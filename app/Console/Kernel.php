<?php

namespace App\Console;

use App\Jobs\SendConcertPromotion;
use App\Jobs\SendTicketMail;
use App\Models\User;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {

        $users = User::all();
        foreach ($users as $user) {
            $schedule->job(new SendConcertPromotion($user))->weekly();
        }
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
