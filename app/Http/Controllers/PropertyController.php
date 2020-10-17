<?php

namespace App\Http\Controllers;

use App\Models\TenancyRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PropertyController extends Controller
{
    function list()
    {
        $houseList = DB::table('houses')->get();
        return view('property.list', compact('houseList'));
    }


    function requestpropertylist()
    {
        $requestpropertylist = DB::table('tenancy_request')
            ->select('tenancy_request.*', 'users.*', 'houses.*', 'tenancy_request.status as request_status')
            ->join('users', 'users.id', '=', 'tenancy_request.renter_id')
            ->join('houses', 'houses.house_id', '=', 'tenancy_request.house_id')
            ->where('tenancy_request.landlord_id', Auth::user()->id)
            ->get();

        // dd( $requestpropertylist);
        return view('property.requestpropertylist', compact('requestpropertylist'));
    }

    public function requestproperty(Request $request)
    {
        // dd($request);
        $request = TenancyRequest::create([

            'renter_id' => Auth::user()->id,
            'landlord_id' => $request['landlord_id'],
            'house_id' => $request['house_id'],
            'professional' => $request['professional'],
            'move_date' => $request['move_date'],
            'duration' => $request['duration'],
            'status' => 'Pending',
        ]);
        return response()->json($request, 201);
    }
    public function requestpropertystatus(Request $request)
    {
        $status = $request->request_status;
        $request = TenancyRequest::find($request->request_id);
        $request->status = $status;
        $request->save();

        return response()->json($request, 201);
    }

    public function requestpropertymainstatus()
    {
        $pending = DB::table('tenancy_request')
                ->where('status', 'Pending')
                ->count();
        $viewing = DB::table('tenancy_request')
                ->where('status', 'Viewing')
                ->count();
        $accepted = DB::table('tenancy_request')
                ->where('status', 'Accepted')
                ->count();
        $rejected = DB::table('tenancy_request')
                ->where('status', 'Rejected')
                ->count();
        $request = [];
        $request['pending']=$pending;
        $request['viewing']=$viewing;
        $request['accepted']=$accepted;
        $request['rejected']=$rejected;
        return response()->json($request, 201);
    }
}
