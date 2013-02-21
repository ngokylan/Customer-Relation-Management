<!--
    Team:			blueSky
    Programmer:		Liam Handasyde | Tommy Wijaya | Sonia Schiavon
    Purpose:		CRM to manage mileston Search Candidates
    Client:			Milestone Search
    Version:		16.0 01.11.2010
    File:			insertWFA.php
    					- calculation duraction WFA 
                        - update existing active WFA if it exists
                        - insert new WFA
-->	
<?php
//Insert WFA into Database
//Coding by Sonia Schiavon: sch09297795

$strWfaId = addslashes($_GET['wfaId']);
$strWfaCandId = addslashes($_GET['wfaCandId']);
$strWfaDescr = addslashes($_GET['wfaDescr']);
$strWfaStatus = addslashes($_GET['wfaStatus']);
$strWfaAssignTemp = addslashes($_GET['wfaAssignTemp']);
$strWfaExpDt = addslashes($_GET['wfaExpDt']);
$strWfaNote = addslashes($_GET['wfaNote']);
$strWfaEmSubject = addslashes($_GET['wfaEmSubject']);
$strWfaEmContent = addslashes($_GET['wfaEmContent']);

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

// Calculare WFA duraction: 
$dtDuractionWFA = mktime(0, 0, 0, date("m"), date("d")+ $intTiming, date("y"));
$strWfaExpDt = date("Y-m-d", $dtDuractionWFA); 

echo "Duraction".$strWfaExpDt;

//Check if already exist an active WFA for that candidate, it shouldn't but in case the Agent has just inserited a wfa, and he 
//trys to modify straight away. (button still be "Save" mode it will do another insert without change the status of the prev WFA)
$sql = "SELECT * 
		FROM  `wfa` 
		WHERE `candidate_id` = '$strWfaCandId' 
		AND `wfa_status` = 'Active'";
echo "sql".$sql;

$appCandExist = "";
$dbRecords = mysql_query($sql, $db_con) or die('<br /> Search For active WFA before to run the insert failed : '.mysql_error());
while($result = mysql_fetch_array($dbRecords)) {
	$appWFATimestExist = $result["wfa_timestamp"];
}
echo "exist? " . $appWFATimestExist ." - ". $strWfaCandId;

if (!($appWFATimestExist == "")){
	//update status existing WFA into WFA Details	
	$sql="UPDATE `crmdatabase`.`wfa` 
		  SET   `wfa_status` = 'Inactive' 
		  WHERE `wfa`.`wfa_timestamp` = '$appWFATimestExist' 
		  AND   `wfa`.`candidate_id` = '$strWfaCandId';"; 
		  
	echo "sql update: ".$sql;
	mysql_query($sql)or die('<br /> Update WFA has failed :( '.mysql_error());
} 
echo $strWfaId;
echo $strWfaCandId;
echo $strWfaDescr;
echo $strWfaStatus;
echo $strWfaAssignTemp;
echo $strWfaExpDt;
echo $strWfaNote;
echo $strWfaEmSubject;
echo $strWfaEmContent;

//insert into WFA Details
$sql="INSERT INTO `crmdatabase`.`wfa` 
		(`wfa_timestamp`, `candidate_id`, `wfa_ID`, `wfa_TempID`, `wfa_status`, 
			`wfa_comment`, `wfa_dtEndDuraction`, `wfa_dtContacted`)     
		VALUES 	
		(CURRENT_TIMESTAMP, '$strWfaCandId', '$strWfaId', '$strWfaAssignTemp', '$strWfaStatus', 
			'$strWfaNote', '$strWfaExpDt', NULL);";
			
echo "sql insert: ".$sql;
mysql_query($sql)or die('<br /> Insert WFA has failed :( '.mysql_error());

//insert into wfa_has_wfa_template
$sql="INSERT INTO `crmdatabase`.`wfa_has_wfa_template` 
		(`wfa_ID_wfa_TempID`, `wfa_ID`, `wfa_TempID`)     
		VALUES 	
		('', '$strWfaId', '$strWfaAssignTemp');"; 
mysql_query($sql)or die('<br /> Insert WFA_has_WFA_Template has failed :( '.mysql_error());
		
//Close The Connection		
mysql_close($db_con); 
?>
<body>
</body>
</html>
