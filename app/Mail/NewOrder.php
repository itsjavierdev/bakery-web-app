<?php

namespace App\Mail;

use App\Models\DeliveryTime;
use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewOrder extends Mailable
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
            subject: 'Nuevo pedido',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $customer = $this->order->customer;
        $delivery_time = DeliveryTime::where('id', $this->order->delivery_time_id)->first();

        return new Content(
            markdown: 'emails.new-order',
            with: [
                'customer' => $customer,
                'delivery_time' => $delivery_time,
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
