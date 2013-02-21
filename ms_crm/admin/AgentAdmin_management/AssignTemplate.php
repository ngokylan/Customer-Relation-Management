<?php

	require("../../db_conection/db_connect.php");
	
	
	//this section is used for UpdateTemplate form ( update or delete template from wfa)
	
	if(isset($_POST['upd_submit']) || isset($_POST['rmv_submit']))
	{
		//get the wfa_template_id from the post form
		//because the name of the control = name of the wfa_template_id which is submited so that we have to scan the id match with the id in the wfa_template to get the correct id.
		$wfa_template_ID = "";
		$template_email_ID ="";
		$wfa_template_ID_change = "";
		
		$query = "select wfa_template_ID from wfa_template";
		
		// Get Recordset based on SQL above
		$dbRecords = mysql_query($query, $db_con ) 
				Or die('Query failed:'.mysql_error());
			
		// Loop through records
		while( $arrRecords = mysql_fetch_array($dbRecords)) 
		{	
			if(isset($_POST['rdTemplateChosen']) && ($_POST['rdTemplateChosen'] == "check_".$arrRecords['wfa_template_ID'] )
												 && (isset($_POST["email_".$arrRecords['wfa_template_ID']]))
												 && (isset($_POST["Update_cbTemplate_".$arrRecords['wfa_template_ID']])))
			{
				$wfa_template_ID = $arrRecords['wfa_template_ID'];	
				$template_email_ID = $_POST["email_".$arrRecords['wfa_template_ID']];
				$wfa_template_ID_change = $_POST["Update_cbTemplate_".$arrRecords['wfa_template_ID']];
				break;
			}
		}
		
		if($_POST['rmv_submit'] == "Remove")
		{
			
			$sql1 = "delete from wfa_has_template 
					 where  wfa_id = '".$_POST['wfa_ID']."'
					 and  wfa_template_ID='".$wfa_template_ID."'";
			
						
			mysql_query($sql1);
	
			//7 Close connection
			mysql_close($db_con);
			echo "<script language='javascript'>window.location = 'ViewWFACode.php?assignTemplate=y&wfa_ID=".$_POST['wfa_ID']."';</script>";
			die;	
		}
		
		//change the email day or the template of wfa
		if($_POST['upd_submit'] == "Update")
		{
			
			if(isset($_POST['rdTemplateChosen']))
			{
				
				$updateQuery = "update wfa_has_template set wfa_template_ID='".$wfa_template_ID_change."',
															email_day = '".$template_email_ID."'
								where wfa_template_ID='".$wfa_template_ID."'
								and wfa_ID = '".$_POST['wfa_ID']."'";
								
				echo "$updateQuery ";
				mysql_query($updateQuery);
		
				//7 Close connection
				mysql_close($db_con);
				echo "<script language='javascript'>window.location = 'ViewWFACode.php?assignTemplate=y&wfa_ID=".$_POST['wfa_ID']."';</script>";
				die;	
			}
		}
	}
	
	
	
	
	
	//assign template to the work flow action - assignTemplate form
	
	if(isset($_POST['btnAssign']) && isset($_POST['cbTemplate']) && isset($_POST['wfa_ID']) && isset($_POST['AssignEmailDay']))
	{
		$assignQuery = 'insert into wfa_has_template (wfa_id, wfa_template_ID, email_day) 
						values ('.$_POST['wfa_ID'].','.$_POST['cbTemplate'].','.$_POST['AssignEmailDay'].')';
						
		echo $assignQuery;
		
		mysql_query($assignQuery);
	
		//7 Close connection
		mysql_close($db_con);	
		echo "<script language='javascript'>window.location = 'ViewWFACode.php?assignTemplate=y&wfa_ID=".$_POST['wfa_ID']."';</script>";	
		die;	
	}
	
	
	
	
?>