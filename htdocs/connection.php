<?php 

//might be some problems

class DatabaseOperation{
	public $mySQLdatabase;
	
	//public $outputResult;
	private $servername = 'localhost';
	private $dbusername = 'root';
	private $dbpassword = '123456';
	private $dbDbasename = 'socialactivity';
	
	public function linkDatabase(){
		$this -> mySQLdatabase = mysql_connect($this->servername,$this->dbusername,$this->dbpassword) or die ('Unable to connect.');
		mysql_select_db($this-> dbDbasename,$this -> mySQLdatabase) or die (mysql_error($this -> mySQLdatabase));
	}
	
	public function freeResult($_result){
		mysql_free_result($_result);
	}

	public function closeDatabase(){
		mysql_close($this -> mySQLdatabase);
	}
	
	
	
	
	public function UserRegiser($_username,$_password,$_email,$_gender,$_birthdate){
		$selectString = "";
		$queryString = "";
		$genderBool = "";
		$markByte = 0;
		if($_gender == "male"){
			$genderBool = "TRUE";
		}
		else{
			$genderBool = "FALSE";
		}
		
		$selectString = "SELECT * FROM USERS WHERE EMAILADDR = '$_email'";			
		if($_birthdate == ""||$_birthdate == NULL){
			$queryString = "INSERT INTO USERS (USERNAME, USERPASSWORD, EMAILADDR, GENDER) 
						VALUES ('$_username', '$_password', '$_email', $genderBool)";
		}
		else{
			$queryString = "INSERT INTO USERS (USERNAME, USERPASSWORD, EMAILADDR, GENDER,BIRTHDATE) 
						VALUES ('$_username', '$_password', '$_email', $genderBool,'$_birthdate')";
		}
		
				
		//echo $selectString;
		echo $queryString;		
		$this->linkDatabase();
		
		$finduserid = mysql_query($selectString,$this -> mySQLdatabase) or die (mysql_error($this -> mySQLdatabase));
		
		if(mysql_fetch_array($finduserid)){
			//echo "User existing! Please use another email address.";
			$markByte = 0;
		}
		else{
			if(mysql_query($queryString,$this -> mySQLdatabase)){
				//echo "Insert Succeed!";
				$markByte = 1;
			}
			else{
				//echo "Insert Failed!";
				$markByte = -1;
			}
		}
		
		$this->closeDatabase();
		return $markByte;

	}
}


?>