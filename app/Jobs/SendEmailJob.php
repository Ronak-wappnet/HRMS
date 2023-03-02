<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\forgotPassword;
use Illuminate\Support\Facades\Mail;



class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $data;  
    /**
     * Create a new job instance.
     */
    public function __construct($data)
    {
        $this->data = $data;
       
    }
    /**
     * Execute the job.
     */
    public function handle(): void
    {       
        // $email=new forgotPassword();
        // Mail::to($this->data['email'])->send($email);
        Mail::send('email.forgotPassMail',$this->data['token'],$this->data['request'], function ($message){
            $message->from('rronak0016@gmail.com');
            $message->to($this->data['email']);
            $message->subject('Reset password');
        });
    }
}
