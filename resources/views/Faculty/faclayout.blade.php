<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  

  <title>@yield('title',"LFRS")</title>

  <!-- Custom fonts for this template-->
  <link href="{{url('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
  <link href="{{url('https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i')}}" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="{{url('css/sb-admin-2.min.css')}}" rel="stylesheet">

  <!-- Custom styles for this page -->
  <link href="{{url('vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
  <script src="{{url('//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js')}}"></script>
  <script src="{{url('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js')}}"></script>
  <script src="{{url('https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js')}}"></script>
  <link rel="stylesheet" href="{{('https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.css')}}">
  <script src="{{url('//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js')}}"></script>
  <script src="{{url('//code.jquery.com/jquery-1.11.1.min.js')}}"></script>
  <script src="{{url('https://cdnjs.cloudflare.com/ajax/libs/pdfobject/2.1.1/pdfobject.js')}}"></script>

<style>
/* The container */
.container {
  display: block;
  position: relative;
  cursor: pointer;
  font-size: 22px;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

/* Hide the browser's default checkbox */
.container input {
  position: absolute;
  opacity: 0;
  cursor: pointer;
  height: 0;
  width: 0;
}

/* Create a custom checkbox */
.checkmark {
  position: absolute;
  margin-left: 25px;
  margin-top: 5px;
  top: 0;
  left: 0;
  height: 28px;
  width: 28px;
  background-color: #ccc;
  border-radius: 20px;
}

/* On mouse-over, add a grey background color */
.container:hover input ~ .checkmark {
  background-color: #ccc;
}

/* When the checkbox is checked, add a blue background */
.container input:checked ~ .checkmark {
  background-color: #2196F3;
}

/* Create the checkmark/indicator (hidden when not checked) */
.checkmark:after {
  content: "";
  position: absolute;
  display: none;
}

/* Show the checkmark when checked */
.container input:checked ~ .checkmark:after {
  display: block;
}

/* Style the checkmark/indicator */
.container .checkmark:after {
  left: 9px;
  top: 5px;
  width: 8px;
  height: 16px;
  border: solid white;
  border-width: 0 3px 3px 0;
  -webkit-transform: rotate(45deg);
  -ms-transform: rotate(45deg);
  transform: rotate(45deg);
}
</style>
</head>

<body id="page-top">
@include('sweetalert::alert')

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="\faculty">
        <div class="sidebar-brand-icon" style="margin-top: 11px;">
          <h4 style="font-weight: bolder;">LJMCA</h4>
        </div>
        <div class="sidebar-brand-text mx-3">Welcome {{Session::get('name')}}</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="{{url('/faculty')}}">
          <i class="fas fa-home"></i>
          <span>Home</span></a>
      </li>


      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="{{url('/profile')}}">
          <i class="fas fa-id-card"></i>
          <span>Profile</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="{{url('/logout')}}">
          <i class="fas fa-sign-out-alt"></i>
          <span>Logout</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        
          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            
            <div class="topbar-divider d-none d-sm-block"></div>
            <hr>

          </ul>

        </nav>
    <!-- End of Topbar -->

    @yield('content')
</div>
</div>
    <!-- Footer -->
    <footer class="sticky-footer bg-white">
      <div class="container my-auto">
        <div class="copyright text-center my-auto">
          <span>Copyright &copy; DPCREATIONS.</span>
          <span><h6>Created By Dhaval Pithwa</h6></span>
        </div>
      </div>
    </footer>
    <!-- End of Footer -->

    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="login.html">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="{{url('vendor/jquery/jquery.min.js')}}"></script>
  <script src="{{url('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

  <!-- Core plugin JavaScript-->
  <script src="{{url('vendor/jquery-easing/jquery.easing.min.js')}}"></script>

  <!-- Custom scripts for all pages-->
  <script src="{{url('js/sb-admin-2.min.js')}}"></script>

  <!-- Page level plugins -->
  <script src="{{url('vendor/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{url('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

  <!-- Page level custom scripts -->
  <script src="{{url('js/demo/datatables-demo.js')}}"></script>

  <script src="https://cdn.rawgit.com/atatanasov/gijgo/master/dist/combined/js/gijgo.min.js" type="text/javascript"></script>
  <link href="https://cdn.rawgit.com/atatanasov/gijgo/master/dist/combined/css/gijgo.min.css" rel="stylesheet" type="text/css" />

  <script>
    // Add the following code if you want the name of the file appear on select
    $(".custom-file-input").on("change", function() {
      var fileName = $(this).val().split("\\").pop();
      $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
  </script>

  <script type="text/javascript">
    
    function seetrid(enroll) {
      var form = document.getElementById('form');
      var tid = document.getElementById('tid');
      var setenroll = document.getElementById('enroll');
      form.addEventListener('submit', function(e) {
        e.preventDefault();
      });
      Swal.fire({
      title: 'Enter Transaction Id',
      input: 'text',
      inputAttributes: {
        autocapitalize: 'off'
      },
      showCancelButton: true,
      confirmButtonText: 'Submit',
      showLoaderOnConfirm: true,
      }).then((result) => {
        if (result.value) {
          setenroll.value = enroll;
          tid.value =  result.value;
          form.submit();
        }
      })
    }

    $(document).ready(function () {
        $('#datepicker').datepicker({
          uiLibrary: 'bootstrap'
        });
    });

  </script>

  
  <script src="{{url('https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.js')}}"></script>
  <script src="{{url('https://unpkg.com/sweetalert/dist/sweetalert.min.js')}}"></script>

  <script src="{{url('https://cdn.jsdelivr.net/npm/sweetalert2@9')}}"></script>

</body>

</html>
