@extends('backend.layouts.app')

@section("title","Parent | Details")
@section("parent_list")
active
@endsection
@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">

                <h6 class="card-header bg-primary text-white">
                    parent Details (status:@if($parent->status == 1)
                    <a href="{{ url("/parent/status/change",$parent->id) }}" class="badge badge-success">Active</a>
                  @else
                    <a href="{{ url("/student/status/change",$parent->id) }}" class="badge badge-danger">Inactive</a>
                  @endif )
                    <a href="{{ url("/student/list") }}" class="btn btn-success float-right btn-sm">Back</a>
                </h6>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table  table-striped table-hover table-bordered">
                    
                            <tr>
                                <th>SL.</th>
                                <td>{{ $parent->id }}</td>
                            </tr>

                            </tr>

                            <tr>
                                <th>Name</th>
                                <td>{{ $parent->name }}</td>
                            </tr>

                            <tr>
                                <th>Email</th>
                                <td>
                                    @if($parent->email)
                                    {{ $parent->email }}
                                    @else
                                      <span class="badge badge-danger">NA</span>
                                    @endif
                                </td>
                            </tr>


                            <tr>
                                <th>NID No</th>
                                <td>
                                    @if($parent->nid_no)
                                    {{ $parent->nid_no }}
                                    @else
                                      <span class="badge badge-danger">NA</span>
                                    @endif
                                </td>
                            </tr>

                            <tr>
                                <th>Phone</th>
                                <td>
                                    @if($parent->phone)
                                    {{ $parent->phone }}
                                    @else
                                      <span class="badge badge-danger">NA</span>
                                    @endif
                                </td>
                            </tr>

                            <tr>
                                <th>Occupation</th>
                                <td>
                                    @if($parent->occupation)
                                    {{ $parent->occupation }}
                                    @else
                                      <span class="badge badge-danger">NA</span>
                                    @endif
                                </td>
                            </tr>

                            <tr>
                                <th>Gender </th>
                                <td>
                                    @if($parent->gender)
                                    {{ $parent->gender }}
                                    @else
                                      <span class="badge badge-danger">NA</span>
                                    @endif
                                </td>
                            </tr>

                            <tr>
                                <th>Address </th>
                                <td>
                                    @if($parent->address)
                                    {{ $parent->address }}
                                    @else
                                      <span class="badge badge-danger">NA</span>
                                    @endif
                                </td>
                            </tr>

                            
                        </table>
                    </div>
                </div>
               
            </div>
        </div>   
    </div>

@endsection