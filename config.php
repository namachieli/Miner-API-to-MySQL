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
  ***********************************************/
 
 /**********************
 * Miner Setup
 ***********************/
 
 // Uncomment (remove the //) each section for the number of miners you have, 
 // or add additional miners by addingmore sections, and just increment the number in the [] each time.

 //Miner1
 $miner[0]['hostname'] = 'Miner1';
 $miner[0]['ip'] = '172.20.20.11';
 $miner[0]['port'] = '4028';

 //Miner2
 $miner[1]['hostname'] = 'Miner2';
 $miner[1]['ip'] = '172.20.20.12';
 $miner[1]['port'] = '4028';

 //Miner3
 $miner[2]['hostname'] = 'Miner3';
 $miner[2]['ip'] = '172.20.20.13';
 $miner[2]['port'] = '4028';

 //Miner4
 $miner[3]['hostname'] = 'Miner4';
 $miner[3]['ip'] = '172.20.20.14';
 $miner[3]['port'] = '4028';

 //Miner5
 $miner[4]['hostname'] = 'Miner5';
 $miner[4]['ip'] = '172.20.20.15';
 $miner[4]['port'] = '4028';
 
 
 /************************
 * Database Information 
 *************************/

 // Fill out the various values for the MySQL server you will be pushing data to
 // You must create the data base manually, and make sure the user supplied has 
 // full permissions for that db. Tables will be generated during first run.
 
 $myserver = 'localhost';
 $myuser = 'root';
 $mypass = 'Plokiju3304';
 $mydb = 'mining_data_test';
 // number of rows to keep before trimming old data. Use this to keep databases from growing to large.
 // not currently implemented,uncommenting has no effect
 // $mytablerows = '5000';
  
 /************************
 * Other Settings
 ************************/
 
 // If you are running via an open webpage and must rely on it to auto refresh, set the refresh interval in seconds here. 
 // Default = 3600 (1 hour)
 $refreshinterval = '3600';
 
 // Controls what data to be captured
 // Comment out each variable if you wish to not capture the data (add // at the begining of the line), or set the variable to 0.
 $apicmd['pools'] = 1; //Get summary info for all miners
 $apicmd['summary'] = 1; //Get mining pool info for each pool on all miners
 $apicmd['devs']  = 1; //Get dev performance info for each dev (gpu, usb, etc) on all miners

 /*************************************************************************************************/
?>
