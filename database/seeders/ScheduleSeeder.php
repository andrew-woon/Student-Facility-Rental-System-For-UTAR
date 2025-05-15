<?php

namespace Database\Seeders;

use App\Models\Schedule;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class ScheduleSeeder extends Seeder
{
    public function run(): void
    {
        $facilityId = 1;
        $users = User::whereBetween('id', [1, 10])->get();
        $statuses = ['approved', 'pending', 'rejected'];
        $reasons = ['Meeting', 'Class', 'Discussion', 'Interview', 'Presentation'];

        $startDate = Carbon::today()->addMonth();
        $endDate = Carbon::today()->addMonths(3);

        $allSchedules = [];

        for ($date = $startDate->copy(); $date->lte($endDate); $date->addDay()) {
            $dailySchedules = [];

            $bookingCount = rand(0, 5);

            for ($i = 0; $i < $bookingCount; $i++) {
                $startHour = rand(6, 20);
                $startMinute = [0, 30][rand(0, 1)];
                $start = $date->copy()->setTime($startHour, $startMinute);

                $duration = [30, 60, 90, 120][rand(0, 3)];
                $end = $start->copy()->addMinutes($duration);

                if ($end->hour > 21 || ($end->hour == 21 && $end->minute > 0)) {
                    continue;
                }

                $status = $statuses[array_rand($statuses)];

                $conflict = false;
                if ($status !== 'pending') {
                    foreach ($dailySchedules as $existing) {
                        if (
                            $start < $existing['end_time'] &&
                            $end > $existing['start_time']
                        ) {
                            $conflict = true;
                            break;
                        }
                    }
                }

                if ($conflict) continue;

                $dailySchedules[] = [
                    'user_id' => $users->random()->id,
                    'facility_id' => $facilityId,
                    'start_time' => $start,
                    'end_time' => $end,
                    'status' => $status,
                    'reasons' => $reasons[array_rand($reasons)],
                    'feedback' => null,
                    'feedback_by' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            $allSchedules = array_merge($allSchedules, $dailySchedules);
        }

        Schedule::insert($allSchedules);
    }
}
