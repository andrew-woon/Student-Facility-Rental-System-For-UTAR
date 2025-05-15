<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Schedule;
use Carbon\Carbon;

class DeleteExpiredSchedules extends Command
{
    protected $signature = 'schedules:clean-expired';
    protected $description = 'Delete schedules with end_time one month ago';

    public function handle()
    {
        $cutoff = now()->subMonth();
    
        $deleted = Schedule::where('end_time', '<', $cutoff)->delete();
    
        $this->info("Deleted $deleted schedules older than one month.");
    }
    
}
