<link href="../style/tablestyle.css" rel="stylesheet" type="text/css" />
<?php
//Validation new values entered
$booWFA_ID =0;
$booWFA_title = 0;
$booWFA_Descr =0;

$txtID = "";
$txtWFA_Title = "";
$txtWFA_Descr = "";
$txtMess = "";

if (isset($_POST["submit"]) )
{
	if ($_POST['txtID'] == NULL)
		$booWFA_ID =1;
	else
		$txtID = $_POST['txtID'];
		
	if ($_POST['txtTitle'] == NULL)
		$booWFA_title =1;
	else
		$txtWFA_Title = $_POST['txtTitle'];
		
	if ($_POST['txtWFA_Descr'] == NULL)
		$booWFA_Descr =1;
	else
		$txtWFA_Descr = $_POST['txtWFA_Descr'];
	
	if ( !($booWFA_ID + $booWFA_Descr)  )
	{
		require("../../db_conection/db_connect.php");
			
		
		//3 Construct UPDATE SQL table
		$sqlEdit = "UPDATE wfa SET Title = '".$txtWFA_Title."',
									Description = '".$txtWFA_Descr."'
					WHERE WFA_ID = '".$txtID."'";
		
		mysql_query($sqlEdit, $db_con ) 
				or die('Update failed:'.mysql_error());
		
		//6 Free Recordset and Close connection
		mysql_close($db_con);
		echo "<script language='javascript'>window.location = 'ViewWFACode.php';</script>";
		die;
	}
	else
	{
		echo '<form id="form1" name="form1" method="post" action="'.$_SERVER["PHP_SELF"].'" >
					<p><table border="0" align="center" width="800">
					<tr>
					  <td colspan="2" align="center"><h1>Edit Work Flow Action</h1></td>
					</tr>
					<tr align="center">
					  <td>WFA Title: </td>
					  <td width="500" align="left"><input style="width:500px" type="text" name="txtTitle" maxlength="50" value="'.$txtWFA_Title.'"></td>
					</tr>
					<tr align="center" valign="top">
					  <td>WFA Description: </td>
					  <td width="500" align="left">
					  <textarea style="width:500px" name="txtWFA_Descr" rows="20"/>'.$txtWFA_Descr.'</textarea>
					  </td>
					</tr>
					<tr>
					  <td colspan=2" align="center"><input type="submit" name="submit" value="Submit" /><input type="reset" name="reset" value="Clear" /></td>
					</tr>
				</table></p>
				<input style="width:500px" type="hidden" name="txtID" readonly="readonly" value="'.$txtID.'">
				</form>';
					
		echo "Please check your data, we do not accept null fields!";
		if ($booWFA_ID)
			$txtMess = " Enter a valid WFA ID";
		echo $txtMess;
		
		if ($booWFA_Descr)
			$txtMess = " Enter a valid WFA Description";
		echo $txtMess;
	}
}
else
{
	require("../../db_conection/db_connect.php");
		
	$txtID = $_GET['txtID'];
	
	//3 Construct SQL statement
	$sql = "select * from wfa where WFA_ID = '".$txtID."';";
	
	//4 Get Recordset based on SQL above
	$dbRecords = mysql_query($sql, $db_con) Or die('Query failed:'.mysql_error());

	$arrRecords = mysql_fetch_array($dbRecords);
	
	$txtID = $arrRecords["WFA_ID"];
	$txtWFA_Title = $arrRecords["Title"] ;
	$txtWFA_Descr = $arrRecords["Description"] ;
	
		echo '<form id="form1" name="form1" method="post" action="'.$_SERVER["PHP_SELF"].'" >
				<p><table border="0" align="center" width="800">
					<tr>
					  <td colspan="2" align="center"><h1>Edit Work Flow Action <a href="#"><img src="../../image/help_icon.jpg" width="20"/></a></h1></td>
					</tr>
					<tr align="center">
					  <td>WFA Name: </td>
					  <td width="500" align="left"><input style="width:500px" type="text" name="txtTitle" maxlength="50" value="'.$txtWFA_Title.'"></td>
					</tr>
					<tr align="center" valign="top">
					  <td>WFA Description: </td>
					  <td width="500" align="left">
					  <textarea style="width:500px" name="txtWFA_Descr" rows="20"/>'.$txtWFA_Descr.'</textarea>
					  </td>
					</tr>
					<tr>
					  <td colspan=2" align="center"><input type="submit" name="submit" value="Submit" /><input type="reset" name="reset" value="Clear" /></td>
					</tr>
				</table></p>
				<input style="width:500px" type="hidden" name="txtID" readonly="readonly" value="'.$txtID.'">
				</form>';
	//6 Free Recordset 
	mysql_free_result($dbRecords);
	// 7 Close 
	mysql_close($db_con);
}
?>
