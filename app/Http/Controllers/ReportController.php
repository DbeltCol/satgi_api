<?php

namespace App\Http\Controllers;

use App\Models\SensorMeasurement;
use App\Models\Sucursal;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ReportController extends Controller
{
    public function getSucursalsAction(Request $request)
    {
        $fromDate = $request->input('fromDate');
        $toDate = $request->input('toDate');

        $sucursals = Sucursal::query();
        if($fromDate){
            $sucursals->where('created_at', '>=', Carbon::parse($fromDate . ' 00:00:00'));
        }
        if($toDate){
            $sucursals->where('created_at', '<=', Carbon::parse($toDate . ' 23:59:59'));
        }
        $sucursals = $sucursals->get();
        return response()->json([
            'data' => $sucursals->count(),
        ], Response::HTTP_OK);
    }

    public function getAlertsAction(Request $request){
        $fromDate = $request->input('fromDate');
        $toDate = $request->input('toDate');

        $alerts = SensorMeasurement::query();
        if($fromDate){
            $alerts->where('created_at', '>=', Carbon::parse($fromDate . ' 00:00:00'));
        }
        if($toDate){
            $alerts->where('created_at', '<=', Carbon::parse($toDate . ' 23:59:59'));
        }
        $alerts = $alerts->where('alert', '!=', 'normal')->get();
        return response()->json([
            'data' => $alerts->count(),
        ], Response::HTTP_OK);
    }

    public function getByAlertAction(Request $request){
        $today = Carbon::today()->format('Y-m-d');
        $alert = $request->input('alert');

        $request->validate([
            'alert' => 'required|string|in:normal,amarilla,naranja,roja',
        ]);

        $alerts = SensorMeasurement::query();

        if($alert){
            $alerts->where('alert', $alert);
        }
        
        $alerts = $alerts->where('created_at', '>=', Carbon::parse($today . ' 00:00:00'))
        ->where('created_at', '<=', Carbon::parse($today . ' 23:59:59'))
        ->count();
        return response()->json([
            'data' => $alerts,
        ], Response::HTTP_OK);
    }
}
