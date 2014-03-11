<?php
 /************************************************
  * CGMinerAPI-to-MySQL
  * Version 0.6.2 (2014-03-10)
  * Written using MySQL 5.1.49 and PHP 5.3.21
  * Created by Namachieli
  * 
  * Released under GPLv3 : See http://gplv3.fsf.org/ for details
  * 
  * If you like this tool, please think about donating! Thank you for your support!
  * BTC: 1B36fQVhrmYjAuGHV4RHKQW6ETyMdQfrKQ
  * LTC: LQwRq2Azhp5RNu5x8VumVW9BqM7Sc67LL3
  * DGC: DDZBds4Gw9DY9QtifL6axHMznCLiYXq8jG
  * 
  * This file check if a command is enabled, then if the table for the command exisits
  * and if it doesn't, creates the MySQL table, into the database specified in config.php
  * 
  ***********************************************/
unset($allcommands);
$allcommands = $apicmd;
$con=mysqli_connect($myserver,$myuser,$mypass,$mydb);
foreach ($allcommands as $command)
	{
		//Get the name of the command
		$currentcmd = key($allcommands);
		//and shift it off so the next run gets the next command
		$shift = array_shift($allcommands);
		if ($command == 1)
			{
				//does table exist already?
				$tblcheck = mysqli_query($con,"SELECT 1 FROM $currentcmd");
				//if it doesn't, import the structure from the named .sql file and run it through clean up functions, and push to the database

				if ($tblcheck === FALSE || $tblcheck === NULL)
					{
						$tblcounter++; //metrics
						$dbms_schema = $currentcmd.'.sql';
						$sql_query = @fread(@fopen($dbms_schema, 'r'), @filesize($dbms_schema)) or die('problem ');
						$sql_query = remove_comments($sql_query);
						$sql_query = remove_remarks($sql_query);
						$sql_query = split_sql_file($sql_query, ';');
						mysql_connect($myserver,$myuser,$mypass) or die('error connection');
						mysql_select_db($mydb) or die('error database selection');
						foreach($sql_query as $sql)
							{
								mysql_query($sql) or die('error in query');
							}
					}
			}
	}
