@extends('layouts.app')

@section('content')

<view-tenant :viewtenant="{{json_encode($viewtenant)}}"></view-tenant>

  @endsection