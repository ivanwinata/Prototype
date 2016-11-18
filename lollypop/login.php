
<style>
.loginform{
margin-top: 350px;
}
			tr, td{
			padding: 5px;
		}
		
	</style>
	
		<div class='col-md-6 col-md-offset-3 loginform'>
			<center>
			<h1>Silahkan Login</h1>
				<form action='ceklogin.php' method='POST'>
					<table>
						<tr>
							<td align='right'>Username</td>
							<td><input type='text' name='id' class='col-md-12 form-control' autofocus></td>
						</tr>
						<tr>
							<td align='right'>Password</td>
							<td><input type='password' name='password' class='col-md-12 form-control'></td>
						</tr>
						<tr><td></td>
							<td ><input type='submit' name='login' value='Login' class='col-md-8'></td>
						</tr>
					</table>
				</form>
			</center>
		</div>
	