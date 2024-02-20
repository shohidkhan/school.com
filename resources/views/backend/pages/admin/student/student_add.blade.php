@extends('backend.layouts.app')

@section("title","Add - Student")
@section("student_list")
active
@endsection
@section('content')
<div class="">
    <div class="row">
      
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
                <h6 class="card-header bg-primary text-white">
                  Add New Student
                    <a href="{{ url("/student/list") }}" class="btn btn-success float-right btn-sm">back</a>
                </h6>
                    <form action="{{ route("create.student") }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="card-body row">
                            <div class="form-group col-lg-4">
                                <label for="name">First  Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control rounded" value="{{ old("first_name") }}" name="first_name" placeholder="Enter First Name">
                                @error('first_name')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="name">Last  Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control rounded" value="{{ old("last_name") }}" name="last_name" placeholder="Enter Last Name">
                                @error('last_name')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="name">Full  Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control rounded" value="{{ old("name") }}" name="name" placeholder="Enter Full Name">
                                @error('name')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group col-lg-4">
                                <label for="name">Student Phone</label>
                                <input type="text" class="form-control rounded" value="{{ old("student_phone") }}" name="student_phone" placeholder="Enter Studnet Phone No">
                                @error('student_phone')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="name">Admission Form No <span class="text-danger">*</span></label>
                                <input type="text" class="form-control rounded" value="{{ old("admission_form_no ") }}" name="admission_form_no" placeholder="Enter Admission Form No">
                                @error('admission_form_no')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group col-lg-4">
                                <label for="name">Admission Date <span class="text-danger">*</span></label>
                                <input type="date" class="form-control rounded" value="{{ old("admission_date ") }}" name="admission_date" placeholder="Enter Last Name">
                                @error('admission_date')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group col-lg-4">
                                <label for="name">Registration No <span class="text-danger">*</span></label>
                                <input type="text" class="form-control rounded" value="{{ old("registration_no ") }}" name="registration_no" placeholder="Registration No">
                                @error('registration_no')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group col-lg-4">
                                <label for="name">Roll <span class="text-danger">*</span></label>
                                <input type="text" class="form-control rounded" value="{{ old("roll") }}" name="roll" placeholder="Roll">
                                @error('roll')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group col-lg-4">
                                <label for="name">Class <span class="text-danger">*</span></label>
                                <select name="class_id" id="" class="form-control rounded">
                                    <option value="">-- select class --</option>
                                    @foreach ($classes as $class)
                                        <option value="{{ $class->id }}" {{ old("class_id") == $class->id ?"selected":"" }}>{{ $class->name }}</option>
                                    @endforeach
                                </select>
                                @error('class_id')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group col-lg-4">
                                <label for="name">Year <span class="text-danger">*</span></label>
                                <input type="text" class="form-control rounded" value="{{ old("year") }}" name="year" placeholder="Admission Year">
                                @error('year')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group col-lg-4">
                                <label for="name">Birth Date <span class="text-danger">*</span></label>
                                <input type="date" class="form-control rounded" value="{{ old("date_of_birth") }}" name="date_of_birth" >
                                @error('date_of_birth')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group col-lg-4">
                                <label for="name">Birth Place</label>
                                <input type="text" class="form-control rounded" value="{{ old("birth_place") }}" name="birth_place" placeholder="Birth Address">
                                @error('birth_place')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group col-lg-4">
                                <label for="name">Parmanent address <span class="text-danger">*</span></label>
                                <input type="text" class="form-control rounded" value="{{ old("parmanent_address") }}" name="parmanent_address" placeholder="Parmanent Address">
                                @error('parmanent_address')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group col-lg-4">
                                <label for="name">Present address <span class="text-danger">*</span></label>
                                <input type="text" class="form-control rounded" value="{{ old("present_address") }}" name="present_address" placeholder="Present Address">
                                @error('present_address')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group col-lg-4">
                                <label for="name">Nationality <span class="text-danger">*</span></label>
                                <input type="text" class="form-control rounded" value="{{ old("nationality") }}" name="nationality" placeholder=" Nationality">
                                @error('nationality')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="name">NID / Birth Certificate No <span class="text-danger">*</span></label>
                                <input type="text" class="form-control rounded" value="{{ old("nid_no") }}" name="nid_no" placeholder=" NID OR BIRTH NO">
                                @error('nid_no')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group col-lg-4">
                                <label for="name">Marital Status <span class="text-danger">*</span></label>
                                <select name="marital_status" id="" class="form-control rounded">
                                    <option value="">-- select Marital status --</option>
                                        <option value="married" {{ old("marital_status") =="married"?"selected":"" }}>Married</option>
                                        <option value="single" {{ old("marital_status") =="single"?"selected":"" }}>Single</option>
                                        <option value="widow" {{ old("marital_status") =="widow"?"selected":"" }}>Widow</option>
                                        <option value="divorced" {{ old("marital_status") =="divorced"?"selected":"" }}>Divorced</option>
                                </select>
                                @error('marital_status')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group col-lg-4">
                                <label for="name">Gender <span class="text-danger">*</span></label>
                                <select name="gender" id="" class="form-control rounded">
                                    <option value="">-- select Marital status --</option>
                                        <option value="male" {{ old("gender") =="male"?"selected":"" }}>Male</option>
                                        <option value="female" {{ old("gender") =="female"?"selected":"" }}>Female</option>
                                        <option value="other" {{ old("gender") =="other"?"selected":"" }}>Other</option>
                                </select>
                                @error('gender')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="name">Profile Photo </label>
                                <input type="file" name="profile_pic" class="form-control rounded" id="">
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="name">Religion  <span class="text-danger">*</span> </label>
                                <input type="text" name="religion" value="{{ old("religion") }}" class="form-control rounded" id="">
                                @error('religion')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group col-lg-4">
                                <label for="name">Height   </label>
                                <input type="text" name="height" value="{{ old("height") }}" class="form-control rounded" id="">
                                @error('height')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="name">Weight   </label>
                                <input type="text" name="weight" value="{{ old("weight") }}" class="form-control rounded" id="">
                                @error('weight')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group col-lg-4">
                                <label for="name">BLood Group </label>
                                <select name="blood_group" id="" class="form-control rounded">
                                    <option value="">-- select Blood Group --</option>
                                        <option value="A+" {{ old("blood_group") =="A+"?"selected":"" }}>A+</option>
                                        <option value="A-" {{ old("blood_group") =="A-"?"selected":"" }}>A-</option>
                                        <option value="B+" {{ old("blood_group") =="B+"?"selected":"" }}>B+</option>
                                        <option value="B-" {{ old("blood_group") =="B-"?"selected":"" }}>B-</option>
                                        <option value="AB+" {{ old("blood_group") =="AB+"?"selected":"" }}>AB+</option>
                                        <option value="AB-" {{ old("blood_group") =="AB-"?"selected":"" }}>AB-</option>
                                        <option value="O+" {{ old("blood_group") =="O+"?"selected":"" }}>O+</option>
                                        <option value="O-" {{ old("blood_group") =="O-"?"selected":"" }}>O-</option>
                                </select>
                                @error('gender ')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group col-lg-4">
                                <label for="userType">Status</label>
                                <select name="status" class="form-control rounded" id="userType">
                                    <option value="">-- select status --</option>
                                    <option value="1" {{ old("status") == "1" ?"selected":"" }}>Active</option>
                                    <option value="2" {{ old("status") == "2" ?"selected":"" }}>Inactive</option>
                                     
                                </select>
                                @error('status')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group col-lg-4">
                                <label for="name">Father Name <span class="text-danger">*</span></label>
                                <input type="text" name="father_name" value="{{ old("father_name") }}" class="form-control rounded" id="" placeholder="Father Name">
                                @error('father_name')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="name">Father Occupation </label>
                                <input type="text" name="father_occupation" value="{{ old("father_occupation") }}" class="form-control rounded" id="" placeholder="Father Occupation">
                                @error('father_occupation')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="name">Father NID </label>
                                <input type="text" name="father_nid" value="{{ old("father_nid") }}" class="form-control rounded" id="" placeholder="Father NID">
                                @error('father_nid')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="name">Father Phone <span class="text-danger">*</span></label>
                                <input type="text" name="father_phone" value="{{ old("father_phone") }}" class="form-control rounded" id="" placeholder="Father Name">
                                @error('father_phone')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="name">Mother Name </label>
                                <input type="text" name="mother_name" value="{{ old("mother_name") }}" class="form-control rounded" id="" placeholder="Mother name" >
                                @error('mother_name')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="name">Mother Occupation </label>
                                <input type="text" name="mother_occupation" value="{{ old("mother_occupation") }}" class="form-control rounded" id="" placeholder="Mother  Occupation">
                                @error('mother_occupation')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="name">Mother NID </label>
                                <input type="text" name="mother_nid" value="{{ old("mother_nid") }}" class="form-control rounded" id="" placeholder="Mother  Occupation">
                                @error('mother_nid')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="name">Mother Phone <span class="text-danger">*</span> </label>
                                <input type="text" name="mother_phone" value="{{ old("mother_phone") }}" class="form-control rounded" id="" placeholder="Mother  Phone">
                                @error('mother_phone')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="name">Guardian Name      <span class="text-danger">*</span> </label>
                                <input type="text" name="guardian_name" value="{{ old("guardian_name") }}" class="form-control rounded" id="" placeholder="Guardian Name">
                                @error('guardian_name')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group col-lg-4">
                                <label for="name">Guardian Phone      <span class="text-danger">*</span> </label>
                                <input type="text" name="guardian_phone" value="{{ old("guardian_phone") }}" class="form-control rounded" id="" placeholder="Guardian Phone">
                                @error('guardian_phone')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group col-lg-4">
                                <label for="name">Guardian Occupation </label>
                                <input type="text" name="guardian_occupation" value="{{ old("guardian_occupation") }}" class="form-control rounded" id="" placeholder="Guardian Occupation">
                                @error('guardian_occupation')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group col-lg-4">
                                <label for="name">Emergency Person Name <span class="text-danger">*</span> </label>
                                <input type="text" name="emergency_person_name" value="{{ old("emergency_person_name") }}" class="form-control rounded" id="" placeholder="emergency person name">
                                @error('emergency_person_name')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="name">Emergency Person Relationship with student <span class="text-danger">*</span> </label>
                                <input type="text" name="emergency_person_relation" value="{{ old("emergency_person_relation") }}" class="form-control rounded" id="" placeholder="emergency person relationship with student">
                                @error('emergency_person_relation')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="name">Emergency Contact <span class="text-danger">*</span> </label>
                                <input type="text" name="emergency_contact" value="{{ old("emergency_contact") }}" class="form-control rounded" id="" placeholder="emergency person contact">
                                @error('emergency_contact')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <hr>
                            <div class="form-group col-lg-4">
                                <label for="name">Student  Email <span class="text-danger">*</span> </label>
                                <input type="text" name="email" value="{{ old("email") }}" class="form-control rounded" id="" placeholder="Student Email">
                                @error('email')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="userType">User Type</label>
                                <select name="user_type" class="form-control rounded" id="userType">
                                    <option value="">-- select user type --</option>
                                    <option value="3" {{ old("user_type") == "3" ?"selected":"" }}>Student</option>
                                </select>
                                @error('user_type')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="name">Student  Password <span class="text-danger">*</span> </label>
                                <input type="text" name="password" value="{{ old("password") }}" class="form-control rounded" id="" placeholder="Student Password">
                                @error('password')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            
                        </div>
                        <div class="card-footer bg-dark">
                            <button type="submit" class="btn btn-primary rounded">Add student</button>
                        </div>
                    </form>
              
            </div>
        </div>
    </div>
</div>
@endsection