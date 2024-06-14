<?php

namespace App\Helpers;

use App\Models\Product;

class Cart
{
    public function __construct()
    {
        if ($this->get() === null)
            $this->set($this->empty());
    }

    public function add(Product $product, $quantity = 1): void
    {
        $cart = $this->get();

        // Buscar el producto en el carrito
        $existingProductIndex = array_search($product->id, array_column($cart['products'], 'id'));

        if ($existingProductIndex !== false) {
            // Si el producto ya está en el carrito, actualiza la cantidad y el subtotal
            $cart['products'][$existingProductIndex]['quantity'] += $quantity;
            $cart['products'][$existingProductIndex]['subtotal'] = $cart['products'][$existingProductIndex]['quantity'] * $cart['products'][$existingProductIndex]['subtotal_price'];
        } else {
            $total_price = $product->price_by_bag;
            // Si el producto no está en el carrito, agrégalo con los nuevos campos
            $productToAdd = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $quantity,
                'bag_quantity' => $product->bag_quantity,
                'subtotal' => $quantity * $product->price_by_bag,
                'subtotal_price' => $product->price_by_bag,
            ];
            array_push($cart['products'], $productToAdd);
        }

        $this->set($cart);
    }

    public function remove(int $productId): void
    {
        $cart = $this->get();
        array_splice($cart['products'], array_search($productId, array_column($cart['products'], 'id')), 1);
        $this->set($cart);
    }

    public function total(): float
    {
        $cart = $this->get();
        return array_reduce($cart['products'], function ($carry, $product) {
            return $carry + $product['subtotal'];
        }, 0);
    }

    public function clear(): void
    {
        $this->set($this->empty());
    }

    public function empty(): array
    {
        return [
            'products' => [],
        ];
    }

    public function get(): ?array
    {
        return request()->session()->get('cart');
    }

    public function set($cart): void
    {
        request()->session()->put('cart', $cart);
    }

    public function totalQuantity(): int
    {
        $cart = $this->get();
        $total = 0;

        if ($cart && isset($cart['products'])) {
            foreach ($cart['products'] as $product) {
                $total += $product['quantity'];
            }
        }

        return $total;
    }
}