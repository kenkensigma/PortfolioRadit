<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class ContactMail extends Mailable
{
    public function __construct(
        public string $senderName,
        public string $senderEmail,
        public string $body,  // ← renamed from $message to $body
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: "New message from {$this->senderName}",
            replyTo: [$this->senderEmail],
        );
    }

    public function content(): Content
    {
        return new Content(view: 'emails.contact');
    }
}