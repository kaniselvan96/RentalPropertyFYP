<?php

namespace App\Http\Controllers;

use App\Models\House;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function myhouse()
    {
        $myhouse = DB::table('tenants')
        ->select('tenants.*', 'users.*', 'houses.*', 'tenants.status as request_status')
        ->join('users', 'users.id', '=', 'tenants.renter_id')
        ->join('houses', 'houses.house_id', '=', 'tenants.house_id')
        ->where('tenants.renter_id', Auth::user()->id)
        ->get();

        return response()->json($myhouse, 201);
    }


    public function getreminder()
    {
        $myreminder = DB::table('reminder')
        ->join('invoices', 'invoices.invoice_id', '=', 'reminder.invoice_id')
        ->join('houses', 'houses.house_id', '=', 'invoices.house_id')
        ->where('reminder.renter_id', Auth::user()->id)
        ->get();


        return response()->json($myreminder, 201);
    }

    function list() {
        $houseList = DB::table('houses')->get();
        return view('house.list', compact('houseList'));
    }

    public function view($id)
    {
        $houseView = DB::table('houses')->where('house_id', $id)->first();
        $savedfacilities = $houseView->facilities;
        // dd($savedfacilities);
        return view('house.view', compact('houseView', 'savedfacilities'));
    }
    public function edit($id)
    {
        $houseView = DB::table('houses')->where('house_id', $id)->first();
        $savedfacilities = $houseView->facilities;
        // dd($savedfacilities);
        return view('house.edit', compact('houseView', 'savedfacilities'));
    }

    public function create()
    {
        return view('house.create');
    }

    public function store(Request $request)
    {
        // dd($request->houseData->title);
        // print_r(json_decode($request->reso_data));
        // $test = json_decode($request->reso_data);
        // dd($test[0]->reso_no);
        // dd($request->all());
        // $request->validate([
        //     'counter_id' => 'required',
        //     'title' => 'required',
        //     'total_no' => 'required',
        //     'reso_data.*.reso_no' => 'required|string',
        //     'reso_data.*.reso_description' => 'required|string',
        // ]);

        $house = House::create([
            'title' => $request['title'],
            'property_type' => $request['property_type'],
            'property_name' => $request['property_name'],
            'floor' => $request['floor'],
            'bedroom' => $request['bedroom'],
            'bathroom' => $request['bathroom'],
            'parking' => $request['parking'],
            'furnishing' => $request['furnishing'],
            'rental' => $request['rental'],
            'deposit' => $request['deposit'],
            'address_line1' => $request['address_line1'],
            'address_line2' => $request['address_line2'],
            'postcode' => $request['postcode'],
            'city' => $request['city'],
            'state' => $request['state'],
            'facilities' => json_encode($request['checkedfacilities']),
            'description' => $request['description'],
            'landlord_id' => Auth::user()->id,
            'status' => "Available",
        ]);
        return response()->json($house, 201);
    }
    
    public function update(Request $request, $id)
    {
        
        $house = House::find($id);
        
        $house->title = $request['title'];
        $house->property_type = $request['property_type'];
        $house->property_name = $request['property_name'];
        $house->floor = $request['floor'];
        $house->bedroom = $request['bedroom'];
        $house->bathroom = $request['bathroom'];
        $house->parking = $request['parking'];
        $house->furnishing = $request['furnishing'];
        $house->rental = $request['rental'];
        $house->deposit = $request['deposit'];
        $house->address_line1 = $request['address_line1'];
        $house->address_line2 = $request['address_line2'];
        $house->postcode = $request['postcode'];
        $house->city = $request['city'];
        $house->state = $request['state'];
        $house->facilities = json_encode($request['checkedfacilities']);
        $house->description = $request['description'];
        $house->landlord_id = Auth::user()->id;

        $house->save();

        return response()->json($house, 201);
    }
}
