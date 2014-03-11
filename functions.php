<?php
 /************************************************
  * CGMinerAPI-to-MySQL
  * Version 0.6.2 (2014-03-10)
  * Written using MySQL 5.1.49 and PHP 5.3.21
  * Updated/Modified by Namachieli
  * Created by Ckolivas and phpBB team
  *
  * Released under GPLv3 : See http://gplv3.fsf.org/ for details
  * 
  * If you like this tool, please think about donating! Thank you for your support!
  * BTC: 1B36fQVhrmYjAuGHV4RHKQW6ETyMdQfrKQ
  * LTC: LQwRq2Azhp5RNu5x8VumVW9BqM7Sc67LL3
  * DGC: DDZBds4Gw9DY9QtifL6axHMznCLiYXq8jG
  * 
  * The meat of these functions were orignially incliuded with cgminer, created by Ckolivas. https://github.com/ckolivas
  * The MySQL cleanup while loop found in request() was written (and paid for by me) specifically for this project by Kimax. https://github.com/Kimax89/CGminer-to-MySQL
  * The sql parser functions were copied from phpbb's sql_parse.php
  * I have modified the aboved referenced code and added additional logic to achive my goal of pulling A LOT of data cleanly out of the cgminer family.
  *  
  ***********************************************/
 
//
// Ckolivas functions. Get, read and request Socket for CGMiner API
//
function getsock($addr, $port)
	{
						
		$socket = null;
		$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
		if ($socket === false || $socket === null)
		{
			$error = socket_strerror(socket_last_error());
			$msg = "socket create(TCP) failed";
		echo "ERR: $msg '$error'\n";
		return null;
	}

	$res = socket_connect($socket, $addr, $port);
	if ($res === false)
	{
		$error = socket_strerror(socket_last_error());
		$msg = "socket connect($addr,$port) failed";
		echo "ERR: $msg '$error'\n";
		socket_close($socket);
		return null;
	}
	return $socket;
}
#
# Slow ...
function readsockline($socket)
	{
		$line = '';
	while (true)
	{
		$byte = socket_read($socket, 1);
		if ($byte === false || $byte === '')
			break;
		if ($byte === "\0")
			break;
		$line .= $byte;
	}
 	return $line;
}
#
function request($hostname, $ip, $port, $cmd)
	{
	global $myserver, $myuser, $mypass, $mydb;
	//formatting for the when and host name columns
	$datetime = "'".date('Y-m-d H:i:s')."', ";
	$hostname = "'".$hostname."', ";
	$socket = getsock($ip, $port);
	if ($socket != null)
		{
			socket_write($socket, $cmd, strlen($cmd));
			$line = readsockline($socket);
			socket_close($socket);

			if (strlen($line) == 0)
				{
					echo "WARN: '$cmd' returned nothing\n";
					return $line;
				}
			// Take $line and explode into an array, 1 array for each Object string, with 0=pre info
			$allobjects = explode("|",$line);
									
			// Take $allobjects[] and remove the pre info for specific commands, not sure if needed for all commands.
			if ($cmd == pools || devs || summary)
				{
					$preobject = array_shift($allobjects);
					$postobject = array_pop($allobjects);
				}
			// Loop through the array of strings and explode them into arrays and build an array of arrays
			$i=0;
			while ($allobjects[0] != null)
				{
					$currentobject = array_shift($allobjects);
					$curobjvalues = explode(",",$currentobject);
					$objectvaluesmda[$i] = $curobjvalues;
					$i++;
				}
			// Run each array through a last clean up and push to values MySql
			foreach ($objectvaluesmda as $curvalues)
				{
				// strip all but output values for table structure and input to MySQL
							$con=mysqli_connect($myserver,$myuser,$mypass,$mydb);
							$cnt = 0;
							$valuescount = count($curvalues);
							$valuescountlast = $valuescount - 1;
							// Kimax's Mysql clean up loop
							while ($cnt<$valuescount)
							{
								$sql = explode("=", $curvalues[$cnt]);
								if ($cnt == 0) $sqldata = "'{$sql[1]}',";
								elseif ($cnt == $valuescountlast) $sqldata = "$sqldata '{$sql[1]}'";
								else $sqldata = "$sqldata '{$sql[1]}',";
								$cnt++;
							}
					$sqldata = "$hostname$datetime$sqldata";
					$rowcounter++;  //metrics
					mysqli_query($con,"INSERT INTO $cmd VALUES ($sqldata)");
					mysqli_close($con);
				}
		}
	return $sqldata;
}
//
// sql_parse.php from phpbb
//
// remove_comments will strip the sql comment lines out of an uploaded sql file
// specifically for mssql and postgres type files in the install....
//
function remove_comments(&$output)
{
   $lines = explode("\n", $output);
   $output = "";
   // try to keep mem. use down
   $linecount = count($lines);
   $in_comment = false;
   for($i = 0; $i < $linecount; $i++)
   {
      if( preg_match("/^\/\*/", preg_quote($lines[$i])) )
      {
         $in_comment = true;
      }
      if( !$in_comment )
      {
         $output .= $lines[$i] . "\n";
      }
      if( preg_match("/\*\/$/", preg_quote($lines[$i])) )
      {
         $in_comment = false;
      }
   }
   unset($lines);
   return $output;
}
//
// remove_remarks will strip the sql comment lines out of an uploaded sql file
//
function remove_remarks($sql)
{
   $lines = explode("\n", $sql);
   // try to keep mem. use down
   $sql = "";
   $linecount = count($lines);
   $output = "";
   for ($i = 0; $i < $linecount; $i++)
   {
      if (($i != ($linecount - 1)) || (strlen($lines[$i]) > 0))
      {
         if (isset($lines[$i][0]) && $lines[$i][0] != "#")
         {
            $output .= $lines[$i] . "\n";
         }
         else
         {
            $output .= "\n";
         }
         // Trading a bit of speed for lower mem. use here.
         $lines[$i] = "";
      }
   }
   return $output;
}
//
// split_sql_file will split an uploaded sql file into single sql statements.
// Note: expects trim() to have already been run on $sql.
//
function split_sql_file($sql, $delimiter)
{
   // Split up our string into "possible" SQL statements.
   $tokens = explode($delimiter, $sql);
   // try to save mem.
   $sql = "";
   $output = array();
   // we don't actually care about the matches preg gives us.
   $matches = array();
   // this is faster than calling count($oktens) every time thru the loop.
   $token_count = count($tokens);
   for ($i = 0; $i < $token_count; $i++)
   {
      // Don't wanna add an empty string as the last thing in the array.
      if (($i != ($token_count - 1)) || (strlen($tokens[$i] > 0)))
      {
         // This is the total number of single quotes in the token.
         $total_quotes = preg_match_all("/'/", $tokens[$i], $matches);
         // Counts single quotes that are preceded by an odd number of backslashes,
         // which means they're escaped quotes.
         $escaped_quotes = preg_match_all("/(?<!\\\\)(\\\\\\\\)*\\\\'/", $tokens[$i], $matches);
         $unescaped_quotes = $total_quotes - $escaped_quotes;
         // If the number of unescaped quotes is even, then the delimiter did NOT occur inside a string literal.
         if (($unescaped_quotes % 2) == 0)
         {
            // It's a complete sql statement.
            $output[] = $tokens[$i];
            // save memory.
            $tokens[$i] = "";
         }
         else
         {
            // incomplete sql statement. keep adding tokens until we have a complete one.
            // $temp will hold what we have so far.
            $temp = $tokens[$i] . $delimiter;
            // save memory..
            $tokens[$i] = "";
            // Do we have a complete statement yet?
            $complete_stmt = false;
            for ($j = $i + 1; (!$complete_stmt && ($j < $token_count)); $j++)
            {
               // This is the total number of single quotes in the token.
               $total_quotes = preg_match_all("/'/", $tokens[$j], $matches);
               // Counts single quotes that are preceded by an odd number of backslashes,
               // which means they're escaped quotes.
               $escaped_quotes = preg_match_all("/(?<!\\\\)(\\\\\\\\)*\\\\'/", $tokens[$j], $matches);
               $unescaped_quotes = $total_quotes - $escaped_quotes;
               if (($unescaped_quotes % 2) == 1)
               {
                  // odd number of unescaped quotes. In combination with the previous incomplete
                  // statement(s), we now have a complete statement. (2 odds always make an even)
                  $output[] = $temp . $tokens[$j];
                  // save memory.
                  $tokens[$j] = "";
                  $temp = "";
                  // exit the loop.
                  $complete_stmt = true;
                  // make sure the outer loop continues at the right point.
                  $i = $j;
               }
               else
               {
                  // even number of unescaped quotes. We still don't have a complete statement.
                  // (1 odd and 1 even always make an odd)
                  $temp .= $tokens[$j] . $delimiter;
                  // save memory.
                  $tokens[$j] = "";
               }
            } // for..
         } // else
      }
   }
   return $output;
}
?>
