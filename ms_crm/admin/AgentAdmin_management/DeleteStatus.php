<?php
require("../../db_conection/db_connect.php");
$txtId = $_GET['txtID'];

//3 Construct DELETE record INTO SQL table
$sqlDel = "DELETE FROM `crmdatabase`.`status` WHERE `status`.`status_ID` = '".$txtId."'";

//6 Put my sql in a query Recordset 
//mysql_free_result($dbRecords);
mysql_query($sqlDel);

//7 Close connection
mysql_close($db_con);
echo "<script language='javascript'>window.location = 'ViewStatus.php';</script>";
die;
?>
