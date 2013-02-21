
<?php
//Validation 
$booWFATempl  =0;
$booWFATemplsubject  =0;
$booWFAContent =0;
$txtWFATempl = "";
$txtWFATemplsubject = "";
$txtWFAContent = "";

//Check if the submit botton has been clicked
//is_numeric($var) will check to see if it's numbers
//preg_match('%^[A-Za-z]+$%', $var) will check to see if it's letters
//preg_match('%^[A-Za-z0-9]+$%', $var) will check to see if it's alphanumeric
if (isset($_POST["submit"]) )
{
	if ($_POST['txtWFATempl'] == NULL)
		$booWFATempl =1;
	else 
		$txtWFATempl = addslashes($_POST['txtWFATempl']);
	
	if ($_POST['txtWFATemplsubject'] == NULL) 	
	//if ($_POST['txtWFATemplTiming'] == NULL) 
	{
		$booWFATemplsubject =1;
	}
	else
		$txtWFATemplsubject = $_POST['txtWFATemplsubject'];	
		
	if ($_POST['txtWFAContent'] == NULL) 
	{
		$booWFAContent =1;
	}
	else
		$txtWFAContent = addslashes($_POST['txtWFAContent']);
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>AddWFATemplate.php</title>

<link href="../style/tablestyle.css" rel="stylesheet" type="text/css" />

<!--   TINYMCE   --- MINH --------------->
<script type="text/javascript" src="../tinymce/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript" src="../scripts/tinymce_init.js"></script>


</head>
<body>
<h1>Add New Work Flow Template <a href="#"><img src="../../image/help_icon.jpg" width="20"/></a></h1>
<form id="form1" name="form1" method="post" action='<?php echo $_SERVER["PHP_SELF"]; ?>' >
  <table width="900px" border="0" align="center">
  	<tr valign="top">
      <td width="100px" align="left">Template ID:</td>
      <td width="800px" align="left">    
                   <?php
				   //-----------------Minh-------------------------------------------
				   //-----------load the next WFA template ID -----------
				   require("../../db_conection/db_connect.php");
				   
				   //3 Construct SQL statement
					$sql1 = 'select max(wfa_template_ID) as maxID from wfa_template;';
					
					//4 Get Recordset based on SQL above
					$dbRecords1 = mysql_query($sql1, $db_con ) 
							Or die('Query failed:'.mysql_error());
						
					//execute to retrive the max value only in WFA template ID
					$arrRecords1 = mysql_fetch_array($dbRecords1);
					
					$txtWFATempl = $arrRecords1["maxID"];
					
					//rise one value 
					$txtWFATempl++;
					
					
					echo '<input name="txtWFATempl" type="text" readonly="true" style="width:500px" value="'.$txtWFATempl.'"/>';
					
					//6 Free Recordset and Close connection
					mysql_free_result($dbRecords1);					
				   ?>
			      
      
      <?php if ($booWFATempl) echo "<font color='red'>Require!</font>"?></td>
	
    </tr>
  	<tr>
      <td>Subject:</td>
      <td align="left"><input type="text" style="width:500px" name="txtWFATemplsubject" maxlength="100" value='<?php echo $txtWFATemplsubject ?>'/>
      <?php if ($booWFATemplsubject) echo "<font color='red'>Require!</font>"?></td>
	  
    </tr>
    <tr>
      <td valign="top"> Content:</td>
      <td align="left"><textarea style="width:500px" name="txtWFAContent" rows="20" value="<?php echo $txtWFAContent ?>"/>      
        </textarea>
      <?php if ($booWFAContent) echo "<font color='red'>Require!</font>"?></td>
	
    </tr>
    <tr>
		<td colspan="2" align="center"><a href="javascript:;" onMouseDown="tinyMCE.get('txtWFAContent').show();">[Show]</a>
		<a href="javascript:;" onMouseDown="tinyMCE.get('txtWFAContent').hide();">[Hide]</a></td>
	</tr>
    <tr>
      <td>&nbsp;</td>
      <td align="left"><input type="submit" name="submit" value="Submit" />        <input type="reset" name="reset" value="Clear" /></td>
    </tr>
  </table>
</form>
</body>
</html>

<?php
if ((!($booWFATempl + $booWFATemplsubject+ $booWFAContent) &&isset($_POST["submit"]) ))
{


	//3 Construct INSERT INTO SQL table
	$sqlIns = 'INSERT INTO wfa_template VALUES(NULL,"'.$txtWFATemplsubject.'", "'.$txtWFAContent.'");';
	
	$dbRecords = mysql_query($sqlIns, $db_con) 
			or die('Insert failed:'.mysql_error());
	
	//6 Free Recordset and Close connection
	//mysql_free_result($dbRecords);
	mysql_close($db_con);
	
	echo "<script language='javascript'> 
		window.location = 'ViewWFATemplate.php';
		</script>";
	die;
}
?>
