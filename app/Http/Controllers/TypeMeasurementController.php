<?php

namespace App\Http\Controllers;

use App\Http\Requests\TypeMeasurementRequest;
use App\Http\Resources\TypeMeasurementResource;
use App\Models\TypeMeasurement;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class TypeMeasurementController extends Controller implements HasMiddleware
{

    public static function middleware(): array
    {
        return [
            new Middleware('permission:get_all_type_measurements',only: ['index']),
            new Middleware('permission:get_type_measurement_by_id',only: ['show']),
            new Middleware('permission:create_type_measurement',only: ['store']),
            new Middleware('permission:edit_type_measurement',only: ['update']),
            new Middleware('permission:delete_type_measurement',only: ['destroy']),
        ];
    }

    public function index(Request $request)
    {
        $typeMeasurements = TypeMeasurement::all();
        return response()->json([
            'typeMeasurements' => TypeMeasurementResource::collection($typeMeasurements),
        ], Response::HTTP_OK);
    }

    public function store(TypeMeasurementRequest $request)
    {
        $typeMeasurement = TypeMeasurement::create($request->all());
        return response()->json([
            'typeMeasurement' => new TypeMeasurementResource($typeMeasurement),
        ], Response::HTTP_CREATED);
    }

    public function show(TypeMeasurement $typeMeasurement)
    {
        return response()->json([
            'typeMeasurement' => new TypeMeasurementResource($typeMeasurement),
        ], Response::HTTP_OK);
    }

    public function update(TypeMeasurementRequest $request, TypeMeasurement $typeMeasurement)
    {
        $typeMeasurement->update($request->all());
        return response()->json([
            'typeMeasurement' => new TypeMeasurementResource($typeMeasurement),
        ], Response::HTTP_OK);
    }

    public function destroy($id)
    {
        $typeMeasurement = TypeMeasurement::find($id);
        if(!$typeMeasurement){
            return response()->json([
                'message' => 'Type measurement not found',
            ], Response::HTTP_NOT_FOUND);  
        }
        $typeMeasurement->delete();
        return response()->json([
            'message' => 'Type measurement deleted successfully',
        ], Response::HTTP_OK);
    }
}
