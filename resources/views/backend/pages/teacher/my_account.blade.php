@extends('backend.layouts.app')

@section("title","My Account")
@section("my_account")
active
@endsection
@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">

                <h6 class="card-header bg-primary text-white d-flex justify-content-between">
                    <span>
                        Teacher Details (status:@if($teacher->status == 1)
                    <a href="#" class="badge badge-success">Active</a>
                    
                  @else
                    <a href="#" class="badge badge-danger">Inactive</a>
                  @endif )
                </span>
                    <a href="{{ url("/teacher/account/edit",$teacher->id) }}" class="btn btn-success  btn-sm">Edit</a>

                </h6>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table  table-striped table-hover table-bordered">
                    
                            <tr>
                                <th>SL.</th>
                                <td>{{ $teacher->id }}</td>
                            </tr>

                            <tr>
                                <th>Photo</th>
                                <td>
                                    @if($teacher->profile_pic)
                                    <img src="{{ asset($teacher->profile_pic) }}" alt="" width="100" height="100">
                                    @else
                                      <span class="badge badge-danger">NA</span>
                                    @endif
                                </td>
                            </tr>

                            <tr>
                                <th>Name</th>
                                <td>{{ $teacher->name }} </td>
                            </tr>

                            <tr>
                                <th>Email</th>
                                <td>
                                    @if($teacher->email)
                                    {{ $teacher->email }}
                                    @else
                                      <span class="badge badge-danger">NA</span>
                                    @endif
                                </td>
                            </tr>

                            <tr>
                                <th>Date of Birth </th>
                                <td>
                                    @if($teacher->date_of_birth)
                                    {{ date("d-M-Y",strtotime($teacher->date_of_birth)) }}
                                    @else
                                      <span class="badge badge-danger">NA</span>
                                    @endif
                                </td>
                            </tr>

                            <tr>
                                <th>Joining Date</th>
                                <td>
                                    @if($teacher->joining_date)
                                    {{ date("d-M-Y",strtotime($teacher->joining_date)) }}
                                    @else
                                      <span class="badge badge-danger">NA</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Gender </th>
                                <td>
                                    @if($teacher->gender)
                                    {{ $teacher->gender }}
                                    @else
                                      <span class="badge badge-danger">NA</span>
                                    @endif
                                </td>
                            </tr>

                            <tr>
                                <th>Religion</th>
                                <td>
                                    @if($teacher->religion)
                                    {{ $teacher->religion }}
                                    @else
                                      <span class="badge badge-danger">NA</span>
                                    @endif
                                </td>
                            </tr>

                            <tr>
                                <th>Blood Group</th>
                                <td>
                                    @if($teacher->blood_group)
                                    {{ $teacher->blood_group }}
                                    @else
                                      <span class="badge badge-danger">NA</span>
                                    @endif
                                </td>
                            </tr>

                            <tr>
                                <th>Nationality </th>
                                <td>
                                    @if($teacher->nationality)
                                    {{ $teacher->nationality }}
                                    @else
                                      <span class="badge badge-danger">NA</span>
                                    @endif
                                </td>
                            </tr>
                            
                            <tr>
                                <th> Present Address  </th>
                                <td>
                                    @if($teacher->present_address)
                                    {{ $teacher->present_address }}
                                    @else
                                      <span class="badge badge-danger">NA</span>
                                    @endif
                                </td>
                            </tr>

                            <tr>
                                <th> Parmanent Address  </th>
                                <td>
                                    @if($teacher->parmanent_address)
                                    {{ $teacher->parmanent_address }}
                                    @else
                                      <span class="badge badge-danger">NA</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th> Marital Status  </th>
                                <td>
                                    @if($teacher->marital_status)
                                    {{ $teacher->marital_status }}
                                    @else
                                      <span class="badge badge-danger">NA</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Nid no / Birth certificate No </th>
                                <td>
                                    @if($teacher->nid_no)
                                    {{ $teacher->nid_no }}
                                    @else
                                      <span class="badge badge-danger">NA</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Qualification </th>
                                <td>
                                    @if($teacher->qualification)
                                    {{ $teacher->qualification }}
                                    @else
                                      <span class="badge badge-danger">NA</span>
                                    @endif
                                </td>
                            </tr>

                            <tr>
                                <th>Experience </th>
                                <td>
                                    @if($teacher->experience)
                                    {{ $teacher->experience }}
                                    @else
                                      <span class="badge badge-danger">NA</span>
                                    @endif
                                </td>
                            </tr>

                            
                            <tr>
                                <th> Designation </th>
                                <td>
                                    @if($teacher->designation)
                                    {{ $teacher->designation }}
                                    @else
                                      <span class="badge badge-danger">NA</span>
                                    @endif
                                </td>
                            </tr>


                           

                            <tr>
                                <th> SSC Result  </th>
                                <td>
                                    @if($teacher->ssc_marks)
                                    {{ $teacher->ssc_marks }}
                                    @else
                                      <span class="badge badge-danger">NA</span>
                                    @endif
                                </td>
                            </tr>

                            <tr>
                                <th> SSC Board </th>
                                <td>
                                    @if($teacher->ssc_board)
                                    {{ $teacher->ssc_board }}
                                    @else
                                      <span class="badge badge-danger">NA</span>
                                    @endif
                                </td>
                            </tr>

                            <tr>
                                <th> SSC Passing Year  </th>
                                <td>
                                    @if($teacher->ssc_passing_year)
                                    {{ $teacher->ssc_passing_year }}
                                    @else
                                      <span class="badge badge-danger">NA</span>
                                    @endif
                                </td>
                            </tr>

                            <tr>
                                <th> SSC Institute  </th>
                                <td>
                                    @if($teacher->ssc_institute)
                                    {{ $teacher->ssc_institute }}
                                    @else
                                      <span class="badge badge-danger">NA</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th> HSC Result  </th>
                                <td>
                                    @if($teacher->hsc_marks)
                                    {{ $teacher->hsc_marks }}
                                    @else
                                      <span class="badge badge-danger">NA</span>
                                    @endif
                                </td>
                            </tr>

                            <tr>
                                <th> HSC Board </th>
                                <td>
                                    @if($teacher->hsc_board)
                                    {{ $teacher->hsc_board }}
                                    @else
                                      <span class="badge badge-danger">NA</span>
                                    @endif
                                </td>
                            </tr>

                            <tr>
                                <th> HSC Passing Year  </th>
                                <td>
                                    @if($teacher->hsc_passing_year)
                                    {{ $teacher->hsc_passing_year }}
                                    @else
                                      <span class="badge badge-danger">NA</span>
                                    @endif
                                </td>
                            </tr>

                            <tr>
                                <th> HSC Institute  </th>
                                <td>
                                    @if($teacher->hsc_institute)
                                    {{ $teacher->hsc_institute }}
                                    @else
                                      <span class="badge badge-danger">NA</span>
                                    @endif
                                </td>
                            </tr>

                            <tr>
                                <th> Honours Result  </th>
                                <td>
                                    @if($teacher->honours_marks)
                                    {{ $teacher->honours_marks }}
                                    @else
                                      <span class="badge badge-danger">NA</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th> Honours Institute  </th>
                                <td>
                                    @if($teacher->honours_institute)
                                    {{ $teacher->honours_institute }}
                                    @else
                                      <span class="badge badge-danger">NA</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th> Honours Passing Year  </th>
                                <td>
                                    @if($teacher->honours_passing_year)
                                    {{ $teacher->honours_passing_year }}
                                    @else
                                      <span class="badge badge-danger">NA</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th> Honours Subject / Depertment  </th>
                                <td>
                                    @if($teacher->honours_subject)
                                    {{ $teacher->honours_subject }}
                                    @else
                                      <span class="badge badge-danger">NA</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th> Masters Result  </th>
                                <td>
                                    @if($teacher->masters_marks)
                                    {{ $teacher->masters_marks }}
                                    @else
                                      <span class="badge badge-danger">NA</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th> Masters Institute  </th>
                                <td>
                                    @if($teacher->masters_institute)
                                    {{ $teacher->masters_institute }}
                                    @else
                                      <span class="badge badge-danger">NA</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th> Masters Passing Year  </th>
                                <td>
                                    @if($teacher->masters_passing_year)
                                    {{ $teacher->masters_passing_year }}
                                    @else
                                      <span class="badge badge-danger">NA</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th> Masters Subject / Depertment  </th>
                                <td>
                                    @if($teacher->masters_subject)
                                    {{ $teacher->masters_subject }}
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