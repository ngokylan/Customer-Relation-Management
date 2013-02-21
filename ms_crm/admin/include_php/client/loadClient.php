<?php
include("../../../db_conection/AjaxConnection.php");	
	if(!$db) {
		echo 'ERROR: Could not connect to the database.';
	} else {
				$query = $db->query("SELECT * FROM `client`"); // The Query String
				if($query) {
					while ($result = $query ->fetch_object()) {
							echo '<div id="divRowClick" onclick="loadAgentInformation(\''.$result->client_ID.'\');">';
							
							echo '<div class="scrolTblColumn"><!--Column First Name-->';
							echo $result->cl_fName;
							echo '</div>';
							
							echo '<div class="scrolTblColumn"><!--Column surname-->';
							echo $result->cl_lName;
							echo '</div>';
						
							echo '</div>';
							
                    	echo '</div>';
						}
	         		}
	}
?>