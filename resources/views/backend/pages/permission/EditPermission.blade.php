<!-- Do what you can, with what you have, where you are. - Theodore Roosevelt -->
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
                        <h6 class="card-title">Add Permission</h6>
                        <form method="POST" action="{{ route('update.permission') }}" class="forms-sample" id="myForm">
                            @csrf
                            <input type="hidden" name="id" value="{{ $permission->id }}">
                            <div class="form-group mb-3">
                                <label class="form-label">Permission Name</label>
                                <input type="text" name="name" class="form-control" value="{{ $permission->name }}">
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">Group Name</label>
                                <select name="group_name" class="form-select" id="exampleFormControlSelect1">
                                    <option selected disabled>Select Group</option>
                                    <option value="type" {{ $permission->group_name == 'type' ? 'selected' : '' }}>Property Type</option>
                                    <option value="state" {{ $permission->group_name == 'state' ? 'selected' : '' }}>State</option>
                                    <option value="amenities" {{ $permission->group_name == 'amenities' ? 'selected' : '' }}>Amenities</option>
                                    <option value="property" {{ $permission->group_name == 'property' ? 'selected' : '' }}>Property</option>
                                    <option value="history" {{ $permission->group_name == 'history' ? 'selected' : '' }}>Package History</option>
                                    <option value="message" {{ $permission->group_name == 'message' ? 'selected' : '' }}>Property Message</option>
                                    <option value="testimonial" {{ $permission->group_name == 'testimonial' ? 'selected' : '' }}>Testimonial</option>
                                    <option value="agent" {{ $permission->group_name == 'agent' ? 'selected' : '' }}>Manage Agent</option>
                                    <option value="category" {{ $permission->group_name == 'category' ? 'selected' : '' }}>Blog Category</option>
                                    <option value="post" {{ $permission->group_name == 'post' ? 'selected' : '' }}>Blog Post</option>
                                    <option value="comment" {{ $permission->group_name == 'comment' ? 'selected' : '' }}>Blog Comment</option>
                                    <option value="smtp" {{ $permission->group_name == 'smtp' ? 'selected' : '' }}>SMTP Setting</option>
                                    <option value="site" {{ $permission->group_name == 'site' ? 'selected' : '' }}>Site Setting</option>
                                    <option value="role" {{ $permission->group_name == 'role' ? 'selected' : '' }}>Role & Permission</option>
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
