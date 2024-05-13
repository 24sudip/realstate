<!-- Because you are alive, everything is possible. - Thich Nhat Hanh -->
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
                        <h6 class="card-title">Edit State</h6>
                        <form method="POST" action="{{ route('update.state') }}" class="forms-sample" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{ $state->id }}">
                            <div class="mb-3">
                                <label class="form-label">State Name</label>
                                <input type="text" name="state_name" class="form-control" value="{{ $state->state_name }}">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">State Photo</label>
                                <input type="file" class="form-control" id="image_id" name="state_image">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label"></label>
                                <img class="wd-80 rounded-circle" src="{{ asset('upload/state_images') }}/{{ $state->state_image }}" alt="state_image" id="showImage">
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
<script type="text/javascript">
    $(document).ready(function () {
        $("#image_id").change(function (e) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $("#showImage").attr("src", e.target.result);
            };
            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>
@endsection
