<?php

	date_default_timezone_set('UTC');
	include 'koneksi.php';
	session_start();
	$tanggal = date('d');
	$bulan = date('m');
	$tahun = date('Y');
	
	if(isset($_GET['del'])){
		$sel=mysql_fetch_array(mysql_query("SELECT * FROM booking WHERE kode_booking = '$_GET[del]'"));
		if($sel['status']=='menunggu konfirmasi'){
			$status='dibatalkan#1';
		}else if($sel['status']=='menunggu tanda jadi'){
			$status = 'dibatalkan#2';
		}else if($sel['status']=='booked'){
			$status = 'dibatalkan#3';
		}
		$update1=mysql_query("UPDATE kamar SET status = 'tersedia' WHERE kode_kamar = '$sel[kode_kamar]'");
		$update=mysql_query("UPDATE booking SET status = '$status' WHERE kode_booking = '$_GET[del]'");
		if($update1 && $update){
				?>
			<script language='JavaScript'>
						alert("Status Pesanan berhasil dibatalkan / diselesaikan");
						document.location='index.php?page=pesanan';
					</script>
		<?
		}
	}
	if(isset($_GET['update'])){
		$sel=mysql_fetch_array(mysql_query("SELECT * FROM booking WHERE kode_booking = '$_GET[update]'"));
		if($sel['status']=='menunggu konfirmasi'){
			$status='menunggu tanda jadi';
			
	if($bulan == '01' || $bulan == '03' || $bulan == '05' || $bulan == '07' || $bulan == '08' || $bulan == '10' || $bulan == '12')
								$limitdays = 31;
							else if($bulan == '04' || $bulan == '06' || $bulan == '09' || $bulan == '11')
								$limitdays = 30;
							else{
								if($tahun1%4 == 0)
									$limitdays = 29;
								else
									$limitdays = 28;
							}
	
	$tanggal1=$tanggal+2;
	$bulan1=$bulan;
	$tahun1=$tahun;
	if($tanggal1 > $limitdays){
		$bulan1=$bulan1+1;
		$tanggal1=$tanggal1-$limitdays;
		if($bulan1>12){
			$tahun1=$tahun1+1;
			$bulan1=$bulan1-12;
		}
	}
	
	$exp=$tahun1.'-'.$bulan1.'-'.$tanggal1;
	
	
		}else if($sel['status']=='menunggu tanda jadi'){
			$status = 'booked';
			$exp='0000-00-00';
		}
		
		$update1=mysql_query("UPDATE kamar SET status = '$status' WHERE kode_kamar = '$sel[kode_kamar]'");
		$update=mysql_query("UPDATE booking SET status = '$status', tanggal=NOW(), tanggal1='$exp' WHERE kode_booking = '$_GET[update]'");
		if($update1 && $update){
				?>
			<script language='JavaScript'>
						alert("Status Pesanan berhasil di-update");
						document.location='index.php?page=pesanan';
					</script>
		<?
		}
	}
$url =  explode("/",$_SERVER['REQUEST_URI']);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang='en' xmlns="http://www.w3.org/1999/xhtml">

<head>

    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <meta name='description' content=''>
    <meta name='author' content=''>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Anaron Kost</title>

    <!-- jQuery -->
    <script src="../js/jquery.js"></script>
    <!-- Bootstrap Core CSS -->
    <link href='../css/bootstrap.css' rel='stylesheet'>
	
	<!-- DataTables CSS -->
	<link href="../css/plugins/dataTables.bootstrap.css" rel="stylesheet">
	
	<!-- Custom Fonts -->
    <link href="../font-awesome-4.1.0/css/font-awesome.css" rel="stylesheet" type="text/css">
		
<script type="text/javascript" src="../js/jquery.imagemapster.js"></script>

		
	<style>
		body{
			font-size:9pt;
			font-family: arial;
		}
		
		table {
			table-layout:fixed;
			word-wrap:break-word;
		}
		
		.container{
			border: 1px grey solid;
			padding: 0px;
			border-top: 0px;
		}
		
		#banner{
			height: 100px;
			width: 100%;
		}
		
		h4{
			margin:0px;
		}
		
		.navbar{
			border-radius: 0;
			border-top: 2px grey solid;
			border-bottom: 2px grey solid;
		}
		
		<!-- Costum table with bootstrap -->		
		table.dataTable thead .sorting,
		table.dataTable thead .sorting_asc,
		table.dataTable thead .sorting_desc,
		table.dataTable thead .sorting_asc_disabled,
		table.dataTable thead .sorting_desc_disabled {
			background: 0 0;
		}

		table.dataTable thead .sorting_asc:after {
			content: "\f0de";
			float: right;
			font-family: fontawesome;
		}

		table.dataTable thead .sorting_desc:after {
			content: "\f0dd";
			float: right;
			font-family: fontawesome;
		}

		table.dataTable thead .sorting:after {
			content: "\f0dc";
			float: right;
			font-family: fontawesome;
			color: rgba(50,50,50,.5);
		}

#content{
min-height: 400px;
}

#footer{
width:100%;
margin-top: 50px;
padding: 10px 0px;
border-top:1px black solid;
}

@media screen and (max-width: 800px) {
    body {
		font-size: 1em;
	}
}


td,th, tr{
	padding:5px
}
	</style>

    <!-- Bootstrap Core JavaScript -->
    <script src="../js/bootstrap.min.js"></script>
<script>
function deLete(kodebooking){
	var conf = confirm('Anda yakin akan menghapus data pesanan tersebut ?')
		if(conf == true){
			window.location.href="index.php?del="+kodebooking;
			return true;
		}else
			return false;
}
function upDate(kodebooking){
	var conf = confirm('Anda yakin akan melanjutkan proses pemesanan ini ?')
		if(conf == true){
			window.location.href="index.php?update="+kodebooking;
			return true;
		}else
			return false;
}
</script>
    	
</head>
<?

if(date('l')=='Sunday')
	$hariini = 'Minggu';
if(date('l')=='Monday')
	$hariini = 'Senin';
if(date('l')=='Tuesday')
	$hariini = 'Selasa';
if(date('l')=='Wednesday')
	$hariini = 'Rabu';
if(date('l')=='Thursday')
	$hariini = 'Kamis';
if(date('l')=='Friday')
	$hariini = 'Jumat';
if(date('l')=='Saturday')
	$hariini = 'Sabtu';

if(date('F')=='January')
	$bulanini = 'Januari';
if(date('F')=='February')
	$bulanini = 'Februari';
if(date('F')=='March')
	$bulanini = 'Maret';
if(date('F')=='April')
	$bulanini = 'April';
if(date('F')=='May')
	$bulanini = 'Mei';
if(date('F')=='June')
	$bulanini = 'Juni';
if(date('F')=='July')
	$bulanini = 'Juli';
if(date('F')=='August')
	$bulanini = 'Agustus';
if(date('F')=='September')
	$bulanini = 'September';
if(date('F')=='October')
	$bulanini = 'Oktober';
if(date('F')=='November')
	$bulanini = 'November';
if(date('F')=='December')
	$bulanini = 'Desember';
?>
<body>
	<div class='container' >
		<div class='row'>
			<div class='col-md-12' >
				<div id='banner' >
					<img src='' style='width: 100%; height: 100%; position : relative;'>
					<span style='float:right;right:30px;top:60px;background: white; padding: 7px; position : absolute;'><?echo $hariini.', '.date('d').' '.$bulanini.' '.date('Y');?></span>
				</div>
				<nav class='navbar' > 
					<div id='menu' style='width:100%; float: left;'>
						<ul class='nav navbar-nav'>
							<li ><a href='index.php?page=pesanan'>Pesanan</a></li>
						</ul>
					</div>
				</nav>
			</div>
		</div>
		
		<div class='row' >
		
			<div id='content'>
				<?
				if($_GET['page']=='pesanan'){
					include 'pesanan.php';
				}else if($_GET['page']=='tambahpesanan'){
					include 'tambahpesanan.php';
				}else if($_GET['page']=='prosesbooking'){
					include 'prosesbooking.php';
				}else if($_GET['page']=='editpesanan'){
					include 'editpesanan.php';
				}else if($_GET['page']=='editbooking'){
					include 'prosesbooking.php';
				}
				?>
					
			</div>
		</div>
		<div class='row'>
			<div class='col-lg-12' >
				<div id='footer'>
					<span style='margin-left: 34%'>Copyright &copy 2016 Anaron Kost & Design By Ronly Shaldy</span>
				</div>
			
			</div>
			</div>
	</div>
	
			
	
	<!-- Page-Level Demo Scripts - Notifications - Use for reference -->
    <script>
    // tooltip demo
    $('.tooltip-demo').tooltip({
        selector: "[data-toggle=tooltip]",
        container: "body"
    })

    // popover demo
    $("[data-toggle=popover]")
        .popover()
    </script>
</body>

</html>