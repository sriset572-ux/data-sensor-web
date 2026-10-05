<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\SensorValue;
use App\Models\SensorS3;
use Carbon\Carbon;

class SeedSensorsRealtime extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'seed:sensors-realtime';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seeds sensor data into the database every 10 seconds';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Starting realtime sensor seeding... Press Ctrl+C to stop.');

        while (true) {
            // Seed SensorValue data
            SensorValue::forceCreate([
                'timestamp' => Carbon::now(),
                'moisture1' => rand(20, 80) + (rand(0, 99) / 100),
                'moisture2' => rand(25, 85) + (rand(0, 99) / 100),
                'temperature' => rand(20, 35) + (rand(0, 99) / 100),
                'humidity' => rand(40, 90) + (rand(0, 99) / 100),
                'lux' => rand(100, 1000) + (rand(0, 99) / 100),
                'rain' => rand(0, 1),
            ]);

            // Seed SensorS3 data
            SensorS3::forceCreate([
                'timestamp' => Carbon::now(),
                'temperature' => rand(20, 35) + (rand(0, 99) / 100),
                'moisture' => rand(20, 80) + (rand(0, 99) / 100),
                'ph' => rand(5, 7) + (rand(0, 99) / 100),
                'conductivity' => rand(100, 1500) + (rand(0, 99) / 100),
                'nitrogen' => rand(10, 100) + (rand(0, 99) / 100),
                'phosphorus' => rand(10, 100) + (rand(0, 99) / 100),
                'potassium' => rand(10, 100) + (rand(0, 99) / 100),
            ]);

            $this->info('Data seeded at ' . Carbon::now());

            // Tunggu 10 detik
            sleep(10);
        }

        return 0;
    }
}
