@extends('backend.layouts.app')
@section("title","Subject - List")
@section("subject_list")
active
@endsection
@section('content')


<div class="container">
    <div class="row">
        <div class="col-lg-12 mb-3">
          <div class="card">
            <div class="card-header">
              Search Subject
            </div>
            <div class="card-body">
              <form action="{{ url("/subject/list") }}" class="row" method="GET">

                <div class="col-lg-3 form-group">
                  <input type="text" name="subject_name" value="{{ Request::get("subject_name") }}" class="form-control" placeholder="Subject Name">
                </div>

                <div class="col-lg-3 form-group">
                  <input type="text" name="subject_code" value="{{ Request::get("subject_code") }}" class="form-control" placeholder="Subject Code">
                </div>

                <div class="col-lg-3 form-group">
                  <select name="subject_type" class="form-control" id="userType">
                    <option value="">-- select Subject Type --</option>
                    <option value="0" {{ old("subject_type",Request::get("subject_type")) == "0" ?"selected":"" }}>Theory</option>
                    <option value="1" {{ old("subject_type",Request::get("subject_type")) == "1" ?"selected":"" }}>Practicle</option>           
                  </select>
                </div> 

                <div class="col-lg-3 form-group">
                  <select name="class_id" class="form-control" id="userType">
                    <option value="">-- select Class  --</option>
                    @foreach ($classes as $class)
                    {{-- <option value="{{ $class->id }}" {{ old("class_id",Request::get("class_id")) == "{{ $class->id }}" ? "selected":"" }}>Theory</option> --}}

                    <option value="{{ $class->id }}" {{ old("class_id",Request::get("class_id")) === $class->id ? "selected":"" }}>{{ $class->name }}</option>    
                    @endforeach      
                  </select>
                </div>      

                <div class="col-lg-3 form-group">
                  <select name="status" class="form-control" id="userType">
                    <option value="">-- select status --</option>
                    <option value="2" {{ old("status",Request::get("status")) == "2" ?"selected":"" }}>Inactive</option>
                    <option value="1" {{ old("status",Request::get("status")) == "1" ?"selected":"" }}>Active</option>           
                  </select>
                </div> 

                <div class="col-lg-3 form-group">
                  <button class="btn btn-info">Search</button>
                  <a href="{{ url("/subject/list") }}" class="btn btn-success">Reset</a>
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
                    Subject List 
                    <a href="{{ url("/add/subject") }}" class="btn btn-success float-right btn-sm">Add New Subject</a>
                </h6>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table  table-striped table-hover table-bordered">
                          <thead>
                            <th>SL.</th>
                            <th>subject Name</th>
                            <th>subject Code</th>
                            <th>subject Type</th>
                            <th>Class</th>
                            <th>Added By</th>
                            <th>Satus</th>
                          
                            <th>Action</th>
                          </thead>
                          <tbody>
                            @forelse ($subject_lists as $subject)
                            <tr>
                                <td>{{ $subject->id }}</td>
                                <td>{{ $subject->subject_name }}</td>
                                <td>{{ $subject->subject_code }}</td>
                                <td>
                                  @if ($subject->subject_type == 0)
                                    Theory
                                  @else
                                  Practicale
                                  @endif
                                </td>
                                <td>{{ $subject->class["name"] }}</td>
                                <td>{{ $subject->user["name"] }}</td>
                                <td>
                                  <a href="{{ url("/changeStatus",$subject->id) }}">
                                    @if($subject->status == 1)
                                      <span class="badge badge-success">Active</span>
                                    @else
                                      <span class="badge badge-danger">Inactive</span>
                                    @endif
                                  </a>
                                </td>
                                <td>
                                    <a href="{{ url("/subject/edit", $subject->id) }}" class="btn btn-info btn-sm rounded">Edit</a>
                                    <form action="{{ route("subject.delete",$subject->id) }}" class="d-inline" method="POST">
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
                          {{ $subject_lists->links() }}
                        </div>
                      </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

