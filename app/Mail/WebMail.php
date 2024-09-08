<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WebMail extends Mailable
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
        return $this->view('mail.welcome')->from('info@mygtn.com.au', "Global Trading Network")->subject('Account Created');
    }
}
