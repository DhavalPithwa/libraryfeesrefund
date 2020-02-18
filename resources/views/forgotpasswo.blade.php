<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>LFRS - Enter OTP</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</head>

<body style="background-image: url(img/loginpage.webp);">
@include('sweetalert::alert')
  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <img src="{{URL::asset('img/ljlogo.png')}}" width="430" height="470" 
              style="margin-top: 20px; margin-left: 40px; margin-right: -10px;" >
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-2">OTP Send To Your Mail.</h1>
                    <h1 style="color: red; font-size: 20px;">OTP Will destroy in 5 minutes</h1>
                    <div style="font-size: 20px;" id="timerdiv">Time left = <span id="timer"></span></div>
                  </div>
                  <form class="user" action="{{url('/checkvalue')}}" method="post">
                    @csrf
                    <div class="form-group">
                      <input type="hidden" name="otp" value="{{$otp}}"><br>
                      <input type="hidden" name="email" value="{{$email}}"><br>
                      <input type="text" class="form-control form-control-user" id="userotp" name="userotp" placeholder="Enter OTP..." value="{{old('userotp')}}"><br>
                      <input type="password" class="form-control form-control-user" name="npassword" id="npassword" placeholder="New Password"><br>
                      <input type="password" class="form-control form-control-user" name="ncpassword" id="cnpassword" placeholder="Confirm New Password"><br>
                    </div>
                    <button class="btn btn-primary btn-user btn-block">
                      Reset Password
                    </button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <script type="text/javascript">
    document.getElementById('timer').innerHTML =  05 + ":" + 00;
    startTimer();

    function startTimer() {
      var presentTime = document.getElementById('timer').innerHTML;
      var timeArray = presentTime.split(/[:]+/);
      var m = timeArray[0];
      var s = checkSecond((timeArray[1] - 1));
      if(s==59){m=m-1}
      if (m<0) 
      {
        let url = "{{ url('forgotpass') }}";
        document.location.href=url;
      } else {
        if(m==0)
        {
          document.getElementById('timerdiv').style.color = "red";
        }
        if(m==0 && s<=30)
        {
          blinkFont();
        }
        document.getElementById('timer').innerHTML = m + ":" + s;
        setTimeout(startTimer, 1000);
      }
      
    }

    function checkSecond(sec) {
      if (sec < 10 && sec >= 0) {sec = "0" + sec}; // add zero in front of numbers < 10
      if (sec < 0) {sec = "59"};
      return sec;
    }

    function blinkFont()
    {
      document.getElementById("timer").style.color="red";
      setTimeout("setblinkFont()",1200)
    }

    function setblinkFont()
    {
      document.getElementById("timer").style.color = "white";
      setTimeout("blinkFont()",1200)
    }
  </script>

</body>

</html>
