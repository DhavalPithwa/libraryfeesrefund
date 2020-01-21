@extends('Student.studlayout')

@section('title','Student - Send Request')


@section('content')
  
 <div class="container" >

    <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Send Request</h1>
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

    <form class="" action="{{url('/chnagepass')}}" method="post">
    <div class="col-xl-6 col-lg-9">
      <div class="card shadow mb-4">
        <!-- Card Body -->
        <div class="card-body">
          <div class="chart-area">
              
                @csrf
                <div class="form-group">
                  <div class="form-group">
                    <h2 class="h3 mb-0 text-gray-800"><b>Current Password</b></h2>
                    <input type="password" class="form-control form-control-user" name="cpass" placeholder="Enter Password">
                </div>
                   
          </div>
        </div>
      </div>
    </div>
</form>
</div>
</div>

@endsection
