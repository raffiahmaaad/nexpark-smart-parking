<?php

namespace App\Http\Controllers;

use App\Models\VehicleIn;
use App\Models\VehicleOut;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $from_date = date('Y-m-d', strtotime($request->from_date));
        $to_date = date('Y-m-d', strtotime($request->to_date));
        $reports_in = $request->report_in;
        $reports_out = $request->report_out;
        $reports = [];


        if ($request->has('report_in')) {
            if ($request->search_in != null && Str::length($request->search_in) > 2) {
                $reports = VehicleIn::where('parking_number', 'like', "%" . $request->search_in . "%")->get();
            } elseif ($from_date != null && $to_date != null) {
                $reports = VehicleIn::whereBetween(DB::raw('date(created_at)'), [$from_date, $to_date])->get();
            }
        } elseif ($request->has('report_out')) {
            if ($request->search_out != null) {
                $reports = VehicleOut::with(['vehicleIn.vehicle', 'vehicleIn.slot', 'user'])
                    ->where('vehicleIn_id', 'like', "%" . $request->search_out . "%")
                    ->whereNotNull('created_at')
                    ->get()
                    ->filter(function ($item) {
                        return isset($item->vehicleIn) && $item->vehicleIn && isset($item->vehicleIn->vehicle) && $item->vehicleIn->vehicle && $item->vehicleIn->status == 2;
                    });
            } elseif ($from_date != null && $to_date != null) {
                $reports = VehicleOut::with(['vehicleIn.vehicle', 'vehicleIn.slot', 'user'])
                    ->whereBetween(DB::raw('date(created_at)'), [$from_date, $to_date])
                    ->whereNotNull('created_at')
                    ->get()
                    ->filter(function ($item) {
                        return isset($item->vehicleIn) && $item->vehicleIn && isset($item->vehicleIn->vehicle) && $item->vehicleIn->vehicle && $item->vehicleIn->status == 2;
                    });
            }
        }

        return view('backend.reports.index', compact('reports', 'reports_in', 'reports_out'));
    }
}
