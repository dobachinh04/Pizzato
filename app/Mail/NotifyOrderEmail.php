<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Queue\SerializesModels;

class NotifyOrderEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $emailData; // Dữ liệu đơn hàng

     public function __construct($emailData)
    {
        $this->emailData = $emailData;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            // subject: 'Thông báo đơn hàng #' . $this->emailData['invoice_id']
            subject: 'Đơn hàng #' . $this->emailData['invoice_id'] .' chưa được xử lý'

        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'admin.emails.notification',
            with: $this->emailData
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
