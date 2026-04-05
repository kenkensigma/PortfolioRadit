<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class ContactMail extends Mailable
{
    public function __construct(
        public string $name,
        public string $email,
        public string $userMessage
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Message from Portfolio',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.contact',
            with: [
                'name'    => $this->name,
                'email'   => $this->email,
                'message' => $this->userMessage,
            ]
        );
    }
}