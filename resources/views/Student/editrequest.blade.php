@extends('Student.studlayout')

@section('title','Student - Request Edit')


@section('content')
  
<div class="container-fluid" >

    <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"><b>Your Request</b></h1>
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
<form class="" action="{{url('/updatereq')}}" method="post" enctype="multipart/form-data" id="form">
      @csrf
<div class="row">
    <div class="col-xl-12 col-lg-8">
        <div class="card-body">
              <div class="form-row" style="padding: 10px;">
                <div class="col">
                    <h3 class="h3 mb-0 text-gray-800"><b>Enrollment</b></h3><br>
                    <h4 class="h5 mb-0 text-gray-800"><label>{{$user->enroll}}</label></h3>
                    <hr>
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
                    <input type="text" class="form-control" style="width: 300px;margin-top: -6px; " name="lfeeno" value="{{$data->lfees_no}}">
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
                    <img src="{{url('/images/missing.jpg')}}" class="img-responsive" width="350" height="300"><br>
                    <div class="custom-file" style="width: 300px; margin-bottom: -10px;">
                      <input type="file" class="custom-file-input" name="lfeefile" id="lfeefile">
                      <label class="custom-file-label" for="customFile">Choose file To Update</label>
                    </div>
                </div>
                @else
                  <div class="col">
                    <h2 class="h4 mb-0 text-gray-800"><b>Library Fee Recipt</b></h2><br>
                    <img src="{{url('/images/'.$data['lfees_path'])}}" class="img-responsive" width="300" height="300"><br><br>
                    <div class="custom-file" style="width: 300px; margin-bottom: -10px;">
                      <input type="file" class="custom-file-input" name="lfeefile" id="lfeefile">
                      <label class="custom-file-label" for="customFile">Choose file To Update</label>
                    </div>
                  </div>
                @endif
                @if($data['sem6fee_path'] == NULL)
                  <div class="col">
                    <h2 class="h4 mb-0 text-gray-800"><b>Sem 6 Fee Recipt Not Submited.</b></h2><br>
                    <img src="{{url('/images/missing.jpg')}}" class="img-responsive" width="300" height="300"><br><br>
                    <div class="custom-file" style="width: 300px; margin-bottom: -10px;">
                      <input type="file" class="custom-file-input" name="sem6feefile" id="sem6feefile">
                      <label class="custom-file-label" for="customFile">Choose file To Update</label>
                    </div>
                </div>
                @else
                  <div class="col">
                    <h2 class="h4 mb-0 text-gray-800"><b>Sem 6 Fee Recipt</b></h2><br>
                    <img src="{{url('/images/'.$data['sem6fee_path'])}}" class="img-responsive" width="300" height="300"><br><br>
                    <div class="custom-file" style="width: 300px; margin-bottom: -10px;">
                      <input type="file" class="custom-file-input" name="sem6feefile" id="sem6feefile">
                      <label class="custom-file-label" for="customFile">Choose file To Update</label>
                    </div>
                  </div>
                @endif
                <div class="col">
                    <h2 class="h4 mb-0 text-gray-800"><b>GTU Grade Histroy</b></h2><br>
                    <img src="{{url('/images/'.$data['gtugrade_path'])}}" class="img-responsive" width="300" height="300"><br><br>
                    <div class="custom-file" style="width: 300px; margin-bottom: -10px;">
                      <input type="file" class="custom-file-input" name="gradsfile" id="passbookfile">
                      <label class="custom-file-label" for="customFile">Choose file</label>
                    </div>
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
                    <img src="{{url('/images/'.$data['passbook_path'])}}" class="img-responsive" width="300" height="300"><br><br>
                    <div class="custom-file" style="width: 300px; margin-bottom: -10px;">
                      <input type="file" class="custom-file-input" name="passbookfile" id="sem6feefile">
                      <label class="custom-file-label" for="customFile">Choose file To Update</label>
                    </div>
                </div>
                <div class="col">
                    <h2 class="h4 mb-0 text-gray-800"><b>Cancle Cheque Image</b></h2><br>
                    <img src="{{url('/images/'.$data['cheque_path'])}}" class="img-responsive" width="300" height="300"><br><br>
                    <div class="custom-file" style="width: 300px; margin-bottom: -10px;">
                      <input type="file" class="custom-file-input" name="cancelceqfile" id="cancelceqfile">
                      <label class="custom-file-label" for="customFile">Choose file To Update</label>
                    </div>
                </div>
                <div class="col">
                    
                </div>
              </div><br><br>
              <button class="btn btn-primary btn-user btn-block" name="btnsubmit"  id="btnsubmit">
                  Update
              </button>
      </div>
    </div>
</form>
</div>
</div>

</div>
</div>

@endsection
