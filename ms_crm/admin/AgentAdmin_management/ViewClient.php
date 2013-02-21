<link href="../style/tablestyle.css" rel="stylesheet" type="text/css" /></style>
<table id="gradient-style" style="width:700"  summary="Client List" align="center">
    <thead>
   	  	<tr>
        <!--June: change name of the Head (First Name   Surname  =>  Contact Name) -->   
            <th width="180" scope="col">Contact Name</th>
            <th width="164" scope="col">Company</th>
        <!--June: insert field for E-mail Address --> 
            <th width="164" scope="col">E-mail</th>
            <th width="160" scope="col">Mobile</th>
            <th width="102" scope="col">Phone</th>
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
$sql = 'SELECT * FROM `client`';

//4 Get Recordset based on SQL above
$dbRecords = mysql_query($sql, $db_con ) 
		Or die('Query failed:'.mysql_error());

//5 Loop through records
while( $arrRecords = mysql_fetch_array($dbRecords)) 
{	

// June: Get E-mail address from personal_details
$contactId = $arrRecords["contact_id"];
$sqlContact = "SELECT * FROM `personal_details` WHERE `personal_details`.`contact_id` = '$contactId'";
$dbRecord = mysql_query($sqlContact, $db_con ) 
		Or die('Query failed:'.mysql_error());
$row = mysql_fetch_assoc($dbRecord);

$eMail = $row["cont_email"];
$mobile = $row["cont_mobile"];
$phone = $row["cont_phone"];
// June: merge column 
// June: change format for Agent name (FirstName   Surname  => Firstname, Surname) 	
echo '		<tr>
					<td>'.$arrRecords["cl_fName"].trim(",&nbsp;").$arrRecords["cl_lName"].'</td>	
				  	<td>'.$arrRecords["cl_Company"].'</td>
					<td>'.$eMail.'</td>
					<td>'.$mobile.'</td>
					<td>'.$phone.'</td>
					<td><a href="EditClient.php?txtID='.$arrRecords["client_ID"].'">Edit</a></td>
					<td><a href="DeleteClient.php?txtID='.$arrRecords["client_ID"].'" onclick="return confirm(\'Are you sure you want to delete the client?\');">Delete</a></td>
				</tr>';
}
//6 Free Recordset and Close connection
mysql_free_result($dbRecords);

mysql_close($db_con);
?>
  </tbody>
</table>
