<?php

	include("../../../db_conection/AjaxConnection.php");	
	if(!$db) 
	{
		echo 'ERROR: Could not connect to the database.';
	} 
	else 
	{
					
		$query = $db->query("SELECT wfa_template_ID, subject  FROM `wfa_template`"); // The Query String
		if($query) 
		{
			while ($result = $query ->fetch_object()) 
			{
			echo "<SCRIPT type=\"text/javascript\">";
			echo 'function fill(){}';
			//echo 'alert("Testing");}';
			echo "</SCRIPT>";	
			die;
			echo 'function fill(){';
			echo 'document.getElementById(\'txtTemplate_ID\').value=\''.$result->subject.'\';';			
		//	echo 'document.getElementById(\'cboSubject\').value=\''.$result->subject.'\';';				
	
			echo '}';
			echo "fill();";
			echo "</SCRIPT>";	
			}
		}
		
		
	}
?>