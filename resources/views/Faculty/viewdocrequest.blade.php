@extends('Faculty.faclayout')

@section('title','Faculty - View Request')


@section('content')
  
<div class="container-fluid" >

    <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"><b><u>Enrollment </u>:- </b>{{$user->enroll}} <b><u>{{$user->name}}'s</u></b> Request</h1>
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
