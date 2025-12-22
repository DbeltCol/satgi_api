<?php

namespace App\Http\Controllers;

use App\Http\Requests\SucursalRequest;
use App\Http\Resources\SucursalResource;
use App\Http\Resources\SucursalSensorResource;
use App\Models\Sucursal;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Symfony\Component\HttpFoundation\Response;

class   SucursalController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:get_all_sucursals',only: ['index']),
            new Middleware('permission:get_sucursal_by_id',only: ['show']),
            new Middleware('permission:create_sucursal',only: ['store']),
            new Middleware('permission:edit_sucursal',only: ['update']),
            new Middleware('permission:delete_sucursal',only: ['destroy']),
        ];
    }

    public function index(Request $request)
    {
        $sucursals = Sucursal::where('name', 'like', '%' . $request->input('name') . '%')->get();
        return response()->json([
            'sucursals' => SucursalResource::collection($sucursals),
        ], Response::HTTP_OK);
    }

    public function show($id)
    {
        $sucursal = Sucursal::find($id);
        if(!$sucursal){
            return response()->json([
                'message' => 'Sucursal not found',
            ], Response::HTTP_NOT_FOUND);
        }
        return response()->json([
            'sucursal' => new SucursalSensorResource($sucursal),
        ], Response::HTTP_OK);
    }

    public function store(SucursalRequest $request)
    {
        $sucursal = Sucursal::create($request->all());
        return response()->json([
            'sucursal' => new SucursalResource($sucursal),
        ], Response::HTTP_CREATED);
    }

    public function update(SucursalRequest $request, $id)
    {
        $sucursal = Sucursal::find($id);
        if(!$sucursal){
            return response()->json([
                'message' => 'Sucursal not found',
            ], Response::HTTP_NOT_FOUND);
        }
        $sucursal->update($request->all());
        return response()->json([
            'sucursal' => new SucursalResource($sucursal),
        ], Response::HTTP_OK);
    }

    public function destroy(Sucursal $sucursal)
    {
        $sucursal->delete();
        return response()->json([
            'message' => 'Sucursal deleted successfully',
        ], Response::HTTP_OK);
    }
}
