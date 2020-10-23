
@extends('layouts.app')
@section('title', Auth::user()->user_type)
@section('content')
<service-landlord-list :servicelandlordlist="{{json_encode($servicelandlordlist)}}" :counting="{{json_encode($counting)}}"></service-landlord-list>
@endsection
