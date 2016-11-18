<?

date_default_timezone_set('UTC');
$tanggal = date('d');
$bulan = date('m');
$tahun = date('Y');

if(isset($_GET['birthday']))
$birthday=explode("-",$_GET['birthday']);
else if(isset($datastudent[2]))
$birthday=explode("-",$datastudent[2]);
else if(isset($inquiry['birthday']))
$birthday=explode("-",$inquiry['birthday']);

$age=$tahun - $birthday[0];

if(($birthday[1] > $bulan) || ($birthday[1] == $bulan && $birthday[2] > $tanggal) ){
	if($age > 0)
		$age = $age-1;

}

echo $age.' y.o';
?>