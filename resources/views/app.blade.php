<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>@yield('title')</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{ asset('plugins/jqvmap/jqvmap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.css') }}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- Data Tables -->
  <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
  <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">

  <!-- Select2 -->
  <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
  <!-- custom style-->
  <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar py-0 my-0 navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>

        <li class="nav-item d-none d-sm-inline-block">
          <a href="/"><img style="width: 50px;" src="/images/logo.png"> </a>
         </li>

         <li class="nav-item d-none d-sm-inline-block">
            <a href="/" class="nav-link">ZAGST Pharmacies</a>
          </li>

        <li class="nav-item d-none d-sm-inline-block">
          <a href="/" class="nav-link text-primary">Home</a>
        </li>

        <li class="nav-item d-none d-sm-inline-block">
            <a href="/" class="nav-link text-primary">About</a>
          </li>


      </ul>

      <!-- SEARCH FORM -->

      @role('admin','admin')
      <form class="floar-right ml-auto mr-5"  method="post" action="{{route('admin.logout')}}">
      @else
        @role('pharmacy','pharmacy')
           <form method="post" class="float-right ml-auto mr-5" action="{{route('pharmacy.logout')}}">
        @else
            <form method="post" class="float-right ml-auto mr-5" action="{{route('doctor.logout')}}">
        @endrole
      @endrole
      @csrf
          <input class="btn btn-primary  btn-md float-right ml-auto mr-5" type="submit" value="logout">
      </form>


    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block">Alexander Pierce</a>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          @role('admin')
            <li class="nav-item">
              <a href="{{route('dashboard.pharmacies.index')}}" class="nav-link">
                <i class="fas fa-clinic-medical"></i>
                <p>
                  Pharmacies
                </p>
              </a>
            </li>
          @endrole
          @role('pharmacy')
            <li class="nav-item">
              <a href="{{route('dashboard.doctors.index')}}" class="nav-link">
                <i class="fas fa-user-md fa-lg"></i>
                <p>
                  Doctors
                </p>
              </a>
            </li>
          @endrole
          @role('admin')
            <li class="nav-item">
              <a href="{{route('dashboard.users.index')}}" class="nav-link">
                <i class="fas fa-address-book fa-lg"></i>
                <p>
                  Users
                </p>
              </a>
            </li>


            <li class="nav-item">
              <a href="{{route('dashboard.areas.index')}}" class="nav-link">
                <i class="fas fa-globe-americas fa-lg"></i>
                <p>
                  Areas
                </p>
              </a>
            </li>

            <li class="nav-item">
              <a href="{{route('dashboard.addresses.index')}}" class="nav-link">
                <i class="fas fa-map-marked-alt fa-lg"></i>
                <p>
                  User Addresses
                </p>
              </a>
            </li>
        @endrole
        @role('doctor')
            <li class="nav-item">
              <a href="{{route('dashboard.medicines.index')}}" class="nav-link">
                <i class="fas fa-capsules fa-lg"></i>
                <p>
                  Medicines
                </p>
              </a>
            </li>

            <li class="nav-item">
              <a href="{{route('dashboard.orders.index')}}" class="nav-link">
                <i class="fas fa-shopping-cart fa-lg"></i>
                <p>
                  Orders
                </p>
              </a>
            </li>
          @endrole
          @role('pharmacy')
            <li class="nav-item">
              <a href="{{route('dashboard.revenue.index')}}" class="nav-link">
                <i class="fas fa-file-invoice-dollar fa-lg"></i>
                <p>
                  Revenue
                </p>
              </a>
            </li>
          @endrole
           @unlessrole('admin')
            <li class="nav-item">
              <a href="{{route('dashboard.profile.edit')}}" class="nav-link">
                <i class="fas fa-file-invoice-dollar fa-lg"></i>
                <p>
                  Edit Profile
                </p>
              </a>
            </li>
          @endunlessrole

          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>


    <div class="content-wrapper">
        <!-- Content Header (Page header) -->


        <div class="content-header">


            @yield('content')


      </div>

    <!-- Content Wrapper. Contains page content -->
    </div>


    <!-- /.content-wrapper -->
    <footer class="main-footer">
      <strong>Copyright &copy; 2020-2021 ZAGST.</a>.</strong>
      All rights reserved.
      <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 3.0.2
      </div>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
    
    <!-- ./wrapper -->
    
    <!-- jQuery -->
    <script
    src="https://code.jquery.com/jquery-2.2.4.js"
    integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI="
    crossorigin="anonymous"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
     <script>
      $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- ChartJS -->
    <script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
    <!-- Sparkline -->
    <script src="{{ asset('plugins/sparklines/sparkline.js') }}"></script>
    <!-- JQVMap -->
    <script src="{{ asset('plugins/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{ asset('plugins/jquery-knob/jquery.knob.min.js') }}"></script>
    <!-- daterangepicker -->
    <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <!-- Summernote -->
    <script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.js') }}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ asset('dist/js/pages/dashboard.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('dist/js/demo.js') }}"></script>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
  
    @yield('script')
</body>

</html>
