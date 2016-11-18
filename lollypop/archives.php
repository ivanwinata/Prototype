<?
include 'koneksi.php';
$selectstudent=mysql_fetch_row(mysql_query("SELECT af.full_name, c.class_name, af.birthday FROM admission_form AS af, student_class AS sc, class AS c WHERE af.student_id = '$_GET[sid]' AND sc.student_id = af.student_id AND c.class_id = sc.class_id"));
?>
    <!-- jQuery -->
    <script src="js/jquery.js"></script>
<div style='width:100%; margin:0 auto; border-top:1px grey solid;margin-bottom:10px;'>
</div>
<h4 style='margin-top:0px;'>
							<b>Student's Archives</b>
						</h4>
						
<form  target="_self" method='POST' enctype='multipart/form-data'>
<table class='col-md-4'>
	<tr>
		<td width='30%'>Student's Name</td>
		<td width='3%'>:</td>
		<td><?=$selectstudent[0]?></td>
	</tr>
	<tr>
		<td>Student's Class</td>
		<td>:</td>
		<td><?=$selectstudent[1]?></td>
	</tr>
	<tr>
		<td>File Title</td>
		<td>:</td>
		<td><input type='text' name='filetitle' ></td>
	</tr>
	<tr>
		<td>File Upload</td>
		<td>:</td>
		<td><input type='file' name='file'></td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td><input type='submit' name='uploadstudentfile' value='Upload'><input type='hidden' name='sid' value='<?=$_GET['sid']?>'></td>
	</tr>
</table>
</form>
<table border='1' class='col-md-6'>
	<tr style='background:beige;'>
		<th width='8%'>No.</th>
		<th>File Title</th>
		<th width='20%'>Option</th>
	</tr>
	<?
	$no=1;
	$query=mysql_query("SELECT * FROM files_upload WHERE student_id = '$_GET[sid]'");
	while($selectfile = mysql_fetch_array($query)){ ?>
	<tr>
		<td ><?=$no?></td>
		<td><?=$selectfile['file_title']?></td>
		<td>
			<table >
			<tr>
			<td style='padding: 2px;'>
			<a href='students/<?=$selectstudent[0].'_'.$selectstudent[2]?>/archives/<?=$selectfile['file_name']?>' target=_blank title="View File" ><img src='icons/view.png' width='70%'></a></td>
			<td style='padding: 2px;'>
			<a href='#' title="Delete File" onclick='deLete("<?=$selectfile['id']?>","<?=$selectfile['file_title']?>","file")'><img src='icons/document_remove.png' width='70%'></a></td>
			</tr>
			</table>
		</td>
	</tr>
	<? $no++; }
	
	if($no==1){
	?>
	<tr>
		<td colspan='3'>Nothing</td>
	</tr>
	<? } ?>
</table>
