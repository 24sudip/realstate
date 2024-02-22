@extends('frontend.FrontendDashboard')

@section('main')
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
            @php
                $id = Auth::user()->id;
                $user_data = App\Models\User::find($id);
            @endphp
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
                            <h4>Category</h4>
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
                                <h3>Including Animation In Your Design System.</h3>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="card-body" style="background-color: #1baf65;">
                                            <h1 class="card-title" style="color: white; font-weight: bold;">0</h1>
                                            <h5 class="card-text"style="color: white;"> Approved properties</h5>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card-body" style="background-color: #ffc107;">
                                            <h1 class="card-title" style="color: white; font-weight: bold; ">0</h1>
                                            <h5 class="card-text"style="color: white;"> Pending approve properties</h5>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card-body" style="background-color: #002758;">
                                            <h1 class="card-title" style="color: white; font-weight: bold;">0</h1>
                                            <h5 class="card-text"style="color: white; "> Rejected properties</h5>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="blog-details-content">
                    <div class="news-block-one">
                        <div class="inner-box">
                            <div class="lower-content">
                                <h3>Activity Logs</h3>
                                <hr>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- sidebar-page-container -->

<!-- subscribe-section -->
@include('frontend.home.subscribe')
<!-- subscribe-section end -->
@endsection
