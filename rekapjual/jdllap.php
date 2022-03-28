<?php
include "../../inc/inc.koneksi.php";
include "../../inc/fungsi_indotgl2.php";
include "../../inc/fungsi_tanggal.php";

$area = $_POST[area];
$d1 = explode("-",$_POST[tgltrx1]);
$d2 = explode("-",$_POST[tgltrx2]);

if($d1[1]=='01'){
	$namabulan = "JAN";
}elseif($d1[1]=='02'){
	$namabulan = "PEB";		
}elseif($d1[1]=='03'){
	$namabulan = "MAR";		
}elseif($d1[1]=='04'){
	$namabulan = "APR";		
}elseif($d1[1]=='05'){
	$namabulan = "MEI";		
}elseif($d1[1]=='06'){
	$namabulan = "JUN";		
}elseif($d1[1]=='07'){
	$namabulan = "JUL";		
}elseif($d1[1]=='08'){
	$namabulan = "AUG";		
}elseif($d1[1]=='09'){
	$namabulan = "SEP";	
}elseif($d1[1]=='10'){
	$namabulan = "OKT";		
}elseif($d1[1]=='11'){
	$namabulan = "NOV";		
}else{
	$namabulan = "DES";		
}

$tgltrx1 = $d1[0]." ".$namabulan." ".$d1[2];

if($d2[1]=='01'){
	$namabulan = "JAN";
}elseif($d2[1]=='02'){
	$namabulan = "PEB";		
}elseif($d2[1]=='03'){
	$namabulan = "MAR";		
}elseif($d2[1]=='04'){
	$namabulan = "APR";		
}elseif($d2[1]=='05'){
	$namabulan = "MEI";		
}elseif($d2[1]=='06'){
	$namabulan = "JUN";		
}elseif($d2[1]=='07'){
	$namabulan = "JUL";		
}elseif($d2[1]=='08'){
	$namabulan = "AUG";		
}elseif($d2[1]=='09'){
	$namabulan = "SEP";	
}elseif($d2[1]=='10'){
	$namabulan = "OKT";		
}elseif($d2[1]=='11'){
	$namabulan = "NOV";		
}else{
	$namabulan = "DES";		
}

$tgltrx2 = $d2[0]." ".$namabulan." ".$d2[2];

$text	= "SELECT namaperusahaan,alamat FROM perusahaan WHERE kodearea='$area'";
$sql 	= mysql_query($text);
$jmlrec	= mysql_num_rows($sql);	

if($jmlrec>0){	
	while($r=mysql_fetch_array($sql)){		
		$data['area']	= $r[namaperusahaan];
		$data['alamat']	= $r[alamat];
		$data['tgltrx']	= 'Tgl. '.$tgltrx1.' s/d '.$tgltrx2;
		echo json_encode($data);
	}		
}else{
	$data['area']	= 'Cabang ';
	$data['alamat']	= 'Jl. ';
	$data['tgltrx']	= 'Tgl. '.$tgltrx1.' s/d '.$tgltrx2;
	echo json_encode($data);	
}	

?>