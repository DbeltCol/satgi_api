<?php

namespace Database\Seeders;

use App\Models\Sensor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SensorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Sensor::create([
            'name' => 'Sensor Satib',
            'type_sensor_id' => 1,
            'sucursal_id' => 1,
            'type_measurement_id' => 1,
            'description' => 'Sensor de movimiento para medida del rio Bogota',
            'code' => "7c1a4f9e-2d6b-4e3c-9b8a-1f6e4c92a7d5"
        ]);
    }
}
