<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Models\Slot;
use App\Enums\SlotStatus;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class SlotSeeder extends Seeder
{
    public function run(): void
    {
        $services = Service::all();
        $startDate = Carbon::now()->startOfDay();

        // Create slots for the next 7 days
        for ($day = 0; $day < 7; $day++) {
            $currentDate = $startDate->copy()->addDays($day);
            
            // Create slots from 9 AM to 5 PM
            $startTime = 9; // 9 AM
            $endTime = 17;  // 5 PM

            foreach ($services as $service) {
                for ($hour = $startTime; $hour < $endTime; $hour++) {
                    Slot::create([
                        'service_id' => $service->id,
                        'day' => $currentDate->format('Y-m-d'),
                        'start_time' => sprintf('%02d:00:00', $hour),
                        'status' => SlotStatus::Available
                    ]);
                }
            }
        }
    }
}
