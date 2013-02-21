<!--
	Team:			blueSky
    Programmer:		Liam Handasyde | Tommy Wijaya | Sonia Schiavon
    Purpose:		First name / last name search connection and inserts results into the scroll table 
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
				
				//This Section for Query
				
				$word = explode(" ", $queryString);
				$queryLike = "";
				
				$queryLike .= " ( ";
				foreach($word as $val){
					$val = trim($val);
					
					$queryLike .= "`can_fName` LIKE  '%$val%' OR  `can_lName` LIKE  '%$val%' OR";
					//echo $val;
				}
				$querySub = substr($queryLike, 0, -3);	
				$querySub .= " ) ";
				
				if($_POST['checkMine']!="no"){
					$agentID = $_POST['checkMine'];
					$querySub .= " and `candidate_ID` in (SELECT candidate_id FROM `agent_has_candidate` WHERE `agent_id` =  $agentID)";
				}
				
				//echo $querySub;
				$query = $db->query("SELECT * FROM  `candidate` WHERE  $querySub "); // The Query String
				

				$lineColourIndicator = false;
				if($query) {
					$emptyCheck= NULL;
					while ($result = $query ->fetch_object()) {
						$emptyCheck = $result->can_fName;
						if ($lineColourIndicator == true){
						echo 	"<div class='bgColorDark'";
						$lineColourIndicator = false;}
						else{
						echo 	"<div class='bgColorLight'"; 
						$lineColourIndicator = true;
						}
						/* Wfa 01112010: Checking if wfa exist   */
						$sqlWFA = "SELECT * FROM  wfa_assignment a, candidate c
								   WHERE c.candidate_ID = a.candidate_ID
								   AND c.candidate_ID = '$result->candidate_ID'
								   AND status_complete = 'Active';";						   
						$queryWFA = $db->query("$sqlWFA"); 
						$wfa_timestampID = "";
						if($queryWFA) {
							while ($resultWFA = $queryWFA ->fetch_object()) {
								$wfa_ID = $resultWFA->wfa_ID;
							}
						}
						//echo "onClick='openCandidate(\"".$result->candidate_ID."\");'>
						/* END Wfa 01112010: Checking if wfa exist   */
						echo "onMouseOut=\"hideSummaryDiv();\" 
							  onMouseOver=\"setSummaryDiv(this,'candidateSummaryDiv','$result->candidate_ID')\" 
			                  
							  onClick='openCandidate_update(\"".$result->candidate_ID."\", \"". $result->can_fName." ".$result->can_lName ."\", \"".$wfa_ID."\")'>  
                                        <div class='leftCol' >
											<div id='colTxtL'>
												<span>".$result->can_fName.' '.$result->can_lName."</span>
											</div>
										</div>";
						$queryJob = $db->query ("select * from skill_set where skill_id IN (select skill_id from skill_set_has_candidate where candidate_id in ($result->candidate_ID))");
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
			} else {
				// Dont do anything.
			}
		} else {
			echo 'There should be no direct access to this script!';
		}
	}
?>