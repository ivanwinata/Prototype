
<div class="panel-body">
					
						<h4 style='margin-top:0px;'>
							<b>Restore data</b>
						</h4>
						
    		<form  method="POST" target="_self" enctype='multipart/form-data'>
				<input type='file' name='fupload' accept='.zip'>
				
    			<span>Before you process, please type your password : </span>
						<input type='password' name='tmppass' autofocus>
						<input type="submit" value="Click Me!" name="restore">
    		</form>
			<br>
	<?
 
if(isset($_POST['restore'])) {
	
	$tmppass = MD5($_POST['tmppass']);
	$passcheck = mysql_num_rows(mysql_query("SELECT * FROM user WHERE uname = '$_SESSION[user]' AND pword='$tmppass'"));
	if($passcheck>0){?>
		
<div style='width:100%; margin:0 auto; border-top:1px grey solid;margin-bottom:10px;'>
</div>
		<?
		$filename = $_FILES['fupload']['name'];
		$source = $_FILES['fupload']['tmp_name'];
		$type = $_FILES['fupload']['type']; 
		 
		$name = explode('.', $filename); 
		$target = 'xxx/';  
		
		
		// Ensures that the correct file was chosen
		$accepted_types = array('application/zip', 
									'application/x-zip-compressed', 
									'multipart/x-zip', 
									'application/s-compressed');
	 
		foreach($accepted_types as $mime_type) {
			if($mime_type == $type) {
				$okay = true;
				break;
			} 
		}
		   
	  //Safari and Chrome don't register zip mime types. Something better could be used here.
		$okay = strtolower($name[1]) == 'zip' ? true: false;
	 
		if(!$okay) {
			  die("Please choose a zip file, dummy!");       
		}
	   if (!file_exists($target)) {
					mkdir($target);
				}
				
		$saved_file_location = $target . $filename;
		if(move_uploaded_file($source, $saved_file_location)) {
			$zip = new ZipArchive();
			$x = $zip->open($saved_file_location);
			if($x === true) {
				$zip->extractTo($target);
				$zip->close();
				 
				unlink($saved_file_location);
					?>
					
    		<form  method="POST" target="_self" >
				Your file ready to restore... <input type='submit' value='Click Here to Restore' name='uploadbackup'>
			
</form>
			<?} else {
				die("There was a problem. Please try again!");
			}
		} else {
			die("There was a problem. Sorry!");
		}
     }else{?>	
		<script>
			alert('Your password is wrong');
			document.location='<?=$url[2]?>';
		</script>
	<?
	 }
}
 
?>
</div>
	