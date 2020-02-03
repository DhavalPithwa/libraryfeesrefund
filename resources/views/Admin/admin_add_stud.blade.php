@extends('Admin.adminlayout')

@section('title','Admin - Add Students')


@section('content')
  
  <div class="container-fluid" >

    <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"><b>Add Students</b></h1>
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
<div class="form-row" style="padding: 10px;">
    <form class="" action="{{url('/addstud')}}" method="post" enctype="multipart/form-data" id="blukform">
      @csrf
    <div class="card-body shadow col-sm-40 mb-8 mb6">
      <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Chosse CSV</h1>
      </div>
      <div class="custom-file">
        <input type="file" class="custom-file-input" name="customFile">
        <label class="custom-file-label" for="customFile">Choose file</label>
      </div>
      <br><br>
      <button class="btn btn-secondary btn-icon-split">
        <span class="icon text-white-50">
          <i class="fas fa-upload"></i>
        </span>
        <span class="text">Upload</span>
      </button>&nbsp;&nbsp;&nbsp;&nbsp;
      <a href="{{url('/export')}}" class="btn btn-secondary btn-icon-split">
        <span class="icon text-white-50">
          <i class="fas fa-download"></i>
        </span>
        <span class="text">Export</span>
      </a>&nbsp;&nbsp;&nbsp;&nbsp;
    </div>
  </form>
  &nbsp;&nbsp;&nbsp;&nbsp;
  <div class="col">
      <button class="btn btn-primary btn-icon-split" onClick="showform()">
        <span class="icon text-white-50">
          <i class="fas fa-user-plus"></i>
        </span>
        <span class="text">Add Student</span>
      </button><br><br>
      <button class="btn btn-primary btn-icon-split" onClick="showtable()">
        <span class="icon text-white-50">
          <i class="fas fa-eye"></i>
        </span>
        <span class="text">Show Students</span>
      </button>&nbsp;&nbsp;&nbsp;&nbsp;
    </div>
</div>
  <!-- Table Start -->

       <div class="card shadow mb-4" id="tablediv">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dtHorizontalVerticalExample" width="100%" cellspacing="0" style="text-align:center;">
                  <thead>
                    <tr>
                      <th>Enroll</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Mobile No</th>
                      <th>Course</th>
                      <th>Semester</th>
                      <th>View</th>
                      <th>Delete</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Enroll</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Mobile No</th>
                      <th>Course</th>
                      <th>Semester</th>
                      <th>View</th>
                      <th>Delete</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    @foreach ($data as $d)
                    <tr>
                      <td>{{$d->enroll}}</td>
                      <td>{{$d->name}}</td>
                      <td>{{$d->email}}</td>
                      <td>{{$d->Phone_No}}</td>
                      <td>{{$d->course}}</td>
                      <td>{{$d->semester}}</td>
                      <td><a href='{{url("/viewstuddetail/$d->enroll")}}'><img src="{{url('/images/viewmore.png')}}" class="img-responsive" width="30" height="30"></a></td>
                    <td><a onclick="confirmation(event)" href='{{url("/deletestuddetail/$d->enroll")}}'><img src="{{url('/images/delete.png')}}" class="img-responsive" width="30" height="30"></a></td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>

  <form class="" action="{{url('/addsinglestud')}}" method="post" enctype="multipart/form-data" id="form" style="display: none;">
      @csrf
    <div class="col-xl-12 col-lg-8">
        <!-- Card Body -->
        <div class="card-body">
          <div class="chart-area" >
              <div class="form-row" style="padding: 10px;">
                <div class="col">
                  <h2 class="h4 mb-0 text-gray-800"><b>Enrollment</b></h2>
                  <input type="text" class="form-control" name="enroll" placeholder="Enter Enrollment Number">
                </div>
                <div class="col">
                  <h2 class="h4 mb-0 text-gray-800"><b>Name</b></h2>
                  <input type="text" class="form-control" name="Name" placeholder="Enetr Your Name">
                </div>
              </div>
              <hr>
              <div class="form-row" style="padding: 10px;">
                <div class="col">
                  <h2 class="h4 mb-0 text-gray-800"><b>Email</b></h2>
                  <input type="text" class="form-control" name="email" placeholder="Enter Your Email">
                </div>
                <div class="col">
                  <h2 class="h4 mb-0 text-gray-800"><b>Mobile Number</b></h2>
                  <input type="text" class="form-control" name="phone" placeholder="Enter Mobile Number">
                </div>
              </div>
              <hr>
              <div class="form-row" style="padding: 10px;">
                <div class="col">
                  <h2 class="h4 mb-0 text-gray-800"><b>Course</b></h2>
                  <select class="form-control" id="course" name="course" onchange="chcourse(this)">
                    <option  value="">Select Course</option>
                    <option  value="MCA">MCA</option>
                    <option  value="IMCA">IMCA</option>
                  </select>
                </div>
                <div class="col">
                  <h2 class="h4 mb-0 text-gray-800"><b>Semester</b></h2>
                  <select class="form-control" id="sem" name="sem">
                  </select>
                </div>
              </div>
              <hr>
              <button class="btn btn-primary btn-user btn-block" name="btnsubmit"  id="btnsubmit" onClick="return submitResult();">
                  Submit
              </button>
              <hr>
          </div>
      </div>
      </div>
    </form>

        </div>


<!-- Table End -->

</div>

@endsection
      