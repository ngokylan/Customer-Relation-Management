<link href="../style/tablestyle.css" rel="stylesheet" type="text/css" />
<?php
//Validation new values entered
$boohs_fieldID =0;
$boohs_msg =0;
$txths_fieldID = "";
$txths_msg = "";
$txtMess = "";

if (isset($_POST["submit"]) )
{
	if ($_POST['txths_fieldID'] == NULL)
		$boohs_fieldID =1;
	else
		$txths_fieldID = addslashes($_POST['txths_fieldID']);
	
	if ($_POST['txths_msg'] == NULL)
		$boohs_msg =1;
	else
		$txths_msg = addslashes($_POST['txths_msg']);
		
	if ( !($boohs_fieldID + $boohs_msg)  )
	{
		require("../../db_conection/db_connect.php");
			
		//3 Construct UPDATE SQL table
		$sqlEdit = "UPDATE help_system SET hs_msg ='".$txths_msg."'
					WHERE hs_fieldID = '".$txths_fieldID."';";
		
		mysql_query($sqlEdit, $db_con ) 
				or die('Update failed:'.mysql_error());
		
		//6 Free Recordset and Close connection
		//mysql_free_result($dbRecords); -> just for reading
		mysql_close($db_con);
		echo "<script language='javascript'>window.location = 'ViewHelpSystemDescr.php';</script>";
		die;
	}
	else
	{
		echo '<form id="form1" name="form1" method="post" action="'.$_SERVER["PHP_SELF"].'" >
					<p><table width="400" border="0" align="center">
						<tr>
						  <td width="200px">Term: </td>
						  <td width="200"><input type="text" name="txths_fieldID" readonly="readonly" value='.$txths_fieldID.'></td>
						</tr>
						<tr>
						  <td width="200px" valign="top">Description: </td>
						  <td width="800"><textarea name="txths_msg" cols="50" rows="5">'.$txths_msg.'</textarea>
						  				 <!-- <input type="text" name="txths_msg" maxlength="300" value='.$txths_msg.'>--></td>
						</tr>
						<tr>
						  <td></td>
						  <td><input type="submit" name="submit" value="Submit" /><input type="reset" name="reset" value="Clear" /></td>
						</tr>
					</table></p></form>';
					
		echo "Please check your data, we do not accept null fields!";
		if ($boohs_msg)
			$txtMess = " Enter a valid Description";
		echo $txtMess;
	}
}
else
{
	require("../../db_conection/db_connect.php");
		
	$txths_fieldID = $_GET['txths_fieldID'];
	
	//3 Construct SQL statement
	$sql = "select * from help_system where hs_fieldID = ".$txths_fieldID.";";
	
	//4 Get Recordset based on SQL above
	$dbRecords = mysql_query($sql, $db_con ) 
			Or die('Query failed:'.mysql_error());
	
	$arrRecords = mysql_fetch_array($dbRecords);
	
	$txths_fieldID = $arrRecords["hs_fieldID"];
	$txths_msg = $arrRecords["hs_msg"];

		//echo $arrRecords["PersonID"]."&nbsp".$arrRecords["FamilyName"]."&nbsp".$arrRecords["GivenName"]."</br>" ;
		echo '<form id="form1" name="form1" method="post" action="'.$_SERVER["PHP_SELF"].'" >
				<p><table width="400" border="0" align="center">
					<tr>
						<td colspan="2"><h1 align="center">Add new Glossary Item <a href="#"><img src="../../image/help_icon.jpg" width="20"/></a></h1></td>
					</tr>
					<tr>
					  <td width="200px">Term: </td>
					  <td width="800"><input type="text" name="txths_fieldID" readonly="readonly" value="'.$txths_fieldID.'"></td>
					</tr>
					<tr>
					  <td width="200px" valign="top">Description: </td>
					  <td width="800"><textarea name="txths_msg" cols="50" rows="5">'.$txths_msg.'</textarea>
					  					<!--<input type="text" name="txths_msg" maxlength="300" value='.$txths_msg.'>-->
						</td>
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
