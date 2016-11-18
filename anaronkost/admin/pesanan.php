<div class="col-lg-12" >
					<div class="panel-body">
						<h4 style='margin-top:0px;' class="tooltip-demo">
							<b>Data Pesanan</b>
						</h4>
						<a href='index.php?page=tambahpesanan'>[+]</a>
					</div>
					
	<div class="col-lg-12">
<table class="table-striped table-bordered table-hover" id="dataTables-example" width='100%' cellspacing="0" style='background:white'>
	<thead>
		<tr>
			<th width='3%'>No</th>
			<th >Kode Booking</th>
			<th>Nama</th>
			<th >No. Kontak</th>
			<th >Tgl. Pesanan</th>
			<th >Tgl. Jatuh Tempo</th>
			<th >Status</th>
			<th >Kamar</th>
			<th >Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?
		$no=0;
		$qpesanan=mysql_query("SELECT a.kode_booking, a.nama, a.cp, a.tanggal, a.tanggal1, a.status, b.nama_kamar, a.kode_kamar FROM booking AS a, kamar AS b WHERE a.status != 'dibatalkan#1' AND a.status != 'dibatalkan#2'AND a.status != 'dibatalkan#3' AND b.kode_kamar = a.kode_kamar ORDER BY a.tanggal ASC");
		while($spesanan=mysql_fetch_row($qpesanan)){
			 $no++;
		?>
		<tr>
			<td><?=$no;?></td>
			<td><?=$spesanan[0]?></td>
			<td><?=$spesanan[1]?></td>
			<td><?=$spesanan[2]?></td>
			<td><?if($spesanan[3]=='0000-00-00') echo '-'; else echo $spesanan[3];?></td>
			<td><?if($spesanan[4]=='0000-00-00') echo '-'; else echo $spesanan[4];?></td>
			<td><?=$spesanan[5]?></td>
			<td><?=$spesanan[6]?></td>
			<td>
			<a href='index.php?page=editpesanan&kode=<?=$spesanan[0]?>' title='edit data pesanan'>Edit</a><?
			if($spesanan[5]!='booked'){?>
				<a href='#' title='Proses Lanjutan ( status menjadi <?if($spesanan[5]=='menunggu konfirmasi') echo 'menunggu tanda jadi'; else if($spesanan[5]=='menunggu tanda jadi') echo 'booked';?>)' onclick='upDate("<?=$spesanan[0]?>");'>P</a>
			<?}	?>
			<a href='#' title='dibatalkan / selesai' onclick='deLete("<?=$spesanan[0]?>");'>B</a></td>
		</tr>
		<?} ?>
		
		</tbody>
</table>
</div>
</div>

<!--konfig data table-->
															<!-- DataTables JavaScript -->
												<script src="../js/dataTables/jquery.dataTables.js"></script>
												<script src="../js/dataTables/dataTables.bootstrap.js"></script>
												<script type="text/javascript" language="javascript" src="../js/dataTables.searchHighlight.js"></script>
												<script type="text/javascript" language="javascript" src="../js/jquery.highlight.js"></script>

												<!-- Page-Level Demo Scripts - Tables - Use for reference -->
												<script>
													$(document).ready(function() {
														$('#dataTables-example').dataTable( {
															"columnDefs": [
																{ "searchable": false, "targets": 8 },
																{ "searchable": false, "targets": 7 },
																{ "searchable": true, "targets": 6 },
																{ "searchable": false, "targets": 5 },
																{ "searchable": false, "targets": 4 },
																{ "searchable": false, "targets": 0 },
																{ "orderable": false, "targets": 8 },
																{ "orderable": false, "targets": 7 },
																{ "orderable": true, "targets": 6 },
																{ "orderable": false, "targets": 5 },
																{ "orderable": false, "targets": 4 },
																{ "orderable": false, "targets": 3 },
																{ "orderable": false, "targets": 2 },
																{ "orderable": false, "targets": 1 },
																{ "orderable": false, "targets": 0 }
															],
															"searching":   true,
															 "language": {
																			"lengthMenu": "Lihat _MENU_ data pesanan",
																			"zeroRecords": "Tidak ditemukan",
																			"info": "",
																			"infoEmpty": "",
																			"infoFiltered": ""
																		}
														});
													});
													
													
												</script> 
