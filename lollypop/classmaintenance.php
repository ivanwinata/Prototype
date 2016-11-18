<?
if(isset($_POST['updateclass'])){
	
	$tmppass = MD5($_POST['tmppass']);
	$max=mysql_fetch_row(mysql_query("SELECT MAX(class_id) FROM class WHERE class_id != '999'"));
	$passcheck = mysql_num_rows(mysql_query("SELECT * FROM user WHERE uname = '$_SESSION[user]' AND pword='$tmppass'"));
	if($passcheck>0){
		$query=mysql_query("SELECT * FROM class ORDER BY class_id DESC");
		$no=1;
		while($sel = mysql_fetch_array($query)){
			$classup = $sel['class_id']+1;
			
			if($classup > $max[0])
				$classup = 888;
			
			$selectyear = mysql_fetch_row(mysql_query("SELECT year FROM student_class WHERE class_id = '$sel[class_id]'"));
			$exyear=explode('/', $selectyear[0]);
			$newyear=($exyear[0]+1).'/'.($exyear[1]+1);
			
			if($no!=1)
				$update=mysql_query("UPDATE student_class SET class_id = '$classup' , year = '$newyear' WHERE class_id='$sel[class_id]'");
				
			$no++;
				
		} ?>	
		<script>
			alert('Maintenance sukses');
			document.location='<?=$url[2]?>';
		</script>
	<?
		}else{ ?>	
		<script>
			alert('Your password is wrong');
			document.location='<?=$url[2]?>';
		</script>
	<?}	

}
?>
					<div class="panel-body">
					
						<h4 style='margin-top:0px;'>
							<b>Class Maintenance </b>
						</h4>
						<br>		
						<?
						$i=0;
						$query=mysql_query("SELECT * FROM class WHERE class_id != '999' ORDER BY class_id DESC");
						while($selectclass = mysql_fetch_array($query)){
							if($i==0){
								echo '<b>';
								echo $selectclass['class_name'].' --> Graduation';
								echo '<br></b>';
								$classid[$i]=$selectclass['class_id'];
								$classname[$i]=$selectclass['class_name'];
							}else{
								echo '<b>';
								echo $selectclass['class_name'].' --> '.$classname[$i-1];
								echo '<br></b>';
								$classid[$i]=$selectclass['class_id'];
								$classname[$i]=$selectclass['class_name'];
							}
							
							$no=1;
							echo '<div style="margin-left:10px;">';
							$query1=mysql_query("SELECT ad.full_name FROM student_class AS sc, admission_form AS ad WHERE sc.class_id = '$selectclass[class_id]' AND sc.mark_not_in = 'N' AND ad.student_id = sc.student_id");
							while($selectstudent = mysql_fetch_row($query1)){
								echo $no.'. &nbsp '.$selectstudent[0].'<br>';
							$no++;	}
							echo '</div><br>';
							$i++;
						}
						?>
						<form target="_self" method='POST'>
						<span>Before you process, please type your password : </span>
						<input type='password' name='tmppass' autofocus>
						<input type='submit' name='updateclass' value='Process' >
						</form>
								
								
								</div>