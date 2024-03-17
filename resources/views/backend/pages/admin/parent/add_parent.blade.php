@extends('backend.layouts.app')

@section("title","Add - Parnet")
@section("parent_list")
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
                  Add New Parent
                    <a href="{{ url("/parent/list") }}" class="btn btn-success float-right btn-sm">back</a>
                </h6>
                    <form action="{{ route("create.parent") }}" method="POST">
                        @csrf

                        <div class="card-body row">
                            <div class="form-group col-lg-4">
                                <label for="name">  Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control rounded" value="{{ old("name") }}" name="name" placeholder="Enter  Name">
                                @error('name')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="name">  Email <span class="text-danger">*</span> </label>
                                <input type="text" name="email" value="{{ old("email") }}" class="form-control rounded" id="" placeholder="Parent Email">
                                @error('email')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                           
                            <div class="form-group col-lg-4">
                                <label for="name">
                                     Phone</label>
                                <input type="text" class="form-control rounded" value="{{ old("phone") }}" name="phone" placeholder="Enter parent Phone">
                                @error('phone')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="name">NID No <span class="text-danger">*</span></label>
                                <input type="text" class="form-control rounded" value="{{ old("nid_no ") }}" name="nid_no" placeholder="Enter Admission Form No">
                                @error('nid_no')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>


                            

                            <div class="form-group col-lg-4">
                                <label for="name"> Address <span class="text-danger">*</span></label>
                                <input type="text" class="form-control rounded" value="{{ old("address") }}" name="address" placeholder="Parmanent Address">
                                @error('address')
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
                                <label for="name">Occupation </label>
                                <input type="text" name="occupation" value="{{ old("occupation") }}" class="form-control rounded" id="" placeholder=" Occupation">
                                @error('occupation')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            
                            <div class="form-group col-lg-4">
                                <label for="userType">User Type</label>
                                <select name="user_type" class="form-control rounded" id="userType">
                                    <option value="">-- select user type --</option>
                                    <option value="4" {{ old("user_type") == "4" ?"selected":"" }}>Parent</option>
                                </select>
                                @error('user_type')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="name">  Password <span class="text-danger">*</span> </label>
                                <input type="text" name="password" value="{{ old("password") }}" class="form-control rounded" id="" placeholder="Student Password">
                                @error('password')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            
                        </div>
                        <div class="card-footer bg-dark">
                            <button type="submit" class="btn btn-primary rounded">Add Parent</button>
                        </div>
                    </form>
              
            </div>
        </div>
    </div>
</div>
@endsection