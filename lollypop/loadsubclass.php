<? include 'koneksi.php';

if(!isset($_GET['cid'])){
	if(isset($_SESSION['sid'])){
		$cekid=mysql_fetch_row(mysql_query("SELECT subclass_id FROM student_class WHERE student_id = '$_SESSION[sid]'"));
		$cekidi=$cekid[0];
		$sclass = $selectclass['class_id'];
	}else if(isset($_SESSION['iid'])){
		$cekidi=$select['subclass_id'];
		$sclass = $select['class_id'];
	}
$q=mysql_query("SELECT * FROM subclass WHERE class_id = '$sclass'");
}else{
	
$q=mysql_query("SELECT * FROM subclass WHERE class_id = '$_GET[cid]'");
}
?>
<select name='subclass'>
<?if(isset($_GET['print'])){?>
	<option value='all'>All SubClass</option>
<?}else{?>
	<option disabled selected>choose subclass</option>
<?}

while($s=mysql_fetch_array($q)){?>
	
		<option value='<?=$s['subclass_id']?>' <?if($s['subclass_id']==$cekidi) echo 'selected';?>><?=$s['subclass_name']?></option>
	

<?}
?></select>

