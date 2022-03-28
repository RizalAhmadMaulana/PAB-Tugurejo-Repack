<?php
session_start();
include "../../inc/inc.koneksi.php";
include "../../inc/fungsi_tanggal.php";
include "../../inc/fungsi_koma.php";
include '../../inc/fungsi_hdt.php';

$userid	= $_SESSION[namauser];

$area = $_GET[area];
$tgltrx1 = jin_date_sql($_GET[tgltrx1]);
$tgltrx2 = jin_date_sql($_GET[tgltrx2]);
$execins = $_GET[execins];

$tgljdllap = 'Tgl. '.$tgltrx1.' s/d '.$tgltrx2;

$del = "DELETE FROM lintasform2 WHERE userid='$userid'";
mysql_query($del);

$ins = "INSERT INTO lintasform2(userid,idtrx,kodetrx) VALUES('$userid','$tgljdllap','".$jnscustomer.$jnstrx."')";
mysql_query($ins);

$text = "SELECT namaproduk FROM produksaki WHERE onview=1";	
$sql 	= mysql_query($text);	
$jmlkolomekstra = mysql_num_rows($sql);

if($execins=='x'){
	$del = "DELETE FROM rekapjualsaki WHERE userid='$userid'";
	mysql_query($del);

	$ins = "INSERT INTO rekapjualsaki(kodecustomer,tglnota,produksaki,satberat,jmlbrg,userid) 
			SELECT a.kodecustomer,a.tglnota,COALESCE(c.produksaki,'') AS produksaki,
			IF(UPPER(c.satuanberat) IN ('ML','LT'),'LITER','KG') AS satberat,
			ROUND(SUM(IF(UPPER(c.satuanberat) IN ('ML','GR'),b.jmlbrg/1000,b.jmlbrg)),2) AS jmlbrg,'$userid' AS userid
			FROM penjualan a LEFT JOIN penjualan_detail b ON b.kodejual=a.kodejual LEFT JOIN daftarharga c ON c.kodebrg=b.kodebrg
			WHERE a.tglnota>='$tgltrx1' AND a.tglnota<='$tgltrx2' AND COALESCE(c.produksaki,'')!='' GROUP BY a.tglnota,c.produksaki,a.kodecustomer";
	mysql_query($ins);
}

$text = "SELECT a.kodecustomer,b.namacustomer,LEFT(b.alamat,80) AS alamat FROM penjualan a LEFT JOIN customer b ON b.kodecustomer=a.kodecustomer 
		WHERE a.tglnota>='$tgltrx1' AND a.tglnota<='$tgltrx2' GROUP BY a.kodecustomer ORDER BY b.namacustomer";	
$sql 	= mysql_query($text);	
$jmlrec	= mysql_num_rows($sql);

echo " 
	<table class='table table-bordered'>
		<thead style='background-color:#3c8dbc;color:#E8EAF6;'>
			<tr>
				<th style='width:10px;vertical-align:middle;' class='text-center'>NO</th>				
				<th style='vertical-align:middle;' class='text-center'>NAMA CUSTOMER</th>";
				
				$txt 	= "SELECT UPPER(namabrg) AS namaproduk FROM daftarharga WHERE onview=1 ORDER BY namaproduk";
				$s		= mysql_query($txt);
				while($r = mysql_fetch_array($s)){				
					echo "
					<th style='width:80px;vertical-align:middle;' class='text-center'>$r[namaproduk]</th>";
				}
				
			echo "	
			</tr>
		</thead>
		<tbody>";		
		
		$no=1;
		while($rec = mysql_fetch_array($sql)){							
				
			echo "
			<tr>
				<td class='text-center'>$no.</td>
				<td ><b>$rec[namacustomer]</b> - $rec[alamat]</td>";
				
				$txt 	= "SELECT kodeproduk FROM produksaki WHERE onview=1 ORDER BY namaproduk";
				$s		= mysql_query($txt);
				while($r = mysql_fetch_array($s)){
					
					$txt2 	= "SELECT SUM(jmlbrg) AS jmlbrg FROM rekapjualsaki	WHERE userid='$userid' AND tglnota>='$tgltrx1' AND tglnota<='$tgltrx2' 
							AND kodecustomer='$rec[kodecustomer]' AND COALESCE(produksaki,'')='$r[kodeproduk]'";
					$s2		= mysql_query($txt2);
					$r2 	= mysql_fetch_array($s2);
					
					echo "
						<td class='text-right'>".format_komadua_str($r2[jmlbrg])."</td>";
				}
				
			echo "	
			</tr>";			
						
			$no++;
		}
			
		if($jmlrecx<5){
			while($no<=5){
				echo "
					<tr>
						<td style='color:#FFFFFF' class='text-center'>$no.</td>
						<td ></td>";
						
						$x=0;
						while($x < $jmlkolomekstra){				
							echo "
							<td ></td>";
							$x++;
						}						
					
				echo "
					</tr>";	
				$no++;						
			}								
		}	
		
echo "	</tbody>
		<tfoot>	
			<tr>
				<td colspan='2' class='text-right'><b>TOTAL</b> &nbsp;&nbsp;</td>";
				
				$txt 	= "SELECT kodeproduk FROM produksaki WHERE onview=1 ORDER BY namaproduk";
				$s		= mysql_query($txt);
				while($r = mysql_fetch_array($s)){
					
					$txt2 	= "SELECT SUM(jmlbrg) AS jmlbrg FROM rekapjualsaki	WHERE userid='$userid' AND tglnota>='$tgltrx1' AND tglnota<='$tgltrx2' 
							AND COALESCE(produksaki,'')='$r[kodeproduk]'";
					$s2		= mysql_query($txt2);
					$r2 	= mysql_fetch_array($s2);
					
					echo "
						<td class='text-right'><b>".format_komadua_str($r2[jmlbrg])."</b></td>";
				}
				
			echo "	
			</tr>
		</tfoot>
	</table>";	
?>