<?php

namespace Database\Seeders;

use App\Models\Facility;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class FacilitySeeder extends Seeder
{
    public function run()
    {
        $buildings = ['KA' => 8, 'KB' => 10];

        foreach ($buildings as $building => $floors) {
            for ($floor = 0; $floor <= $floors; $floor++) {
                $roomCount = rand(10, 30);

                for ($i = 1; $i <= $roomCount; $i++) {
                    $roomNum = Str::padLeft($floor * 100 + $i, 3, '0');
                    Facility::create([
                        'name' => "{$building}{$roomNum}",
                        'location' => $building,
                        'description' => "Room {$building}{$roomNum} located on floor $floor",
                    ]);
                }
            }
        }
    }
}
