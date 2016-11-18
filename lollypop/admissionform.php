<?

if(($bulan==6 && $tanggal>10)||$bulan>=7){
	$studyyear1=$tahun.'/'.($tahun+1);
	$studyyear2=($tahun+1).'/'.($tahun+2);
}else{
	$studyyear1=($tahun-1).'/'.$tahun;
	$studyyear2=$tahun.'/'.($tahun+1);
}

if(isset($_POST['savetoadd'])){
	
	if($_POST['fullname'] != '' && $_POST['class'] != '' && $_POST['year'] != '' && $_POST['birthday'] != ''){
	$img_type = array('image/png','image/jpg','image/jpeg','image/gif');
	
		$folder = 'students/'.$_POST['fullname'].'_'.$_POST['birthday'];
		if (!file_exists($folder)) {
				mkdir($folder);
		}	
	
	
	$img_name = $_FILES['photo']['name'];
	$type = $_FILES['photo']['type'];
	$error = $_FILES['photo']['error'];
	$newimgname='';
	if($img_name!='' || in_array($type, $img_type)){
				$temp = explode(".", $img_name);
				$newimgname = $_POST['fullname'].'_'.$_POST['birthday'].'.' . end($temp);
				$moves=move_uploaded_file($_FILES['photo']['tmp_name'], $folder.'/'.$newimgname);
	}	
	
	$f_img_name = $_FILES['f_picture']['name'];
	$f_type = $_FILES['f_picture']['type'];
	$f_error = $_FILES['f_picture']['error'];
	$f_newimgname='';
	if($f_img_name!='' || in_array($f_type, $img_type)){
				$f_temp = explode(".", $f_img_name);
				$f_newimgname = $_POST['fullname'].'_'.$_POST['birthday'].'(father).' . end($f_temp);
				$movef = move_uploaded_file($_FILES['f_picture']['tmp_name'], $folder.'/'.$f_newimgname);
	}		
	
	$m_img_name = $_FILES['m_picture']['name'];
	$m_type = $_FILES['m_picture']['type'];
	$m_error = $_FILES['m_picture']['error'];
	$m_newimgname='';
	if($m_img_name!='' || in_array($m_type, $img_type)){
				$m_temp = explode(".", $m_img_name);
				$m_newimgname = $_POST['fullname'].'_'.$_POST['birthday'].'(Mother).' . end($m_temp);
				$movem = move_uploaded_file($_FILES['m_picture']['tmp_name'], $folder.'/'.$m_newimgname);
	}		
	$studentid=mysql_fetch_row(mysql_query("SELECT MAX(student_id) FROM admission_form"));
	$student_id = $studentid[0]+1;
	$insert = mysql_query("INSERT INTO admission_form VALUES(
	'$student_id',
	'$_POST[fullname]',
	'$_POST[nickname]',
	'$_POST[sex]',
	'$_POST[birthday]',
	'$_POST[birthplace]',
	'$_POST[nationality]',
	'$_POST[religion]',
	'$_POST[homeaddress]',
	'$_POST[homephone]',
	'$_POST[fax]',
	'$_POST[fathername]',
	'$_POST[fatherofficename]',
	'$_POST[fatherofficeaddress]',
	'$_POST[fatherofficephoneno]',
	'$_POST[fatherofficefaxno]',
	'$_POST[fatheremail]',
	'$_POST[fatherhp]',
	'$_POST[mothername]',
	'$_POST[motherofficename]',
	'$_POST[motherofficeaddress]',
	'$_POST[motherofficephoneno]',
	'$_POST[motherofficefaxno]',
	'$_POST[motheremail]',
	'$_POST[motherhp]',
	'$_POST[ecname]',
	'$_POST[ecrelation]',
	'$_POST[ecaddress]',
	'$_POST[echp]',
	'$_POST[sla]',
	'$_POST[registrationdate]',
	'$newimgname',
	'$_SESSION[user]',
	NOW(),
	'active',
	'$f_newimgname',
	'$m_newimgname')");
	
	if($insert){
		if($_POST['year']==$studyyear1)
			$insert1=mysql_query("INSERT INTO student_class VALUES('','$_POST[class]','$student_id','$_POST[year]','N','$_POST[subclass]')");
		else if($_POST['year']==$studyyear2)
			$insert1=mysql_query("INSERT INTO student_class VALUES('','$_POST[class]','$student_id','$_POST[year]','Y','$_POST[subclass]')");
			
		?>
			<script language='JavaScript'>
						alert("Data siswa berhasil disimpan");
						document.location='index.php?page=<?=MD5('studentdata')?>';
					</script>
		<?
	}
	}else{?>
			<script language='JavaScript'>
						alert("Fullname, Class, birthday, dan Year wajib diisi");
						document.location='index.php?page=<?=MD5('studentdata')?>';
					</script>
		<?
		
	}
}else if(isset($_POST['savetoedit'])){
if($_POST['fullname'] != '' && $_POST['class'] != '' && $_POST['year'] != '' && $_POST['birthday'] != ''){
	
	$img_type = array('image/png','image/jpg','image/jpeg','image/gif');
	
	
	
	$selecttt=mysql_fetch_row(mysql_query("SELECT full_name, birthday FROM admission_form WHERE student_id = '$_SESSION[sid]'"));
	$tmpfullname=$selecttt[0];
	$tmpbirthday=$selecttt[1];
	
	$olddir='students/'.$tmpfullname.'_'.$tmpbirthday;
		$folder = 'students/'.$_POST['fullname'].'_'.$_POST['birthday'];
		
		if (!file_exists($olddir)) {
				mkdir($folder);
		}else{
			rename($olddir,$folder);
		}
			
	
	
	
	$img_name = $_FILES['photo']['name'];
	$type = $_FILES['photo']['type'];
	$error = $_FILES['photo']['error'];
	
	$temp = explode(".", $img_name);
	$newimgname = $_POST['fullname'].'_'.$_POST['birthday'].'.' . end($temp);
	
	if($img_name!=''||in_array($type, $img_type)){
		$img=$newimgname;
		unlink($folder.'/'.$_POST['tmppicture']);
					$s=move_uploaded_file($_FILES['photo']['tmp_name'], $folder.'/'.$img);
	}else
		$img=$_POST['tmppicture'];
	
	$f_img_name = $_FILES['f_picture']['name'];
	$f_type = $_FILES['f_picture']['type'];
	$f_error = $_FILES['f_picture']['error'];
	
	$f_temp = explode(".", $f_img_name);
	$f_newimgname = $_POST['fullname'].'_'.$_POST['birthday'].'(father).' . end($f_temp);
	
	if($f_img_name!=''||in_array($f_type, $img_type)){
		$f_img=$f_newimgname;
		unlink($folder.'/'.$_POST['f_tmppicture']);
						$f=move_uploaded_file($_FILES['f_picture']['tmp_name'], $folder.'/'.$f_img);
	}else
		$f_img=$_POST['f_tmppicture'];
	
	$m_img_name = $_FILES['m_picture']['name'];
	$m_type = $_FILES['m_picture']['type'];
	$m_error = $_FILES['m_picture']['error'];
	
	$m_temp = explode(".", $m_img_name);
	$m_newimgname = $_POST['fullname'].'_'.$_POST['birthday'].'(mother).' . end($m_temp);
	
	if($m_img_name!=''||in_array($m_type, $img_type)){
		$m_img=$m_newimgname;
		unlink($folder.'/'.$_POST['m_tmppicture']);
						$m=move_uploaded_file($_FILES['m_picture']['tmp_name'], $folder.'/'.$m_img);
	}else
		$m_img=$_POST['m_tmppicture'];
	
	$update = mysql_query("UPDATE admission_form SET
	full_name = '$_POST[fullname]',
	nick_name = '$_POST[nickname]',
	sex = '$_POST[sex]',
	birthday = '$_POST[birthday]',
	birthplace = '$_POST[birthplace]',
	nationality = '$_POST[nationality]',
	religion = '$_POST[religion]',
	home_address = '$_POST[homeaddress]',
	home_phone_number = '$_POST[homephone]',
	fax_number = '$_POST[fax]',
	father_name = '$_POST[fathername]',
	father_office_name = '$_POST[fatherofficename]',
	father_office_address = '$_POST[fatherofficeaddress]',
	father_office_phone_number = '$_POST[fatherofficephoneno]',
	father_office_fax_number = '$_POST[fatherofficefaxno]',
	father_email = '$_POST[fatheremail]',
	father_hp = '$_POST[fatherhp]',
	mother_name = '$_POST[mothername]',
	mother_office_name = '$_POST[motherofficename]',
	mother_office_address = '$_POST[motherofficeaddress]',
	mother_office_phone_number = '$_POST[motherofficephoneno]',
	mother_office_fax_number = '$_POST[motherofficefaxno]',
	mother_email = '$_POST[motheremail]',
	mother_hp = '$_POST[motherhp]',
	emergency_contact_name = '$_POST[ecname]',
	emergency_contact_relationship = '$_POST[ecrelation]',
	emergency_contact_address = '$_POST[ecaddress]',
	emergency_contact_phone_number = '$_POST[echp]',
	school_last_attended = '$_POST[sla]',
	registration_date = '$_POST[registrationdate]',
	picture = '$img',
	uname = '$_SESSION[user]',
	date_updated = NOW(),
	f_picture = '$f_img',
	m_picture = '$m_img'
	WHERE student_id='$_SESSION[sid]'");
	
	
	
		if($update){
			
			if($_POST['year'] == $studyyear1)
				$update=mysql_query("UPDATE student_class SET class_id = '$_POST[class]', year='$_POST[year]', subclass_id='$_POST[subclass]' WHERE student_id = '$_SESSION[sid]'");
			else if($_POST['year'] == $studyyear2)
				$update=mysql_query("UPDATE student_class SET class_id = '$_POST[class]', year='$_POST[year]', mark_not_in='Y', subclass_id='$_POST[subclass]' WHERE student_id = '$_SESSION[sid]'");
			?>
				<script language='JavaScript'>
							alert("Data siswa berhasil disimpan");
							document.location='index.php?page=<?=MD5('studentdata')?>';
						</script>
			<?
		}
	}else{?>
			<script language='JavaScript'>
						alert("Fullname, Class, birtday, dan Year wajib diisi");
						document.location='<?=$url[2]?>';
					</script>
		<?
		
	}
}
?>

<style>
	input[type=text], #age{
		width:100%;
		border:0px solid black;
		border-bottom:1px solid grey;
		height:25px;
	}
	td{
		padding:5px 0px 5px 0px;
	}
	select{
		height:100%;
	}
	td i{
		color:grey;
	}
</style>
<link type="text/css" href="plug-in/development-bundle/themes/base/ui.all.css" rel="stylesheet" />   

    <script type="text/javascript" src="plug-in/development-bundle/jquery-1.3.2.js"></script>
    <script type="text/javascript" src="plug-in/development-bundle/ui/ui.core.js"></script>
    <script type="text/javascript" src="plug-in/development-bundle/ui/ui.datepicker.js"></script>
    
    <script type="text/javascript" src="plug-in/development-bundle/ui/i18n/ui.datepicker-id.js"></script>

    <script type="text/javascript"> 
      $(document).ready(function(){
        $("#birthday").datepicker({
					dateFormat  : "yy-mm-dd",        
          changeMonth : true,
          changeYear  : true					
        });
		$("#registrationdate").datepicker({
					dateFormat  : "yy-mm-dd",        
          changeMonth : true,
          changeYear  : true					
        });
      });
    </script>	
	
	
	<?
	if($_GET['page']==MD5('addmisionformtoadd')){
	?>
					<div class="panel-body">
					
						<h4 style='margin-top:0px;'>
							<a href='#' onclick='goBack()' style='margin-right:10px;' title='kembali'><img src='icons/back.png' width='20px' height='20px'></a><b>Admission Form <i>(Add Student's Data)</i></b>
						</h4>
						<form target="_self" method='POST' enctype='multipart/form-data'>
						<table width='98%'>
							<tr>
								<th width='10%'></th>
								<th width='1%'></th>
								<th width='30%'></th>
								<th width='3%'></th>
								<th width='8%'></th>
								<th width='1%'></th>
								<th width='20%'></th>
							</tr>
							<tr>
								<td>Student's Photo</td>
								<td>:</td>
								<td><input type='file' name='photo'></td>
								<td></td>
								<td>Registration Date</td>
								<td>:</td>
								<td><input type='text' name='registrationdate' id='registrationdate'></td>
							</tr>
							<tr>
								<td>Student's Class</td>
								<td>:</td>
								<td><select name='class' onchange='loadPage("loadsubclass.php?cid="+this.value,"subclass");' style='float:left'>
									<option disabled selected>choose class</option>
									<?
									$q=mysql_query("SELECT * FROM class WHERE class_id != '999' ORDER BY class_id ASC");
									while($s=mysql_fetch_array($q)){?>
										<option value='<?=$s['class_id']?>'><?=$s['class_name']?></option>
									<?}
									?>
									</select>
									<div id='subclass' style='float:left; margin-left:10px'>
									</div>
								</td>
								<td></td>
								<td>Study Year</td>
								<td>:</td>
								<td><select name='year'>
									<option disabled selected>choose study year</option>
									<option value='<?=$studyyear1?>'><?=$studyyear1?></option>
									<option value='<?=$studyyear2?>'><?=$studyyear2?></option>
									</select>
								</td>
							</tr>
							<tr>
								<td >Student's Full Name</td>
								<td>:</td>
								<td colspan='5'><input type='text' name='fullname' autofocus></td>
							</tr>
							<tr>
								<td>Nickname</td>
								<td>:</td>
								<td><input type='text' name='nickname'></td>
								<td></td>
								<td>Sex</td>
								<td>:</td>
								<td><select name='sex'>
									<option disabled selected>choose sex</option>
									<option value='M'>Male</option>
									<option value='F'>Female</option>
									</select>
								</td>
							</tr>
							<tr>
								<td>Birthday</td>
								<td >:</td>
								<td><input type='text' id='birthday' name='birthday' onchange='loadPage("age.php?birthday="+this.value,"age");' onkeydown=""></td>
								<td ></td>
								<td >Birthplace</td>
								<td>:</td>
								<td><input type='text' name='birthplace'></td>
							</tr>
							<tr>
								<td>Student's Age</td>
								<td >:</td>
								<td><div id='age'></div></td>
								<td ></td>
								<td colspan='3'><i>(by October of the current School Year)</i></td>
							</tr>
							<tr>
								<td>Nationality</td>
								<td >:</td>
								<td><input type='text' name='nationality'></td>
								<td ></td>
								<td >Religion</td>
								<td>:</td>
								<td><select name='religion'>
									<option disabled selected>choose religion</option>
									<option value='christian'>Christian</option>
									<option value='catholic'>Catholic</option>
									<option value='islam'>Islam</option>
									<option value='buddha'>Buddha</option>
									<option value='hindu'>Hindu</option>
									</select></td>
							</tr>
							<tr>
								<td>Home Address</td>
								<td >:</td>
								<td colspan='5'><input type='text' name='homeaddress'></td>
							</tr>
							<tr>
								<td>Home Phone No.</td>
								<td >:</td>
								<td><input type='text' name='homephone'></td>
								<td ></td>
								<td >Fax No.</td>
								<td>:</td>
								<td><input type='text' name='fax'></td>
							</tr>
							<tr>
								<td>Father's Name</td>
								<td >:</td>
								<td><input type='text' name='fathername'></td>
								<td></td>
								<td>Father's Photo</td>
								<td >:</td>
								<td ><input type='file' name='f_picture'></td>
							</tr>
							<tr>
								<td><i>&nbsp&nbsp&nbsp Office Name</i></td>
								<td >:</td>
								<td colspan='5'><input type='text' name='fatherofficename'></td>
							</tr>
							<tr>
								<td><i>&nbsp&nbsp&nbsp Office Addres</i></td>
								<td >:</td>
								<td colspan='5'><input type='text' name='fatherofficeaddress'></td>
							</tr>
							<tr>
								<td><i>&nbsp&nbsp&nbsp Office Phone No.</i></td>
								<td >:</td>
								<td ><input type='text' name='fatherofficephoneno'></td>
								<td></td>
								<td><i>&nbsp&nbsp&nbsp Fax No.</i></td>
								<td >:</td>
								<td ><input type='text' name='fatherofficefaxno'></td>
							</tr>
							<tr>
								<td><i>&nbsp&nbsp&nbsp Email Address</i></td>
								<td >:</td>
								<td ><input type='text' name='fatheremail'></td>
								<td></td>
								<td><i>&nbsp&nbsp&nbsp H.P No.</i></td>
								<td >:</td>
								<td ><input type='text' name='fatherhp'></td>
							</tr>
							<tr>
								<td>Mother's Name</td>
								<td >:</td>
								<td ><input type='text' name='mothername'></td>
								<td></td>
								<td>Mother's Photo</td>
								<td >:</td>
								<td ><input type='file' name='m_picture'></td>
							</tr>
							<tr>
								<td><i>&nbsp&nbsp&nbsp Office Name</i></td>
								<td >:</td>
								<td colspan='5'><input type='text' name='motherofficename'></td>
							</tr>
							<tr>
								<td><i>&nbsp&nbsp&nbsp Office Addres</i></td>
								<td >:</td>
								<td colspan='5'><input type='text' name='motherofficeaddress'></td>
							</tr>
							<tr>
								<td><i>&nbsp&nbsp&nbsp Office Phone No.</i></td>
								<td >:</td>
								<td ><input type='text' name='motherofficephoneno'></td>
								<td></td>
								<td><i>&nbsp&nbsp&nbsp Fax No.</i></td>
								<td >:</td>
								<td ><input type='text' name='motherofficefaxno'></td>
							</tr>
							<tr>
								<td><i>&nbsp&nbsp&nbsp Email Address</i></td>
								<td >:</td>
								<td ><input type='text' name='motheremail'></td>
								<td></td>
								<td><i>&nbsp&nbsp&nbsp H.P No.</i></td>
								<td >:</td>
								<td ><input type='text' name='motherhp'></td>
							</tr>
							<tr>
								<td colspan='7'>Person to call in case of Emergency <i>(if parents cannot be reached)</i></td>
							</tr>
							<tr>
								<td><i>&nbsp&nbsp&nbsp Name</i></td>
								<td >:</td>
								<td ><input type='text' name='ecname'></td>
								<td></td>
								<td><i>&nbsp&nbsp&nbsp Relationship</i></td>
								<td >:</td>
								<td ><input type='text' name='ecrelation'></td>
							</tr>
							<tr>
								<td><i>&nbsp&nbsp&nbsp Address</i></td>
								<td >:</td>
								<td ><input type='text' name='ecaddress'></td>
								<td></td>
								<td><i>&nbsp&nbsp&nbsp H.P No.</i></td>
								<td >:</td>
								<td ><input type='text' name='echp'></td>
							</tr>
							<tr>
								<td>School Last Attended</td>
								<td >:</td>
								<td colspan='4'><input type='text' name='sla'></td>
								<td><i>&nbsp&nbsp (if any)</i></td>
							</tr>
							
							<tr>
								<td colspan='7' align=right><input type='submit' name='savetoadd' value='Save'>&nbsp<input type='reset'></td>
							</tr>
						</table>
						</form>
					</div>
					
					
					
					
					
		<?}else if($_GET['page']==MD5('addmisionformtoedit')){
		$inquiry=mysql_fetch_array(mysql_query("SELECT * FROM admission_form WHERE student_id='$_SESSION[sid]'"));
									$selectclass=mysql_fetch_array(mysql_query("SELECT * FROM student_class WHERE student_id = '$_SESSION[sid]'"));
		?>			
		<div class="panel-body">
					
						<h4 style='margin-top:0px;' >
							<a href='#' onclick='goBack()' style='margin-right:10px;' title='kembali'><img src='icons/back.png' width='20px' height='20px'></a>
							<b>Admission Form <i>(Edit Student's Data)</i></b>
						</h4>
						<form target="_self" method='POST' enctype='multipart/form-data'>
						<table width='98%'>
							<tr>
								<th width='10%'></th>
								<th width='1%'></th>
								<th width='30%'></th>
								<th width='3%'></th>
								<th width='8%'></th>
								<th width='1%'></th>
								<th width='20%'></th>
							</tr>
							<tr>
								<td valign=TOP>Student's Photo</td>
								<td valign=TOP>:</td>
								<td ><? if($inquiry['picture'] != ''){?><img id="myImg" alt='<?=$inquiry['full_name']?>' src='students/<?=$inquiry['full_name']?>_<?=$inquiry['birthday']?>/<?=$inquiry['picture']?>' width='100px'>	<?}?>
								<input type='file' name='photo' value='<?=$inquiry['picture']?>' ><input type='hidden' name='tmppicture' value='<?=$inquiry['picture']?>'></td>
								<td></td>
								<td valign=TOP>Registration Date</td>
								<td valign=TOP>:</td>
								<td valign=TOP><input type='text' name='registrationdate' id='registrationdate' value='<?=$inquiry['registration_date']?>'></td>
							</tr>
							<tr>
								<td>Student's Class</td>
								<td>:</td>
								<td><select name='class' onchange='loadPage("loadsubclass.php?cid="+this.value,"subclass");' style='float:left'>
									<option disabled selected>choose class</option>
									<?
									$q=mysql_query("SELECT * FROM class ORDER BY class_id ASC");
									while($s=mysql_fetch_array($q)){?>
										<option value='<?=$s['class_id']?>' <?if($selectclass['class_id']==$s['class_id']) echo 'selected';?>><?=$s['class_name']?></option>
									<?}
									?>
									</select>
									<div id='subclass' style='float:left;margin-left:10px'>
										<? include 'loadsubclass.php';?>
									</div>
								</td>
								<td></td>
								<td>Study Year</td>
								<td>:</td>
								<td><select name='year'>
									<option disabled selected>choose study year</option>
									<option value='<?echo $studyyear1;?>' <?if($selectclass['year']==$studyyear1) echo 'selected';?>><?=$studyyear1?></option>
									<option value='<?echo $studyyear2;?>' <?if($selectclass['year']==$studyyear2) echo 'selected';?>><?=$studyyear2?></option>
									</select>
								</td>
							</tr>
							<tr>
								<td >Student's Full Name</td>
								<td>:</td>
								<td colspan='5'><input type='text' name='fullname' value='<?=$inquiry['full_name']?>' autofocus></td>
							</tr>
							<tr>
								<td>Nickname</td>
								<td>:</td>
								<td><input type='text' name='nickname' value='<?=$inquiry['nick_name']?>'></td>
								<td></td>
								<td>Sex</td>
								<td>:</td>
								<td><select name='sex'>
									<option disabled selected>choose sex</option>
									<option value='M' <?if($inquiry['sex']=='M') echo 'selected';?>>Male</option>
									<option value='F' <?if($inquiry['sex']=='F') echo 'selected';?>>Female</option>
									</select>
								</td>
							</tr>
							<tr>
								<td>Birthday</td>
								<td >:</td>
								<td><input type='text' id='birthday' name='birthday' onchange='loadPage("age.php?birthday="+this.value,"age");' value='<?=$inquiry['birthday']?>'></td>
								<td ></td>
								<td >Birthplace</td>
								<td>:</td>
								<td><input type='text' name='birthplace' value='<?=$inquiry['birthplace']?>'></td>
							</tr>
							<tr>
								<td>Student's Age</td>
								<td >:</td>
								<td><div id='age'><?include 'age.php';?></div></td>
								<td ></td>
								<td colspan='3'><i>(by October of the current School Year)</i></td>
							</tr>
							<tr>
								<td>Nationality</td>
								<td >:</td>
								<td><input type='text' name='nationality' value='<?=$inquiry['nationality']?>'></td>
								<td ></td>
								<td >Religion</td>
								<td>:</td>
								<td><select name='religion'>
									<option disabled selected>choose religion</option>
									<option value='christian' <?if($inquiry['religion']=='christian') echo 'selected';?>>Christian</option>
									<option value='catholic' <?if($inquiry['religion']=='catholic') echo 'selected';?>>Catholic</option>
									<option value='islam' <?if($inquiry['religion']=='islam') echo 'selected';?>>Islam</option>
									<option value='buddha' <?if($inquiry['religion']=='buddha') echo 'selected';?>>Buddha</option>
									<option value='hindu' <?if($inquiry['religion']=='hindu') echo 'selected';?>>Hindu</option>
									</select></td>
							</tr>
							<tr>
								<td>Home Address</td>
								<td >:</td>
								<td colspan='5'><input type='text' name='homeaddress' value='<?=$inquiry['home_address']?>'></td>
							</tr>
							<tr>
								<td>Home Phone No.</td>
								<td >:</td>
								<td><input type='text' name='homephone' value='<?=$inquiry['home_phone_number']?>'></td>
								<td ></td>
								<td >Fax No.</td>
								<td>:</td>
								<td><input type='text' name='fax' value='<?=$inquiry['fax_number']?>'></td>
							</tr>
							<tr>
								<td valign=TOP>Father's Name</td>
								<td valign=TOP>:</td>
								<td valign=TOP><input type='text' name='fathername' value='<?=$inquiry['father_name']?>'></td>
								<td></td>
								<td valign=TOP>Father's Photo</td>
								<td valign=TOP>:</td>
								<td ><? if($inquiry['f_picture'] != ''){?><img id="myImg" alt='<?=$inquiry['father_name']?>' src='students/<?=$inquiry['full_name']?>_<?=$inquiry['birthday']?>/<?=$inquiry['f_picture']?>' width='100px'>	<?}?><input type='file' name='f_picture' value='<?=$inquiry['f_picture']?>'><input type='hidden' name='f_tmppicture' value='<?=$inquiry['f_picture']?>'></td>
							</tr>
							<tr>
								<td><i>&nbsp&nbsp&nbsp Office Name</i></td>
								<td >:</td>
								<td colspan='5'><input type='text' name='fatherofficename' value='<?=$inquiry['father_office_name']?>'></td>
							</tr>
							<tr>
								<td><i>&nbsp&nbsp&nbsp Office Addres</i></td>
								<td >:</td>
								<td colspan='5'><input type='text' name='fatherofficeaddress' value='<?=$inquiry['father_office_address']?>'></td>
							</tr>
							<tr>
								<td><i>&nbsp&nbsp&nbsp Office Phone No.</i></td>
								<td >:</td>
								<td ><input type='text' name='fatherofficephoneno' value='<?=$inquiry['father_office_phone_number']?>'></td>
								<td></td>
								<td><i>&nbsp&nbsp&nbsp Fax No.</i></td>
								<td >:</td>
								<td ><input type='text' name='fatherofficefaxno' value='<?=$inquiry['father_office_fax_number']?>'></td>
							</tr>
							<tr>
								<td><i>&nbsp&nbsp&nbsp Email Address</i></td>
								<td >:</td>
								<td ><input type='text' name='fatheremail' value='<?=$inquiry['father_email']?>'></td>
								<td></td>
								<td><i>&nbsp&nbsp&nbsp H.P No.</i></td>
								<td >:</td>
								<td ><input type='text' name='fatherhp' value='<?=$inquiry['father_hp']?>'></td>
							</tr>
							
							<tr>
								<td valign=TOP>Mother's Name</td>
								<td valign=TOP >:</td>
								<td valign=TOP><input type='text' name='mothername' value='<?=$inquiry['mother_name']?>'></td>
								<td valign=TOP></td>
								<td valign=TOP>Mother's Photo</td>
								<td valign=TOP>:</td>
								<td ><? if($inquiry['m_picture'] != ''){?><img id="myImg" alt='<?=$inquiry['mother_name']?>' src='students/<?=$inquiry['full_name']?>_<?=$inquiry['birthday']?>/<?=$inquiry['m_picture']?>' width='100px'>	<?}?><input type='file' name='m_picture' value='<?=$inquiry['m_picture']?>'><input type='hidden' name='m_tmppicture' value='<?=$inquiry['m_picture']?>'></td>
							</tr>
							<tr>
								<td><i>&nbsp&nbsp&nbsp Office Name</i></td>
								<td >:</td>
								<td colspan='5'><input type='text' name='motherofficename' value='<?=$inquiry['mother_office_name']?>'></td>
							</tr>
							<tr>
								<td><i>&nbsp&nbsp&nbsp Office Addres</i></td>
								<td >:</td>
								<td colspan='5'><input type='text' name='motherofficeaddress' value='<?=$inquiry['mother_office_address']?>'></td>
							</tr>
							<tr>
								<td><i>&nbsp&nbsp&nbsp Office Phone No.</i></td>
								<td >:</td>
								<td ><input type='text' name='motherofficephoneno' value='<?=$inquiry['mother_office_phone_number']?>'></td>
								<td></td>
								<td><i>&nbsp&nbsp&nbsp Fax No.</i></td>
								<td >:</td>
								<td ><input type='text' name='motherofficefaxno' value='<?=$inquiry['mother_office_fax_number']?>'></td>
							</tr>
							<tr>
								<td><i>&nbsp&nbsp&nbsp Email Address</i></td>
								<td >:</td>
								<td ><input type='text' name='motheremail' value='<?=$inquiry['mother_email']?>' ></td>
								<td></td>
								<td><i>&nbsp&nbsp&nbsp H.P No.</i></td>
								<td >:</td>
								<td ><input type='text' name='motherhp' value='<?=$inquiry['mother_hp']?>'></td>
							</tr>
							<tr>
								<td colspan='7'>Person to call in case of Emergency <i>(if parents cannot be reached)</i></td>
							</tr>
							<tr>
								<td><i>&nbsp&nbsp&nbsp Name</i></td>
								<td >:</td>
								<td ><input type='text' name='ecname' value='<?=$inquiry['emergency_contact_name']?>'></td>
								<td></td>
								<td><i>&nbsp&nbsp&nbsp Relationship</i></td>
								<td >:</td>
								<td ><input type='text' name='ecrelation' value='<?=$inquiry['emergency_contact_relationship']?>'></td>
							</tr>
							<tr>
								<td><i>&nbsp&nbsp&nbsp Address</i></td>
								<td >:</td>
								<td ><input type='text' name='ecaddress' value='<?=$inquiry['emergency_contact_address']?>'></td>
								<td></td>
								<td><i>&nbsp&nbsp&nbsp H.P No.</i></td>
								<td >:</td>
								<td ><input type='text' name='echp' value='<?=$inquiry['emergency_contact_phone_number']?>'></td>
							</tr>
							<tr>
								<td>School Last Attended</td>
								<td >:</td>
								<td colspan='4'><input type='text' name='sla' value='<?=$inquiry['school_last_attended']?>'></td>
								<td><i>&nbsp&nbsp (if any)</i></td>
							</tr>
							
							<tr>
								<td colspan='7' align=right><input type='submit' name='savetoedit' value='Save'>&nbsp<input type='reset'></td>
							</tr>
						</table>
						</form>
					</div>
		
		<? }?>