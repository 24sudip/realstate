<!-- Be present above all else. - Naval Ravikant -->
@extends('agent.AgentDashboard')

@section('agent')
<div class="page-content">
    <div class="row profile-body">
        <!-- middle wrapper start -->
        <div class="col-md-12 col-xl-12 middle-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h6 class="card-title">Agent Live Chat</h6>
                    <div id="app">
                        <chat-message></chat-message>
                    </div>
                  </div>
                </div>
            </div>
        </div>
        </div>
        <!-- middle wrapper end -->
    </div>
</div>
@endsection
