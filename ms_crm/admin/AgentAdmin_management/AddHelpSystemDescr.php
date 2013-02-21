<link href="../style/tablestyle.css" rel="stylesheet" type="text/css" />

<?php
//Validation 
$boohs_fieldID  =0;
$boohs_msg =0;
$txths_fieldID = "";
$txths_msg = "";

//Check if the submit botton has been clicked
//is_numeric($var) will check to see if it's numbers
//preg_match('%^[A-Za-z]+$%', $var) will check to see if it's letters
//preg_match('%^[A-Za-z0-9]+$%', $var) will check to see if it's alphanumeric
if (isset($_POST["submit"]) )
{
	if ($_POST['txths_fieldID'] == NULL)
		$boohs_fieldID =1;
	else 
		$txths_fieldID = $_POST['txths_fieldID'];
		
//	if (($_POST['txths_msg'] == NULL) || (!(preg_match('%^[A-Za-z]+$%', ($_POST['txths_msg']))) ))
	if ($_POST['txths_msg'] == NULL) 
	{
		$boohs_msg =1;
	}
	else
		$txths_msg = $_POST['txths_msg'];
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>AddHelpSystemDescr.php</title>

</head>
<body>
<p>&nbsp;</p>
<h1>Add new Glossary Item <a href="#"><img src="../../image/help_icon.jpg" width="20"/></a></h1>
<form id="form1" name="form1" method="post" action='<?php echo $_SERVER["PHP_SELF"]; ?>' >
  <table width="700" border="0" align="center">
  	<tr>
      <td width="238">Term:</td>
      <td width="242"><input type="text" name="txths_fieldID" maxlength="50" value='<?php echo $txths_fieldID ?>'/></td>
	  <td width="17"><?php if ($boohs_fieldID) echo "Please type the name of the Help field!" ?></td>
    </tr>
  	<tr>
      <td valign="top">Description:</td>
      <td width="350"><textarea name="txths_msg" id="txths_msg" rows="5" value='<?php echo $txths_msg ?>'></textarea></td>
	  <td width="17"><?php if ($boohs_msg) echo "Please type the description of the Help field!" ?></td>
    </tr>
    <tr>
    	<td colspan="3" align="center">
		</td>
        
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" name="submit" value="Submit" />        <input type="reset" name="reset" value="Clear" /></td>
    </tr>
  </table>
</form>
</body>
</html>

<?php
if ((!($boohs_fieldID + $boohs_msg) &&isset($_POST["submit"]) ))
{
	require("../../db_conection/db_connect.php");
	//3 Construct INSERT INTO SQL table
	$sqlIns = 'INSERT INTO help_system VALUES("'.$txths_fieldID.'", "'.$txths_msg.'");';
	
	$dbRecords = mysql_query($sqlIns, $db_con ) 
			Or die('Insert failed:'.mysql_error());
	
	//6 Free Recordset and Close connection
	mysql_free_result($dbRecords);
	mysql_close($db_con);
	echo "<script language='javascript'>window.location = 'ViewHelpSystemDescr.php';</script>";
	die;
}
?>
