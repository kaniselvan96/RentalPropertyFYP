
@extends('layouts.app')
@section('title', Auth::user()->user_type)
@section('content')
<service-list :servicelist="{{json_encode($servicelist)}}"></service-list>
@endsection
