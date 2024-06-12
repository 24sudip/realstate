<!-- Smile, breathe, and go slowly. - Thich Nhat Hanh -->
@extends('frontend.FrontendDashboard')

@section('main')
    @section('title')
    {{ $blog->post_title }} Easy Realestate
    @endsection
<!--Page Title-->
    <section class="page-title-two bg-color-1 centred">
        <div class="pattern-layer">
            <div class="pattern-1" style="background-image: url({{ asset('frontend_assets') }}/images/shape/shape-9.png);"></div>
            <div class="pattern-2" style="background-image: url({{ asset('frontend_assets') }}/images/shape/shape-10.png);"></div>
        </div>
        <div class="auto-container">
            <div class="content-box clearfix">
                <h1>{{ $blog->post_title }}</h1>
                <ul class="bread-crumb clearfix">
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li>{{ $blog->post_title }}</li>
                </ul>
            </div>
        </div>
    </section>
<!--End Page Title-->

<!-- sidebar-page-container -->
<section class="sidebar-page-container blog-details sec-pad-2">
    <div class="auto-container">
        <div class="row clearfix">
            <div class="col-lg-8 col-md-12 col-sm-12 content-side">
                <div class="blog-details-content">
                    <div class="news-block-one">
                        <div class="inner-box">
                            <div class="image-box">
                                <figure class="image"><img src="{{ asset('upload/post_images') }}/{{ $blog->post_image }}" alt="post_image"></figure>
                                <span class="category">Featured</span>
                            </div>
                            <div class="lower-content">
                                <h3>{{ $blog->post_title }}</h3>
                                <ul class="post-info clearfix">
                                    <li class="author-box">
                                        <figure class="author-thumb"><img src="{{ (!empty($blog->rel_to_user->photo)) ? url('upload/admin_photos/'.$blog->rel_to_user->photo) : url('upload/no_image.jpg') }}" alt="user"></figure>
                                        <h5><a href="blog-details.html">{{ $blog['rel_to_user']['name'] }}</a></h5>
                                    </li>
                                    <li>{{ $blog->created_at->format('M d Y') }}</li>
                                </ul>
                                <div class="text">
                                    <p>{!! $blog->long_descp !!}</p>
                                </div>
                                <div class="post-tags">
                                    <ul class="tags-list clearfix">
                                        <li><h5>Tags:</h5></li>
                                        @foreach ($tags_all as $tag)
                                        <li><a href="#">{{ ucwords($tag) }}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    @php
                        $comment = App\Models\Comment::where('post_id',$blog->id)->where('parent_id',null)->limit(5)->get();
                    @endphp
                    <div class="comments-area">
                        <div class="group-title">
                            <h4>3 Comments</h4>
                        </div>
                        <div class="comment-box">
                            @foreach ($comment as $com)
                            <div class="comment">
                                <figure class="thumb-box">
                                    <img src="{{ (!empty($com->rel_to_user->photo)) ? url('upload/user_photos/'.$com->rel_to_user->photo) : url('upload/no_image.jpg') }}" alt="user">
                                </figure>
                                <div class="comment-inner">
                                    <div class="comment-info clearfix">
                                        <h5>{{ $com->rel_to_user->name }}</h5>
                                        <span>{{ $com->created_at->format('M d Y') }}</span>
                                    </div>
                                    <div class="text">
                                        <p>{{ $com->subject }}</p>
                                        <p>{{ $com->message }}</p>
                                        <a href="blog-details.html"><i class="fas fa-share"></i>Reply</a>
                                    </div>
                                </div>
                            </div>
                            @php
                                $reply = App\Models\Comment::where('parent_id',$com->id)->get();
                            @endphp

                                @foreach ($reply as $rep)
                                <div class="comment replay-comment">
                                    <figure class="thumb-box">
                                        <img src="{{ url('upload/admin_photos/20240220114622img-1.jpg') }}">
                                    </figure>
                                    <div class="comment-inner">
                                        <div class="comment-info clearfix">
                                            <h5>{{ $rep->subject }}</h5>
                                            <span>{{ $rep->created_at->format('M d Y') }}</span>
                                        </div>
                                        <div class="text">
                                            <p>{{ $rep->message }}</p>
                                            <a href="blog-details.html"><i class="fas fa-share"></i>Reply</a>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            @endforeach
                        </div>
                    </div>
                    <div class="comments-form-area">
                        <div class="group-title">
                            <h4>Leave a Comment</h4>
                        </div>
                        @auth
                        <form action="{{ route('store.comment') }}" method="post" class="comment-form default-form">
                            @csrf
                            <input type="hidden" name="post_id" value="{{ $blog->id }}">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                    <input type="text" name="subject" placeholder="Subject" required="">
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                    <textarea name="message" placeholder="Your message"></textarea>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 form-group message-btn">
                                    <button type="submit" class="theme-btn btn-one">Submit Now</button>
                                </div>
                            </div>
                        </form>
                        @else
                        <p><b>For Adding Comment You Need To Login First <a href="{{ route('login') }}">Login Here</a></b></p>
                        @endauth
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12 col-sm-12 sidebar-side">
                <div class="blog-sidebar">
                    <div class="sidebar-widget search-widget">
                        <div class="widget-title">
                            <h4>Search</h4>
                        </div>
                        <div class="search-inner">
                            <form action="blog-1.html" method="post">
                                <div class="form-group">
                                    <input type="search" name="search_field" placeholder="Search" required="">
                                    <button type="submit"><i class="fas fa-search"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="sidebar-widget social-widget">
                        <div class="widget-title">
                            <h4>Follow Us On</h4>
                        </div>
                        <ul class="social-links clearfix">
                            <li><a href="blog-1.html"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href="blog-1.html"><i class="fab fa-google-plus-g"></i></a></li>
                            <li><a href="blog-1.html"><i class="fab fa-twitter"></i></a></li>
                            <li><a href="blog-1.html"><i class="fab fa-linkedin-in"></i></a></li>
                            <li><a href="blog-1.html"><i class="fab fa-instagram"></i></a></li>
                        </ul>
                    </div>
                    <div class="sidebar-widget category-widget">
                        <div class="widget-title">
                            <h4>Category</h4>
                        </div>
                        <div class="widget-content">
                            <ul class="category-list clearfix">
                                @foreach ($b_category as $cat)
                                    @php
                                        $post = App\Models\BlogPost::where('blog_cat_id',$cat->id)->get();
                                    @endphp
                                <li><a href="{{ url('/blog/cat/list/'.$cat->id) }}">{{ $cat->category_name }}<span>({{ count($post) }})</span></a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="sidebar-widget post-widget">
                        <div class="widget-title">
                            <h4>Recent Posts</h4>
                        </div>
                        <div class="post-inner">
                            @foreach ($d_post as $recent)
                            <div class="post">
                                <figure class="post-thumb"><a href="blog-details.html"><img src="{{ asset('upload/post_images') }}/{{ $recent->post_image }}" alt="recent"></a></figure>
                                <h5><a href="blog-details.html">{{ $recent->post_title }}</a></h5>
                                <span class="post-date">{{ $recent->created_at->format('M d Y') }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- sidebar-page-container -->
@endsection
