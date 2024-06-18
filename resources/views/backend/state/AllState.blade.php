<!-- I have not failed. I've just found 10,000 ways that won't work. - Thomas Edison -->
@extends('admin.AdminDashboard')

@section('admin')
<div class="page-content">

    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <a href="{{ route('add.state') }}" class="btn btn-inverse-info">Add State</a>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">State All</h6>
                    <div class="table-responsive">
                    <table id="dataTableExample" class="table">
                        <thead>
                        <tr>
                            <th>SL </th>
                            <th>State Name </th>
                            <th>State Image</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($state as $key => $item)
                            <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $item->state_name }}</td>
                            <td>
                                <img src="{{ asset('upload/state_images') }}/{{ $item->state_image }}" style="width:70px;height:40px;">
                            </td>
                            <td>
                                @if (Auth::user()->can('edit.state'))
                                <a href="{{ route('edit.state', $item->id) }}" class="btn btn-inverse-warning">Edit</a>
                                @endif

                                @if (Auth::user()->can('delete.state'))
                                <a href="{{ route('delete.state', $item->id) }}" class="btn btn-inverse-danger" id="delete">Delete</a>
                                @endif
                            </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
