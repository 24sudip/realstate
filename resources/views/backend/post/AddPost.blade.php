<!-- Simplicity is the ultimate sophistication. - Leonardo da Vinci -->
@extends('admin.AdminDashboard')

@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<div class="page-content">
    <div class="row profile-body">
        <!-- middle wrapper start -->
        <div class="col-md-12 col-xl-12 middle-wrapper">
            <div class="row">
                <div class="col-md-12 grid-margin">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-title">Add Post</h6>
                            <form method="POST" action="{{ route('store.post') }}" class="forms-sample" enctype="multipart/form-data">
                            @csrf
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Post Title</label>
                                            <input type="text" name="post_title" class="form-control" placeholder="Post Title">
                                        </div>
                                    </div><!-- Col -->
                                    <div class="col-sm-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Blog Category</label>
                                            <select name="blog_cat_id" class="form-select" id="exampleFormControlSelect1">
                                                <option selected disabled>Select Category</option>
                                                @foreach ($blog_cat as $cat)
                                                <option value="{{ $cat->id }}">{{ $cat->category_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div><!-- Col -->
                                </div>
                                <div class="col-sm-12">
                                    <div class="mb-3">
                                        <label class="form-label">Short Description</label>
                                        <textarea name="short_descp" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-12">
                                    <div class="mb-3">
                                        <label class="form-label">Long Description</label>
                                        <textarea name="long_descp" class="form-control" name="tinymce" id="tinymceExample" rows="10"></textarea>
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Post Tags</label>
                                            <input name="post_tags" id="tags" value="Realestate," />
                                        </div>
                                    </div><!-- Col -->
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Post Photo</label>
                                    <input type="file" class="form-control" id="image_id" name="post_image">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label"></label>
                                    <img class="wd-80 rounded-circle" src="{{ url('upload/no_image.jpg') }}" alt="profile" id="showImage">
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
