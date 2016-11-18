<?

if(isset($_POST['tambah'])){
	$kode_booking = rand(100000, 999999);
						
						$selectkodebooking = mysql_fetch_array(mysql_query("SELECT * FROM booking WHERE kode_booking = '$kode_booking'"));
						
						while($selectkodebooking){
							$kode_booking = rand(100000, 999999);
							$selectkodebooking = mysql_fetch_array(mysql_query("SELECT * FROM booking WHERE kode_booking = '$kode_booking'"));
						}
	
	
	if($bulan == '01' || $bulan == '03' || $bulan == '05' || $bulan == '07' || $bulan == '08' || $bulan == '10' || $bulan == '12')
								$limitdays = 31;
							else if($bulan == '04' || $bulan == '06' || $bulan == '09' || $bulan == '11')
								$limitdays = 30;
							else{
								if($tahun1%4 == 0)
									$limitdays = 29;
								else
									$limitdays = 28;
							}
	
	$tanggal1=$tanggal+1;
	$bulan1=$bulan;
	$tahun1=$tahun;
	if($tanggal1 > $limitdays){
		$bulan1=$bulan1+1;
		$tanggal1=$tanggal1-$limitdays;
		if($bulan1>12){
			$tahun1=$tahun1+1;
			$bulan1=$bulan1-12;
		}
	}
	
	$exp=$tahun1.'-'.$bulan1.'-'.$tanggal1;
	
	
	$insert=mysql_query("INSERT INTO booking VALUES('$kode_booking','$_POST[kode_kamar]','$_POST[nama]','$_POST[cp]',NOW(),'',NOW(),'booked')");
	if($insert){
		$update=mysql_query("UPDATE kamar SET status = 'booked' WHERE kode_kamar = '$_POST[kode_kamar]'");
		if($update){?>
			<script language='JavaScript'>
						alert("Pemesanan anda berhasil. \n\nKode Booking anda <?=$kode_booking?> \nNama : <?=$_POST['nama']?> \nNo. Hp : <?=$_POST['cp']?>. \n\n Status kamar  menjadi booked");
						document.location='index.php?page=pesanan';
					</script>
		<?}
	}else{
		echo '1';
	}
}else if(isset($_POST['edit'])){
	$update=mysql_query("UPDATE booking SET nama = '$_POST[nama]', cp = '$_POST[cp]', kode_kamar = '$_POST[kodeup]' WHERE kode_booking = '$_POST[kodebooking]'");
	if($update){
		$update1=mysql_query("UPDATE kamar SET status = 'tersedia' WHERE kode_kamar = '$_POST[kmrsebelum]'");
		$update1=mysql_query("UPDATE kamar SET status = '$_POST[sttssebelum]' WHERE kode_kamar = '$_POST[kodeup]'");
		?>
			<script language='JavaScript'>
						alert("Data pesanan berhasil diubah. \n\nKode Booking <?=$_POST['kodebooking']?> \nNama : <?=$_POST['nama']?> \nNo. Hp : <?=$_POST['cp']?>. \n\n Status kamar tidak berubah");
						document.location='index.php?page=pesanan';
					</script>
		<?
	}
}
?>