<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CredentialsMailable extends Mailable
{
    use Queueable, SerializesModels;

    public $subject;
    public $data;
    public function __construct($data)
    {
        $this->subject = $data['title'];
        $this->data = $data;
    }

   
    public function build()
    {
        return $this->view('Emails.credentials');
    }
}
