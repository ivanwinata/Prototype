<?
include 'koneksi.php';
if($_GET['opt'] == '1'){
?>
Choose Class <select name='class' onchange='loadPage("loadsubclass.php?cid="+this.value+"&print=yes","subclass");'>
									<option value='all' >All Class</option>
									<?
									
									$qclass=mysql_query("SELECT * FROM class");
									while($class=mysql_fetch_array($qclass)){ 
										?>
										<option value='<?=$class['class_id']?>' ><?=$class['class_name']?></option>
										<? 
									}
									?>
								</select>
								
							<span id='subclass'> 
							</span>
						<?}?>