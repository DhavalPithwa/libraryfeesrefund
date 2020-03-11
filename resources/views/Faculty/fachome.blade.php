@extends('Faculty.faclayout')

@section('title','Faculty - Home')


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
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Under Payment Requests</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="text-align: center;">
                  <thead>
                    <tr>
                      <th>Request Id</th>
                      <th>Enroll</th>
                      <th>Student Name</th>
                      <th>Status</th>
                      <th>View</th>
                      <th>Approved</th>
                      <th>Reject</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Request Id</th>
                      <th>Enroll</th>
                      <th>Student Name</th>
                      <th>Status</th>
                      <th>View</th>
                      <th>Approved</th>
                      <th>Reject</th>
                    </tr>
                  </tfoot>
                    @csrf
                  <tbody>
                    @foreach ($data as $ld)
                    <tr>
                        <td>{{ ($loop->index+1) }}</td>
                        <td>{{ $ld->enroll }}</td>
                        <td>{{ $ld->sname }}</td>
                        @if($ld->status == 0)
                          <td>Pending</td>
                        @elseif($ld->status == 1)
                          <td>Approved Go For Payment</td>
                        @elseif($ld->status == 2)
                          <td>Completed</td>
                        @endif
                        <td><a href='{{url("/viewdocfreqdetail/$ld->enroll/$ld->faculty_id")}}'><img src="{{url('/images/viewmore.png')}}" class="img-responsive" width="30" height="30"></a></td>
                        <td><a href='{{url("/docreqstatus/$ld->enroll/$ld->faculty_id/1")}}'><img src="{{url('/images/docapproved.svg')}}" class="img-responsive" width="30" height="30"></a></td>
                        <td><a href='{{url("/docreqstatus/$ld->enroll/$ld->faculty_id/3")}}'><img src="{{url('/images/docreject.svg')}}" class="img-responsive" width="30" height="30"></a></td>
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
      