@extends('Student.studlayout')

@section('title','Student - Home')


@section('content')

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
                      @if ($data['status'] == 2)
                      <th>Reason</th>
                      @elseif ($data['status'] == 3)
                      <th>Transaction Id</th>
                      @else
                      <th>Edit</th>
                      @endif
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>{{$data['enroll']}}</td>
                      <td>{{$data['lfees_no']}}</td>
                      @if($data['status'] == 0)
                        <td>Not Verified</td>
                      @elseif ($data['status'] == 1)
                        <td>Under Payment</td>
                      @elseif ($data['status'] == 2)
                        <td>Rejetced</td>
                      @elseif ($data['status'] == 3)
                        <td>Complete</td>
                      @endif
                      @if($data['reason'] == "Student Need To Pay Us")
                      <td>Student Penalty : {{$data['amount']}}</td>
                      @else
                      <td>{{$data['amount']}}</td>
                      @endif
                      @if($data['status'] == 0)
                        <td>
                          <a href="{{url('/editreq')}}" class="btn btn-primary btn-icon-split">
                          <span class="icon text-white-50">
                            <i class="fas fa-edit"></i>
                          </span>
                          <span class="text">Edit Request</span>
                          </a>
                        </td>
                      @elseif ($data['status'] == 2)
                        <td>{{$data['reason']}}</td>
                      @elseif ($data['status'] == 3)
                        @if($data['tran_id'] == null)
                          <td>Not Given</td>
                        @else
                          <td>{{$data['tran_id']}}</td>
                        @endif
                      @else
                        <td>Request Can't Editable.<b>Contact To Admin.</b></td>
                      @endif
                    </tr>
                  </tbody>
                </table>

                @if($data->pendingbook != NULL)
                <table class="table table-bordered" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Pending Book</th>
                      @if($data->pendingbook != "Request Accepted & Amount Deducted.")
                      <th style="text-align:center;">React</th>
                      @endif
                    </tr>
                  </thead>  
                  <tbody>
                    <tr>
                      @if($data['reason'] == "Student Need To Pay Us")
                      <td>{{$data->reason}} :- {{$data['amount']}} INR</td>
                      @else
                      <td>{{$data->pendingbook}}</td>
                      @endif
                      @if($data->pendingbook != "Request Accepted & Amount Deducted.")
                      <td style="text-align:center;">
                        <a onclick="confirmation(event)" href="/studaccept/{{$data['enroll']}}">
                          <button class="btn btn-primary btn-user" name="btnsubmit"  id="btnsubmit" style="width: 110px; ">
                              Accept
                          </button>
                        </a>
                      </td>
                      @endif
                    </tr>
                  </tbody>
                </table>
                @endif


                <table class="table table-bordered" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      @if($data['lfees_path'] == NULL)
                        <th>Library Fee Recipt Not Submited.</th>
                      @else
                        <th>Library Fee Recipt</th>
                      @endif
                      @if($data['sem6fee_path'] == NULL)
                        <th>Sem 6 Fee Recipt Not Submited.</th>
                      @else
                        <th>Sem 6 Fee Recipt</th>
                      @endif
                      <th>GTU Grade Histroy</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                    @if($data['lfees_path'] == NULL)
                      <td><img src="{{url('/images/missing.jpg')}}" class="img-responsive" width="300" height="300"></td>
                    @else
                      <td><img src="{{url('/images/'.$data['lfees_path'])}}" class="img-responsive" width="300" height="300"></td>
                    @endif
                    @if($data['sem6fee_path'] == NULL)
                      <td><img src="{{url('/images/missing.jpg')}}" class="img-responsive" width="300" height="300"></td>
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
      