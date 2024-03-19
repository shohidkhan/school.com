@extends('backend.layouts.app')

@section("title","Parent | List")
@section("parent_list")
active
@endsection
@section('content')
<div class="">
    <div class="row">
        <div class="col-lg-12 mb-3">
          <div class="card">
            <div class="card-header">
              Search Parents
            </div>
            <div class="card-body">
              <form action="{{ url("/parent/list") }}" class="row" method="GET">
                <div class="col-lg-3 form-group">
                  <input type="text" name="name" value="{{ Request::get("name") }}" class="form-control" placeholder="Enter Name">
                </div>
                <div class="col-lg-3 form-group">
                  <input type="text" name="email" value="{{ Request::get("email") }}" class="form-control" placeholder="Enter email">
                </div>
                <div class="col-lg-3 form-group">
                  <input type="text" name="nid_no" value="{{ Request::get("nid_no") }}" class="form-control" placeholder="Enter Nid No">
                </div>              
                <div class="col-lg-3 form-group">
                  <input type="text" name="phone" value="{{ Request::get("phone") }}" class="form-control" placeholder="Enter Phone Number">
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
                  <a href="{{ url("/parent/list") }}" class="btn btn-success">Reset</a>
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
          @if(session("error"))
                
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>{{ session("error") }}</strong> 
                  </div>
          @endif
            <div class="card">
                <h6 class="card-header bg-primary text-white d-flex justify-content-between">
                    <span>Parent List (Total Parnets :  {{ $total_parents }})</span> 

                    
                    {{-- <span class="ms-5">
                      @if ($parent_lists_count === null)
                      Total Search Result : 0
                      @else 
                      Total Search Result : {{ $parent_lists_count }}
                      @endif
                    </span> --}}
                      
                    <a href="{{ url("/add/parent") }}" class="btn btn-success float-right btn-sm">Add New Parent</a>
                </h6>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table  table-striped table-hover table-bordered">
                          <thead >
                            <tr >
                                <th class="text-center">SL.</th>
                                <th class="text-center">Name</th>
                                <th class="text-center">Nid No</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Phone</th>
                                <th class="text-center">Gender</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            @forelse ($parents as $parent)
                            <tr class="text-center">
                                <td>{{ $parent->id }}</td>
                                <td>{{ $parent->name }} </td>
                                <td>
                                    @if($parent->nid_no)
                                    {{ $parent->nid_no }}
                                    @else
                                      <span class="badge badge-danger">NA</span>
                                    @endif
                                </td>
                                <td>
                                    @if($parent->email)
                                    {{ $parent->email }}
                                    @else
                                      <span class="badge badge-danger">NA</span>
                                    @endif
                                </td>

                                <td>
                                    @if($parent->phone)
                                    {{ $parent->phone }}
                                    @else
                                      <span class="badge badge-danger">NA</span>
                                    @endif
                                </td>
                                <td>
                                    @if($parent->gender)
                                    {{ $parent->gender }}
                                    @else
                                      <span class="badge badge-danger">NA</span>
                                    @endif
                                </td>

                                <td>
                                  <a href="{{ url("/parent/status/change",$parent->id) }}">
                                    @if($parent->status == 1)
                                      <span class="badge badge-success">Active</span>
                                    @else
                                      <span class="badge badge-danger">Inactive</span>
                                    @endif
                                  </a>
                                </td>
                                <td>
                                    <a href="{{ url("/parent/details", $parent->id) }}" class="btn btn-primary btn-sm rounded">View</a>
                                    <a href="{{ url("/parent/edit", $parent->id) }}" class="btn btn-info btn-sm rounded">Edit</a>
                                    @if($parent->status == 1)
                                    <a href="{{ url("/assign/student", $parent->id) }}" class="btn btn-info btn-sm rounded">Assign Student</a>
                                    @endif
                                    <form action="{{ route("parent.delete",$parent->id) }}" class="d-inline" method="POST">
                                      @csrf
                                      @method("DELETE")
                                      <button type="submit" class="btn d-inline rounded btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center">No User Found</td>
                            </tr>
                            @endforelse
                          </tbody>
                        </table>
                        <div class="float-right p-3 ">
                          {{ $parents->links() }}
                        </div>
                      </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection