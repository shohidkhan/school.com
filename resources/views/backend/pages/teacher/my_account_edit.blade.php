@extends('backend.layouts.app')

@section("title","Edit - Account")
@section("my_account")
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
                  Update My Account
                    <a href="{{ url("/teacher/account") }}" class="btn btn-success float-right btn-sm">back</a>
                </h6>
                    <form action="{{ route("teacher.account.update",$teacher->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="card-body row">
                           <div class="col-lg-12 mb-3">
                            <img src="{{ asset($teacher->profile_pic) }}" class="rounded-circle" width="100"
                            height="100" alt="">
                           </div>
                            <div class="form-group col-lg-12">
                                <label for="name">Profile Photo </label>
                                <input type="file" name="profile_pic" class="form-control rounded" id="">
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="name">Full  Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control rounded" value="{{ old("name",$teacher->name) }}" name="name" placeholder="Enter Full Name">
                                @error('name')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group col-lg-4">
                                <label for="name">Teacher  Email <span class="text-danger">*</span> </label>
                                <input type="text" name="email" value="{{ old("email",$teacher->email) }}" class="form-control rounded" id="" placeholder="Student Email">
                                @error('email')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group col-lg-4">
                                <label for="name"> Phone</label>
                                <input type="text" class="form-control rounded" value="{{ old("phone",$teacher->phone) }}" name="phone" placeholder="Enter Teacher Phone No">
                                @error('phone')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group col-lg-4">
                                <label for="name">Joining Date <span class="text-danger">*</span></label>
                                <input type="date" class="form-control rounded" value="{{ old("joining_date",$teacher->joining_date) }}" name="joining_date" placeholder="Enter Last Name">
                                @error('joining_date')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group col-lg-4">
                                <label for="name">Birth Date <span class="text-danger">*</span></label>
                                <input type="date" class="form-control rounded" value="{{ old("date_of_birth",$teacher->date_of_birth) }}" name="date_of_birth" >
                                @error('date_of_birth')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group col-lg-4">
                                <label for="name">Parmanent address <span class="text-danger">*</span></label>
                                <input type="text" class="form-control rounded" value="{{ old("parmanent_address",$teacher->parmanent_address) }}" name="parmanent_address" placeholder="Parmanent Address">
                                @error('parmanent_address')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group col-lg-4">
                                <label for="name">Present address <span class="text-danger">*</span></label>
                                <input type="text" class="form-control rounded" value="{{ old("present_address",$teacher->present_address) }}" name="present_address" placeholder="Present Address">
                                @error('present_address')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group col-lg-4">
                                <label for="name">Nationality <span class="text-danger">*</span></label>
                                <input type="text" class="form-control rounded" value="{{ old("nationality",$teacher->nationality) }}" name="nationality" placeholder=" Nationality">
                                @error('nationality')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="name">NID / Birth Certificate No <span class="text-danger">*</span></label>
                                <input type="text" class="form-control rounded" value="{{ old("nid_no",$teacher->nid_no) }}" name="nid_no" placeholder=" NID OR BIRTH NO">
                                @error('nid_no')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group col-lg-4">
                                <label for="name">Marital Status <span class="text-danger">*</span></label>
                                <select name="marital_status" id="" class="form-control rounded">
                                    <option value="">-- select Marital status --</option>
                                        <option value="married" {{ old("marital_status",$teacher->marital_status) =="married"?"selected":"" }}>Married</option>
                                        <option value="single" {{ old("marital_status",$teacher->marital_status) =="single"?"selected":"" }}>Single</option>
                                        <option value="widow" {{ old("marital_status",$teacher->marital_status) =="widow"?"selected":"" }}>Widow</option>
                                        <option value="divorced" {{ old("marital_status",$teacher->marital_status) =="divorced"?"selected":"" }}>Divorced</option>
                                </select>
                                @error('marital_status')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group col-lg-4">
                                <label for="name">Gender <span class="text-danger">*</span></label>
                                <select name="gender" id="" class="form-control rounded">
                                    <option value="">-- select Marital status --</option>
                                        <option value="male" {{ old("gender",$teacher->gender) =="male"?"selected":"" }}>Male</option>
                                        <option value="female" {{ old("gender",$teacher->gender) =="female"?"selected":"" }}>Female</option>
                                        <option value="other" {{ old("gender",$teacher->gender) =="other"?"selected":"" }}>Other</option>
                                </select>
                                @error('gender')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                           

                            <div class="form-group col-lg-4">
                                <label for="name">Religion  <span class="text-danger">*</span> </label>
                                <input type="text" name="religion" value="{{ old("religion",$teacher->religion) }}" class="form-control rounded" id="">
                                @error('religion')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="name">Blood Group  <span class="text-danger">*</span> </label>
                                <input type="text" name="blood_group" value="{{ old("blood_group",$teacher->blood_group) }}" class="form-control rounded" id="">
                                @error('blood_group')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="name">Qualification  <span class="text-danger">*</span> </label>
                                <textarea type="text" name="qualification"  class="form-control rounded" id="">{{ old("qualification",$teacher->qualification) }}</textarea>
                                @error('qualification')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group col-lg-4">
                                <label for="name">Experience  <span class="text-danger">*</span> </label>
                                <input type="text" name="experience" value="{{ old("experience",$teacher->experience) }}" class="form-control rounded" id="">
                                @error('experience')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="name">Designation  <span class="text-danger">*</span> </label>
                                <input type="text" name="designation" value="{{ old("designation",$teacher->designation) }}" class="form-control rounded" id="">
                                @error('designation')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>



                            <div class="form-group col-lg-4">
                                <label for="name">SSC Result  <span class="text-danger">*</span> </label>
                                <input type="text" name="ssc_marks" value="{{ old("ssc_marks",$teacher->ssc_marks) }}" class="form-control rounded" id="">
                                @error('ssc_marks')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="name">SSC Board  <span class="text-danger">*</span> </label>
                                <input type="text" name="ssc_board" value="{{ old("ssc_board",$teacher->ssc_board) }}" class="form-control rounded" id="">
                                @error('ssc_board')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                           
                            <div class="form-group col-lg-4">
                                <label for="name">SSC Institute  <span class="text-danger">*</span> </label>
                                <input type="text" name="ssc_institute" value="{{ old("ssc_institute",$teacher->ssc_institute) }}" class="form-control rounded" id="">
                                @error('ssc_institute')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="name">SSC Passing Year  <span class="text-danger">*</span> </label>
                                <input type="text" name="ssc_passing_year" value="{{ old("ssc_passing_year",$teacher->ssc_passing_year) }}" class="form-control rounded" id="">
                                @error('ssc_passing_year')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group col-lg-4">
                                <label for="name">HSC Result  <span class="text-danger">*</span> </label>
                                <input type="text" name="hsc_marks" value="{{ old("hsc_marks",$teacher->hsc_marks) }}" class="form-control rounded" id="">
                                @error('hsc_marks')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="name">HSC Board  <span class="text-danger">*</span> </label>
                                <input type="text" name="hsc_board" value="{{ old("hsc_board",$teacher->hsc_board) }}" class="form-control rounded" id="">
                                @error('hsc_board')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="name">HSC Institute  <span class="text-danger">*</span> </label>
                                <input type="text" name="hsc_institute" value="{{ old("hsc_institute",$teacher->hsc_institute) }}" class="form-control rounded" id="">
                                @error('hsc_institute')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="name">HSC Passing Year  <span class="text-danger">*</span> </label>
                                <input type="text" name="hsc_passing_year" value="{{ old("hsc_passing_year",$teacher->hsc_passing_year) }}" class="form-control rounded" id="">
                                @error('hsc_passing_year')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group col-lg-4">
                                <label for="name">Honours Result  <span class="text-danger">*</span> </label>
                                <input type="text" name="honours_marks" value="{{ old("honours_marks",$teacher->honours_marks) }}" class="form-control rounded" id="">
                                @error('honours_marks')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="name">Honours Institute  <span class="text-danger">*</span> </label>
                                <input type="text" name="honours_institute" value="{{ old("honours_institute",$teacher->honours_institute) }}" class="form-control rounded" id="">
                                @error('honours_institute')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="name">Honours Passing Year  <span class="text-danger">*</span> </label>
                                <input type="text" name="honours_passing_year" value="{{ old("honours_passing_year",$teacher->honours_passing_year) }}" class="form-control rounded" id="">
                                @error('honours_passing_year')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="name">Honours Subject / Department<span class="text-danger">*</span> </label>
                                <input type="text" name="honours_subject" value="{{ old("honours_subject",$teacher->honours_subject) }}" class="form-control rounded" id="">
                                @error('honours_subject')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="name">Masters Result  <span class="text-danger">*</span> </label>
                                <input type="text" name="masters_marks" value="{{ old("masters_marks",$teacher->masters_marks) }}" class="form-control rounded" id="">
                                @error('masters_marks')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="name">Masters Institute  <span class="text-danger">*</span> </label>
                                <input type="text" name="masters_institute" value="{{ old("masters_institute",$teacher->masters_institute) }}" class="form-control rounded" id="">
                                @error('masters_institute')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="name">Masters Passing Year  <span class="text-danger">*</span> </label>
                                <input type="text" name="masters_passing_year" value="{{ old("masters_passing_year",$teacher->masters_passing_year) }}" class="form-control rounded" id="">
                                @error('masters_passing_year')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="name">Masters Subject / Department <span class="text-danger">*</span> </label>
                                <input type="text" name="masters_subject" value="{{ old("masters_subject",$teacher->masters_subject) }}" class="form-control rounded" id="">
                                @error('masters_subject')
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