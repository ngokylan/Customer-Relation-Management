
<link href="../style/tablestyle.css" rel="stylesheet" type="text/css" />
<!--June modified 1/05/2011
-->
<?php
//Validation new values entered
$error = 0;
$txtMess = "";
$state = "";

if (isset($_POST["submit"]))
{
	$agentID = $_POST['txtID'];
	$contactID = $_POST['txtContactID'];

//June: 
	$agentFirstname 	    = $_POST['txtFirstName'];
	$agentLastname 			= $_POST['txtSurname'];
	$agentPassword 			= $_POST['txtPassword'];
	$agentLevelAccess 		= $_POST['cboAgentAccessLevel'];
	$agentAttempts 			= $_POST['cboAgentAccessStatus'];
	$mobile					= $_POST['txtMobile'];
	$streetNo				= $_POST['txtStreetNo'];
	$streetName				= $_POST['txtStreetName'];
	$city					= $_POST['txtCity'];
	$state					= $_POST['cboAgentState'];
	$country				= $_POST['txtCountry'];
	$postcode				= $_POST['txtPostcode'];
	$phone					= $_POST['txtPhone'];
	
	//minh: change password or not
	$rdPassChange = $_POST['rdPasschange'];
    
	//June: insert field for Email 
	$email					= $_POST['txtEmail'];

	//----------------------------------//
    //         June: validation         //
	//----------------------------------// 
	//Validate phone - The phone accept only digit.
	if ($phone != "" AND !ctype_digit($phone))				{$error = 1; $txtMess = "Phone number is invalid!";}
	//Validate postcode - postcode can accept only digit.
	if ($postcode != "" AND !ctype_digit($postcode))  		{$error = 1; $txtMess = "Postcode is invalid!";}	
    
	//Validate Email & Mobile
	if ($email == "" AND $mobile == "")						{$error = 1; $txtMess = "Enter the e-mail or mobile, please. ";}
	if ($mobile != "" AND !ctype_digit($mobile))    		{$error = 1; $txtMess = "Mobile number is invalid!";}
	if ($email != "" AND !isValidEmail($email))   			{$error = 1; $txtMess = "E-mail is invalid!";}
	
	//Validate password 
	if ($agentPassword == NULL) 							{ $error = 1; $txtMess = "Password is required!";}

	//Validate Lastname - Lastname cannot accept Null.
	if ($agentLastname == NULL) 							{ $error = 1; $txtMess = "Surname is required!";}
	
	//Validate Firstname - Firstname cannot accept Null.
	//if ($agentFirstname == NULL) 							{ $error = 1; $txtMess = "Firstname is required!";}

	//All Data have been validated.
	if ( $error == 0 )
	{
			require("../../db_conection/db_connect.php");
			require("../../include_php/password_function.php");
			
			//June: change table (contact_details => personal_details)	
			while  ($contactID == NULL OR $contactID == 0)
			{
				$sqlContact = "SELECT `contact_ID` FROM `personal_details` WHERE `cont_email` LIKE '$email' AND `cont_mobile` LIKE '$mobile' AND `cont_streetNo` LIKE '$streetNo' AND `cont_street` LIKE '$streetName' AND `cont_city` LIKE '$city' limit 1";
				$dbContacts = mysql_query($sqlContact, $db_con) or die('<br /> Query failed'.mysql_error());
			
				while($result = mysql_fetch_array($dbContacts)) 
				{
					$contactID = $result[0];
				}
				
				if ($contactID == NULL OR $contactID == 0)
				{
					$sqlContact="INSERT INTO `crmdatabase`.`personal_details` 
					(`contact_ID`, `cont_streetNo`, `cont_street`,  `cont_city`, `cont_zip`,`cont_state`, `cont_country`,  `cont_mobile`, `cont_phone`, `cont_email`) 			VALUES 
					(NULL, '$streetNo', '$streetName',  '$city', '$postcode','$state', '$country',  '$mobile', '$phone', '$email')";
					mysql_query($sqlContact) or die('<br /> Query failed :'.mysql_error());
				}
			}//end while ($txtContactID == NULL)
			
			$sql=" UPDATE `personal_details` SET 
				`cont_streetNo` = '$streetNo', 
				`cont_street` = '$streetName', 
				`cont_city` = '$city', 
				`cont_zip` = '$postcode', 
				`cont_state` = '$state', 
				`cont_country` = '$country', 
				`cont_mobile` = '$mobile', 
				`cont_phone` = '$phone', 
				`cont_email` = '$email' 
				WHERE `personal_details`.`contact_ID` = '$contactID'";
				echo "<script>
					alert(".$sql.");
				</script>";
				
				
				mysql_query($sql, $db_con) or die('<br /> Query failed :'.mysql_error());
				
			if($rdPassChange == "change")
			{
				//3 Construct UPDATE Agent details with sha1 password encription
			$agentPassword = encrypt_password($agentPassword);
			$sqlEdit = "UPDATE `agent` SET 
						`ag_fName` = '$agentFirstname', 
						`ag_lName` = '$agentLastname', 
						`ag_password` = '$agentPassword', 
						`ag_levelAccess` = '$agentLevelAccess', 
						`ag_logAttempts` = '$agentAttempts',
						`contact_id` = '$contactID'
						WHERE `agent`.`agent_ID` = $agentID";
			}
			else
			{			
					$sqlEdit = "UPDATE `agent` SET 
						`ag_fName` = '$agentFirstname', 
						`ag_lName` = '$agentLastname', 
						`ag_levelAccess` = '$agentLevelAccess', 
						`ag_logAttempts` = '$agentAttempts',
						`contact_id` = '$contactID'
						WHERE `agent`.`agent_ID` = $agentID";
			}
			
			
						
			mysql_query($sqlEdit, $db_con ) or die('Update failed:'.mysql_error());
			//6 Free Recordset and Close connection
			mysql_close($db_con);
			
			echo "<script language='javascript'>window.location = 'ViewAgent.php?txtID=$agentID';</script>";
			die; 
	}//ens if ($error == 0)
}//end if(isset($_POST["submit"])
else  
	{
		require("../../db_conection/db_connect.php");
		$agentID = "";
		if(isset($_GET['txtID']))
			$agentID = $_GET['txtID'];
		
		//3 Construct SQL statement
		$sql = "SELECT *  FROM `agent` WHERE `agent_ID` LIKE '".$agentID."';";
		
		//4 Get Recordset based on SQL above
		$dbRecords = mysql_query($sql, $db_con) Or die('Query failed:'.mysql_error());
		$arrRecords = mysql_fetch_array($dbRecords);
		
		$agentID = $arrRecords["agent_ID"];
		$agentFirstname = $arrRecords["ag_fName"];
		$agentLastname = $arrRecords["ag_lName"];
		$agentPassword = $arrRecords["ag_password"];
		$agentLevelAccess = $arrRecords["ag_levelAccess"];
		$agentAttempts = $arrRecords["ag_logAttempts"];
		if($agentAttempts < 3)
		{
			$agentAttempts = 0;
		}
		//$agentContactID = $arrRecords["contact_id"];
		$contactID = $arrRecords["contact_id"];
		mysql_free_result($dbRecords);
			
		//3 Construct SQL statement

//June: change name of the table (contact_details => personal_details)
		$sql = "SELECT *  FROM `personal_details` WHERE `contact_ID` LIKE '".$contactID."';";

		//4 Get Recordset based on SQL above
		$dbRecords = mysql_query($sql, $db_con) Or die('Query failed:'.mysql_error());
		$arrRecords = mysql_fetch_array($dbRecords);
		$streetNo = $arrRecords["cont_streetNo"];
		$streetName = $arrRecords["cont_street"];
		$city = $arrRecords["cont_city"];
		$state = $arrRecords["cont_state"];
		$country = $arrRecords["cont_country"];
		$postcode = $arrRecords["cont_zip"];
		$mobile = $arrRecords["cont_mobile"];
		$phone = $arrRecords["cont_phone"];
		
//June: insert email
		$email = $arrRecords["cont_email"];
		mysql_free_result($dbRecords);		
	
	// 7 Close 
	mysql_close($db_con);
}

function isValidEmail($email)
{
      $pattern = "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$";
     
      if (eregi($pattern, $email)){
         return true;
      }
      else {
         return false;
      }   
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!--June: The purpose of the function is reuse.-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
	<form id="formAgent" name="formAgent" method="post" action="EditAgent.php" align = "center">
		<input type="hidden" name="txtID" id="txtID" value='<?php echo $agentID; ?>' />
		<input type="hidden" name="txtContactID" id="txtContactID" value='<?php echo $contactID; ?>' />
				
		<table width="600" border="0" cellspacing="2" cellpadding="0" align="center">
              <tr>
                <td colspan="4" align="center"><h1>Edit Agent <a href="#"><img src="../../image/help_icon.jpg" width="20"/></a></h1></td>
              </tr>
              <tr>
                <td width="140" style="color:blue">First Name</td>
                <td width="180"><input type="text" name="txtFirstName" id="txtFirstName" readonly="readonly" value='<?php echo $agentFirstname; ?>' ></td>
                <td width="140">Surname</td>
                <td width="180"><input type="text" name="txtSurname" id="txtSurname" value='<?php echo $agentLastname; ?>' ></td>
              </tr>
			   <tr>
                <td width="140" style="font-family:arial;color:blue;font-size:15px;">(username)</td>
                <td width="180" style="font-family:arial;color:blue;font-size:12px;">(unable to change)</td>
				<td width="140">Access Level</td>
                <td width="180">
                  <select name="cboAgentAccessLevel" class="selectNonDate" id="cboAgentAccessLevel" value='<?php echo $agentLevelAccess; ?>'>
                    <option value="2" <?php if($agentLevelAccess =="2") echo "Selected" ?>>User</option>
                    <option value="1" <?php if($agentLevelAccess =="1") echo "Selected" ?>>Administrator</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td width="140">Password</td>
                <td width="180"><input type="text" name="txtPassword" id="txtPassword" value='<?php echo $agentPassword; ?>' ></td>
                 <td width="140">Status</td>
                <td width="180">
                  <select name="cboAgentAccessStatus" class="selectNonDate" id="cboAgentAccessStatus" value='<?php echo $agentAttempts; ?>'>
                    <option value="3" <?php if($agentAttempts == "3") echo "Selected" ?>>Locked</option>
                    <option value="0" <?php if($agentAttempts == "0") echo "Selected" ?>>Unlocked</option>
                  </select>
                </td>
              </tr> 
              <tr>
                <td width="140">Password</td>
                <td width="180"><input id="rdPasschange" name="rdPasschange" type="radio" value="Unchange" checked />unchage<input id="rdPasschange" name="rdPasschange" type="radio" value="change" />change</td>
                 <td width="140"></td>
                <td width="180">
                 
                </td>
              </tr> 
              <tr>
              	<td colspan="4"><br /></td>
              </tr>
              <tr>
                <td colspan="4"><b>Contact Details</b></td>
              </tr>
              <tr>
                <td width="140">E-mail</td>
                <td width="180"><input type="text" name="txtEmail" id="txtEmail" value='<?php echo $email; ?>' ></td>
                <td width="140">Mobile</td>
                <td width="180"><input type="text" name="txtMobile" id="txtMobile" value='<?php echo $mobile; ?>' ></td>
              </tr>
              <tr>
                <td width="140">Street No</td>
                <td width="180"><input type="text" name="txtStreetNo" id="txtStreetNo" value='<?php echo $streetNo; ?>' ></td>
                <td width="140">Street Name</td>
                <td width="180"><input type="text" name="txtStreetName" id="txtStreetName" value='<?php echo $streetName; ?>' ></td>
              </tr>
              <tr>
                <td width="140">City</td>
                <td width="180"><input type="text" name="txtCity" id="txtCity"  value='<?php echo $city; ?>' ></td>
                <td width="140">State</td>
                <td width="180">
                  <select name="cboAgentState" class="selectNonDate" id="cboAgentState" value='<?php echo $state; ?>'>
                    <option value="" <?php if($state =="") echo "Selected" ?>>Please select </option>
                    <option value="VIC" <?php if($state =="VIC") echo "Selected" ?>>Victoria</option>
                    <option value="NSW" <?php if($state =="NSW") echo "Selected" ?>>New South Wales</option>
                    <option value="QLD" <?php if($state =="QLD") echo "Selected" ?>>Queensland</option>
                    <option value="CBR" <?php if($state =="CBR") echo "Selected" ?>>Canberra</option>
                    <option value="SA" <?php if($state =="SA")  echo "Selected" ?>>South Australia</option>
                    <option value="WA" <?php if($state =="WA")  echo "Selected" ?>>Western Australia</option>
                    <option value="NT" <?php if($state =="NT")  echo "Selected" ?>>Northern Territory</option>
                    <option value="HOB" <?php if($state =="HOB") echo "Selected" ?>>Hobart</option>
                    <option value="LTON" <?php if($state =="LTON") echo "Selected" ?>>Launceston</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td width="140">Country</td>
                <td width="180"><input type="text" name="txtCountry" id="txtCountry" value='<?php echo $country; ?>' ></td>
                <td width="140">Postcode</td>
                <td width="180"><input type="text" name="txtPostcode" id="txtPostcode" value='<?php echo $postcode; ?>' ></td>
              </tr>
              <tr>
                <td width="140">Phone</td>
                <td width="180"><input type="text" name="txtPhone" id="txtPhone"  value='<?php echo $phone; ?>' ></td>
                <td colspan="2" style="color:red"><?php echo $txtMess; ?></td>
              </tr>
              <tr>
                <td width="140"></td>
                <td colspan="2"><input type="reset"  name="reset" value="Reset" />
                                <input type="submit" name="submit" value="Submit" /></td>
                <td width="180"></td>
              </tr>
		</table>
	</form>
</body>
</html>