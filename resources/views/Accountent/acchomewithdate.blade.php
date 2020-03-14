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
<form action="{{url('/acceptreqwd')}}" method="post" id="form" autocomplete="off">
       <div class="card shadow mb-4">
            <div class="card-header py-3">
              <ul class="nav nav-pills">
                <li class="nav-item">
                  <h4 class="font-weight-bold text-primary" onclick="lfr()" style="cursor: pointer; text-decoration: underline;" id="lfrh4">Library Fee Refund Requests({{ count($updata) }})</h4>
                </li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <li class="nav-item">
                  <h4 class="font-weight-bold text-primary" onclick="lor()" style="cursor: pointer;" id="lorh4">LOR Requests({{ count($lordata) }})</h4>
                </li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <li class="nav-item">
                  <h4 class="font-weight-bold text-primary" onclick="bone()" style="cursor: pointer;" id="bonh4">Bonafide Requests({{ count($bfdata) }})</h4>
                </li>
              </ul>
            </div>
            <div class="row" style="margin-left: 15px; margin-top: 15px;">
                <input id="datepicker" width="270" name="date" placeholder="Select Date"/> &nbsp;&nbsp;&nbsp;&nbsp;
                <button class="btn btn-info" name="btnaccwd"  id="btnaccwd">
                      <b> Payment Done </b>
                      <img src="{{url('/images/payment.svg')}}" class="img-responsive" width="30" height="30">
                </button>
            </div>
            <div class="card-body" id="lfrdiv">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
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
                        <input type="text" class="form-control" name="lfr-{{$upd->enroll}}" id="tid" placeholder="Enter Transaction Id For {{$upd->name}}">
                      </td>
                      <td>
            						<label class="container">
            						  <input type="checkbox" name="lfr-check[]" value="{{$upd->enroll}}" id="checkboxid" onchange="checkform()">
            						  <span class="checkmark"></span>
            						</label>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>

            <div class="card-body" style="display: none;" id="lordiv">
              <div class="table-responsive">
                <table class="table table-bordered" id="lordtHorizontalVerticalExample" width="100%" cellspacing="0" style="text-align:center;">
                  <thead style="widows: 100%;">
                    <tr>
                      <th>Request Id</th>
                      <th>Enrollment</th>
                      <th>Name</th>
                      <th>Faculty</th>
                      <th>Transaction Id</th>
                      <th>Amount</th>
                      <th>Select</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Request Id</th>
                      <th>Enrollment</th>
                      <th>Faculty</th>
                      <th>Transaction Id</th>
                      <th>Amount</th>
                      <th>Select</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    @foreach ($lordata as $ld)
                    <tr>
                        <td>{{ ($loop->index+1) }}</td>
                        <td>{{ $ld->enroll }}</td>
                        <td>{{ $ld->name }}</td>
                        <td>{{$ld->fname}}</td>
                        <td>
                          <input type="text" class="form-control" name="lor-{{$ld->enroll}}" id="tid" placeholder="  Enter Transaction Id For {{$ld->name}}">
                        </td>
                        <td>
                          <input type="number" min="0" class="form-control" name="loramt-{{$ld->enroll}}" id="amt" placeholder="  Enter Amount For {{$ld->name}}">
                        </td>
                        <td>
                          <label class="container">
                            <input type="checkbox" name="lor-check[]" value="{{$ld->enroll}}-{{$ld->faculty_id}}" id="checkboxid" onchange="checkform()">
                            <span class="checkmark"></span>
                          </label>
                        </td>
                        @endforeach
                  </tbody>
                </table>
              </div>
            </div>

            <div class="card-body" style="display: none;" id="bondiv">
              <div class="table-responsive">
                <table class="table table-bordered" id="bfdtHorizontalVerticalExample" width="100%" cellspacing="0" style="text-align:center;">
                  <thead style="widows: 100%;">
                    <tr>
                      <th>Request Id</th>
                      <th>Enrollment</th>
                      <th>Name</th>
                      <th>BonafiedFile</th>
                      <th>Transaction Id</th>
                      <th>Amount</th>
                      <th>Select</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Request Id</th>
                      <th>Enrollment</th>
                      <th>BonafiedFile</th>
                      <th>Transaction Id</th>
                      <th>Amount</th>
                      <th>Select</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    @foreach ($bfdata as $bd)
                    <tr>
                        <td>{{ ($loop->index+1) }}</td>
                        <td>{{ $bd->enroll }}</td>
                        <td>{{ $bd->name }}</td>
                        <td>
                          <a style="color: gray;" href="{{url('/pdffiles/'.$bd->bonafiepdf_path)}}">{{ $bd->bonafiepdf_path }}</a>
                        </td>
                        <td>
                          <input type="text" class="form-control" name="bof-{{$bd->enroll}}" id="tid" placeholder="Enter Transaction Id For {{$bd->name}}">
                        </td>
                        <td>
                          <input type="number" min="0" class="form-control" name="bofamt-{{$bd->enroll}}" id="amt" placeholder="  Enter Amount For {{$bd->name}}">
                        </td>
                        <td>
                          <label class="container">
                            <input type="checkbox" name="bof-check[]" value="{{$bd->enroll}}" id="checkboxid" onchange="checkform()">
                            <span class="checkmark"></span>
                          </label>
                        </td>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>

          </div>
</form>
        </div>


<!-- Table End -->

              
      </div>
      <!-- End of Main Content -->

<script type="text/javascript">

  $(document).ready(function() {
      $('#lordtHorizontalVerticalExample').DataTable();
      $('#bfdtHorizontalVerticalExample').DataTable();
  } );
  
  function lfr()
  {
    document.getElementById('lfrh4').style.textDecoration = "underline";
    document.getElementById('lorh4').style.textDecoration = "none";
    document.getElementById('bonh4').style.textDecoration = "none";
    document.getElementById('lfrdiv').style.display = 'block';
    document.getElementById('lordiv').style.display = 'none';
    document.getElementById('bondiv').style.display = 'none';
  }

  function lor()
  {
    document.getElementById('lfrh4').style.textDecoration = "none";
    document.getElementById('lorh4').style.textDecoration = "underline";
    document.getElementById('bonh4').style.textDecoration = "none";
    document.getElementById('lfrdiv').style.display = 'none';
    document.getElementById('lordiv').style.display = 'block';
    document.getElementById('bondiv').style.display = 'none';
  }

  function bone()
  {
    document.getElementById('lfrh4').style.textDecoration = "none";
    document.getElementById('lorh4').style.textDecoration = "none";
    document.getElementById('bonh4').style.textDecoration = "underline";
    document.getElementById('lfrdiv').style.display = 'none';
    document.getElementById('lordiv').style.display = 'none';
    document.getElementById('bondiv').style.display = 'block';
  }

  function lorbtn()
  {
    alert('lor payment');
  }

  function bonebtn()
  {
    alert('bonefied payment');
  }
</script>

@endsection
      