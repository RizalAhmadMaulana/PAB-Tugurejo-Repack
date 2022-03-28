<?php
session_start();
include "../../inc/inc.koneksi.php";
include "../../inc/fungsi_hdt.php";

echo " <option value='' selected>- Bulan -</option>";

$text	="SELECT DATE_FORMAT(tglnota,'%Y-%m') AS blntrx,DATE_FORMAT(tglnota,'%Y') AS thntrx,DATE_FORMAT(tglnota,'%m') AS blnaja 
		FROM penjualan GROUP BY DATE_FORMAT(tglnota,'%Y%m') ORDER BY blntrx DESC";	
$tampil	= mysql_query($text);
$jml	= mysql_num_rows($tampil);	
if($jml>0){
    while($r = mysql_fetch_array($tampil)){
		
		if($r[blnaja]=='01'){
			$bulantrx="Januari ".$r[thntrx];
		}elseif($r[blnaja]=='02'){
			$bulantrx="Pebruari ".$r[thntrx];
		}elseif($r[blnaja]=='03'){
			$bulantrx="Maret ".$r[thntrx];
		}elseif($r[blnaja]=='04'){
			$bulantrx="April ".$r[thntrx];
		}elseif($r[blnaja]=='05'){
			$bulantrx="Mei ".$r[thntrx];
		}elseif($r[blnaja]=='06'){
			$bulantrx="Juni ".$r[thntrx];
		}elseif($r[blnaja]=='07'){
			$bulantrx="Juli ".$r[thntrx];
		}elseif($r[blnaja]=='08'){
			$bulantrx="Agustus ".$r[thntrx];
		}elseif($r[blnaja]=='09'){
			$bulantrx="September ".$r[thntrx];
		}elseif($r[blnaja]=='10'){
			$bulantrx="Oktober ".$r[thntrx];
		}elseif($r[blnaja]=='11'){
			$bulantrx="Nopember ".$r[thntrx];
		}else{
			$bulantrx="Desember ".$r[thntrx];
		}	
		
        echo "<option value='$r[blntrx]'>$bulantrx</option>";		 
	}
}
	
?>