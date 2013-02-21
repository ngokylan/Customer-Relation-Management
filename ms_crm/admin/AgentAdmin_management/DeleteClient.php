
<!--Prograsm: DeleteClient.php by June01/05/2011
			  Delete record from client table & personal_details table
<?php 
require("../../db_conection/db_connect.php");
$txtId = $_GET['txtID'];

//Delete records from client_has_candidate
$sqlHasClient = "DELETE FROM `client_has_candidate` WHERE `client_id` = '".$txtId."'";
mysql_query($sqlHasClient, $db_con) Or die('Query failed:'.mysql_error());

//Get contact_ID by agent table
$sql = "SELECT * FROM `client` WHERE `client`.`client_ID` = '".$txtId."'";
$dbRecords = mysql_query($sql, $db_con) Or die('Query failed:'.mysql_error());
$arrRecords = mysql_fetch_array($dbRecords);		
$contactID = $arrRecords["contact_id"];

//Delete record from agent table
$sqlDel = "DELETE FROM `client` WHERE `client`.`client_ID` = '".$txtId."'";
mysql_query($sqlDel);

//Delete record from personal_details table
$sqlDel = "DELETE FROM `personal_details` WHERE `personal_details`.`contact_ID` = '".$contactID."'";
mysql_query($sqlDel);

//Close connection
mysql_close($db_con);
echo "<script language='javascript'>window.location = 'ViewClient.php';</script>";
die;
?>