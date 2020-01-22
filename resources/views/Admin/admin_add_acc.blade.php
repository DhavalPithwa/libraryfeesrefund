@extends('Admin.adminlayout')

@section('title','Admin - Add Accountant')


@section('content')
  
  <div class="container" >

    <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"><b>Add Accountant</b></h1>
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

      <form class="" action="{{url('/addacc')}}" method="post">
      @csrf
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-7">
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user" name="name" placeholder="First Name">
                  </div>
                  <div class="col-sm-6">
                    <input type="text" class="form-control form-control-user" name="number" placeholder="Mobile Number">
                  </div>
                </div>
                <div class="form-group">
                  <input type="email" class="form-control form-control-user" name="email" placeholder="Email Address">
                </div>
                <button class="btn btn-primary btn-user btn-block">
                  Add
                </button>
          </div>
        </div><br>
  </form>

  <!-- Table Start -->

       <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Mobile No</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>ID</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Mobile No</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    @foreach ($data as $d)
                    <tr>
                      <td>{{$d->id}}</td>
                      <td>{{$d->name}}</td>
                      <td>{{$d->email}}</td>
                      <td>{{$d->phone_no}}</td>
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
      