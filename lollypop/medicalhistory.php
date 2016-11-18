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
	
	#immunizationtab th, #immunizationtab td{
		text-align:center;
	}
</style>
					<div class="panel-body">
					
						<h4 style='margin-top:0px;'>
							<a href='#' onclick='goBack()' style='margin-right:10px;' title='kembali'><img src='icons/back.png' width='20px' height='20px'></a>
							<b>Student's Medical History</b>
						</h4>
						<form target="_self" method='POST' enctype='multipart/form-data'>
							<table width='98%'  >
								<tr>
									<td width='3%'></td>
									<td width='40%'></td>
									<td width='2%'></td>
									<td></td>
								</tr>
								
								<tr>
									<td><b>I.</b></td>
									<td colspan='3'><b>IMMUNIZATION</b></td>
								</tr>
								<tr>
									<td></td>
									<td colspan='3'>
										<table id='immunizationtab' width='70%' border='1'>
											<tr>
												<th width='40%'>Type</th>
												<th>First Shot</th>
												<th>Second Shot</th>
												<th>Third Shot</th>
											</tr>
											<tr>
												<td>DPT</td>
												<td><input type='checkbox' name='Idpt1'></td>
												<td><input type='checkbox' name='Idpt2'></td>
												<td><input type='checkbox' name='Idpt3'></td>
											</tr>
											<tr>
												<td>Polio</td>
												<td><input type='checkbox' name='Ipolio1'></td>
												<td><input type='checkbox' name='Ipolio2'></td>
												<td><input type='checkbox' name='Ipolio3'></td>
											</tr>
											<tr>
												<td>BCG</td>
												<td><input type='checkbox' name='Ibcg1'></td>
												<td><input type='checkbox' name='Ibcg2'></td>
												<td><input type='checkbox' name='Ibcg3'></td>
											</tr>
											<tr>
												<td>Chicken Pox</td>
												<td><input type='checkbox' name='Icp1'></td>
												<td><input type='checkbox' name='Icp2'></td>
												<td><input type='checkbox' name='Icp3'></td>
											</tr>
											<tr>
												<td>Hepatitis A</td>
												<td><input type='checkbox' name='Iha1'></td>
												<td><input type='checkbox' name='Iha2'></td>
												<td><input type='checkbox' name='Iha3'></td>
											</tr>
											<tr>
												<td>Hepatitis B</td>
												<td><input type='checkbox' name='Ihb1'></td>
												<td><input type='checkbox' name='Ihb2'></td>
												<td><input type='checkbox' name='Ihb3'></td>
											</tr>
										</table>
									</td>
								</tr>
								
								<tr>
									<td colspan='4'></td>
								</tr>
								<tr>
									<td ><b>II. </b></td>
									<td colspan='3'><b>Illnesses, Allergies, & Food Restrictions</b></td>
								</tr>
								<tr>
									<td>a.</td>
									<td colspan='3'>Had you child suffered any of these illnesses in the past ?</td>
								</tr>
								<tr>
									<td></td>
									<td colspan = '3'>
									<table width='100%'>
										<tr>
											<td><input type='checkbox' name='IIameasles'> Measles</td>
											<td><input type='checkbox' name='IIachickenpox'> Chicken Pox</td>
											<td><input type='checkbox' name='IIahepatitis'> Hepatitis</td>
											<td><input type='checkbox' name='IIaepilepsy'> Epilepsy</td>
											<td><input type='checkbox' name='IIamumps'> Mumps</td>
											<td><input type='checkbox' name='IIawhoopingcough'> Whooping Cough</td>
										</tr>
										
										<tr>
											<td><input type='checkbox' name='IIameningitis'> Meningitis</td>
											<td><input type='checkbox' name='IIapneumonia'> Pneumonia</td>
											<td><input type='checkbox' name='IIarheumaticfever'> Rheumatic Fever</td>
											<td><input type='checkbox' name='IIapoliomyelitis'> Poliomyelitis</td>
											<td><input type='checkbox' name='IIadiphthria'> Diphthria</td>
											<td>Others <input type='text' name='IIaothers' style='width:70%'></td>
										</tr>
									</table>
									</td>
								</tr>
								<tr>
									<td>b.</td>
									<td colspan='3'>Had you child suffered any of these illnesses in the past ?</td>
								</tr>
								<tr>
									<td></td>
									<td colspan = '3'>
									<table width='70%'>
										<tr>
											<td><input type='checkbox' name='IIbasthma'> Asthma</td>
											<td><input type='checkbox' name='IIbepilepsy'> Epilepsy</td>
											<td><input type='checkbox' name='IIbchestpain'> Chest pain</td>
										</tr>
										<tr>
											
											<td><input type='checkbox' name='IIbefaintingspells'> Fainting spells</td>
											<td><input type='checkbox' name='IIbbleedingproblem'> Bleeding problem</td>
											<td><input type='checkbox' name='IIbvisualproblem'> Visual Problem</td>
										</tr>
										<tr>
											<td><input type='checkbox' name='IIbfrequentheadaches'> Frequent headaches</td>
											<td><input type='checkbox' name='IIbfrequentstomachaches'> Frequent stomachaches</td>
											<td><input type='checkbox' name='IIbcongenitalheartdisease'> Congenital heart disease</td>
										</tr>
									</table>
									<table width='70%'>
										<tr>
											<td width='35%'><input type='checkbox' name='IIbinfections'> Infections, <i>pls specify</i></td>
											<td width='3%'>:</td>
											<td><input type='text' name='IIbinfectionsdetail'></td>
										</tr>
										<tr>
											<td><input type='checkbox' name='IIbskindiseases'> Skin diseases, <i>pls specify</i></td>
											<td>:</td>
											<td><input type='text' name='IIbskindiseasesdetail'></td>
										</tr>
										<tr>
											<td><input type='checkbox' name='IIballergiesmedication'> Allergies to medication, <i>pls specify</i></td>
											<td>:</td>
											<td><input type='text' name='IIballergiesmedicationdetail'></td>
										</tr>
										<tr>
											<td><input type='checkbox' name='IIballergiesfood'> Allergies to food, <i>pls specify</i></td>
											<td>:</td>
											<td><input type='text' name='IIballergiesfooddetail'></td>
										</tr>
									</table>
									</td>
								</tr>
								<tr>
									<td>c.</td>
									<td colspan='3'>Please specify if there are any food restrictions :</td>
								</tr>
								<tr>
									<td></td>
									<td colspan='3'><input type='text' name='IIc'></td>
								</tr>
								<tr>
									<td>d.</td>
									<td colspan='3'>Please specify if there are any religious regulations :</td>
								</tr>
								<tr>
									<td></td>
									<td colspan='3'><input type='text' name='IId'></td>
								</tr>
								<tr>
								<td colspan='4' align=right><input type='submit' name='save' value='Save'>&nbsp<input type='reset'></td>
							</tr>
							</table>
						</form>
					</div>