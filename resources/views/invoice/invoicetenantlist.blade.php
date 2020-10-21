
@extends('layouts.app')
@section('title', "Invoice -" . Auth::user()->user_type)
@section('content')
<invoice-tenant-list :invoiceslist="{{json_encode($invoicesList)}} "></invoice-tenant-list>
@endsection
