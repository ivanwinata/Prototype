<?php
	include 'koneksi.php';
	
	session_start();
	if(isset($_POST['login'])){
		$id = $_POST['id'];
		$pass = md5($_POST['password']);

		$qlogin = mysql_query("SELECT uname, pword FROM user WHERE uname='$id' AND pword='$pass'");
		$login = mysql_fetch_row($qlogin);

		if($id == $login[0] && $pass == $login[1]){
			$_SESSION['user'] = $id;
			?>
				<script language='JavaScript'>
					document.location='index.php';
				</script>
			<?php
		}else{
			?>
			<script language='JavaScript'>
				alert('Username atau Password Anda Belum Tepat');
				document.location='index.php';
			</script>
			<?php
		}
	}
?>