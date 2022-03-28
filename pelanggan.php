<?php 
// sesi login dimulai
include 'koneksi.php';
session_start();
// jika session bukan nama dari ruser maka dialihkan ke login page
if (!isset($_SESSION['name'])) {
    header("Location: login.php");
}

// hapus data aktifitas
// ambil id pelanggan seng meh di hapus
if (isset($_GET['idpelanggan'])) {
    $idpel = $_GET['idpelanggan'];

    // query hapus 
    $query = "DELETE FROM tbpelanggan WHERE idpelanggan=$idpel";
    $sql = mysqli_query($conn, $query);

    // apakah query hapus berhasil?
    // nek yo
    if ($sql) {
        echo "<script>alert('Data berhasil dihapus')</script>";
        header("Refresh:0; url=pelanggan.php");
	// nek rk 
    } else {
        die("gagal menghapus...");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PAB Tugurejo | Form Pelanggan</title>
  <!--Logo Title-->
  <link rel="icon" type="image/x-icon" href="gambar/logo.png" />

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="template/plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="template/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="template/dist/css/adminlte.min.css">
  <!-- data tables -->
  <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet"/>

</head>
<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__wobble" src="template/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link">
      <img src="gambar/logo.png" alt="Logo PAB Tugurejo" class="brand-image" height="30px">
      <span class="brand-text font-weight-light">PAB Tugurejo</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="gambar/person.png" width="23px" height="23px" alt="User Image">
        </div>
        <div class="info">
          <span>
            <?php echo $_SESSION['name']; ?>
          </span>
        </div>
      </div>
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="index.php" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Master Data
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pelanggan.php"class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Pelanggan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="tarif.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Tarif</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Laporan
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="laporan_pembayaran.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Laporan Pembayaran</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <img src="gambar/pengaturan.png" width="23px" height="23px">&nbsp;&nbsp;&nbsp;
              <p>
                Pengaturan
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="user_apk.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pengguna Aplikasi</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="logout.php" class="nav-link">
              <img src="gambar/SignOut.png" width="23px" height="23px">&nbsp;&nbsp;&nbsp;
              <p>
                Sign Out
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
        <!-- Content Header (Page header) -->
        <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Pelanggan</h1><br><br>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php" style="color: #E2E2E2;">Home</a></li>
              <li class="breadcrumb-item active"><a href="pelanggan.php" style="color: #E2E2E2;">Data Pelanggan</a></li>
            </ol>
          </div>
          <a href='create_pelanggan.php' class="btn btn-secondary" style="margin-left: 10px;"><img src="gambar/plus.png" width="18px" height="18px">&nbsp;Pelanggan Baru</a>&nbsp;<a href='export_pelanggan.php' class="btn btn-dark"><img src="gambar/export.png" width="18px" height="18px">&nbsp;Export Data</a><br>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"  style="color: #E2E2E2; font-family: Thinking Of Betty; font-size: 15px">Tabel&nbsp;&nbsp;Pelanggan</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="datatablesSimple"class="table table-bordered table-hover">
                  <thead>
                        <tr class="align-middle" style="text-align: center;">
                            <th>No</th>
                            <th>ID</th>
                            <th>Nama Pelanggan</th>
                            <th>Alamat</th>
                            <th>No Telp</th>
                            <th>Stand Awal</th>
                            <th colspan="2">Opsi</th>
                        </tr>
                  </thead>
                  <tbody>
                        <?php
                        $no = 0;
                        $tabel = mysqli_query($conn, "SELECT * FROM tbpelanggan ORDER BY stand_awal asc");
                        while ($data = mysqli_fetch_array($tabel)) {
                            $no++;
                        ?>
                        <tr>
                            <td><?php echo $no; ?></td>
                            <td><?php echo $data['idpelanggan']; ?></td>
                            <td><?php echo $data['namapelanggan']; ?></td>
                            <td><?php echo " RT"." ".$data['RT']." / RW"." ".$data['RW']." / NO"." ".$data['nomor_rumah']." / Jalan"." ".$data['jalan']." / Kelurahan"." ".$data['kelurahan']." / Kota"." ".$data['kota']; ?></td>
                            <td><?php echo $data['nomor_telpon']; ?></td>
                            <td><?php echo $data['stand_awal']; ?></td>
                            <td><a href='pelanggan.php?idpelanggan="<?=$data['idpelanggan']?>"' class="btn btn-danger btn-sm" onclick="return confirm('apakah anda yakin untuk mengubah?')">Hapus</a></td>
                            <td><a href='edit_pelanggan.php?idpelanggan="<?=$data['idpelanggan']?>"' class="btn btn-warning btn-sm">Edit</a></td>
                        </tr>
                        <?php
                        }
                        ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            
              <!-- /.card-header -->

              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.1.0
    </div>
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="template/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="template/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="template/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="template/dist/js/adminlte.js"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="template/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="template/plugins/raphael/raphael.min.js"></script>
<script src="template/plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="template/plugins/jquery-mapael/maps/usa_states.min.js"></script>
<!-- ChartJS -->
<script src="template/plugins/chart.js/Chart.min.js"></script>

<!-- AdminLTE for demo purposes -->
<script src="template/dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="template/dist/js/pages/dashboard2.js"></script>

<!--DataTables-->
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="js/sekrip.js"></script>
</body>
</html>
