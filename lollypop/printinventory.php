<?
require('fpdf.php');
include("koneksi.php");

class PDF extends FPDF {
// Simple table
function BasicTable($index,$indexname) {
	$this->SetFont('Arial','B',9);
	if($_POST['option']=='1'){
		if($_POST['class']=='all'){
			$query=mysql_query("SELECT a.id_inventory, a.inventory_name, a.description, a.picture, a.picture2, a.path, a.qty, b.class_name, a.subclass_id FROM inventory AS a, class AS b WHERE a.class_id='$index' AND b.class_id = a.class_id ORDER BY a.path ASC");
		}else{
			if($indexname == 'No Subclass Name')
				$query=mysql_query("SELECT a.id_inventory, a.inventory_name, a.description, a.picture, a.picture2, a.path, a.qty, b.class_name, a.subclass_id FROM inventory AS a, class AS b WHERE a.subclass_id = '0' AND a.class_id='$index' AND b.class_id = a.class_id  ORDER BY a.path ASC");
			else
				$query=mysql_query("SELECT a.id_inventory, a.inventory_name, a.description, a.picture, a.picture2, a.path, a.qty, b.class_name, a.subclass_id FROM inventory AS a, class AS b WHERE  a.subclass_id = '$index' AND b.class_id = a.class_id ORDER BY a.path ASC");
		}
		$this->Cell(30,7,$indexname);
		$this->Ln();
		$this->Cell(9,7,'No',1);
		$this->Cell(40,7,'Inventory Code',1);
		$this->Cell(70,7,'Inventory Name',1);
		$this->Cell(30,7,'Category',1);
		if($_POST['class']=='all')
			$this->Cell(30,7,'Subclass',1);
		
	}else{
		$indexname = $index;
		$this->Cell(30,7,$indexname);
		$this->Ln();
		$this->Cell(9,7,'No',1);
		$this->Cell(40,7,'Inventory Code',1);
		$this->Cell(70,7,'Inventory Name',1);
		$this->Cell(30,7,'Class',1);
		$query=mysql_query("SELECT a.id_inventory, a.inventory_name, a.description, a.picture, a.picture2, b.class_name, a.qty, a.path FROM inventory AS a, class AS b WHERE a.path='$index' AND b.class_id = a.class_id ORDER BY a.class_id");
	}
	
	
	

		$this->Ln();	
$this->SetFont('Arial','',9);
$h=6;
$i=1;
while($datainventory=mysql_fetch_row($query)){
	if($_POST['option']=='1'){
		$this->Cell(9,$h,$i,1);	
		$this->Cell(40,$h,$datainventory[0],1);	
		$this->Cell(70,$h,$datainventory[1],1);	
		$this->Cell(30,$h,$datainventory[5],1);
		if($_POST['class'] == 'all'){
			if($datainventory[8]==0)
				$this->Cell(30,$h,'-',1);	
			else{
				$subclass=mysql_fetch_row(mysql_query("SELECT subclass_name FROM subclass WHERE subclass_id = '$datainventory[8]'"));
				$this->Cell(30,$h,$subclass[0],1);	
			}
		}
	}else{
		$this->Cell(9,$h,$i,1);	
		$this->Cell(40,$h,$datainventory[0],1);	
		$this->Cell(70,$h,$datainventory[1],1);	
		$this->Cell(30,$h,$datainventory[5],1);	
	}
	$this->Ln();
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
	$this->Cell(30,6,'Inventory Data');
	$this->Ln();$this->SetFont('Arial','B',10);
	if($_POST['option']=='1')
		if($_POST['class']=='all')
			$this->Cell(30,6,'Print By Class (All)');
		else{
			if($_POST['subclass']=='all'){
				$s=mysql_fetch_array(mysql_query("SELECT * FROM class WHERE class_id = '$_POST[class]'"));
				$this->Cell(30,6,'Print By Class (All - '.$s["class_name"].')');
			}else{
				$s=mysql_fetch_row(mysql_query("SELECT a.class_name, b.subclass_name FROM class AS a, subclass AS b WHERE a.class_id = '$_POST[class]' AND b.subclass_id = '$_POST[subclass]'"));
				$this->Cell(30,6,'Print By Class ('.$s[0].' - '.$s[1].')');
			}
		}
	else{
		$this->Cell(30,6,'Print By Category');
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


$pdf = new PDF('P','mm','A4');
// Data loading
$pdf->SetFont('Arial','',10);
$pdf->AddPage();
if($_POST['option']=='1'){
	if($_POST['class']=='all'){
		$q=mysql_query("SELECT * FROM class ORDER BY class_id ASC");
		while($s=mysql_fetch_array($q)){
			$pdf->BasicTable($s['class_id'],$s['class_name']);
		}
	}else{
		if($_POST['subclass']=='all'){
			$q=mysql_query("SELECT * FROM subclass WHERE class_id = '$_POST[class]' ORDER BY subclass_id ASC");
			while($s=mysql_fetch_array($q)){
				$pdf->BasicTable($s['subclass_id'],$s['subclass_name']);
			}
			$cek = mysql_num_rows(mysql_query("SELECT * FROM inventory WHERE class_id = '$_POST[class]' AND subclass_id = '0' "));
			if($cek>0)
				$pdf->BasicTable($_POST['class'],'No Subclass Name');
		}else{
			$pdf->BasicTable($_POST['subclass'],'');
		}
	}	
}else{
	$path=["books","games","assets"];
	for($i=0;$i<3;$i++){	
		$pdf->BasicTable($path[$i],'');
	}
}
$pdf->Output('Inventory data','I');
?>