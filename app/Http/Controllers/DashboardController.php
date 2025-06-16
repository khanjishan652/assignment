<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use DataTables;

class DashboardController extends Controller
{
    public function index(){
        return view('admin.dashboard');
    }

    public function bookedServices(Request $request){
        if ($request->ajax()) {
            $data = Booking::where(['customer_id'=>auth()->id()]);
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('provider_id',function($row){
                    return $row->provider?->name??'N/A';
                })
                ->editColumn('service_id',function($row){
                    return $row->service?->name??'N/A';
                })
                ->editColumn('time_slot_id',function($row){
                    return !is_null($row->slot) ? $row->slot?->start_time.' - '.$row->slot?->end_time:'N/A';
                })
                ->addColumn('action', function ($row) {
                    return '<a href="#" class="btn btn-sm btn-primary">Edit</a>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.services-booking.index');
    }
}
