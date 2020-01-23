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

    <form class="" action="{{url('/addstud')}}" method="post" enctype="multipart/form-data">
      @csrf
    <div class="card-body shadow col-sm-5 mb-4 mb6">
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
      </a>
    </div>
  </form>


  <!-- Table Start -->

       <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dtHorizontalVerticalExample" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Enroll</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Mobile No</th>
                      <th>Course</th>
                      <th>Semester</th>
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
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>


<!-- Table End -->

</div>

@endsection
      