<!-- People find pleasure in different ways. I find it in keeping my mind clear. - Marcus Aurelius -->
@extends('admin.AdminDashboard')

@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<div class="page-content">
    <div class="row profile-body">
        <!-- middle wrapper start -->
        <div class="col-md-8 col-xl-8 middle-wrapper">
            <div class="row">
                <div class="col-md-12 grid-margin">
                    <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Edit Roles</h6>
                        <form method="POST" action="{{ route('update.roles') }}" class="forms-sample" id="myForm">
                            @csrf
                            <input type="hidden" name="id" value="{{ $roles->id }}">
                            <div class="form-group mb-3">
                                <label class="form-label">Roles Name</label>
                                <input type="text" name="name" class="form-control" value="{{ $roles->name }}">
                            </div>
                            <button type="submit" class="btn btn-primary me-2">Save Changes</button>
                        </form>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- middle wrapper end -->
    </div>
</div>
@endsection
