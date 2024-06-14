<!-- It is quality rather than quantity that matters. - Lucius Annaeus Seneca -->
@extends('admin.AdminDashboard')

@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<div class="page-content">
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <a href="{{ route('export') }}" class="btn btn-inverse-danger">Download Xlsx</a>
        </ol>
    </nav>
    <div class="row profile-body">
        <!-- middle wrapper start -->
        <div class="col-md-8 col-xl-8 middle-wrapper">
            <div class="row">
                <div class="col-md-12 grid-margin">
                    <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Import Permission</h6>
                        <form method="POST" action="{{ route('import') }}" class="forms-sample" id="myForm" enctype="multipart/form-data">
                        @csrf
                            <div class="form-group mb-3">
                                <label class="form-label">Xlsx File Import</label>
                                <input type="file" name="import_file" class="form-control" placeholder="Permission Name">
                            </div>

                            <button type="submit" class="btn btn-inverse-warning me-2">Upload</button>
                        </form>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- middle wrapper end -->
    </div>
</div>
@endsection
