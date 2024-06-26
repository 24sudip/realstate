<!-- I begin to speak only when I am certain what I will say is not better left unsaid. - Cato the Younger -->
@extends('admin.AdminDashboard')

@section('admin')
<div class="page-content">

    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <a href="{{ route('add.post') }}" class="btn btn-inverse-info">Add Post</a>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Post All</h6>
                    <div class="table-responsive">
                    <table id="dataTableExample" class="table">
                        <thead>
                        <tr>
                            <th>SL</th>
                            <th>Post Title</th>
                            <th>Category</th>
                            <th>Post Image</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($post as $key => $item)
                            <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $item->post_title }}</td>
                            <td>{{ $item['rel_to_cat']['category_name'] }}</td>
                            <td>
                                <img src="{{ asset('upload/post_images') }}/{{ $item->post_image }}" style="width:70px;height:40px;">
                            </td>
                            <td>
                                <a href="{{ route('edit.post', $item->id) }}" class="btn btn-inverse-warning">Edit</a>
                                <a href="{{ route('delete.post', $item->id) }}" class="btn btn-inverse-danger" id="delete">Delete</a>
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
