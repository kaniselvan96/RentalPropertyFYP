
@extends('layouts.app')
@section('title', Auth::user()->user_type)
@section('content')
<property-list :houseList="{{json_encode($houseList)}}"></property-list>
@endsection
