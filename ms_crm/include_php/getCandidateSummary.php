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
	include("../db_conection/AjaxConnection.php");
	if(!$db) {
		echo 'ERROR: Could not connect to the database.';
	} else {
		
		if(isset($_POST['queryString'])) {
			$queryString = $db->real_escape_string($_POST['queryString']);			
			if(strlen($queryString) >0) {				
				$query = $db->query("SELECT * FROM  `candidate` WHERE  `candidate_ID` LIKE  '$queryString' LIMIT 1"); // The Query String 
				if($query) {
					while ($result = $query ->fetch_object()) {
					echo "&nbsp;<strong>".$result->can_fName." ".$result->can_lName."</strong><br>";
					echo "&nbsp;Next Available : <strong>".$result->can_nextCont."</strong><br>";
					
				
					
						$queryContactDetail = $db->query("SELECT * FROM  `contact_details` WHERE  `contact_ID` = $result->contact_id LIMIT 1"); 
						if($queryContactDetail) {
							while ($resultContactDetail = $queryContactDetail ->fetch_object()) {
							echo "&nbsp;Mobile&nbsp;&nbsp;&nbsp; :  <strong>".$resultContactDetail->cont_mobile."</strong><br>";
							echo "&nbsp;Phone&nbsp;&nbsp;&nbsp;&nbsp; : <strong>".$resultContactDetail->cont_homePhone."</strong><br>";
							
								}
						}
						
						$queryEmail = $db->query("SELECT * FROM  `multi_email` WHERE  `candidate_id` LIKE  '$queryString' LIMIT 1"); 
						if($queryEmail) {
							while ($resultEmail = $queryEmail ->fetch_object()) {
							//echo 'document.getElementById(\'txtInsertEmail\').value=\''.$resultEmail->email_ID.'\';';
								}
						}			
						
						
						
						
						$queryJob = $db->query("SELECT *  FROM `job_title` WHERE `job_ID` in (SELECT `job_id`  FROM `job_title_has_candidate` WHERE `candidate_id` LIKE '$queryString')"); 
						if($queryJob) {
							while ($resultJob = $queryJob ->fetch_object()) {
							echo "<br />
&nbsp;Job Title : ".$resultJob->job_shortDescr."<br>";
							//echo 'document.getElementById(\'txtInsertJobTitle\').value=\''.$resultJob->job_shortDescr.'\';';
							//echo 'document.getElementById(\'txtInsertJobDescription\').value=\''.$resultJob->job_longDescr.'\';';
								}
						}	
						$querySkill = $db->query("SELECT *  FROM `skill_set` WHERE `skill_ID` in (SELECT `skill_id`  FROM `skill_set_has_candidate` WHERE `candidate_id` LIKE '$queryString')"); 
						if($querySkill) {
							while ($resultSkill = $querySkill ->fetch_object()) {
								echo "<br />
&nbsp;Skill Set : ".$resultSkill->skill_shortDescr."<br>";
								echo "&nbsp;<strong>Description</strong> : <br />".$resultSkill->skill_longDescr."<br>";
							//echo 'document.getElementById(\'txtInsertSkill\').value=\''.$resultSkill->skill_shortDescr.'\';';
							//echo 'document.getElementById(\'txtInsertSkillDes\').value=\''.$resultSkill->skill_longDescr.'\';';
								}
						}						
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