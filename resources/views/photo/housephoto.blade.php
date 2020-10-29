
@extends('layouts.app')

@section('content')

<house-photo :houseView="{{json_encode($houseView)}}" :saveimages="{{$saveimages}}"></house-photo>

  @endsection