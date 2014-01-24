<?php
//Includes all the global variables and class files
include_once('globals.php');
foreach(glob($CLASSPATH."/*.php") as $classFile)
{
	include_once($classFile);
}

//Initialise all the class objects
$DB = new DBHelper();
$SQL = new SQLHelper();
$ERROR = new ErrorHelper();
$IO = new IOHelper();
$USER = new UserHelper();
?>
