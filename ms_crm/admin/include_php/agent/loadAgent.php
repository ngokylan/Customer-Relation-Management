<?php
include("../../../db_conection/AjaxConnection.php");	
	if(!$db) {
		echo 'ERROR: Could not connect to the database.';
	} else {
		//if(isset($_POST['queryString'])) {
			//$queryString = $db->real_escape_string($_POST['queryString']);			
			//if(strlen($queryString) >0) {				
				$query = $db->query("SELECT * FROM `agent`"); // The Query String
				if($query) {
					while ($result = $query ->fetch_object()) {
							echo '<div id="divRowClick" onclick="loadAgentInformation(\''.$result->agent_ID.'\');">';
							
							echo '<div class="scrolTblColumn"><!--Column First Name-->';
							echo $result->ag_fName;
							echo '</div>';
							
							echo '<div class="scrolTblColumn"><!--Column surname-->';
							echo $result->ag_lName;
							echo '</div>';
							
							echo '<div class="scrolTblColumn"><!--Column Level of Access-->';
							echo $result->ag_levelAccess;
							echo '</div>';
							
							echo '<div class="scrolTblColumn"><!--Column Account Status-->';
							if(($result->ag_logAttempts)==3){
								echo "Locked";
							}else{
								echo "Active";
							}
							echo '</div>';
							
                    	echo '</div>';
						}
	         		}
				//} else {
				//	echo 'ERROR: There was a problem with the query.';
				//}
			//} else {
				// Dont do anything.
			//}
		//} else {
		//	echo 'There should be no direct access to this script!';
		//}
	}
?>