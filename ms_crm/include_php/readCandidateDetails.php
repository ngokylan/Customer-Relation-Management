<!--
	Team:			ISYNC
    Programmer:		MINH
    Purpose:		CRM to manage mileston Search Candidates
    Client:			Milestone Search
    Version:		3.3.2 26-04-2011
    File:			readCandidateDetails.php

-->
<?php
	require("../db_conection/AjaxConnection.php");
	if(!$db) {
		echo 'ERROR: Could not connect to the database.';
	} else {
		if(isset($_POST['queryString'])) {
			$queryString = $db->real_escape_string($_POST['queryString']);			
			if(strlen($queryString) >0) {				
				$query = $db->query("SELECT * FROM  `candidate` WHERE  `candidate_ID` LIKE  '$queryString' LIMIT 1"); // The Query String
				if($query) {
					while ($result = $query ->fetch_object()) {
					
/*
				var nextAvailable = "2010-10-10";// Until work out date function
				var initialContact = "2010";// Until work out date function
				var scoring = document.getElementById('cboInsertScoring').value;
				var relationshipStatus = document.getElementById('cboInsertRelatStatus').value;
				var currentEngageType = document.getElementById('cboInsertCurrEngageType').value;	
				
				var engagementType = document.getElementById('').value;
				var email = document.getElementById('txtInsertEmail').value;
				*/
					echo "<SCRIPT LANGUAGE=\"javascript\">";
					echo 'function fill(){';
					echo 'document.getElementById(\'txtInsertFName\').value=\''.$result->can_fName.'\';';
					echo 'document.getElementById(\'txtInsertSurname\').value=\''.$result->can_lName.'\';';
					echo 'document.getElementById(\'cboInsertScoring\').value=\''.$result->can_scoring.'\';';
					echo 'document.getElementById(\'dateInsertNextAvailable\').value=\''.$result->can_nextCont.'\';';
					echo 'document.getElementById(\'dateInsertInitialContact\').value=\''.$result->can_yearIniCont.'\';';
					echo 'document.getElementById(\'cboInsertRelatStatus\').value=\''.$result->can_relStatus.'\';';
					echo 'document.getElementById(\'txtInsertRate\').value=\''.$result->can_rate.'\';';
					echo 'document.getElementById(\'rateType\').value=\''.$result->can_typeRate.'\';';
					echo 'document.getElementById(\'txtInsertSellRate\').value=\''.$result->can_sellRate.'\';';
					echo 'document.getElementById(\'sellRateType\').value=\''.$result->can_typeSellRate.'\';';
					echo 'document.getElementById(\'txtInsertBuyRate\').value=\''.$result->can_buyRate.'\';';
					echo 'document.getElementById(\'buyRateType\').value=\''.$result->can_typeBuyRate.'\';';
					echo 'document.getElementById(\'cboInsertCurrEngageType\').value=\''.$result->can_currEng.'\';';
					echo 'document.getElementById(\'txtInsertNotes\').value=\''.$result->can_note.'\';';
					
					echo 'document.getElementById(\'cboInsertStatus\').value=\''.$result->status_id.'\';';
					
						$queryContactDetail = $db->query("SELECT * FROM  `contact_details` WHERE  `contact_ID` = $result->contact_id LIMIT 1"); 
						if($queryContactDetail) {
							while ($resultContactDetail = $queryContactDetail ->fetch_object()) {
							echo 'document.getElementById(\'txtInsertStNum\').value=\''.$resultContactDetail->cont_streetNo.'\';';
							echo 'document.getElementById(\'txtInsertStName\').value=\''.$resultContactDetail->cont_street.'\';';
							echo 'document.getElementById(\'txtInsertCity\').value=\''.$resultContactDetail->cont_city.'\';';
							echo 'document.getElementById(\'txtInsertPostCode\').value=\''.$resultContactDetail->cont_zip.'\';';
							echo 'document.getElementById(\'cboInsertState\').value=\''.$resultContactDetail->cont_state.'\';';
							echo 'document.getElementById(\'txtInsertCountry\').value=\''.$resultContactDetail->cont_country.'\';';
							echo 'document.getElementById(\'txtInsertMobile\').value=\''.$resultContactDetail->cont_mobile.'\';';
							echo 'document.getElementById(\'txtInsertHPhone\').value=\''.$resultContactDetail->cont_homePhone.'\';';
							echo 'document.getElementById(\'txtInsertComp\').value=\''.$resultContactDetail->cont_companyName.'\';';
							echo 'document.getElementById(\'txtInsertWorkPhone\').value=\''.$resultContactDetail->cont_workPhone.'\';';
							echo 'document.getElementById(\'txtInsertWorkFax\').value=\''.$resultContactDetail->cont_workFax.'\';';
								}
						}
						
						$queryEmail = $db->query("SELECT * FROM  `multi_email` WHERE  `candidate_id` LIKE  '$queryString' LIMIT 1"); 
						if($queryEmail) {
							while ($resultEmail = $queryEmail ->fetch_object()) {
							echo 'document.getElementById(\'txtInsertEmail\').value=\''.$resultEmail->email_ID.'\';';
								}
						}			
						
						
						$querySkill = $db->query("SELECT *  FROM `skill_set` WHERE `skill_ID` in (SELECT `skill_id`  FROM `skill_set_has_candidate` WHERE `candidate_id` LIKE '$queryString')"); 
						if($querySkill) {
							while ($resultSkill = $querySkill ->fetch_object()) {
							echo 'document.getElementById(\'txtInsertSkill\').value=\''.$resultSkill->skill_shortDescr.'\';';
							echo 'document.getElementById(\'txtInsertSkillDes\').value=\''.$resultSkill->skill_longDescr.'\';';
								}
						}			
						
						$queryJob = $db->query("SELECT *  FROM `job_title` WHERE `job_ID` in (SELECT `job_id`  FROM `job_title_has_candidate` WHERE `candidate_id` LIKE '$queryString')"); 
						if($queryJob) {
							while ($resultJob = $queryJob ->fetch_object()) {
							echo 'document.getElementById(\'txtInsertJobTitle\').value=\''.$resultJob->job_shortDescr.'\';';
							echo 'document.getElementById(\'txtInsertJobDescription\').value=\''.$resultJob->job_longDescr.'\';';
								}
						}	
						
						
						//used for selecting the correct assigned WFA of the selected candidate
						$queryJob = $db->query("SELECT wa.wfa_ID  
											   FROM wfa w, wfa_assignment wa, candidate c 
											    WHERE c.candidate_ID = wa.candidate_ID
												AND wa.wfa_ID = w.WFA_ID
												AND wa.status_complete = 'Active'
												AND c.candidate_id = '$queryString'"); 
						if($queryJob) {
							while ($resultJob = $queryJob ->fetch_object()) {
							echo 'document.getElementById(\'cbAssignWFA\').value=\''.$resultJob->wfa_ID.'\';';
							
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