<?php

namespace App\Mail;

use App\Models\Customer;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CustomerNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public Customer $customer;

    public string $subjectText;

    public string $messageContent;

    public function __construct(Customer $customer, string $subject, string $message)
    {
        $this->customer = $customer;
        $this->subjectText = $subject;
        $this->messageContent = $message;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->subjectText,
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.customer-notification',
        );
    }
}
