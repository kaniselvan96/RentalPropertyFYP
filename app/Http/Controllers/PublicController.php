<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\House;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PublicController extends Controller
{
    public function allhouse()
    {
        $myhouse = DB::table('houses')
        ->where('status', 'Available')
        ->get();

        return response()->json($myhouse, 201);
    }

    public function publicviewhouse($id)
    {
        $houseView = DB::table('houses')->where('house_id', $id)->first();
        $savedfacilities = $houseView->facilities;
        // dd($savedfacilities);
        return view('house.view', compact('houseView', 'savedfacilities'));
    }
}
