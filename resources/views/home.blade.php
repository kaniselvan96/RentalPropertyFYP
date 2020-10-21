@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                    @if (Auth::user()->user_type == "landlord")
                    <br><a href="{{route('listhome')}}" class="btn btn-sm btn-info mr-4">View House</a> 
                    <a href="{{route('requestpropertylist')}}" class="btn btn-sm btn-info mr-4">View Request</a>
                    <a href="{{route('invoicelist')}}" class="btn btn-sm btn-info mr-4">View Invoice</a>
                    @else
                    <br>
                    <a href="{{route('property')}}" class="btn btn-sm btn-info mr-4">View House</a> 
                    <a href="{{route('invoicetenantlist')}}" class="btn btn-sm btn-info mr-4">View Invoice</a> 
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
