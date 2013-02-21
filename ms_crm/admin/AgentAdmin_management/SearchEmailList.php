<!--
    Team:			isync
    Programmer:		Minh 
    Purpose:		Manages the Work Flow Action functionality
    Client:			Milestone Search
    Version:		3.3.5 28-04-2011
    File:			wfa.php
    
-->


<link href="../style/tablestyle.css" rel="stylesheet" type="text/css" />
<h1>Email Search <a href="#"><img src="../../image/help_icon.jpg" width="20"/></a></h1>

<?php
			require_once("../../db_conection/db_connect.php");
			session_start();
			$agentID = "";
			
			if(isset($_SESSION['userID']))
			{
				$agentID = $_SESSION['userID'];			
			}

	//use for processing delete button
	if(isset($_POST['btnDelete']))
	{
		$wfaid = "";
		$candidateid = "";
		$timestamp = "";
		$wfa_temp_can_id = $_POST['chkCheckAll'];
		for($i = 0;$i < count($wfa_temp_can_id); $i++)
		{	
		//	echo count($wfa_temp_can_id)."\n";
		//	echo "wfa: ".$wfa_temp_can_id[$i]. " ";			
			$sql = "select wc2.wfa_temp_can_id , wa.status_complete, wc2.candidate_ID, wc2.wfa_id, wa.timestamp
						  from wfa_assignment wa, wfa_template_for_candidate wc2
						  where wa.status_complete = 'Inactive'
						  and wc2.candidate_ID = wa.candidate_ID
						  and wc2.wfa_id = wa.wfa_ID
						  and wc2.wfa_temp_can_id = '".$wfa_temp_can_id[$i]."'";
						  
			$dbRecords = mysql_query($sql , $db_con );
		
			while($arrRecords = mysql_fetch_array($dbRecords)) 
			{
				if($arrRecords['status_complete'] == "Inactive")
				{
										
					$wfa_temp_can_id2 = $arrRecords['wfa_temp_can_id'];
					//echo $wfa_temp_can_id2." ";
					$sqlDel = "DELETE FROM `wfa_template_for_candidate` 
							   WHERE `wfa_temp_can_id` = '".$wfa_temp_can_id2."'";
				
					mysql_query($sqlDel,$db_con)
			Or die('Query failed:'.mysql_error());
					//echo $wfaid;
					//remove old wfa_assignment either
									
				}		
			}
		}
		
		$sql = "select wa.candidate_ID, wa.wfa_ID, wa.timestamp
						  from wfa_assignment wa, wfa_template_for_candidate wc2
						  where wa.status_complete = 'Inactive'";
						  
			$dbRecords = mysql_query($sql , $db_con );
		
			while($arrRecords = mysql_fetch_array($dbRecords)) 
			{
			
					$wfaid = $arrRecords['wfa_ID'];
					$candidateid = $arrRecords['candidate_ID'];				
					$timestamp = $arrRecords['timestamp'];
					
					$sqlDel2 = "DELETE FROM `wfa_assignment` 
							   WHERE `wfa_ID` = '$wfaid'
							   AND `candidate_ID` = '$candidateid'
							   AND timestamp = '$timestamp'";
					//echo $sqlDel."\n";
					mysql_query($sqlDel2,$db_con)
					Or die('Query failed:'.mysql_error());
					
					
				
			}
		
		echo '<script language="javascript">
				alert("Empty the unneccessary records succesfully!!!");
			</script>';
	}
	
	$searchType = "";
	$input = "";
	$date = "";
	$count_rows = 0 ; //count number of returned value from the query to include into the javascript which check all the record
	if(isset($_POST['btnSearch']))
	{		
		//check if the type of search is by name or by date
		if(isset($_POST['rdSearchType']))
		{
			$searchType = $_POST['rdSearchType'];			
			$input = $_POST['txtInput'];	
			$date = $_POST['txtEmailDate'];
			$date = date("Y/m/d",strtotime($date));
			
		}		
	}


?>


<form id="SearchForm" name="SearchForm" method="post" action="SearchEmailList.php">
<table summary="Work Flow Action Code" align="center">
	<!-- Search control -->
                
                <tr>
                	<td align="left">
                    <table width="900px" style="border:1; border-color:#09F">
                    <tr>
                    	<td>
                            <input name="txtInput" type="text" id="txtInput" size="100"/><label><input name="rdSearchType" type="radio" value="Name" 
						<?php if($searchType == "Name") echo "checked";
							  if($searchType == NULL) echo "checked";?>
                        />Name </label>
                        </td>
                        <td align="left">
                        	<input name="txtEmailDate" type="text" id="txtEmailDate" size="100" class="txtBoxShadow"/><label><input name="rdSearchType" type="radio" value="Date" 
                            <?php if($searchType == "Date") echo "checked";?>
                        />
                        	Email Date (d-m-y)</label>
                         </td>
                         <td align="left">
                         	 <label><input name="rdSearchType" type="radio" value="active" 
                            <?php if($searchType == "active") echo "checked";?>
                        />Active Status</label>
                        <label><input name="rdSearchType" type="radio" value="inactive" 
                            <?php if($searchType == "inactive") echo "checked";?>
                        />InActive Status</label>
                         </td>
                        <td align="left"><input name="btnSearch" type="submit" value="Search" /></td>
                    </tr>
                    </table>
                    </td>
                </tr>
              
	<tr valign="top">    	
        <td width="100%">
        	<table border="0" width="100%" id="gradient-style" >
            	<!-- header ---->
            	 <thead>
                  <tr>                      		        
                    <th scope="col"><input id="chkCheckAllMenu" name="chkCheckAllMenu" type="checkbox" value="" onClick="check_all();"/>Check All</th>
                    <th scope="col">Candidate Name</th>
                    <th scope="col">Template</th> 
                    <th scope="col">Date Sent</th>   
                    <th scope="col">Notes</th>              
                    <th scope="col">Send Status</th>
                    <th scope="col">Duration</th> 
                    <th scope="col">Completed Status</th>        
                    
                </thead>
        		
              <!-- Content ---->
                
                  <?php
	if(isset($_POST['btnSearch']))
	{	

		
		//check if the type of search is by name or by date
		
		if(!$db_con)
		{
			echo 'ERROR: Could not connect to the database.';
		}
		else 
		{	
			$query = "";
			if($searchType == "Name")
			{
				$query ="SELECT distinct(c.can_fName),c.can_fName,c.can_lName, t.subject, DATE_FORMAT(wc.date_sent,'%d/%m/%Y') as date_sent, wc.comment, wc.sent_status, DATE_FORMAT(wc.enduration,'%d/%m/%Y') as enduration, wa.status_complete, wc.wfa_temp_can_id  
					FROM wfa w, wfa_template t, wfa_assignment wa, wfa_template_for_candidate wc, candidate c, agent_has_candidate ac
					WHERE w.WFA_ID = wa.wfa_ID
					AND   wa.wfa_ID = wc.wfa_id
					AND	  c.candidate_ID = wa.candidate_ID
					AND	  c.candidate_ID = wc.candidate_ID
					AND   wc.wfa_template_ID = t.wfa_template_ID
					AND   ac.candidate_id = c.candidate_ID
					AND   ac.agent_id = '".$agentID."'
					AND   c.can_fName like '%" . $input . "%'"; 
			}
			
			if($searchType == "Date")
			{
				$query ="SELECT distinct(c.can_fName),c.can_fName,c.can_lName, t.subject, DATE_FORMAT(wc.date_sent,'%d/%m/%Y') as date_sent, wc.comment, wc.sent_status, DATE_FORMAT(wc.enduration,'%d/%m/%Y') as enduration, wa.status_complete, wc.wfa_temp_can_id 
					FROM wfa w, wfa_template t, wfa_assignment wa, wfa_template_for_candidate wc, candidate c, agent_has_candidate ac
					WHERE w.WFA_ID = wa.wfa_ID
					AND   wa.wfa_ID = wc.wfa_id
					AND	  c.candidate_ID = wa.candidate_ID
					AND	  c.candidate_ID = wc.candidate_ID
					AND   wc.wfa_template_ID = t.wfa_template_ID
					AND   ac.candidate_id = c.candidate_ID
					AND   ac.agent_id = '".$agentID."'
					AND   wc.enduration = '".$date."'"; 			
			}
			
			if($searchType == "active" || $searchType == "inactive")
			{
				$query ="SELECT distinct(c.can_fName),c.can_fName,c.can_lName , t.subject, DATE_FORMAT(wc.date_sent,'%d/%m/%Y') as date_sent, wc.comment, wc.sent_status, DATE_FORMAT(wc.enduration,'%d/%m/%Y') as enduration, wa.status_complete, wc.wfa_temp_can_id 
					FROM wfa w, wfa_template t, wfa_assignment wa, wfa_template_for_candidate wc, candidate c, agent_has_candidate ac
					WHERE w.WFA_ID = wa.wfa_ID
					AND   wa.wfa_ID = wc.wfa_id
					AND	  c.candidate_ID = wa.candidate_ID
					AND	  c.candidate_ID = wc.candidate_ID
					AND   wc.wfa_template_ID = t.wfa_template_ID
					AND   ac.candidate_id = c.candidate_ID
					AND   ac.agent_id = '".$agentID."'
					AND   wa.status_complete = '$searchType'"; 
			}
			
			//	echo $query;		
			$dbRecords = mysql_query($query, $db_con ) 
			Or die('Query failed:'.mysql_error());
		
			while( $arrRecords = mysql_fetch_array($dbRecords)) 
			{
				$count_rows++;
				if($arrRecords['status_complete'] == "Inactive")
				{
					$candidateName = $arrRecords['can_fName'].' '.$arrRecords['can_lName'];		
						echo '						
					<tr bgcolor="#FFFFFF">
						<td><input id="chkCheckAll'.$count_rows.'" name="chkCheckAll[]" type="checkbox" value="'.$arrRecords['wfa_temp_can_id'].'" onClick="uncheck_all();"/></td>
						<td>'.$candidateName.'</td>                            
						<td>'.$arrRecords['subject'].'</td>
						<td>'.$arrRecords['date_sent'].'</td>
						<td>'.$arrRecords['comment'].'</td>
						<td align="center">';
						
					if($arrRecords['sent_status'] == 1)
						echo 'Yes';
					else
						echo 'No';
					
					echo '</td>
						<td>'.$arrRecords['enduration'].'</td>
						<td><font color="#FF9900">'.$arrRecords['status_complete'].'</font></td>
					</tr>';
				}
				else
				{
					$candidateName = $arrRecords['can_fName'].' '.$arrRecords['can_lName'];	
						echo '						
					<tr>
						<td><input id="chkCheckAll'.$count_rows.'" name="chkCheckAll[]" type="checkbox" value="'.$arrRecords['wfa_temp_can_id'].'" onClick="uncheck_all();"/></td>
						<td>'.$candidateName.'</td>                            
						<td>'.$arrRecords['subject'].'</td>
						<td>'.$arrRecords['date_sent'].'</td>
						<td>'.$arrRecords['comment'].'</td>
						<td align="center">';
						
					if($arrRecords['sent_status'] == 1)
						echo 'Yes';
					else
						echo 'No';
					
					echo '</td>
						<td>'.$arrRecords['enduration'].'</td>
						<td>'.$arrRecords['status_complete'].'</td>
					</tr>';
				}
			} 
		}	
	}
	
	
	echo '
	<script type="text/javascript">
		function check_all()
		{
			if(document.getElementById("chkCheckAllMenu").checked == 1)
			{
				var numberCheckBox = '.$count_rows.';
				for(var i = 1; i <= numberCheckBox; i++)
				{
					//alert("chkCheckAll" + i);
					document.getElementById("chkCheckAll" + i).checked = 1;
					
				}
				window.location= \'#btnDelete\';
			}
			else
			{
				var numberCheckBox = '.$count_rows.';
				for(var i = 1; i <= numberCheckBox; i++)
				{
					//alert("chkCheckAll" + i);
					document.getElementById("chkCheckAll" + i).checked = 0;
					
				}
			}		
			
		}
		
		function uncheck_all()
		{
			document.getElementById("chkCheckAllMenu").checked = 0;			
		}
	</script>
	';
?>

                    
        
        
        
        
        		
                
              <!-- Footer  ---->        	
            </table>
        </td>
    </tr>
    <tr>
            	<td colspan="8" align="left"><input id="btnDelete" name="btnDelete" type="submit" value="Delete The Inactive WFA" onclick="return confirm('Are you sure to delete?');"><input name="hdCountRow" type="hidden" value="<?php echo $count_rows;?>" /></td>
            </tr>
</table>
  </form>

