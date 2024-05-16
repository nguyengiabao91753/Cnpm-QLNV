<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendUserAccount extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $email;

    public $password;


    /**
     * Create a new message instance.
     */
    public function __construct($name, $email, $password)
    {
        $this->name= $name;
        $this->email = $email;
        $this->password = $password;
    }


    public function build(){
        return $this->from(config('mail.from.address'), config('mail.from.name'))
        ->view('sendmail.sendacctouser',[
            'name' => $this->name,
            'email' => $this->email,
            'password'=> $this->password
        ]);
    }


    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Send User Account',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'sendmail.sendacctouser',
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
