@extends('Student.studlayout')

@section('title','Student - Home')


@section('content')

<!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"><b>Home</b></h1>
          </div>

          <!-- Content Row -->
          <div class="row">

             
            
          </div>


       <!-- Table Start -->
@if ($data)
       <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Your Request</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Enrollment</th>
                      <th>Library Fee Recipt No</th>
                      <th>Status</th>
                      <th>Amount</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>{{$data['enroll']}}</td>
                      <td>{{$data['lfees_no']}}</td>
                      @if($data['status'] == 0)
                      <td>Not Verified</td>
                      @elseif ($data['status'] == 1)
                      <td>Verified</td>
                      @elseif ($data['status'] == 2)
                      <td>Under Payment</td>
                      @elseif ($data['status'] == 3)
                      <td>Rejected</td>
                      @endif
                      <td>{{$data['amount']}}</td>
                    </tr>
                  </tbody>
                </table>
                <table class="table table-bordered" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Library Fee Recipt</th>
                      <th>Sem 6 Fee Recipt</th>
                      <th>GTU Grade Histroy</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                    @if($data['lfees_path'] == NULL)
                      <td><img src="{{url('/images/missing.png')}}" class="img-responsive" width="300" height="300"></td>
                    @else
                      <td><img src="{{url('/images/'.$data['lfees_path'])}}" class="img-responsive" width="300" height="300"></td>
                    @endif
                    @if($data['sem6fee_path'] == NULL)
                      <td><img src="{{url('/images/missing.png')}}" class="img-responsive" width="300" height="300"></td>
                    @else
                      <td><img src="{{url('/images/'.$data['sem6fee_path'])}}" class="img-responsive" width="300" height="300"></td>
                    @endif
                      <td><img src="{{url('/images/'.$data['gtugrade_path'])}}" class="img-responsive" width="300" height="300"></td>
                    </tr>
                    <thead>
                    <tr>
                      <th>PassBook Front Page</th>
                      <th>Cancle Cheque Image</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td><img src="{{url('/images/'.$data['passbook_path'])}}" class="img-responsive" width="300" height="300"></td>
                      <td><img src="{{url('/images/'.$data['cheque_path'])}}" class="img-responsive" width="300" height="300"></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

    <div class="row">
    <div class="col-xl-12 col-lg-8">
        <div class="card-body mb-4">
              <div class="form-row" style="padding: 10px;">
                @if($data['lfees_path'] == NULL)
                  <div class="col">
                    <h2 class="h4 mb-0 text-gray-800"><b>Library Fee Recipt Not Submited.</b></h2><br>
                    <img src="{{url('/images/missing.png')}}" class="img-responsive" width="250" height="300">
                </div>
                @else
                  <div class="col">
                    <h2 class="h4 mb-0 text-gray-800"><b>Library Fee Recipt</b></h2><br>
                    <img src="{{url('/images/'.$data['lfees_path'])}}" class="img-responsive" width="250" height="300">
                  </div>
                @endif
                @if($data['sem6fee_path'] == NULL)
                  <div class="col">
                    <h2 class="h4 mb-0 text-gray-800"><b>Sem 6 Fee Recipt Not Submited.</b></h2><br>
                    <img src="{{url('/images/missing.png')}}" class="img-responsive" width="250" height="300">
                </div>
                @else
                  <div class="col">
                    <h2 class="h4 mb-0 text-gray-800"><b>Sem 6 Fee Recipt</b></h2><br>
                    <img src="{{url('/images/'.$data['sem6fee_path'])}}" class="img-responsive" width="250" height="300">
                </div>
                @endif
                <div class="col">
                    <h2 class="h4 mb-0 text-gray-800"><b>GTU Grade Histroy</b></h2><br>
                    <img src="{{url('/images/'.$data['gtugrade_path'])}}" class="img-responsive" width="250" height="300">
                </div>
              </div>
              <hr>
              <div class="form-row" style="padding: 10px;">
                <div class="col">
                    <h2 class="h4 mb-0 text-gray-800"><b>PassBook Front Page</b></h2><br>
                    <img src="{{url('/images/'.$data['passbook_path'])}}" class="img-responsive" width="250" height="300">
                </div>
                <div class="col">
                    <h2 class="h4 mb-0 text-gray-800"><b>Cancle Cheque Image</b></h2><br>
                    <img src="{{url('/images/'.$data['cheque_path'])}}" class="img-responsive" width="250" height="300">
                </div>
                <div class="col">
              
                </div>
              </div>
          </div>
      </div>
      </div>
</div>
@else
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800"><b>You Don't Have Any Request.</b></h1>
  </div>
@endif
        </div>


<!-- Table End -->

              
      </div>
      <!-- End of Main Content -->
@endsection
      