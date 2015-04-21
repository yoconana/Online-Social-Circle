<?php 

class TestYang(){
	public $var1;
	
}

//class DatabaseOperation(){
	//private $mySQLdatabase;
	//public $testString;

/*	public function linkDatabase(){
	$db = mysql_connect('localhost','root','123456') or die ('Unable to connect.');
		mysql_select_db('socialactivity',$db) or die (mysql_error($db));
	}

	public function freeResult($_result){
		mysql_free_result($_result);
	}

	public function closeDatabase(){
		mysql_close($db);
	}

	public function UserRegiser($_username,$_password,$_email,$_gender){
		$queryString = "";
		$genderBool = ;
		if($_gender == "male"){
			$genderBool = "TRUE";
		}
		else{
			$genderBool = "FALSE";
		}
		$queryString = queryString."INSERT INTO USERS(USERNAME, USERPASSWORD, EMAILADDR, GENDER) VALUES ('"
									.$_username."','"
									._password."','"
									._email."',".$genderBool.")";
									
		$queryString = "INSERT INTO USERS (USERNAME, USERPASSWORD, EMAILADDR, GENDER) VALUES ('$_username', '$_password', '$_email', $genderBool)";
									
		echo $genderBool;	
								
	}*/
//}

?>