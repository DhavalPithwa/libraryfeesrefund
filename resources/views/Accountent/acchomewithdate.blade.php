@extends('Accountent.acclayout')

@section('title','Accountant - Home')


@section('content')

<!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"><b>Home</b></h1>
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


       <!-- Table Start -->
<form action="{{url('/acceptreqwd')}}" method="post" id="form">
       <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Under Payment Requests</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                	<div class="form-group">
                		<label class="h5 mb-0 text-gray-800">Select Date</label>
		    			<input id="datepicker" width="270" name="date" />
		    		</div>
                  <thead>
                    <tr>
                      <th>Enroll</th>
                      <th>Name</th>
                      <th>Library Fee Number</th>
                      <th>Documents</th>
                      <th>Amount</th>
                      <th>Transaction Id</th>
                      <th>Select</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Enroll</th>
                      <th>Name</th>
                      <th>Library Fee Number</th>
                      <th>Documents</th>
                      <th>Amount</th>
                      <th>Transaction Id</th>
                      <th>Select</th>
                    </tr>
                  </tfoot>
                    @csrf
                  <tbody>
                    @foreach ($updata as $upd)
                    <tr>
                      <td name="requestenroll">{{$upd->enroll}}</td>
                      <td>{{$upd->name}}</td>
                      <td>{{$upd->lfees_no}}</td>
                      @if ($upd->lfees_path == null or $upd->sem6fee_path == null or $upd->passbook_path == null or $upd->cheque_path == null or $upd->gtugrade_path == null)
                      <td>Documents Missing</td>
                      @else 
                      <td>All Documents Submited</td>
                      @endif
                      <td>{{$upd->amount}}</td>
                      <td>
                        <input type="text" class="form-control" name="{{$upd->enroll}}" id="tid" placeholder="Enter Transaction Id For {{$upd->name}}">
                      </td>
                      <td>
            						<label class="container">
            						  <input type="checkbox" name="check[]" value="{{$upd->enroll}}" id="checkboxid" onchange="checkform()">
            						  <span class="checkmark"></span>
            						</label>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table><br>
                <button class="btn btn-primary btn-user" name="btnaccwd"  id="btnaccwd" style="float: right; width: 180px; height: 40px;">
                    	Submit
                </button>
              </div>
            </div>
          </div>
</form>
        </div>


<!-- Table End -->

              
      </div>
      <!-- End of Main Content -->
@endsection
      