
@extends('layouts.app')
@section('title', "Invoice -" . Auth::user()->user_type)
@section('content')

<invoice-create :tenantinfo="{{json_encode($tenantinfo)}}" :chargelist="{{json_encode($chargeList)}}" :billedchargelist="{{json_encode($billedChargeList)}}"></invoice-create>
{{-- <invoice-list ></invoice-list> --}}
@endsection
