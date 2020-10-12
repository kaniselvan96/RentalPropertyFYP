
@extends('layouts.app')

@section('content')

<house-view :houseView="{{json_encode($houseView)}}"></house-view>

  @endsection