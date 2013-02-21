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

//3 Construct SQL statement
$sql = "select * from Person where PersonID = ".$txtId."";

//4 Get Recordset based on SQL above
$dbRecords = mysql_query($sql, $dbConnection ) 
		Or die('Query failed:'.mysql_error());

$arrRecords = mysql_fetch_array($dbRecords);

    //echo $arrRecords["PersonID"]."&nbsp".$arrRecords["FamilyName"]."&nbsp".$arrRecords["GivenName"]."</br>" ;
	echo '<p><table border="0" align="center">
				<tr>
				  <td width="20">Person ID: </td>
				  <td width="70">'.$arrRecords["PersonID"].'</td>
				</tr>
				<tr>
				  <td width="20">Family Name: </td>
				  <td width="70"><input type="text" name="txtFName" value='.$arrRecords["FamilyName"].'/></td>
				</tr>
				<tr>
				  <td width="20">Given Name: </td>
				  <td width="70"><input type="text" name="txtFName" value='.$arrRecords["GivenName"].'/></td>
				</tr>
				<tr>
				  <td><input type="submit" name="submit" value="Submit" /></td>
      			  <td><input type="reset" name="reset" value="Clear" /></td>
				</tr>
			</table>
		</p>';


//6 Free Recordset 
mysql_free_result($dbRecords);

//Validation new values entered
$booFName =0;
$booGName =0;
$txtId = $arrRecords["PersonID"];
$txtFName = $arrRecords["FamilyName"];
$txtGName = $arrRecords["GivenName"];

if ($txtId == NULL)
	$booId =1;

if ($txtFName == NULL || (!(is_numeric($txtFName))) )
	$booFName =1;
		
//if (($_POST['txtTutMark'] == NULL) || (!(is_numeric($_POST['txtTutMark'])) ))
if ($txtGName == NULL || (!(is_numeric($txtGName))) )
	$booGName =1;
//die;
if ( !($booId + $booFName + $booGName)  )
{
	//3 Construct UPDATE SQL table
	$sqlEdit = "UPDATE Person SET(".$txtFName.", ".$txtGName.")
				WHERE PersonID = ".$txtId."";
	
	mysql_query($sqlEdit, $dbConnection ) 
			or die('Update failed:'.mysql_error());
	
	//6 Free Recordset and Close connection
	//mysql_free_result($dbRecords); -> just for reading
	mysql_close($dbConnection);
	echo "<script language='javascript'>window.location = 'View.php';</script>";
	die;
}
?>
