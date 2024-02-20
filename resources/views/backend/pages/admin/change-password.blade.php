@extends('backend.layouts.app')

@section("title","Change - Password")
@section("password_change")
active
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
                @if(session("success"))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ session("success") }}</strong> 
                    </div>
                @endif
                @if(session("error"))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>{{ session("error") }}</strong> 
                  </div>
                @endif
            <div class="card">
                <div class="card-header bg-dark">
                    Change Password
                </div>
                <div class="card-body">
                    <form action="{{ url("/change-password") }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="password">Old Password</label>
                            <input type="password" class="form-control" name="old_password">
                            @error("old_password")
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password">New Password</label>
                            <input type="password" class="form-control" name="password">
                            @error("password")
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">Confirm Password</label>
                            <input type="password" class="form-control" name="password_confirmation">
                            @error("password_confirmation")
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Change Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection