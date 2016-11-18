<style>
td{
	padding:5px;
}
</style>
<div style='border:1px solid black;padding:5px;'>
<b style='font-size:14pt'>Form Pemesanan </b>
<br>
<?=$_GET['nama_kamar'].'<br> jenis kamar : '.$_GET['jenis_kamar']?>
<br>
<span><b>Admin Anaron Kost akan melakukan verifikasi melalui sms ke no. HP anda. <br>Jika dalam 1 hari tidak ada konfirmasi dari anda, admin akan membatalkan pemesanan anda </b></span>
<br>
<span>Silahkan mengisi form dibawah untuk melakukan pemesanan kamar</span>
<br>
<br>
<form action='index.php?page=prosesbooking' method='post'>
<table>
	<tr>
		<td>Nama</td>
		<td>:</td>
		<td><input type='text' name='nama' required></td>
	</tr>
	<tr>
		<td>No. HP</td>
		<td>:</td>
		<td><input type='text' name='cp' required></td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td><input type='hidden' name='kode_kamar' value='<?=$_GET['kode_kamar']?>'>
		<input type='submit' name='submit' value='Proses'></td>
	</tr>
</table>
</form>
</div>