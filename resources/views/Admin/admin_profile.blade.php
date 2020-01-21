@extends('Admin.adminlayout')

@section('title','Admin - Profile')


@section('content')
  
 <div class="container" >

    <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Your Profile</h1>
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
   <div class="col-xl-6 col-lg-9">
      <div class="card shadow mb-4">
        <!-- Card Body -->
        <div class="card-body">
          <div class="chart-area">
              <h3 class="h3 mb-0 text-gray-800"><b>Name</b></h3><br>
              <h4 class="h5 mb-0 text-gray-800"><label>{{$user->name}}</label></h3>
              <hr>
              <h3 class="h3 mb-0 text-gray-800"><b>Email</b></h3><br>
              <h3 class="h5 mb-0 text-gray-800"><label>{{$user->email}}</label></h3>
              <hr>
              <h3 class="h3 mb-0 text-gray-800"><b>Mobile Number</b></h3><br>
              <h3 class="h5 mb-0 text-gray-800"><label>{{$user->phone_no}}</label></h3>
          </div>
        </div>
      </div>
    </div>


    <div class="col-xl-6 col-lg-9">
      <div class="card shadow mb-4">
        <!-- Card Body -->
        <div class="card-body">
          <div class="chart-area">
              <form class="" action="{{url('/chnagepass')}}" method="post">
                @csrf
                <div class="form-group">
                  <div class="form-group">
                    <h2 class="h3 mb-0 text-gray-800"><b>Current Password</b></h2>
                    <input type="password" class="form-control form-control-user" name="cpass" placeholder="Enter Password">
                  </div>
                  <div class="form-group">
                    <h2 class="h3 mb-0 text-gray-800"><b>New Password</b></h2>
                    <input type="password" class="form-control form-control-user" name="npass" placeholder="Enter Password">
                  </div>
                </div>
                <div class="form-group">
                  <h2 class="h3 mb-0 text-gray-800"><b>Confirm New Password</b></h2>
                  <input type="password" class="form-control form-control-user" name="cnpass" placeholder="Enter Password">
                </div>
                <button class="btn btn-primary btn-user btn-block">
                  Chnage Password
                </button>
              </form>
          </div>
        </div>
      </div>
    </div>

</div>
</div>

@endsection
