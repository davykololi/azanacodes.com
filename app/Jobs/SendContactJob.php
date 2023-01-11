<?php

namespace App\Jobs;

use Mail;
use App\Mail\ContactMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendContactJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $contact;
    public $tries = 3;    
    public $backoff = 60; 
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($contact)
    {
        //
        $this->contact = $contact;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        $address = config('constants.email');
        $contact = $this->contact;
        Mail::to($address)->send(new ContactMail($contact));
    }
}
