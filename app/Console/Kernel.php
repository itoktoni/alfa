<?php

namespace App\Console;

use App\Console\Commands\CheckOutstandingHilang;
use App\Console\Commands\CheckOutstandingPending;
use App\Console\Commands\CleanGroupingConsole;
use App\Console\Commands\CleanKotorConsole;
use App\Console\Commands\CleanRegisterConsole;
use App\Console\Commands\RegisterConsole;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel {

    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        'App\Console\Commands\Console',
        'App\Console\Commands\SyncDownloadOutstanding',
        'App\Console\Commands\SyncUploadOutstanding',
        'App\Console\Commands\SyncUpdateOutstanding',
        CleanRegisterConsole::class,
        CleanKotorConsole::class,
        CleanGroupingConsole::class,
        CheckOutstandingPending::class,
        CheckOutstandingHilang::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule) {
//        $schedule->command('email:system')->withoutOverlapping()->everyMinute();
        // $schedule->command('inspire')
        //          ->hourly();
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands() {
        require base_path('routes/console.php');
    }

}
