<?	

function message($msg){
	echo $pesan = $pesan.$msg;
}

function restore($file){
		if (file_exists('xxx/tempfile/'.$file)) {
		$handle = fopen('xxx/tempfile/'.$file, "r");
		$c = 0;
		while(($filesop = fgetcsv($handle, 1000, ",")) !== false)
		{
				if($c!=0){
					if($file=='admission_form.csv'){
						$sql = mysql_query("INSERT INTO admission_form VALUES (
						'$filesop[0]','$filesop[1]','$filesop[2]','$filesop[3]','$filesop[4]','$filesop[5]',
						'$filesop[6]','$filesop[7]','$filesop[8]','$filesop[9]','$filesop[10]','$filesop[11]',
						'$filesop[12]','$filesop[13]','$filesop[14]','$filesop[15]','$filesop[16]','$filesop[17]',
						'$filesop[18]','$filesop[19]','$filesop[20]','$filesop[21]','$filesop[22]','$filesop[23]',
						'$filesop[24]','$filesop[25]','$filesop[26]','$filesop[27]','$filesop[28]','$filesop[29]',
						'$filesop[30]','$filesop[31]','$filesop[32]','$filesop[33]','$filesop[34]')");
					}else if($file=='class.csv'){
						$sql = mysql_query("INSERT INTO class VALUES (
						'$filesop[0]','$filesop[1]')");
					}else if($file=='files_upload.csv'){
						$sql = mysql_query("INSERT INTO files_upload VALUES (
						'$filesop[0]','$filesop[1]','$filesop[2]','$filesop[3]','$filesop[4]','$filesop[5]')");
					}else if($file=='inventory.csv'){
						$sql = mysql_query("INSERT INTO inventory VALUES (
						'$filesop[0]','$filesop[1]','$filesop[2]','$filesop[3]','$filesop[4]','$filesop[5]','$filesop[6]','$filesop[7]')");
					}else if($file=='student_class.csv'){
						$sql = mysql_query("INSERT INTO student_class VALUES (
						'$filesop[0]','$filesop[1]','$filesop[2]','$filesop[3]','$filesop[4]','$filesop[5]')");
					}else if($file=='user.csv'){
						$sql = mysql_query("INSERT INTO user VALUES (
						'$filesop[0]','$filesop[1]','$filesop[2]','$filesop[3]')");
					}else if($file=='subclass.csv'){
						$sql = mysql_query("INSERT INTO subclass VALUES (
						'$filesop[0]','$filesop[1]','$filesop[2]')");
					}
				}

			$c = $c + 1;
		}
		
			if($sql){
				message("Your file ".$file." has imported successfully. You have inserted ". ($c-1) ." recoreds <br>");
			}else{
				message("Sorry! There is some problem in file ".$file." <br>");
			}
		}
}


//af
$af = mysql_query('select * from admission_form LIMIT 1');
		if($af == FALSE){
			$createtable = mysql_query("CREATE TABLE admission_form (
			student_id INT(11) PRIMARY KEY,
			full_name VARCHAR(200) NOT NULL,
			nick_name VARCHAR(100) NOT NULL,
			sex CHAR(1) NOT NULL,
			birthday DATE NOT NULL,
			birthplace VARCHAR(50) NOT NULL,
			nationality VARCHAR(50) NOT NULL,
			raligion VARCHAR(20) NOT NULL,
			home_address TEXT NOT NULL,
			home_phone_number VARCHAR(15) NOT NULL,
			fax_number VARCHAR(15) NOT NULL,
			father_name VARCHAR(200) NOT NULL,
			father_office_name VARCHAR(200) NOT NULL,
			father_office_address VARCHAR(300) NOT NULL,
			father_office_phone_number VARCHAR(15) NOT NULL,
			father_office_fax_number VARCHAR(15) NOT NULL,
			father_email VARCHAR(100) NOT NULL,
			father_hp VARCHAR(100) NOT NULL,
			mother_name VARCHAR(200) NOT NULL,
			mother_office_name VARCHAR(200) NOT NULL,
			mother_office_address VARCHAR(300) NOT NULL,
			mother_office_phone_number VARCHAR(15) NOT NULL,
			mother_office_fax_number VARCHAR(15) NOT NULL,
			mother_email VARCHAR(100) NOT NULL,
			mother_hp VARCHAR(100) NOT NULL,
			emergency_contact_name VARCHAR(200) NOT NULL,
			emergency_contact_relationship VARCHAR(50) NOT NULL,
			emergency_contact_address VARCHAR(300) NOT NULL,
			emergency_contact_phone_number VARCHAR(100) NOT NULL,
			school_last_attended VARCHAR(100) NOT NULL,
			registration_date DATE NOT NULL,
			picture VARCHAR(200) NOT NULL,
			uname VARCHAR(100) NOT NULL,
			date_updated DATETIME NOT NULL,
			status VARCHAR(20) NOT NULL
			) ");
			restore('admission_form.csv');
		}else{
			$truncate = mysql_query("TRUNCATE TABLE admission_form");
			restore('admission_form.csv');
		}
		
		
//class		
$class = mysql_query('select * from class LIMIT 1');
		if($class == FALSE){
			$createtable = mysql_query("CREATE TABLE class (
			class_id INT(3) PRIMARY KEY,
			class_name VARCHAR(20) NOT NULL
			) ");
			restore('class.csv');
		}else{
			$truncate = mysql_query("TRUNCATE TABLE class");
			restore('class.csv');
		}
		
		
//files upload		
$fu = mysql_query('select * from files_upload LIMIT 1');
		if($class == FALSE){
			$createtable = mysql_query("CREATE TABLE files_upload (
			id INT(11) PRIMARY KEY,
			student_id INT(11) NOT NULL,
			file_title VARCHAR(200) NOT NULL,
			file_name VARCHAR(210) NOT NULL,
			uploaded_date DATETIME NOT NULL,
			uname VARCHAR(100) NOT NULL
			) ");
			restore('files_upload.csv');
		}else{
			$truncate = mysql_query("TRUNCATE TABLE files_upload");
			restore('files_upload.csv');
		}
		
		
		
//inventory		
$fu = mysql_query('select * from inventory LIMIT 1');
		if($class == FALSE){
			$createtable = mysql_query("CREATE TABLE inventory (
			id_inventory INT(11) PRIMARY KEY,
			inventory_name VARCHAR(200) NOT NULL,
			description VARCHAR(500) NOT NULL,
			picture VARCHAR(100) NOT NULL,
			picture2 VARCHAR(100) NOT NULL,
			path VARCHAR(20) NOT NULL,
			qty INT(11) NOT NULL,
			class_id INT(3) NOT NULL
			) ");
			restore('inventory.csv');
		}else{
			$truncate = mysql_query("TRUNCATE TABLE files_upload");
			restore('inventory.csv');
		}
		
			
//student class		
$fu = mysql_query('select * from student_class LIMIT 1');
		if($class == FALSE){
			$createtable = mysql_query("CREATE TABLE student_class (
			id INT(11) PRIMARY KEY AUTO INCREMENT,
			class_id INT(3) NOT NULL,
			student_id INT(11) NOT NULL,
			year VARCHAR(9) NOT NULL,
			mark_not_in CHAR(1) NOT NULL
			subclass_id INT(11) NOT NULL
			) ");
			restore('student_class.csv');
		}else{
			$truncate = mysql_query("TRUNCATE TABLE student_class");
			restore('student_class.csv');
		}
		
				
//user	
$fu = mysql_query('select * from user LIMIT 1');
		if($class == FALSE){
			$createtable = mysql_query("CREATE TABLE user (
			uname VARCHAR(100) PRIMARY KEY,
			pword VARCHAR(100) NOT NULL,
			name VARCHAR(100) NOT NULL,
			category VARCHAR(100) NOT NULL
			) ");
			restore('user.csv');
		}else{
			$truncate = mysql_query("TRUNCATE TABLE user");
			restore('user.csv');
		}			
//subclass	
$fu = mysql_query('select * from subclass LIMIT 1');
		if($class == FALSE){
			$createtable = mysql_query("CREATE TABLE subclass (
			subclass_id INT(11) PRIMARY KEY AUTO INCREMENT,
			class_id INT(11) NOT NULL,
			subclass_name VARCHAR(100) NOT NULL,
			) ");
			restore('subclass.csv');
		}else{
			$truncate = mysql_query("TRUNCATE TABLE subclass");
			restore('subclass.csv');
		}
			
?><script language='JavaScript'>
								alert("Proses Restore Selesai");
								document.location='index.php';
							</script>