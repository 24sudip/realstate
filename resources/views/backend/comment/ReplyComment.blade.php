<!-- It is quality rather than quantity that matters. - Lucius Annaeus Seneca -->
@extends('admin.AdminDashboard')

@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<div class="page-content">
    <div class="row profile-body">
        <!-- middle wrapper start -->
        <div class="col-md-8 col-xl-8 middle-wrapper">
            <div class="row">
                <div class="col-md-12 grid-margin">
                    <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Reply Comment</h6>
                        <form method="POST" action="{{ route('reply.message') }}" class="forms-sample">
                        @csrf
                        <input type="hidden" name="id" value="{{ $comment->id }}">
                        <input type="hidden" name="user_id" value="{{ $comment->user_id }}">
                        <input type="hidden" name="post_id" value="{{ $comment->post_id }}">
                            <div class="mb-3">
                                <label class="form-label">User Name : </label>
                                <code>{{ $comment['rel_to_user']['name'] }}</code>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Post Title : </label>
                                <code>{{ $comment['rel_to_post']['post_title'] }}</code>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Subject : </label>
                                <code>{{ $comment->subject }}</code>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Message : </label>
                                <code>{{ $comment->message }}</code>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Subject</label>
                                <input type="text" name="subject" class="form-control" placeholder="Subject">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Message</label>
                                <input type="text" name="message" class="form-control" placeholder="Message">
                            </div>
                            <button type="submit" class="btn btn-primary me-2">Reply Comment</button>
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
