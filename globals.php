<?php

//All global variables used through out the system will go here.

//Development database congiguration goes here
$devDBHost = "localhost";
$devDBUserName = "root";
$devDBPassword = "root";
$devDBPort =3306 ;
$devDBDatabase = "cloudy";

//Live Database configuration goes here
$liveDBHost = "localhost";
$liveDBUsername = "anup";
$liveDBPassword = "tripleseven7";
$liveDBPort = 3306;
$liveDBDatabase = "cloudy";

//Global path where all classes are stored
$dir = realpath(dirname(__FILE__));
$CLASS_PATH = $dir."/includes/class";
$LOG_PATH = $dir."/logs";
$BACKUP_PATH = $dir."/backup";

//Date & time global variables
$date = new DateTime();
$TIMESTAMP  = $date->getTimestamp();
$DATE = date('y-m-d');


?>
