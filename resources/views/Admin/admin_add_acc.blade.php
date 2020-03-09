@extends('Admin.adminlayout')

@section('title','Admin - Add Authorities')


@section('content')
  <style type="text/css">
    img:hover{
      cursor: pointer;
    }
  </style>
  <div class="container-fluid" >

    <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"><b>Add Authorities</b></h1>
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

      <form class="" action="{{url('/adduser')}}" method="post">
      @csrf
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-7">
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="hidden" name="userid" id="accid">
                    <input type="text" class="form-control form-control-user" name="name" placeholder="Enter Name" id="name" value="{{ old('name') }}">
                  </div>
                  <div class="col-sm-6">
                    <input type="text" class="form-control form-control-user" name="number" placeholder="Mobile Number" id="number" value="{{ old('number') }}">
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-6">
                    <input type="email" class="form-control form-control-user" name="email" placeholder="Email Address" id="email" value="{{ old('email') }}">
                  </div>
                  <div class="col-sm-6">
                    <select class="form-control" id="userdropdown" name="role">
                      <option>Select Role</option>
                      <option>Accountant</option>
                      <option>Librarian</option>
                      <option>Faculty</option>
                    </select>
                  </div>
                </div>
                <button class="btn btn-primary btn-user btn-block" id="add">
                  Add
                </button>
                <button class="btn btn-primary btn-user btn-block" style="display: none;" id="update">
                  Update
                </button>
          </div>
        </div><br>
  </form>

  <!-- Table Start -->

       <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Accountant Data</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dtHorizontalVerticalExample" width="100%" cellspacing="0"style="text-align:center;">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Role</th>
                      <th>Mobile No</th>
                      <th>View</th>
                      <th>Delete</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>ID</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Role</th>
                      <th>Mobile No</th>
                      <th>View</th>
                      <th>Delete</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    @foreach ($data as $d)
                    <tr>
                      <td>{{$d->id}}</td>
                      <td>{{$d->name}}</td>
                      <td>{{$d->email}}</td>
                      @if($d->type == 1)
                      <td>Accountant</td>
                      @elseif($d->type == 2)
                      <td>Librarian</td>
                      @else
                      <td>Faculty</td>
                      @endif
                      <td>{{$d->phone_no}}</td>
                      <td>
                        <img src="{{url('/images/viewmore.png')}}" class="img-responsive" width="30" height="30" onclick="edituser({{$d}})">
                      </td>
                      <td>
                        <a onclick="confirmation(event)" href='{{url("/deleteaccdetail/$d->id")}}'><img src="{{url('/images/delete.png')}}" class="img-responsive" width="30" height="30"></a>
                      </td>
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
      