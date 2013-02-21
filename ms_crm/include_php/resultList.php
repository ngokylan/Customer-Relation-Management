<!--
	Team:			blueSky
    Programmer:		Liam Handasyde | Tommy Wijaya | Sonia Schiavon
    Purpose:		Pulls results from search query from the database
    Client:			Milestone Search
    Version:		12.0 11.10.2010
    File:			resultList.php

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
				$query = $db->query("SELECT * FROM  `candidate` WHERE  `can_fName` LIKE  '%$queryString%'OR  `can_lName` LIKE  '%$queryString%' LIMIT 10"); // The Query String
				if($query) {
					while ($result = $query ->fetch_object()) {
						echo '<li onClick="filltoTextbox(\''.$result->can_fName.' '.$result->can_lName.'\');">'.$result->can_fName.' '.$result->can_lName.'</li>'; 
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