<!--
	Team:			blueSky
    Programmer:		Liam Handasyde | Tommy Wijaya | Sonia Schiavon
    Purpose:		CRM to manage mileston Search Candidates
    Client:			Milestone Search
    Version:		12.0 11.10.2010
    File:			readCandidateDetails.php
    
    ResultSet For Search Criteria
    Version 1.0
    Date 			: 9 September 2010
    Last Modified 	: 9 September 2010
    Programmer : Tommy Saputra Wijaya
-->
<?php

	require("../db_conection/AjaxConnection.php");
	if(!$db) {
		echo 'ERROR: Could not connect to the database.';
	} else {
		if(isset($_POST['queryString'])) {
			$queryString = $db->real_escape_string($_POST['queryString']);			
			if(strlen($queryString) >0) {				
				$query = $db->query("SELECT * FROM  wfa_assignment a, candidate c 
									 WHERE candidate_ID LIKE  '$queryString' 
									 AND a.candidate_ID = c.candidate_ID
									 AND status_complete = 'Active' LIMIT 1"); // The Query String
				if($query) {
					while ($result = $query ->fetch_object()) {
						echo "<SCRIPT LANGUAGE=\"javascript\">";
						echo 'function fill(){';
						echo 'document.getElementById(\'cboWfaWFAID\').value=\''.$result->wfa_ID.'\';';
						// candidate id implemente by the function searchWFAByID( of supportFunction.js
						
						// need to create a new query to retrive the description from wfa_code table
						$queryWfaCode = $db->query("SELECT *  FROM `wfa_code` 
													WHERE `wfa_ID` = ".$result->wfa_ID.""); 
						if($queryWfaCode) {
							while ($resultWfaCode = $queryWfaCode ->fetch_object()) {
								echo 'document.getElementById(\'txtWfaDescr\').value=\''.$resultWfaCode->wfa_Descr.'\';';	
							}
						}			
						
						echo 'document.getElementById(\'cboWfaStatus\').value=\''.$result->wfa_status.'\';';
						echo 'document.getElementById(\'cboAssTemp\').value=\''.$result->wfa_TempID.'\';';
						echo 'document.getElementById(\'wfaExpDt\').value=\''.$result->wfa_dtEndDuraction.'\';';
						echo 'document.getElementById(\'wfaNotes\').value=\''.$result->wfa_comment.'\';';
						
						// need to see what we should display into subject email template??
						echo 'document.getElementById(\'wfaSubject\').value=\''.$resultWfaCode->wfa_Descr.'\';';
						
						// need to create a new query to retrive the template from wfa_template table
						$queryWfaTemplate = $db->query("SELECT *  
														FROM `wfa_template` 
														WHERE `wfa_TempID` = ".$result->wfa_TempID.""); ; 
						if($queryJob) {
							while ($resultWfaTemplate = $queryJob ->fetch_object()) {
							echo 'document.getElementById(\'txaWfaMessage\').value=\''.$resultWfaTemplate->wfa_Temp_Content.'\';';
							}
						}		
						
						echo '}';
						echo "fill();";
						echo "</SCRIPT>";					
					}
				} else {
					echo 'ERROR: There was a problem with the query.';
				}
			} else {
				// Dont do anything.
			}
		} else {
			echo 'There should be no direct access to this script!';
		}
	}
?>