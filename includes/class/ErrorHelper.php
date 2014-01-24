<?php
//Class to hold all Error handeling functions
public class ErrorHelper extends SQLHelper{
	//Include all necessory files
	include_once('../../bootstart.php');
	

	/*Commented By : Anup Vaze.
          Description: Function to insert error into the temp table.
          Parameters : string message, int level, string description, int code, string link.
          Function Calls : none.
          Return Value : none.
        */
	public function pushError($message, $level, $description, $code, $link){
		$SQL = parent::generatQuery('pusherror', 0);
		$stmt = $dbh->prepare($SQL, array(PDO::ATTR_ORACLE_NULLS => PDO::NULL_EMPTY_STRING, PDO::ATTR_EMULATE_PREPARES => TRUE));
		$stmt->bindParam(1,strtoupper($message));
		$stmt->bindParam(2,$level);
		$stmt->bindParam(3,ucfirst($description));
		$stmt->bindParam(4,$code);
		$stmt->bindParam(5, $link);
		$stmt->execute();
	}	
 	
	/*Commented By : Anup Vaze.
          Description: Function to fetch all active errors. This functions will be called on the pages rendering output to the screen. 
          Parameters : array level.
          Function Calls :none.
          Return Value : list of errors in an array format.
        */

	public function fetchError($level=array()){
		$paramCount = count($level);
		$SQL = parent::generateQuery('pullerror', $paramCount);
		$stmt = $dbh->prepare($SQL, array(PDO::ATTR_EMULATE_PREPARES=>TRUE, PDO::MYSQL_ATTR_USE_BUFFERED_QUERY=>TRUE, PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC));
		$paramExplode = explode(','$level);
		for($i = 0; $i <= $paramCount; $i++){
			$param = $i + 1;
			$stmt->bindParam($param,$paramExplode[$i]);
		}
		$stmt->execute();
		$errorList = $stmt->fetchAll();
		return $errorList;
	}

	/*Commented By : Anup Vaze.
          Description: Function to write messages to log files. Which log file to write depends on the first parameter '$log'. 
          Parameters : String $log, String $e_message, int $e_code, int $access_type.
	         Parameter Explanation:
			$log : This parameter decides which log file to write to. Pass 'EX' to write to exception log, 'AC' to write to access log, & 'AP' to pass to application log. 
			$e_message : This parameter holds the actuall message which should be written to the log file. 
			$e_code :  This parameter holds the exception code. This parameter is necessory only while writting to exception log. Pass the value as 0 if writting to any other logs.
			$access_type :  This parameter holds the access type which gains the fraudlent access.  True only in case of access log. Pass 'FTP' in case of ftp, 'XSS' in case of XSS, 'UX' in case of undefined., 'SSH' in case of ssh, 'LOG' in case of unattempeted or fraudlent login, & 'CURL' in case of curl.
          Function Calls :none.
          Return Value : none
        */

	public function writeToLog($log, $e_message = "", $e_code = 0, $access_type = 0){
		$IO->scanLogHealth($log);	
		
	}
	
}

?>
