<?php

namespace Database\Seeders;

use App\Models\TypeMeasurement;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeMeasurementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TypeMeasurement::create([
            'name' => 'centrimetros',
            'symbol' => 'cm',
        ]);

        TypeMeasurement::create([
            'name' => 'metros',
            'symbol' => 'm',
        ]);
    }
}
