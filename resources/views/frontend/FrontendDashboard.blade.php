{{--  --}}
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

<title>@yield('title')</title>
@vite(['resources/js/app.js'])

<!-- Fav Icon -->
<link rel="icon" href="{{ asset('frontend_assets/images') }}/favicon.ico" type="image/x-icon">
<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

<!-- Stylesheets -->
<link href="{{ asset('frontend_assets/css') }}/font-awesome-all.css" rel="stylesheet">
<link href="{{ asset('frontend_assets/css') }}/flaticon.css" rel="stylesheet">
<link href="{{ asset('frontend_assets/css') }}/owl.css" rel="stylesheet">
<link href="{{ asset('frontend_assets/css') }}/bootstrap.css" rel="stylesheet">
<link href="{{ asset('frontend_assets/css') }}/jquery.fancybox.min.css" rel="stylesheet">
<link href="{{ asset('frontend_assets/css') }}/animate.css" rel="stylesheet">
<link href="{{ asset('frontend_assets/css') }}/jquery-ui.css" rel="stylesheet">
<link href="{{ asset('frontend_assets/css') }}/nice-select.css" rel="stylesheet">
<link href="{{ asset('frontend_assets/css') }}/color/theme-color.css" id="jssDefault" rel="stylesheet">
<link href="{{ asset('frontend_assets/css') }}/switcher-style.css" rel="stylesheet">
<link href="{{ asset('frontend_assets/css') }}/style.css" rel="stylesheet">
<link href="{{ asset('frontend_assets/css') }}/responsive.css" rel="stylesheet">

<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" >

</head>

<!-- page wrapper -->
<body>

    <div class="boxed_wrapper">

        @include('frontend.home.preloader')

        @include('frontend.home.header')

        @include('frontend.home.mobileMenu')

        @yield('main')

        @include('frontend.home.footer')

        <!--Scroll to top-->
        <button class="scroll-top scroll-to-target" data-target="html">
            <span class="fal fa-angle-up"></span>
        </button>
    </div>

    <!-- jequery plugins -->
    <script src="{{ asset('frontend_assets/js') }}/jquery.js"></script>
    <script src="{{ asset('frontend_assets/js') }}/popper.min.js"></script>
    <script src="{{ asset('frontend_assets/js') }}/bootstrap.min.js"></script>
    <script src="{{ asset('frontend_assets/js') }}/owl.js"></script>
    <script src="{{ asset('frontend_assets/js') }}/wow.js"></script>
    <script src="{{ asset('frontend_assets/js') }}/validation.js"></script>
    <script src="{{ asset('frontend_assets/js') }}/jquery.fancybox.js"></script>
    <script src="{{ asset('frontend_assets/js') }}/appear.js"></script>
    <script src="{{ asset('frontend_assets/js') }}/scrollbar.js"></script>
    <script src="{{ asset('frontend_assets/js') }}/isotope.js"></script>
    <script src="{{ asset('frontend_assets/js') }}/jquery.nice-select.min.js"></script>
    <script src="{{ asset('frontend_assets/js') }}/jQuery.style.switcher.min.js"></script>
    <script src="{{ asset('frontend_assets/js') }}/jquery-ui.js"></script>
    <script src="{{ asset('frontend_assets/js') }}/nav-tool.js"></script>

    <!-- map script -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA-CE0deH3Jhj6GN4YvdCFZS7DpbXexzGU"></script>
    <script src="{{ asset('frontend_assets/js') }}/gmaps.js"></script>
    <script src="{{ asset('frontend_assets/js') }}/map-helper.js"></script>

    <!-- main-js -->
    <script src="{{ asset('frontend_assets/js') }}/script.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    
<script>
 @if(Session::has('message'))
 var type = "{{ Session::get('alert-type','info') }}"
 switch(type){
    case 'info':
    toastr.info(" {{ Session::get('message') }} ");
    break;

    case 'success':
    toastr.success(" {{ Session::get('message') }} ");
    break;

    case 'warning':
    toastr.warning(" {{ Session::get('message') }} ");
    break;

    case 'error':
    toastr.error(" {{ Session::get('message') }} ");
    break;
 }
 @endif
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script type="text/javascript">
$.ajaxSetup({
    headers:{
        'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content'),
    },
});
// Add to Wishlist
function addToWishlist(property_id) {
    $.ajax({
        type: "POST",
        dataType: "json",
        url: "/add-to-wishList/" + property_id,
        success: function (data) {
            wishlist();
            // Start Message

            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",

                showConfirmButton: false,
                timer: 3000,
            });
            if ($.isEmptyObject(data.error)) {
                Toast.fire({
                    type: "success",
                    icon: "success",
                    title: data.success,
                });
            } else {
                Toast.fire({
                    type: "error",
                    icon: "error",
                    title: data.error,
                });
            }

            // End Message
        }
    });
}
</script>

{{-- load wishlist data --}}
<script type="text/javascript">
    function wishlist() {
        $.ajax({
            type: "GET",
            dataType: 'json',
            url: "/get-wishlist-property/",
            success: function (response) {
                $('#wishQty').text(response.wishQty);
                var rows = "";
                $.each(response.wishlist, function (key, value) {
                    rows += `
                    <div class="deals-block-one">
                        <div class="inner-box">
                            <div class="image-box">
                                <figure class="image"><img src="{{ asset('upload/property/thumbnail') }}/${value.relation_to_property.property_thumbnail}" alt="property_thumbnail"></figure>
                                <div class="batch"><i class="icon-11"></i></div>
                                <span class="category">Featured</span>
                                <div class="buy-btn"><a href="#">
                                    For ${value.relation_to_property.property_status}</a></div>
                            </div>
                            <div class="lower-content">
                                <div class="title-text"><h4><a href="#">${value.relation_to_property.property_name}</a></h4></div>
                                <div class="price-box clearfix">
                                    <div class="price-info pull-left">
                                        <h6>Start From</h6>
                                        <h4>$${value.relation_to_property.lowest_price}</h4>
                                    </div>
                                </div>
                                <ul class="more-details clearfix">
                                    <li><i class="icon-14"></i>${value.relation_to_property.bedrooms} Beds</li>
                                    <li><i class="icon-15"></i>${value.relation_to_property.bathrooms} Baths</li>
                                    <li><i class="icon-16"></i>${value.relation_to_property.property_size} Sq Ft</li>
                                </ul>
                                <div class="other-info-box clearfix">
                                    <ul class="other-option pull-right clearfix">
                                        <li><a type="submit" class="text-body" id="${value.id}" onclick="wishlistRemove(this.id)"><i class="fa fa-trash"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    `;
                });
                $('#wishlist').html(rows);
            },
        });
    }
    wishlist();
    // wishlist Remove Start
    function wishlistRemove(id) {
        $.ajax({
            type: "GET",
            dataType: 'json',
            url: "/wishlist-remove/"+id,
            success: function (data) {
                wishlist();
                // Start Message
                const Toast = Swal.mixin({
                    toast: true,
                    position: "top-end",

                    showConfirmButton: false,
                    timer: 3000,
                });
                if ($.isEmptyObject(data.error)) {
                    Toast.fire({
                        type: "success",
                        icon: "success",
                        title: data.success,
                    });
                } else {
                    Toast.fire({
                        type: "error",
                        icon: "error",
                        title: data.error,
                    });
                }
                // End Message
            }
        });
    }
</script>
{{-- Add to Compare --}}
<script type="text/javascript">
    function addToCompare(property_id) {
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "/add-to-compare/" + property_id,
            success: function (data) {
                // Start Message

                const Toast = Swal.mixin({
                    toast: true,
                    position: "top-end",

                    showConfirmButton: false,
                    timer: 3000,
                });
                if ($.isEmptyObject(data.error)) {
                    Toast.fire({
                        type: "success",
                        icon: "success",
                        title: data.success,
                    });
                } else {
                    Toast.fire({
                        type: "error",
                        icon: "error",
                        title: data.error,
                    });
                }

                // End Message
            }
        });
}
</script>

{{-- load Compare data --}}
<script type="text/javascript">
    function compare() {
        $.ajax({
            type: "GET",
            dataType: 'json',
            url: "/get-compare-property/",
            success: function (response) {
                var rows = "";
                $.each(response, function (key, value) {
                    rows += `
                        <tr>
                            <th>Property Info</th>
                            <th>
                                <figure class="image-box"><img src="{{ asset('upload/property/thumbnail') }}/${value.relation_to_property.property_thumbnail}" alt="thumbnail"></figure>
                                <div class="title">${value.relation_to_property.property_name}</div>
                                <div class="price">$${value.relation_to_property.lowest_price}</div>
                            </th>
                        </tr>
                        <tr>
                            <td>
                                <p>City</p>
                            </td>
                            <td>
                                <p>${value.relation_to_property.city}</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>Area</p>
                            </td>
                            <td>
                                <p>${value.relation_to_property.property_size} Sq Ft</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>Rooms</p>
                            </td>
                            <td>
                                <p>${value.relation_to_property.bedrooms}</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>Bathrooms</p>
                            </td>
                            <td>
                                <p>${value.relation_to_property.bathrooms}</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>Action</p>
                            </td>
                            <td>
                                <a type="submit" class="text-body" id="${value.id}" onclick="compareRemove(this.id)"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    `;
                });
                $('#compare').html(rows);
            },
        });
    }
    compare();
    // compare Remove Start
    function compareRemove(id) {
        $.ajax({
            type: "GET",
            dataType: 'json',
            url: "/compare-remove/"+id,
            success: function (data) {
                compare();
                // Start Message
                const Toast = Swal.mixin({
                    toast: true,
                    position: "top-end",

                    showConfirmButton: false,
                    timer: 3000,
                });
                if ($.isEmptyObject(data.error)) {
                    Toast.fire({
                        type: "success",
                        icon: "success",
                        title: data.success,
                    });
                } else {
                    Toast.fire({
                        type: "error",
                        icon: "error",
                        title: data.error,
                    });
                }
                // End Message
            }
        });
    }
</script>

</body><!-- End of .page_wrapper -->
</html>
