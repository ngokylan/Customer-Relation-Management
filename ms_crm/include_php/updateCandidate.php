<!--
	Team:			ISYNC
    Programmer:		MINH
    Purpose:		CRM to manage mileston Search Candidates
    Client:			Milestone Search
    Version:		3.4.4 07-04-2011
    File:			readCandidateDetails.php

-->
<?php
//Insert Database
$strAssignWFA = addslashes($_GET['wfaid']);
$agentID = addslashes($_GET['agentID']);
$strCandidateID = addslashes($_GET['candidateID']);

$strStNumber = addslashes($_GET['streeNum']);
$strStName = addslashes($_GET['streetName']);
$strCity = addslashes($_GET['city']);
$strState = addslashes($_GET['state']);
$strZip = addslashes($_GET['postCode']);

$strCountry = addslashes($_GET['country']);
$strMobile = addslashes($_GET['mobile']);
$strPhone = addslashes($_GET['homePhone']);
$strCurrentComp = addslashes($_GET['company']);

$strWorkPhone = addslashes($_GET['workPhone']);
$strWorkFax = addslashes($_GET['workFax']);

$strFirstName = addslashes($_GET['fName']);
$strSurname = addslashes($_GET['lName']);
$dteNextAvailable = addslashes($_GET['nextAvailable']);
$dteInitailContact = addslashes($_GET['initialContact']);
$strScoring = addslashes($_GET['scoring']);
$strRelStatus = addslashes($_GET['relationshipStatus']);
$strRate= addslashes($_GET['rate']);
$strTypeRate = addslashes($_GET['typeRate']);
$strSellRate = addslashes($_GET['sellRate']);
$strTypeSellRate= addslashes($_GET['typeSellRate']);
$strBuyRate = addslashes($_GET['buyRate']); 
$strTypeBuyRate = addslashes($_GET['typeBuyRate']);
$strCurrentEng = addslashes($_GET['currentEngageType']);
$strNote = addslashes($_GET['notes']);
$strStatusID = addslashes($_GET['statusID']);

$strEmail = addslashes($_GET['email']);

$jobTitle = addslashes($_GET['jobTitle']);
$jobDescription = addslashes($_GET['jobDescription']);

$skillShortDesc = addslashes($_GET['skillShortDesc']);
$skillLongDesc= addslashes($_GET['skillLongDesc']);

$agentID = addslashes($_GET['agentID']);

require("../db_conection/db_connect.php");

$strContactID=NULL;
$error = 0;
while  ($strContactID == NULL || $error < 2)
{
	$sql = "SELECT `contact_id` FROM `candidate` WHERE `candidate_ID` = '$strCandidateID' ";
	$dbRecords = mysql_query($sql, $db_con) or die('<br /> Query failed'.mysql_error());
	while($result = mysql_fetch_array($dbRecords)) 
	{
		$strContactID = $result[0];
		}
	$error += 1;
}

//echo $strContactID;

//Update Contact_Details
$sql=" UPDATE `crmdatabase`.`contact_details` 
SET `cont_streetNo` = '$strStNumber', 
	`cont_street` = '$strStName', 
	`cont_city` = '$strCity', 
	`cont_zip` = '$strZip', 
	`cont_state` = '$strState', 
	`cont_country` = '$strCountry', 
	`cont_mobile` = '$strMobile', 
	`cont_homePhone` = '$strPhone', 
	`cont_companyName` = '$strCurrentComp', 
	`cont_workPhone` = '$strWorkPhone', 
	`cont_workFax` = '$strWorkFax' 
	WHERE `contact_details`.`contact_ID` = $strContactID";
mysql_query($sql) or die('<br /> Query failed :'.mysql_error());
			
//Update Candidate
$sql="UPDATE `crmdatabase`.`candidate` SET `can_fName` = '$strFirstName', `can_lName` = '$strSurname', `can_nextCont` = '$dteNextAvailable', `can_yearIniCont` = '$dteInitailContact', `can_scoring` = '$strScoring', `can_relStatus` = '$strRelStatus', `can_rate` = '$strRate', `can_typeRate` = '$strTypeRate', `can_sellRate` = '$strSellRate', `can_typeSellRate` = '$strTypeSellRate', `can_buyRate` = '$strBuyRate', `can_typeBuyRate` = '$strTypeBuyRate', `can_currEng` = '$strCurrentEng', `can_note` = '$strNote', `status_id` = '$strStatusID' WHERE `candidate`.`candidate_ID` = '$strCandidateID'";
mysql_query($sql) or die('<br /> Query failed :'.mysql_error());


$strPreEmail = NULL;
while  ($strPreEmail == NULL || $error < 2){
	$sql = "SELECT  `email_ID` FROM  `multi_email` WHERE  `candidate_id` LIKE '$strCandidateID' ";
	$dbRecords = mysql_query($sql, $db_con) or die('<br /> Query failed'.mysql_error());
	while($result = mysql_fetch_array($dbRecords)) 
	{
		$strPreEmail = $result[0];
	}
	$error += 1;
}

$sql="UPDATE  `crmdatabase`.`multi_email` SET  `email_ID` =  '$strEmail' WHERE  `multi_email`.`email_ID` =  '$strPreEmail' AND  `multi_email`.`candidate_id` =  '$strCandidateID'";
mysql_query($sql) or die('<br /> Query failed :'.mysql_error());

//Update Job Title
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
			$sql="UPDATE `crmdatabase`.`job_title_has_candidate` SET `job_id` = '$jobID' WHERE `job_title_has_candidate`.`candidate_id` = '$strCandidateID'";
			//$sql="INSERT INTO  `crmdatabase`.`job_title_has_candidate` (`job_candidate_id` ,`job_id` ,`candidate_id`) VALUES (NULL ,  '$jobID',  '$candidateID')";
			mysql_query($sql)or die('<br /> Insert Job Title failed : '.mysql_error());
		}
}



//Update Skill Set
$skillID=NULL;
while  ($skillID == NULL)
{
	$sql = "SELECT * FROM  `skill_set` WHERE  `skill_shortDescr` LIKE  '$skillShortDesc' AND  `skill_longDescr` LIKE  '$skillLongDesc' LIMIT 1";
	$dbRecords = mysql_query($sql, $db_con) or die('<br /> Search For Skill Set failed : '.mysql_error());
	while($result = mysql_fetch_array($dbRecords)) 
	{
		$skillID = $result[0];
	}
	if ($skillID == NULL){
		$sql="INSERT INTO `crmdatabase`.`skill_set` (`skill_ID`, `skill_shortDescr`, `skill_longDescr`) VALUES (NULL, '$skillShortDesc', '$skillLongDesc')";
		mysql_query($sql)or die('<br /> Insert Skill Set failed : '.mysql_error());
	}else{
		//      UPDATE `crmdatabase`.`skill_set_has_candidate` SET `skill_id` = '9' WHERE `candidate_id` = '20101103161410000007';
		$sql="UPDATE `crmdatabase`.`skill_set_has_candidate` SET `skill_id` = '$skillID' WHERE `candidate_id` = '$strCandidateID'";
		mysql_query($sql)or die('<br /> Insert Job Title failed : '.mysql_error());
	}
		
}

//----------------------------Minh- 17/05/2011-------------------------------
//.script for updating Work Flow Action by inserting new record into "wfa_assignment" table
// and disable the previous record of the old WFA

//search in the "wfa_assignment" for the previous assigned WFA

//update table "wfa_assignment" to change the status_complete into "Inactive"

//insert new wfa_asignment into "wfa_assignment" table

//read all the templates which are belong to the new assigned WFA

//run through the loop and insert into new record into "wfa_template_for_candidate" table
//---------------------------------------------------------------------------------


//update table "wfa_assignment" to change the status_complete into "Inactive"
$sql = "select wa.wfa_ID
        From wfa_assignment wa
		Where wa.candidate_ID = '$strCandidateID'
		AND wa.status_complete = 'Active'";

$dbRecords = mysql_query($sql, $db_con) 
or die('<br /> Search For templates belonging to the assigned wfa : '.mysql_error());
	
//	.run a loop with the number of counting templates from the previous step
	
	while($result = mysql_fetch_array($dbRecords)) 
	{		
		$wfaid = $result['wfa_ID'];
		
		$sql = "UPDATE  `crmdatabase`.`wfa_assignment` SET  `status_complete` =  'Inactive' WHERE  `wfa_assignment`.`candidate_ID` =  '$strCandidateID' AND  `wfa_assignment`.`wfa_ID` ='$wfaid' AND  `wfa_assignment`.`timestamp` = '$dteInitailContact'";
		mysql_query($sql)or die('<br /> update WFA_assignment failed : '.mysql_error()); 
		
	}


$sql = "INSERT INTO `crmdatabase`.`wfa_assignment` 
(`candidate_ID`, `wfa_ID`, `timestamp`, `status_complete`, `next_contact_date`, `agent_ID`)
        VALUES 
('$strCandidateID' ,  '$strAssignWFA',  '$dteInitailContact', 'Active', NULL, NULL)";
mysql_query($sql)or die('<br /> Insert wfa assignemnt for this candidate failed : '.mysql_error());


//		.script for counting and collecting all the "template_id" and "email_day" from the "wfa_has_template" table

$sql = "select w.WFA_ID, wt.wfa_template_ID, wt.email_day
        From wfa w, wfa_has_template wt
		Where w.WFA_ID = wt.wfa_id
		AND wt.wfa_id = '$strAssignWFA'";

$dbRecords = mysql_query($sql, $db_con) 
or die('<br /> Search For templates belonging to the assigned wfa : '.mysql_error());
	
//	.run a loop with the number of counting templates from the previous step
	
	while($result = mysql_fetch_array($dbRecords)) 
	{
		$template = $result['wfa_template_ID'];
		$Day = $result['email_day'];
		$wfaid = $result['WFA_ID'];	
		
		$emailDay = date('Y-m-d', strtotime($dteInitailContact. " + $Day days"));
		
		if ($templateArray.count != NULL)
		{
			$sql="INSERT INTO wfa_template_for_candidate 
			(wfa_temp_can_id, wfa_template_ID, wfa_id, candidate_ID,date_sent, comment, enduration, sent_status) 
			VALUES 
			(NULL, '$template', '$wfaid', '$strCandidateID', NULL , NULL, '$emailDay', '0')";
			mysql_query($sql)or die('<br /> Insert Skill Set failed : '.mysql_error());
		}else{
			
		}
	}
	
	
	
mysql_close($db_con); //Close The Connection

?>


<body>
</body>
</html>