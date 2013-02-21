




<!-- 
	Version 31-03-2011 - Minh


-->





<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

    
<title>CRM Administration</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<link href="../css/ui-lightness/ff.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="../js/jquery-ui-1.8.5.custom.min.js"></script>
<script type="text/javascript" src="scripts/prototype.lite.js"></script>
<script type="text/javascript" src="scripts/moo.fx.js"></script>
<script type="text/javascript" src="scripts/moo.fx.pack.js"></script>
<script type="text/javascript" src="scripts/adminSupportFunction.js"></script>

</head>
<body onload="loadAll()">


 				<div id="tabs10">
                <ul>
                                <!-- CSS Tabs -->
<li><a href="emailist.html"><span>Email List</span></a></li>
<li><a href="Assigncandidate.html"><span>Assign Candidate</span></a></li>
<li><a href="Account.html"><span>Account</span></a></li>

                        </ul>
                </div>
                <table width="100%" border="0" id="EmailListTable">
                <!-- Search control -->
                <form id="SearchForm" name="SearchForm" method="post" action="consultantpage.php">
                <tr>
                	<td align="left">
                    <table width="550px">
                    <tr>
                    	<td><input name="txtInput" id="txtInput" type="text" size="50" maxlength="50" /></td>
                        <td align="left"><label><input name="rdSearchType" type="radio" value="Name" checked />Name </label>
                        	<label><input name="rdSearchType" type="radio" value="Date" />Date</label></td>
                        <td align="left"><input name="btnSearch" type="submit" value="Search" /></td>
                    </tr>
                    </table>
                    </td>
                </tr>
                </form>
                <!-- Header -->
                <tr>
                	<td width="100%">      
                    <table width="100%" border="0">
                    	<tr bgcolor="#999999">
                       	  <td><input name="chkCheckAll" type="checkbox" value="" />Check All</td>
                            <td>Candidate Name</td>                            
                            <td>Template</td>
                            <td>Date Sent</td>
                            <td>Notes</td>
                            <td>Send Status</td>
                            <td>Duration</td>
                            <td>Completed Status</td>
                            
                        </tr>
                        
                        
                        <?php
	
	if(isset($_POST['btnSearch']))
	{
		
		include("../db_conection/db_connect.php");	
		//check if the type of search is by name or by date
		if(isset($_POST['rdSearchType']))
		{
			
			if(!$db_con)
			{
				echo 'ERROR: Could not connect to the database.';
			}
			else 
			{	
			
				$name = $_POST['txtInput'];
				$query ="SELECT distinct(c.can_fName), t.subject, wc.date_sent, wc.comment, wc.sent_status, wc.enduration, wa.status_complete 
						FROM wfa w, wfa_template t, wfa_assignment wa, wfa_template_for_candidate wc, candidate c
						WHERE w.WFA_ID = wa.wfa_ID
						AND	  c.candidate_ID = wa.candidate_ID
						AND	  c.candidate_ID = wc.candidate_ID
						AND   wc.wfa_template_ID = t.wfa_template_ID
						AND   c.can_fName like '%" . $name . "%'"; 
				
				$dbRecords = mysql_query($query, $db_con ) 
				Or die('Query failed:'.mysql_error());
				
			
				
				
				
				while( $arrRecords = mysql_fetch_array($dbRecords)) 
				{
					
					
						echo '						
						<tr>
							<td><input name="chkCheckAll" type="checkbox" value="" /></td>
                            <td>'.$arrRecords['can_fName'].'</td>                            
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
						</tr>
						
						';
					
					
				} 
				
			
				
			}
				
		}
		else
		{
			
		}
	}


?>

                    
                    
                    
                    
                        
                    </table>              
                    </td>
                </tr>
                <!-- Content with dynamic PHP code -->
                <tr>
                	<td>
                    
                    
                    
                    
                    
                    </td>
                </tr>
                
                <!-- Fotter -->
                <tr>
                	<td></td>
                </tr>
                </table>
                
                

<script type="text/javascript">
	Element.cleanWhitespace('content');
	init();
</script>
</body>
</html><!--http://www.nyokiglitter.com/tutorials/tabs.html-->