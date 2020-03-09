@extends('Student.studlayout')

@section('title','Student - View Request')


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
                      <h3 class="h3 mb-0 text-gray-800"><b>Faculty</b></h3><br>
                      <h3 class="h5 mb-0 text-gray-800"><label>{{$data->fname}}</label></h3>
                      <hr>
                  </div>
                </div>
          </div>
      </div>
  </div>
</form>

  <h1 class="h3 mb-0 text-gray-800"><b>Your PDF File</b></h1>
  <br>
  <center>
    <div id="viewpdf" style="height: 40rem; border:solid rgba(0,0,0,.1);"></div>
  </center>
</div>
</div>
<script type="text/javascript">
    
    var viewpdf = $('#viewpdf');
    PDFObject.embed("{{url('/pdffiles/'.$data->lorpdf_path)}}",viewpdf);

</script>

@endsection
