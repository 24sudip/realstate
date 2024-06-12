<!-- If you do not have a consistent goal in life, you can not live it in a consistent way. - Marcus Aurelius -->
@extends('frontend.FrontendDashboard')

@section('main')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<!--Page Title-->
<section class="page-title centred" style="background-image: url({{ asset('frontend_assets/images') }}/background/page-title-5.jpg);">
    <div class="auto-container">
        <div class="content-box clearfix">
            <h1>Schedule Request</h1>
            <ul class="bread-crumb clearfix">
                <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li>Schedule Request</li>
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
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">SL</th>
                                            <th scope="col">Property Name</th>
                                            <th scope="col">Date</th>
                                            <th scope="col">Time</th>
                                            <th scope="col">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($s_request as $key => $item)
                                        <tr>
                                            <th scope="row">{{ $key+1 }}</th>
                                            <td>{{ $item['rel_to_property']['property_name'] }}</td>
                                            <td>{{ $item->tour_date }}</td>
                                            <td>{{ $item->tour_time }}</td>
                                            <td>
                                                @if ($item->status == 1)
                                                <span class="badge rounded-pill bg-success">Confirmed</span>
                                                @else
                                                <span class="badge rounded-pill bg-danger">Pending</span>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
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
