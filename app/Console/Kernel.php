<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Carbon\Carbon;
use App\Model\Ept;
use App\Model\Registerept;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        // Commands\Inspire::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();

        $schedule->call(function () {
          $now = Carbon::today();
          $id = Ept::select('id')->where('registration_date', '<', $now->toDateString())->get()->pluck('id')->toArray();
          $update = Registerept::whereIn('id_ept', $id)->whereNotIn('status', ['Verified', 'Done', 'Abandoned'])->update([
            'status' => 'Abandoned'
          ]);
        })->daily()->timezone('Asia/Jakarta');
    }
}
