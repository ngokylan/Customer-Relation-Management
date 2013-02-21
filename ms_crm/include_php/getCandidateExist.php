<?php
/*
Team:			blueSky
    Programmer:		Tommy Wijaya
    Purpose:		Retrieve Candidate information if the Candidate Exist
    Client:			Milestone Search
    Version:		12.0 11.10.2010
    File:			resultCandidateAdvanceList.php

    Checking Candidate Exist
    Version 1.0
    Date 			: 19 November 2010
    Last Modified 	: 19 November 2010
    Programmer 		: Tommy Saputra Wijaya
*/
	require("../db_conection/AjaxConnection.php");
	if(!$db) {
		echo 'ERROR: Could not connect to the database.';
	} else {
				$strFirstname 	= addslashes($_POST['firstName']);
				$strLastname 	= addslashes($_POST['lastName']);
				$strMobile 		= addslashes($_POST['mobile']);
				$strEmail 		= addslashes($_POST['email']);

				$sql =	"SELECT *  FROM `candidate` WHERE `contact_ID`  in (SELECT `contact_ID`  FROM `contact_details` WHERE `cont_mobile` LIKE '$strMobile')OR 
						candidate_id in (SELECT `candidate_ID`  FROM `multi_email` WHERE `email_ID` LIKE '$strEmail') or 
						(`can_fName` LIKE '$strFirstname' AND `can_lName` LIKE '$strLastname') LIMIT 1";
				
				/*$sql = "SELECT *  FROM `candidate` WHERE `candidate_ID` in (SELECT `candidate_ID`  FROM `contact_details` WHERE `cont_mobile` LIKE '$strMobile') 
						AND candidate_id in (SELECT `candidate_ID`  FROM `multi_email` WHERE `email_ID` LIKE '$strEmail') and 
						`can_fName` LIKE '$strFirstname' OR`can_lName` LIKE '$strLastname' ";*/
				
				/*$sql = "SELECT *  FROM `candidate` WHERE ";
				
				if(isset($_POST['mobile']) && $_POST['mobile'] !=""){
					$sql .="`candidate_ID` in (SELECT `candidate_ID`  FROM `contact_details` WHERE `cont_mobile` LIKE '$strMobile') OR ";
				}
				
				$sql .=" `candidate_ID` in (SELECT `candidate_ID`  FROM `multi_email` WHERE `email_ID` LIKE '$strEmail') AND ";
				$sql .=" `can_fName` LIKE '$strFirstname' AND `can_lName` LIKE '$strLastname' ";*/
				//echo $sql;
				
				$query = $db->query("$sql"); 
				if($query) {				
					while ($result = $query ->fetch_object()) {
						$sqlWFA = "SELECT * FROM  `wfa` WHERE `candidate_ID` = $result->candidate_ID AND `wfa_status` = 'Active' LIMIT 1;";
						$queryWFA = $db->query("$sqlWFA"); 
						$wfa_timestampID = "";
						if($queryWFA) {
							while ($resultWFA = $queryWFA ->fetch_object()) {
								$wfa_timestampID = $resultWFA->wfa_timestamp;
							}
						}
						//echo "\"".$result->candidate_ID."\", \"".$wfa_timestampID."\"";
						echo $result->candidate_ID.",".$wfa_timestampID;
	         		}
				} else {
					echo 'ERROR: There was a problem with the query.';
				}
	}
?>