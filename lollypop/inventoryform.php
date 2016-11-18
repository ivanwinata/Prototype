<?
$url2 =  explode("&",$url[2]);
if(isset($_POST['savetoadd'])){
	if($_POST['class']!=''){
	if($_POST['path']=='games'){
		
		$cek=mysql_num_rows(mysql_query("SELECT * FROM inventory WHERE id_inventory = '$_POST[id]'"));

		if($cek==0){
		$x='';
		$ceknama=mysql_num_rows(mysql_query("SELECT id_inventory FROM inventory WHERE inventory_name = '$_POST[name]'"));	
		if($ceknama>0)
			$x=$ceknama+1;
		
		$img_type = array('image/png','image/jpg','image/jpeg','image/gif');
		$img_name1 = $_FILES['photo1']['name'];
		$type1 = $_FILES['photo1']['type'];
		$error1 = $_FILES['photo1']['error'];
		
		$newimgname1='';
		if($img_name1!='' && in_array($type1, $img_type)){
		$temp1 = explode(".", $img_name1);
		$newimgname1 = $_POST['name'].$x.'(first).' . end($temp1);
		}
		
		$img_name2 = $_FILES['photo2']['name'];
		$type2 = $_FILES['photo2']['type'];
		$error2 = $_FILES['photo2']['error'];
		
		$newimgname2='';
		if($img_name2!=''&&in_array($type2, $img_type)){
		$temp2 = explode(".", $img_name2);
		$newimgname2 = $_POST['name'].$x.'(second).' . end($temp2);
		}			
		$insert = mysql_query("INSERT INTO inventory VALUES(
		'$_POST[id]',
		'$_POST[name]',
		'$_POST[desc]',
		'$newimgname1',
		'$newimgname2',
		'$_POST[path]',
		'1',
		'$_POST[class]',
		'$_POST[subclass]')");
		
		if($insert){
			
			$folder = 'inventory/'.$_POST['path'];
				if (!file_exists($folder)) {
					mkdir($folder);
				}
			
			if($img_name1!=''){
				$photomove1=0;	
				if(in_array($type1, $img_type)){
						if(move_uploaded_file($_FILES['photo1']['tmp_name'], $folder.'/'.$newimgname1)){	
							$photomove1=1;
						}
				}
			}
			
			if($img_name2!=''){
					$photomove2=0;	
				if(in_array($type2, $img_type)){
						if(move_uploaded_file($_FILES['photo2']['tmp_name'], $folder.'/'.$newimgname2)){	
							$photomove2=1;
						}
				}
			}
			
			
			if(isset($photomove1)||isset($photomove2)){
				if($photomove1==1||$photomove2==1){
				?>
				<script language='JavaScript'>
							alert("Data berhasil ditambahkan");
							document.location='index.php?page=<?=MD5('inventory')?>';
						</script>
				<? }else{
				?>
				<script language='JavaScript'>
							alert("Data berhasil ditambahkan, namun gambar 1 dan/atau gambar 2 gagal di unggah karena type gambar tidak sesuai");
							document.location='index.php?page=<?=MD5('inventory')?>';
						</script>
				<? }
			}else{
				?>
				<script language='JavaScript'>
							alert("Data berhasil ditambahkan");
							document.location='index.php?page=<?=MD5('inventory')?>';
						</script>
				<?
			}
		}
		}else{
			?>
				<script language='JavaScript'>
							alert("Kode inventory sudah ada");
							goBack();
						</script>
			<?
		}
	}else if($_POST['path']=='books'){
		$cek=mysql_num_rows(mysql_query("SELECT * FROM inventory WHERE id_inventory = '$_POST[id]'"));

		if($cek==0){
			$insert = mysql_query("INSERT INTO inventory VALUES(
			'$_POST[id]',
			'$_POST[name]',
			'$_POST[desc]',
			'',
			'',
			'$_POST[path]',
			'1',
			'$_POST[class]',
		'$_POST[subclass]')");
			
			if($insert){
				?>
					<script language='JavaScript'>
								alert("Data berhasil ditambahkan");
								document.location='index.php?page=<?=MD5('inventory')?>';
							</script>
					<?
			}
		}
	}else if($_POST['path']=='assets'){
		$cek=mysql_num_rows(mysql_query("SELECT * FROM inventory WHERE id_inventory = '$_POST[id]'"));

		if($cek==0){
			$insert = mysql_query("INSERT INTO inventory VALUES(
			'$_POST[id]',
			'$_POST[name]',
			'',
			'',
			'',
			'$_POST[path]',
			'$_POST[qty]',
			'$_POST[class]',
		'$_POST[subclass]')");
			
			if($insert){
				?>
					<script language='JavaScript'>
								alert("Data berhasil ditambahkan");
								document.location='index.php?page=<?=MD5('inventory')?>';
							</script>
					<?
			}
		}
	}
	}else{ ?>
		<script language='JavaScript'>
									alert("Gagal, Class wajib dipilih");
									document.location='<?=$url[2]?>';
							</script>
	<? }
}else if(isset($_POST['savetoedit'])){
	if($_POST['class']!=''){
	if($_POST['path']=='games'){
		$img_type = array('image/png','image/jpg','image/jpeg','image/gif');
		$img_name1 = $_FILES['photo1']['name'];
		$type1 = $_FILES['photo1']['type'];
		$error1 = $_FILES['photo1']['error'];
		$img_name2 = $_FILES['photo2']['name'];
		$type2 = $_FILES['photo2']['type'];
		$error2 = $_FILES['photo2']['error'];
		
					
		$x='';
		$ceknama=mysql_num_rows(mysql_query("SELECT id_inventory FROM inventory WHERE inventory_name = '$_POST[name]'"));	
		if($ceknama>1)
			$x=$ceknama+1;
		
					$temp1 = explode(".", $img_name1);
					$newimgname1 = $_POST['name'].$x.'(first).' . end($temp1);
					
					$temp2 = explode(".", $img_name2);
					$newimgname2 = $_POST['name'].$x.'(second).' . end($temp2);
					
	$selecttt=mysql_fetch_row(mysql_query("SELECT path,picture, picture2 FROM inventory WHERE id_inventory = '$_SESSION[iid]'"));
	$tmppath = $selecttt[0];
	
	$olddir='inventory/'.$tmppath;
	$folder = 'inventory/'.$_POST['path'];
			
	
		if($img_name1!=''&&in_array($type1, $img_type)){
			$img1=$newimgname1;
			unlink($olddir.'/'.$_POST['tmppicture1']);
			$a1=move_uploaded_file($_FILES['photo1']['tmp_name'], $folder.'/'.$newimgname1);
		}else
			$img1=$_POST['tmppicture1'];
		
		if($img_name2!=''&&in_array($type2, $img_type)){
			$img2=$newimgname2;
			unlink($olddir.'/'.$_POST['tmppicture2']);
			$a2=move_uploaded_file($_FILES['photo2']['tmp_name'], $folder.'/'.$newimgname2);
		}else
			$img2=$_POST['tmppicture2'];
		
		$update = mysql_query("UPDATE inventory SET
		id_inventory = '$_POST[id]',
		inventory_name = '$_POST[name]',
		description = '$_POST[desc]',
		picture = '$img1',
		picture2 = '$img2',
		path = '$_POST[path]',
		class_id = '$_POST[class]',
		subclass_id = '$_POST[subclass]'
		WHERE id_inventory = '$_SESSION[iid]'");
		
		
		
		if($update){
			
			
				?>
				<script language='JavaScript'>
							alert("Data berhasil diupdate");
							document.location='index.php?page=<?=MD5('inventory')?>';
						</script>
				<?
		}
	}else if($_POST['path']=='books'){
		
		$update = mysql_query("UPDATE inventory SET
		id_inventory = '$_POST[id]',
		inventory_name = '$_POST[name]',
		description = '$_POST[desc]',
		class_id = '$_POST[class]',
		subclass_id = '$_POST[subclass]'
		WHERE id_inventory = '$_SESSION[iid]'");
		
			if($update){
				?>
					<script language='JavaScript'>
								alert("Data berhasil diupdate");
								document.location='index.php?page=<?=MD5('inventory')?>';
							</script>
					<?
			}
		
	}else if($_POST['path']=='assets'){
		
		$update = mysql_query("UPDATE inventory SET
		id_inventory = '$_POST[id]',
		inventory_name = '$_POST[name]',
		qty = '$_POST[qty]',
		class_id = '$_POST[class]',
		subclass_id = '$_POST[subclass]'
		WHERE id_inventory = '$_SESSION[iid]'");
		
			if($update){
				?>
					<script language='JavaScript'>
								alert("Data berhasil diupdate");
								document.location='index.php?page=<?=MD5('inventory')?>';
							</script>
					<?
			}
	}
	}else{
		?>
		<script language='JavaScript'>
									alert("Gagal, Class wajib dipilih");
									document.location='<?=$url[2]?>';
							</script>
	<?
	}
}
?>

<script>
	function changeCategory(value){
			window.location.href="<?=$url2[0]?>&c="+value;
	}
	
</script>
<style>
	input[type=text], #age{
		width:100%;
		border:0px solid black;
		border-bottom:1px solid grey;
		height:25px;
	}
	td, th{
		padding:5px 0px 5px 0px;
	}
	select{
		height:100%;
	}
	td i{
		color:grey;
	}
	textarea{
		width:500px;
		height:100px;
	}
</style>

	<?
	if($_GET['page']==MD5('inventoryformtoadd')){
	?>
					<div class="panel-body">
					
						<h4 style='margin-top:0px;'>
							<a href='#' onclick='goBack()' style='margin-right:10px;' title='kembali'><img src='icons/back.png' width='20px' height='20px'></a><b>Inventory Form <i>(Add Inventory's Data)</i></b>
						</h4>
						
						<form target="_self" method='POST' enctype='multipart/form-data'>
						<table width='70%'>
							<tr>
								<th width='10%'>Choose Category</th>
								<th width='1%'>:</th>
								<th width='30%'>
								<select name='path' onchange='changeCategory(this.value)'>
									<option value='' selected disabled>-</option>
									<option value='books' <?if($_GET['c']=='books') echo 'selected';?>>Books</option>
									<option value='games' <?if($_GET['c']=='games') echo 'selected';?>>Games</option>
									<option value='assets' <?if($_GET['c']=='assets') echo 'selected';?>>Assets</option>
								</select></th>
							</tr>
							<?if($_GET['c']=='games'){?>
							<tr>
								<td>Class</td>
								<td>:</td>
								<td><select name='class' onchange='loadPage("loadsubclass.php?cid="+this.value,"subclass");' style='float:left'>
								<option value='' disabled selected >-</option>
									<?
									
									$qclass=mysql_query("SELECT * FROM class");
									while($class=mysql_fetch_array($qclass)){ ?>
										<option value='<?=$class['class_id']?>' <?if($_GET['cid']==$class['class_id']) echo 'selected';?>><?=$class['class_name']?></option>
									<? }
									?>
								</select>
								<div id='subclass' style='float:left; margin-left:10px'>
									</div>
									</td>
							</tr>
							<tr>
								<td >Inventory Code</td>
								<td>:</td>
								<td ><input type='text' name='id' autofocus></td>
							</tr>
							<tr>
								<td >Inventory Name</td>
								<td>:</td>
								<td ><input type='text' name='name' autofocus></td>
							</tr>
							<tr>
								<td valign=top>Description</td>
								<td valign=top>:</td>
								<td ><textarea name='desc' ></textarea></td>
							</tr>
							<tr>
								<td >Picture 1</td>
								<td>:</td>
								<td><input type='file' name='photo1' ></td>
							</tr>
							<tr>
								<td >Picture 2</td>
								<td>:</td>
								<td><input type='file' name='photo2' ></td>
							</tr>
							
							<tr>
								<td colspan='3' align=right><input type='submit' name='savetoadd' value='Save'>&nbsp<input type='reset'></td>
							</tr>
							
							<? }else if($_GET['c']=='books'){ ?>
							<tr>
								<td>Class</td>
								<td>:</td>
								<td><select name='class' onchange='loadPage("loadsubclass.php?cid="+this.value,"subclass");' style='float:left'>
								<option value='' disabled selected >-</option>
									<?
									
									$qclass=mysql_query("SELECT * FROM class");
									while($class=mysql_fetch_array($qclass)){ ?>
										<option value='<?=$class['class_id']?>' <?if($_GET['cid']==$class['class_id']) echo 'selected';?>><?=$class['class_name']?></option>
									<? }
									?>
								</select>
								<div id='subclass' style='float:left; margin-left:10px'>
									</div>
									</td>
							</tr>							
							<tr>
								<td >Book Code</td>
								<td>:</td>
								<td ><input type='text' name='id' autofocus></td>
							</tr>
							<tr>
								<td >Book Name</td>
								<td>:</td>
								<td ><input type='text' name='name' autofocus></td>
							</tr>
							<tr>
								<td valign=top>Description</td>
								<td valign=top>:</td>
								<td ><textarea name='desc' ></textarea></td>
							</tr>
							
							<tr>
								<td colspan='3' align=right><input type='submit' name='savetoadd' value='Save'>&nbsp<input type='reset'></td>
							</tr>
							<?}else if($_GET['c']=='assets'){?>
								<tr>
								<td>Class</td>
								<td>:</td>
								<td><select name='class' onchange='loadPage("loadsubclass.php?cid="+this.value,"subclass");' style='float:left'>
								<option value='' disabled selected >-</option>
									<?
									
									$qclass=mysql_query("SELECT * FROM class");
									while($class=mysql_fetch_array($qclass)){ ?>
										<option value='<?=$class['class_id']?>' <?if($_GET['cid']==$class['class_id']) echo 'selected';?>><?=$class['class_name']?></option>
									<? }
									?>
								</select>
								<div id='subclass' style='float:left; margin-left:10px'>
									</div>
									</td>
							</tr>
							<tr>
								<td >Assets Code</td>
								<td>:</td>
								<td ><input type='text' name='id' autofocus></td>
							</tr>
							<tr>
								<td >Assets Name</td>
								<td>:</td>
								<td ><input type='text' name='name' autofocus></td>
							</tr>
							<tr>
								<td valign=top>Qty</td>
								<td valign=top>:</td>
								<td ><input type='text' name='qty' ></td>
							</tr>
							
							<tr>
								<td colspan='3' align=right><input type='submit' name='savetoadd' value='Save'>&nbsp<input type='reset'></td>
							</tr>
							<?}?>
							
						</table>
						</form>
						</div>
	
	
	
	
	
	
	<?
	}else if($_GET['page']==MD5('inventoryformtoedit')){

	$select=mysql_fetch_array(mysql_query("SELECT * FROM inventory WHERE id_inventory = '$_SESSION[iid]'"));
	?>
	<div class="panel-body">
					
						<h4 style='margin-top:0px;'>
							<a href='#' onclick='goBack()' style='margin-right:10px;' title='kembali'><img src='icons/back.png' width='20px' height='20px'></a><b>Inventory Form <i>(Edit Inventory's Data)</i></b>
						</h4>
						<form target="_self" method='POST' enctype='multipart/form-data'>
						<table width='70%'>
							<tr>
								<th width='10%'>Category</th>
								<th width='1%'>:</th>
								<th width='30%'><?=$select['path']?></th>
							</tr>
							<?if($select['path']=='games'){?>
							
							<tr>
								<td>Class</td>
								<td>:</td>
								<td><select name='class' onchange='loadPage("loadsubclass.php?cid="+this.value,"subclass");' style='float:left'>
								<option value='' disabled selected >-</option>
									<?
									
									$qclass=mysql_query("SELECT * FROM class");
									while($class=mysql_fetch_array($qclass)){ ?>
										<option value='<?=$class['class_id']?>' <?if($select['class_id']==$class['class_id']) echo 'selected';?>><?=$class['class_name']?></option>
									<? }
									?>
								</select>
								<div id='subclass' style='float:left;margin-left:10px'>
										<? include 'loadsubclass.php';?>
									</div></td>
							</tr><tr>
								<td >Inventory Code</td>
								<td>:</td>
								<td ><input type='text' name='id' autofocus value='<?=$select['id_inventory']?>'></td>
							</tr>
							<tr>
								<td >Inventory Name</td>
								<td>:</td>
								<td ><input type='text' name='name' autofocus value='<?=$select['inventory_name']?>'></td>
							</tr>
							<tr>
								<td valign=top>Description</td>
								<td valign=top>:</td>
								<td ><textarea name='desc' ><?=$select['description']?></textarea></td>
							</tr>
							<tr>
								<td valign=top>Picture 1</td>
								<td valign=top>:</td>
									<td ><?if($select['picture']!=''){?><img id="myImg" src='inventory/<?=$select['path']?>/<?=$select['picture']?>' width='100px'  alt='<?=$select['inventory_name']?>'><?}?><input type='file' name='photo1' value='<?=$select['picture']?>''><input type='hidden' name='tmppicture1' value='<?=$select['picture']?>'></td>
							</tr>
							<tr>
								<td valign=top>Picture 2</td>
								<td valign=top>:</td>
									<td ><?if($select['picture2']!=''){?><img id="myImg" src='inventory/<?=$select['path']?>/<?=$select['picture2']?>' width='100px'  alt='<?=$select['inventory_name']?>'><?}?><input type='file' name='photo2' value='<?=$select['picture']?>' ><input type='hidden' name='tmppicture2' value='<?=$select['picture2']?>'></td>
							</tr>
							
							<?}else if($select['path']=='books'){?>
								<tr>
								<td>Class</td>
								<td>:</td>
								<td><select name='class' onchange='loadPage("loadsubclass.php?cid="+this.value,"subclass");' style='float:left'>
								<option value='' disabled selected >-</option>
									<?
									
									$qclass=mysql_query("SELECT * FROM class");
									while($class=mysql_fetch_array($qclass)){ ?>
										<option value='<?=$class['class_id']?>' <?if($select['class_id']==$class['class_id']) echo 'selected';?>><?=$class['class_name']?></option>
									<? }
									?>
								</select>
								<div id='subclass' style='float:left;margin-left:10px'>
										<? include 'loadsubclass.php';?>
									</div></td>
							</tr>
							<tr>
								<td >Book's Code</td>
								<td>:</td>
								<td ><input type='text' name='id' autofocus value='<?=$select['id_inventory']?>'></td>
							</tr>
							<tr>
								<td >Book's Name</td>
								<td>:</td>
								<td ><input type='text' name='name' autofocus value='<?=$select['inventory_name']?>'></td>
							</tr>
							<tr>
								<td valign=top>Description</td>
								<td valign=top>:</td>
								<td ><textarea name='desc' ><?=$select['description']?></textarea></td>
							</tr>
							
							<?}else if($select['path']=='assets'){?>
<tr>
								<td>Class</td>
								<td>:</td>
								<td><select name='class' onchange='loadPage("loadsubclass.php?cid="+this.value,"subclass");' style='float:left'>
								<option value='' disabled selected >-</option>
									<?
									
									$qclass=mysql_query("SELECT * FROM class");
									while($class=mysql_fetch_array($qclass)){ ?>
										<option value='<?=$class['class_id']?>' <?if($select['class_id']==$class['class_id']) echo 'selected';?>><?=$class['class_name']?></option>
									<? }
									?>
								</select>
								<div id='subclass' style='float:left;margin-left:10px'>
										<? include 'loadsubclass.php';?>
									</div></td>
							</tr>							
							<tr>
								<td >Asset's Code</td>
								<td>:</td>
								<td ><input type='text' name='id' autofocus value='<?=$select['id_inventory']?>'></td>
							</tr>
							<tr>
								<td >Asset's Name</td>
								<td>:</td>
								<td ><input type='text' name='name' autofocus value='<?=$select['inventory_name']?>'></td>
							</tr>
							<tr>
								<td valign=top>Qty</td>
								<td valign=top>:</td>
								<td ><input name='qty' value='<?=$select['qty']?>'></td>
							</tr>
							
							<?}?>
							<input type='hidden' value='<?=$select['path']?>' name='path'>
							<tr>
								<td colspan='3' align=right><input type='submit' name='savetoedit' value='Save'>&nbsp<input type='reset'></td>
							</tr>
						</table>
						</form>
						</div>
						
	<?  }?>