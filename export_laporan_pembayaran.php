<?php
session_start();


// Panggil class PHPExcel nya
$excel = new PHPExcel();


// Settingan awal file excel
$excel->getProperties()->setCreator('InatekCorp')
             ->setLastModifiedBy('InatekCorp')
             ->setTitle("Data Penjualan")
             ->setSubject("Produk")
             ->setDescription("Laporan");


// Buat sebuah variabel untuk menampung pengaturan style dari header tabel
$style_header = array(
  'font' => array('bold' => true), // Set font nya jadi bold
  'alignment' => array(
    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
    'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
  ),
  'borders' => array(
    'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
    'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
    'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THICK), // Set border bottom dengan garis tebal
    'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
  )
);

// Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
$style_row = array(
  'alignment' => array(
    'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
  ),
  'borders' => array(
    'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
    'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
    'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
    'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
  )
);

$style_row_center = array(
  'alignment' => array(
	'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
    'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
  ),
  'borders' => array(
    'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
    'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
    'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
    'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
  )
);

$style_grandrow = array(
  'font' => array('bold' => true), 	
  'alignment' => array(
    'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
  )
);

$style_grandrow_center = array(
  'font' => array('bold' => true), 	
  'alignment' => array(
	'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
    'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
  )
);

$excel->setActiveSheetIndex(0)->setCellValue('A1', "TOKO AB TANI PEMALANG"); // Set kolom A1 
$excel->getActiveSheet()->mergeCells('A1:K1'); // Set Merge Cell 
$excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold 
$excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(12); // Set font size 15 
$excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center 

$excel->setActiveSheetIndex(0)->setCellValue('A2', "REKAP PENJUALAN PRODUK SAKASAKI"); 
$excel->getActiveSheet()->mergeCells('A2:K2'); 
$excel->getActiveSheet()->getStyle('A2')->getFont()->setBold(TRUE); 
$excel->getActiveSheet()->getStyle('A2')->getFont()->setSize(12); 
$excel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); 

$excel->setActiveSheetIndex(0)->setCellValue('A3', $periodetgl); 
$excel->getActiveSheet()->mergeCells('A3:K3'); 
$excel->getActiveSheet()->getStyle('A3')->getFont()->setBold(FALSE); 
$excel->getActiveSheet()->getStyle('A3')->getFont()->setSize(12); 
$excel->getActiveSheet()->getStyle('A3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); 

$excel->setActiveSheetIndex(0)->setCellValue('A4', "(Dalam Liter / Kg)"); 
$excel->getActiveSheet()->mergeCells('A4:K4'); 
$excel->getActiveSheet()->getStyle('A4')->getFont()->setBold(TRUE); 
$excel->getActiveSheet()->getStyle('A4')->getFont()->setSize(12); 
$excel->getActiveSheet()->getStyle('A4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); 

$excel->getActiveSheet()->getStyle('A6:K6')->getAlignment()->setWrapText(true);

// Buat header tabel nya
$excel->setActiveSheetIndex(0)->setCellValue('A5', "NO"); 
$excel->setActiveSheetIndex(0)->setCellValue('B5', "TGL NOTA"); 
$excel->setActiveSheetIndex(0)->setCellValue('C5', "NO NOTA"); 
$excel->setActiveSheetIndex(0)->setCellValue('D5', "NAMA BARANG"); 
$excel->setActiveSheetIndex(0)->setCellValue('E5', "QTY"); 
$excel->setActiveSheetIndex(0)->setCellValue('F5', strtoupper($satuanberat));
$excel->setActiveSheetIndex(0)->setCellValue('G5', "HARGA");
$excel->setActiveSheetIndex(0)->setCellValue('H5', "JUMLAH");
$excel->setActiveSheetIndex(0)->setCellValue('I5', "TOTAL TRANSAKSI");
$excel->setActiveSheetIndex(0)->setCellValue('J5', "TGL BAYAR");
$excel->setActiveSheetIndex(0)->setCellValue('K5', "JUMLAH BAYAR");
$excel->setActiveSheetIndex(0)->setCellValue('L5', "TOTAL BAYAR");
$excel->setActiveSheetIndex(0)->setCellValue('M5', "SALDO");
$excel->setActiveSheetIndex(0)->setCellValue('N5', "LAMA PELUNASAN");

// Apply style header yang telah kita buat tadi ke masing-masing kolom header
$excel->getActiveSheet()->getStyle('A5')->applyFromArray($style_header);
$excel->getActiveSheet()->getStyle('B5')->applyFromArray($style_header);
$excel->getActiveSheet()->getStyle('C5')->applyFromArray($style_header);
$excel->getActiveSheet()->getStyle('D5')->applyFromArray($style_header);
$excel->getActiveSheet()->getStyle('E5')->applyFromArray($style_header);
$excel->getActiveSheet()->getStyle('F5')->applyFromArray($style_header);
$excel->getActiveSheet()->getStyle('G5')->applyFromArray($style_header);
$excel->getActiveSheet()->getStyle('H5')->applyFromArray($style_header);
$excel->getActiveSheet()->getStyle('I5')->applyFromArray($style_header);
$excel->getActiveSheet()->getStyle('J5')->applyFromArray($style_header);
$excel->getActiveSheet()->getStyle('K5')->applyFromArray($style_header);
$excel->getActiveSheet()->getStyle('L5')->applyFromArray($style_header);
$excel->getActiveSheet()->getStyle('M5')->applyFromArray($style_header);
$excel->getActiveSheet()->getStyle('N5')->applyFromArray($style_header);

// Set height baris ke 1, 2 dan 3
$excel->getActiveSheet()->getRowDimension('1')->setRowHeight(20);
$excel->getActiveSheet()->getRowDimension('2')->setRowHeight(20);
$excel->getActiveSheet()->getRowDimension('3')->setRowHeight(20);
$excel->getActiveSheet()->getRowDimension('4')->setRowHeight(20);
$excel->getActiveSheet()->getRowDimension('5')->setRowHeight(35);

// Buat query untuk menampilkan semua data siswa
$text = "SELECT nomor,tglnota,nonota,namabrg,ROUND(qty) AS qty,ROUND(liter,2) AS liter,ROUND(harga) AS harga,ROUND(jml) AS jml,
		ROUND(tottrx) AS tottrx,tglbyr,ROUND(jmlbyr) AS jmlbyr,ROUND(totbyr) AS totbyr,ROUND(saldo) AS saldo,
		ROUND(lamalunas) AS lamalunas FROM lapforsakasaki WHERE userid='$userid' ORDER BY nourut";
$sql  = mysql_query($text);

$no = 1; 
$numrow = 6; 
$liter_total	= 0;
$jml_total		= 0;
$tottrx_total	= 0;
$jmlbyr_total 	= 0;
$totbyr_total	= 0;
while($data = mysql_fetch_array($sql)){ 

  $excel->getActiveSheet()->getStyle('E'.$numrow)->getNumberFormat()->setFormatCode('#,##0');
  $excel->getActiveSheet()->getStyle('F'.$numrow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
  $excel->getActiveSheet()->getStyle('G'.$numrow)->getNumberFormat()->setFormatCode('#,##0');
  $excel->getActiveSheet()->getStyle('H'.$numrow)->getNumberFormat()->setFormatCode('#,##0');
  $excel->getActiveSheet()->getStyle('I'.$numrow)->getNumberFormat()->setFormatCode('#,##0');
  $excel->getActiveSheet()->getStyle('K'.$numrow)->getNumberFormat()->setFormatCode('#,##0');
  $excel->getActiveSheet()->getStyle('L'.$numrow)->getNumberFormat()->setFormatCode('#,##0');
  $excel->getActiveSheet()->getStyle('M'.$numrow)->getNumberFormat()->setFormatCode('#,##0');
  $excel->getActiveSheet()->getStyle('N'.$numrow)->getNumberFormat()->setFormatCode('#,##0');

  $excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $data['nomor']);
  $excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $data['tglnota']);
  $excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $data['nonota']);
  $excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $data['namabrg']);  
  $excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $data['qty']);
  $excel->setActiveSheetIndex(0)->setCellValue('F'.$numrow, $data['liter']);
  $excel->setActiveSheetIndex(0)->setCellValue('G'.$numrow, $data['harga']);
  $excel->setActiveSheetIndex(0)->setCellValue('H'.$numrow, $data['jml']);
  $excel->setActiveSheetIndex(0)->setCellValue('I'.$numrow, $data['tottrx']);  
  $excel->setActiveSheetIndex(0)->setCellValue('J'.$numrow, $data['tglbyr']);
  $excel->setActiveSheetIndex(0)->setCellValue('K'.$numrow, $data['jmlbyr']);
  $excel->setActiveSheetIndex(0)->setCellValue('L'.$numrow, $data['totbyr']);  
  $excel->setActiveSheetIndex(0)->setCellValue('M'.$numrow, $data['saldo']);
  $excel->setActiveSheetIndex(0)->setCellValue('N'.$numrow, $data['lamalunas']);
  
  // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
  $excel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_row_center);
  $excel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row_center);
  $excel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row_center);
  $excel->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row);
  $excel->getActiveSheet()->getStyle('E'.$numrow)->applyFromArray($style_row_center);
  $excel->getActiveSheet()->getStyle('F'.$numrow)->applyFromArray($style_row_center);
  $excel->getActiveSheet()->getStyle('G'.$numrow)->applyFromArray($style_row_center);
  $excel->getActiveSheet()->getStyle('H'.$numrow)->applyFromArray($style_row);
  $excel->getActiveSheet()->getStyle('I'.$numrow)->applyFromArray($style_row);
  $excel->getActiveSheet()->getStyle('J'.$numrow)->applyFromArray($style_row_center);
  $excel->getActiveSheet()->getStyle('K'.$numrow)->applyFromArray($style_row);
  $excel->getActiveSheet()->getStyle('L'.$numrow)->applyFromArray($style_row);
  $excel->getActiveSheet()->getStyle('M'.$numrow)->applyFromArray($style_row);
  $excel->getActiveSheet()->getStyle('N'.$numrow)->applyFromArray($style_row_center);
  
  $excel->getActiveSheet()->getRowDimension($numrow)->setRowHeight(20);
  
  $liter_total	= $liter_total+$data['liter'];
  $jml_total	= $jml_total+$data['jml'];
  $tottrx_total	= $tottrx_total+$data['tottrx'];
  $jmlbyr_total = $jmlbyr_total+$data['jmlbyr'];
  $totbyr_total	= $totbyr_total+$data['totbyr'];
  
  $no++; // Tambah 1 setiap kali looping
  $numrow++; // Tambah 1 setiap kali looping
}

$excel->getActiveSheet()->getStyle('F'.$numrow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
$excel->getActiveSheet()->getStyle('H'.$numrow)->getNumberFormat()->setFormatCode('#,##0');
$excel->getActiveSheet()->getStyle('I'.$numrow)->getNumberFormat()->setFormatCode('#,##0');
$excel->getActiveSheet()->getStyle('K'.$numrow)->getNumberFormat()->setFormatCode('#,##0');
$excel->getActiveSheet()->getStyle('L'.$numrow)->getNumberFormat()->setFormatCode('#,##0');

$excel->setActiveSheetIndex(0)->setCellValue('F'.$numrow, $liter_total);
$excel->setActiveSheetIndex(0)->setCellValue('G'.$numrow, $satuanberat);
$excel->setActiveSheetIndex(0)->setCellValue('H'.$numrow, $jml_total);
$excel->setActiveSheetIndex(0)->setCellValue('I'.$numrow, $tottrx_total); 
$excel->setActiveSheetIndex(0)->setCellValue('K'.$numrow, $jmlbyr_total);
$excel->setActiveSheetIndex(0)->setCellValue('L'.$numrow, $totbyr_total);
  
$excel->getActiveSheet()->getStyle('F'.$numrow)->applyFromArray($style_grandrow_center);
$excel->getActiveSheet()->getStyle('G'.$numrow)->applyFromArray($style_grandrow_center);
$excel->getActiveSheet()->getStyle('H'.$numrow)->applyFromArray($style_grandrow);
$excel->getActiveSheet()->getStyle('I'.$numrow)->applyFromArray($style_grandrow);
$excel->getActiveSheet()->getStyle('K'.$numrow)->applyFromArray($style_grandrow);
$excel->getActiveSheet()->getStyle('L'.$numrow)->applyFromArray($style_grandrow);
  
$excel->getActiveSheet()->getRowDimension($numrow)->setRowHeight(20);

// Set width kolom
$excel->getActiveSheet()->getColumnDimension('A')->setWidth(5); 
$excel->getActiveSheet()->getColumnDimension('B')->setWidth(12); 
$excel->getActiveSheet()->getColumnDimension('C')->setWidth(19); 
$excel->getActiveSheet()->getColumnDimension('D')->setWidth(40); 
$excel->getActiveSheet()->getColumnDimension('E')->setWidth(10); 
$excel->getActiveSheet()->getColumnDimension('F')->setWidth(10); 
$excel->getActiveSheet()->getColumnDimension('G')->setWidth(12); 
$excel->getActiveSheet()->getColumnDimension('H')->setWidth(13); 
$excel->getActiveSheet()->getColumnDimension('I')->setWidth(14); 
$excel->getActiveSheet()->getColumnDimension('J')->setWidth(12); 
$excel->getActiveSheet()->getColumnDimension('K')->setWidth(13); 
$excel->getActiveSheet()->getColumnDimension('L')->setWidth(14);
$excel->getActiveSheet()->getColumnDimension('M')->setWidth(10); 
$excel->getActiveSheet()->getColumnDimension('N')->setWidth(14);

// Set orientasi kertas jadi LANDSCAPE
$excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);

// Set judul file excel nya
$excel->getActiveSheet(0)->setTitle("Laporan");
$excel->setActiveSheetIndex(0);

// Proses file excel
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="LapPenjualan_ProdukSakasaki.xlsx"'); // Set nama file excel nya
header('Cache-Control: max-age=0');

$write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
$write->save('php://output');

?>

<?php
// sesi login dimulai
include 'koneksi.php';
session_start();
// jika session bukan nama dari ruser maka dialihkan ke login page
if (!isset($_SESSION['name'])) {
    header("Location: login.php");
}
// awal variable kosong
$tglawal = "";
$tglakhir = "";
$laporan = "";
// ketika tombol submit
if (isset($_POST['submit'])) {
	// ambil data dari 2 input tanggal
	$tglawal = $_POST['tglawal'];
	$tglakhir = $_POST['tglakhir'];
	// format text laporan
	$laporan = "Tgl. ".$tglawal." s/d " .$tglakhir;
}
// ketika tombol reset
if (isset($_POST['reset'])) {
	// variable tanggal di kosongin/dihapus
	$tglawal = "";
	$tglakhir = "";
	$laporan = "";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PAB Tugurejo | Laporan Pembayaran</title>
  <!--Logo Title-->
  <link rel="icon" type="image/x-icon" href="gambar/logo.png" />

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="template/plugins/fontawesome-free/css/all.min.css">
  <!-- IonIcons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="template/dist/css/adminlte.min.css">
  <!-- data tables -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>

</head>
<!--
`body` tag options:

  Apply one or more of the following classes to to the body tag
  to get the desired effect

  * sidebar-collapse
  * sidebar-mini
-->
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars" style="color: black;"></i></a>
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
          <span style="color: white;">
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
          <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Laporan
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="laporan_pembayaran.php" class="nav-link active">
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
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php" style="color: #939393;">Home</a></li>
              <li class="breadcrumb-item active"><a href="laporan_pembayaran.php" style="color: #939393;">Laporan Pembayaran</a></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
	<!-- Page content-->
	<div class="container">
                    <form method="post" action="">
                        <div class="px-4 py-4 text-center">
                    <div class="col-lg-7 mx-auto">
                    <div class="row">
                        <div class="col-lg-7">
                        <div class="input-group">
                        <input type="date" class="form-control" placeholder="tgl-awal" aria-label="tgl-awal" name="tglawal" value="<?=@$tglawal;?>">
                        </div>
                    </div>
                        <div class="col-lg-7">
                        <div class="input-group">
                        <input type="date" class="form-control" placeholder="tgl-akhir" aria-label="tgl-akhir" name="tglakhir" value="<?=@$tglakhir;?>">
                        </div>
                        </div>
                    </div>
                    <div class="row py-3">
                        <div class="col-lg-7">
                            <button type="submit" class="btn btn-secondary btn-sm" name="submit">Cari</button>&nbsp;<button type="submit" class="btn btn-dark btn-sm" name="reset">Reset</button>
                        </div>
                    </div><br><br><br><br>
                    <h1 class="display-6 fw-light">Laporan Pembayaran</h1>
                    <p><?php echo $laporan; ?></p>
                    </div>
                        </div>
                    </form>
	            </div>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"  style="color: #E2E2E2; font-family: Thinking Of Betty; font-size: 15px">Tabel&nbsp;&nbsp;Laporan&nbsp;&nbsp;Pembayaran</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="export" class="table table-bordered table-hover">
                  <thead>
                        <tr class="align-middle" style="text-align: center;">
                            <th>No</th>
                            <th>Nama Pelanggan</th>
                            <th>Alamat</th>
                            <th>Jumlah Tagihan</th>
                            <th>Jumlah Bayar</th>
                            <th>Kekurangan</th>
                        </tr>
                  </thead>
                  <tbody>
                        <?php
                            $no = 0;
                            $tabel = mysqli_query($conn, "SELECT a.namapelanggan, CONCAT(a.RT,'/',a.RW,'/',a.nomor_rumah,'/',a.jalan,'/',a.kelurahan,'/',a.kota) AS alamat,b.jmltagihan,c.jmlbayar,b.jmltagihan-c.jmlbayar AS kekurangan FROM tbpelanggan a LEFT JOIN tbtagihan b ON b.idpelanggan=a.idpelanggan LEFT JOIN tbpembayaran c ON c.idpelanggan=a.idpelanggan AND c.bulantrx=b.bulantrx;");
                            while ($data = mysqli_fetch_array($tabel)) {
                                $no++;
                        ?>
                        <tr>
                            <td><?php echo $no; ?></td>
                            <td><?php echo $data['namapelanggan']; ?></td>
                            <td><?php echo $data['alamat'];?></td>
                            <td><?php echo $data['jmltagihan']; ?></td>
                            <td><?php echo $data['jmlbayar']; ?></td>
                            <td><?php echo $data['kekurangan']; ?></td>
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
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="template/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="template/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE -->
<script src="template/dist/js/adminlte.js"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="template/plugins/chart.js/Chart.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="template/dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="template/dist/js/pages/dashboard3.js"></script>
<!--export datatables-->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>
<script>
            $(document).ready(function() {
                $('#export').DataTable( {
                    dom: 'Bfrtip',
                    buttons: [ 
                        {
                            extend: 'print',
                            messageTop: '<h1 class="display-6 fw-light">Laporan Pembayaran <?php echo $laporan; ?> </h1>'
                        }
                    ]
                } );
            } );
</script>
</body>
</html>
