@extends('backend.layouts.app')

@section("title","Assign - Student")
@section("parent_list")
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
            <div class="card mb-3">
                <h6 class="card-header bg-primary text-white d-flex justify-content-between">
                    <span>Assigned Student List (Total Assigned Students :  {{ $total_assigned_student }})</span> 
                    <a href="{{ url("/parent/list") }}" class="btn btn-success float-right btn-sm">Back</a>
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
                            @forelse ($assign_students as $student)
                            <tr class="text-center">
                                <td>{{ $student->id }}</td>
                                <td>{{ $student->student["first_name"] }} {{ $student->student["first_name"] }}</td>
                                <td>
                                    @if($student->student["registration_no"])
                                    {{ $student->student["registration_no"] }}
                                    @else
                                      <span class="badge badge-danger">NA</span>
                                    @endif
                                </td>
                                <td>
                                    @if($student->student["roll"])
                                    {{ $student->student["roll"] }}
                                    @else
                                      <span class="badge badge-danger">NA</span>
                                    @endif
                                </td>
                                <td>
                                    @if($student->student["class"]["name"])
                                    {{ $student->student["class"]["name"] }}
                                    @else
                                      <span class="badge badge-danger">NA</span>
                                    @endif
                                </td>
                                <td>
                                 
                                    @if($student->student["status"] == 1)
                                      <span class="badge badge-success">Active</span>
                                    @else
                                      <span class="badge badge-danger">Inactive</span>
                                    @endif
                                 
                                </td>
                                <td>
                                    
                                    <form action="{{ route("assign.student.delete",$student->id) }}" method="POST">
                                        @csrf
                                        @method("DELETE")
                                        <button type="submit" class="btn rounded btn-danger btn-sm">Delete Assigned Student</button>
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
          <div class="card">
            <div class="card-header">
              Search Student
            </div>
            <div class="card-body">
                <form action="{{ url("/assign/student",$parent_id) }}" class="row" method="GET">
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
                      <a href="{{ url("/assign/student",$parent_id) }}" class="btn btn-success">Reset</a>
                    </div>
                  </form>
            </div>
          </div>
        </div>
        <div class="col-lg-12">
          
            <div class="card">
                <h6 class="card-header bg-primary text-white d-flex justify-content-between">
                    <span>Student List (Total Students :  {{ $total_student }})</span> 
                    <a href="{{ url("/add/student") }}" class="btn btn-success float-right btn-sm">Add New Student</a>
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
                                    <form action="{{ route("assign.student.store") }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="student_id" value="{{ $student->id }}" >
                                        <input type="hidden" name="parent_id" value="{{ $parent_id }}">
                                        <button type="submit" class="btn rounded btn-primary btn-sm">Assign To Parent</button>
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