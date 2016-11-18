<?php
	$hostname="localhost";
	$username="root";
	$password="ivanwinata8";
	$database="lollypop_preschool";

	if (!$dbh=mysql_connect($hostname,$username,$password))
	{
  		 echo mysql_error();
		 
   		exit;
	} else {
		$connect = mysql_select_db($database, $dbh);
		if(!$connect)
			echo $errorconnectdb='not exist';
	}
?>
