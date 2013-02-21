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
				if ($queryString == "wfaID"){
					echo '<option value="notSelected"  selected="selected">Please select.. </option>';
					$query = $db->query("SELECT * FROM wfa"); 
					if($query) {
						while ($result = $query ->fetch_object()) {
							echo '<option value="'.$result->WFA_ID.'">'.$result->Title .'</option>';
						}
					} else {
						echo 'ERROR: There was a problem with the query.';
					}
				}
				
				if ($queryString == "templete"){
					echo '<option value="notSelected"  selected="selected">Please select.. </option>';
					$query = $db->query("SELECT * FROM wfa_template"); 
					if($query) {
						while ($result = $query ->fetch_object()) {
							echo '<option value="'.$result->wfa_template_ID.'">'.$result->subject.'</option>';
						}
					} else {
						echo 'ERROR: There was a problem with the query.';
					}
				}
				
				if ($queryString == "status"){
					echo '<option value="notSelected"  selected="selected">Please select.. </option>';
					$query = $db->query("SELECT * FROM `status`"); 
					if($query) {
						while ($result = $query ->fetch_object()) {
							echo '<option value="'.$result->status_ID.'">'.$result->st_shortDescr.'</option>';
						}
					} else {
						echo 'ERROR: There was a problem with the query.';
					}
				}
				
				
				//-----------------------minh - load template follow by wfa---------------
				if ($queryString == "loadTemplateFollowWFA"){
					echo '<option value="notSelected"  selected="selected">Please select.. </option>';
					if(isset($_GET['wfa_ID']))
					{
						$wfa_id = $_GET['wfa_ID'];
						$query = $db->query("SELECT * FROM wfa_template wt, wfa_has_template wht, wfa w
										WHERE wt.wfa_template_ID = wht.wfa_template_ID
										AND wht.wfa_ID = w.WFA_ID
										AND wht.wfa_ID = '$wfa_id'"); 
						if($query) {
							while ($result = $query ->fetch_object()) {
								echo '<option value="'.$result->wfa_template_ID.'">'.$result->subject.'</option>';
							}
						} else {
							echo 'ERROR: There was a problem with the query.';
						}
					}
				}
				
				
				
			} else {
				// Dont do anything.
			}
		} else {
			echo 'There should be no direct access to this script!';
		}
	}
?>