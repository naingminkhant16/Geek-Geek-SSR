<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

use function PHPUnit\Framework\isNull;

class CustomMail extends Mailable
{
    use Queueable, SerializesModels;

    public $subject, $body, $files;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $subject, string $body, array|null $files = null)
    {

        $this->subject = $subject;
        $this->body = $body;
        $this->files = $files;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            from: new Address(getenv("MAIL_FROM_ADDRESS"), getenv("APP_NAME")),
            subject: $this->subject,
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: "Mails.custom-mail",
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        if (is_null($this->files))  return [];

        return array_map(function ($file) {
            return Attachment::fromPath(
                public_path("storage/mail_files/" . $file)
            );
        }, $this->files);
    }
}
