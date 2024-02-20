@extends('backend.layouts.app')
@section("title","User - Edit ")
@section("admin_list")
active
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-8 m-auto">
            @if(session("success"))
            
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ session("success") }}</strong> 
              </div>
            @endif
            <div class="card rounded">
                <h6 class="card-header bg-dark text-white rounded">
                    Create User
                    <a href="{{ url("/admin/list") }}" class="btn btn-primary float-right btn-sm">Back</a>
                </h6>
                <form action="{{ route("update.user",$user->id) }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" value="{{ old("name",$user->name) }}" name="name" placeholder="Enter Name">
                            @error('name')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" value="{{ old("email",$user->email) }}" name="email" placeholder="Enter Email">
                            @error('email')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="userType">User Type</label>
                            <select name="user_type" class="form-control" id="userType">
                                <option value="">-- select User Type --</option>
                                <option value="1" {{ old("user_type",$user->user_type) == "1" ?"selected":"" }}>Admin</option>
                                <option value="2" {{ old("user_type",$user->user_type) == "2" ?"selected":"" }}>Teacher</option>
                                <option value="3" {{ old("user_type",$user->user_type) == "3" ?"selected":"" }}>Student</option>
                                <option value="4" {{ old("user_type",$user->user_type) == "4" ?"selected":"" }}>Parent</option>
                            </select>
                            @error('user_type')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control"  name="password" placeholder="Create password">
                            @error('password')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer bg-dark">
                        <button type="submit" class="btn btn-primary rounded">Add User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection