
<!--
program: AddClient.php by June 02/05/2011
		 insert record into client table & personal_details table
-->
<link href="../style/tablestyle.css" rel="stylesheet" type="text/css" />
<?php
//Validation new values entered
$error = 0;
$txtMess = "";
$state = "";

if (isset($_POST["submit"]))
{
	$clientFirstname 	    = $_POST['txtFirstName'];
    $clientLastname 		= $_POST['txtSurname'];
	$clientCompany 			= $_POST['txtCompany'];
	$mobile					= $_POST['txtMobile'];
	$streetNo				= $_POST['txtStreetNo'];
	$streetName				= $_POST['txtStreetName'];
	$city					= $_POST['txtCity'];
	$state					= $_POST['cboAgentState'];
	$country				= $_POST['txtCountry'];
	$postcode				= $_POST['txtPostcode'];
	$phone			 		= $_POST['txtPhone']; 
	$email					= $_POST['txtEmail'];

	//--------------------------//
	//       Validation         //
	//--------------------------//

	//Validate phone - The phone accept only digit.
	if ($phone != "" AND !ctype_digit($phone))				{$error = 1; $txtMess = "Phone number is invalid!";}
	//Validate postcode - postcode can accept only digit.
	if ($postcode != "" AND !ctype_digit($postcode))  		{$error = 1; $txtMess = "Postcode is invalid!";}	
    //Validate country 
	//if ($country != "" AND !ctype_alpha($country))	{$error = 1; $txtMess = "Country accepts only charactder!";}
    //Validate state 
	//if ($state != "" AND !ctype_alpha($state))	{$error = 1; $txtMess = "State accepts only charactder!";}
    //Validate city
	//if ($city != "" AND !ctype_alpha($city))	{$error = 1; $txtMess = "City accepts only charactder!";}
    //Validate street name
	//if ($streetName != "" AND !ctype_alpha($streetName))	{$error = 1; $txtMess = "Street Name accepts only charactder!";}
	//Validate Email & Mobile
	if ($email == "" AND $mobile == "")						{$error = 1; $txtMess = "Enter the e-mail or mobile, please. ";}
	if ($mobile != "" AND !ctype_digit($mobile))    		{$error = 1; $txtMess = "Mobile number is invalid!";}
	if ($email != "" AND !isValidEmail($email))   			{$error = 1; $txtMess = "E-mail is invalid!";}
	//Validate Lastname - Lastname accepts only character.
	//if (!ctype_alpha($clientLastname))   					{ $error = 1; $txtMess = "Surname accepts only character!";}
	//Validate Lastname - Lastname cannot accept Null.
	if ($clientLastname == NULL) 							{ $error = 1; $txtMess = "Surname is required!";}
	//Validate Lastname - Firstname accepts only character.
	//if (!ctype_alpha($clientFirstname))   					{ $error = 1; $txtMess = "Firstname accepts only character!";}
	//Validate Lastname - Firstname cannot accept Null.
	if ($clientFirstname == NULL) 							{ $error = 1; $txtMess = "Firstname is required!";}

	//All Data have been validated.
	if ( $error == 0 )
	{
		require("../../db_conection/db_connect.php");

		//insert record into personal_details
		$sqlContact="INSERT INTO `crmdatabase`.`personal_details` 
				(`contact_ID`, `cont_email`, `cont_mobile`, `cont_streetNo`, `cont_street`,  `cont_city`, `cont_state`, `cont_country`, `cont_zip`, `cont_phone`) VALUES 
				(NULL, '$email', '$mobile', '$streetNo', '$streetName',  '$city', '$state', '$country', '$postcode','$phone')";
		mysql_query($sqlContact) or die('<br /> Query failed :'.mysql_error());
	
		//Get contact_ID by personal_details table
		$sql = "SELECT `contact_ID` FROM `personal_details` WHERE `cont_email` LIKE '$email' AND `cont_mobile` LIKE '$mobile' AND `cont_streetNo` LIKE '$streetNo' AND `cont_street` LIKE '$streetName' AND `cont_city` LIKE '$city' limit 1";
		$dbContacts = mysql_query($sql, $db_con) or die('<br /> Query failed'.mysql_error());
		while($result = mysql_fetch_array($dbContacts)) 
		{
			$contactID = $result[0];
		}
		
		//insert record into agent table
		$sqlClient="INSERT INTO `crmdatabase`.`client` 
				(`client_ID`, `cl_fName`, `cl_lName`, `cl_Company`, `contact_id`) VALUES 
				(NULL, '$clientFirstname', '$clientLastname', '$clientCompany', '$contactID')";
		mysql_query($sqlClient) or die('<br /> Query failed:'.mysql_error());
			//6 Free Recordset and Close connection
		mysql_close($db_con);
		echo "<script language='javascript'>window.location = 'ViewClient.php?txtID=$clientID';</script>";
		die; 
	}//ens if ($error == 0)
}//end if(isset($_POST["submit"])
else  
{
		$clientID = "";
		$clientFirstname = "";
		$clientLastname = "";
		$clientCompany = "";
		$contactID = "";
		$email = "";
		$mobile = "";
		$streetNo = "";
		$streetName = "";
		$city = "";
		$state = "";
		$country = "";
		$postcode = "";
		$phone =  "";	
}

function isValidEmail($email)
{
      $pattern = "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$";
     
      if (eregi($pattern, $email))
	  {
         return true;
      }
      else 
	  {
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
	<form id="formClient" name="formClient" method="post" action="AddClient.php" align = "center">
				
		<table width="600" border="0" cellspacing="2" cellpadding="0" align="center">
              <tr>
                <td colspan="4" align="center"><h1>Add New Client <a href="#"><img src="../../image/help_icon.jpg" width="20"/></a></h1></td>
              </tr>
              <tr>
                <td width="140">First Name</td>
                <td width="180"><input type="text" name="txtFirstName" id="txtFirstName" value='<?php echo $clientFirstname; ?>' ></td>
                <td width="140">Surname</td>
                <td width="180"><input type="text" name="txtSurname" id="txtSurname" value='<?php echo $clientLastname; ?>' ></td>
              </tr>
              <tr>
                <td width="140">Company</td>
                <td width="180"><input type="text" name="txtCompany" id="txtCompany" value='<?php echo $clientCompany; ?>' ></td>
                <td width="140"></td>
                <td width="180"></td>
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