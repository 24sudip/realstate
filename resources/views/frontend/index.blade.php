@extends('frontend.FrontendDashboard')

@section('main')

    @section('title')
    Easy Realestate
    @endsection

    @include('frontend.home.banner')

    @include('frontend.home.category')

    @include('frontend.home.feature')

    @include('frontend.home.video')

    @include('frontend.home.deals')

    @include('frontend.home.testimonial')

    @include('frontend.home.chooseus')

    <!-- place-section -->
    @include('frontend.home.place')
    <!-- place-section end -->


    <!-- team-section -->
    @include('frontend.home.team')
    <!-- team-section end -->


    <!-- cta-section -->
    @include('frontend.home.cta')
    <!-- cta-section end -->


    <!-- news-section -->
    @include('frontend.home.news')
    <!-- news-section end -->


    <!-- download-section -->
    @include('frontend.home.download')
    <!-- download-section end -->

@endsection
