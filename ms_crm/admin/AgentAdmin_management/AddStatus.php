<link href="../style/tablestyle.css" rel="stylesheet" type="text/css" />
<?php
//Validation 
$booStatus_ID  =0;
$boost_shortDescr =0;
$boost_longDescr =0;
$txtStatus_ID = "";
$txtst_shortDescr = "";
$txtst_longDescr = "";


//Check if the submit botton has been clicked
//is_numeric($var) will check to see if it's numbers
//preg_match('%^[A-Za-z]+$%', $var) will check to see if it's letters
//preg_match('%^[A-Za-z0-9]+$%', $var) will check to see if it's alphanumeric
if (isset($_POST["submit"]) )
{
	if ($_POST['txtStatus_ID'] == NULL)
		$booStatus_ID =1;
	else 
		$txtStatus_ID = $_POST['txtStatus_ID'];
		
//	if (($_POST['txtst_shortDescr'] == NULL) || (!(preg_match('%^[A-Za-z]+$%', ($_POST['txtst_shortDescr']))) ))
	if ($_POST['txtst_shortDescr'] == NULL) 
		$boost_shortDescr =1;
	else
		$txtst_shortDescr = $_POST['txtst_shortDescr'];
	
	if ($_POST['txtst_longDescr'] == NULL) 
		$boost_longDescr =1;
	else
		$txtst_longDescr = $_POST['txtst_longDescr'];
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>AddStatus.php</title>

</head>
<body>
<h1>Add Work Status <a href="#"><img src="../../image/help_icon.jpg" width="20"/></a></h1></h1>
<center>
<form id="form1" name="form1" method="post" action='<?php echo $_SERVER["PHP_SELF"]; ?>' >
  <table width="500" border="0" align="center">
  	<tr>
      <td width="100">Status ID:</td>
      <td width="350"><input type="text" name="txtStatus_ID" maxlength="5" value='<?php echo $txtStatus_ID ?>'/></td>
	  <td width="50"><?php if ($booStatus_ID) echo "Please type the name of the Help field!" ?></td>
    </tr>
  	<tr>
      <td>Status Title:</td>
      <td><input width="400" type="text" name="txtst_shortDescr" maxlength="100" value='<?php echo $txtst_shortDescr ?>'/></td>
	  <td><?php if ($boost_shortDescr) echo "Please type the status title!" ?></td>
    </tr>
    <tr>
      <td>Description:</td>
      <td> <textarea name="txtst_longDescr" cols="" rows="4"><?php echo $txtst_longDescr ?></textarea>  
    </td>
	  <td><?php if ($boost_longDescr) echo "Please type the description!" ?></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" name="submit" value="Submit" />        <input type="reset" name="reset" value="Clear" /></td>
    </tr>
  </table>
  </form>
</center>
</body>
</html>

<?php
if ((!($booStatus_ID + $boost_shortDescr + $boost_longDescr) &&isset($_POST["submit"]) ))
{
	require("../../db_conection/db_connect.php");
	
	//3 Construct INSERT INTO SQL table
	$sqlIns = 'INSERT INTO status VALUES("'.$txtStatus_ID.'", "'.$txtst_shortDescr.'", "'.$txtst_longDescr.'");';
	
	$dbRecords = mysql_query($sqlIns, $db_con ) 
			Or die('Insert failed:'.mysql_error());
	
	//6 Free Recordset and Close connection
	mysql_free_result($dbRecords);
	mysql_close($db_con);
	echo "<script language='javascript'>window.location = 'ViewStatus.php';</script>";
	die;
}
?>
