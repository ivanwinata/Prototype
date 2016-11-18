<?
if(isset($_GET['sid'])&&$_GET['page']== MD5('addmisionformtoedit')){
	$tempurl=explode('&',$url[2]);
	$_SESSION['sid']=$_GET['sid']; ?>
	<script>
	document.location ='<?=$tempurl[0]?>';
	</script>
<? }else if(isset($_POST['uploadstudentfile'])){
		if($_POST['filetitle']!=''){
			$file_type = array('image/png','image/jpg','image/jpeg','image/gif','doc','docx','xls','xlsx','pdf');
			$file_name = $_FILES['file']['name'];
			$type = $_FILES['file']['type'];
			$error = $_FILES['file']['error'];
			
			$temp = explode(".", $file_name);
			$newfilename = $_POST['filetitle'].'.' . end($temp);
						
			
		
			$tempselect=mysql_fetch_row(mysql_query("SELECT full_name, birthday FROM admission_form WHERE student_id = '$_POST[sid]'"));
			if($file_name!='' && $error==0){
				
				if(in_array($type, $file_type)){
						$path = 'students/'.$tempselect[0].'_'.$tempselect[1];
						if (!file_exists($path)) {
							mkdir($path);
							
						}
						if(!file_exists($path.'/archives'))
								mkdir($path.'/archives');
						if(move_uploaded_file($_FILES['file']['tmp_name'], $path.'/archives/'.$newfilename)){	
							$insert=mysql_query("INSERT INTO files_upload VALUE('','$_POST[sid]','$_POST[filetitle]','$newfilename',NOW(),'$_SESSION[user]')");
							?>
								<script language='JavaScript'>
									alert("File berhasil di-unggah");
									document.location='<?=$url[2]?>';
								</script>
							<?
						}
					
				}else{?>
						<script language='JavaScript'>
							alert("File tidak berhasil di-unggah. Format salah");
							document.location='<?=$url[2]?>';
						</script>
			<?}
			}else{?>
						<script language='JavaScript'>
							alert("File tidak berhasil di-unggah. Harap memilih file yang aka di-unggah");
							document.location='<?=$url[2]?>';
						</script>
			<?
			
			}
		}else{ ?>
					<script language='JavaScript'>
						alert("File tidak berhasil di-unggah. Harap mengisi judul file dan memilih file");
						document.location='<?=$url[2]?>';
					</script>
		<?
		}
}else if(isset($_GET['del'])){
	if($_GET['mode']=='file'){
	$select=mysql_fetch_row(mysql_query("SELECT a.full_name, a.birthday, b.file_name FROM admission_form AS a, files_upload AS b WHERE b.id='$_GET[del]' AND a.student_id=b.student_id"));
		if(unlink("students/".$select[0].'_'.$select[1].'/archives/'.$select[2])){
			if($del=mysql_query("DELETE FROM files_upload WHERE id='$_GET[del]'")){
				$tmpurl=explode('&',$url[2]);
				
				?>
					<script language='JavaScript'>
					
						alert('File berhasil dihapus');
						document.location='<?=$tmpurl[0]?>';
					</script>
		<?
			
			}
		}
	}else if($_GET['mode']=='student'){
		$update=mysql_query("UPDATE admission_form SET status='disactive' WHERE student_id='$_GET[del]'");
		if($update){
			$tmpurl=explode('&',$url[2]);
			?>
					<script language='JavaScript'>
						alert('Data siswa berhasil dihapus');
						document.location='<?=$tmpurl[0]?>';
					</script>
		<?
		}
	}else if($_GET['mode']=='inventory'){
		$select=mysql_fetch_array(mysql_query("SELECT * FROM inventory WHERE id_inventory = '$_GET[del]'"));
		if($select['picture']!='')
			unlink('inventory/'.$select['path'].'/'.$select['picture']);
		if($select['picture2']!='')
			unlink('inventory/'.$select['path'].'/'.$select['picture2']);
		
		$delete=mysql_query("DELETE FROM inventory WHERE id_inventory = '$_GET[del]'");
		if($delete){
			
			$tmpurl=explode('&',$url[2]);
			?>
					<script language='JavaScript'>
						alert('Data inventory berhasil dihapus');
						document.location='<?=$tmpurl[0]?>';
					</script>
		<?
		}
	}else if($_GET['mode']=='subclass'){
		$update = mysql_query("UPDATE student_class SET subclass_id = '0' WHERE subclass_id = '$_GET[del]'");
		$delete=mysql_query("DELETE FROM subclass WHERE subclass_id = '$_GET[del]'");
		if($delete){
			
			$tmpurl=explode('&',$url[2]);
			?>
					<script language='JavaScript'>
						alert('Data subclass berhasil dihapus');
						document.location='<?=$tmpurl[0]?>';
					</script>
		<?
		}
	}
}else if(isset($_GET['iid'])&&$_GET['page']== MD5('inventoryformtoedit')){
	$tempurl=explode('&',$url[2]);
	$_SESSION['iid']=$_GET['iid'];?>
	<script>
	document.location ='<?=$tempurl[0]?>';
	</script>
<? }