<? include 'function.php';?>
<div class="col-lg-12" >
					<div class="panel-body">
						<h4 style='margin-top:0px;' class="tooltip-demo">
							<b>Beranda</b>
						</h4>
					</div>
	<div id='formsearch' class="col-lg-12">
		<span>Silahkan masukkan Kode Pemesanan anda</span>
		<input type='text' name='cari' placeholder='' id='cari'>
		<a href='#' onclick='loadPage("search.php?kode="+document.getElementById("cari").value,"search");'>Cari</a>
	</div>
	<div id='search' class="col-lg-12">
	</div>
</div>