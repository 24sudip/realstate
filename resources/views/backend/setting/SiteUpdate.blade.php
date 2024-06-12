<!-- Order your soul. Reduce your wants. - Augustine -->
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
                        <h6 class="card-title">Update Site Setting</h6>
                        <form method="POST" action="{{ route('update.site.setting') }}" class="forms-sample" id="myForm" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{ $site_setting->id }}">
                            <div class="form-group mb-3">
                                <label class="form-label">support_phone</label>
                                <input type="text" name="support_phone" class="form-control" value="{{ $site_setting->support_phone }}">
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">company_address</label>
                                <input type="text" name="company_address" class="form-control" value="{{ $site_setting->company_address }}">
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">email</label>
                                <input type="email" name="email" class="form-control" value="{{ $site_setting->email }}">
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">facebook</label>
                                <input type="text" name="facebook" class="form-control" value="{{ $site_setting->facebook }}">
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">twitter</label>
                                <input type="text" name="twitter" class="form-control" value="{{ $site_setting->twitter }}">
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">copyright</label>
                                <input type="text" name="copyright" class="form-control" value="{{ $site_setting->copyright }}">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Logo</label>
                                <input type="file" class="form-control" id="image_id" name="logo">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label"></label>
                                <img class="wd-80 rounded-circle" src="{{ asset('upload/logo') }}/{{ $site_setting->logo }}" alt="profile" id="showImage">
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
