@extends('layouts.app')

@section('content')

<add-tenant :addtenant="{{json_encode($addtenant)}}"></add-tenant>

  @endsection