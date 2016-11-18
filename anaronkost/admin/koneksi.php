<?php
	$hostname="localhost";
	$username="root";
	$password="ivanwinata8";
	$database="anaronkost";

	if (!$dbh=mysql_connect($hostname,$username,$password))
	{
  		 echo mysql_error();
   		exit;
	} else {
   		mysql_select_db($database, $dbh);
	}
?>
