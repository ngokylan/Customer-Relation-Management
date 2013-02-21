<link href="../style/tablestyle.css" rel="stylesheet" type="text/css" />
</style><h1>Work Status List <a href="#"><img src="../../image/help_icon.jpg" width="20"/></a></h1>
<table id="gradient-style" summary="Work Flow Action Code" align="center">
    <thead>
   	  <tr>
			<th scope="col">Status ID</th>
            <th scope="col">Title</th>
            <th scope="col">Description</th>
            <th scope="col"></th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tfoot>
   	  <tr>
        <td></td>
        <td></td>
        <td></td>
        <td colspan="2" align="center"><a href="AddStatus.php">Add New Record</a></td>
      </tr>
    </tfoot>
    <tbody>
<?php
// 1 Connect to MYSQL
$dbConnection = mysql_connect('isync.zzl.org','435606_isyncuser','CIT27AIsync')
		Or die('<p>Database Error</p> ' . mysql_error());
		
// 2 Select database
mysql_select_db('isync_zzl_crmdatabase', $dbConnection )
	Or die('<p>Database Error</p> ' . mysql_error());

//3 Construct SQL statement
$sql = 'select * from status order by status_ID;';

//4 Get Recordset based on SQL above
$dbRecords = mysql_query($sql, $dbConnection ) 
		Or die('Query failed:'.mysql_error());

//5 Loop through records
while( $arrRecords = mysql_fetch_array($dbRecords)) 
{
	$arrRecords["status_ID"]."&nbsp".$arrRecords["st_shortDescr"]."&nbsp".$arrRecords["st_longDescr"]."</br>" ;
	echo '
				<tr>
				  <td width="50">'.$arrRecords["status_ID"].'</td>
				  <td width="300">'.$arrRecords["st_shortDescr"].'</td>
				  <td width="300">'.$arrRecords["st_longDescr"].'</td>
				  <td><a href="EditStatus.php?txtID='.$arrRecords["status_ID"].'">Edit</a></td>
				  <td><a href="DeleteStatus.php?txtID='.$arrRecords["status_ID"].'">Delete</a></td>
				</tr>
			';
}
//6 Free Recordset and Close connection
mysql_free_result($dbRecords);
mysql_close($dbConnection);
?>
  </tbody>
</table>