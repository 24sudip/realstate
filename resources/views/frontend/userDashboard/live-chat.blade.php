<!-- I begin to speak only when I am certain what I will say is not better left unsaid. - Cato the Younger -->
@extends('frontend.FrontendDashboard')

@section('main')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<!--Page Title-->
<section class="page-title centred" style="background-image: url({{ asset('frontend_assets/images') }}/background/page-title-5.jpg);">
    <div class="auto-container">
        <div class="content-box clearfix">
            <h1>Live Chat</h1>
            <ul class="bread-crumb clearfix">
                <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li>Live Chat</li>
            </ul>
        </div>
    </div>
</section>
<!--End Page Title-->


<!-- sidebar-page-container -->
<section class="sidebar-page-container blog-details sec-pad-2">
    <div class="auto-container">
        <div class="row clearfix">
            <div class="col-lg-3 col-md-3 col-sm-3 sidebar-side">
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
            <div class="col-lg-9 col-md-9 col-sm-9 content-side">
                <div class="blog-details-content">
                    <div class="news-block-one">
                        <div class="inner-box">
                            <div class="lower-content">
                                <h3>Live Chat Box</h3>
                                <div id="app">
                                    <chat-message></chat-message>
                                </div>
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
@endsection
