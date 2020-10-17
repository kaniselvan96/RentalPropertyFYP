<?php

namespace App\Http\Controllers;

use App\Models\TenancyRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PropertyController extends Controller
{
    function list() {
        $houseList = DB::table('houses')->get();
        return view('property.list', compact('houseList'));
    }

    public function requestproperty(Request $request)
    {
        // dd($request);
        $house = TenancyRequest::create([
            
            'renter_id' => Auth::user()->id,
            'landlord_id' => $request['landlord_id'],
            'house_id' => $request['house_id'],
            'professional' => $request['professional'],
            'move_date' => $request['move_date'],
            'duration' => $request['duration'],
        ]);
        return response()->json($house, 201);
    }
}
