<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

// Artisan::command('send:reminder', function () {
//     $this->comment('Sending reminder to users');
// })->purpose('Send reminder to users')->daily();

// Schedule::command('booking:reminders')
//     ->daily()
//     ->at('23:00')
//     ->timezone('Asia/Karachi')
//     ->withoutOverlapping()
//     ->runInBackground();

// Schedule::command('booking:reminders')->daily();
Schedule::command('booking:reminders')->everyFiveSeconds();
// Schedule::command('inspire')->everySecond();
