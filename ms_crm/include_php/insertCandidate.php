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
$dteInitailContact = addslashes($_GET['initialContact']);	//use as timestamp to save into "wfa_assignment" table
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



require("../db_conection/db_connect.php");
//insert into Contacts Details

//Search for existing Contact Details
$contactID=NULL;
while  ($contactID == NULL){
	$sql = "SELECT `contact_ID` FROM `contact_details` WHERE `cont_streetNo` LIKE '".$strStNumber."' AND `cont_street` LIKE '".$strStName."' AND `cont_city` LIKE '".$strCity."' limit 1";
	
	echo '<script language="javascript">alert("'.$sql.'")</script>';
	
	$dbRecords = mysql_query($sql, $db_con) or die('<br /> Query failed'.mysql_error());
	while($result = mysql_fetch_array($dbRecords)) 
	{
		$contactID = $result[0];
	}
		if ($contactID == NULL){
			//echo "The Contact ID is not Exist and Insert Them Into Database";
			//Inserting Contact Details into Database
			$sql="INSERT INTO `crmdatabase`.`contact_details` 
			(`contact_ID`, `cont_streetNo`, `cont_street`,  `cont_city`, `cont_zip`,`cont_state`, `cont_country`,  `cont_mobile`, `cont_homePhone`, `cont_companyName`,  `cont_workPhone`, `cont_workFax`, `cont_otherCompany`)
			VALUES 
			(NULL, '$strStNumber', '$strStName',  '$strCity', '$strZip','$strState', '$strCountry',  '$strMobile', '$strPhone', '$strCurrentComp',  '$strWorkPhone', '$strWorkFax', NULL)";
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
$sql="INSERT INTO `crmdatabase`.`candidate` 
(`candidate_ID`, `can_fName`, `can_lName`, `email`,  `can_nextCont`, `can_yearIniCont`, `can_scoring`,  `can_relStatus`,  `can_rate`, `can_typeRate`,  `can_sellRate`, `can_typeSellRate`,  `can_buyRate`, `can_typeBuyRate`, `can_currEng`, `can_note`, `status_id`, `contact_id`) 
VALUES 
('$candidateID', '$strFirstName', '$strSurname',NULL, '$dteNextAvailable', '$dteInitailContact', '$strScoring', '$strRelStatus', '$strRate', '$strTypeRate',  '$strSellRate', '$strTypeSellRate',  '$strBuyRate', '$strTypeBuyRate',  '$strCurrentEng', '$strNote',  '$strStatusID', '$contactID')"; 
mysql_query($sql)or die('<br /> Query failed'.mysql_error());

echo $sql; 
//Find Candidate ID
//insert into multi_email
$sql="INSERT INTO `crmdatabase`.`multi_email` 
(`email_ID`, `candidate_id`, `em_timestamp`, `primary_email`) 
VALUES ('$strEmail', '$candidateID', CURRENT_TIMESTAMP, '1')";
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
	$sql = "SELECT * FROM `skill_set` WHERE  `skill_shortDescr` LIKE  '$skillShortDesc' LIMIT 1";
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

//----------------------------Minh--------------------------------
//.script for inserting new record into "wfa_assignment" table

   
$sql = "INSERT INTO `crmdatabase`.`wfa_assignment` 
(`candidate_ID`, `wfa_ID`, `timestamp`, `status_complete`, `next_contact_date`, `agent_ID`)
        VALUES 
('$candidateID' ,  '$strAssignWFA',  '$dteInitailContact', 'Active', NULL, NULL)";
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
		$candidate_id = $candidateID;
		
		$emailDay = date('Y-m-d', strtotime($dteInitailContact. " + $Day days"));
		
		if ($templateArray.count != NULL)
		{
			$sql="INSERT INTO wfa_template_for_candidate 
			(wfa_temp_can_id, wfa_template_ID, wfa_id, candidate_ID,date_sent, comment, enduration, sent_status) 
			VALUES 
			(NULL, '$template', '$wfaid', '$candidate_id', NULL , NULL, '$emailDay', '0')";
			mysql_query($sql)or die('<br /> Insert Skill Set failed : '.mysql_error());
		}else{
			
		}
	}

//	-> script for inserting new record into "wfa_template_for_candidate" table

	/*if ($templateArray.count != NULL)
	{
		$sql="INSERT INTO `crmdatabase`.`skill_set` (`skill_ID`, `skill_shortDescr`, `skill_longDescr`) VALUES (NULL, '$skillShortDesc', '$skillLongDesc')";
		mysql_query($sql)or die('<br /> Insert Skill Set failed : '.mysql_error());
	}else{
		
	}
*/
//	-> take the timestamp for the candidate to convert the "email_day" in the "Wfa_has_template" table into the real date and insert into "wfa_template_for_candidate" table


mysql_close($db_con); //Close The Connection
?>
