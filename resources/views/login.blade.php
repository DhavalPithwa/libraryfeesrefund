<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>LFRS Login</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body style="background-image: url(img/loginpage.webp);">
@include('sweetalert::alert')
  <div class="container">
    <br><br><br><br><br>
    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <!-- <div class="col-lg-6 d-none d-lg-block bg-login-image"></div> -->
              <img src="{{URL::asset('img/ljlogo.png')}}" width="430" height="420" 
              style="margin-top: 20px; margin-left: 40px; margin-right: -10px;" >
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                  <h1 class="h4 text-gray-900 mb-4"><b>Welcome To Student Interaction System</b></h1>
                  </div>
                  <form class="user" action="{{url('/adminlogin')}}" method="post" id="form">
                    @csrf
                    <div class="form-row">
                      <div class="form-check-inline" style="margin-left: 30px;">
                        <label class="text-gray-900 mb-4" style="font-size:19px;">
                          <input type="radio" class="form-check-input" name="optradio" style="width: 20px; height: 15px;" onclick="stud()">Student
                        </label>
                      </div>
                      <div class="form-check-inline" style="font-size:19px;">
                        <label class="text-gray-900 mb-4">
                          <input type="radio" class="form-check-input" name="optradio" checked style="width: 20px; height: 15px;" onclick="librarian()">Authorities
                        </label>
                      </div>
                    </div>
                    <div class="form-group">
                      <input type="email" class="form-control form-control-user" name="email" id="email" aria-describedby="emailHelp" placeholder="Enter Email Address..." autofocus>
                      <input type="text" class="form-control form-control-user" name="enroll" id="enroll" aria-describedby="emailHelp" placeholder="Enter Your Enrollment..." style="display: none;" autofocus>
                      <input type="hidden" name="role" id="role" value="0">
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" name="password" id="password" placeholder="Password">
                    </div>
                    <button class="btn btn-primary btn-user btn-block" id="formsubmit" onclick="submitform()">
                      Login
                    </button>
                  </form>
                  <hr>
                  <div class="text-center">
                  <a class="h4 mb-0 text-gray-800" href="{{url('forgotpass')}}">Forgot Password ?</a>
                  </div>
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
    
    function stud(){
      document.getElementById("role").value = 1;
      document.getElementById("email").style.display = "none";
      document.getElementById("enroll").style.display = "block";
    }

    function librarian(){
      document.getElementById("role").value = 0;
      document.getElementById("enroll").style.display = "none";
      document.getElementById("email").style.display = "block";
    }

    function submitform() 
    {
      var form = document.getElementById('form');
      form.submit();
    }
    
  </script>

</body>

</html>
