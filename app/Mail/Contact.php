<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Contact extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $name, $email, $telephone, $message;
    public function __construct($name, $email, $telephone, $message)
    {

        $this->name = $name;
        $this->email = $email;
        $this->telephone = $telephone;
        $this->message = $message;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.Enquiry', ['name' => $this->name,'mail' => $this->email,'mobile' => $this->telephone,'message' => $this->message,]);
    }
}
