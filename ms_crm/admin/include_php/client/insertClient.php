<?php	
$strStNumber 	= addslashes($_GET['streetNumber']);
$strStName 		= addslashes($_GET['streetName']);
$strCity 		= addslashes($_GET['city']);
$strState 		= addslashes($_GET['state']);
$strZip 		= addslashes($_GET['postCode']);

$strCountry 	= addslashes($_GET['country']);
$strMobile 		= addslashes($_GET['mobile']);
$strPhone 		= addslashes($_GET['phone']);

$strCurrentComp = "";
$strWorkPhone 	= "";
$strWorkFax 	= "";

$strFirstName 	= addslashes($_GET['firstName']);
$strSurname 	= addslashes($_GET['surname']);
$strCompany 	= addslashes($_GET['company']);

echo "Test";
require("../../../db_conection/db_connect.php");
$contactID=NULL;
while  ($contactID == NULL){
	$sql = "SELECT `contact_ID` FROM `contact_details` WHERE `cont_streetNo` LIKE '$strStNumber' AND `cont_street` LIKE '$strStName' AND `cont_city` LIKE '$strCity' limit 1";
	$dbRecords = mysql_query($sql, $db_con) or die('<br /> Query failed'.mysql_error());
	while($result = mysql_fetch_array($dbRecords)) 
	{
		$contactID = $result[0];
	}
		if ($contactID == NULL){
			$sql="INSERT INTO `crmdatabase`.`contact_details` 
		(`contact_ID`, `cont_streetNo`, `cont_street`,  `cont_city`, `cont_zip`,`cont_state`, `cont_country`,  `cont_mobile`, `cont_homePhone`, `cont_companyName`,  `cont_workPhone`, `cont_workFax`) 
			VALUES 
		(NULL, '$strStNumber', '$strStName',  '$strCity', $strZip,'$strState', '$strCountry',  '$strMobile', '$strPhone', '$strCurrentComp',  '$strWorkPhone', '$strWorkFax')";
		mysql_query($sql) or die('<br /> Query failed :'.mysql_error());
		}else{
			//echo $contactID;
		}
}

$sql="INSERT INTO `crmdatabase`.`client` (`client_ID`, `cl_fName`, `cl_lName`,`cl_Company`, `contact_id`) VALUES 
(NULL, '$strFirstName','$strSurname','$strCompany', '$contactID')";

mysql_query($sql)or die('<br /> Query failed'.mysql_error());
echo "Insert Client Success";
mysql_close($db_con);
?>