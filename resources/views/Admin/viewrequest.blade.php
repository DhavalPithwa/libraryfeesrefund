@extends('Admin.adminlayout')

@section('title','Admin - View Request')


@section('content')
  
<div class="container-fluid" >

    <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"><b>{{$user->name}}'s Request</b></h1>
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
<form class="" action="{{url('/passorrejectreq')}}" method="post" id="form">
      @csrf
<div class="row">
    <div class="col-xl-12 col-lg-8">
        <div class="card-body">
              <div class="form-row" style="padding: 10px;">
                <div class="col">
                    <h3 class="h3 mb-0 text-gray-800"><b>Enrollment</b></h3><br>
                    <h4 class="h5 mb-0 text-gray-800"><label>{{$user->enroll}}</label></h3>
                    <hr>
                    <input type="hidden" name="reqenroll" value="{{$user->enroll}}">
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
                    <h3 class="h3 mb-0 text-gray-800"><b>Library Fee Number</b></h3><br>
                    <h3 class="h5 mb-0 text-gray-800"><label>{{$data->lfees_no}}</label></h3>
                    <hr>
                </div>
                <div class="col">
                    <h3 class="h3 mb-0 text-gray-800"><b>Amount</b></h3><br>
                    <h3 class="h5 mb-0 text-gray-800"><label>{{$data->amount}}</label></h3>
                    <hr>
                </div>
                <div class="col">
                    <h3 class="h3 mb-0 text-gray-800"><b>Status</b></h3><br>
                    @if($data->status == 0)
                      <h3 class="h5 mb-0 text-gray-800"><label>Not Verified</label></h3>
                    @elseif ($data->status == 1)
                      <h3 class="h5 mb-0 text-gray-800"><label>Verified</label></h3>
                      @elseif ($data->status == 2)
                      <h3 class="h5 mb-0 text-gray-800"><label>Under Payment</label></h3>
                      @elseif ($data->status == 3)
                      <h3 class="h5 mb-0 text-gray-800"><label>Rejected</label></h3>
                      @endif
                    <hr>
                </div>
              </div>
      </div>
    </div>

    <div class="col-xl-12 col-lg-8">
        <div class="card-body">
              <div class="form-row" style="padding: 10px;">
                @if($data['lfees_path'] == NULL)
                  <div class="col">
                    <h2 class="h4 mb-0 text-gray-800"><b>Library Fee Recipt Not Submited.</b></h2><br>
                    <img src="{{url('/images/missing.jpg')}}" class="img-responsive" width="350" height="300">
                </div>
                @else
                  <div class="col">
                    <h2 class="h4 mb-0 text-gray-800"><b>Library Fee Recipt</b></h2><br>
                    <img src="{{url('/images/'.$data['lfees_path'])}}" class="img-responsive" width="300" height="300">
                  </div>
                @endif
                @if($data['sem6fee_path'] == NULL)
                  <div class="col">
                    <h2 class="h4 mb-0 text-gray-800"><b>Sem 6 Fee Recipt Not Submited.</b></h2><br>
                    <img src="{{url('/images/missing.jpg')}}" class="img-responsive" width="300" height="300">  
                </div>
                @else
                  <div class="col">
                    <h2 class="h4 mb-0 text-gray-800"><b>Sem 6 Fee Recipt</b></h2><br>
                    <img src="{{url('/images/'.$data['sem6fee_path'])}}" class="img-responsive" width="300" height="300">
                  </div>
                @endif
                <div class="col">
                    <h2 class="h4 mb-0 text-gray-800"><b>GTU Grade Histroy</b></h2><br>
                    <img src="{{url('/images/'.$data['gtugrade_path'])}}" class="img-responsive" width="300" height="300">
                </div>
              </div>
      </div>
    </div>

    <div class="col-xl-12 col-lg-8">
        <div class="card-body">
              <hr>
              <div class="form-row" style="padding: 10px;">
                <div class="col">
                    <h2 class="h4 mb-0 text-gray-800"><b>PassBook Front Page</b></h2><br>
                    <img src="{{url('/images/'.$data['passbook_path'])}}" class="img-responsive" width="300" height="300">
                </div>
                <div class="col">
                    <h2 class="h4 mb-0 text-gray-800"><b>Cancle Cheque Image</b></h2><br>
                    <img src="{{url('/images/'.$data['cheque_path'])}}" class="img-responsive" width="300" height="300">
                </div>
                <div class="col">
                  <br><br><br>
                  @if($data->pendingbook == NULL)
                    <button class="btn btn-danger btn-user btn-block" name="btnsubmit"  id="pedding" onClick="pnddingbook();">
                      Pending Book 
                    </button><br>
                  @else
                      @if($data->pendingbook == "Request Accepted & Amount Deducted.")
                        <h3 class="h3 mb-0 text-gray-800"><b>Amount Deducted Of Pending Books.</b></h3><br> 
                      @else 
                        <h3 class="h3 mb-0 text-gray-800"><b>Pending Book</b></h3><br>
                        <input type="text" class="form-control" style="width: 300px;margin-top: -6px; " name="pendingbook" value="{{$data->pendingbook}}">
                        <hr>
                      @endif
                      <button class="btn btn-danger btn-user btn-block" name="btnsubmit"  id="reject" onClick="elementvisible();">
                      Reject
                      </button><br>
                  @endif
                    <input type="hidden" name="rejectclick" id="rejectclick" value="0">
                    <h3 class="h3 mb-0 text-gray-800" id="h3reason" style="display: none"><b>Reason</b></h3><br>
                    <input type="text" class="form-control" name="reject_reason" id="textreason" style="display: none"><br>
                    <button class="btn btn-primary btn-user btn-block" name="btnsubmit"  id="btnsubmit"
                    onClick="formsubmit();">
                      Submit
                    </button>
                </div>
              </div>
      </div>
    </div>
</form>
</div>
</div>

</div>
</div>

@endsection
