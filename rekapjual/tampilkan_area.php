<?php
session_start();
include "../../inc/inc.koneksi.php";
include "../../inc/fungsi_hdt.php";

$kodearea=$_SESSION[kodearea];

if($kodearea=='01'){
	$text	= "SELECT kodearea,namaperusahaan FROM perusahaan WHERE kodearea!='01' ORDER BY index_perusahaan";
}else{
	$text	="SELECT kodearea,namaperusahaan FROM perusahaan WHERE kodearea='$kodearea' ORDER BY index_perusahaan";
}

$tampil	= mysql_query($text);
$jml	= mysql_num_rows($tampil);

if($jml > 1){  
	echo "
	<option value='' selected> - Cabang - </option>";
     while($r=mysql_fetch_array($tampil)){
         echo "<option value='$r[kodearea]'>$r[namaperusahaan]</option>";		 
     }
}else{
	if($jml==1){
		$r=mysql_fetch_array($tampil);
		echo "
		<option value='$r[kodearea]' selected>$r[namaperusahaan]</option>";
	}else{
		echo "
		<option value='' selected> - Cabang - </option>";		 
	}	
}

?>