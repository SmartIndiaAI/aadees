<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderStatusChanged extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $statusMessage;

    public function __construct(Order $order, $message = null)
    {
        $this->order = $order;
        $this->statusMessage = $message ?? "Your order #{$order->order_number} status has been updated to {$order->status}.";
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: "Order #{$this->order->order_number} - Status Update",
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.order_status',
        );
    }
}
