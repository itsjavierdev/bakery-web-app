<?php

namespace App\Mail;

use App\Models\Address;
use App\Models\DeliveryTime;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $order;
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Confirmacion de pedido',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $customer = $this->order->customer;
        $details = OrderDetail::join('products', 'order_details.product_id', '=', 'products.id')
            ->where('order_details.order_id', $this->order->id)
            ->select('order_details.*', 'products.name as product_name', 'products.price_by_bag')
            ->get();

        $address = $this->order->address;
        $delivery_time = DeliveryTime::where('id', $this->order->delivery_time_id)->first();
        $addressBakery = Address::where('id', 1)->first();

        return new Content(
            markdown: 'emails.order-confirmation',
            with: [
                'customer' => $customer,
                'details' => $details,
                'address' => $address,
                'delivery_time' => $delivery_time,
                'addressBakery' => $addressBakery,
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
