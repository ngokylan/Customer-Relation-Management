<?php
	//retrieve the agent id from the sesstion variable
	session_cache_limiter("nocache");
	session_start();
	/*
    Team:			isync
    Programmer:		Minh 
    Purpose:		Manages the Work Flow Action functionality
    Client:			Milestone Search
    Version:		3.4.1 28-04-2011
    File:			wfa.php
    */

	$agentID = "";
	$count_rows = 0;
	
	if(isset($_SESSION['userName'])&&isset($_SESSION['userID'])){
		$agentID = $_SESSION['userID'];			
	}

	include("../db_conection/AjaxConnection.php");	
	if(!$db) {
		echo 'ERROR: Could not connect to the database.';
	} else {
		if(isset($_POST['queryString'])) 
		{
			$queryString = $db->real_escape_string($_POST['queryString']);
					
			//display only 20 characters of the template name 
			//and the comments to the Agent To Do list
			$query = $db->query("SELECT distinct(c.can_fName), c.can_lName, 					c.candidate_ID, wc.enduration, wa.timestamp, IF(CHAR_LENGTH(t.subject)>20,RPAD(LEFT(t.subject,20),23,'.'),t.subject) AS template, IF(CHAR_LENGTH(wc.comment)>20,RPAD(LEFT(wc.comment,20),23,'.'),wc.comment) AS comment, wc.wfa_temp_can_id, wc.wfa_template_ID
				FROM (wfa_template_for_candidate wc

				INNER JOIN 
				(
					SELECT wc2.candidate_ID, MIN( wc2.enduration ) AS Oldest_Email
					FROM wfa_template_for_candidate wc2, wfa_assignment wa
					WHERE wc2.sent_status =  '0'
					AND wc2.enduration <= NOW( ) 
					AND wc2.wfa_id = wa.wfa_ID
					AND wa.status_complete = 'Active'
					AND wa.candidate_ID = wc2.candidate_ID
					GROUP BY wc2.candidate_ID
				) AS result 
				ON wc.candidate_ID = result.candidate_ID
				AND wc.enduration = result.Oldest_Email)

				INNER 
				   JOIN wfa_template t
					  ON wc.wfa_template_ID= t.wfa_template_ID
					  
				INNER 
				   JOIN candidate c 
					  ON wc.candidate_ID = c.candidate_ID
					  Inner 
						 Join wfa_assignment wa
							On wa.candidate_ID = c.candidate_ID
							AND wc.wfa_ID = wa.wfa_id
							AND wa.status_complete = 'Active'
							   Inner
								  Join wfa w
									   On w.WFA_ID = wa.wfa_ID				   
			 	Inner 
				   JOIN agent_has_candidate ac
				      On ac.candidate_ID = c.candidate_ID
					  AND ac.agent_id = '$agentID'"); // The Query String
			
			
			
			/*$query = $db->query("SELECT distinct(c.can_fName), c.can_lName, 					c.candidate_ID, wc.enduration, wa.timestamp, IF(CHAR_LENGTH(t.subject)>20,RPAD(LEFT(t.subject,20),23,'.'),t.subject) AS template, IF(CHAR_LENGTH(wc.comment)>20,RPAD(LEFT(wc.comment,20),23,'.'),wc.comment) AS comment, wc.wfa_temp_can_id, wc.wfa_template_ID
				FROM (wfa_template_for_candidate wc

				INNER JOIN 
				(
					SELECT wc2.candidate_ID, MIN( wc2.enduration ) AS Oldest_Email
					FROM wfa_template_for_candidate wc2, wfa_assignment wa
					WHERE wc2.sent_status =  '0'
					AND wc2.enduration <= NOW( ) 
					AND wc2.wfa_id = wa.wfa_ID
					AND wa.status_complete = "Active"
					AND wa.candidate_ID = wc2.candidate_ID
					GROUP BY wc2.candidate_ID
				) AS result 
				ON wc.candidate_ID = result.candidate_ID
				AND wc.enduration = result.Oldest_Email)

				INNER 
				   JOIN wfa_template t
					  ON wc.wfa_template_ID= t.wfa_template_ID
					  
				inner
					join wfa_has_template wt
					 	on wt.wfa_template_id = t.wfa_template_ID
					
				 Inner
					Join wfa w
						On w.WFA_ID = wt.wfa_ID		
				
				 Inner 
						 Join wfa_assignment wa
							On wc.wfa_ID = wa.wfa_ID
							AND wa.status_complete = 'Active'
							AND w.WFA_ID = wa.wfa_ID
				
				INNER 
				   JOIN candidate c 
					  ON wc.candidate_ID = c.candidate_ID
					  AND c.candidate_ID = wa.candidate_ID
					 
							  		   
			 	Inner 
				   JOIN agent_has_candidate ac
				      On ac.candidate_ID = c.candidate_ID
					  AND ac.agent_id = '$agentID'");*/
			
			
			
			if($query) 
			{				
				
				//$colorChange = true;
				$candidateName ="";
				while ($result = $query ->fetch_object()) 
				{
					$count_rows++;	//count the number of the returned value for ticking all the check boxes
					
					$candidateName = $result->can_fName.' '.$result->can_lName;					

					
					echo'<tr onmouseout="hideSummaryDiv();" 
					onmouseover="setSummaryDiv(this,\'candidateSummaryDiv\',\''.$result->candidate_ID.'\')"
					>
						  <td width="70" onClick="searchWFAByCandID(\''.$result->candidate_ID.'\',\''.$result->wfa_template_ID.'\')" >'.date("d/m/Y",strtotime($result->enduration)).'</td>
						  <td width="110" onClick="searchWFAByCandID(\''.$result->candidate_ID.'\',\''.$result->wfa_template_ID.'\')" >'.$candidateName.'</td>
						   <td width="150" onClick="searchWFAByCandID(\''.$result->candidate_ID.'\',\''.$result->wfa_template_ID.'\')" >'.$result->template.'</td>
						  <td width="110" onClick="searchWFAByCandID(\''.$result->candidate_ID.'\',\''.$result->wfa_template_ID.'\')" >'.$result->comment.'</td>
						  <td width="60" align="center" ><input id="chkAll'.$count_rows.'" type="checkbox" onClick="uncheck_all(\'chkAll'.$count_rows.'\');" value="'.$result->wfa_temp_can_id.'"/>
						  </td>
						</tr>';
					
				}
				
			} else {
				// Dont do anything.
			}
		} else {
			echo 'There should be no direct access to this script!';
		}
	}
	
	//javascript check to uncheck the check all check boxes when one of the check box is unticked
	echo '

	<script type="text/javascript">	
				
		function check_all()
		{
			document.getElementById("NoChecked").value = '.$count_rows.';
			document.getElementById("chkAll").value = '.$count_rows.';
			if(document.getElementById("chkAll").checked == 1)
			{
				
				var numberCheckBox = '.$count_rows.';				
				for(var i = 1; i <= numberCheckBox; i++)
				{
					//alert("chkCheckAll" + i);
					document.getElementById("chkAll" + i).checked = 1;					
				}
				document.getElementById("btnSendAll").disabled = 0;
			}
			else
			{
				var numberCheckBox = '.$count_rows.';
				for(var i = 1; i <= numberCheckBox; i++)
				{
					//alert("chkCheckAll" + i);
					document.getElementById("chkAll" + i).checked = 0;				
				}
				document.getElementById("btnSendAll").disabled = 1;
				document.getElementById("chkAll").value = 0;
			}
		}
		
		function uncheck_all(checkbox_id)
		{
			document.getElementById("NoChecked").value = '.$count_rows.';
			//disable the sendAll button when all check boxes are unticked
			if(document.getElementById("chkAll").value == null || document.getElementById("chkAll").value <= 0 )
			{
				document.getElementById("btnSendAll").disabled = 1;
				document.getElementById("chkAll").value = 1;		
				document.getElementById("chkAll").checked = 0;
			}						
			else if(document.getElementById("chkAll").value != null )
			{
				//minor the total checkboxes 1 if there is one check box is unticked
				if(document.getElementById("chkAll").checked == 0 && document.getElementById(checkbox_id).checked == 0)
				{		
					var totalCheckBoxes = document.getElementById("chkAll").value;
					totalCheckBoxes--;
					document.getElementById("chkAll").value = totalCheckBoxes;
					document.getElementById("chkAll").checked = 0;
					
					//disable the sendAll button when all the check boxes are unticked
					if(document.getElementById("chkAll").value == 0)
						document.getElementById("btnSendAll").disabled = 1;
					document.getElementById("chkAll").checked = 0;
				}
				
				//minor the total checkboxes 1 if there is one check box is unticked and CheckAll is unticked
				if(document.getElementById("chkAll").checked == 1 && document.getElementById(checkbox_id).checked == 0)
				{		
					var totalCheckBoxes = document.getElementById("chkAll").value;
					totalCheckBoxes--;
					document.getElementById("chkAll").value = totalCheckBoxes;
					document.getElementById("chkAll").checked = 0;
					
					//disable the sendAll button when all the check boxes are unticked
					if(document.getElementById("chkAll").value == 0)
						document.getElementById("btnSendAll").disabled = 1;
					document.getElementById("chkAll").checked = 0;
				}
								
				//add 1 to the total checkboxes 1 if there is one check box is ticked
				if(document.getElementById("chkAll").checked == 0 && document.getElementById("chkAll").value >= 0 && document.getElementById(checkbox_id).checked == 1)
				{					
					var totalCheckBoxes = document.getElementById("chkAll").value;
					totalCheckBoxes++;
					document.getElementById("chkAll").value = totalCheckBoxes;
					document.getElementById("chkAll").checked = 0;					
					
				}			
									
			}			
			
			//alert(document.getElementById("chkAll").value);
			//alert(checkbox_id);
			if(document.getElementById(checkbox_id).checked == 1)
			{
				document.getElementById("btnSendAll").disabled = 0;
				document.getElementById("chkAll").checked = 0;
			}
						
		}
	</script>
	';
	
?>


