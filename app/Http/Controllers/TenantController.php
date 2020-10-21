<?php

namespace App\Http\Controllers;

use App\Models\House;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\TenancyRequest;
use App\Models\Tenant;

class TenantController extends Controller
{
    public function addtenant($id)
    {
        $addtenant = DB::table('tenancy_request')
        ->select('tenancy_request.*', 'users.*', 'houses.*', 'tenancy_request.status as request_status')
        ->join('users', 'users.id', '=', 'tenancy_request.renter_id')
        ->join('houses', 'houses.house_id', '=', 'tenancy_request.house_id')
        ->where('tenancy_request.landlord_id', Auth::user()->id)
        ->where('tenancy_request.house_id', $id)
        ->get();
        // dd($addtenant);
        $addtenant = $addtenant[0];
        return view('tenant.addtenant', compact('addtenant'));
    }
    public function viewtenant($id)
    {
        $viewtenant = DB::table('tenants')
        ->select('tenants.*', 'users.*', 'houses.*', 'tenants.status as request_status')
        ->join('users', 'users.id', '=', 'tenants.renter_id')
        ->join('houses', 'houses.house_id', '=', 'tenants.house_id')
        ->where('tenants.landlord_id', Auth::user()->id)
        ->where('tenants.house_id', $id)
        ->get();
        // dd($viewtenant);
        $viewtenant = $viewtenant[0];
        return view('tenant.viewtenant', compact('viewtenant'));
    }
    
    public function storeaddtenant(Request $request)
    {

        // dd($request);
        $tenant = Tenant::create([
            // 'name' => $request['name'],
            // 'email' => $request['email'],
            // 'phone_number' => $request['phone_number'],
            // 'ic_number' => $request['ic_number'],
            // 'home_address' => $request['home_address'],
            'professional' => $request['professional'],
            // 'rental_unit' => $request['rental_unit'],
            'rental' => $request['rental'],
            'deposit' => $request['deposit'],
            'due_on' => $request['due_on'],
            'lease_start_date' => $request['lease_start_date'],
            'lease_expiration_date' => $request['lease_expiration_date'],
            'status' => "Active",

            'house_id' => $request['house_id'],
            'renter_id' => $request['renter_id'],
            'landlord_id' => Auth::user()->id,
        ]);

        $request = TenancyRequest::find($request['request_id']);
        $request->tenant_status = "Added";
        $request->save();


        $house = House::find($request['house_id']);
        $house->status = "Tenant";
        $house->save();

        return response()->json($tenant, 201);
    }
    
}
