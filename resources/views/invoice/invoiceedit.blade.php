
@extends('layouts.app')
@section('title', "Invoice -" . Auth::user()->user_type)
@section('content')

<invoice-edit :tenantinfo="{{json_encode($tenantinfo)}}" :chargelist="{{json_encode($chargeList)}}" :billedchargelist="{{json_encode($billedChargeList)}}"></invoice-edit>
{{-- <invoice-list ></invoice-list> --}}
@endsection
