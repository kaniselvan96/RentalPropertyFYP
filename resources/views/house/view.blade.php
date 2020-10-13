
@extends('layouts.app')

@section('content')

<house-view :houseView="{{json_encode($houseView)}}" :savedfacilities="{{$savedfacilities}}"></house-view>

  @endsection