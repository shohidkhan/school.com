@extends('backend.layouts.app')
@section("title","Batch | List")
@section("batch_list")
active
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 mb-3">
          <div class="card">
            <div class="card-header">
              Search Batches
            </div>
            <div class="card-body">
              <form action="{{ url("/batch/list") }}" class="row" method="GET">
                <div class="col-lg-4 form-group">
                  <input type="text" name="name" value="{{ Request::get("name") }}" class="form-control" placeholder="Enter Name">
                </div>
                <div class="col-lg-4 form-group">
                  <select name="status" class="form-control" id="userType">
                    <option value="">-- select status --</option>
                    <option value="2" {{ old("status",Request::get("status")) == "2" ?"selected":"" }}>Inactive</option>
                    <option value="1" {{ old("status",Request::get("status")) == "1" ?"selected":"" }}>Active</option>           
                </select>
                @error('status')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
              </div>               
                
                <div class="col-lg-4 form-group">
                  <button class="btn btn-info">Search</button>
                  <a href="{{ url("/batch/list") }}" class="btn btn-success">Reset</a>
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
                    Batch List (Total batches:{{ $total_batch }})
                    <a href="{{ url("/add/batch") }}" class="btn btn-success float-right btn-sm">Add New Batch</a>
                </h6>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table  table-striped table-hover table-bordered">
                          <thead>
                            <th>SL.</th>
                            <th>Batch Name</th>
                            <th>Added By</th>
                            <th>Active</th>
                          
                            <th>Action</th>
                          </thead>
                          <tbody>
                            @forelse ($batches as $batch)
                            <tr>
                                <td>{{ $batch->id }}</td>
                                <td>{{ $batch->name }}</td>
                                <td>{{ $batch->user["name"] }}</td>
                                <td>
                                  <a href="{{ url("/batch/change/status",$batch->id) }}">
                                    @if($batch->status == 1)
                                      <span class="badge badge-success">Active</span>
                                    @else
                                      <span class="badge badge-danger">Inactive</span>
                                    @endif
                                  </a>
                                </td>
                                <td>
                                    <a href="{{ url("/batch/edit", $batch->id) }}" class="btn btn-info btn-sm rounded">Edit</a>
                                    <form action="{{ route("batch.delete",$batch->id) }}" class="d-inline" method="POST">
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
                          {{ $batches->links() }}
                        </div>
                      </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection