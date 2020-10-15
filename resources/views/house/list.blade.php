



@extends('layouts.app')
@section('title', Auth::user()->user_type)
@section('style')
<link href="{!! asset('css/dataTables.bootstrap4.min.css') !!}" media="all" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<house-list :houseList="{{json_encode($houseList)}}"></house-list>
<!-- <div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Meeting</h1>

            <a href="meeting/create">CREATE</a>
            <table id="meetingTable" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>Meeting Name</th>
                        <th>Counter</th>
                        <th>Total Resolution</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($houseList as $data)
                        <tr>
                            <td>{{ $data->title }}</td>
                            <td>{{ $data->property_type }}</td>
                            <td>{{ $data->status }}</td>
                            <td><a href="meeting/{{ $data->property_type }}/edit">Edit</a></td>
                        </tr>
                        <tr>
                            <td>{{ $data->title }}</td>
                            <td>{{ $data->property_type }}</td>
                            <td>{{ $data->status }}</td>
                            <td><a href="meeting/{{ $data->property_type }}/edit">Edit</a></td>
                        </tr>
                        <tr>
                            <td>{{ $data->title }}</td>
                            <td>{{ $data->property_type }}</td>
                            <td>{{ $data->status }}</td>
                            <td><a href="meeting/{{ $data->property_type }}/edit">Edit</a></td>
                        </tr>
                        <tr>
                            <td>{{ $data->title }}</td>
                            <td>{{ $data->property_type }}</td>
                            <td>{{ $data->status }}</td>
                            <td><a href="meeting/{{ $data->property_type }}/edit">Edit</a></td>
                        </tr>
                        <tr>
                            <td>{{ $data->title }}</td>
                            <td>{{ $data->property_type }}</td>
                            <td>{{ $data->status }}</td>
                            <td><a href="meeting/{{ $data->property_type }}/edit">Edit</a></td>
                        </tr>
                        <tr>
                            <td>{{ $data->title }}</td>
                            <td>{{ $data->property_type }}</td>
                            <td>{{ $data->status }}</td>
                            <td><a href="meeting/{{ $data->property_type }}/edit">Edit</a></td>
                        </tr>
                        <tr>
                            <td>{{ $data->title }}</td>
                            <td>{{ $data->property_type }}</td>
                            <td>{{ $data->status }}</td>
                            <td><a href="meeting/{{ $data->property_type }}/edit">Edit</a></td>
                        </tr>
                        <tr>
                            <td>{{ $data->title }}</td>
                            <td>{{ $data->property_type }}</td>
                            <td>{{ $data->status }}</td>
                            <td><a href="meeting/{{ $data->property_type }}/edit">Edit</a></td>
                        </tr>
                        <tr>
                            <td>{{ $data->title }}</td>
                            <td>{{ $data->property_type }}</td>
                            <td>{{ $data->status }}</td>
                            <td><a href="meeting/{{ $data->property_type }}/edit">Edit</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        
        </div> 
    </div> 
</div>  -->
@endsection
@section('script')
<script type="text/javascript" src="{!! asset('js/jquery.dataTables.min.js') !!}"></script>
<script type="text/javascript" src="{!! asset('js/dataTables.bootstrap4.min.js') !!}"></script>

<script>
    
        // $('#meetingTable').DataTable();
        // $('#meetingTable2').DataTable();

</script>
@endsection
