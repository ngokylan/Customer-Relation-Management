<!--
	Team:			ISYNC
    Programmer:		MINH
    Purpose:		CRM to manage mileston Search Candidates
    Client:			Milestone Search
    Version:		3.4.4 30-05-2011
    File:			readCandidateDetails.php

-->
<?php

echo $strWfaId;
echo $strWfaCandId;
echo $strWfaDescr;
echo $strWfaStatus;
echo $strWfaAssignTemp;
echo $strWfaExpDt;
echo $strWfaNote;
echo $strWfaEmSubject;
echo $strWfaEmContent;

require("../db_conection/db_connect.php");

//Retrive the timing associate with the templete wfa & calculate duraction
$sql = "SELECT * 
		FROM  `wfa_template` 
		WHERE `wfa_TempID` = '$strWfaAssignTemp' LIMIT 1";

$dbRecords = mysql_query($sql, $db_con) or die('<br /> Search For Timing failed : '.mysql_error());
while($result = mysql_fetch_array($dbRecords)) {
	$intTiming = $result["wfa_Temp_Timing"];
}

//Calculare WFA duraction: 
$dtDuractionWFA = mktime(0, 0, 0, date("m"), date("d")+ $intTiming, date("y"));
$strWfaExpDt = date("Y-m-d", $dtDuractionWFA);

//Insert into Candidate Details only the Agent to-do list will update the field `wfa_dtContacted`
$sql="UPDATE `crmdatabase`.`wfa` 
		 SET `wfa_id` = '$strWfaId', 
			 `wfa_TempID` = '$strWfaAssignTemp', 
			 `wfa_status` = '$strWfaStatus',
			 `wfa_comment` = '$strWfaNote', 
			 `wfa_dtEndDuraction` = '$strWfaExpDt'
	   WHERE `wfa`.`candidate_ID` = '$strWfaCandId'
		 AND `wfa`.`wfa_status` = 'Active'";						 		 										 
mysql_query($sql)or die('<br /> Update WFA has failed :( '.mysql_error());

//Close The Connection
mysql_close($db_con); 
?>
