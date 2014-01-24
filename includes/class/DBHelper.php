<?php
//Class to help Database transaction. This class supports forms all the functions to wrap the database activities.
public class DBHelper(){
	//Include all global variables
	include_once('../../bootstart.php');
	
	/*Commented By : Anup Vaze.
	  Description: Function to connect to a live Database.
	  Parameters : none.
	  Function Calls : DBConnect.
	  Return Value : none.
	*/
	public function connectLive(){
		GLOBAL $liveDBHost;
		GLOBAL $liveDBUsername;
		GLOBAL $liveDBPassword;
		GLOBAL $liveDBPort;

		$this->DBConnect($liveDBHost, $liveDBUsername, $liveDBPassword, $liveDBDatabase, $liveDBPort);

	}
       
	/*Commented By : Anup Vaze.
          Description: Function to connect to a development Database.
          Parameters : none.
          Function Calls : DBConnect.
          Return Value : none.
        */

	public function connectDevelopment(){
		GLOBAL $devDBHost;
		GLOBAL $devDBUsername;
		GLOBAL $devDBPassword;
		GLOBAL $devDBPort;
		GLOBAL $devDBDatabase;
		
		$this->DBConnect($devDBHost, $devDBUsername, $devDBPassword, $devDBDatabase, $devDBPort);
	}
	
	/*Commented By : Anup Vaze.
          Description: Function to connect to the Database. This function reposnds to its caller and gets to the respective database.
          Parameters : string host, string username, string, password, string database, int port .
          Function Calls : connectSlave.
          Return Value : connection object
        */

	private function DBConnect($host, $username, $password, $database, $port){
		$slave = FALSE;
		try{
			GLOBAL $dbh = new PDO("mysql:host=$host; dbname=$database;",$username,$password);
			GLOBAL $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			GLOBAL $dbh->setAttribute(PDO::ATTR_TIMEOUT, "1");
			return $dbh;
		}		
		catch(Exception $e){
			if($slave){
				print "Exception : ".$e->getMessage().". Connecting to the Slave Database";
				sleep(5);	
				$dbh = $this->connectSlave();
				return $dbh;
			}
			else {
				print "Exception : ".$e->getMessage().". Please wait for some time OR contact the service providers";
			}
		}
	}
}
?>
