<!-- Simplicity is the ultimate sophistication. - Leonardo da Vinci -->
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
                            <h6 class="card-title">Add Admin</h6>
                            <form method="POST" action="{{ route('store.admin') }}" class="forms-sample" id="myForm">
                            @csrf
                                <div class="form-group mb-3">
                                    <label class="form-label">Admin User Name</label>
                                    <input type="text" name="user_name" class="form-control" placeholder="Admin User Name">
                                </div>
                                <div class="form-group mb-3">
                                    <label class="form-label">Admin Name</label>
                                    <input type="text" name="name" class="form-control" placeholder="Admin Name">
                                </div>
                                <div class="form-group mb-3">
                                    <label class="form-label">Admin Email</label>
                                    <input type="email" name="email" class="form-control" placeholder="Admin Email">
                                </div>
                                <div class="form-group mb-3">
                                    <label class="form-label">Admin Phone</label>
                                    <input type="tel" name="phone" class="form-control" placeholder="Admin Phone">
                                </div>
                                <div class="form-group mb-3">
                                    <label class="form-label">Admin Address</label>
                                    <input type="text" name="address" class="form-control" placeholder="Admin Address">
                                </div>
                                <div class="form-group mb-3">
                                    <label class="form-label">Admin Password</label>
                                    <input type="password" name="password" class="form-control" placeholder="Admin Password">
                                </div>
                                <div class="form-group mb-3">
                                    <label class="form-label">Role Name</label>
                                    <select name="roles" class="form-select" id="exampleFormControlSelect1">
                                        <option selected disabled>Select Role</option>
                                        @foreach ($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                        @endforeach
                                    </select>
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
