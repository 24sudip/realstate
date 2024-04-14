<!-- Simplicity is the essence of happiness. - Cedric Bledsoe -->
@extends('frontend.FrontendDashboard')

@section('main')
    <!--Page Title-->
    <section class="page-title-two bg-color-1 centred">
        <div class="pattern-layer">
            <div class="pattern-1" style="background-image: url({{ asset('frontend_assets') }}/images/shape/shape-9.png);"></div>
            <div class="pattern-2" style="background-image: url({{ asset('frontend_assets') }}/images/shape/shape-10.png);">
            </div>
        </div>
        <div class="auto-container">
            <div class="content-box clearfix">
                <h1>Wishlist Property</h1>
                <ul class="bread-crumb clearfix">
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li>Wishlist Property</li>
                </ul>
            </div>
        </div>
    </section>
    <!--End Page Title-->

    <!-- property-page-section -->
    <section class="property-page-section property-list">
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
                    <div class="property-content-side">
                        <div class="wrapper list">
                            <div class="deals-list-content list-item">
                                <div id="wishlist"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- property-page-section end -->
    @include('frontend.home.subscribe')
@endsection
