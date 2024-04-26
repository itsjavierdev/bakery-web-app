<?php

namespace App\Livewire\Admin\Orders;

use App\Models\Address;
use App\Models\Customer;
use App\Models\DeliveryTime;
use App\Models\Product;
use App\Models\Order;
use Livewire\Component;
use Livewire\Attributes\On;

class Create extends Component
{
    public $delivery_times;

    public $add_customer = false;
    public $add_address = false;

    //modal
    public $open = false;
    public $select = '';

    //inputs
    public $customer = ['id' => null, 'name' => null, 'surname' => null, 'phone' => null, 'email' => null];
    public $address = ['id' => null, 'address' => null, 'reference' => null];
    public $notes;
    public $total_paid;
    public $paid;
    public $delivery_time;
    public $delivery_date;

    //details
    public $products = [];
    public $total;

    public function mount()
    {
        $this->delivery_times = DeliveryTime::all();
    }

    public function render()
    {
        //Calculate the subtotal for each product
        foreach ($this->products as $key => $product) {
            // In case the quantity is empty, set it to 0
            if (is_numeric($product['quantity']) && is_numeric($product['bag_quantity'])) {
                $this->products[$key]['subtotal'] = $product['by_bag'] ?
                    $product['price'] * $product['quantity'] * $product['bag_quantity'] :
                    $product['price'] * $product['quantity'];
            } else {
                $this->products[$key]['subtotal'] = 0;
            }
        }
        // Calculate the total
        $total = 0;
        foreach ($this->products as $product) {
            $total += $product['subtotal'];
        }
        $this->total = $total;

        return view('livewire.admin.orders.create')->layout('layouts.admin-header', ['title' => 'Crear pedido', 'titleAlign' => 'center']);
    }

    public function save()
    {
        $this->validate();

        // Create the customer and address if is a new one (not selected from the list)
        if ($this->customer['id'] == null) {
            $customer = Customer::create([
                'name' => $this->customer['name'],
                'surname' => $this->customer['surname'],
                'phone' => $this->customer['phone'],
                'email' => $this->customer['email'],
            ]);
            $this->customer['id'] = $customer->id;
        }
        if ($this->address['id'] == null) {
            if ($this->address['address'] != null) {
                $address = Address::create([
                    'address' => $this->address['address'],
                    'reference' => $this->address['reference'],
                    'customer_id' => $this->customer['id'],
                ]);
                $this->address['id'] = $address->id;
            }
        }

        // Create the order
        $order = Order::create([
            'delivery_date' => $this->delivery_date,
            'total' => $this->total,
            'paid_amount' => $this->total_paid,
            'paid' => $this->total_paid == $this->total ? true : false,
            'notes' => $this->notes,
            'customer_id' => $this->customer['id'],
            'address_id' => $this->address['id'],
            'delivery_time_id' => $this->delivery_time,
        ]);

        // Create the order details
        foreach ($this->products as $product) {
            $order->products()->attach($product['id'], [
                'product_price' => $product['price'],
                'quantity' => $product['quantity'],
                'subtotal' => $product['subtotal'],
                'by_bag' => $product['by_bag'],
            ]);
        }

        return redirect()->to('admin/pedidos')->with('flash.bannerStyle', 'success')->with('flash.banner', 'Pedido creado correctamente');
    }


    public function updatedPaid($value)
    {
        if ($value) {
            $this->total_paid = round($this->total, 1);
        } else {
            $this->total_paid = null;
        }
    }

    // Open modal to select customer, address or product
    public function toggleModal($value)
    {
        if ($value == '') {
            $this->open = false;
            return;
        }
        $this->open = true;
        $this->select = $value;
    }

    public function deleteProduct($key)
    {
        $this->products = array_values(array_filter($this->products, function ($product) use ($key) {
            return $product['id'] != $key;
        }));
    }

    #[On('add-productos')]
    public function addProduct($id)
    {
        $product = Product::find($id);

        // If the product is in the list, set the key as a existing product
        $existing_product_key = null;
        foreach ($this->products as $key => $item) {
            if ($item['id'] == $product->id) {
                $existing_product_key = $key;
                break;
            }
        }

        //if the product is set as exisiting product, update the quantity
        if ($existing_product_key !== null) {
            $this->products[$existing_product_key]['quantity'] += 1;
            $this->products[$existing_product_key]['subtotal'] += $product->price;
        } else {
            //if the product is not in the list, add it
            $new_product = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'bag_quantity' => $product->bag_quantity,
                'quantity' => 1,
                'by_bag' => false,
                'subtotal' => $product->price
            ];
            $this->products[] = $new_product;
        }
        $this->open = false;
    }

    #[On('add-direcciones')]
    public function addAddress($id)
    {
        $this->address = [
            'id' => $id,
            'address' => Address::find($id)->address
        ];
        $this->add_address = false;
        $this->open = false;
    }

    #[On('add-clientes')]
    public function addCustomer($id)
    {
        $this->customer = [
            'id' => $id,
            'name' => Customer::find($id)->name

        ];
        $this->reset('address');
        $this->add_customer = false;
        $this->open = false;
    }

    //validation rules
    public function rules()
    {
        $rules = [
            'customer.name' => 'required|regex:/^[a-zA-ZáéíóúüñÁÉÍÓÚÜÑ\s]+$/|min:3|max:25',
            'address.address' => 'nullable|string|min:5|max:100',
            'notes' => 'nullable|string|max:255',
            'products' => 'required|array|min:1',
            'products.*.quantity' => 'required|integer|min:1',
            'delivery_time' => 'required|exists:delivery_times,id',
            'delivery_date' => 'required|date|after_or_equal:today',
        ];
        if ($this->add_address) {
            $rules['address.address'] = 'required|string|min:5|max:100';
            $rules['address.reference'] = 'nullable|string|max:50';

        }
        if ($this->add_customer) {
            $rules['customer.surname'] = 'required|regex:/^[a-zA-ZáéíóúüñÁÉÍÓÚÜÑ\s]+$/|min:3|max:25';
            $rules['customer.phone'] = 'required|integer|min:60000000|max:80090000|unique:customers,phone';
            $rules['customer.email'] = 'nullable|string|email|max:255|unique:customers,email';

        }
        $rules['total_paid'] = [
            'nullable',
            'numeric',
            'between:0,99999.9',
            function ($attribute, $value, $fail) {
                if ($value > ($this->total + 1)) {
                    $fail('El monto pagado no puede ser mayor que el total.');
                }
            },
        ];

        return $rules;

    }
    public function validationAttributes()
    {
        return [
            'customer.name' => 'cliente',
            'customer.surname' => 'apellido cliente',
            'customer.phone' => 'teléfono cliente',
            'customer.email' => 'correo electrónico cliente',
            'address.address' => 'dirección',
            'address.reference' => 'referencia',
            'notes' => 'nota',
            'total_paid' => 'total pagado',
            'products' => 'productos',
            'products.*.quantity' => 'cantidad',
            'delivery_time' => 'hora de entrega',
            'delivery_date' => 'fecha de entrega',
        ];
    }

    public function messages()
    {
        return [
            'customer.name.regex' => 'El campo cliente solo puede contener letras.',
            'customer.surname.regex' => 'El campo apellido cliente solo puede contener letras.',
            'products.*.quantity.min' => 'Los productos deben tener al menos una cantidad de 1.',
        ];
    }

    public function updatingAddCustomer()
    {
        $this->reset('customer');
    }
    public function updatingAddAddress()
    {
        $this->reset('address');
    }
}