<?php

namespace App\Mail;

use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewOrderNotification extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Order Placed — Rublevsky Store',
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'mail.orders.notification',
            with: [
                'order' => $this->order,
                'url' => route('my-orders.show', $this->order->id),
                'user' => $this->order->user,
                'items' => $this->order->items,
                'address' => $this->order->address,
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
