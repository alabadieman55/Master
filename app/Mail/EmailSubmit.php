<?php

namespace App\Mail;

use App\Models\Contactus;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Markdown;
use Illuminate\Queue\SerializesModels;

class EmailSubmit extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The contact instance.
     *
     * @var \App\Models\Contactus
     */
    protected $contact;

    /**
     * Create a new message instance.
     */
    public function __construct(Contactus $contact)
    {

                 $this->contact = $contact;
    }
    

    /**
     * Get the message envelope.
     */
    public function build()
    
       
        {
            return $this->subject('New Contact Subject ' . $this->contact->subject)
                ->markdown('emails.contact-form')
                ->with(['contact' => $this->contact]);
        }
    

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.contact-form', // Update this to the correct view path
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
