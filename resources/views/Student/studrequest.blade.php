@extends('Student.studlayout')

@section('title','Student - Send Request')


@section('content')
  
 <div class="container" >

    <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"><b>Send Request</b></h1>
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

    <form class="" action="{{url('/sendreq')}}" method="post" enctype="multipart/form-data" id="form">
      @csrf
    <div class="col-xl-12 col-lg-8">
        <!-- Card Body -->
        <div class="card-body">
          <div class="chart-area" >
               <div class="form-row" style="padding: 10px;">
                <div class="col">
                  <h2 class="h4 mb-0 text-gray-800"><b>Library Fee Recipt Number</b></h2>
                  <input type="text" class="form-control" name="lfeeno" placeholder="Library fee Recipt Number">
                </div>
                <div class="col">
                  <h2 class="h4 mb-0 text-gray-800"><b>Library Fee Recipt Image</b></h2>
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" name="lfeefile" id="lfeefile">
                    <label class="custom-file-label" for="customFile">Choose file</label>
                  </div>
                </div>
              </div>
              <hr>
              <div class="form-row" style="padding: 10px;">
                <div class="col">
                  <h2 class="h4 mb-0 text-gray-800"><b>SEM-6 FEE Recipt Image</b></h2>
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" name="sem6feefile" id="sem6feefile">
                    <label class="custom-file-label" for="customFile">Choose file</label>
                  </div>
                </div>
                <div class="col">
                  <h2 class="h4 mb-0 text-gray-800"><b>Graduate Histroy Image</b></h2>
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" name="gradsfile">
                    <label class="custom-file-label" for="customFile">Choose file</label>
                  </div>
                </div>
              </div>
              <hr>
              <div class="form-row" style="padding: 10px;">
                <div class="col">
                  <h2 class="h4 mb-0 text-gray-800"><b>First Page Of PassBook Image</b></h2>
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" name="passbookfile">
                    <label class="custom-file-label" for="customFile">Choose file</label>
                  </div>
                </div>
                <div class="col">
                  <h2 class="h4 mb-0 text-gray-800"><b>Cancel Cheque Image</b></h2>
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" name="cancelceqfile">
                    <label class="custom-file-label" for="customFile">Choose file</label>
                  </div>
                </div>
              </div>
              <hr>
              <div class="form-row" style="padding: 10px;">
                <div class="col">
                  <h2 class="h4 mb-0 text-gray-800"><b>Amount</b></h2>
                  <input type="text" class="form-control" name="amt" id="amt" placeholder="Your mount">
                </div>
                <div class="col" style="padding-top: 28px;">
                  <button class="btn btn-primary btn-user btn-block" name="submit"  id="submit">
                  Submit
                  </button>
                  <!-- onClick="return submitResult();" -->
                </div>
              </div>
              <hr>
              in
          </div>
      </div>
      </div>
    </form>
 </div>
</div>

@endsection
