@extends('Student.studlayout')

@section('title','Student - Send Request')


@section('content')
  
 <div class="container-fluid" >

    <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"><b>Document Request</b></h1>
          </div>
          <br>
     @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form class="" action="{{url('/docreq')}}" method="post" enctype="multipart/form-data">
      @csrf
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-7">
            <input type="hidden" name="type" id="type" value="0">
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" name="pdffile">
                      <label class="custom-file-label" for="pdffile">Choose PDF file</label>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <select class="form-control" id="userdropdown" name="faculty">
                      <option>Select Faculty</option>
                      @foreach($users as $user)
                      <option>{{ $user->id }}-{{ $user->name }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <button class="btn btn-primary btn-user btn-block" id="add">
                  LOR (Letter of Recommendation)
                </button>
                <button class="btn btn-primary btn-user btn-block" onclick="sendbonfiereq()">
                  Bonafide Certificate Application
                </button>
          </div>
        </div><br>
    </form>

    <div class="card shadow mb-4" >
            <div class="card-header">
              <ul class="nav nav-pills">
                <li class="nav-item">
                  <h4 class="font-weight-bold text-primary" onclick="lor()" style="cursor: pointer; text-decoration: underline;" id="lorh4">LOR Requests</h4>
                </li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <li class="nav-item">
                  <h4 class="font-weight-bold text-primary" onclick="bone()" style="cursor: pointer;" id="bonh4">Bonafide Requests</h4>
                </li>
              </ul>
            </div>
            <div class="card-body" style="display: block;" id="lordiv">
              <div class="table-responsive">
                <table class="table table-bordered" id="lordtHorizontalVerticalExample" width="100%" cellspacing="0" style="text-align:center;">
                  <thead style="widows: 100%;">
                    <tr>
                      <th>Request Id</th>
                      <th>Faculty_Id</th>
                      <th>Status</th>
                      <th>Completedby</th>
                      <th>Paydate</th>
                      <th>Tran_id</th>
                      <th>Amount</th>
                      <th>View</th>
                      <th>Delete</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Request Id</th>
                      <th>Faculty_Id</th>
                      <th>Status</th>
                      <th>Completedby</th>
                      <th>Paydate</th>
                      <th>Tran_id</th>
                      <th>Amount</th>
                      <th>View</th>
                      <th>Delete</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    @foreach ($lordata as $ld)
                    <tr>
                        <td>{{ ($loop->index+1) }}</td>
                        <td>{{$ld->fname}}</td>
                        @if($ld->status == 0)
                          <td>Pending</td>
                        @elseif($ld->status == 1)
                          <td>Approved Go For Payment</td>
                        @elseif($ld->status == 2)
                          <td>Completed</td>
                          <td>{{ $ld->completedby }}</td>
                          <td>{{ $ld->paydate }}</td>
                          <td>{{ $ld->tran_id }}</td>
                          <td>{{ $ld->amount }}</td>
                        @endif
                        <td>Not Requried</td>
                        <td>Not Requried</td>
                        <td>Not Requried</td>
                        <td>Not Requried</td>
                        <td><a href='{{url("/viewdocreqdetail/$ld->enroll/$ld->faculty_id")}}'><img src="{{url('/images/viewmore.png')}}" class="img-responsive" width="30" height="30"></a></td>
                        <td><a onclick="docdelconfirmation(event)" href='{{url("/deletedocdetail/$ld->enroll/$ld->faculty_id")}}'><img src="{{url('/images/delete.png')}}" class="img-responsive" width="30" height="30"></a></td>
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
                      <th>Status</th>
                      <th>Completedby</th>
                      <th>Paydate</th>
                      <th>Tran_id</th>
                      <th>Amount</th>
                      <th>Delete</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Request Id</th>
                      <th>Status</th>
                      <th>Completedby</th>
                      <th>Paydate</th>
                      <th>Tran_id</th>
                      <th>Amount</th>
                      <th>Delete</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    @foreach ($bfdata as $bd)
                    <tr>
                        <td>{{ ($loop->index+1) }}</td>
                        @if($bd->status == 0)
                          <td>Pending</td>
                        @elseif($bd->status == 1)
                          <td>Approved Go For Payment</td>
                        @elseif($bd->status == 2)
                          <td>Completed</td>
                          <td>{{ $bd->completedby }}</td>
                          <td>{{ $bd->paydate }}</td>
                          <td>{{ $bd->tran_id }}</td>
                          <td>{{ $bd->amount }}</td>
                        @endif
                        <td>Not Requried</td>
                        <td>Not Requried</td>
                        <td>Not Requried</td>
                        <td>Not Requried</td>
                        <td><a onclick="docdelconfirmation(event)" href='{{url("/deletedocdetail/$bd->enroll/0")}}'><img src="{{url('/images/delete.png')}}" class="img-responsive" width="30" height="30"></a></td>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>

          </div>

</div>
</div>

<script type="text/javascript">
  
  function sendbonfiereq()
  {
    document.getElementById('type').value = 1;
  }

  function lor()
  {
    document.getElementById('lorh4').style.textDecoration = "underline";
    document.getElementById('bonh4').style.textDecoration = "none";
    document.getElementById('lordiv').style.display = 'block';
    document.getElementById('bondiv').style.display = 'none';
  }

  function bone()
  {
    document.getElementById('lorh4').style.textDecoration = "none";
    document.getElementById('bonh4').style.textDecoration = "underline";
    document.getElementById('lordiv').style.display = 'none';
    document.getElementById('bondiv').style.display = 'block';
  }

  $(document).ready(function() {
      $('#lordtHorizontalVerticalExample').DataTable();
      $('#bfdtHorizontalVerticalExample').DataTable();
  } );

  function docdelconfirmation(ev) {
        ev.preventDefault();
        var urlToRedirect = ev.currentTarget.getAttribute('href'); //use currentTarget because the click may be on the nested i tag and not a tag causing the href to be empty
        swal({
          title: "Delete Request",
          text: "Are you Sure You Want To Delete Request.",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            swal("Request Deleted.", {
              icon: "success",
            });
             window.location.replace(urlToRedirect);
          } else {
            swal("Your Data is Safe.",{icon: "info",});
          }
        });
    }
</script>
@endsection
