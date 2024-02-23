@extends('frontend.FrontendDashboard')

@section('main')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<!--Page Title-->
<section class="page-title centred" style="background-image: url({{ asset('frontend_assets/images') }}/background/page-title-5.jpg);">
    <div class="auto-container">
        <div class="content-box clearfix">
            <h1>User Profile </h1>
            <ul class="bread-crumb clearfix">
                <li><a href="index.html">Home</a></li>
                <li>User Profile </li>
            </ul>
        </div>
    </div>
</section>
<!--End Page Title-->


<!-- sidebar-page-container -->
<section class="sidebar-page-container blog-details sec-pad-2">
    <div class="auto-container">
        <div class="row clearfix">
            <div class="col-lg-4 col-md-12 col-sm-12 sidebar-side">
                <div class="blog-sidebar">
                    <div class="sidebar-widget post-widget">
                        <div class="widget-title">
                            <h4>User Profile </h4>
                        </div>
                        <div class="post-inner">
                            <div class="post">
                                <figure class="post-thumb"><a href="blog-details.html">
                                <img src="{{ (!empty($user_data->photo)) ? url('upload/user_photos/'.$user_data->photo) : url('upload/no_image.jpg') }}" alt=""></a></figure>
                                <h5><a href="blog-details.html">{{ $user_data->name }}</a></h5>
                                <p>{{ $user_data->email }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="sidebar-widget category-widget">
                        <div class="widget-title">
                            <h4>Menu</h4>
                        </div>
                        @include('frontend.userDashboard.DashboardSidebar')
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-12 col-sm-12 content-side">
                <div class="blog-details-content">
                    <div class="news-block-one">
                        <div class="inner-box">
                            <div class="lower-content">
                                <form action="{{ route('user.profile.store') }}" method="post" class="default-form" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label>Username</label>
                                        <input type="text" name="user_name" value="{{ $user_data->user_name }}" required="">
                                    </div>
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" name="name" value="{{ $user_data->name }}" required="">
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" name="email" value="{{ $user_data->email }}" required="">
                                    </div>
                                    <div class="form-group">
                                        <label>Phone</label>
                                        <input type="text" name="phone" value="{{ $user_data->phone }}" required="">
                                    </div>
                                    <div class="form-group">
                                        <label>Address</label>
                                        <input type="text" name="address" value="{{ $user_data->address }}" required="">
                                    </div>
                                    <div class="form-group">
                                        <label for="formFile" class="form-label">Default file input example</label>
                                        <input class="form-control" type="file" name="photo" id="image_id">
                                    </div>
                                    <div class="form-group">
                                        <label for="formFile" class="form-label"></label>
                                        <img src="{{ (!empty($user_data->photo)) ? url('upload/user_photos/'.$user_data->photo) : url('upload/no_image.jpg') }}" id="showImage" style="width: 100px;height: 100px;">
                                    </div>

                                    <div class="form-group message-btn">
                                        <button type="submit" class="theme-btn btn-one">Save Changes </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- sidebar-page-container -->

@include('frontend.home.subscribe')

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
