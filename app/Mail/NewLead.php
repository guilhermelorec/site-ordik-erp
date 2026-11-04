<?php

namespace App\Mail;

use App\Models\Lead;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class NewLead extends Mailable
{
    public function __construct(public Lead $lead) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: "Novo lead: {$this->lead->company}",
            replyTo: [$this->lead->email],
        );
    }

    public function content(): Content
    {
        return new Content(markdown: 'mail.new-lead');
    }
}
