<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactEgourmet extends Mailable
{
    use Queueable, SerializesModels;

    public $messageBody;
    public $messageSender;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($messageBody, $messageSender)
    {
        $this->messageBody = $messageBody;
        $this->messageSender = $messageSender;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $messageBody = $this->messageBody;
        return $this->from($this->messageSender)
            ->replyTo($this->messageSender)
            ->view('emails.contactemail', compact('messageBody'));
    }
}
