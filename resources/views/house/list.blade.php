
@extends('layouts.app')
@section('title', Auth::user()->user_type)
@section('content')
<house-list :houseList="{{json_encode($houseList)}}"></house-list>
@endsection
