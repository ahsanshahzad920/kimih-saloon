<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\GenericEmail;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $email;
    protected $subject;
    protected $body;
    protected $attach;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($email, $subject, $body, $attach)
    {
        $this->email = $email;
        $this->subject = $subject;
        $this->body = $body;
        $this->attach = $attach;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->email)->send(new GenericEmail($this->subject, $this->body, $this->attach));
    }
}
