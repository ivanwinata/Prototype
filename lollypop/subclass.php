<?
if(isset($_POST['savetoadd'])){
	$insert=mysql_query("INSERT INTO subclass VALUES('','$_POST[class]','$_POST[subclass]');");
	if($insert){
		?>
		<script language='JavaScript'>
								alert("Sub Class Berhasil ditambah");
								document.location='<?=$url[2]?>';
							</script>
		<?
	}
}else if(isset($_POST['savetoedit'])){
	$update = mysql_query("UPDATE subclass SET class_id = '$_POST[class]', subclass_name = '$_POST[subclass]' WHERE subclass_id = '$_POST[scid]'");
	if($update){
		?>
		<script language='JavaScript'>
								alert("Sub Class Berhasil diedit");
								document.location='<?=$url[2]?>';
							</script>
		<?
	}
}
?>


<style>
	input[type=text],input[type=password]{
		width:100%;
		border:0px solid black;
		border-bottom:1px solid grey;
		height:25px;
	}
	td, th{
	}
	select{
		height:100%;
	}
	td i{
		color:grey;
	}
	textarea{
		width:500px;
		height:100px;
	}
</style>
<div class="panel-body">
					
						<h4 style='margin-top:0px;'>
							<b>Sub Class</b>
						</h4>
						<a href='#' onclick='loadPage("subclass1.php?mode=1","add/edit");'>Add Subclass</a>	
								<br>
								<br>
							<table width='40%' style='float:left' border='1' >
								<tr style='background:maroon;color:beige'>
									<th width='10%'>No</th>
									<th width='60%'>SubClass Name</th>
									<th>Option</th>
								</tr>
								<?
								$no=1;
								$query=mysql_query("SELECT b.class_name, a.subclass_name, a.subclass_id, a.class_id FROM subclass AS a, class AS b WHERE b.class_id = a.class_id ORDER BY a.class_id ASC, a.subclass_id ASC");
								while($select=mysql_fetch_row($query)){
									
									if($select[0]!=$tmpclass){?>
										<tr style='background:beige;'>
											<td colspan='3' ><?=$select[0]?> Class</td>
										</tr>
										<?$tmpclass = $select[0];
									}?>
									<tr>
										<td><?=$no;?></td>
										<td><?=$select[1];?></td>
										<td>
										<table class="tooltip-demo">
											<tr>
																								<td style='padding: 2px;'><a href='#' title="Edit Subclass's Data"   data-toggle="tooltip" data-placement="top" onclick="loadPage('subclass1.php?mode=2&scid=<?=$select[2]?>&cid=<?=$select[3]?>','add/edit')"><img src='icons/edit.png' width='80%'></a></td>
																								<td><a href='#' title="Delete Subclass's Data"  data-toggle="tooltip" data-placement="top" onclick='deLete("<?=$select[2]?>","<?=$select[1]?>","subclass");'><img src='icons/trash.png' width='80%'></a></td>
											</tr>
										</table>														
										</td>
									</tr>
								<?
								$no++;
								}?>
							</table>
							<div id='add/edit'  style='float:left; margin-left:30px;width:40%'>
							</div>
</div>