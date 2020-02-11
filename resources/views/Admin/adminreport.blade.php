@extends('Admin.adminlayout')

@section('title','Admin - Report')


@section('content')

<!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"><b>Statistical Data</b></h1>
          </div>
          <!-- <form action="{{url('/chnagedaterept')}}" method="post" id="form"> -->
              @csrf
              <div class="row">
                  <div class="col-xl-12 col-lg-8">
                      <div class="">
                            <div class="form-row" style="padding: 10px;">
          <div class="col">
              <h3 class="h3 mb-0 text-gray-800"><b>Selected Month</b></h3><br>
              <h4 class="h5 mb-0 text-gray-800"><label>{{$month}}</label></h3>
          </div>
          <div class="col">
              <h3 class="h3 mb-0 text-gray-800"><b>Selected Year</b></h3><br>
              <h4 class="h5 mb-0 text-gray-800"><label>{{$year}}</label></h3>
          </div>
          <div class="col">
              <select class="form-control" id="year" name="year" style="font-size: 20px; width: 245px; background: #4e73df; border-color: #4e73df; color: white;">
              </select>
          </div>
          <div class="col">
              <select class="form-control" id="year" name="year" style="font-size: 20px; width: 245px; background: #4e73df; border-color: #4e73df; color: white;" onchange="f1(this)">
                <option  value="">Select Month</option>
                <option  value="01">January</option>
                <option  value="02">February</option>
                <option  value="03">March</option>
                <option  value="04">April</option>
                <option  value="05">May</option>
                <option  value="06">June</option>
                <option  value="07">July</option>
                <option  value="08">August</option>
                <option  value="09">September</option>
                <option  value="10">Octomber</option>
                <option  value="11">November</option>
                <option  value="12">December</option>
              </select>
         </div>
    
                    </div>
                  </div>
              </div>
            </div>
              <input type="hidden" name="month" id="month"> 
          <!-- </form> -->
          <hr>
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
      @if($nvdata->count() > 0)
      <a href='{{url("/nvexport/$month/$year")}}' class="btn btn-secondary btn-icon-split" style="float: right;">
        <span class="icon text-white-50">
          <i class="fas fa-download"></i>
        </span>
        <span class="text">Export</span>
      </a>
      @endif
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
                      <td>{{$nvd->amount}}</td>
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
      @if($cmdata->count() > 0)
      <a href='{{url("/cmexport/$month/$year")}}' class="btn btn-secondary btn-icon-split" style="float: right;">
        <span class="icon text-white-50">
          <i class="fas fa-download"></i>
        </span>
        <span class="text">Export</span>
      </a>
      @endif
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
      @if($updata->count() > 0)
      <a href='{{url("/upexport/$month/$year")}}' class="btn btn-secondary btn-icon-split" style="float: right;">
        <span class="icon text-white-50">
          <i class="fas fa-download"></i>
        </span>
        <span class="text">Export</span>
      </a>
      @endif
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
      @if($rjdata->count() > 0)
      <a href='{{url("/rjexport/$month/$year")}}' class="btn btn-secondary btn-icon-split" style="float: right;">
        <span class="icon text-white-50">
          <i class="fas fa-download"></i>
        </span>
        <span class="text">Export</span>
      </a>
      @endif
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
      <script type="text/javascript">
        var start = new Date().getFullYear();;
        var end = 2015;
        var options = "";
        for(var year = start ; year >= end; year--){
          options += "<option>"+ year +"</option>";
        }
        document.getElementById("year").innerHTML = options;
      </script>
      <!-- End of Main Content -->
@endsection
      