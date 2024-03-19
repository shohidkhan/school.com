@extends('backend.layouts.app')

@section("title","Teacher | List")
@section("teacher_list")
active
@endsection
@section('content')
<div class="">
    <div class="row">
        <div class="col-lg-12 mb-3">
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
            <div class="card-header">
              Search Teacher
            </div>
            <div class="card-body">
              <form action="{{ url("/teacher/list") }}" class="row" method="GET">
                <div class="col-lg-3 form-group">
                  <input type="text" name="name" value="{{ Request::get("name") }}" class="form-control" placeholder="Enter Name">
                </div>
                <div class="col-lg-3 form-group">
                  <input type="text" name="email" value="{{ Request::get("email") }}" class="form-control" placeholder="Enter Email">
                </div>
                <div class="col-lg-3 form-group">
                  <input type="text" name="phone" value="{{ Request::get("phone") }}" class="form-control" placeholder="Enter Phone Number">
                </div>
                <div class="col-lg-3 form-group">
                  <input type="text" name="nid_no" value="{{ Request::get("nid_no") }}" class="form-control" placeholder="Enter Nid No">
                </div>
                        
                <div class="col-lg-3 form-group">
                  <select name="status" class="form-control" id="userType">
                    <option value="">-- select status --</option>
                    <option value="2" {{ old("status",Request::get("status")) == "2" ?"selected":"" }}>Inactive</option>
                    <option value="1" {{ old("status",Request::get("status")) == "1" ?"selected":"" }}>Active</option>           
                  </select>
                  @error('status')
                      <p class="text-danger">{{ $message }}</p>
                  @enderror
                </div>               
                
                <div class="col-lg-3 form-group">
                  <button class="btn btn-info">Search</button>
                  <a href="{{ url("/teacher/list") }}" class="btn btn-success">Reset</a>
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="col-lg-12">
          
            <div class="card">
                <h6 class="card-header bg-primary text-white d-flex justify-content-between">
                    <span>Teacher List (Total Teachers :  {{ $total_teacher }})</span> 

                    
                    {{-- <span class="ms-5">
                      @if ($teacher_lists_count === null)
                      Total Search Result : 0
                      @else 
                      Total Search Result : {{ $teacher_lists_count }}
                      @endif
                      </span> --}}
                      
                    <a href="{{ url("/add/teacher") }}" class="btn btn-success float-right btn-sm">Add New Teacher</a>
                </h6>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table  table-striped table-hover table-bordered">
                          <thead >
                            <tr >
                                <th class="text-center">SL.</th>
                                <th class="text-center">Teacher Name</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Phone</th>
                                <th class="text-center">Nid No</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            @forelse ($teacher_lists as $teacher)
                            <tr class="text-center">
                                <td>{{ $teacher->id }}</td>
                                <td>{{ $teacher->name }} </td>
                                <td>
                                    @if($teacher->email)
                                    {{ $teacher->email }}
                                    @else
                                      <span class="badge badge-danger">NA</span>
                                    @endif
                                </td>
                                <td>
                                    @if($teacher->phone)
                                    {{ $teacher->phone }}
                                    @else
                                      <span class="badge badge-danger">NA</span>
                                    @endif
                                </td>
                                <td>
                                    @if($teacher->nid_no)
                                    {{ $teacher->nid_no }}
                                    @else
                                      <span class="badge badge-danger">NA</span>
                                    @endif
                                </td>
                                <td>
                                  <a href="{{ url("/teacher/status/change",$teacher->id) }}">
                                    @if($teacher->status == 1)
                                      <span class="badge badge-success">Active</span>
                                    @else
                                      <span class="badge badge-danger">Inactive</span>
                                    @endif
                                  </a>
                                </td>
                                <td>
                                    <a href="{{ url("/teacher/details", $teacher->id) }}" class="btn btn-primary btn-sm rounded">View</a>
                                    <a href="{{ url("/teacher/edit", $teacher->id) }}" class="btn btn-info btn-sm rounded">Edit</a>
                                    <form action="{{ route("teacher.delete",$teacher->id) }}" class="d-inline" method="POST">
                                      @csrf
                                      @method("DELETE")
                                      <button type="submit" class="btn d-inline rounded btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center">No User Found</td>
                            </tr>
                            @endforelse
                          </tbody>
                        </table>
                        <div class="float-right p-3 ">
                          {{ $teacher_lists->links() }}
                        </div>
                      </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection