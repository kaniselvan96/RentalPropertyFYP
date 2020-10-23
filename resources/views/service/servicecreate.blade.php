
@extends('layouts.app')
@section('title', Auth::user()->user_type)
@section('content')
<service-create :servicelist="{{json_encode($servicelist)}}"></service-create>
@endsection
