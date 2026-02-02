<?php

namespace App\Http\Controllers;

use App\Http\Requests\SensorMeasurementRequest;
use App\Http\Resources\SensorMeasurementResource;
use App\Models\Sensor;
use App\Models\SensorMeasurement;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class SensorMeasurementController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:get_measurements_by_sensor',only: ['measurementsBySensor']),
            //new Middleware('permission:create_measurements_by_sensor',only: ['createMeasurementsBySensor']),
        ];
    }

    public function measurementsBySensor(Request $request, $id)
    {
        $sensor = Sensor::where('id', $id)->first();
        if(!$sensor){
            return response()->json([
                'message' => 'Sensor not found',
            ], Response::HTTP_NOT_FOUND);
        }

        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');

        if($fromDate && $toDate){
            $sensorMeasurements = SensorMeasurement::where('sensor_id', $sensor->id)
            ->where('created_at', '>=', $fromDate)
            ->where('created_at', '<=', $toDate)
            ->orderBy('created_at', 'desc')
            ->get();
        } else {
            $sensorMeasurements = SensorMeasurement::where('sensor_id', $sensor->id)->orderBy('created_at', 'desc')->get();
        }

        return response()->json([
            'sensorMeasurements' => SensorMeasurementResource::collection($sensorMeasurements),
        ], Response::HTTP_OK);
    }

    public function createMeasurementsBySensor(SensorMeasurementRequest $request)
    {
        $sensor = Sensor::where('code', $request->input('code'))->first();
        if(!$sensor){
            return response()->json([
                'message' => 'Not authenticated',
            ], Response::HTTP_UNAUTHORIZED);
        }

        $sensorMeasurement = SensorMeasurement::create([
            'sensor_id' => $sensor->id,
            'measurement' => $request->input('measurement'),
        ]);

        return response()->json([
            'sensorMeasurement' => new SensorMeasurementResource($sensorMeasurement),
        ], Response::HTTP_CREATED);
    }

}
