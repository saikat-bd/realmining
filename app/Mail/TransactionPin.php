<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TransactionPin extends Mailable
{
    use Queueable, SerializesModels;
    public $userinfo;
    public function __construct($userinfo)
    {
        $this->userinfo = $userinfo;
    }

    public function build()
    {
        return $this->view('mail.trsansaction_pin')->from('info@mygtn.com.au', "Global Trading Network")->subject('Transaction New PIN');
    }
}
