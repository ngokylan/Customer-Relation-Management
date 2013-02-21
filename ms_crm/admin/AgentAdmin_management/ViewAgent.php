<link href="../style/tablestyle.css" rel="stylesheet" type="text/css" /></style>
<table id="gradient-style" style="width:700"  summary="Agent List" align="center">
    <thead>
   	  	<tr>
        <!--June: change name of the Head (First Name   Surname  =>  Contact Name) -->   
            <th width="180" scope="col">Contact Name</th>
            <th width="164" scope="col">Password</th>
        <!--June: insert field for E-mail Address --> 
            <th width="164" scope="col">E-mail</th>
            <th width="160" scope="col">Access Level</th>
            <th width="102" scope="col">Status</th>
            <th width="30" scope="col"></th>
            <th width="33" scope="col"><a href="#"><img src="../../image/help_icon.jpg" width="20"/></a></th>
		</tr>
    </thead>
    <tfoot>
   	  	<tr>
        <!--June: Merge column-->
            <td width="180"></td>
            <td></td>
        <!--June: insert column-->
            <td></td>
            <td></td>
            <td></td>
            <td colspan="2" align="center"></td>
       	</tr>
    </tfoot>
    <tbody>
 
<?php
require("../../db_conection/db_connect.php");
//3 Construct SQL statement
$sql = 'SELECT * FROM `agent`';

//4 Get Recordset based on SQL above
$dbRecords = mysql_query($sql, $db_con ) 
		Or die('Query failed:'.mysql_error());

//5 Loop through records
while( $arrRecords = mysql_fetch_array($dbRecords)) 
{
	if ($arrRecords["ag_levelAccess"] =="1"){
		$strLevelAccess = "Administrator";
		}else{
			$strLevelAccess = "User";}
			
	if ($arrRecords["ag_logAttempts"] >= 3){
		$status="Locked";
	}else{
		$status="Unlock";
	}

// June: Get E-mail address from personal_details
$contactId = $arrRecords["contact_id"];
$sqlEmail = "SELECT `cont_email` FROM `personal_details` WHERE `personal_details`.`contact_id` = '$contactId'";
$dbRecord = mysql_query($sqlEmail, $db_con ) Or die('Query failed:'.mysql_error());
$row = mysql_fetch_assoc($dbRecord);

$eMail = $row["cont_email"];

//---------------------------------------------------------------------------------//
// June: merge column 
//       change format for Agent name (FirstName   Surname  => Firstname, Surname) 	
//       display confirm message 
echo '		<tr>
					<td>'.$arrRecords["ag_fName"].trim(",&nbsp;").$arrRecords["ag_lName"].'</td>	
				  	<td>'.$arrRecords["ag_password"].'</td>
					<td>'.$eMail.'</td>
					<td>'.$strLevelAccess.'</td>
					<td>'.$status.'</td>
					<td><a href="EditAgent.php?txtID='.$arrRecords["agent_ID"].'">Edit</a></td>
					<td><a href="DeleteAgent.php?txtID='.$arrRecords["agent_ID"].'"onclick="return confirm(\'Are you sure you want to delete the agent?\n The record will be deleted and unrecoverable\');">Delete</a></td>
</tr>';
}
//6 Free Recordset and Close connection
mysql_free_result($dbRecords);

mysql_close($db_con);
?>
  </tbody>
</table>
