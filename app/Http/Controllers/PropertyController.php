<?php

namespace App\Http\Controllers;

use App\Models\TenancyRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PropertyController extends Controller
{
    function list() {
        $houseList = DB::table('houses')
            // ->where('status', 'Available')
            ->get();

            
        $myhousephoto = DB::table('houses')
        ->leftjoin('photos', 'photos.house_id', '=', 'houses.house_id')
        // ->where('houses.status', 'Available')
        ->get();

        $myhousephoto = json_decode(json_encode($myhousephoto), true);


        $seenItems = array();

        foreach($myhousephoto as $index => $item){
            if(in_array($item["house_id"], $seenItems))
                unset($myhousephoto[$index]);
            else
                $seenItems[] = $item["house_id"];
        }


        foreach($houseList as $houseindex => $house){
            foreach($myhousephoto as $index => $photo){
                $houseList[$houseindex]->photolink = "default.png";
            }
        }
        foreach($houseList as $houseindex => $house){
            foreach($myhousephoto as $index => $photo){
                if($photo["house_id"] == $house->house_id){
                    $houseList[$houseindex]->photolink = $photo["photolink"];
                }
                 
            }
        }

    $myhousephoto = array_values($myhousephoto);
    $myhousemain['houseList'] = $houseList;
    $myhousemain['myhousephoto'] = $myhousephoto;
        return view('property.list', compact('myhousemain'));
    }

    public function requestpropertylist()
    {
        $requestpropertylist = DB::table('tenancy_request')
            ->select('tenancy_request.*', 'users.*', 'houses.*', 'tenancy_request.status as request_status')
            ->join('users', 'users.id', '=', 'tenancy_request.renter_id')
            ->join('houses', 'houses.house_id', '=', 'tenancy_request.house_id')
            ->where('tenancy_request.landlord_id', Auth::user()->id)
            ->orderBy('tenancy_request.request_id', 'DESC')
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
            'tenant_status' => 'no',
        ]);
        return response()->json($request, 201);
    }
    public function requestpropertystatus(Request $request)
    {
        $status = $request->request_status;
        $request = TenancyRequest::find($request->request_id);
        $request->status = $status;
        $request->save();

        //update count
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
        $request['pending'] = $pending;
        $request['viewing'] = $viewing;
        $request['accepted'] = $accepted;
        $request['rejected'] = $rejected;
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
        $request['pending'] = $pending;
        $request['viewing'] = $viewing;
        $request['accepted'] = $accepted;
        $request['rejected'] = $rejected;
        return response()->json($request, 201);
    }
}
