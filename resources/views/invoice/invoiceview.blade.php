
@extends('layouts.app')
@section('title', "Invoice -" . Auth::user()->user_type)
@section('content')
<invoice-view :invoiceview="{{json_encode($invoiceview)}}" :chargelist="{{json_encode($chargelist)}}"></invoice-view>
{{-- <invoice-list ></invoice-list> --}}
@endsection
