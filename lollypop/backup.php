<?
include 'ExportToExcel.php';
?>

<div class="panel-body">
					
						<h4 style='margin-top:0px;'>
							<b>Backup data</b>
						</h4>
						
    		<form  method="POST" target="_self">
    			<span>Before you process, please type your password : </span>
						<input type='password' name='tmppass' autofocus>
						<input type="submit" value="Click Me!" name="backup">
    		</form>
			<br>
		<?
if(isset($_POST['backup'])){
	
	$tmppass = MD5($_POST['tmppass']);
	$passcheck = mysql_num_rows(mysql_query("SELECT * FROM user WHERE uname = '$_SESSION[user]' AND pword='$tmppass'"));
	if($passcheck>0){ ?>
		
<div style='width:100%; margin:0 auto; border-top:1px grey solid;margin-bottom:10px;'>
</div>
Note : <br>
<?
		ExportExcel("admission_form");
		ExportExcel("class");
		ExportExcel("student_class");
		ExportExcel("files_upload");
		ExportExcel("inventory");
		ExportExcel("subclass");
		ExportExcel("user");
		?>
			<br>
			<span style='float:left'>Your file is ready... &nbsp&nbsp&nbsp&nbsp</span>
			<form  method="POST" target="_self" style='float:left'>
				<input type='submit' name='downloadbackup' value='Click here to download'>
			</form>
		<? 	
	}else{ ?>	
		<script>
			alert('Your password is wrong');
			document.location='<?=$url[2]?>';
		</script>
	<?}	

}
?>
</div>
	