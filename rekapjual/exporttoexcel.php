<?php
session_start();
include "inc/inc.koneksi.php";
include "inc/fungsi_hdt.php";
require_once "PHPExcel/PHPExcel.php";

$userid	= $_SESSION[namauser];

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