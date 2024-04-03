@extends('backend.layouts.app')

@section("title","My Account")
@section("my_account")
active
@endsection
@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">

                <h6 class="card-header bg-primary text-white">
                    Student Details (status:@if($student->status == 1)
                    <a href="#" class="badge badge-success">Active</a>
                  @else
                    <a href="#" class="badge badge-danger">Inactive</a>
                  @endif )
                    <a href="{{ url("/student/account/edit",$student->id) }}" class="btn btn-success float-right btn-sm">Edit</a>
                </h6>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table  table-striped table-hover table-bordered">
                    
                            <tr>
                                <th>SL.</th>
                                <td>{{ $student->id }}</td>
                            </tr>

                            <tr>
                                <th>Photo</th>
                                <td>
                                    @if($student->profile_pic)
                                    <img src="{{ asset($student->profile_pic) }}" alt="" width="100" height="100">
                                    @else
                                      <span class="badge badge-danger">NA</span>
                                    @endif
                                </td>
                            </tr>

                            <tr>
                                <th>Name</th>
                                <td>{{ $student->first_name }} {{ $student->last_name }}</td>
                            </tr>

                            <tr>
                                <th>Email</th>
                                <td>
                                    @if($student->student_email)
                                    {{ $student->student_email }}
                                    @else
                                      <span class="badge badge-danger">NA</span>
                                    @endif
                                </td>
                            </tr>


                            <tr>
                                <th>Admission Form No</th>
                                <td>
                                    @if($student->admission_form_no)
                                    {{ $student->admission_form_no }}
                                    @else
                                      <span class="badge badge-danger">NA</span>
                                    @endif
                                </td>
                            </tr>

                            <tr>
                                <th>Registration No</th>
                                <td>
                                    @if($student->registration_no)
                                    {{ $student->registration_no }}
                                    @else
                                      <span class="badge badge-danger">NA</span>
                                    @endif
                                </td>
                            </tr>

                            <tr>
                                <th>Admission Year</th>
                                <td>
                                    @if($student->year)
                                    {{ $student->year }}
                                    @else
                                      <span class="badge badge-danger">NA</span>
                                    @endif
                                </td>
                            </tr>

                            <tr>
                                <th>Class </th>
                                <td>
                                    @if($student->class["name"])
                                    {{ $student->class["name"] }}
                                    @else
                                      <span class="badge badge-danger">NA</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Batch </th>
                                <td>
                                    @if($student->batch["name"])
                                    {{ $student->batch["name"] }}
                                    @else
                                      <span class="badge badge-danger">NA</span>
                                    @endif
                                </td>
                            </tr>

                            <tr>
                                <th>Roll </th>
                                <td>
                                    @if($student->roll)
                                    {{ $student->roll }}
                                    @else
                                      <span class="badge badge-danger">NA</span>
                                    @endif
                                </td>
                            </tr>

                            <tr>
                                <th>Gender </th>
                                <td>
                                    @if($student->gender)
                                    {{ $student->gender }}
                                    @else
                                      <span class="badge badge-danger">NA</span>
                                    @endif
                                </td>
                            </tr>

                            <tr>
                                <th>Date of Birth </th>
                                <td>
                                    @if($student->date_of_birth)
                                    {{ date("d-M-Y",strtotime($student->date_of_birth)) }}
                                    @else
                                      <span class="badge badge-danger">NA</span>
                                    @endif
                                </td>
                            </tr>

                            <tr>
                                <th>Nid no / Birth certificate No </th>
                                <td>
                                    @if($student->nid_no)
                                    {{ $student->nid_no }}
                                    @else
                                      <span class="badge badge-danger">NA</span>
                                    @endif
                                </td>
                            </tr>


                            <tr>
                                <th> Birth place </th>
                                <td>
                                    @if($student->birth_place)
                                    {{ $student->birth_place }}
                                    @else
                                      <span class="badge badge-danger">NA</span>
                                    @endif
                                </td>
                            </tr>

                            <tr>
                                <th> Present Address  </th>
                                <td>
                                    @if($student->present_address)
                                    {{ $student->present_address }}
                                    @else
                                      <span class="badge badge-danger">NA</span>
                                    @endif
                                </td>
                            </tr>

                            <tr>
                                <th> Parmanent Address  </th>
                                <td>
                                    @if($student->parmanent_address)
                                    {{ $student->parmanent_address }}
                                    @else
                                      <span class="badge badge-danger">NA</span>
                                    @endif
                                </td>
                            </tr>

                            <tr>
                                <th> Nationality  </th>
                                <td>
                                    @if($student->nationality)
                                    {{ $student->nationality }}
                                    @else
                                      <span class="badge badge-danger">NA</span>
                                    @endif
                                </td>
                            </tr>

                            <tr>
                                <th> Marital Status  </th>
                                <td>
                                    @if($student->marital_status)
                                    {{ $student->marital_status }}
                                    @else
                                      <span class="badge badge-danger">NA</span>
                                    @endif
                                </td>
                            </tr>

                            <tr>
                                <th> Religion  </th>
                                <td>
                                    @if($student->religion)
                                    {{ $student->religion }}
                                    @else
                                      <span class="badge badge-danger">NA</span>
                                    @endif
                                </td>
                            </tr>

                            <tr>
                                <th> Blood Group  </th>
                                <td>
                                    @if($student->blood_group)
                                    {{ $student->blood_group }}
                                    @else
                                      <span class="badge badge-danger">NA</span>
                                    @endif
                                </td>
                            </tr>

                            <tr>
                                <th> Height  </th>
                                <td>
                                    @if($student->height)
                                    {{ $student->height }}
                                    @else
                                      <span class="badge badge-danger">NA</span>
                                    @endif
                                </td>
                            </tr>

                            <tr>
                                <th> Weight  </th>
                                <td>
                                    @if($student->weight)
                                    {{ $student->weight }}
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

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    Father Details
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-bordered">
                            <tr>
                                <th>Father Name</th>
                                <td>
                                    @if($student->father_name)
                                    {{ $student->father_name }}
                                    @else
                                      <span class="badge badge-danger">NA</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Father Occupation</th>
                                <td>
                                    @if($student->father_occupation)
                                    {{ $student->father_occupation }}
                                    @else
                                      <span class="badge badge-danger">NA</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Father NID</th>
                                <td>
                                    @if($student->father_nid)
                                    {{ $student->father_nid }}
                                    @else
                                      <span class="badge badge-danger">NA</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Father Phone</th>
                                <td>
                                    @if($student->father_phone)
                                    {{ $student->father_phone }}
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
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    Mother Details
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-bordered">
                            <tr>
                                <th>Mother Name</th>
                                <td>
                                    @if($student->mother_name)
                                    {{ $student->mother_name }}
                                    @else
                                      <span class="badge badge-danger">NA</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Mother Occupation</th>
                                <td>
                                    @if($student->mother_occupation)
                                    {{ $student->mother_occupation }}
                                    @else
                                      <span class="badge badge-danger">NA</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Mother NID</th>
                                <td>
                                    @if($student->mother_nid)
                                    {{ $student->mother_nid }}
                                    @else
                                      <span class="badge badge-danger">NA</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Mother Phone</th>
                                <td>
                                    @if($student->mother_phone)
                                    {{ $student->mother_phone }}
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
   
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    Guardian Details
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-bordered">
                            <tr>
                                <th>Guardian Name</th>
                                <td>
                                    @if($student->guardian_name)
                                    {{ $student->guardian_name }}
                                    @else
                                      <span class="badge badge-danger">NA</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Guardian Phone</th>
                                <td>
                                    @if($student->guardian_phone)
                                    {{ $student->guardian_phone }}
                                    @else
                                      <span class="badge badge-danger">NA</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Guardian Occupation</th>
                                <td>
                                    @if($student->guardian_occupation)
                                    {{ $student->guardian_occupation }}
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
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    Emergency Details
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-bordered">
                            <tr>
                                <th>Emergency Person Name</th>
                                <td>
                                    @if($student->emergency_person_name)
                                    {{ $student->emergency_person_name }}
                                    @else
                                      <span class="badge badge-danger">NA</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Emergency Person  relation with student</th>
                                <td>
                                    @if($student->emergency_person_relation)
                                    {{ $student->emergency_person_relation }}
                                    @else
                                      <span class="badge badge-danger">NA</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Emergency Contact</th>
                                <td>
                                    @if($student->emergency_contact)
                                    {{ $student->emergency_contact }}
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