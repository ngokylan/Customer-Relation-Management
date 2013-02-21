<?php
include("../../../db_conection/AjaxConnection.php");	
	if(!$db) {
		echo 'ERROR: Could not connect to the database.';
	} else {
		if(isset($_GET['pAgentID'])) {
			$queryString = $db->real_escape_string($_GET['pAgentID']);			
			if(strlen($queryString) >0) {				
				$query = $db->query("SELECT *  FROM `agent` WHERE `agent_ID` LIKE  '$queryString' LIMIT 1"); // The Query String
				if($query) {
					while ($result = $query ->fetch_object()) {
					echo "<SCRIPT type=\"text/javascript\">";
					echo 'function fill(){';
					echo 'alert("Testing");}';
					echo "</SCRIPT>";	
					die;
					echo 'function fill(){';
					echo 'document.getElementById(\'txtAgentFirstName\').value=\''.$result->ag_fName.'\';';
					echo 'document.getElementById(\'txtAgentSurname\').value=\''.$result->ag_lName.'\';';
					echo 'document.getElementById(\'txtAgentPassword\').value=\''.$result->ag_password.'\';';
					echo 'document.getElementById(\'cboAgentAccessLevel\').value=\''.$result->ag_levelAccess.'\';';
					if (($result->ag_logAttempts)==3){
					echo 'document.getElementById(\'cboAgentAccessStatus\').value=\''.$result->ag_logAttempts.'\';';
					}else{
						echo 'document.getElementById(\'cboAgentAccessStatus\').value=\'0\';';
					}
						$queryContactDetail = $db->query("SELECT * FROM  `contact_details` WHERE  `contact_ID` = $result->contact_id LIMIT 1"); 
						if($queryContactDetail) {
							while ($resultContactDetail = $queryContactDetail ->fetch_object()) {
							echo 'document.getElementById(\'txtAgentStreetNumber\').value=\''.$resultContactDetail->cont_streetNo.'\';';
							echo 'document.getElementById(\'txtAgentStreetName\').value=\''.$resultContactDetail->cont_street.'\';';
							echo 'document.getElementById(\'txtAgentCity\').value=\''.$resultContactDetail->cont_city.'\';';
							echo 'document.getElementById(\'txtAgentPostCode\').value=\''.$resultContactDetail->cont_zip.'\';';
							echo 'document.getElementById(\'cboAgentState\').value=\''.$resultContactDetail->cont_state.'\';';
							echo 'document.getElementById(\'txtAgentCountry\').value=\''.$resultContactDetail->cont_country.'\';';
							echo 'document.getElementById(\'txtAgentMobile\').value=\''.$resultContactDetail->cont_mobile.'\';';
							echo 'document.getElementById(\'txtAgentPhone\').value=\''.$resultContactDetail->cont_homePhone.'\';';
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