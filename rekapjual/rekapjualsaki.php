<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>OnCash | Rekap</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />	
        <link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />
		<link href="assets/global/plugins/bootstrap-datepicker/css/datepicker3.css" rel="stylesheet" type="text/css"/>
    	<link href="img/favicon.png" rel="shortcut icon" type="image/png" />
    	<script language="JavaScript">
			document.addEventListener("contextmenu", function(e){
				e.preventDefault();
			}, false);
		</script>
    </head>
    <body class="skin-blue">
        <header class="header">
            <a href="index.html" class="logo">
				<?php				
					session_start();
					include "inc/inc.koneksi.php";
					include "inc/fungsi_hdt.php";
							
					$text = "SELECT UPPER(namaperusahaan) AS nama FROM perusahaan WHERE kodearea='$_SESSION[kodearea]'";																		
					$sql = mysql_query($text);
					$rec = mysql_fetch_array($sql);
					$namaarea = $rec['nama'];							
					
					echo $_SESSION[perusahaan];
				?>		
            </a>
            <nav class="navbar navbar-static-top" role="navigation">
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
					
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span>
									<?php echo $_SESSION[namalengkap];?>
								<i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="user-header bg-light-blue">
                                    <img src="<?php echo $_SESSION[pathavatar];?>" class="img-circle" alt="User Image" />
                                    <p>									
										<?php echo $_SESSION[posisi];?>
                                        <small><?php echo $_SESSION[tgljoin] ?></small>
                                    </p>
                                </li>
								
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="?mod=chpass" class="btn btn-default btn-flat">Change Password</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="?mod=exit" class="btn btn-default btn-flat">Sign out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <aside class="left-side sidebar-offcanvas">
                <section class="sidebar">                    
                    <form action="#" method="get" class="sidebar-form">                        
                    	<input type="text" class="form-control text-center" value="<?php echo $namaarea ?>" disabled="disabled"/>
                    </form>					
                    <ul class="sidebar-menu">
						<?php
							$idinduk = "7";									
							
							$queryx="SELECT b.link,b.menu_class,b.menu_caption,a.id_induk,a.id_anak FROM aksesmenu a 
									LEFT JOIN menu_induk b ON b.id_induk=a.id_induk 
									WHERE a.username='$_SESSION[namauser]' GROUP BY a.id_induk ORDER BY a.id_induk";																		
							$sql_ = mysql_query($queryx);
							while($menu = mysql_fetch_array($sql_)){
								if($menu[id_induk]==$idinduk){
									if($menu[id_anak]>0){
										 echo "
										 <li class='treeview active'>";
									}else{
										echo "
										 <li class='active'>";
									}	 									 
								}else{	 
									if($menu[id_anak]>0){
										echo "
										 <li class='treeview'>";
									}else{
										echo "<li>";
									}	 			
								}
								
								echo "									
									<a href='$menu[link]'>
										<i class='$menu[menu_class]'></i><span> $menu[menu_caption]</span>";
										if($menu[id_anak]>0){
											echo "
												<i class='fa fa-angle-left pull-right'></i>";
										}
								echo "</a>";
								
								if($menu[id_anak]>0){
									echo "
										<ul class='treeview-menu'>";					
										
									$sqlx = mysql_query("SELECT b.link,b.menu_class,b.menu_caption FROM aksesmenu a LEFT JOIN menu_anak b 
														ON b.id_anak=a.id_anak WHERE a.id_induk=$menu[id_induk] AND a.username='$_SESSION[namauser]' 
														ORDER BY a.id_anak");
									while($menu_a = mysql_fetch_array($sqlx)){
										echo "
											<li><a href='$menu_a[link]'><i class='$menu_a[menu_class]'></i> $menu_a[menu_caption]</a></li>";							
									}
									
									echo "</ul>";
								}
								echo " 									
								</li>";	
							}	
						?>						
						<li>
							<a href='?mod=exit'><i class='fa fa-sign-out'></i><span> Sign Out</span></a>
						</li>
                    </ul>
                </section>
            </aside>
			
            <aside class="right-side">
                <section class="content-header">
                    <h1>
                        Penjualan Sakasaki
                        <small>Rekap Harian</small>                    
					</h1>
					<ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-folder-open"></i>Laporan</a></li>
                        <li class="active">Rekap Penjualan Sakasaki</li>
                    </ol>
                </section>
				
                <section class="content">
                	<div class="box box-solid">
						<div class="box-header no-print" >							
							<div class="form-group"><br>								
								<div class="col-lg-6">
									<select class="form-control" id="cboarea">
										<option value='' selected> - Cabang Toko - </option>
									</select>	
								</div>	
								<div class="col-lg-3">
									<div class="input-group input-medium date date-picker" data-date-format="dd-mm-yyyy" data-date-end-date="+0d">
										<div class="input-group-addon">
											<i class="fa fa-calendar"></i>
										</div>											
										<input type="text" id="tgltrx1" style="background:#FFFFFF" class="form-control text-center" readonly />										
									</div>	
								</div>
								<div class="col-lg-3">
									<div class="input-group input-medium date date-picker" data-date-format="dd-mm-yyyy" data-date-end-date="+0d">
										<div class="input-group-addon">
											<i class="fa fa-calendar"></i>
										</div>											
										<input type="text" id="tgltrx2" style="background:#FFFFFF" class="form-control text-center" readonly />										
									</div>	
								</div>
							</div>												
						</div><br>	
					</div>	
					<div class="box box-solid">	
						<div class="box-body"><br>
							<div class="row">								
								<div class="col-sm-12 invoice-col">
									<center>
										<strong>REKAP PENJUALAN PRODUK SAKASAKI</strong><br>
										<span id='lbltgltrx'>Tgl.</span><br>
										<span >(Dalam Liter / Kg)</span>
									</center>
								</div>
							</div><br>
							<div class="table-responsive" id="tampildata"></div>
						</div><br>
						<div class="box-footer no-print text-right">							
							<button type="button" class="btn btn-default"><a class="download" href="?mod=expexcreksaki" style='color:#000000'>
								<i class="fa fa-cloud-download"></i>&nbsp;Export Ke Excel</a>
							</button>															
						</div>	
					</div>		
                </section>
            </aside>
        </div>  
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
		<script src="assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js" type="text/javascript"></script>
		<script src="js/rekjlsk.js"></script>
        <script src="js/AdminLTE/app.js" type="text/javascript"></script>
		<script src="assets/admin/pages/scripts/components-pickers.js"></script>	
		<script src="assets/global/scripts/metronic.js" type="text/javascript"></script>
		<script src="js/jquery.idle.js" type="text/javascript"></script>	
		<script>
			jQuery(document).ready(function() { 
			   	Metronic.init(); 
			    ComponentsPickers.init();
			});

			$(document).idle({
				onIdle: function(){
					window.location.assign('?mod=exit');	
				},
				idle: 720000
			});
			
			window.setTimeout("waktu()", 1000);
		
			function waktu() {
				var waktu = new Date();
				setTimeout("waktu()", 1000);
				var jam = waktu.getHours();
				var menit = waktu.getMinutes();
				var detik = waktu.getSeconds();
				
				if(detik==59){
					$.ajax({
						type: 'POST', 
						url: 'pages/info/xxxxx.php',
						success: function(data) {}
					});						
				}	
			}						
		</script>
    </body>
</html>