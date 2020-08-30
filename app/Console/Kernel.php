<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel {
	/**
	 * The Artisan commands provided by your application.
	 *
	 * @var array
	 */
	protected $commands = [
		'App\Console\Commands\NotificationsCommand',

	];

	protected function schedule(Schedule $schedule) {

		$schedule->command('notification:generate')->dailyAt('10:00');
		$schedule->command('notification:generate')->dailyAt('16:00');
		$schedule->command('notification:generate')->dailyAt('21:00');
		// $schedule->command('notification:generate')->daily();

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
