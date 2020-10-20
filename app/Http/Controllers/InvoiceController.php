<?php

namespace App\Http\Controllers;

use App\Models\House;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\TenancyRequest;
use App\Models\Tenant;
use App\Models\Invoice;
use App\Models\Charge;


class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function invoicelist()
    {
        $houseList = DB::table('houses')
            ->select('house_id', 'title')
            ->where('landlord_id', Auth::user()->id)
            ->get();

            
        $invoicesList = DB::table('invoices')
            ->select('invoices.*', 'users.*', 'houses.*','invoices.status AS invoice_status')
            ->join('users', 'users.id', '=', 'invoices.renter_id')
            ->join('houses', 'houses.house_id', '=', 'invoices.house_id')
            ->where('invoices.landlord_id', Auth::user()->id)
            ->get();

            // dd($invoicesList);

        // dd($houseList);
        return view('invoice.invoicelist', compact('houseList','invoicesList'));
    }
    public function invoicecreate($id)
    {
        $tenantinfo = DB::table('tenants')
            ->select('tenants.*', 'users.*', 'houses.*','tenants.rental AS tenant_rent')
            ->join('users', 'users.id', '=', 'tenants.renter_id')
            ->join('houses', 'houses.house_id', '=', 'tenants.house_id')
            ->where('tenants.landlord_id', Auth::user()->id)
            ->where('houses.house_id', $id)
            ->get();
            if(!empty($tenantinfo)) {
                $tenantinfo = $tenantinfo[0];
            }
       
        $chargeList = DB::table('charges')
            ->where('house_id', $id)
            ->where('status', "unbilled")
            ->get();

        $billedChargeList = DB::table('charges')
            ->where('house_id', $id)
            ->where('status', "Billed")
            ->get();
        // dd($billedChargeList);
        return view('invoice.invoicecreate', compact('tenantinfo', 'chargeList',"billedChargeList"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function storeinvoice(Request $request)
    {

        $invoice = Invoice::create([
            'renter_id' => $request['renter_id'],
            'house_id' => $request['house_id'],
            'landlord_id' => Auth::user()->id,
            'total' => $request['total'],
            'month' => $request['month'],
            'pay_date' => $request['pay_date'],
            'status' => "Billed",
        ]);

        foreach ($request->confirmchargelist as $index => $chargelist) {

            if ($chargelist['charges_id']) {
                $chargeAddId = Charge::find($chargelist['charges_id']);
                $chargeAddId->invoice_id = $invoice->invoice_id;
                $chargeAddId->status = "Billed";
                $chargeAddId->save();
            } else {
                $addCharge = Charge::create([
                    'invoice_id' => $invoice->invoice_id,
                    'house_id' => $request['house_id'],
                    'amount' => $chargelist['amount'],
                    'charge_date' => $chargelist['charge_date'],
                    'status' => "Billed",
                    'description_charge' => $chargelist['description_charge'],
                ]);
            }
        }

        return response()->json($invoice, 201);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show(invoice $invoice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function edit(invoice $invoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, invoice $invoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(invoice $invoice)
    {
        //
    }
}
