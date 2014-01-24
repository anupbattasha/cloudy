<?php
mysql_query('localhost','anup','tripleseven7');
mysql_select_db('wealthjunction');
$array = array();
array_push($array,"H2");
array_push($array,"H3");


echo $sql = "Select * from vtiger_user2role WHERE roleid IN($array)" ;
$res = mysql_query($sql);
print_r($res);


?>
