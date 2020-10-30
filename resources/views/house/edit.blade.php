
@extends('layouts.app')

@section('content')

<house-edit :houseView="{{json_encode($houseView)}}" :savedfacilities="{{$savedfacilities}}":saveimages="{{$saveimages}}" ></house-edit>

  @endsection