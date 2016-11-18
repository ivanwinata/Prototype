<?
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
	
	
	$insert=mysql_query("INSERT INTO booking VALUES('$kode_booking','$_POST[kode_kamar]','$_POST[nama]','$_POST[cp]',NOW(),'$exp',NOW(),'menunggu konfirmasi')");
	if($insert){
		$update=mysql_query("UPDATE kamar SET status = 'menunggu konfirmasi' WHERE kode_kamar = '$_POST[kode_kamar]'");
		if($update){?>
			<script language='JavaScript'>
						alert("Pemesanan anda berhasil. \n\nKode Booking anda <?=$kode_booking?> \nNama : <?=$_POST['nama']?> \nNo. Hp : <?=$_POST['cp']?>. \n\n Pihak Kost akan menghubungi anda untuk verifikasi proses pemesanan anda benar, jika tidak ada tanggapan dari anda maka proses pemesanan kamar anda akan dibatalkan. Terima kasih");
						document.location='index.php?page=booking';
					</script>
		<?}
	}
?>