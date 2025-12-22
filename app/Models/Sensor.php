<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sensor extends Model
{
    use SoftDeletes;
    protected $fillable = ['name', 'type_sensor_id', 'sucursal_id', 'type_measurement_id', 'description', 'status', 'port', 'latitude', 'longitude', 'altitude', 'accuracy', 'code'];

    public function typeSensor()
    {
        return $this->belongsTo(TypeSensor::class);
    }
    public function typeMeasurement()
    {
        return $this->belongsTo(TypeMeasurement::class);
    }

    public function sucursal()
    {
        return $this->belongsTo(Sucursal::class);
    }

    public function sensorMeasurements()
    {
        return $this->hasMany(SensorMeasurement::class);
    }
}
