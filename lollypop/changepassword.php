<?
if(isset($_POST['changeprocess'])){
	$pword = MD5($_POST['password']);
	$cek = mysql_num_rows(mysql_query("SELECT * FROM user WHERE pword = '$pword'"));
	if($cek>0){
		if($_POST['newpassword'] == $_POST['newpassword1']){
			$pass = MD5($_POST['newpassword']);
			$update = mysql_query("UPDATE user SET pword = '$pass' WHERE uname = '$_SESSION[user]'");
			if($update){
				?>
				<script language='JavaScript'>
										alert("Berhasil Mengganti Password");
										document.location='<?=$url[2]?>';
									</script>
				<?
			}
		}else{
			?>
			<script language='JavaScript'>
						alert("New Password anda salah");
						document.location='<?=$url[2]?>';
					</script>
		<?
		}
	}else{
		?>
			<script language='JavaScript'>
						alert("Password anda salah");
						document.location='<?=$url[2]?>';
					</script>
		<?
	}
}
?>


<style>
	input[type=text],input[type=password]{
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
<div class="panel-body">
					
						<h4 style='margin-top:0px;'>
							<b>Change Password</b>
						</h4>
						<form target="_self" method='POST' >
							<table width='40%'>
								<tr>
									<td width='30%'>Your Password</td>
									<td width='3%'>:</td>
									<td><input type='password' name='password' ></td>
								</tr>
								<tr>
									<td >New Password</td>
									<td>:</td>
									<td><input type='password' name='newpassword'></td>

								</tr>
								<tr >
									<td>Repeat New Password</td>
									<td>:</td>
									<td><input  type='password' name='newpassword1'></td>
								</tr>
							<tr>
								<td colspan='3' align=right><input   type='submit' name='changeprocess' value='Process'>&nbsp<input type='reset'></td>
							</tr>
							</table>
						</form>
</div>