<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
// Assuming your Order model is located here
use App\Models\Order;
class OrderStatusUpdated extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The order instance.
     * @var Order
     */
    public $order;
    /**
     * Create a new message instance.
     */
    public function __construct(Order $order)
    {
        // We inject the order object into the Mailable
        $this->order = $order;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        // Define the email subject based on the new status
        $statusText = $this->getStatusText($this->order->status);

        return new Envelope(
            subject: 'به‌روزرسانی وضعیت سفارش #' . $this->order->order_number,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        // Use the markdown view we created
        return new Content(
            markdown: 'emails.orders.status_updated',
        );
    }

    /**
     * Helper function to convert status slug to readable text.
     * Since we pass the entire Order object, this can be moved to a Trait or the Model,
     * but we keep it here for simplicity.
     */
    private function getStatusText(string $status): string
    {
        return match ($status) {
            'pending' => 'در انتظار تایید',
            'processing' => 'در حال پردازش',
            'delivered' => 'تحویل پیک یا پست داده شده',
            'completed' => 'تکمیل شده',
            'canceled' => 'لغو شده',
            default => 'وضعیت نامشخص',
        };
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
