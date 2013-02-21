<!--
    Team:			blueSky
    Programmer:		Liam Handasyde | Tommy Wijaya | Sonia Schiavon
    Purpose:		CRM to manage mileston Search Candidates
    Client:			Milestone Search
    Version:		12.0 11.10.2010
    File:			insertCandidate.php
-->
<?php
//Insert Database
//Coding by Mr.TomTom :P
$strStNumber 	= addslashes($_GET['streeNum']);
$strStName 		= addslashes($_GET['streetName']);
$strCity 		= addslashes($_GET['city']);
$strState 		= addslashes($_GET['state']);
$strZip 		= addslashes($_GET['postCode']);

$strCountry 	= addslashes($_GET['country']);
$strMobile 		= addslashes($_GET['mobile']);
$strPhone 		= addslashes($_GET['homePhone']);
$strCurrentComp = addslashes($_GET['company']);

$strWorkPhone 	= addslashes($_GET['workPhone']);
$strWorkFax 	= addslashes($_GET['workFax']);

$strFirstName 	= addslashes($_GET['fName']);
$strSurname 	= addslashes($_GET['lName']);



require("../db_conection/db_connect.php");
//insert into Contacts Details

//Search for existing Contact Details
$contactID=NULL;
while  ($contactID == NULL){
	$sql = "SELECT `contact_ID` FROM `contact_details` WHERE `cont_streetNo` LIKE $strStNumber AND `cont_street` LIKE '$strStName' AND `cont_city` LIKE '$strCity' limit 1";
	$dbRecords = mysql_query($sql, $db_con) or die('<br /> Query failed'.mysql_error());
	while($result = mysql_fetch_array($dbRecords)) 
	{
		$contactID = $result[0];
	}
		if ($contactID == NULL){
			//echo "The Contact ID is not Exist and Insert Them Into Database";
			//Inserting Contact Details into Database
			$sql="INSERT INTO `crmdatabase`.`contact_details` (`contact_ID`, `cont_streetNo`, `cont_street`,  `cont_city`, `cont_zip`,`cont_state`, `cont_country`,  `cont_mobile`, `cont_homePhone`, `cont_companyName`,  `cont_workPhone`, `cont_workFax`) VALUES (NULL, $strStNumber, '$strStName',  '$strCity', $strZip,'$strState', '$strCountry',  '$strMobile', '$strPhone', '$strCurrentComp',  '$strWorkPhone', '$strWorkFax')";
		mysql_query($sql) or die('<br /> Query failed :'.mysql_error());
		}else{
			//echo $contactID;
		}
}

// Find the Last Number of Candidate ID & Set The Time Stamp and Candidate ID
$candidateID = "";
$sql = "SELECT * FROM `candidate` ORDER BY `contact_ID` DESC LIMIT 0 , 1";
$dbRecords = mysql_query($sql, $db_con) or die('<br /> Query failed'.mysql_error());
while($result = mysql_fetch_array($dbRecords)) 
{
	$candidateID = $result[0];
}
echo $candidateID;
if($candidateID == NULL){
	$candidateID = 0;
}
$intCandidateID = substr($candidateID, -6);
$candidateID =  $intCandidateID+1; 
$length = strlen($candidateID); 
$i = $length - 6;
$frontZero ="";
while ($i < 0){
	$frontZero .='0'; 
	$i += 1;
}
$candidateID = date("Ymd").date("His").$frontZero.$candidateID; 
echo "<br />".$candidateID;
//insert into Candidate Details
$sql="INSERT INTO `crmdatabase`.`candidate` (`candidate_ID`, `can_fName`, `can_lName`,  `can_nextCont`, `can_yearIniCont`, `can_scoring`,  `can_relStatus`,  `can_rate`, `can_typeRate`,  `can_sellRate`, `can_typeSellRate`,  `can_buyRate`, `can_typeBuyRate`, `can_currEng`, `can_note`, `status_id`, `contact_id`) VALUES ('$candidateID', '$strFirstName', '$strSurname', '$dteNextAvailable', '$dteInitailContact', '$strScoring', '$strRelStatus',  $strRate, '$strTypeRate',  '$strSellRate', '$strTypeSellRate',  $strBuyRate, '$strTypeBuyRate',  '$strCurrentEng', '$strNote',  '$strStatusID', $contactID)"; 
mysql_query($sql)or die('<br /> Query failed'.mysql_error());

//Find Candidate ID
//insert into multi_email
$sql="INSERT INTO `crmdatabase`.`multi_email` 
(`email_ID`, `candidate_id`, `em_timestamp`) 
VALUES ('$strEmail', '$candidateID', CURRENT_TIMESTAMP)";
mysql_query($sql)or die('<br /> Insert Email failed : '.mysql_error());

//insert into skill_set
$jobID=NULL;
while  ($jobID == NULL){
	$sql = "SELECT `job_ID` FROM  `job_title` WHERE  `job_shortDescr` LIKE  '$jobTitle' AND  `job_longDescr` LIKE  '$jobDescription' LIMIT 1";
	$dbRecords = mysql_query($sql, $db_con) or die('<br /> Search For Job Title failed : '.mysql_error());
	while($result = mysql_fetch_array($dbRecords)) 
	{
		$jobID = $result[0];
	}
		if ($jobID == NULL){
			$sql="INSERT INTO `crmdatabase`.`job_title` (`job_ID`, `job_shortDescr`, `job_longDescr`) 
			VALUES 	(NULL, '$jobTitle', '$jobDescription')";
			mysql_query($sql)or die('<br /> Insert Skill Set failed : '.mysql_error());
		}
		else{
			
		}
}
$sql="INSERT INTO  `crmdatabase`.`job_title_has_candidate` (`job_candidate_id` ,`job_id` ,`candidate_id`) VALUES (NULL ,  '$jobID',  '$candidateID')";
mysql_query($sql)or die('<br /> Insert Job Title failed : '.mysql_error());



//insert into Skill_set_has_candicate
$skillID=NULL;
while  ($skillID == NULL){
	$sql = "SELECT * FROM `skill_set` WHERE  `skill_shortDescr` LIKE  '$skillShortDesc' AND  `skill_longDescr` LIKE  '$skillLongDesc' LIMIT 1";
	$dbRecords = mysql_query($sql, $db_con) or die('<br /> Search For Skill Set failed : '.mysql_error());
	while($result = mysql_fetch_array($dbRecords)) 
	{
		$skillID = $result[0];
	}
		if ($skillID == NULL){
			$sql="INSERT INTO `crmdatabase`.`skill_set` (`skill_ID`, `skill_shortDescr`, `skill_longDescr`) VALUES (NULL, '$skillShortDesc', '$skillLongDesc')";
			mysql_query($sql)or die('<br /> Insert Skill Set failed : '.mysql_error());
		}else{
		}
}


$sql = "INSERT INTO  `crmdatabase`.`skill_set_has_candidate` (`skill_candidate_id` ,`skill_id` ,`candidate_id`)VALUES (NULL ,  '$skillID',  '$candidateID')";
mysql_query($sql)or die('<br /> Insert Job Title failed : '.mysql_error());


//insert into agent_has_candidate
$sql = "INSERT INTO  `crmdatabase`.`agent_has_candidate` (`agent_candidate_id` ,`agent_id` ,`candidate_id`)VALUES (NULL ,  '$agentID',  '$candidateID')";
mysql_query($sql)or die('<br /> Insert Agent Has Candidate failed : '.mysql_error());
mysql_close($db_con); //Close The Connection
?>
<body>
</body>
</html>