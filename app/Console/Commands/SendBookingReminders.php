<?php

namespace App\Console\Commands;

use App\Jobs\SendBookingReminderSmsJob;
use App\Models\Appointment;
use Carbon\Carbon;
use Illuminate\Console\Command;

class SendBookingReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    // protected $signature = 'app:send-booking-reminders';
    protected $signature = 'booking:reminders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send booking reminders';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // $today = Carbon::now()->addDay(); // Get tomorrow's date
        // $booking = Appointment::where('start', $today)->get();

        $tomorrowStart = now()->addDay()->startOfDay(); // Start of tomorrow (00:00:00)
        $tomorrowEnd = now()->addDay()->endOfDay();     // End of tomorrow (23:59:59)

        $bookings = Appointment::whereBetween('start', [$tomorrowStart, $tomorrowEnd])->get();

        foreach ($bookings as $booking) {
            SendBookingReminderSmsJob::dispatch($booking->client->phone,$booking->client->name, $booking->location, $booking->start);
        }

        return Command::SUCCESS;
    }
}
