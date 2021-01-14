
@extends('layouts.app')
@section('title', Auth::user()->user_type)
@section('content')
<service-page ></service-page>
@endsection
