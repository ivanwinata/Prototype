<?
if(isset($_POST['save'])){
	
}
?>

<style>
	input[type=text], #age{
		width:100%;
		border:0px solid black;
		border-bottom:1px solid grey;
		height:25px;
	}
	td{
		padding:5px 0px 5px 0px;
	}
	select{
		height:100%;
	}
	td i{
		color:grey;
	}
</style>
					<div class="panel-body">
					
						<h4 style='margin-top:0px;'>
							<a href='#' onclick='goBack()' style='margin-right:10px;' title='kembali'><img src='icons/back.png' width='20px' height='20px'></a>
							<b>Student's Personal Profile Form</b>
						</h4>
						<form target="_self" method='POST' enctype='multipart/form-data'>
							<table width='98%'  >
								<tr>
									<td width='3%'></td>
									<td width='10%'></td>
									<td width='2%'></td>
									<td width='10%'></td>
									<td width='2%'></td>
									<td width='3%'></td>
									<td width='2%'></td>
									<td ></td>
								</tr>
								<tr>
									<td ><b>I. </b></td>
									<td colspan='7'><b>FAMILY</b></td>
								</tr>
								<tr>
									<td >a. </td>
									<td colspan='3'>The child is attached to</td>
									<td >:</td>
									<td colspan='3'><select name='Ia'>
										<option value='' disabled selected>Choose</option>
										<option value='mother'>Mother</option>
										<option value='father'>Father</option>
										<option value='both'>Both</option>
									</select></td>
								</tr>
								<tr>
									<td >b. </td>
									<td colspan='3'>Activities the child enjoys with</td>
									<td colspan='4'>:</td>

								</tr>
								<tr>
									<td ></td>
									<td width='10%'>&nbsp&nbsp&nbsp Mother</td>
									<td >:</td>
									<td colspan='5'><input type='text' name='Ib1'></td>
	
								</tr>
								<tr>
									<td ></td>
									<td>&nbsp&nbsp&nbsp Father</td>
									<td>:</td>
									<td colspan='5'><input type='text' name='Ib2'></td>
	
								</tr>
								<tr>
									<td >c.</td>
									<td colspan='3'>First Language at home</td>
									<td>:</td>
									<td colspan='3'><input type='text' name='Ic'></td>
	
								</tr>
								<tr>
									<td >d.</td>
									<td colspan='3'>Dialect spoken at home</td>
									<td>:</td>
									<td colspan='3'><input type='text' name='Id'></td>
	
								</tr>
								<tr>
									<td >e.</td>
									<td colspan='3'>Child's position in the family</td>
									<td>:</td>
									<td colspan='3'><input type='text' name='Ie'></td>
	
								</tr>
								<tr>
									<td valign=top>f.</td>
									<td colspan='7'>
										<table width='70%' style='margin-left:30px'>
										<tr>
											<td align=center width='8%'>Siblings :</td>
											<td align=center width='70%'>Name</td>
											<td align=center width='22%'>Age</td>
										</tr>
										<?
										for($i=0;$i<6;$i++){?>
										<tr>
											<td style='padding-left:10px;'><?=$i+1?></td>
											<td style='padding-left:10px;'><input type='text' name='Ifname<?=$i?>' ></td>
											<td style='padding-left:20px;'><input type='text' name='Ifage<?=$i?>' ></td>
										</tr>
										<?}
										
										?>
										</table>
									</td>
								</tr>
								<tr>
									<td colspan='8'></td>
								</tr>
								<tr>
									<td ><b>II. </b></td>
									<td colspan='7'><b>SPEECH & GROWTH</b></td>
								</tr>
								<tr>
									<td>a.</td>
									<td colspan='5'>The child started walking at the age of</td>
									<td >:</td>
									<td ><input type='text' name='IIayear' style='width:70px'>&nbsp&nbsp&nbsp year(s) and/or &nbsp&nbsp&nbsp<input type='text' name='IIamonth' style='width:70px'>&nbsp&nbsp&nbsp month(s)</td>
								</tr>
								<tr>
									<td></td>
									<td colspan ='3'>&nbsp&nbsp&nbsp <i>Difficulties encountered</i></td>
									<td>:</td>
									<td colspan='3'><input type='text' name='IIadiff'></td>
								</tr>
								<tr>
									<td>b.</td>
									<td colspan='5'>The child started walking at the age of</td>
									<td >:</td>
									<td ><input type='text' name='IIbyear' style='width:70px'>&nbsp&nbsp&nbsp year(s) and/or &nbsp&nbsp&nbsp<input type='text' name='IIbmonth' style='width:70px'>&nbsp&nbsp&nbsp month(s)</td>
								</tr>
								<tr>
									<td></td>
									<td colspan ='3'>&nbsp&nbsp&nbsp <i>Difficulties encountered</i></td>
									<td>:</td>
									<td colspan='3'><input type='text' name='IIbdiff'></td>
								</tr>
								<tr>
									<td colspan='8'></td>
								</tr>
								<tr>
									<td ><b>III. </b></td>
									<td colspan='7'><b>PERSONAL TRAITS & CHARACTERISTICS</b></td>
								</tr>
								<tr>
									<td colspan='8'><i>Please comment on the child's behavior; those traits & characteristics abserved in particular circumstances or situations. Indicate the trait(s) where in the child needs correction or guidance.</i></td>
								</tr>
								<tr>
									<td>a.</td>
									<td colspan='3'>friendly / outgoing</td>
									<td>:</td>
									<td colspan='3'><input type='text' name='IIIa'></td>
								</tr>
								<tr>
									<td>b.</td>
									<td colspan='3'>shy / withdrawn</td>
									<td>:</td>
									<td colspan='3'><input type='text' name='IIIb'></td>
								</tr>
								<tr>
									<td>c.</td>
									<td colspan='3'>self-confident</td>
									<td>:</td>
									<td colspan='3'><input type='text' name='IIIc'></td>
								</tr>
								<tr>
									<td>d.</td>
									<td colspan='3'>lacking self-confident</td>
									<td>:</td>
									<td colspan='3'><input type='text' name='IIId'></td>
								</tr>
								<tr>
									<td>e.</td>
									<td colspan='3'>stubbron</td>
									<td>:</td>
									<td colspan='3'><input type='text' name='IIIe'></td>
								</tr>
								<tr>
									<td>f.</td>
									<td colspan='3'>cooperative</td>
									<td>:</td>
									<td colspan='3'><input type='text' name='IIIf'></td>
								</tr>
								<tr>
									<td>g.</td>
									<td colspan='3'>docile</td>
									<td>:</td>
									<td colspan='3'><input type='text' name='IIIg'></td>
								</tr>
								<tr>
									<td>h.</td>
									<td colspan='3'>aggressive</td>
									<td>:</td>
									<td colspan='3'><input type='text' name='IIIh'></td>
								</tr>
								<tr>
									<td>i.</td>
									<td colspan='3'>self-occupied</td>
									<td>:</td>
									<td colspan='3'><input type='text' name='IIIi'></td>
								</tr>
								<tr>
									<td>j.</td>
									<td colspan='3'>too energetic / restless</td>
									<td>:</td>
									<td colspan='3'><input type='text' name='IIIj'></td>
								</tr>
								<tr>
									<td>k.</td>
									<td colspan='3'>sluggish / slow to act</td>
									<td>:</td>
									<td colspan='3'><input type='text' name='IIIk'></td>
								</tr>
								<tr>
									<td colspan='8'></td>
								</tr>
								<tr>
									<td ><b>IV. </b></td>
									<td colspan='7'><b>INDEPENDENCE</b></td>
								</tr>
								<tr>
									<td colspan='8'><i>Please comment the following activities to indicate whether each is done independently or with some help. If so, by whom ?</i></td>
								</tr>
								<tr>
									<td>a.</td>
									<td colspan='3'>eating</td>
									<td>:</td>
									<td colspan='3'><input type='text' name='IVa'></td>
								</tr>
								<tr>
									<td>b.</td>
									<td colspan='3'>drinking</td>
									<td>:</td>
									<td colspan='3'><input type='text' name='IVb'></td>
								</tr>
								<tr>
									<td>c.</td>
									<td colspan='3'>washing up</td>
									<td>:</td>
									<td colspan='3'><input type='text' name='IVc'></td>
								</tr>
								<tr>
									<td>d.</td>
									<td colspan='3'>dressing up</td>
									<td>:</td>
									<td colspan='3'><input type='text' name='IVd'></td>
								</tr>
								<tr>
									<td>e.</td>
									<td colspan='3'>going to the toilet</td>
									<td>:</td>
									<td colspan='3'><input type='text' name='IVe'></td>
								</tr>
								<tr>
									<td>f.</td>
									<td colspan='3'>bathing</td>
									<td>:</td>
									<td colspan='3'><input type='text' name='IVf'></td>
								</tr>
								<tr>
									<td>g.</td>
									<td colspan='3'>brushing teeth</td>
									<td>:</td>
									<td colspan='3'><input type='text' name='IVg'></td>
								</tr>
								<tr>
									<td>h.</td>
									<td colspan='3'>playing</td>
									<td>:</td>
									<td colspan='3'><input type='text' name='IVh'></td>
								</tr>
								
								<tr>
									<td colspan='8'></td>
								</tr>
								<tr>
									<td ><b>V. </b></td>
									<td colspan='7'><b>ACADEMICS</b></td>
								</tr>
								<tr>
									<td colspan='8'><i>Please comment about the child's familiarity with the following :</i></td>
								</tr>
								
								<tr>
									<td >a. </td>
									<td colspan='3'>The Alphabets</td>
									<td colspan='4'>:</td>

								</tr>
								<tr>
									<td ></td>
									<td width='10%'><i>&nbsp&nbsp&nbsp Names</i></td>
									<td >:</td>
									<td colspan='5'><input type='text' name='Vanames'></td>
	
								</tr>
								<tr>
									<td ></td>
									<td><i>&nbsp&nbsp&nbsp Sounds</i></td>
									<td>:</td>
									<td colspan='5'><input type='text' name='Vasounds'></td>
	
								</tr>
								
								<tr>
									<td>b.</td>
									<td colspan='3'>Numbers</td>
									<td>:</td>
									<td colspan='3'><input type='text' name='Vb'></td>
								</tr>
								
								<tr>
									<td>c.</td>
									<td colspan='3'>Shapes</td>
									<td>:</td>
									<td colspan='3'><input type='text' name='Vc'></td>
								</tr>
								
								<tr>
									<td>d.</td>
									<td colspan='3'>Colors</td>
									<td>:</td>
									<td colspan='3'><input type='text' name='Vd'></td>
								</tr>
								
							<tr>
								<td colspan='8' align=right><input type='submit' name='save' value='Save'>&nbsp<input type='reset'></td>
							</tr>
							</table>
						</form>
					</div>