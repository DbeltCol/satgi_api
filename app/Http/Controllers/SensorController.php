<?php

namespace App\Http\Controllers;

use App\Http\Requests\SensorRequest;
use App\Http\Resources\SensorResource;
use App\Models\Sensor;
use App\Models\Sucursal;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;


class SensorController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:get_all_sensors',only: ['index']),
            new Middleware('permission:get_sensor_by_id',only: ['show']),
            new Middleware('permission:create_sensor',only: ['store']),
            new Middleware('permission:edit_sensor',only: ['update']),
            new Middleware('permission:delete_sensor',only: ['destroy']),
           // new Middleware('permission:change_state_sensor',only: ['changeStateSensor']),
        ];
    }

    public function index(Request $request)
    {
        $sucursal = Sucursal::find($request->input('sucursal_id'));
        if(!$sucursal){
            return response()->json([
                'message' => 'Sucursal not found',
            ], Response::HTTP_NOT_FOUND);
        }
        $sensors = Sensor::where('name', 'like', '%' . $request->input('name') . '%')
        ->where('sucursal_id', $request->input('sucursal_id'))
        ->orderBy('id', 'asc')->paginate(10);

        return response()->json([
            'sensors' => SensorResource::collection($sensors),
        ], Response::HTTP_OK);
    }

    public function show(Sensor $sensor)
    {
        return response()->json([
            'sensor' => new SensorResource($sensor),
        ], Response::HTTP_OK);
    }
    
    public function store(SensorRequest $request)
    {
        $sensor = Sensor::create([
            'name' => $request->input('name'),
            'type_sensor_id' => $request->input('type_sensor_id'),
            'sucursal_id' => $request->input('sucursal_id'),
            'type_measurement_id' => $request->input('type_measurement_id'),
            'description' => $request->input('description'),
            'code' => (string) Str::uuid(),
        ]);

        return response()->json([
            'sensor' => new SensorResource($sensor),
        ], Response::HTTP_CREATED);
    }

    public function update(SensorRequest $request, Sensor $sensor)
    {
        $sensor->update([
            'name' => $request->input('name'),
            'type_sensor_id' => $request->input('type_sensor_id'),
            'type_measurement_id' => $request->input('type_measurement_id'),
            'description' => $request->input('description'),
        ]);
        return response()->json([
            'sensor' => new SensorResource($sensor),
        ], Response::HTTP_OK);
    }
    
    public function destroy(Sensor $sensor)
    {
        $sensor->delete();

        return response()->json([
            'message' => 'Sensor deleted successfully',
        ], Response::HTTP_OK);
    }
    public function changeStateSensor(Request $request)
    {
        $sensor = Sensor::find($request->input('sensor_id'));
        if(!$sensor){
            return response()->json([
                'message' => 'Sensor not found',
                'request' => $request->all(),
                'sensor' => $request->input('id'),
            ], Response::HTTP_NOT_FOUND);
        }
        $sensor->update([
            'status' => $request->input('status'),
        ]);
        return response()->json([
            'message' => 'Sensor state changed successfully',
            'sensor' => new SensorResource($sensor),
        ], Response::HTTP_OK);
    }
}
