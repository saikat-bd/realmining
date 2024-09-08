<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\WithdrawalOTPMailSend;


class WithdrawalOTPMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $details;

    public function __construct($details)
    {
      $this->details = $details;  
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        echo '\n mail send start \n'.$this->details->name;

        Mail::to($this->details->email)->send(new WithdrawalOTPMailSend($this->details));

        sleep(5);
        echo '\n mail send finish \n';
    }
}
