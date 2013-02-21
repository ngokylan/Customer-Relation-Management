<link href="../style/tablestyle.css" rel="stylesheet" type="text/css" />
<?php
//Validation new values entered
$booStatus_ID =0;
$boost_longDescr =0;
$boost_shortDescr =0;
$txtID = "";
$txtst_longDescr = "";
$txtst_shortDescr = "";
$txtMess = "";

if (isset($_POST["submit"]) )
{
	if ($_POST['txtID'] == NULL)
		$booStatus_ID =1;
	else
		$txtID = $_POST['txtID'];
		
	if ($_POST['txtst_longDescr'] == NULL)
		$boost_longDescr =1;
	else
		$txtst_longDescr = $_POST['txtst_longDescr'];
	
	if ($_POST['txtst_shortDescr'] == NULL)
		$boost_shortDescr =1;
	else
		$txtst_shortDescr = $_POST['txtst_shortDescr'];
		
	
	if ( !($booStatus_ID + $boost_longDescr + $boost_shortDescr)  )
	{
		require("../../db_conection/db_connect.php");
			
		
		//3 Construct UPDATE SQL table
		$sqlEdit = "UPDATE `status` SET `st_shortDescr` = '".$txtst_shortDescr."', `st_longDescr` = '".$txtst_longDescr."' WHERE `status`.`status_ID` = '".$txtID."';";
		//$sqlEdit = "UPDATE wfa_code SET st_longDescr = '".$txtst_longDescr."'	WHERE wfa_ID = '".$txtID."'";
		
		mysql_query($sqlEdit, $db_con ) 
				or die('Update failed:'.mysql_error());
		
		//6 Free Recordset and Close connection
		mysql_close($db_con);
		echo "<script language='javascript'>window.location = 'ViewStatus.php';</script>";
		die;
	}
	else
	{
		echo '<form id="form1" name="form1" method="post" action="'.$_SERVER["PHP_SELF"].'" >
					<p><table border="0" align="center">
						<tr>
							<td colspan="2"><h1 align="center">Edit Work Status <a href="#"><img src="../../image/help_icon.jpg" width="20"/></a></h1></td>
						</tr>
						<tr>
						  <td>Status ID: </td>
						  <td width="50"><input type="text" name="txtID" readonly="readonly" value='.$txtID.'></td>
						</tr>
						<tr>
						  <td>Status Label: </td>
						  <td width="200"><input type="text" name="txtst_shortDescr" maxlength="30" value='.$txtst_shortDescr.'></td>
						</tr>
						<tr>
						  <td vAlign="top">Status Description: </td>
						  <td width="200">
						  <textarea name="txtst_longDescr" cols="" rows="4">'.$txtst_longDescr.'</textarea>  
						</tr>
						<tr>
						  <td></td>
						  <td><input type="submit" name="submit" value="Submit" /><input type="reset" name="reset" value="Clear" /></td>
						</tr>
					</table></p></form>';
					
		echo "Please check your data, we do not accept null fields!";
		if ($booStatus_ID)
			$txtMess = " Enter a valid Status ID";
		echo $txtMess;
		
		if ($boost_shortDescr)
			$txtMess = " Enter a valid Status Label";
		echo $txtMess;
		
		if ($boost_longDescr)
			$txtMess = " Enter a valid Status Description";
		echo $txtMess;
	}
}
else
{
	require("../../db_conection/db_connect.php");
		
	$txtID = $_GET['txtID'];
	
	//3 Construct SQL statement
	$sql = "SELECT *  FROM `status` WHERE `status_ID` LIKE '".$txtID."';";
	//$sql = "select * from wfa_code where wfa_ID = '".$txtID."';";
	
	//4 Get Recordset based on SQL above
	$dbRecords = mysql_query($sql, $db_con) Or die('Query failed:'.mysql_error());

	$arrRecords = mysql_fetch_array($dbRecords);
	
	$txtID = $arrRecords["status_ID"];
	$txtst_shortDescr = $arrRecords["st_shortDescr"];
	$txtst_longDescr = $arrRecords["st_longDescr"];
	
	
		echo '<form id="form1" name="form1" method="post" action="'.$_SERVER["PHP_SELF"].'" >
				<p><table border="0" align="center">
					<tr>
							<td colspan="2"><h1 align="center">Edit Work Status <a href="#"><img src="../../image/help_icon.jpg" width="20"/></a></h1></td>
						</tr>
					<tr>
					  <td>Status ID: </td>
					  <td width="50"><input type="text" name="txtID" readonly="readonly" value='.$txtID.'></td>
					</tr>
					<tr>
						  <td>Status Title: </td>
						  <td width="200"><input type="text" name="txtst_shortDescr" maxlength="30" value='.$txtst_shortDescr.'></td>
					</tr>
					<tr>
					  <td vAlign="top">Description: </td>
					  <td width="200">
					  <textarea name="txtst_longDescr" cols="" rows="4">'.$txtst_longDescr.'</textarea>  
					</tr>
					<tr>
					  <td></td>
					  <td><input type="submit" name="submit" value="Submit" /><input type="reset" name="reset" value="Clear" /></td>
					</tr>
				</table></p></form>';
	//6 Free Recordset 
	mysql_free_result($dbRecords);
	// 7 Close 
	mysql_close($db_con);
}
?>
