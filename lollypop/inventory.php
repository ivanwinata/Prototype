
					<div class="panel-body">
					
						<h4 style='margin-top:0px;'>
							<b>Inventory Data Master</b>
						</h4>
							<a href='index.php?page=<?=MD5('inventoryformtoadd')?>'>Add Inventory</a> &nbsp
							<a href='#' onclick='loadPage("opsiprint.php?mode=inventory","opsiprint")'>Print Inventory Data</a>	
							<div id='opsiprint'>
							</div>
								<br> 	
								Class &nbsp
								<select onchange='changeMode(this.value,"<?=$_GET['cat']?>","")'>
									<option value='' >All Class</option>
									<?
									
									$qclass=mysql_query("SELECT * FROM class");
									while($class=mysql_fetch_array($qclass)){ ?>
										<option value='<?=$class['class_id']?>' <?if($_GET['cid']==$class['class_id']) echo 'selected';?>><?=$class['class_name']?></option>
									<? }
									?>
									
								</select>
								<?
								if($_GET['cid']!=''){?>
									<select onchange='changeMode("<?=$_GET['cid']?>", "<?=$_GET['cat']?>", this.value)' id='subclass'>
											<option value=''>All Sub Class</option>
											<?
												$qsubclass=mysql_query("SELECT * FROM subclass WHERE class_id = '$_GET[cid]'");
												while($subclass = mysql_fetch_array($qsubclass)){
													?>
													<option value='<?=$subclass['subclass_id']?>' <?if($_GET['scid']==$subclass['subclass_id']) echo 'selected';?>><?=$subclass['subclass_name']?></option>
													<? 
												}
											?>
										</select>
								<?}
								?>
								<br>
								<br>
								Category &nbsp
								<select name='path' onchange='changeMode("<?=$_GET['cid']?>",this.value,"<?=$_GET['scid']?>")'>
									<option value=''>All Category</option>
									<option value='books' <?if($_GET['cat']=='books') echo 'selected';?>>Books</option>
									<option value='games' <?if($_GET['cat']=='games') echo 'selected';?>>Games</option>
									<option value='assets' <?if($_GET['cat']=='assets') echo 'selected';?>>Assets</option>
								</select>
								<br>
								<br>
																		<table class=" table-striped table-bordered table-hover" id="dataTables-example" width="100%" cellspacing="0">
																			<thead>
																				<tr>
																					<th width='3%' >No</th>
																					<th >Code</th>
																					<th >Name</th>
																					<? if(!isset($_GET['cid'])){ ?>
																					<th width='10%'>Class</th>
																					<? } ?>
																					<th >Decription</th>
																					<th width='8%'>Category</th>
																					<th width='8%'>Picture</th>
																					<th width='15%'>Option</th>
																				</tr>
																			</thead>
																			<tbody>
																				<?php
																					$i=1;
																					if($_GET['cid']=='' && $_GET['cat']==''){
																						$query=mysql_query("SELECT a.id_inventory, a.inventory_name, a.description, a.picture, a.picture2, a.path, a.qty, b.class_name FROM inventory AS a, class AS b WHERE b.class_id = a.class_id");
																					}else if($_GET['cid']!='' && $_GET['cat']==''){	
																						if($_GET['scid']!=''){
																							$query=mysql_query("SELECT a.id_inventory, a.inventory_name, a.description, a.picture, a.picture2, a.path, a.qty, b.class_name FROM inventory AS a, class AS b, subclass AS c WHERE a.subclass_id='$_GET[scid]' AND c.subclass_id = a.subclass_id AND b.class_id = a.class_id");
																						}else{
																							$query=mysql_query("SELECT a.id_inventory, a.inventory_name, a.description, a.picture, a.picture2, a.path, a.qty, b.class_name FROM inventory AS a, class AS b WHERE a.class_id='$_GET[cid]' AND b.class_id = a.class_id");
																						}
																					}else if($_GET['cid']=='' && $_GET['cat']!=''){
																						$query=mysql_query("SELECT a.id_inventory, a.inventory_name, a.description, a.picture, a.picture2, a.path, a.qty, b.class_name FROM inventory AS a, class AS b WHERE a.path = '$_GET[cat]' AND b.class_id = a.class_id");
																					}else{
																						if($_GET['scid']!=''){
																							$query=mysql_query("SELECT a.id_inventory, a.inventory_name, a.description, a.picture, a.picture2, a.path, a.qty, b.class_name FROM inventory AS a, class AS b, subclass AS c WHERE a.subclass_id='$_GET[scid]' AND a.path = '$_GET[cat]' AND c.subclass_id = a.subclass_id AND b.class_id = a.class_id");
																						}else{
																							$query=mysql_query("SELECT a.id_inventory, a.inventory_name, a.description, a.picture, a.picture2, a.path, a.qty, b.class_name FROM inventory AS a, class AS b WHERE a.class_id='$_GET[cid]' AND a.path = '$_GET[cat]' AND b.class_id = a.class_id");
																						}
																					}
																					
																					while($datainventory=mysql_fetch_row($query)){
																				?>
																				<tr> 
																					<td ><?php echo $i;?></td>
																					<td ><?php echo $datainventory[0];?></td>
																					<td ><?php echo $datainventory[1];?></td>
																					<? if(!isset($_GET['cid'])){ ?>
																					<td ><?php echo $datainventory[7];?></td>
																					<?}
																					if($datainventory[5]!='assets'){
																					$tmp=$datainventory[2];
																					$tmp1=substr($tmp,0,50);?>
																					<td><?php echo $tmp1.'...';?></td>
																					<?}else{?>
																					<td><?php echo 'Qty : '.$datainventory[6];?></td>
																					<?}?>
																					<td><?php echo $datainventory[5];?></td>
																					<td>
																					<?if($datainventory[3]!=''){?><img id="myImg" src='inventory/<?=$datainventory[5]?>/<?=$datainventory[3]?>' width='48%' height='30px' alt='<?=$datainventory[1]?>'>
																					<?} 
																					if($datainventory[4]!=''){?> <img id="myImg" src='inventory/<?=$datainventory[5]?>/<?=$datainventory[4]?>' width='48%'  height='30px' alt='<?=$datainventory[1]?>'><?}?></td>
																					<td>
																						<table class="tooltip-demo">
																							<tr>
																								<td style='padding: 2px;'>
																									<a href='index.php?page=<?=MD5('inventoryformtoedit')?>&iid=<?=$datainventory[0]?>' title="Edit Inventory Data" id='tombol' data-toggle="tooltip" data-placement="top" ><img src='icons/edit.png' width='80%'></a>
																								</td>
																								<td style='padding: 2px;'>
																									<a href='#' title="Delete Inventory's Data" id='tombol' data-toggle="tooltip" data-placement="top" onclick='deLete("<?=$datainventory[0]?>","<?=$datainventory[1]?>","inventory")'><img src='icons/trash.png' width='80%'></a>
																								</td>
																							</tr>
																						</table>
																					</td>
																				</tr>
																				<?php 
																					$i++;
																				
																				
																				} ?>
																			</tbody>
																		</table>
																	</div>
															
															<div id='archives' class="panel-body" >
															
															</div>
															<!--konfig data table-->
															<!-- DataTables JavaScript -->
												<script src="js/dataTables/jquery.dataTables.js"></script>
												<script src="js/dataTables/dataTables.bootstrap.js"></script>
												
												<!-- Page-Level Demo Scripts - Tables - Use for reference -->
												<script>
													$(document).ready(function() {
														$('#dataTables-example').dataTable( {
															"columnDefs": [
																<? if(!isset($_GET['cid'])){ ?>
																{ "searchable": false, "targets": 7 },
																{ "orderable": false, "targets": 7 },
																{ "orderable": false, "targets": 4 },
																<?}else{?>
																{ "orderable": false, "targets": 3 },
																{ "orderable": false, "targets": 5 },
																<?}?>
																{ "searchable": false, "targets": 6 },
																{ "searchable": false, "targets": 3 },
																{ "searchable": false, "targets": 0 },
																{ "orderable": false, "targets": 6 },
																
																
															],
															"searching":   true,
															 "language": {
																			"lengthMenu": "View _MENU_ inventory's data",
																			"zeroRecords": "Not found",
																			"info": "",
																			"infoEmpty": "",
																			"infoFiltered": ""
																		}
														});
														
													});
													
	function changeMode(class_id, category, sclass_id){

			window.location.href="index.php?page=<?=MD5('inventory')?>&cid="+class_id+"&cat="+category+"&scid="+sclass_id;
	}
	
</script>