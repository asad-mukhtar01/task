@extends('layouts.app')

@section('content')
<div class="container-fluid">
    @if(Auth::user()->user_role == "admin")
    <div class="row">
        <div class="col-md-4">
            <div class="card shadow">
                <div class="card-header">{{ __('Requesting Invitation') }}</div>
                <div class="card-body">
                    @if(Session::has('message'))
                        <div class="alert alert-primary">{{ Session::get('message') }}</div>
                    @endif
                    <p>Laravel is a closed community. You have an invitaion to register as given below.</p>
                    <form action="{{ route('storeInvitation') }}" method="post" >
                        @csrf
                        <label><b>Email Address</b></label>
                        <input type="text" name="email" class="form-control" value="" placeholder="Enter Email Address">
                        <button type="submit" class="btn btn-success my-3">Send Invitation</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            Invitations which you sent to others
                        </div>
                        <div class="card-body">
                            <table class="table table-borderd">
                                <tr>
                                    <th>Email</th>
                                    <th>Timesmap</th>
                                    <th>Status</th>
                                </tr>
                                @foreach($invitations as $invitation)
                                <tr>
                                    <td>{{ $invitation->email }}</td>
                                    <td>
                                        {{ \Carbon\Carbon::parse($invitation->created_at)->diffForHumans() }}
                                    </td>
                                    <td>
                                        @if($invitation->status == 0)
                                            <b>Pending</b>
                                        @else
                                            <b>Active</b>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
        </div>
    </div>
    @else
        Welcome to Dashboard
    @endif
</div>
@endsection
