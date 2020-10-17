
@extends('layouts.app')
@section('title', Auth::user()->user_type)
@section('content')
<request-property-list :requestpropertylist="{{json_encode($requestpropertylist)}}"></request-property-list>
@endsection
