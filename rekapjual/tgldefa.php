<?php
include "../../inc/inc.koneksi.php";
include "../../inc/fungsi_tanggal.php";

$text	= "SELECT DATE_FORMAT(CURRENT_DATE(),'%d-%m-%Y') AS tgltrx FROM DUAL";
$sql 	= mysql_query($text);
$r		= mysql_fetch_array($sql);

$data['tgltrx1']	= $r[tgltrx];
$data['tgltrx2']	= $r[tgltrx];
echo json_encode($data);	

	
?>