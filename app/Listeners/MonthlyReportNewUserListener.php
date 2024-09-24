<?php

namespace App\Listeners;

use App\Events\NewUserRegistered;
use App\Models\MonthlyReport;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class MonthlyReportNewUserListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(NewUserRegistered $event): void
    {
        MonthlyReport::where('month', now()->format('Y-m'))->increment('users_count');
    }
}
