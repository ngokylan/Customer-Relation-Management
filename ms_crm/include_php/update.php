<!--
    Team:			blueSky
    Programmer:		Liam Handasyde
    Purpose:		Nolonger required
    Client:			Milestone Search
    Version:		13.0 11.10.2010
    File:			update.php
-->
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Update</title>
</head>

<body>
<?php
require("db_conection/db_connect.php");

//load state from database into combobox - Minh
$sql2 = 'select * from state order by state_code';

//4 Get Recordset based on SQL above
$dbRecords2 = mysql_query($sql2, $db_con ) 
		Or die('Query failed:'.mysql_error());

//5 Loop through records for: $state, $state_code, $state_name
$state = "";
while( $arrRecords2 = mysql_fetch_array($dbRecords2)) 
{		
	$state_code = $arrRecords2["state_code"];
	$state_name = $arrRecords2["state_name"];
	$state .= '<option value="'.$state_code.'">'.$state_name.'</option>';
}
	
//6 Free Recordset and Close connection

mysql_free_result($dbRecords2);
mysql_close($db_con);
?>
<form action="" method="" name"updateForm">
    <div class="floatRow">
    	<label for="txtUpdateFName" class="labelStyleLeft">First Name</label>
        <input type="text" class="txtBoxShadow" id="txtUpdateFName" name="txtUpdateFName" />
        <label for="txtUpdateSurname" class="labelStyleRight">Surname</label>
        <input type="text" class="txtBoxShadow" id="txtUpdateSurname" name="txtUpdateSurname" />
    </div>
    <div class="floatRow">
    	<label for="txtUpdateJobTitle" class="labelStyleLeft">Job Title</label>
        <input type="text" class="txtBoxShadow" id="txtUpdateJobTitle" name="txtUpdateJobTitle" />
        <label for="cboUpdateCategories" class="">Categories</label>
        <select name="cboUpdateCategories" class="selectNonDate" id="cboUpdateCategories">
                    <option value="notSelected"  selected="selected">Please select </option>
                    <option value="0">Skill 1</option>
                    <option value="1">Skill 2</option>
                    <option value="2">Skill 3</option>
                    <option value="3">Skill 4</option>
                    <option value="4">Skill 5</option>
                </select>
    </div>
    <div class="floatRow">
    	<label for="txtUpdateEmail" class="labelStyleLeft">Email</label>
        <input type="text" class="txtBoxShadow" id="txtUpdateEmail" name="txtUpdateEmail" />
        <label for="txtUpdateMobile" class="labelStyleRight">Mobile</label>
        <input type="text" class="txtBoxShadow" id="txtUpdateMobile" name="txtUpdateMobile" />
    </div>
    <div class="floatRow">
    	<label for="txtUpdateHPhone" class="labelStyleLeft">Home Phone</label>
        <input type="text" class="txtBoxShadow" id="txtUpdateHPhone" name="txtUpdateHPhone" />
        <label for="txtUpdateFax" class="labelStyleRight">Fax</label>
        <input type="text" class="txtBoxShadow" id="txtUpdateFax" name="txtUpdateFax" />
    </div>
    <div class="floatRow">
    	<label for="txtUpdateStNum" class="labelStyleLeft">Street No</label>
        <input type="text" class="txtBoxShadow" id="txtUpdateStNum" name="txtUpdateStNum" />
        <label for="txtUpdateStName" class="labelStyleRight">Street Name</label>
        <input type="text" class="txtBoxShadow" id="txtUpdateStName" name="txtUpdateStName" />
    </div>
    <div class="floatRow">
    	<label for="txtUpdateZip" class="labelStyleLeft">Post Code</label>
        <input type="text" class="txtBoxShadow" id="txtUpdateZip" name="txtUpdateZip" />
        <label for="cboUpdateState" class="labelStyleRight">State</label>
        <select name="cboUpdateState" class="selectNonDate" id="cboUpdateState">
                    <option value="notSelected"  selected="selected">Please select </option>
                     <?php echo $state;?>
		</select>
    </div>
    <div class="floatRow">
    	<label for="txtUpdateCountry" class="labelStyleLeft">Country</label>
        <input type="text" class="txtBoxShadow" id="txtUpdateCountry" name="txtUpdateCountry" />
        <label for="txtUpdateCurComp" class="labelStyleRight">Curr Company</label>
        <input type="text" class="txtBoxShadow" id="txtUpdateCurComp" name="txtUpdateCurComp" />
    </div>
    <div class="floatRow">
    	<label for="cboUpdateConsultant" class="labelStyleLeft">Consultant</label>
        <!--  
        ===========================================================================================================================
        "cboUpdateConsultant" Needs dynamic feed from the database
        ===========================================================================================================================
        -->
        <select name="cboUpdateConsultant" class="selectNonDate" id="cboUpdateConsultant">
                    <option value="notSelected"  selected="selected">Please select </option>
                    <option value="0">Consultant 1</option>
                    <option value="1">Consultant 2</option>
                    <option value="2">Consultant 3</option>
                    <option value="3">Consultant 4</option>
                    <option value="4">Consultant 5</option>
                    <option value="5">Consultant 6</option>
                    <option value="6">Consultant 7</option>
                    <option value="7">Consultant 8</option>
                    <option value="8">Consultant 9</option>
		</select>
        <!--  
        ===========================================================================================================================
        "cboUpdateConsultant" Needs dynamic feed from the database
        ===========================================================================================================================
        -->
        <label for="cboUpdateEngageType" class="UpdateRelState" id="UpdateRelState">Engagement Type</label>
        <select name="cboUpdateEngageType" class="selectNonDate" id="cboUpdateEngageType">
                    <option value="notSelected"  selected="selected">Please select </option>
                    <option value="0">Full Time</option>
                    <option value="1">Part Time</option>
                    <option value="2">Casual</option>
                    <option value="3">Contract</option>
                </select>
    </div>
    <div class="floatRow">
    	<label for="cboUpdateScoring" class="labelStyleLeft">Scoring</label>
        <select name="cboUpdateScoring" class="selectNonDate" id="cboUpdateScoring">
                    <option value="notSelected"  selected="selected">Please select </option>
                    <option value="0">Exelent</option>
                    <option value="1">Very Good</option>
                    <option value="2">Good</option>
                    <option value="3">Average</option>
                    <option value="4">Below Average</option>
                </select>
        <label for="cboUpdatetStatus" class="UpdateRelState" id="UpdateRelState">Status</label>
        <select name="cboUpdatetStatus" class="selectNonDate" id="cboUpdatetStatus">
                    <option value="notSelected"  selected="selected">Please select </option>
                    <option value="0">Continue Prospecting</option>
                    <option value="1">Seeking Perm</option>
                    <option value="2">Seeking Contract</option>
                    <option value="3">Submitted for Interview</option>
                    <option value="4">Interview Confirm</option>
                    <option value="5">Placed by Milestone</option>
                    <option value="6">Requirement Identified</option>
                </select>
    </div>
     <div class="floatRow">
    	<label for="txtUpdateNextAvail" class="labelStyleLeft">Next Available</label>
        <script>DateInput('orderdate3', true, 'DD-MON-YYYY')</script>
    </div>
    <div class="floatRow">
    	<label for="txtUpdateBuyRate" class="labelStyleLeft">Buy Rate</label>
        <input type="text" class="txtBoxShadow" id="txtUpdateBuyRate" name="txtUpdateBuyRate" />
        <label for="txtUpdateSellRate" class="labelStyleRight">Sell Rate</label>
        <input type="text" class="txtBoxShadow" id="txtUpdateSellRate" name="txtUpdateSellRate" />
    </div>
    <div class="floatRow">
    	<label for="txaUpdateNotes" class="labelStyleLeft">Notes</label>
    	<textarea name="txaUpdateNotes" class="txaBoxShadow" id="updateHeigh"></textarea>
    </div>
    <div class="floatRow">
    	<input type="reset" class="inc_buttons" name="reset" id="updateButtonSpace" value="Reset" />
        <input type="submit" class="inc_buttons" name="btnSubmitWFA" id="updateButtonSpace" value="Submit" />
    </div>
</form>
</body>
</html>