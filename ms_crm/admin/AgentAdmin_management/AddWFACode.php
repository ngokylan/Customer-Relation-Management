
<?php
//Validation 
$booWFACode  =0;
$booWFADescr =0;
$booWFATitle = 0;
$txtWFACode = "";
$txtWFADescr = "";
$txtWFATitle = "";

	//Check if the submit botton has been clicked
	//is_numeric($var) will check to see if it's numbers
	//preg_match('%^[A-Za-z]+$%', $var) will check to see if it's letters
	//preg_match('%^[A-Za-z0-9]+$%', $var) will check to see if it's alphanumeric
	if (isset($_POST["submit"]) )
	{
		if ($_POST['txtWFACode'] == NULL)
			$booWFACode =1;
		else 
			$txtWFACode = $_POST['txtWFACode'];
			
		if ($_POST['txtWFATitle'] == NULL)
			$booWFATitle =1;
		else 
			$txtWFATitle = $_POST['txtWFATitle'];
			
		if ($_POST['txtWFADescr'] == NULL) 
		{
			$booWFADescr =1;
		//	$txtWFADescr = $_POST['txtWFADescr'];
		}
		else
			$txtWFADescr = $_POST['txtWFADescr'];
				
	}
	
	
	//-----------------Minh-------------------------------------------
	   //-----------load the next WFA ID -----------
	   require("../../db_conection/db_connect.php");
	   
	   //3 Construct SQL statement
		$sql1 = 'select max(WFA_ID) as maxID from wfa;';
		
		//4 Get Recordset based on SQL above
		$dbRecords1 = mysql_query($sql1, $db_con ) 
				Or die('Query failed:'.mysql_error());
			
		//execute to retrive the max value only in WFA template ID
		$arrRecords1 = mysql_fetch_array($dbRecords1);
		
		$txtWFA = $arrRecords1["maxID"];
		
		//rise one value 
		$txtWFA++;
		
		
		
		
		//6 Free Recordset and Close connection
		mysql_free_result($dbRecords1);			
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>AddWFACode.php</title>
<link href="../style/tablestyle.css" rel="stylesheet" type="text/css" />
</head>
<body>
<p>&nbsp;</p>
<h1>Add a New WFA code <a href="#"><img src="../../image/help_icon.jpg" width="20"/></a></h1>
<form id="form1" name="form1" method="post" action='<?php echo $_SERVER["PHP_SELF"]; ?>' >
  <table width="800" border="0" align="center">
  	<tr>
      <td align="right"></td>
      <td align="left"><input style="width:500px" type="hidden" readonly="readonly" name="txtWFACode" maxlength="10" value='<?php echo $txtWFA ?>'/>
	 <?php if ($booWFACode) echo "<font color='red'>Require!</font>"?></td>
    </tr>
    <tr>
      <td align="right">WFA Name:</td>
      <td align="left"><input style="width:500px" type="text" name="txtWFATitle" maxlength="50" value="<?php echo $txtWFATitle ?>"/>
	 <?php if ($booWFATitle) echo "<font color='red'>Require!</font>"; ?></td>
    </tr>
    <tr valign="top">
      <td align="right">WFA Description:</td>
      <td align="left" valign="top"><textarea name="txtWFADescr" cols="" rows="20"></textarea>
	 <?php if ($booWFADescr) echo "<font color='red'>Require!</font>"; ?></td>
    </tr>
    <tr>
      <td align="center" colspan="2"><input type="submit" name="submit" value="Submit" />        <input type="reset" name="reset" value="Clear" /></td>
    </tr>
  </table>
</form>
</body>
</html>

<?php
if ((!($booWFACode + $booWFADescr) &&isset($_POST["submit"]) ))
{
	

	//3 Construct INSERT INTO SQL table
	$sqlIns = 'INSERT INTO wfa (Title, Description) VALUES("'.$txtWFATitle.'", "'.$txtWFADescr.'");';
	
	$dbRecords = mysql_query($sqlIns, $db_con ) 
			Or die('Insert failed:'.mysql_error());
	
	//6 Free Recordset and Close connection
	mysql_free_result($dbRecords);
	mysql_close($db_con);
	echo "<script language='javascript'>window.location = 'ViewWFACode.php';</script>";
    die;
}
?>
