<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\TypeSensorRequest;
use App\Http\Resources\TypeSensorResource;
use App\Models\TypeSensor;

class TypeSensorController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:get_all_type_sensors',only: ['index']),
            new Middleware('permission:get_type_sensor_by_id',only: ['show']),
            new Middleware('permission:create_type_sensor',only: ['store']),
            new Middleware('permission:edit_type_sensor',only: ['update']),
            new Middleware('permission:delete_type_sensor',only: ['destroy']),
        ];
    }

    public function index(Request $request)
    {
        $typeSensors = TypeSensor::all();
        return response()->json([
            'typeSensors' => TypeSensorResource::collection($typeSensors),
        ], Response::HTTP_OK);
    }

    public function store(TypeSensorRequest $request)
    {
        $typeSensor = TypeSensor::create($request->all());
        return response()->json([
            'typeSensor' => new TypeSensorResource($typeSensor),
        ], Response::HTTP_CREATED);
    }

    public function show(TypeSensor $typeSensor)
    {
        return response()->json([
            'typeSensor' => new TypeSensorResource($typeSensor),
        ], Response::HTTP_OK);
    }
    
    public function update(TypeSensorRequest $request, TypeSensor $typeSensor)
    {
        $typeSensor->update($request->all());
        return response()->json([
            'typeSensor' => new TypeSensorResource($typeSensor),
        ], Response::HTTP_OK);
    }
    
    public function destroy(TypeSensor $typeSensor)
    {
        $typeSensor->delete();
        return response()->json([
            'message' => 'Type sensor deleted successfully',
        ], Response::HTTP_OK);
    }
}
