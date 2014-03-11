Miner-API-to-MySQL
==================

Built using MySQL 5.1.49 or later and PHP 5.3.21 or later, CGMiner 3.7.2 and cgminer-kalrith 3.7.3.

This program will reach out to all miners using CGMiner API 1.32 and pull details about the miner.

Currently supported:

Summary - Over all stats of the miner
Pools - Detailed information about each pool configured on the miner
Devs - Detailed information about each individual device (GPU, ASIC, etc)

Future commands to be added:

notify
stats
usbstats
coin
config
version
devdetails

___________________________________

To Intall just put this on your webserver, open config.php and set values. Create a MySQL Database with the name you specify in config.php. All tables will be built the first time they are required, from xxx.sql. Make sure the user/pass you use has database admin rights. All files assume they exist within the same directory.

This can either be ran in a few different ways: 
In open web browser, with refresh interval set, and it will auto reload using http refresh.
Called using a task scheduler (you may wish to comment out$refreshinterval in config.php
Called using a cron job on a schedule / event


*** WARNING ***

There has been no attmept made to secure this app, or any of the functions from attacks such as injection, buffer overflows, etc. It is reccomended NOT to run this app on a publicly accessible webserver. If you choose to do so, I take no responsibility if any personal or financial loss/damage occurs. You have been warned.

*** WARNING ***
