<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ForgotPassword extends Mailable
{
    use Queueable, SerializesModels;

    public $userinfo;

    public function __construct($userinfo)
    {
        $this->userinfo = $userinfo;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('info@mygtn.com.au', "Global Trading Network")
                ->subject('Lost password request')
                ->view('mail.forgot_passowrd');
    }
}
