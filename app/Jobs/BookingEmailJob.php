<?php

namespace App\Jobs;

use App\Mail\BookingEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class BookingEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(public $email, public $name, public $location, public $date)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Send the email
        Mail::to($this->email)->send(new BookingEmail($this->name, $this->location, $this->date));

    }
}
