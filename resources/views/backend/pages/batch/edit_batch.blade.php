@extends('backend.layouts.app')

@section("title","Edit - Batch")
@section("batch_list")
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
                        Edit Batch
                        <a href="{{ url("/batch/list") }}" class="btn btn-primary float-right btn-sm">Back</a>
                    </h6>
                    <form action="{{ route("update.batch",$batch->id) }}" method="POST">
                        @csrf

                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" value="{{ old("name",$batch->name) }}" name="name" placeholder="Enter batch Name">
                                @error('name')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="userType">Status</label>
                                <select name="status" class="form-control" id="userType">
                                    <option value="">-- select status --</option>
                                    <option value="1" {{ old("status",$batch->status) == "1" ?"selected":"" }}>Active</option>
                                    <option value="2" {{ old("status",$batch->status) == "2" ?"selected":"" }}>Inactive</option>
                                     
                                </select>
                                @error('status')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="card-footer bg-dark">
                            <button type="submit" class="btn btn-primary rounded">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection