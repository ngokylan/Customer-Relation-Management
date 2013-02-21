<!--June: Delete record from agent table & personal_details table
<?php 
require("../../db_conection/db_connect.php");
$txtId = $_GET['txtID'];

//Delete records from agent_has_candidate    delete FROM `agent_has_candidate` WHERE `agent_id` = 16
$sqlHasCan = "DELETE FROM `agent_has_candidate` WHERE `agent_id` = '".$txtId."'";
mysql_query($sqlHasCan, $db_con) Or die('Query failed:'.mysql_error());

//

//Get contact_ID by agent table
$sql = "SELECT * FROM `agent` WHERE `agent`.`agent_ID` = '".$txtId."'";
$dbRecords = mysql_query($sql, $db_con) Or die('Query failed:'.mysql_error());
$arrRecords = mysql_fetch_array($dbRecords);		
$contactID = $arrRecords["contact_id"];

//Delete record from agent table
$sqlDel = "DELETE FROM `agent` WHERE `agent`.`agent_ID` = '".$txtId."'";
mysql_query($sqlDel);

//Delete record from personal_details table
$sqlDel = "DELETE FROM `personal_details` WHERE `personal_details`.`contact_ID` = '".$contactID."'";
mysql_query($sqlDel);

//Close connection
mysql_close($db_con);
echo "<script language='javascript'>window.location = 'ViewAgent.php';</script>";
die;
?>