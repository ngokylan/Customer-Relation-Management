<? ob_start(); ?>
<?php
/*
	Team:			blueSky
    Programmer:		Tommy Wijaya edited by Liam Handasyde
    Purpose:		Login Screen
    Client:			Milestone Search
    Version:		16.0 24.10.2010
    File:			index.php
*/

$info=""; $userNote=""; $passNote=""; $user="";


//test access to this file is from form
if(!isset($_POST['submit']))
{
	echo "<script language='javascript'>window.location = '../../index.php';</script>";
	die;
}
//test if username and password fields are not empty
if(isset($_POST['submit']))
{
	//capture vars
	$username = ""; $pass = ""; $attempts = 0; 
	//error vars
	$errorUser = 1; $errorPass = 1;
											//username test not empty
	if($_POST['txtUserName'] == NULL)
	{
		$errorUser = 1;
	}
	else
		{
			$username = trim($_POST['txtUserName']);
			$errorUser = 0;
		}									//password test not empty
	if($_POST['txtPassword'] == NULL)
	{
		$errorPass = 1;
	}
	else
		{
			$pass = trim($_POST['txtPassword']);
			$errorPass = 0; 
		}

	//test
	if(($errorUser == 0)&&($errorPass == 0))
	{
		//call for db connection
		require_once('db_connect.php');
		
		//create query string
		$sql = "SELECT * FROM agent WHERE ag_fName='$username'";
		
		//submit query
		$query = mysql_query($sql, $db_con)
				or die("Query failure!:  ". mysql_error());
				
		//assign to var for comparison
		while($row = mysql_fetch_array($query))
		{
			$compareUsername = $row["ag_fName"];
			$comparePassword = $row["ag_password"];
		}
		
		while($attempts > 0)
		{
			//compare username against user input
			if($username !== $compareUsername)
			{
				$attempts ++;
				$query="UPDATE  crmdatabase`.`agent` SET  `ag_logAttempts` =  '0' WHERE  `agent`.`agent_ID` =$agentID"; // Update the log Temp In
				//mysql_query("UPDATE athlete SET name = '$txtName', surname = '$txtSurname', age ='$txtAge', gender = '$txtGender', dob = '$txtDOB', eventType = '$chbEventType WHERE athlete_ID = '$txtID'", $db_connect);
			}
			else
				{
					$attempts = 0;
						
					if($pass !== $comparePassword)
					{
						$attempts ++;
					}
					else
						{
							$attempts = 0;
						}
				} 
		}
				
		
	}
}
	$user = trim($_POST['txtUsername']);
	$pass = trim($_POST['txtPassword']);
	
	$userNote=" ";
	$passNote=" ";
	$tempLogin=0;
	$tempMax = 3;
	$errorCode =0;
	
	if($user == ""){
		$userNote = "Please Fill Username"; // Give Error If The User Field Empty
	}
	
	if($pass ==""){
		$passNote = "Please Fill Password"; // Give Error if The Password Field Empty
	}
	
	if(($user != "")&&($pass !="")){
		//Select Data Using the User Name
		$queryStatement="SELECT * FROM  `agent` WHERE  `ag_fName` LIKE  '$user'";
		require_once("db_conection/db_connect.php");
		$dbRecord=mysql_query($queryStatement,$db_con) or die ("Problem Reading Table: ".mysql_error());
		if($dbRecord){
 
		 //Gives error if user dosen't exist
		 	$check2 = mysql_num_rows($dbRecord);
		 	if ($check2 == 0) {
				 $userNote = "Username Not Found";
			}
			
			
			while($recs = mysql_fetch_array($dbRecord))
			{
				if ($user == $recs["ag_fName"]){
					$tempLogin = $recs["ag_logAttempts"];
					$agentID = $recs["agent_ID"]; //Get the Agent ID
					$password = $recs["ag_password"];
					
					if($tempLogin >= $tempMax){
						$userNote = "Username Locked, Please Contact Administrator"; //Gives error if the Agent User Name Locked
					}elseif($pass == $password){
								$codeString = $recs["agent_ID"].$user; //Set The String That Will Encode to The Main Page
								$eUser = base64_encode($codeString); 
								$query="UPDATE  `crmdatabase`.`agent` SET  `ag_logAttempts` =  '0' WHERE  `agent`.`agent_ID` =$agentID"; // Update the log Temp In Database
								mysql_query($query) or die('<br /> Query failed :'.mysql_error());
								echo "<script language='javascript'>window.location = 'index1.php?o=$eUser';</script>";
								exit;
						}else{
								$tempLogin +=1; // add Temp Login error + 1
								$query="UPDATE  `crmdatabase`.`agent` SET  `ag_logAttempts` =  '$tempLogin' WHERE  `agent`.`agent_ID` =$agentID"; // Update the log Temp In Database
								mysql_query($query) or die('<br /> Query failed :'.mysql_error());
								$changes = 3 - $tempLogin;
								$passNote="Password is not Match <br /> You Only Can Try : ".$changes." times"; //Give the Number of change the User can try
							}
				}
			}			
		}
		else
		{
			$userNote = "Error Login";
		}
	}

?>
<? ob_flush(); ?>