<?php
//Include all tha Global Variables
include_once('globals.php');
//Includes all inilialised class objects
include_once('loadboot.php');

//Connect to the Database. Yoou can connect to only one database at a time, either live or development database. Comment out the functioncall which is unwanted, or otherwise.
$DB->connectLive();
//$DB->connectDevelopment();



?>
