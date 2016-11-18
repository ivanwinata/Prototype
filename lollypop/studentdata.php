
<script>
	function changeClass(value){
		if(value == 'all')
			window.location.href="index.php?page=<?=MD5('studentdata')?>";
		else
			window.location.href="index.php?page=<?=MD5('studentdata')?>&cid="+value;
	}
	function changeSubClass(subclassid,classid){
		if(subclassid == 'all')
			window.location.href="index.php?page=<?=MD5('studentdata')?>&cid="+classid;
		else
			window.location.href="index.php?page=<?=MD5('studentdata')?>&cid="+classid+"&scid="+subclassid;
	}
</script>
					<div class="panel-body">
					
						<h4 style='margin-top:0px;'>
							<b>Student's Data Master</b>
						</h4>
							<a href='index.php?page=<?=MD5('addmisionformtoadd')?>'>Add Student</a>	&nbsp
							<a href='#' onclick='loadPage("opsiprint.php?mode=student","opsiprint");'>Print Student's Data</a>	
							<div id='opsiprint'>
							</div>
								<br> 	 	
								View by class &nbsp
								<select onchange='changeClass(this.value)' id='class'>
									<option value='all' >All Class</option>
									<?
									
									$qclass=mysql_query("SELECT * FROM class");
									while($class=mysql_fetch_array($qclass)){ 
									
										if($class['class_id'] != 999){?>
										<option value='<?=$class['class_id']?>' <?if($_GET['cid']==$class['class_id']) echo 'selected';?>><?=$class['class_name']?></option>
										<? }
									}
									?>
								</select>
								<?
								if(isset($_GET['cid'])){
									?>
										<select onchange='changeSubClass(this.value, document.getElementById("class").value)' id='subclass'>
											<option value='all'>All Sub Class</option>
											<?
												$qsubclass=mysql_query("SELECT * FROM subclass WHERE class_id = '$_GET[cid]'");
												while($subclass = mysql_fetch_array($qsubclass)){
													?>
													<option value='<?=$subclass['subclass_id']?>' <?if($_GET['scid']==$subclass['subclass_id']) echo 'selected';?>><?=$subclass['subclass_name']?></option>
													<? 
												}
											?>
										</select>
									<?
								}
								?>
								<br>
								<br>
																		<table class=" table-striped table-bordered table-hover" id="dataTables-example" width="100%" cellspacing="0">
																			<thead>
																				<tr>
																					<th width='3%' >No</th>
																					<th width='20%'>Name</th>
																					<? if(!isset($_GET['cid'])){ ?>
																					<th width='13%'>Class</th>
																					<? } ?>
																					<th width='10%'>Birthday</th>
																					<th >Mother (HP)</th>
																					<th >Father (HP)</th>
																					<th width='15%'>Option</th>
																				</tr>
																			</thead>
																			<tbody>
																				<?php
																					$i=1;
																					if(isset($_GET['cid'])){ 
																						if(isset($_GET['scid'])){
																							$query=mysql_query("SELECT af.full_name, c.subclass_name, af.birthday, af.home_address, af.student_id, af.mother_name, af.mother_hp, af.father_name, af.father_hp FROM admission_form AS af, student_class AS sc, subclass AS c WHERE af.status='active' AND sc.student_id = af.student_id AND sc.subclass_id='$_GET[scid]' AND c.subclass_id = sc.subclass_id ORDER BY sc.class_id ASC, af.full_name ASC");
																						}else{
																							$query=mysql_query("SELECT af.full_name, c.class_name, af.birthday, af.home_address, af.student_id, af.mother_name, af.mother_hp, af.father_name, af.father_hp FROM admission_form AS af, student_class AS sc, class AS c WHERE af.status='active' AND sc.student_id = af.student_id AND c.class_id = sc.class_id AND sc.class_id='$_GET[cid]' ORDER BY sc.class_id ASC, af.full_name ASC");
																						}
																					}else{
																						$query=mysql_query("SELECT af.full_name, c.class_name, af.birthday, af.home_address, af.student_id, af.mother_name, af.mother_hp, af.father_name, af.father_hp FROM admission_form AS af, student_class AS sc, class AS c WHERE af.status='active' AND sc.student_id = af.student_id AND c.class_id = sc.class_id ORDER BY sc.class_id ASC, af.full_name ASC");
																					}
																					while($datastudent=mysql_fetch_row($query)){
																				?>
																				<tr> 
																					<td ><?php echo $i;?></td>
																					<td ><?php echo $datastudent[0]?></td>
																					<? if(!isset($_GET['cid'])){ ?>
																					<td ><?php echo $datastudent[1];?></td>
																					<?}?>
																					<td><?php echo date("d M Y", strtotime($datastudent[2]));?></td>
																					<td><?php echo $datastudent[5].'<br> ('.$datastudent[6].')';?></td>
																					<td><?php echo $datastudent[7].'<br> ('.$datastudent[8].')';?></td>
																					<td>
																						<table class="tooltip-demo">
																							<tr>
																								<td style='padding: 2px;'>
																									<a href='index.php?page=<?=MD5('addmisionformtoedit')?>&sid=<?=$datastudent[4]?>' title="Edit Student's Admission Form" id='tombol' data-toggle="tooltip" data-placement="top" ><img src='icons/editaf.png' width='80%'></a>
																								</td>
																								<!--<td style='padding: 2px;'>
																									<a href='index.php?page=<?=MD5('personalprofile')?>' title="Add / Edit Student's Personal Profile" id='tombol' data-toggle="tooltip" data-placement="top"><img src='icons/editpp.png' width='80%'></a>
																								</td>
																								<td style='padding: 2px;'>
																									<a href='index.php?page=<?=MD5('medicalhistory')?>' title="Add / Edit Student's Medical History" id='tombol' data-toggle="tooltip" data-placement="top"><img src='icons/editmh.png' width='80%'></a>
																								</td>-->
																								<td style='padding: 2px;'>
																									<a href='#archives' title="View to Upload Files" id='tombol' data-toggle="tooltip" data-placement="top" onclick='loadPage("archives.php?sid=<?=$datastudent[4]?>","archives")'><img src='icons/upload.png' width='80%'></a>
																								</td>
																								<td style='padding: 2px;'>
																									<a href='#' title="Delete Student's Data" id='tombol' data-toggle="tooltip" data-placement="top" onclick='deLete("<?=$datastudent[4]?>","<?=$datastudent[0]?>","student")'><img src='icons/trash.png' width='80%'></a>
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
																{ "searchable": false, "targets": 6 },
																{ "orderable": false, "targets": 6 },
																<?}else{?>
																{ "orderable": false, "targets": 2 },
																<?}?>
																{ "searchable": false, "targets": 3 },
																{ "searchable": false, "targets": 2 },
																{ "searchable": false, "targets": 0 },
																{ "orderable": false, "targets": 5 },
																{ "orderable": false, "targets": 4 },
																{ "orderable": false, "targets": 3 }
																
																
															],
															"searching":   true,
															 "language": {
																			"lengthMenu": "View _MENU_ student's data",
																			"zeroRecords": "Not found",
																			"info": "",
																			"infoEmpty": "",
																			"infoFiltered": ""
																		}
														});
														
													});
													
												</script> 