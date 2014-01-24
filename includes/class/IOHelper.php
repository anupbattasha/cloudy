<?php
public class IOHelper{
	include_once('../../bootstart.php');
	
	public function scanLogHealth($log){
		$logFile = $this->locateLog($log);
		if($sizeOfFile = filesize($logFile) < '107374182'){
			return $logFile;
		}
		else{
			$this->logFlush($logFile, $log);
		}
		
		
	}

	private function locateLog($log){
		GLOBAL $LOG_PATH;
		switch($log) {
			case "EX" : return $LOG_PATH.'/exception.log';
			case "AC" : return $LOG_PATH.'/access.log';
			case "AP" : return $LOG_PATH.'/application.log';
		}		
	}

	private function logFlush($logFile, $log){
		GLOBAL $BACKUP_PATH;
		try{
			$zip = new ZipArcHive;
			$zipFileHandler = $zip->open($BACKUP_PATH."/logs.zip", ZipArchive::OVERWRITE);
			throw new Exception("Unable to Open Zip File. Unintended Exception caused.", 001);
		}
		catch(Exception $e){
			$ERROR->pushError($e->getMessage, 25, $e->getCode," ");			
		}		
	}
	
	
	
}

?>
