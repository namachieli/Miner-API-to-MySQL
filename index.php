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
  * This is the main file to call any includes and and start sucking info from the 
  * API of your favorite family member of CGMiner
  * 
  ***********************************************/
include 'config.php';
include 'functions.php';
include 'sqlbuilder.php';
$miners = $miner;
$tblcounter = 0;
$rowcounter = 0;
foreach($miners as $currentminer) 
	{
		unset($allcommands);
		$allcommands = $apicmd;
		foreach($allcommands as $command )
			{
				$currentcmd = key($allcommands);
				$shift = array_shift($allcommands);
				if ($command == 1)
					{			
						$request = request($currentminer['hostname'], $currentminer['ip'], $currentminer['port'], $currentcmd);
					}
			}
	}
$datetime = date('Y-m-d H:i:s');

?>
	<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="en">
<head>
    <meta http-equiv="refresh" content="<?php $refreshinterval; ?>" charset=utf-8">
    <title>MinerApiToMySql</title>
</head>
<body>
	<?php
		echo "Last completed run: ".$datetime." </br>";
		//echo "New Tables Created: ".$tblcounter." ;</br>";
		//echo "New Rows Created: ".$rowcounter." ;</br>";
	?>
</body>
</html>
