<?php

namespace App\Console\Commands;

use App\Models\Attendance;
use App\Models\Schedule;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('app:process-absent-command')]
#[Description('Process absent command description')]
class ProcessAbsentCommand extends Command
{
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $schedule = Schedule::query()
            ->whereRelation('shift', 'end_time', '<', now())
            ->whereDoesntHave('attendance')
            ->get();

        $data = [];

        foreach ($schedule as $schedule) {
            $data[] = [
                'user_id'     => null,
                'schedule_id' => null,
                'start_time'  => null,
                'end_time'    => null,
                'status'      => 'absent',
                'created_at'  => now(),
                'updated_at'  => now(),
            ];
        }

        Attendance::query()->insert($data);

        return Command::SUCCESS;
    }
}
