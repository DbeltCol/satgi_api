<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class SensorMeasurementResource extends JsonResource
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
            'name' => $this->sensor->name,
            'measurement' => $this->measurement,
            'symbol' => $this->sensor->typeMeasurement->symbol,
            'created_at' => Carbon::parse($this->created_at)->format('d/m/Y H:i:s'),
        ];
    }
}
