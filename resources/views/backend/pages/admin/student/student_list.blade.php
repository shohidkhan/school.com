@extends('backend.layouts.app')

@section("title","Student | List")
@section("student_list")
active
@endsection
@section('content')
<div class="">
    <div class="row">
        <div class="col-lg-12 mb-3">
          <div class="card">
            <div class="card-header">
              Search student
            </div>
            <div class="card-body">
              <form action="{{ url("/student/list") }}" class="row" method="GET">
                <div class="col-lg-3 form-group">
                  <input type="text" name="name" value="{{ Request::get("name") }}" class="form-control" placeholder="Enter Name">
                </div>
                <div class="col-lg-3 form-group">
                  <input type="text" name="roll" value="{{ Request::get("roll") }}" class="form-control" placeholder="Enter Roll">
                </div>
                <div class="col-lg-3 form-group">
                  <input type="text" name="registration_no" value="{{ Request::get("registration_no") }}" class="form-control" placeholder="Enter Registration No">
                </div>

                <div class="col-lg-3 form-group">
                  <select name="class_id" class="form-control" id="userType">
                    <option value="">-- select Class --</option>
                    @foreach ($classes as $class)
                    <option value="{{ $class->id }}" {{ old("class_id",Request::get("class_id")) ==  $class->id  ?"selected":"" }}>{{ $class->name }}</option>           
                    @endforeach
                  </select>
                  @error('class_id')
                      <p class="text-danger">{{ $message }}</p>
                  @enderror
                </div>               
                <div class="col-lg-3 form-group">
                  <select name="batch_id" class="form-control" id="userType">
                    <option value="">-- select Batch --</option>
                    @foreach ($batches as $batch)
                    <option value="{{ $batch->id }}" {{ old("batch_id",Request::get("batch_id")) ==  $batch->id  ?"selected":"" }}>{{ $batch->name }}</option>           
                    @endforeach
                  </select>
                  @error('batch_id')
                      <p class="text-danger">{{ $message }}</p>
                  @enderror
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
                  <a href="{{ url("/student/list") }}" class="btn btn-success">Reset</a>
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
                <h6 class="card-header bg-primary text-white d-flex justify-content-between">
                    <span>Student List (Total students :  {{ $total_student }})</span> 

                    
                    <span class="ms-5">
                      @if ($student_lists_count === null)
                      Total Search Result : 0
                      @else 
                      Total Search Result : {{ $student_lists_count }}
                      @endif
                      </span>
                      
                    <a href="{{ url("/add/student") }}" class="btn btn-success float-right btn-sm">Add New Class</a>
                </h6>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table  table-striped table-hover table-bordered">
                          <thead >
                            <tr >
                                <th class="text-center">SL.</th>
                                <th class="text-center">Student Name</th>
                                <th class="text-center">Registration</th>
                                <th class="text-center">Roll</th>
                                <th class="text-center">Class</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            @forelse ($student_lists as $student)
                            <tr class="text-center">
                                <td>{{ $student->id }}</td>
                                <td>{{ $student->first_name }} {{ $student->last_name }}</td>
                                <td>
                                    @if($student->registration_no)
                                    {{ $student->registration_no }}
                                    @else
                                      <span class="badge badge-danger">NA</span>
                                    @endif
                                </td>
                                <td>
                                    @if($student->roll)
                                    {{ $student->roll }}
                                    @else
                                      <span class="badge badge-danger">NA</span>
                                    @endif
                                </td>
                                <td>
                                    @if($student->class)
                                    {{ $student->class["name"] }}
                                    @else
                                      <span class="badge badge-danger">NA</span>
                                    @endif
                                </td>
                                <td>
                                  <a href="{{ url("/student/status/change",$student->id) }}">
                                    @if($student->status == 1)
                                      <span class="badge badge-success">Active</span>
                                    @else
                                      <span class="badge badge-danger">Inactive</span>
                                    @endif
                                  </a>
                                </td>
                                <td>
                                    <a href="{{ url("/student/view", $student->id) }}" class="btn btn-primary btn-sm rounded">View</a>
                                    <a href="{{ url("/student/edit", $student->id) }}" class="btn btn-info btn-sm rounded">Edit</a>
                                    <form action="{{ route("student.delete",$student->id) }}" class="d-inline" method="POST">
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
                          {{ $student_lists->links() }}
                        </div>
                      </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection