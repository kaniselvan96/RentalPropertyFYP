
@extends('layouts.app')

@section('content')

<house-view :houseView="{{json_encode($houseView)}}" :savedfacilities="{{$savedfacilities}}" :housephotolink="{{json_encode($housephotolink)}}"></house-view>

  @endsection