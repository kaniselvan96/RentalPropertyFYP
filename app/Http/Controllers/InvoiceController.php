<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\House;
use App\Models\Charge;
use App\Models\Tenant;
use App\Models\Invoice;
use App\Models\Reminder;
use Illuminate\Http\Request;
use App\Models\TenancyRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

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
            ->select('invoices.*', 'users.*', 'houses.*', 'invoices.status AS invoice_status')
            ->join('users', 'users.id', '=', 'invoices.renter_id')
            ->join('houses', 'houses.house_id', '=', 'invoices.house_id')
            ->where('invoices.landlord_id', Auth::user()->id)
            ->get();

        $nowdate = date('Y-m-d');
        $paid = 0;
        $pending = 0;
        $overdue = 0;
        foreach ($invoicesList as $index => $invoice) {
            if ($invoice->pay_status == "paid") {
                $invoice->payment_status = 'paid';
                $paid =  $paid + 1;
            } else {
                if ($invoice->pay_date > $nowdate) {
                    $invoice->payment_status = 'waiting';
                    $pending =  $pending + 1;
                } else {
                    $invoice->payment_status = 'overdue';
                    $overdue =  $overdue + 1;
                }
            }
        }

        $allsum = [];
        $allsum['paid'] = $paid;
        $allsum['pending'] = $pending;
        $allsum['overdue'] = $overdue;
        
        // dd($allsum);

        // dd($houseList);
        return view('invoice.invoicelist', compact('houseList', 'invoicesList','allsum'));
    }


    public function invoicecreate($id)
    {
        $tenantinfo = DB::table('tenants')
            ->select('tenants.*', 'users.*', 'houses.*', 'tenants.rental AS tenant_rent')
            ->join('users', 'users.id', '=', 'tenants.renter_id')
            ->join('houses', 'houses.house_id', '=', 'tenants.house_id')
            ->where('tenants.landlord_id', Auth::user()->id)
            ->where('houses.house_id', $id)
            ->get();
        if (!empty($tenantinfo)) {
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
        return view('invoice.invoicecreate', compact('tenantinfo', 'chargeList', "billedChargeList"));
    }

    public function invoiceedit($id,$serviceid)
    {
        $tenantinfo = DB::table('tenants')
            ->select('tenants.*', 'users.*', 'houses.*', 'tenants.rental AS tenant_rent','invoices.month AS invoice_month','invoices.pay_date AS invoice_pay_date','invoice_id AS invoice_main_id')
            ->join('users', 'users.id', '=', 'tenants.renter_id')
            ->join('houses', 'houses.house_id', '=', 'tenants.house_id')
            ->join('invoices', 'houses.house_id', '=', 'tenants.house_id')
            ->where('invoices.invoice_id', $serviceid)
            ->where('tenants.landlord_id', Auth::user()->id)
            ->where('houses.house_id', $id)
            ->get();
        if (!empty($tenantinfo)) {
            $tenantinfo = $tenantinfo[0];
        }
        $chargeList = DB::table('charges')
            ->where('house_id', $id)
            ->where('status', "unbilled")
            ->get();

        $billedChargeList = DB::table('charges')
            ->where('house_id', $id)
            ->where('invoice_id', $serviceid)
            ->where('status', "Billed")
            ->get();
        // dd($billedChargeList);
        return view('invoice.invoiceedit', compact('tenantinfo', 'chargeList', "billedChargeList"));
    }

    public function invoiceview($id)
    {
        $invoiceview = DB::table('invoices')
            ->select('tenants.*', 'invoices.*', 'users.*', 'houses.*', 'invoices.status AS invoice_status')
            ->join('users', 'users.id', '=', 'invoices.renter_id')
            ->join('houses', 'houses.house_id', '=', 'invoices.house_id')
            ->join('tenants', 'houses.house_id', '=', 'tenants.house_id')
            ->where('invoices.invoice_id', $id)
            ->get();

        if (!empty($invoiceview)) {
            $invoiceview = $invoiceview[0];
        }

        $chargelist = DB::table('charges')
            ->where('invoice_id', $id)
            ->where('status', "Billed")
            ->get();

        // dd($invoiceview);
        // $billedChargeList = DB::table('charges')
        //     ->where('house_id', $id)
        //     ->where('status', "Billed")
        //     ->get();
        // dd($billedChargeList);
        return view('invoice.invoiceview', compact('invoiceview', 'chargelist'));
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

    public function invoicetenantlist()
    {
        $invoicesList = DB::table('invoices')
            ->select('invoices.*', 'users.*', 'houses.*', 'invoices.status AS invoice_status')
            ->join('users', 'users.id', '=', 'invoices.renter_id')
            ->join('houses', 'houses.house_id', '=', 'invoices.house_id')
            ->where('invoices.renter_id', Auth::user()->id)
            ->orderBy('invoices.invoice_id', 'desc')
            ->get();
        $nowdate = date('Y-m-d');
        foreach ($invoicesList as $index => $invoice) {
            if ($invoice->pay_status == "paid") {
                $invoice->payment_status = 'paid';
            } else {
                if ($invoice->pay_date > $nowdate) {
                    $invoice->payment_status = 'waiting';
                } else {
                    $invoice->payment_status = 'overdue';
                }
            }
        }

        // dd($houseList);
        return view('invoice.invoicetenantlist', compact('invoicesList'));
    }

    public function payinvoice(Request $request)
    {
        // dd($request->invoice_id);
        $invoice = Invoice::find($request->invoice_id);

        $invoice->pay_status = "paid";
        $invoice->paid_date = date('Y-m-d');

        $invoice->save();
        return response()->json($invoice, 201);
    }
    public function reminder(Request $request)
    {
        // dd($request->invoice_id);
        $int = (int) $request->reminder;

        $invoice = Invoice::find($request->invoice_id);
        $invoice->reminder = 1 + $int;
        $invoice->save();


        $reminder = Reminder::create([
            'invoice_id' => $invoice->invoice_id,
            'house_id' => $request['house_id'],
            'renter_id' => $request['renter_id'],
            'landlord_id' => Auth::user()->id,
        ]);

        return response()->json($invoice, 201);
    }
    public function editinvoice(Request $request)
    {
        // dd($request->invoice_id);
      
        $invoice = Invoice::find($request->invoice_id);
        $invoice->total = $request->total;
        $invoice->save();

        $chargelist = $request->confirmchargelist;
// dd($chargelist);
        foreach ($chargelist as $index => $charge) {
            $editcharge = Charge::find($charge["charges_id"]);
            $editcharge->description_charge = $charge["description_charge"];
            $editcharge->charge_date = $charge["charge_date"];
            $editcharge->amount = $charge["amount"];
            $editcharge->save();
        }
        
        return response()->json($invoice, 201);
    }
}
