<?
include 'koneksi.php';

if(isset($_GET['lt'])){
	$sdenah=mysql_fetch_array(mysql_query("SELECT * FROM lantai WHERE id_lantai='$_GET[lt]'"));
}else{
	$sdenah=mysql_fetch_array(mysql_query("SELECT * FROM lantai WHERE id_lantai='1'"));
}?>
<div class="col-lg-6">
<center>
<span style='font-size:14pt'><b><?=$sdenah['nama_lantai']?></b></span>
</center>
<img src='../<?=$sdenah['gambar']?>' usemap='#map' id='peta' style='border:10px solid black;'>
<map name='map'>
<?
				$w=0;

				$qs0=mysql_query("SELECT a.koorx,a.koory,a.kode_kamar,a.nama_kamar,b.keterangan,a.status FROM kamar AS a, jeniskamar AS b WHERE a.id_lantai = '$sdenah[id_lantai]' AND b.id_jenis=a.jenis_kamar");
				
			while($s0=mysql_fetch_row($qs0)){
				$status=$s0[5];
				if($s0[5]=='menunggu konfirmasi'||$s0[5]=='menunggu tanda jadi'){
					$maxdate=mysql_fetch_row(mysql_query("SELECT max(tanggal), tanggal1  FROM booking WHERE kode_kamar='$s0[2]'"));
						
					$tanggal1 = explode("-",$maxdate[1]);
					if($bulan == $tanggal1[1] && $tanggal > $tanggal1[2]){
						$status = 'tersedia';
					}else if($bulan>$tanggal1[1] || $tahun > $tanggal1[0]){
						$status = 'tersedia';
					}
				}
				if($status=='tersedia'){
				?>
			<area shape='circle' coords='<?=$s0[0]?>,<?=$s0[1]?>,5' href='#' onclick='loadPage("formbooking.php?kode_kamar=<?=$s0[2]?>&nama_kamar=<?=$s0[3]?>&jenis_kamar=<?=$s0[4]?>","formbooking")' data-name="<?=$w?>,all" id='hotspot<?=$w?>' title='<?=$s0[5]?>'>
			
				<? }
			$w++;}?>
			

</map>
<script>
	
var inArea,
	map = $('#peta'),
    
    single_opts = {
        fillColor: '000000',
        fillOpacity: 0.4,
        stroke: true,
        strokeColor: 'ff0000',
		
        isSelectable: false,
		
		
		
        strokeWidth: 2
		
    },
    all_opts = {
        fillColor: 'ffffff',
        fillOpacity: 0.8,
        stroke: true,
        strokeWidth: 1,
        strokeColor: 'a26a1a'
		
    },
     initial_opts = {
        mapKey: 'data-name',
        
        onMouseover: function (data) {
            inArea = true;
        },
        onMouseout: function (data) {
            inArea = false;
        }
    };
    opts = $.extend({}, initial_opts,all_opts, single_opts);


    // Bind to the image 'mouseover' and 'mouseout' events to activate or deactivate ALL the areas, like the
    // original demo. Check whether an area has been activated with "inArea" - IE<9 fires "onmouseover" 
    // again for the image when entering an area, so all areas would stay highlighted when entering
    // a specific area in those browsers otherwise. It makes no difference for other browsers.

    map.mapster('unbind')
        .mapster(opts)
                map.mapster('set_options', all_opts)
                    .mapster('set', true, 'all')
                    .mapster('set_options', single_opts);
</script>
</div>
<div  id='formbooking' class="col-lg-6">
</div>
<div   class="col-lg-6">

<img src='../legend.jpg'>
</div>