<link href="../style/tablestyle.css" rel="stylesheet" type="text/css" />

<!--   TINYMCE   --- MINH --------------->
<script type="text/javascript" src="../tinymce/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript" src="../scripts/tinymce_init.js"></script>

<?php
//Validation new values entered
$booWFATempl =0;
$booWFATemplTiming =0;
$booWFAContent =0;
$txtWFATempl = "";
$txtWFATemplTiming = "";
$txtWFAContent = "";
$txtMess = "";

$booWFATempl  =0;
$booWFATemplTiming  =0;
$booWFAContent =0;
$txtWFATempl = "";
$txtWFATemplTiming = "";
$txtWFAContent = "";

if (isset($_POST["submit"]) )
{
	if ($_POST['txtWFATempl'] == NULL)
		$booWFATempl =1;
	else
		$txtWFATempl = addslashes($_POST['txtWFATempl']);
	
	//if ($_POST['txtWFATemplTiming'] == NULL)
	if ($_POST['txtWFAsubject'] == NULL)	
		$txtWFAsubject =1;
	else
		$txtWFAsubject = addslashes($_POST['txtWFAsubject']);
		
	if ($_POST['txtWFAContent'] == NULL)
		$booWFAContent =1;
	else
		$txtWFAContent = addslashes($_POST['txtWFAContent']);
	
	if ( ($booWFATempl + $booWFAContent + $booWFAContent) == 0  )
	{
		require("../../db_conection/db_connect.php");
			
		
		//3 Construct UPDATE SQL table
		$sqlEdit = "UPDATE wfa_template SET subject ='".$txtWFAsubject."', content = '".$txtWFAContent."' WHERE wfa_template_ID = '".$txtWFATempl."';";
		
		mysql_query($sqlEdit, $db_con ) or die('Update failed:'.mysql_error());
		
		//6 Free Recordset and Close connection
		//mysql_free_result($dbRecords); -> just for reading
		mysql_close($db_con);
		echo "<script language='javascript'>window.location = 'ViewWFATemplate.php';</script>";
		die;
	}
	else
	{
		echo '<form id="form1" name="form1" method="post" action="'.$_SERVER["PHP_SELF"].'" >
					<p><table align="center">
					<tr>
						<td colspan="2"><h1 align="center">Edit Work Flow Template <a href="#"><img src="../../image/help_icon.jpg" width="20"/></a></h1></td>
					</tr>
						<tr>
						  <td width="100px">WFA Template ID: </td>
						  <td><input style="width:500px" type="text" name="txtWFATempl" readonly="readonly" value="'.$txtWFATempl.'"></td>
						</tr>
						<tr>
						  <td width="100px">WFA Timing: </td>
						  <td width="800px"><input style="width:500px" type="text" name="txtWFATemplTiming" maxlength="100" value="'.$txtWFAsubject.'"></td>
						</tr>
						<tr>
						  <td width="100px">WFA Template Content: </td>
						  <td width="800px" valign="top"><textarea name="txtWFAContent" cols="" rows="20" value='.$txtWFAContent.'>'.$txtWFAContent.'</textarea>
						</tr>
						<tr>
						  <td></td>
						  <td><input type="submit" name="submit" value="Submit" /><input type="reset" name="reset" value="Clear" /></td>
						</tr>
					</table></p></form>';
					
		//echo "Please check your data, we do not accept null fields!";
		if ($booWFATemplTiming)
			$txtMess = " Enter a valid WFA Timing";
		echo $txtMess;
		
		if ($booWFAContent)
			$txtMess = " Enter a valid WFA Template Content";
		echo $txtMess;
	}
}
else
{
	require("../../db_conection/db_connect.php");
		
	$txtWFATempl = $_GET['txtWFATempl'];
	
	//3 Construct SQL statement
	$sql = "select * from wfa_template where wfa_template_ID = '".$txtWFATempl."';";
	//4 Get Recordset based on SQL above
	$dbRecords = mysql_query($sql, $db_con ) 
			Or die('Query failed:'.mysql_error());
	
	$arrRecords = mysql_fetch_array($dbRecords);
	//echo "arrRecords: ".$arrRecords;
	$txtWFATempl = $arrRecords["wfa_template_ID"];
	$txtWFAsubject = $arrRecords["subject"];
	$txtWFAContent = $arrRecords["content"] ;
	//echo "a: ".$txtWFATempl;

		//echo $arrRecords["PersonID"]."&nbsp".$arrRecords["FamilyName"]."&nbsp".$arrRecords["GivenName"]."</br>" ;
		echo '<form id="form1" name="form1" method="post" action="'.$_SERVER["PHP_SELF"].'" >
				<p><table align="center">
					<tr>
						<td colspan="2"><h1 align="center">Edit Work Flow Template <a href="#"><img src="../../image/help_icon.jpg" width="20"/></a></h1></td>
					</tr>
					<tr>
					  <td width="100px">Template ID: </td>
					  <td width="50"><input style="width:500px" type="text" name="txtWFATempl" readonly="readonly" value="'.$txtWFATempl.'"></td>
					</tr>
					<tr>
					  <td width="100px">Subject: </td>
					  <td width="800px"><input style="width:500px" type="text" name="txtWFAsubject" maxlength="100" value="'.$txtWFAsubject.'"></td>
					</tr>
					<tr>
					  <td width="100px" valign="top">Content: </td>
					  <td width="800px"><textarea name="txtWFAContent" cols="" rows="20">'.$txtWFAContent.'</textarea></td>
					</tr>
					<tr>
						<td colspan="2" align="center"><a href="javascript:;" onMouseDown="tinyMCE.get(\'txtWFAContent\').show();">[Show]</a>
		<a href="javascript:;" onMouseDown="tinyMCE.get(\'txtWFAContent\').hide();">[Hide]</a></td>
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
