<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SensorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'type_sensor' => $this->typeSensor->name,
            'type_sensor_id' => $this->type_sensor_id,
            'type_measurement_id' => $this->type_measurement_id,
            'status' => $this->status == 'active' ? 'Activo' : 'Inactivo',
            'quantity_measurements' => $this->sensorMeasurements->count(),
            'measurements' => SensorMeasurementResource::collection($this->sensorMeasurements),
   
        ];
    }
}
