<?php
date_default_timezone_set('UTC');

	include 'koneksi.php';
$tanggal = date('d');
$bulan = date('m');
$tahun = date('Y');
	session_start();
	
	if(isset($_SESSION['sid'])){
		if($_GET['page']!= MD5('addmisionformtoedit') )
			unset($_SESSION['sid']);
	}else if(isset($_SESSION['iid'])){
		if($_GET['page']!= MD5('inventoryformtoedit') )
			unset($_SESSION['iid']);
	}
$url =  explode("/",$_SERVER['REQUEST_URI']);

if(isset($_POST['downloadbackup'])){
	$error = "";
	if(extension_loaded('zip')){
		$zip = new ZipArchive();			// Load zip library	
				$zip_name = "lollypop_".$tahun."-".$bulan."-".$tanggal.".zip";			// Zip name
				if($zip->open($zip_name, ZIPARCHIVE::CREATE)!==TRUE){		// Opening zip file to load files
					$error .=  "* Sorry ZIP creation failed at this time<br/>";
				}
				$zip->addFile('tempfile/admission_form.csv');			// Adding files into zip
				$zip->addFile('tempfile/class.csv');			// Adding files into zip
				$zip->addFile('tempfile/student_class.csv');			// Adding files into zip
				$zip->addFile('tempfile/files_upload.csv');			// Adding files into zip
				$zip->addFile('tempfile/inventory.csv');			// Adding files into zip
				$zip->addFile('tempfile/subclass.csv');			// Adding files into zip
				$zip->addFile('tempfile/user.csv');				// Adding files into zip
				
				$source = realpath('/appserv/www/lollypop/students');
				
				if (is_dir($source)) {
					$files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($source), RecursiveIteratorIterator::SELF_FIRST);
					foreach ($files as $file) {
						$file = realpath($file);
						
						
						if (is_dir($file)) {
							$zip->addEmptyDir(str_replace('C:\AppServ\www\lollypop\students', 'students', $file));
						} else if (is_file($file)) {
							$zip->addFromString(str_replace('C:\AppServ\www\lollypop\students', 'students', $file), file_get_contents($file));
						}
					}
				} else if (is_file($source)) {
					$zip->addFromString(basename($source), file_get_contents($source));
				}
				$source1 = realpath('/appserv/www/lollypop/inventory');
				if (is_dir($source)) {
					$files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($source1), RecursiveIteratorIterator::SELF_FIRST);
					foreach ($files as $file) {
						$file = realpath($file);
						
						
						if (is_dir($file)) {
							$zip->addEmptyDir(str_replace('C:\AppServ\www\lollypop\inventory', 'inventory', $file));
						} else if (is_file($file)) {
							$zip->addFromString(str_replace('C:\AppServ\www\lollypop\inventory', 'inventory', $file), file_get_contents($file));
						}
					}
				} else if (is_file($source1)) {
					$zip->addFromString(basename($source1), file_get_contents($source1));
				}
				$zip->close();
				if(file_exists($zip_name)){
					// push to download the zip
					header('Content-type: application/zip');
					header('Content-Disposition: attachment; filename="'.$zip_name.'"');
					readfile($zip_name);
					// remove zip file is exists in temp path
					unlink($zip_name);
				}
			
	}else
			$error .= "* You dont have ZIP extension<br/>";

}else if(isset($_POST['uploadbackup'])){
	include 'actionrestore.php';
}


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
    <title>Lollypop Preschool</title>

    <!-- Bootstrap Core CSS -->
    <link href='css/bootstrap.css' rel='stylesheet'>
	
	
    <link href='css/popupimg.css' rel='stylesheet'>
	
	<!-- DataTables CSS -->
	<link href="css/plugins/dataTables.bootstrap.css" rel="stylesheet">
	
	<!-- Custom Fonts -->
    <link href="font-awesome-4.1.0/css/font-awesome.css" rel="stylesheet" type="text/css">
		
	<style>
		body{
			font-size:11pt;
			font-family: calibri;
		}
		
		table {
			table-layout:fixed;
			word-wrap:break-word;
		}
		th, td {
		padding: 3px 5px 3px 5px;
	}
		.container{
			padding: 0px;
		}
		
		.navbar{
			border-top: 1px grey solid;
			border-bottom: 1px grey solid;
			margin-bottom:0px;
			border-radius:0px;
		}
		
		#menu{
		margin-left: 30px;
		width:100%; 
		float: left;
		}
		
#content{
min-height: 400px;
margin-bottom:20px;
}

@media screen and (max-width: 800px) {
    body {
		font-size: 1em;
	}
}

		#banner{
			height: 130px;
			width: 100%;
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
		
		h4{
			font-size:20pt;
		}
		

		
		
	</style>

    <!-- jQuery -->
    <script src="js/jquery.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <script>
		
		function goBack(){
						window.history.back();
					}
		function isNumberKey(evt){
			var charCode = (evt.which) ? evt.which : evt.keyCode;
			if(charCode != 46 && charCode > 31 && (charCode < 48 || charCode >57))
				return false;
				
			return true;
		}
		function loadPage(pageURL,div){
			var xmlhttp;
			if (window.XMLHttpRequest)
			  {// code for IE7+, Firefox, Chrome, Opera, Safari
			  xmlhttp=new XMLHttpRequest();
			  }
			else
			  {// code for IE6, IE5
			  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			  }
			xmlhttp.onreadystatechange=function()
			  {
			  if (xmlhttp.readyState==4 && xmlhttp.status==200)
				{
				document.getElementById(div).innerHTML=xmlhttp.responseText;
				}
			  }
			xmlhttp.open("GET",pageURL,true);
			xmlhttp.send();
		}
		
function deLete(id, title, mode){
	if(mode == 'file'){
		var conf = confirm('Anda yakin akan menghapus berkas \n "'+title+'" ?')
		if(conf == true){
			window.location.href="index.php?page=<?=MD5('studentdata')?>&del="+id+"&mode="+mode;
			return true;
		}else
			return false;
	}else if(mode == 'student'){
		var conf = confirm('Anda yakin akan menghapus data siswa \n "'+title+'" ?')
		if(conf == true){
			window.location.href="index.php?page=<?=MD5('studentdata')?>&del="+id+"&mode="+mode;
			return true;
		}else
			return false;
	}else if(mode == 'inventory'){
		var conf = confirm('Anda yakin akan menghapus data inventory \n "'+title+'" ?')
		if(conf == true){
			window.location.href="index.php?page=<?=MD5('inventory')?>&del="+id+"&mode="+mode;
			return true;
		}else
			return false;
	}else if(mode == 'subclass'){
		var conf = confirm('Anda yakin akan menghapus data subclass \n "'+title+'" ?')
		if(conf == true){
			window.location.href="index.php?page=<?=MD5('subclass')?>&del="+id+"&mode="+mode;
			return true;
		}else
			return false;
	}
}

</script>



</head>

<body >
	
	<?
		if(!isset($_SESSION['user'])){
			?>
			<img src='img/bannerlogin.jpg' style='position:absolute; width:100%; z-index:-1000'>
		<?}?>
	<div class='container' >
		<div class='row'>
			<div class='col-md-12' >
				<div id='banner' >
					<?
		if(isset($_SESSION['user'])){
			?><img src='img/banner.jpg' style='width:100%;height:100%;'>
		<?}?>
				</div>
				<?
				if(isset($_SESSION['user'])){
				?>
				<nav class='navbar' > 
					<div id='menu' >
						<ul class='nav navbar-nav'>
							<li ><a href='index.php'>Home</a></li>
							<li ><a data-toggle="dropdown" href='#'>Data Master</a>
								<ul class='dropdown-menu' >
									<li><a href='index.php?page=<?=MD5('studentdata');?>'>Student</a></li>
									<li><a href='index.php?page=<?=MD5('inventory');?>'>Inventory</a></li>
								</ul>
							</li>
							<li ><a data-toggle="dropdown" href='#'>Maintenance</a>
								<ul class='dropdown-menu' >
									<li><a href='index.php?page=<?=MD5('classmaintenance');?>'>Class</a></li>
									<li><a href='index.php?page=<?=MD5('backup');?>'>Backup</a></li>
									<li><a href='index.php?page=<?=MD5('restore');?>'>Restore</a></li>
								</ul>
							</li>
							<li ><a data-toggle="dropdown" href='#'>Setting</a>
								<ul class='dropdown-menu' >
									<li><a href='index.php?page=<?=MD5('changepassword');?>'>Password</a></li>
									<li><a href='index.php?page=<?=MD5('subclass');?>'>Sub Class</a></li>
								</ul>
							</li>
							<li><a href='logout.php'>Keluar</a></li>
						</ul>
					</div>
				</nav>
				<?
				}
				?>
			</div>
		</div>
		
		<div id='content'>
			<div class='row'>
			<div class='col-md-12' >
				<?
				if(isset($_SESSION['user'])){
					if(isset($_POST['uploadstudentfile'])&&$_GET['page']== MD5('studentdata')){
						include 'otherprocess.php';
					}else if(isset($_GET['del'])&&$_GET['page']== MD5('studentdata')){
						include 'otherprocess.php';
					}else if($_GET['page'] == MD5('studentdata')){
						include 'studentdata.php';
						
					}else if($_GET['page'] == MD5('addmisionformtoadd')){
						include 'admissionform.php';
						
					}else if(isset($_GET['sid'])&&$_GET['page']== MD5('addmisionformtoedit')){
						include 'otherprocess.php';
					}else if($_GET['page'] == MD5('addmisionformtoedit')&&!isset($_GET['sid'])){
						include 'admissionform.php';
					
					}else if(isset($_GET['sid'])&&$_GET['page']== MD5('detailstudent')){
						include 'otherprocess.php';
					}else if($_GET['page']== MD5('detailstudent')&&!isset($_GET['sid'])){
						include 'detailview.php';
					
					}else if($_GET['page'] == MD5('personalprofile')){
						include 'personalprofile.php';
					}else if($_GET['page'] == MD5('medicalhistory')){
						include 'medicalhistory.php';
						
					}else if(isset($_GET['del'])&&$_GET['page']== MD5('inventory')){
						include 'otherprocess.php';
					}else if($_GET['page'] == MD5('inventory')){
						include 'inventory.php';
					}else if($_GET['page'] == MD5('inventoryformtoadd')){
						include 'inventoryform.php';
					}else if(isset($_GET['iid'])&&$_GET['page']== MD5('inventoryformtoedit')){
						include 'otherprocess.php';
					}else if($_GET['page'] == MD5('inventoryformtoedit')&&!isset($_GET['iid'])){
						include 'inventoryform.php';
						
					}else if($_GET['page'] == MD5('classmaintenance')){
						include 'classmaintenance.php';
					}else if($_GET['page'] == MD5('backup')){
						include 'backup.php';
					}else if($_GET['page'] == MD5('restore')){
						include 'restore.php';
						
					}else if($_GET['page'] == MD5('changepassword')){
						include 'changepassword.php';
				
					}else if(isset($_GET['del'])&&$_GET['page'] == MD5('subclass')){
						include 'otherprocess.php';
					}else if($_GET['page'] == MD5('subclass')){
						include 'subclass.php';
					}else{
						include 'home.php';
					}
				}else{
					include 'login.php';
				}
				
				
				?>
			</div>
			</div>
		</div>
		
	</div>
	
<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- The Close Button -->
  <span class="close" onclick="document.getElementById('myModal').style.display='none'">&times;</span>

  <!-- Modal Content (The Image) -->
  <img class="modal-content" id="img01">

  <!-- Modal Caption (Image Text) -->
  <div id="caption"></div>
</div>
												<script src="js/popupimg.js"></script>

			
	
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