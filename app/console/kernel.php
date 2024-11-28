<?php

namespace App\Console;

use App\Jobs\SendAppointmentReminderJob;
use App\Models\Appointement;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            Log::info('Scheduled task is running.');
    
            $appointements = Appointement::with('patient')
                ->where('date', now()->addDays(2)->toDateString())
                ->get();
    
            foreach ($appointements as $appointement) {
                Log::info('Dispatching job for appointment ID: ' . $appointement->id);
                SendAppointmentReminderJob::dispatch($appointement);
            }
        })->dailyAt('22:41');
    }
    

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
    

    // Other methods...
}
