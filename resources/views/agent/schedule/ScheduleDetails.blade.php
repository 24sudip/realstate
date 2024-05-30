<!-- The biggest battle is the war against ignorance. - Mustafa Kemal Atatürk -->
@extends('agent.AgentDashboard')

@section('agent')
<div class="page-content">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <h6 class="card-title pt-4">Schedule Request Details</h6>
                <form action="{{ route('agent.update.schedule') }}" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{ $schedule->id }}">
                    <input type="hidden" name="email" value="{{ $schedule->rel_to_user->email }}">
                    <div class="table-responsive pt-3">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td>User Name</td>
                                    <td>{{ $schedule->rel_to_user->name }}</td>
                                </tr>
                                <tr>
                                    <td>Property Name</td>
                                    <td>{{ $schedule->rel_to_property->property_name }}</td>
                                </tr>
                                <tr>
                                    <td>Tour Date</td>
                                    <td>{{ $schedule->tour_date }}</td>
                                </tr>
                                <tr>
                                    <td>Tour Time</td>
                                    <td>{{ $schedule->tour_time }}</td>
                                </tr>
                                <tr>
                                    <td>Message</td>
                                    <td>{{ $schedule->message }}</td>
                                </tr>
                                <tr>
                                    <td>Request Send Time</td>
                                    <td>{{ $schedule->created_at->format('l M d Y') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-success mb-4">Request Confirm</button>
                </form>
            </div>
        </div>
    </div>
@endsection
