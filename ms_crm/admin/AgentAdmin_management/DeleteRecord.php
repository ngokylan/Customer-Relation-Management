<?php
echo $_GET['txtID'];
 
// 1 Connect to MYSQL
$dbConnection = mysql_connect('127.0.0.1','root','root')
 			Or die('<p>Database Error</p> ' . mysql_error());
		
// 2 Select database
//@mysql_select_db('Web2ExerciseCRUD', $dbConnection )
mysql_select_db('web2exercisecrud', $dbConnection )
	Or die('<p>Database Error</p> ' . mysql_error());

$txtId = $_GET['txtID'];

//3 Construct DELETE record INTO SQL table
$sqlDel = "DELETE FROM Person WHERE PersonID = ".$txtId."";

//6 Put my sql in a query Recordset 
//mysql_free_result($dbRecords);
mysql_query($sqlDel);

//7 Close connection
mysql_close($dbConnection);
echo "<script language='javascript'>window.location = 'View.php';</script>";
die;
?>
