@extends('backend.layouts.app')

@section("title","Edit - Subject")
@section("subject_list")
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
                        Edit Subject
                        <a href="{{ url("/subject/list") }}" class="btn btn-primary float-right btn-sm">Back</a>
                    </h6>
                    <form action="{{ route("update.subject",$subject->id) }}" method="POST">
                        @csrf

                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Subject Name</label>
                                <input type="text" class="form-control" value="{{ old("subject_name",$subject->subject_name) }}" name="subject_name" placeholder="Enter subject Name">
                                @error('subject_name')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="name">Subject Code</label>
                                <input type="text" class="form-control" value="{{ old("subject_code",$subject->subject_code) }}" name="subject_code" placeholder="Enter subject Code">
                                @error('subject_code')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="userType">Subject Type</label>
                                <select name="subject_type" class="form-control" id="userType">
                                    <option value="">-- select status --</option>
                                    <option value="0" {{ old("subject_type",$subject->subject_type) == "0" ?"selected":"" }}>Theory</option>
                                    <option value="1" {{ old("subject_type",$subject->subject_type) == "1" ?"selected":"" }}>Practical</option>
                                     
                                </select>
                                @error('status')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="userType">Class</label>
                                <select name="class_id" class="form-control" id="userType">
                                    <option value="">-- select Class --</option>
                                    @foreach ($classes as $class)
                                    <option value="{{ $class->id }}" {{ old("subject_type",$subject->class_id) == "
                                    $class->id" ?"selected":"" }}>{{ $class->name }}</option>
                                    @endforeach
                                    
                                </select>

                                @error('status')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="userType">Status</label>
                                <select name="status" class="form-control" id="userType">
                                    <option value="">-- select status --</option>
                                    <option value="1" {{ old("status",$subject->status) == "1" ?"selected":"" }}>Active</option>
                                    <option value="2" {{ old("status",$subject->status) == "2s" ?"selected":"" }}>Inactive</option>
                                     
                                </select>
                                @error('status')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="card-footer bg-dark">
                            <button type="submit" class="btn btn-primary rounded">Update Class</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection