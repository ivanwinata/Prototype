<style>
td{
	padding:5px;
}
</style><div style='border:1px black solid;width:100%;background:lightgrey;padding:5px;margin-top:10px'>
<?include 'koneksi.php';
	date_default_timezone_set('UTC');
$tanggal = date('d');
	$bulan = date('m');
	$tahun = date('Y');
$cek=mysql_num_rows(mysql_query("SELECT * FROM booking WHERE kode_booking = '$_GET[kode]'"));
if($cek>0){
	$sbook=mysql_fetch_row(mysql_query("SELECT a.kode_booking, a.nama, a.cp, b.nama_kamar, c.nama_lantai, a.status, a.tanggal, a.waktu, d.keterangan, a.tanggal1 FROM booking AS a, kamar AS b, lantai AS c, jeniskamar AS d WHERE a.kode_booking = '$_GET[kode]' AND b.kode_kamar = a.kode_kamar AND c.id_lantai = b.id_lantai AND d.id_jenis = b.jenis_kamar"));
	
	if($sbook[5]=='dibatalkan#1'){
		$status='<b style="color:red">dibatalkan - verifikasi tidak berhasil</b>';
	}else if($sbook[5]=='dibatalkan#2'){
		$status='<b style="color:red">dibatalkan - tidak melakukan tanda jadi</b>';
	}else{
		$status=$sbook[5];
		
		$tanggal1 = explode("-",$sbook[9]);
		if($bulan == $tanggal1[1] && $tanggal > $tanggal1[2]){
			$status = 'dibatalkan';
		}else if($bulan>$tanggal1[1] || $tahun > $tanggal1[0]){
			$status = 'dibatalkan';
		}
		
		if($status=='dibatalkan' && $sbook[5] == 'menunggu konfirmasi'){
			$status = '<b style="color:red">'.$status.' - verifikasi tidak berhasil</b>';
		}else if($status=='dibatalkan' && $sbook[5] == 'menunggu tanda jadi'){
			$status = '<b style="color:red">'.$status.' - tidak melakukan tanda jadi</b>';
		}
	}
	?>
	<table>
		<tr>
			<td>Kode Booking</td>
			<td>:</td>
			<td><?=$sbook[0]?></td>
		</tr>
		<tr>
			<td>Status Pemesanan</td>
			<td>:</td>
			<td><?=$status?></td>
		</tr>
		<tr>
			<td>Nama Anda</td>
			<td>:</td>
			<td><?=$sbook[1]?></td>
		</tr>
		<tr>
			<td>Kontak</td>
			<td>:</td>
			<td><?=$sbook[2]?></td>
		</tr>
		<tr>
			<td>Lokasi kamar</td>
			<td>:</td>
			<td><?=$sbook[3].' - '.$sbook[4]?></td>
		</tr>
		<tr>
			<td>Jenis kamar</td>
			<td>:</td>
			<td><?=$sbook[8]?></td>
		</tr>
		<tr>
			<td>Tanggal Pemesanan</td>
			<td>:</td>
			<td><?=$sbook[6].' '.$sbook[7]?></td>
		</tr>
	</table>
	<?
}else{
	echo '<b style="color:red">Kode Booking anda '.$_GET['kode'].' tidak ditemukan.</b>';
}
?>
</div>