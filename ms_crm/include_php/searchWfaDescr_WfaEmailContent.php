<!--
    Team:			isync
    Programmer:		Minh 
    Purpose:		Manages the Work Flow Action functionality
    Client:			Milestone Search
    Version:		3.3.4 20-04-2011
    File:			wfa.php
    
-->
<?php
	function strToEnter($strText){
		$strProcessText="";
		$i=0;
		while($i<strlen($strText)){
			if(ord(substr($strText,$i,1))==10 ){
				
			}elseif(ord(substr($strText,$i,1))==13 ){
							  $strProcessText .="\\n";
							  }else{
								 $strProcessText .= substr($strText,$i,1); 
							  }
			$i++;
		}
		return $strProcessText;
	}

	require("../db_conection/AjaxConnection.php");				
	$strCleaner ="";						
	if(!$db) {
		echo 'ERROR: Could not connect to the database.';
	} else {
		if(isset($_POST['queryString']) && isset($_POST['candidateID'])) {
			$queryString = $db->real_escape_string($_POST['queryString']);	
			if(strlen($queryString) >0) {
				if ($_POST['type']== "WFA_code") 
				{
					$candidate_ID = $_POST['candidateID'];
					$query = $db->query("SELECT * 
										FROM wfa_template wt, wfa_template_for_candidate wc, wfa_assignment wa, candidate c
										WHERE  wt.wfa_template_ID = wc.wfa_template_ID
										AND wc.candidate_ID = c.candidate_ID
										AND wa.candidate_ID = c.candidate_ID
										AND wa.candidate_ID =  '$candidate_ID'
										;");
				
				
					if($query) 
					{
						while ($result = $query ->fetch_object()) 
						{
							$strWfaExpDt = $result->enduration; 
							
							echo "<SCRIPT LANGUAGE=\"javascript\">";
							echo 'function fill(){';
														
							echo 'document.getElementById(\'cboWfaWFAID\').value=\''.$result->wfa_ID.'\';';
							
							echo 'document.getElementById(\'cboAssTemp\').value=\''.$result->wfa_template_ID.'\';';								
							
							echo 'document.getElementById(\'cboWfaStatus\').value=\''.$result->status_complete.'\';';
							
							echo 'document.getElementById(\'txaWfaMessage\').value=\''.strToEnter(addslashes($result->content)).'\';';	
							echo 'document.getElementById(\'wfaExpDt\').value=\''.$strWfaExpDt.'\';';	
							echo '}';
							
							echo "fill();";
							echo "</SCRIPT>";					
						}
					} 
				}
				else if($_POST['type'] == "WFA_template")
				{
					$query = $db->query("SELECT *  FROM wfa_template wt, wfa_template_for_candidate wc, wfa_assignment wa
										WHERE wa.wfa_ID = wc.wfa_id
										AND wt.wfa_template_ID = wc.wfa_template_ID
										AND wt.wfa_id = '$queryString';");
					if($query) {
						while ($result = $query ->fetch_object()) 
						{
							// Calculare WFA duraction: 
							$strWfaExpDt = $result->enduration; 
							echo "<SCRIPT LANGUAGE=\"javascript\">";
							echo 'function fill(){';
							echo 'document.getElementById(\'txaWfaMessage\').value=\''.strToEnter(addslashes($result->content)).'\';';	
								
							
							echo 'document.getElementById(\'wfaExpDt\').value=\''.$strWfaExpDt.'\';';							
							echo '}';
							echo "fill();";
							echo "</SCRIPT>";					
						}
					} 
				} 
			} else 	{
				echo 'ERROR: There was a problem with the query.';
			}
		} else {
			// Dont do anything.
		} 
	}
?>