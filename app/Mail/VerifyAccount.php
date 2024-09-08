<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VerifyAccount extends Mailable
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
         return $this->view('mail.account_verifaction')->from('info@mygtn.com.au', "Global Trading Network")->subject('Verify your GTN');
    }
}
