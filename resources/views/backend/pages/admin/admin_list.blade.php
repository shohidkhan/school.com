@extends('backend.layouts.app')
@section("title","admin | List")
@section("admin_list")
active
@endsection
@section('content')


<div class="container">
    <div class="row">
        <div class="col-lg-12 mb-3">
          <div class="card">
            <div class="card-header">
              Search User
            </div>
            <div class="card-body">
              <form action="{{ url("/admin/list") }}" class="row" method="GET">
                <div class="col-lg-4 form-group">
                  <input type="text" name="name" value="{{ Request::get("name") }}" class="form-control" placeholder="Enter Name">
                </div>
                <div class="col-lg-4 form-group">
                  <input type="text" name="email" value="{{ Request::get("email") }}" class="form-control" placeholder="Enter Email">
                </div>
                <div class="col-lg-4 form-group">
                  <button class="btn btn-info">Search</button>
                  <a href="{{ url("/admin/list") }}" class="btn btn-success">Reset</a>
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="col-lg-12">
          @if(session("success"))
                
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ session("success") }}</strong> 
                  </div>
          @endif
            <div class="card">
                <h6 class="card-header bg-primary text-white">
                    Admin List (Total Users:{{ $total_users }})
                    <a href="{{ url("/admin/add") }}" class="btn btn-success float-right btn-sm">Add New User</a>
                </h6>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table  table-striped table-hover table-bordered">
                          <thead>
                            <th>SL.</th>
                            <th>Name</th>
                            <th>email</th>
                            <th>Role</th>
                            <th>Action</th>
                          </thead>
                          <tbody>
                            @forelse ($user_lists as $user)
                              
                            
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if($user->user_type == 1)
                                        Admin
                                    @elseif($user->user_type == 2)
                                        Teacher
                                    @elseif($user->user_type == 3)
                                        Student 
                                    @elseif($user->user_type == 4)    
                                        Parent
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ url("/user/edit", $user->id) }}" class="btn btn-info btn-sm rounded">Edit</a>
                                    <form action="{{ route("user.delete",$user->id) }}" class="d-inline" method="POST">
                                      @csrf
                                      @method("DELETE")
                                      <button type="submit" class="btn d-inline rounded btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center">No User Found</td>
                            </tr>
                            @endforelse
                          </tbody>
                        </table>
                        <div class="float-right p-3 ">
                          {{ $user_lists->links() }}
                        </div>
                      </div>
                      
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

