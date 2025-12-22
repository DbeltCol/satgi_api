<?php

namespace Database\Seeders;

use App\Models\TypeSensor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeSensorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TypeSensor::create([
            'name' => 'Sensor de movimiento',
        ]);
    }
}
