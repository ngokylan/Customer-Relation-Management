<!--
	Team:			ISYNC
    Programmer:		MINH
    Purpose:		CRM to manage mileston Search Candidates
    Client:			Milestone Search
    Version:		3.4.4 30-05-2011
    File:			readCandidateDetails.php

-->
<?php
//Update candidate information, set inactive email status
$strCandidateID = addslashes($_POST['CandidateID']);

require("../db_conection/db_connect.php");


$sql="UPDATE `wfa_assignment` 
		 SET `status_complete` = 'Inactive'			 
	   WHERE `candidate_ID` = '$strCandidateID'
		 AND `status_complete` = 'Active'";						 		 										 
mysql_query($sql)or die('<br /> Update status has failed :( '.mysql_error());

//Close The Connection
mysql_close($db_con); 
?>
