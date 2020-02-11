@extends('Admin.adminlayout')

@section('title','Admin - Home')


@section('content')

<!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"><b>Home</b></h1>
          </div>

          <!-- Content Row -->
          <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body" style="cursor: pointer;" onclick="shownvtable();">
                  <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"><h4>Pending Requests</h4></div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{$nvdata->count()}}</div>
                    </div>
                    <div class="col-auto">
                      <br><br>
                      <i class="fas fa-undo-alt fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body" id="underpay" style="cursor: pointer;" onclick="showuptable();">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1"><h4>Under payment Requests</h4></div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{$updata->count()}}</div>
                    </div>
                    <div class="col-auto">
                      <br><br>
                      <i class="fas fa-rupee-sign fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body" id="completed" style="cursor: pointer;" onclick="showcmtable();">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1"><h4>Completed Requests</h4></div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{$cmdata->count()}}</div>
                    </div>
                    <div class="col-auto">
                      <i class="fa-li fa fa-check-square fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

               
            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body" id="rejeted" style="cursor: pointer;" onclick="showrjtable();">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-danger text-uppercase mb-1"><h4>Rejected Requests</h4></div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{$rjdata->count()}}</div>
                    </div>
                    <div class="col-auto">
                      <br><br>
                      <i class="fas fa-window-close fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>


       <!-- Not Varifiled Table -->

       <div class="card shadow mb-4" id="nvtable" style="display: block;">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Not Varifiled Requests</h6>
            </div>
            <div class="card-body">
              <div class="">
                <table class="table table-bordered" id="dtHorizontalVerticalExample" width="100%" cellspacing="0" style="text-align:center;">
                  <thead style="widows: 100%;">
                    <tr>
                      <th>Request Id</th>
                      <th>Enroll</th>
                      <th>Name</th>
                      <th>Library Fee Number</th>
                      <th>Documents</th>
                      <th>Amount</th>
                      <th>View</th>
                      <th>Delete</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Request Id</th>
                      <th>Enroll</th>
                      <th>Name</th>
                      <th>Library Fee Number</th>
                      <th>Documents</th>
                      <th>Amount</th>
                      <th>View</th>
                      <th>Delete</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    @foreach ($nvdata as $nvd)
                    <tr>
                      <td>{{$nvd->Req_id}}</td>
                      <td>{{$nvd->enroll}}</td>
                      <td>{{$nvd->name}}</td>
                      <td>{{$nvd->lfees_no}}</td>
                      @if ($nvd->lfees_path == null or $nvd->sem6fee_path == null or $nvd->passbook_path == null or $nvd->cheque_path == null or $nvd->gtugrade_path == null)
                      <td>Documents Missing</td>
                      @else 
                      <td>All Documents Submited</td>
                      @endif
                      @if($nvd->reason == "Student Need To Pay Us")
                      <td>Student Penalty : {{$nvd->amount}}</td>
                      @else
                      <td>{{$nvd->amount}}</td>
                      @endif
                      <td><a href='{{url("/viewreqdetail/$nvd->enroll")}}'><img src="{{url('/images/viewmore.png')}}" class="img-responsive" width="30" height="30"></a></td>
                    <td><a onclick="confirmation(event)" href='{{url("/deletedetail/$nvd->enroll")}}'><img src="{{url('/images/delete.png')}}" class="img-responsive" width="30" height="30"></a></td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>


        <div class="card shadow mb-4" id="cmtable" style="display: none;">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Completed Requests</h6>
            </div>
            <div class="card-body">
              <div class="">
                <table class="table table-bordered" id="cmdtHorizontalVerticalExample" width="100%" cellspacing="0" style="text-align:center;">
                  <thead>
                    <tr>
                      <th>Request Id</th>
                      <th>Enroll</th>
                      <th>Name</th>
                      <th>Library Fee Number</th>
                      <th>Documents</th>
                      <th>Transaction Id</th>
                      <th>Completed By</th>
                      <th>Amount</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Request Id</th>
                      <th>Enroll</th>
                      <th>Name</th>
                      <th>Library Fee Number</th>
                      <th>Documents</th>
                      <th>Transaction Id</th>
                      <th>Completed By</th>
                      <th>Amount</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    @foreach ($cmdata as $cmd)
                    <tr>
                      <td>{{$cmd->Req_id}}</td>
                      <td>{{$cmd->enroll}}</td>
                      <td>{{$cmd->name}}</td>
                      <td>{{$cmd->lfees_no}}</td>
                      @if ($cmd->lfees_path == null or $cmd->sem6fee_path == null or $cmd->passbook_path == null or $cmd->cheque_path == null or $cmd->gtugrade_path == null)
                      <td>Documents Missing</td>
                      @else 
                      <td>All Documents Submited</td>
                      @endif
                      @if($cmd->tran_id == null)
                      <td>Not Given</td>
                      @else
                      <td>{{$cmd->tran_id}}</td>
                      @endif
                      <td>{{$cmd->completedby}}</td>
                      <td>{{$cmd->amount}}</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>


          <div class="card shadow mb-4" id="uptable" style="display: none;">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Under Payment Requests</h6>
            </div>
            <div class="card-body">
              <div class="">
                <table class="table table-bordered" id="updtHorizontalVerticalExample" width="100%" cellspacing="0" style="text-align:center;">
                  <thead>
                    <tr>
                      <th>Request Id</th>
                      <th>Enroll</th>
                      <th>Name</th>
                      <th>Library Fee Number</th>
                      <th>Documents</th>
                      <th>Amount</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Request Id</th>
                      <th>Enroll</th>
                      <th>Name</th>
                      <th>Library Fee Number</th>
                      <th>Documents</th>
                      <th>Amount</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    @foreach ($updata as $upd)
                    <tr>
                      <td>{{$upd->Req_id}}</td>
                      <td>{{$upd->enroll}}</td>
                      <td>{{$upd->name}}</td>
                      <td>{{$upd->lfees_no}}</td>
                      @if ($upd->lfees_path == null or $upd->sem6fee_path == null or $upd->passbook_path == null or $upd->cheque_path == null or $upd->gtugrade_path == null)
                      <td>Documents Missing</td>
                      @else 
                      <td>All Documents Submited</td>
                      @endif
                      <td>{{$upd->amount}}</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>

          <div class="card shadow mb-4" id="rjtable" style="display: none;">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Rejected Requests</h6>
            </div>
            <div class="card-body">
              <div class="">
                <table class="table table-bordered" id="rjdtHorizontalVerticalExample" width="100%" cellspacing="0" style="text-align:center;">
                  <thead>
                    <tr>
                      <th>Request Id</th>
                      <th>Enroll</th>
                      <th>Name</th>
                      <th>Library Fee Number</th>
                      <th>Documents</th>
                      <th>Reason</th>
                      <th>Amount</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Request Id</th>
                      <th>Enroll</th>
                      <th>Name</th>
                      <th>Library Fee Number</th>
                      <th>Documents</th>
                      <th>Reason</th>
                      <th>Amount</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    @foreach ($rjdata as $rjd)
                    <tr>
                      <td>{{$rjd->Req_id}}</td>
                      <td>{{$rjd->enroll}}</td>
                      <td>{{$rjd->name}}</td>
                      <td>{{$rjd->lfees_no}}</td>
                      @if ($rjd->lfees_path == null or $rjd->sem6fee_path == null or $rjd->passbook_path == null or $rjd->cheque_path == null or $rjd->gtugrade_path == null)
                      <td>Documents Missing</td>
                      @else 
                      <td>All Documents Submited</td>
                      @endif
                      <td>{{$rjd->reason}}</td>
                      @if($rjd->reason == "Student Need To Pay Us")
                      <td>Student Penalty : {{$rjd->amount}}</td>
                      @else
                      <td>{{$rjd->amount}}</td>
                      @endif
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
      <!-- End of Main Content -->
@endsection
      