<!--
	Team:			blueSky
    Programmer:		Tommy Wijaya
    Purpose:		Advance search connection and inserts results into the scroll table 
    Client:			Milestone Search
    Version:		12.0 11.10.2010
    File:			resultCandidateAdvanceList.php

    ResultSet For Advance Search Criteria
    Version 1.0
    Date 			: 9 September 2010
    Last Modified 	: 9 September 2010
    Programmer 		: Tommy Saputra Wijaya
    
    WFA 01112010: Insert WFA into DB  */
    Version 16.0
    Date 			: 01.11.2010
    Last Modified 	: 01.11.2010
    Programmer 		: Sonia
-->
<?php
	require("../db_conection/AjaxConnection.php");
	if(!$db) {
		echo 'ERROR: Could not connect to the database.';
	} else {
		//if(isset($_POST['queryString'])) {
			//$queryString = $db->real_escape_string($_POST['queryString']);
			//if(strlen($queryString) >0) {
				
				//This Section for Query
				
					$sql = "SELECT * FROM  `candidate` WHERE ";
					
					if(isset($_GET['qSkill'])) { 
					$skill = $_GET['qSkill'] ;
						if ($skill != ""){
						$sql .= "`candidate_ID` in  (SELECT DISTINCT  `candidate_id` FROM  `skill_set_has_candidate` WHERE  `skill_id` in 
									(SELECT  `skill_ID` FROM  `skill_set` WHERE  `skill_shortDescr` LIKE  '%$skill%' or  `skill_longDescr` LIKE  '%$skill%')) AND ";
						}
					} 
					
					if(isset($_GET['qNextDate'])) { 
					$nextDate = $_GET['qNextDate'];
						if($nextDate != ""){
						$sql .="`can_nextCont` >=  '$nextDate' AND ";
						}
					} 
				
					if(isset($_GET['qStatus'])) { 
					$status = $_GET['qStatus'];
						if($status != ""){
						$sql .= "`status_id` LIKE  '$status' AND ";
						}
					} 
					
					if(isset($_GET['qState'])) { 
					$state = $_GET['qState'];
						if($state != ""){
						$sql .= "`contact_id` in (SELECT  `contact_ID` FROM  `contact_details` WHERE  `cont_state` LIKE  '$state') AND ";
						}
					}
					
					if($_GET['checkMine']!="no"){
						$mine = $_GET['checkMine'];
					$sql .= "`candidate_ID` in (SELECT candidate_id FROM `agent_has_candidate` WHERE `agent_id` = '$mine') AND ";
					}
					
					$sql = substr($sql, 0, -5);						
				
				//echo $sql;
				$query = $db->query("$sql"); 
				
				$lineColourIndicator = false;
				
				if($query) {
					$emptyCheck=NULL;
					while ($result = $query ->fetch_object()) {
						$emptyCheck = $result->can_fName;
						if ($lineColourIndicator == true){
						echo 	"<div class='bgColorDark'";
						$lineColourIndicator = false;
						}else{
						echo 	"<div class='bgColorLight'"; 
						$lineColourIndicator = true;
						}
						/* Wfa 01112010: Checking if wfa exist   */
						$sqlWFA = "SELECT * FROM  wfa_assignment a, candidate c
								   WHERE c.candidate_ID = a.candidate_ID
								   AND `c.candidate_ID` = $result->candidate_ID
								   AND `status_complete` = 'Active';";
								   
						$queryWFA = $db->query("$sqlWFA"); 
						$wfa_timestampID = "";
						if($queryWFA) {
							while ($resultWFA = $queryWFA ->fetch_object()) {
								$wfa_ID = $resultWFA->wfa_ID;
							}
						}

							echo "onMouseOut=\"hideSummaryDiv();\" 
							  onMouseOver=\"setSummaryDiv(this,'candidateSummaryDiv','$result->candidate_ID')\" 
			                  
							  onClick='openCandidate_update(\"".$result->candidate_ID."\", \"".$wfa_ID."\");'>
							  
                                        <div class='leftCol' >
											<div id='colTxtL'>
												<span>".$result->can_fName.' '.$result->can_lName."</span>
											</div>
										</div>";
						$queryJob = $db->query("select * from skill_set where skill_id IN (select skill_id from skill_set_has_candidate where candidate_id in ($result->candidate_ID))");
						while ($resultJob = $queryJob ->fetch_object()){
						echo "<div class='rightCol'>
								<div id='colTxtR'>
								".$resultJob->skill_shortDescr."<br/>
								</div>
							  </div>";
						}
						echo "</div>";
	         		}
					if( $emptyCheck == NULL){
						echo "Candidate Not Found" ;
					}
				} else {
					echo 'ERROR: There was a problem with the query.';
				}
			//} else {
				// Dont do anything.
			//}
		//} else {
		//	echo 'There should be no direct access to this script!';
		//}
	}
	
	//Full Query SELECT * 
	//FROM  `candidate` WHERE  
	// `candidate_ID` in  (SELECT DISTINCT  `candidate_id` FROM  `skill_set_has_candidate` WHERE  `skill_id` 
			   // in (SELECT  `skill_ID` FROM  `skill_set` WHERE  `skill_shortDescr` LIKE  '%office%' AND  `skill_longDescr` LIKE  '%excel%')) AND  
	// `can_nextCont` >=  '2010-10-10' AND  
	// `status_id` LIKE  '2a' AND 
	// `contact_id` 
				//in (SELECT  `contact_ID` FROM  `contact_details` WHERE  `cont_state` LIKE  'VIC')
?>