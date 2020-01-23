@extends('Student.studlayout')

@section('title','Student - Profile')


@section('content')
  
<div class="container-fluid" >

    <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"><b>Your Profile</b></h1>
          </div>

     @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

<div class="row">
    <div class="col-xl-12 col-lg-8">
        <div class="card-body">
              <div class="form-row" style="padding: 10px;">
                <div class="col">
                    <h3 class="h3 mb-0 text-gray-800"><b>Enrollment</b></h3><br>
                    <h4 class="h5 mb-0 text-gray-800"><label>{{$user->enroll}}</label></h3>
                    <hr>
                </div>
                <div class="col">
                    <h3 class="h3 mb-0 text-gray-800"><b>Name</b></h3><br>
                    <h3 class="h5 mb-0 text-gray-800"><label>{{$user->name}}</label></h3>
                    <hr>
                </div>
                <div class="col">
                    <h3 class="h3 mb-0 text-gray-800"><b>Email</b></h3><br>
                    <h3 class="h5 mb-0 text-gray-800"><label>{{$user->email}}</label></h3>
                    <hr>
                </div>
              </div>
      </div>
      </div>
    <div class="col-xl-12 col-lg-8">
        <div class="card-body">
              <div class="form-row" style="padding: 10px;">
                <div class="col">
                    <h3 class="h3 mb-0 text-gray-800"><b>Mobile Number</b></h3><br>
                    <h4 class="h5 mb-0 text-gray-800"><label>{{$user->Phone_No}}</label></h3>
                    <hr>
                </div>
                <div class="col">
                    <h3 class="h3 mb-0 text-gray-800"><b>Course</b></h3><br>
                    <h3 class="h5 mb-0 text-gray-800"><label>{{$user->course}}</label></h3>
                    <hr>
                </div>
                <div class="col">
                    <h3 class="h3 mb-0 text-gray-800"><b>Semester</b></h3><br>
                    <h3 class="h5 mb-0 text-gray-800"><label>{{$user->semester}}</label></h3>
                    <hr>
                </div>
              </div>
      </div>
      </div>
</div>
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"><b>Chnage Your PassWord</b></h1>
          </div>
<div class="row">
    <div class="col-xl-12 col-lg-8">
        <div class="card-body">
                <form class="" action="{{url('/chnagepass')}}" method="post">
                @csrf
              <div class="form-row" style="padding: 10px;">
                <div class="col">
                    <h2 class="h3 mb-0 text-gray-800"><b>Current Password</b></h2><br>
                    <input type="password" class="form-control form-control-user" name="cpass" placeholder="Enter Password">
                    <hr>
                </div>
                <div class="col">
                    <h2 class="h3 mb-0 text-gray-800"><b>New Password</b></h2><br>
                    <input type="password" class="form-control form-control-user" name="npass" placeholder="Enter Password">
                    <hr>
                </div>
                <div class="col">
                    <h2 class="h3 mb-0 text-gray-800"><b>Confirm Password</b></h2><br>
                  <input type="password" class="form-control form-control-user" name="cnpass" placeholder="Enter Password">
                    <hr>
                </div>
                <button class="btn btn-primary btn-user btn-block">
                  Chnage Password
                </button>
              </div>
              </form>
              </div>
      </div>
      </div>
</div>

</div>
</div>

@endsection
