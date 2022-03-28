<?php 
// sesi login dimulai
include 'koneksi.php';
session_start();
// jika session bukan dari tbaplikasi maka dialihkan ke login page
if (!isset($_SESSION['name'])) {
    header("Location: login.php");
}
//ambil id dari query string
$user = $_GET['username'];

// buat query untuk ambil data dari database
$query = "SELECT * FROM tbaplikasi WHERE username=$user";
$sql = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($sql);

// jika data yang di-edit tidak ditemukan
if( mysqli_num_rows($sql) < 1 ){
    die("data tidak ditemukan...");
}

// simpan perubahan
// cek apakah tombol simpan sudah diklik atau blum?
if (isset($_POST['submit'])){

    // ambil data dari formulir input sebelumnya
    $username = $_POST['username'];
    $password = $_POST['password'];
    $namalengkap = $_POST['namalengkap'];
    $jabatan = $_POST['jabatan'];
    // buat query update
    $query = "UPDATE tbaplikasi SET username='$username', password='$password', nama_lengkap='$namalengkap', jabatan='$jabatan' WHERE username=$user";
    $sql = mysqli_query($conn, $query);

    // apakah query update berhasil?
    if( $sql ) {
        // alihkan ke tabel
        echo "<script>alert('Data berhasil diedit')</script>";
        header("Refresh:0; url=user_apk.php");
    } else {
        // kalau gagal tampilkan pesan
        echo "<script>alert('Data gagal diedit')</script>";
        header("Refresh:0; url=user_apk.php");
    }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PAB Tugurejo | Form Pengguna Aplikasi</title>
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
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Master Data
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pelanggan.php"class="nav-link">
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
          <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <img src="gambar/pengaturan.png" width="23px" height="23px">&nbsp;&nbsp;&nbsp;
              <p>
                Pengaturan
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="user_apk.php" class="nav-link active">
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
            <h1>Data Pengguna Aplikasi</h1><br><br>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php" style="color: #E2E2E2;">Home</a></li>
              <li class="breadcrumb-item active"><a href="user_apk.php" style="color: #E2E2E2;">Pengguna Aplikasi</a></li>
            </ol>
          </div>
          <a href='create_user_apk.php' class="btn btn-secondary" style="margin-left: 10px;"><img src="gambar/plus.png" width="18px" height="18px">&nbsp;Pengguna Baru</a>&nbsp;<a href='export_user_apk.php' class="btn btn-dark"><img src="gambar/export.png" width="18px" height="18px">&nbsp;Export Data</a><br>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title" style="color: #E2E2E2; font-family: Thinking Of Betty; font-size: 15px">Form&nbsp;&nbsp;Edit</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" action="">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Username :</label>
                    <input type="text" class="form-control" name="username" required autocomplete="off" id="exampleInputEmail1" placeholder="Masukkan username Anda" value="<?php echo $data['username']; ?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Password :</label>
                    <input type="password" class="form-control" name="password" required autocomplete="off" id="exampleInputEmail1" placeholder="Masukkan Password Anda" value="<?php echo $data['password']; ?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Nama Lengkap :</label>
                    <input type="text" class="form-control"name="namalengkap" required autocomplete="off" id="exampleInputEmail1" placeholder="Masukkan Nama Lengkap anda" value="<?php echo $data['nama_lengkap']; ?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Jabatan :</label>
                    <select name="jabatan" class="form-control" required  autocomplete="off" id="exampleInputEmail1">
                            <option selected><?php echo $data['jabatan']; ?></option>
                            <option>Ketua Dewan Pengawas</option>
                            <option>Administrasi Dewan Pengawas</option>
                            <option>Keuangan Dewan Pengawas</option>
                            <option>Anggota Dewan Pengawas</option> 
                            <option>Ketua Tim Pelaksana</option>
                            <option>Administrasi Tim Pelaksana</option>
                            <option>Keuangan Tim Pelaksana</option>
                            <option>Teknis Tim Pelaksana</option>
                            <option>Koordinasi Dawis</option>
                    </select><br>
                  </div>
                <!-- /.card-body -->
                <div>
                  <button type="submit" name="submit" class="btn btn-primary">Update</button>&nbsp;&nbsp;
                  <a class="btn btn-primary" href="user_apk.php" role="button">Batal</a>
                </div>
              </form>
            </div>
            <!-- /.card -->
          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
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
</body>
</html>