<?php include 'assets/fxn.php';
$id = $_SESSION["UID"];
$result = getThis("SELECT * FROM `admindetails` WHERE `id`='$id'");
$result = $result[0];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Dashboard</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="dashboard.php" class="nav-link">Home</a>
        </li>
        
      </ul>

      <!-- SEARCH FORM -->
      

      <!-- Right navbar links -->
      
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="index3.html" class="brand-link">
        <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Eagle Eye</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block"><?php echo e_d('d', $result['firstName']) . " " . e_d('d', $result['lastName']); ?></a>
            <a href="#" class="d-block"><?php echo e_d('d', $result['emailAddress']) . ", " . e_d('d', $result['phoneNumber']); ?></a>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item">
              <a href="dashboard.php" class="nav-link active">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Dashboard
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="inmatesmanagement.php" class="nav-link">
                <i class="nav-icon fas fa-th"></i>
                <p>
                  Inmates Management
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="movementmanagement.php" class="nav-link">
                <i class="nav-icon fas fa-th"></i>
                <p>
                  Inmate Movement 
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="routemanagement.php" class="nav-link">
                <i class="nav-icon fas fa-th"></i>
                <p>
                  Route Management
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="locationmanagement.php" class="nav-link">
                <i class="nav-icon fas fa-th"></i>
                <p>
                  Location Management
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="parolemanagement.php" class="nav-link">
                <i class="nav-icon fas fa-th"></i>
                <p>
                  Parole Management
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="bailmanagement.php" class="nav-link">
                <i class="nav-icon fas fa-th"></i>
                <p>
                  Bail Management
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="barrackmanagement.php" class="nav-link">
                <i class="nav-icon fas fa-th"></i>
                <p>
                  Barrack Management
                </p>
              </a>
            </li>
           
           


          
          </ul>
        </nav>
        <a href="logout.php" class="btn btn-danger btn-block">Logout</a>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>