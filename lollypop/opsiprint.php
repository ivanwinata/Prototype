<?
include 'koneksi.php';
?>

<style>
	input[type="checkbox"]{
		margin:0px 0px 0px 5px;
	}
	span{
		margin-left:10px
	}
</style>
<div style='border:1px solid grey;background:lightgrey; padding:2px;'>
<?if($_GET['mode']=='student'){?>
<form target=_blank method='POST' action='printstudent.php'>
<span>
Print by Class &nbsp
								<select name='class' onchange='loadPage("loadsubclass.php?cid="+this.value+"&print=yes","subclass");'>
									<option value='all' >All Class</option>
									<?
									
									$qclass=mysql_query("SELECT * FROM class");
									while($class=mysql_fetch_array($qclass)){ 
									
										if($class['class_id'] != 999){?>
										<option value='<?=$class['class_id']?>' ><?=$class['class_name']?></option>
										<? }
									}
									?>
								</select>
							</span>
							<span id='subclass'>
							</span>
<span >
Field : 
<input type='checkbox' value='1'  checked disabled> Student's Name						
<input type='checkbox' value='2' name='birthday'> Birthday					
<input type='checkbox' value='3' name='parent'> Parent's Contact	
</span>		
<span>
<input type='submit' value='Print'>
</span>			
</form>
<?}else if($_GET['mode']=='inventory'){?>	
<form target=_blank method='POST' action='printinventory.php'>
<span>
Print by &nbsp
								<select name='option' onchange='loadPage("loadclass.php?opt="+this.value,"class");'>
									<option value='1'>Class</option>
									<option value='2' selected>Category</option>
								</select>
							</span>
							<span id='class'>
							
							</span>
<span>
<input type='submit' value='Print'>
</span>			
</form>
<?}?>
</div>