<link href="../style/tablestyle.css" rel="stylesheet" type="text/css" />
</style>
<h1>Glossary <a href="#"><img src="../../image/help_icon.jpg" width="20"/></a></h1>
<table id="gradient-style" summary="Work Flow Action Code" align="center">
    <thead>
   	  <tr>
			<th scope="col">Term</th>
            <th scope="col">Description</th>
            <th scope="col"></th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tfoot>
   	  <tr>
        <td ></td>
        <td colspan="3" align="right"><a href="AddHelpSystemDescr.php">Add New Record</a></td>
      </tr>
    </tfoot>
    <tbody>
<?php
require("../../db_conection/db_connect.php");

//3 Construct SQL statement
$sql = 'select * from help_system order by hs_fieldID;';

//4 Get Recordset based on SQL above
$dbRecords = mysql_query($sql, $db_con ) 
		Or die('Query failed:'.mysql_error());

//5 Loop through records
while( $arrRecords = mysql_fetch_array($dbRecords)) 
{
	$arrRecords["hs_fieldID"]."&nbsp".$arrRecords["hs_msg"]."</br>" ;
	echo '
				<tr>
				  <td width="200">'.$arrRecords["hs_fieldID"].'</td>
				  <td width="800">'.$arrRecords["hs_msg"].'</td>
				  <td><a href="EditHelpSystemDescr.php?txths_fieldID=\''.$arrRecords["hs_fieldID"].'\'">Edit</a></td>
				  <td></td>
				</tr>
		';
}

//6 Free Recordset and Close connection
mysql_free_result($dbRecords);
mysql_close($db_con);
?>
  </tbody>
</table>