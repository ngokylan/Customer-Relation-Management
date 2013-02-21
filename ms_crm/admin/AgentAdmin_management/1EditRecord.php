<?php

//Validation new values entered
$booId =0;
$booFName =0;
$booGName =0;
$txtId = "";
$txtFName = "";
$txtGName = "";
$txtMess = "";

if (isset($_POST["submit"]) )
{
	if ($_POST['txtId'] == NULL)
		$booId =1;
	else
		$txtId = $_POST['txtId'];
	
	if ($_POST['txtFName'] == NULL)
		$booFName =1;
	else
		$txtFName = $_POST['txtFName'];
		
	if ($_POST['txtGName'] == NULL)
		$booGName =1;
	else
		$txtGName = $_POST['txtGName'];
	
	if ( !($booId + $booFName + $booGName)  )
	{
		// 1 Connect to MYSQL
		$dbConnection = mysql_connect('127.0.0.1','root','root')
				Or die('<p>Database Error</p> ' . mysql_error());
			
		// 2 Select database
		//@mysql_select_db('Web2ExerciseCRUD', $dbConnection )
		mysql_select_db('web2exercisecrud', $dbConnection )
				Or die('<p>Database Error</p> ' . mysql_error());
			
		
		//3 Construct UPDATE SQL table
		$sqlEdit = "UPDATE Person SET FamilyName ='".$txtFName."', GivenName = '".$txtGName."'
					WHERE PersonID = '".$txtId."'";
		
		mysql_query($sqlEdit, $dbConnection ) 
				or die('Update failed:'.mysql_error());
		
		//6 Free Recordset and Close connection
		//mysql_free_result($dbRecords); -> just for reading
		mysql_close($dbConnection);
		echo "<script language='javascript'>window.location = 'View.php';</script>";
		die;
	}
	else
	{
		echo '<form id="form1" name="form1" method="post" action="'.$_SERVER["PHP_SELF"].'" >
					<p><table border="1" align="center">
						<tr>
						  <td width="20">Person ID: </td>
						  <td width="70"><input type="text" name="txtId" readonly="readonly" value='.$txtId.'></td>
						</tr>
						<tr>
						  <td width="20">Family Name: </td>
						  <td width="70"><input type="text" name="txtFName" value='.$txtFName.'></td>
						</tr>
						<tr>
						  <td width="20">Given Name: </td>
						  <td width="70"><input type="text" name="txtGName" value='.$txtGName.'></td>
						</tr>
						<tr>
						  <td><input type="submit" name="submit" value="Submit" /></td>
						  <td><input type="reset" name="reset" value="Clear" /></td>
						</tr>
					</table></p></form>';
					
		echo "Please check your data, we do not accept null fields!";
		if ($booFName)
			$txtMess = " Enter a valid First name";
		echo $txtMess;
		
		if ($booGName)
			$txtMess = " Enter a valid Given name";
		echo $txtMess;
	}
}
else
{
	// 1 Connect to MYSQL
	$dbConnection = mysql_connect('127.0.0.1','root','root')
				Or die('<p>Database Error</p> ' . mysql_error());
			
	// 2 Select database
	//@mysql_select_db('Web2ExerciseCRUD', $dbConnection )
	mysql_select_db('web2exercisecrud', $dbConnection )
		Or die('<p>Database Error</p> ' . mysql_error());
		
	$txtId = $_GET['txtID'];
	
	//3 Construct SQL statement
	$sql = "select * from Person where PersonID = ".$txtId."";
	
	//4 Get Recordset based on SQL above
	$dbRecords = mysql_query($sql, $dbConnection ) 
			Or die('Query failed:'.mysql_error());
	
	$arrRecords = mysql_fetch_array($dbRecords);
	
	$txtId = $arrRecords["PersonID"];
	$txtFName = $arrRecords["FamilyName"];
	$txtGName = $arrRecords["GivenName"] ;
	
		//echo $arrRecords["PersonID"]."&nbsp".$arrRecords["FamilyName"]."&nbsp".$arrRecords["GivenName"]."</br>" ;
		echo '<form id="form1" name="form1" method="post" action="'.$_SERVER["PHP_SELF"].'" >
				<p><table border="1" align="center">
					<tr>
					  <td width="20">Person ID: </td>
					  <td width="70"><input type="text" name="txtId" readonly="readonly" value='.$txtId.'></td>
					</tr>
					<tr>
					  <td width="20">Family Name: </td>
					  <td width="70"><input type="text" name="txtFName" value='.$txtFName.'></td>
					</tr>
					<tr>
					  <td width="20">Given Name: </td>
					  <td width="70"><input type="text" name="txtGName" value='.$txtGName.'></td>
					</tr>
					<tr>
					  <td><input type="submit" name="submit" value="Submit" /></td>
					  <td><input type="reset" name="reset" value="Clear" /></td>
					</tr>
				</table></p></form>';
	//6 Free Recordset 
	mysql_free_result($dbRecords);
	// 7 Close 
	mysql_close($dbConnection);
}
?>
