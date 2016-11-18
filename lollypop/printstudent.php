<?
require('fpdf.php');
include("koneksi.php");

class PDF extends FPDF {
// Simple table
function BasicTable($id,$name) {
	if($_POST['class']=='all'){
		$query=mysql_query("SELECT af.full_name, c.class_name, af.birthday, af.home_address, af.student_id, af.mother_name, af.mother_hp, af.father_name, af.father_hp, d.subclass_name FROM admission_form AS af, student_class AS sc, class AS c, subclass AS d WHERE af.status='active' AND sc.student_id = af.student_id AND c.class_id = sc.class_id AND sc.class_id='$id' AND d.subclass_id = sc.subclass_id ORDER BY sc.class_id ASC, af.full_name ASC, d.subclass_id ASC");
		$cek1 = mysql_num_rows(mysql_query("SELECT * FROM student_class WHERE class_id = '$id' AND subclass_id = '0' "));
	}else{
		if($name == 'No Subclass Name')
			$query=mysql_query("SELECT af.full_name, c.class_name, af.birthday, af.home_address, af.student_id, af.mother_name, af.mother_hp, af.father_name, af.father_hp FROM admission_form AS af, student_class AS sc, class AS c WHERE af.status='active' AND sc.student_id = af.student_id AND c.class_id = sc.class_id AND sc.subclass_id='0' AND sc.class_id = '$id' ORDER BY af.full_name ASC");
		else
			$query=mysql_query("SELECT af.full_name, c.class_name, af.birthday, af.home_address, af.student_id, af.mother_name, af.mother_hp, af.father_name, af.father_hp, d.subclass_name FROM admission_form AS af, student_class AS sc, class AS c, subclass AS d WHERE af.status='active' AND sc.student_id = af.student_id AND c.class_id = sc.class_id AND sc.subclass_id='$id' AND d.subclass_id = sc.subclass_id ORDER BY af.full_name ASC, d.subclass_id ASC");
	}

	$this->SetFont('Arial','B',9);
	if($_POST['class']=='all' ||$_POST['subclass']=='all'){
		$this->Cell(30,7,$name);
		$this->Ln();
	}
	
	$this->Cell(9,7,'No',1);
	$this->Cell(50,7,'Student Name',1);
	if($_POST['class']=='all')
		$this->Cell(30,7,'Subclass',1);
	if(isset($_POST['birthday']))
		$this->Cell(25,7,'Birthday',1);
	if(isset($_POST['parent']))
		$this->Cell(100,7,'Parent',1);
	$this->Ln();
	
	
$this->SetFont('Arial','',9);

$i=1;
$index=0;		
if(!isset($_POST['parent']))
	$h=6;
else
	$h=12;
while($datastudent=mysql_fetch_row($query)){
	$this->Cell(9,$h,$i,1);	
	$this->Cell(50,$h,$datastudent[0],1);	
	if($_POST['class']=='all')
		$this->Cell(30,$h,$datastudent[9],1);
	if(isset($_POST['birthday'])){
		$bday=explode('-', $datastudent[2]);
		
		$this->Cell(25,$h,$bday[2].'-'.$bday[1].'-'.$bday[0],1);
		$w=114;
	}else
		$w=89;
	
	
	if(isset($_POST['parent'])){
	$fcontact = 'Father - '.$datastudent[7].' ('.$datastudent[8].')';
	$this->Cell(100,6,$fcontact,1);	
	$this->Ln();
	if($_POST['class']!='all' && $_POST['subclass']=='all' || $_POST['subclass']!='all')
		$w = $w-30;
	$this->Cell($w,6,'',0);
	$mcontact = 'Mother - '.$datastudent[5].' ('.$datastudent[6].')';
	$this->Cell(100,6,$mcontact,1);
	}
	$i++;
	$this->Ln();
}

if($_POST['class']=='all' && $cek1>0){
	$query=mysql_query("SELECT af.full_name, c.class_name, af.birthday, af.home_address, af.student_id, af.mother_name, af.mother_hp, af.father_name, af.father_hp FROM admission_form AS af, student_class AS sc, class AS c WHERE af.status='active' AND sc.student_id = af.student_id AND c.class_id = sc.class_id AND sc.class_id='$id' AND sc.subclass_id = '0' ORDER BY sc.class_id ASC, af.full_name ASC");
	while($datastudent=mysql_fetch_row($query)){
		$this->Cell(9,$h,$i,1);	
		$this->Cell(50,$h,$datastudent[0],1);	
		$this->Cell(30,$h,'-',1);
	if(isset($_POST['birthday'])){
		$bday=explode('-', $datastudent[2]);
		
		$this->Cell(25,$h,$bday[2].'-'.$bday[1].'-'.$bday[0],1);
		$w=114;
	}else
		$w=89;
	
	
	if(isset($_POST['parent'])){
	$fcontact = 'Father - '.$datastudent[7].' ('.$datastudent[8].')';
	$this->Cell(100,6,$fcontact,1);	
	$this->Ln();
	$this->Cell($w,6,'',0);
	$mcontact = 'Mother - '.$datastudent[5].' ('.$datastudent[6].')';
	$this->Cell(100,6,$mcontact,1);
	}
	$i++;
	$this->Ln();
	}
}

$this->Ln();
}

// Page header
function Header()
{


	// Logo
	//$this->Image('logo.png',10,6,30);
	
	
	// Title
	$this->SetFont('Arial','B',16);
	$this->Cell(30,6,'Students Data');
	$this->Ln();$this->SetFont('Arial','B',10);
	if($_POST['class']=='all')
		$this->Cell(30,6,'All Class');
	else{
		if($_POST['subclass']=='all'){
			$s=mysql_fetch_array(mysql_query("SELECT * FROM class WHERE class_id = '$_POST[class]'"));
			$this->Cell(30,6,$s['class_name']);
		}else{
			$s=mysql_fetch_row(mysql_query("SELECT a.class_name, b.subclass_name FROM class AS a, subclass AS b WHERE a.class_id = '$_POST[class]' AND b.subclass_id = '$_POST[subclass]'"));
			$this->Cell(30,6,$s[0].' ('.$s[1].')');
		}
	}
	// Line break
	$this->Ln(8);
	
	
	
}

// Page footer
function Footer()
{
	// Position at 1.5 cm from bottom
	$this->SetY(-15);
	// Arial italic 8
	$this->SetFont('Arial','I',8);
	// Page number
	$this->Cell(0,10,'Halaman '.$this->PageNo(),0,0,'C');
}
}

if($_POST['class']=='all' && isset($_POST['birthday']) && isset($_POST['parent']))
$pdf = new PDF('L','mm','A4');
else
$pdf = new PDF('P','mm','A4');
// Data loading
$pdf->SetFont('Arial','',10);
$pdf->AddPage();
if($_POST['class']=='all'){
	$q=mysql_query("SELECT * FROM class WHERE class_id != 999 ORDER BY class_id ASC");
	while($s=mysql_fetch_array($q)){
		$pdf->BasicTable($s['class_id'],$s['class_name']);
		
	}
		
}else{
	if($_POST['subclass']=='all'){
		$q=mysql_query("SELECT * FROM subclass WHERE class_id = '$_POST[class]' ORDER BY subclass_id ASC");
		while($s=mysql_fetch_array($q)){
			$pdf->BasicTable($s['subclass_id'],$s['subclass_name']);
		}
		$cek = mysql_num_rows(mysql_query("SELECT * FROM student_class WHERE class_id = '$_POST[class]' AND subclass_id = '0' "));
		if($cek>0)
			$pdf->BasicTable($_POST['class'],'No Subclass Name');
	}else{
		$pdf->BasicTable($_POST['subclass'],'');
	}
}
$pdf->Output('Students data','I');
?>