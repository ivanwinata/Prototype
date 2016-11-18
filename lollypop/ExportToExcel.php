<?php

date_default_timezone_set('UTC');

function ExportExcel($table)
	{
		//kasih nama file
		$filename = "tempfile/".$table.'.csv';

		$sql = mysql_query("SELECT * FROM $table") or die(mysql_error());

		$num_rows = mysql_num_rows($sql);
		if($num_rows >= 1)
		{
			$row = mysql_fetch_assoc($sql);
			$fp = fopen($filename, "w");
			$seperator = "";
			$comma = "";

			foreach ($row as $name => $value)
				{
					$seperator .= $comma . '' .str_replace('', '""', $name);
					$comma = ";";
				}

			$seperator .= "\n";
			
					fputcsv($fp, explode(';',$seperator));

			mysql_data_seek($sql, 0);
			$numrecord=0;
			while($row = mysql_fetch_assoc($sql))
				{
					$seperator = "";
					$comma = "";

					foreach ($row as $name => $value) 
						{	
							$seperator .= $comma . '' .str_replace('', '""', $value);
							$comma = ";";
						}

					$seperator .= "\n";
					fputcsv($fp, explode(';',$seperator));
					$numrecord++;
				}
	
			fclose($fp);
			echo '<i style="margin-left:10px;">'.$table.' : '.$numrecord.'<br></i>';
			//echo "Your file is ready. You can download it from <a href='$filename'>here!</a>";
		}
		else
		{
			echo "<i style='margin-left:10px;color:grey'>There is no record in database '".$table."'<br></i>";
		}


	}
?>