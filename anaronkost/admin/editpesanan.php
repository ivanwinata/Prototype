<? include '../function.php';?>

<div class="col-lg-12" >
					<div class="panel-body">
						<h4 style='margin-top:0px;' class="tooltip-demo">
							<b>Tambah Pemesanan</b>
						</h4>
					</div>
	<div id='formdenah' class="col-lg-12">
		<span>Silahkan memilih kamar dari denah dibawah</span>
		<br>
		<?
		$qlantai=mysql_query("SELECT * FROM lantai");
		while($slantai=mysql_fetch_array($qlantai)){?>
			
			<a href='index.php?page=editpesanan&lt=<?=$slantai['id_lantai']?>&kode=<?=$_GET['kode']?>' ><?=$slantai['nama_lantai']?> </a>
		<?}
		?>
	</div>
	<div id='denah' class="col-lg-12">
		<? include 'denahedit.php'; ?>
	</div>
</div>