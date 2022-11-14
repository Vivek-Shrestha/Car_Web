<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('planexpiry:cron')
        ->daily();
        //->everyThirtyMinutes();
       //   ->everyFifteenMinutes();
           // ->everyTwelveHours();
        //   ->cron('0 */12 * * *');
       //    ->twiceDaily(12, 12);	
       //->everyFifteenMinutes();
       // ->dailyAt('12:00');
       // ->weekly();	
       // ->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
