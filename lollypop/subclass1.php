<? include 'koneksi.php';

if($_GET['mode']==1){
	echo '<h4>Add Subclass</h4>';
	$i='savetoadd';
}else if($_GET['mode']==2){
	echo '<h4>Edit Subclass</h4>';
	$i='savetoedit';
}
	$sel=mysql_fetch_array(mysql_query("SELECT * FROM subclass WHERE subclass_id = '$_GET[scid]'"));?>

<form target="_self" method='POST'>
<table >
	<tr>
		<td width='40%'>Class</td>
		<td width='3%'>:</td>
		<td><select name='class'>
									<option disabled selected>choose class</option>
									<?
									$q=mysql_query("SELECT * FROM class ORDER BY class_id ASC");
									while($s=mysql_fetch_array($q)){?>
										<option value='<?=$s['class_id']?>' <?if($sel['class_id']==$s['class_id']) echo 'selected';?>><?=$s['class_name']?></option>
									<?}
									?>
									</select>
				</td>
	</tr>
	<tr>
		<td>Subclass Name</td>
		<td>:</td>
		<td><input type='text' name='subclass' value='<?=$sel['subclass_name']?>'></td>
	</tr>
	<tr>
		<input type='hidden' name='scid' value='<?=$_GET['scid']?>'>
		<td colspan='3'><input type='submit' name='<?=$i?>' value='Save'></td>
	</tr>
	
</table>
</form>