@extends('Accountent.acclayout')

@section('title','Accountant - Home')


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
<form action="{{url('/acceptreq')}}" method="post" id="form">
       <div class="card shadow mb-4">
            <div class="card-header">
              <ul class="nav nav-pills">
                <li class="nav-item">
                  <h4 class="font-weight-bold text-primary" onclick="lor()" style="cursor: pointer; text-decoration: underline;" id="lorh4">Library Fee Refund Requests </h4>
                </li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <li class="nav-item">
                  <h4 class="font-weight-bold text-primary" onclick="lor()" style="cursor: pointer; text-decoration: underline;" id="lorh4">LOR Requests</h4>
                </li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <li class="nav-item">
                  <h4 class="font-weight-bold text-primary" onclick="bone()" style="cursor: pointer;" id="bonh4">Bonafide Requests</h4>
                </li>
              </ul>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Enroll</th>
                      <th>Name</th>
                      <th>Library Fee Number</th>
                      <th>Documents</th>
                      <th>Amount</th>
                      <th id="head">Accept</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Enroll</th>
                      <th>Name</th>
                      <th>Library Fee Number</th>
                      <th>Documents</th>
                      <th>Amount</th>
                      <th id="foot">Accept</th>
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
                        <button class="btn btn-primary btn-user btn-block" name="btnacc"  id="btnacc" onClick="seetrid({{$upd->enroll}});">
                        Accept
                        </button>
                        
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                  
                </table>
              </div>
            </div>
          </div>
          <input type="hidden" name="trid" id="tid" value="0">
          <input type="hidden" name="enroll" id="enroll" value="0">
</form>
        </div>


<!-- Table End -->

              
      </div>
      <!-- End of Main Content -->
@endsection
      