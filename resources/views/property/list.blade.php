
@extends('layouts.app')
@section('title', Auth::user()->user_type)
@section('content')
<property-list :myhousemain="{{json_encode($myhousemain)}}"></property-list>
@endsection
