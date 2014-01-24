<?php
//Class which generates the sql queries.
public class SQLHelper(){
	include_once('../../bootstart.php');
	/*Commented By : Anup Vaze.
          Description: Function to generate a specific query.
          Parameters : string action, int paramcount
          Function Calls : none
          Return Value : Generated SQL Query.
        */

	public function generateQuery($action, int $paramCount){
		switch($action){
			case 'pusherror' :
				$SQL = "INSERT INTO ".$USER->sessionTable."(e_message, e_level, e_description, e_code, e_actionlink) VALUES(?, ?, ?, ?, ?)";
				break;			
			
			case 'pullerror' :
				$SQL = "SELECT * FROM ".$USER->sessionTable." WHERE e_level = ?";		
				for($i =0; $i < $paramCount; $i++){
					$SQL .= " AND e_level = ?"; 
				}
				return $SQL;
		}
		return $SQL;
	}
}
?>
