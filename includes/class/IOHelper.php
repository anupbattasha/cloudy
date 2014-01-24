<?php
public class IOHelper{
	include_once('../../bootstart.php');
		
	/*Commented By : Anup Vaze.
          Description: Function to scan the health and size of the log.
          Parameters : string log.
          Function Calls : locateLog, logFlush.
          Return Value : log file name.
        */
	public function scanLogHealth($log){
		$logFile = $this->locateLog($log);
		if($sizeOfFile = filesize($logFile) < '107374182'){
			return $logFile;
		}
		else{
			$this->logFlush($logFile, $log);
		}
		
		
	}
	
	/*Commented By : Anup Vaze.
          Description: Function to locate the log file
          Parameters : string log .
          Function Calls : none.
          Return Value : log file name and path.
        */
	private function locateLog($log){
		GLOBAL $LOG_PATH;
		switch($log) {
			case "EX" : return $LOG_PATH.'/exception.log';
			case "AC" : return $LOG_PATH.'/access.log';
			case "AP" : return $LOG_PATH.'/application.log';
		}		
	}

	/*Commented By : Anup Vaze.
          Description: Function to zip the log file.
          Parameters : string logfile name.
          Function Calls : none.
          Return Value : none.
        */
	private function logFlush($logFile){
		GLOBAL $BACKUP_PATH;
		GLOBAL $DATE;
		$zip = new ZipArcHive;
		$zipFileHandler = $zip->open($BACKUP_PATH."/logs.zip", ZipArchive::OVERWRITE);
		$zip->addFile($logFile,$logFile."_".$DATE.".log");
		$zip->close();
	}
	
	
	
}

?>
