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
  <link rel="stylesheet" href="{{url('https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.css')}}">
  <script src="{{url('https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.js')}}"></script>
  <script src="{{url('https://unpkg.com/sweetalert/dist/sweetalert.min.js')}}"></script>

</head>

<body id="page-top">
@include('sweetalert::alert')

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="\admin">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">{{Session::get('name')}}</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="{{url('/admin')}}">
          <i class="fas fa-home"></i>
          <span>Home</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="{{url('/add_stud')}}">
          <i class="fas fa-user-plus"></i>
          <span>Add Students</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="{{url('/add_acc')}}">
          <i class="fas fa-user-plus"></i>
          <span>Add Accountent</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="{{url('/admin_report')}}">
          <i class="fas fa-search-plus"></i>
          <span>Statistical Data</span></a>
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
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/chart-area-demo.js"></script>
  <script src="js/demo/chart-pie-demo.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/datatables-demo.js"></script>

  <script>
    // Add the following code if you want the name of the file appear on select
    $(".custom-file-input").on("change", function() {
      var fileName = $(this).val().split("\\").pop();
      $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
  </script>
  <script type="text/javascript">
    
    $(document).ready(function () {
      $('#dtHorizontalVerticalExample').DataTable({
      "scrollX": true,
      "scrollY": 465,
      });
      $('.dataTables_length').addClass('bs-select');
    });

    $(document).ready(function () {
      $('#cmdtHorizontalVerticalExample').DataTable({
      "scrollX": true,
      "scrollY": 465,
      });
      $('.dataTables_length').addClass('bs-select');
    });

    $(document).ready(function () {
      $('#updtHorizontalVerticalExample').DataTable({
      "scrollX": true,
      "scrollY": 465,
      });
      $('.dataTables_length').addClass('bs-select');
    });

    $(document).ready(function () {
      $('#rjdtHorizontalVerticalExample').DataTable({
      "scrollX": true,
      "scrollY": 465,
      });
      $('.dataTables_length').addClass('bs-select');
    });
  </script>

  <script type="text/javascript">
    
    function elementvisible() {
      var form = document.getElementById('form');
      form.addEventListener('submit', function(e) {
        e.preventDefault();
      });
      document.getElementById("rejectclick").value = 1;
      document.getElementById("h3reason").style.display = "block";
      document.getElementById("textreason").style.display = "block";
    }

    function formsubmit() {
      var form = document.getElementById('form');
      form.submit();
    }

  </script>

  <script type="text/javascript">
      
      function shownvtable() 
      {
        $("#cmtable").hide("slow");
        $("#rjtable").hide("slow");
        $("#uptable").hide("slow");
        $("#nvtable").show(2000);
      }

      function showcmtable() 
      {
        $("#nvtable").hide("slow");
        $("#rjtable").hide("slow");
        $("#uptable").hide("slow");
        $("#cmtable").show(2000);
      }

      function showuptable() 
      {
        $("#cmtable").hide("slow");
        $("#rjtable").hide("slow");
        $("#nvtable").hide("slow");
        $("#uptable").show(2000);
      }

      function showrjtable() 
      {
        $("#cmtable").hide("slow");
        $("#nvtable").hide("slow");
        $("#uptable").hide("slow");
        $("#rjtable").show(2000);
      }

  </script>

  <script type="text/javascript">
    
    function confirmation(ev) {
            ev.preventDefault();
            var urlToRedirect = ev.currentTarget.getAttribute('href'); //use currentTarget because the click may be on the nested i tag and not a tag causing the href to be empty
            swal({
              title: "Delete Data",
              text: "Are you Sure You Want To Delete Data.",
              icon: "warning",
              buttons: true,
              dangerMode: true,
            })
            .then((willDelete) => {
              if (willDelete) {
                swal("Your Form Submited.", {
                  icon: "success",
                });
                 window.location.replace(urlToRedirect);
              } else {
                swal("Your Data is Safe.",{icon: "info",});
              }
            });
        }

    function submitform()
    {
      var form = document.getElementById('form');
      form.addEventListener('submit', function(e) {
        e.preventDefault();
      });
      form.submit();
    }

    var start = new Date().getFullYear();;
    var end = 2015;
    var options = "";
    for(var year = start ; year >= end; year--){
      options += "<option>"+ year +"</option>";
    }
    document.getElementById("year").innerHTML = options;

    function f1(objButton){  
        var form = document.getElementById('form');
        var month = document.getElementById('month');
        form.addEventListener('submit', function(e) {
          e.preventDefault();
        });
        month.value = objButton.value;
        form.submit();
    }

  </script>

</body>

</html>
