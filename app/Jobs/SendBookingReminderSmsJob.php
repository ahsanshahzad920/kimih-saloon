<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Twilio\Rest\Client;

class SendBookingReminderSmsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(public $phone,public $name, public $location, public $date)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {

        try
        {
            $sid = getenv("TWILIO_ACCOUNT_SID");
            $token = getenv("TWILIO_AUTH_TOKEN");
            $twilio = new Client($sid, $token);

            // Send the SMS message
            $twilio->messages->create(
                // $this->phone,
                '+923164734175',
                [
                    "body" => "Hi $this->name, this is a reminder that you have an appointment at $this->location on $this->date.",
                    "from" => getenv("TWILIO_PHONE"),
                ]
            );
            Log::info('SMS sent successfully');
        }
        catch (\Exception $e)
        {
            // dd($e->getMessage());
            // Handle the exception and redirect back with an error message
            Log::error('Failed to send SMS: ' . $e->getMessage());

        }


    }
}
