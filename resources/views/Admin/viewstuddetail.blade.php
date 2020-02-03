@extends('Admin.adminlayout')

@section('title','Admin - Edit Student Detail')


@section('content')
  
<div class="container-fluid" >

    <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"><b>{{$user->name}} Detail</b></h1>
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
<form class="" action="{{url('/updatestud')}}" method="post" id="form">
      @csrf
<div class="row">
    <div class="col-xl-12 col-lg-8">
        <div class="card-body">
              <div class="form-row" style="padding: 10px;">
                <div class="col">
                    <h3 class="h3 mb-0 text-gray-800"><b>Enrollment</b></h3><br>
                    <input type="text" class="form-control" style="width: 300px;margin-top: -6px; " name="enroll" value="{{$user->enroll}}">
                    <hr>
                </div>
                <div class="col">
                    <h3 class="h3 mb-0 text-gray-800"><b>Name</b></h3><br>
                    <input type="text" class="form-control" style="width: 300px;margin-top: -6px; " name="name" value="{{$user->name}}">
                    <hr>
                </div>
                <div class="col">
                    <h3 class="h3 mb-0 text-gray-800"><b>Email</b></h3><br>
                    <input type="text" class="form-control" style="width: 300px;margin-top: -6px; " name="email" value="{{$user->email}}">
                    <hr>
                </div>
              </div>
              <input type="hidden" id="semval" name="semval" value="{{$user->semester}}">
      </div>
      </div>
    <div class="col-xl-12 col-lg-8">
        <div class="card-body">
              <div class="form-row" style="padding: 10px;">
                <div class="col">
                    <h3 class="h3 mb-0 text-gray-800"><b>Mobile Number</b></h3><br>
                    <input type="text" class="form-control" style="width: 300px;" name="phone" value="{{$user->Phone_No}}">
                    <hr>
                </div>
                <div class="col">
                    <h3 class="h3 mb-0 text-gray-800"><b>Course</b></h3><br>
                    @if($user->course == "MCA")
                    <select class="form-control" id="course" name="course" onchange="updatecourse(this)" style="width: 300px;">
                      <option  value="MCA">MCA</option>
                      <option  value="IMCA">IMCA</option>
                    </select>
                    @else
                    <select class="form-control" id="course" name="course" onchange="updatecourse(this)" style="width: 300px;">
                      <option  value="MCA">IMCA</option>
                      <option  value="IMCA">MCA</option>
                    </select>
                    @endif
                    <hr>
                </div>
                <div class="col">
                  @if($user->course == "MCA")
                  <h3 class="h3 mb-0 text-gray-800"><b>Semester</b></h3><br>
                  <select class="form-control" id="sem" name="sem" style="width: 300px;">
                    <option>{{$user->semester}}</option>
                    @for ($i = 1; $i <= 6; $i++)
                        @if($i != $user->semester)
                        <option>{{$i}}</option>
                        @endif
                    @endfor
                  </select>
                  <hr>
                  @else
                  <h3 class="h3 mb-0 text-gray-800"><b>Semester</b></h3><br>
                  <select class="form-control" id="sem" name="sem" style="width: 300px;">
                    <option>{{$user->semester}}</option>
                    @for ($i = 1; $i <= 10; $i++)
                        @if($i != $user->semester)
                        <option>{{$i}}</option>
                        @endif
                    @endfor
                  </select>
                  <hr>
                  @endif
                </div>
              </div>
      </div>
    </div>

    <div class="col-xl-12 col-lg-8">
        <div class="card-body">
              <hr>
              <button class="btn btn-primary btn-user btn-block" name="btnsubmit"  id="btnsubmit">
                  Update
              </button>
      </div>
    </div>
</form>
</div>
</div>

</div>
</div>

@endsection
