<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            [
                'name' => 'Regular Checkup',
                'description' => 'Comprehensive dental examination and cleaning',
                'price' => 100.00,
                'is_active' => true,
            ],
            [
                'name' => 'Normal Cleaning',
                'description' => 'Basic cleaning and polishing',
                'price' => 80.00,
                'is_active' => true,
            ],
            [
                'name' => 'Deep Cleaning',
                'description' => 'Deep cleaning and tartar removal',
                'price' => 150.00,
                'is_active' => true,
            ],
            [
                'name' => 'Tooth Filling',
                'description' => 'Dental filling for cavities',
                'price' => 200.00,
                'is_active' => true,
            ],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}
