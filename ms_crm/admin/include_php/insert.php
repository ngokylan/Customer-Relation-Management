<!--
    Team:			blueSky
    Programmer:		Liam Handasyde | Tommy Wijaya | Sonia Schiavon
    Purpose:		CRM to manage mileston Search Candidates
    Client:			Milestone Search
    Version:		12.0 11.10.2010
    File:			insert.php
-->
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Insert</title>
		
<style type="text/css">
<!--
.labelStyleInfo {
	font-family: Arial, Helvetica, sans-serif;
	color:#F90;
	font-weight:400;
	text-decoration:underline;
}
-->
</style>
</head>

<body>
<!-- Help System: sch09297795 - 05/10/10 - Read glossary from DB-->
<?php
require("db_conection/db_connect.php");

//3 Construct SQL statement
$sql = 'select * from help_system order by hs_fieldID';

//4 Get Recordset based on SQL above
$dbRecords = mysql_query($sql, $db_con ) 
		Or die('Query failed:'.mysql_error());

//5 Loop through records for: $hs_status, $hs_nextContact, $hs_category_SkillSet
while( $arrRecords = mysql_fetch_array($dbRecords)) 
{
	//$arrRecords["hs_fieldID"]."&nbsp".$arrRecords["hs_msg"]."</br>" ;
	
	if ($arrRecords["hs_fieldID"] == 'Availability / Next Contact')
	{
		$hs_nextContact = $arrRecords["hs_msg"];
		$hs_HnextContact = $arrRecords["hs_fieldID"];
	}
	if ($arrRecords["hs_fieldID"] == 'Initial Contact')
	{
		$hs_iniContact = $arrRecords["hs_msg"];
		$hs_HiniContact = $arrRecords["hs_fieldID"];
	}
	if ($arrRecords["hs_fieldID"] == 'Scoring')
	{
		$hs_scoring = $arrRecords["hs_msg"];
		$hs_Hscoring = $arrRecords["hs_fieldID"];
	}
	if ($arrRecords["hs_fieldID"] == 'Engagement Type')
	{
		$hs_engType = $arrRecords["hs_msg"];
		$hs_HengType = $arrRecords["hs_fieldID"];
	}
	if ($arrRecords["hs_fieldID"] == 'Status')
	{
		$hs_status = $arrRecords["hs_msg"];
		$hs_Hstatus = $arrRecords["hs_fieldID"];
	}
	if ($arrRecords["hs_fieldID"] == 'Sell Rate')
	{
		$hs_sellRate = $arrRecords["hs_msg"];
		$hs_HsellRate = $arrRecords["hs_fieldID"];
	}
	if ($arrRecords["hs_fieldID"] == 'Buy Rate')
	{
		$hs_buyRate = $arrRecords["hs_msg"];
		$hs_HbuyRate = $arrRecords["hs_fieldID"];
	}
	if ($arrRecords["hs_fieldID"] == 'Rate')
	{
		$hs_rate = $arrRecords["hs_msg"];
		$hs_Hrate = $arrRecords["hs_fieldID"];
	}
}
	
//6 Free Recordset and Close connection
mysql_free_result($dbRecords);
mysql_close($db_con);
?>
<!-- Help System: sch09297795 - 05/10/10 END -->
<form id="insertForm" >
	<input id="hiddenCandidateID" type="hidden" value="">
    <div class="floatRow">																			<!--First Name || Surname-->
    	<label for="txtInsertFName" class="labelStyleLeft">First Name</label>
        <input type="text" class="txtBoxShadow" id="txtInsertFName" name="txtInsertFName" />
        <label for="txtInsertSurname" class="labelStyleRight">Surname</label>
        <input type="text" class="txtBoxShadow" id="txtInsertSurname" name="txtInsertSurname" />
    </div>
  <div class="floatRow">																			<!--First Name || Surname-->
    	<label for="txtInsertJobTitle" class="labelStyleLeft">Job Title</label>
        <input type="text" class="txtBoxShadow" id="txtInsertJobTitle" name="txtInsertJobTitle" />
    <label for="txtInsertJobDescription" class="labelStyleRight">Job Description</label>
    <input type="text" class="txtBoxShadow" id="txtInsertJobDescription" name="txtInsertJobDescription" />
  </div>
  <div class="floatRow">																			<!--First Name || Surname-->
    	<label for="txtInsertSkill" class="labelStyleLeft">Major Skill</label>
        <input type="text" class="txtBoxShadow" id="txtInsertSkill" name="txtInsertSkill" />
        <label for="txtInsertSkillDes" class="labelStyleRight">Skill Description</label>
        <input type="text" class="txtBoxShadow" id="txtInsertSkillDes" name="txtInsertSkillDes" />
    </div>
    <div class="floatRow">	
    	<label class="labelStyleInfo">Contact Details____</label>
    </div>
    <div class="floatRow">																			<!--Street Num || Street Name-->
    	<label for="txtInsertStNum" class="labelStyleLeft">Street Number</label>
        <input type="text" class="txtBoxShadow" id="txtInsertStNum" name="txtInsertStNum" />
        <label for="txtInsertStName" class="labelStyleRight">Street Name</label>
        <input type="text" class="txtBoxShadow" id="txtInsertStName" name="txtInsertStName" /> 
    </div>
    <div class="floatRow">																			<!--City || State-->
    	<label for="txtInsertCity" class="labelStyleLeft">City</label>
        <input type="text" class="txtBoxShadow" id="txtInsertCity" name="txtInsertCity" />
        <label for="txtInsertState" class="labelStyleRight">State</label>
        <select name="cboInsertState" class="selectNonDate" id="cboInsertState" onChange="document.getElementById('txtInsertCountry').value='Australia'"><!--==========================================-->
                    <option value="notSelected"  selected="selected">Please select </option>
                    <option value="VIC">Victoria</option>
                    <option value="NSW">NSW</option>
                    <option value="QLD">Queensland</option>
                    <option value="CBR">Canberra</option>
                    <option value="SA">South Australia</option>
                    <option value="WA">Western Australia</option>
                    <option value="NT">Northern Territory</option>
                    <option value="HOB">Hobart</option>
                    <option value="LTON">Launceston</option>
		</select> 
    </div>
    <div class="floatRow">																			<!--Post Code || Country-->
    	<label for="txtInsertZip" class="labelStyleLeft">Post Code</label>
        <input name="txtInsertZip" type="text" class="txtBoxShadow" id="txtInsertPostCode" maxlength="4" />
      <label for="txtInsertCountry" class="labelStyleRight">Country</label>
        <input type="text" class="txtBoxShadow" id="txtInsertCountry" name="txtInsertCountry" /> 
    </div>
    <div class="floatRow">																			<!--Mobile || Home Phone-->
    	<label for="txtInsertMobile" class="labelStyleLeft">Mobile</label>
        <input name="txtInsertMobile" type="text" class="txtBoxShadow" id="txtInsertMobile" maxlength="10" />
      <label for="txtInsertHPhone" class="labelStyleRight">Home Phone</label>
        <input name="txtInsertHPhone" type="text" class="txtBoxShadow" id="txtInsertHPhone" maxlength="10" /> 
    </div>
    <div class="floatRow">
    	<label for="txtInsertEmail" class="labelStyleLeft">Email</label>
    	<input name="txtInsertEmail" type="text" class="txtBoxShadow" id="txtInsertEmail"  />
    	<!--Company || Other Companies-->																		
<label for="txtInsertCurComp" class="labelStyleLeft">Company</label>
        <input name="txtInsertCompany" type="text" class="txtBoxShadow" id="txtInsertComp" />
    </div>
    <div class="floatRow">																			<!--Work Phone || Work Phone-->																		
    	<label for="txtInsertCurComp" class="labelStyleLeft">Work Phone</label>
        <input name="txtInsertWPhone" type="text" class="txtBoxShadow" id="txtInsertWorkPhone" maxlength="10" />
      <label for="txtInsertPreComp" class="labelStyleRight">Work Fax</label>
        <input name="txtInsertWFax" type="text" class="txtBoxShadow" id="txtInsertWorkFax" maxlength="10" /> 
    </div>
    <div class="floatRow">									
    	<label class="labelStyleInfo">Opportunity_______</label>
    </div>
  <div class="floatRow">	
   		<!--Next Available--><!-- Help System: sch09297795 - 05/10/10-->
  <label for="txtInsertNextAvail" class="labelStyleLeft"
        		onMouseOut="closeHelpSummary();" 
                onMouseOver="helpSummary(this,'<?php echo $hs_nextContact?>', '<?php echo $hs_HnextContact." field"?> ');" 
                onDblClick="helpSummary(this,'<?php echo $hs_nextContact?>', '<?php echo $hs_HnextContact." field"?>');">Next Available</label>
                <input name="dateInsertNextAvailable" type="text" class="txtBoxShadow"  id="dateInsertNextAvailable">								
                
        <!--Initial Contact--><!-- Help System: sch09297795 - 05/10/10-->
   	  <label for="dateInsertInitialContact" class="labelStyleRight"
        		onMouseOut="closeHelpSummary();" 
                onMouseOver="helpSummary(this,'<?php echo $hs_iniContact?>', '<?php echo $hs_HiniContact." field"?> ');" 
                onDblClick="helpSummary(this,'<?php echo $hs_iniContact?>', '<?php echo $hs_HiniContact." field"?>');">Initial Contact</label>
              <input name="dateInsertInitialContact" type="text" class="txtBoxShadow"  id="dateInsertInitialContact">
    </div>
    <div class="floatRow">									<!--Email || Scoring--><!-- Help System: sch09297795 - 05/10/10-->
    	
        <label for="cboInsertScoring" class="labelStyleRight" id=""
        		onMouseOut="closeHelpSummary();" 
                onMouseOver="helpSummary(this,'<?php echo $hs_scoring?>', '<?php echo $hs_Hscoring." field"?> ');" 
                onDblClick="helpSummary(this,'<?php echo $hs_scoring?>', '<?php echo $hs_Hscoring." field"?>');">Scoring</label>
        <select name="cboInsertScoring" class="selectNonDate" id="cboInsertScoring">
                    <option value="notSelected"  selected="selected">Please select </option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                </select>
                
                <label for="txtInsertPreComp" class="labelStyleRight" id="insertRelState"
        		onMouseOut="closeHelpSummary();" 
                onMouseOver="helpSummary(this,'<?php echo $hs_status?>', '<?php echo $hs_Hstatus." field"?> ');" 
                onDblClick="helpSummary(this,'<?php echo $hs_status?>', '<?php echo $hs_Hstatus." field"?>');">Relation Status</label>
        <select name="cboInsertRelatStatus" class="selectNonDate" id="cboInsertRelatStatus">
                    <option value="notSelected"  selected="selected">Please select </option>
                    <option value="Excellent">Excellent</option>
                    <option value="Very Good">Very Good</option>
	                <option value="Good">Good</option>
                    <option value="Average">Average</option>
                    <option value="Below Average">Below Average</option>
                </select> 
    </div>
    <div class="floatRow">							<!--Engagement Type || Status--><!-- Help System: sch09297795 - 05/10/10-->
    	<label for="txtInsertCurComp" class="labelStyleLeft"
        		onMouseOut="closeHelpSummary();" 
                onMouseOver="helpSummary(this,'<?php echo $hs_engType?>', '<?php echo $hs_HengType." field"?> ');" 
                onDblClick="helpSummary(this,'<?php echo $hs_engType?>', '<?php echo $hs_HengType." field"?>');">Engagement Type</label>
       <select name="cboInsertCurrEngageType" class="selectNonDate" id="cboInsertCurrEngageType">
                    <option value="notSelected"  selected="selected">Please select </option>
                    <option value="0">Full Time</option>
                    <option value="1">Part Time</option>
                    <option value="2">Casual</option>
                    <option value="3">Contract</option>
         </select>
        <label for="txtInsertPreComp" class="labelStyleRight" id="insertRelState"
        		onMouseOut="closeHelpSummary();" 
                onMouseOver="helpSummary(this,'<?php echo $hs_status?>', '<?php echo $hs_Hstatus." field"?> ');" 
                onDblClick="helpSummary(this,'<?php echo $hs_status?>', '<?php echo $hs_Hstatus." field"?>');">Status</label>
        <select name="cboInsertStatus" class="selectNonDate" id="cboInsertStatus">
                    <option value="notSelected"  selected="selected">Please select </option>
                    <option value="1a">Continue Prospecting</option>
                    <option value="1b">Requirement Indentified</option>
	                <option value="2a">Continue Prospecting</option>
                    <option value="2b">Seek Perm</option>
                    <option value="2c">Seek Contract</option>
                    <option value="2d">Submitted for Interview</option>
                    <option value="2e">Interview Confirmed</option>
                    <option value="2f">Placed by Milestone</option>
                </select> 
    </div>
  		<div class="floatRow">	
        <label for="txtInsertRate" class="labelStyleLeft"
        		onMouseOut="closeHelpSummary();" 
                onMouseOver="helpSummary(this,'<?php echo $hs_rate?>', '<?php echo $hs_Hrate." field"?> ');" 
                onDblClick="helpSummary(this,'<?php echo $hs_rate?>', '<?php echo $hs_Hrate." field"?>');">Rate</label>
        <input type="text" class="txtBoxShadow" id="txtInsertRate" name="txtInsertRate" style="width:50px"/>
   		<select name="rateType" class="selectNonDate" id="rateType" style="width:76px">
                    <option value="notSelected"  selected="selected">Please select </option>
                    <option value="per Hour">per Hour</option>
                    <option value="per Day">per Day</option>
                    <option value="per Annual">per Annual</option>
         </select>
         </div>
         
         <div class="floatRow">	
		<label for="txtInsertBuyRate" class="labelStyleRight"
        		onMouseOut="closeHelpSummary();" 
                onMouseOver="helpSummary(this,'<?php echo $hs_buyRate?>', '<?php echo $hs_HbuyRate." field"?> ');" 
                onDblClick="helpSummary(this,'<?php echo $hs_buyRate?>', '<?php echo $hs_HbuyRate." field"?>');">Buy Rate</label>
        <input type="text" class="txtBoxShadow" id="txtInsertBuyRate" name="txtInsertBuyRate" style="width:50px"/> 
   		<select name="buyRateType" class="selectNonDate" id="buyRateType" style="width:76px">
                    <option value="notSelected"  selected="selected">Please select </option>
                    <option value="per Hour">per Hour</option>
                    <option value="per Day">per Day</option>
                    <option value="per Annual">per Annual</option>
        </select>
        </div>
        
    	<div class="floatRow">	
		<label for="txtInsertSellRate" class="labelStyleLeft"
        		onMouseOut="closeHelpSummary();" 
                onMouseOver="helpSummary(this,'<?php echo $hs_sellRate?>', '<?php echo $hs_HsellRate." field"?> ');" 
                onDblClick="helpSummary(this,'<?php echo $hs_sellRate?>', '<?php echo $hs_HsellRate." field"?>');">Sell Rate</label>
        <input type="text" class="txtBoxShadow" id="txtInsertSellRate" name="txtInsertSellRate" style="width:50px" />
   		<select name="sellRateType" class="selectNonDate" id="sellRateType" style="width:76px">
                    <option value="notSelected"  selected="selected">Please select </option>
                    <option value="per Hour">per Hour</option>
                    <option value="per Day">per Day</option>
                    <option value="per Annual">per Annual</option>
         </select>
         </div>
         
        
    <!--
    	Scroll Over Table
    -->
    <div id="insertTxaRow"><!--class="floatRow"-->
    	<label for="txtInsertNotes" class="labelStyleLeft">Notes</label>
    	<textarea name="txaInsertNotes" rows="3" class="txaBoxShadow" id="txtInsertNotes" onblur="addComment();"></textarea>
    </div>
    <!--id="insertButtonRow"--><!-- Help System: sch09297795 - 05/10/10-->
    <!-- <div class="floatRow">
    	<input type="reset" class="inc_buttons" id="insertSpace" name="reset" value="Reset" />
        <input type="button" onClick="insertCandidateFunction()" class="inc_buttons" id="insertSpace" value="Submit" />
                                       
                                        header("Location: tutorial3_3ver2_2.php?a=$a&b=$b&c=$c&d=$d")
         </div> -->
    <div class="AdSearchfloatRowBtns">
        <div id="adSearchHelp">
        	<div id="adSearchHelpInner">
            	<!--<a href="HelpSystem/Help_InsUpdCand.htm"><img src="../css/ui-lightness/images/HELP.bmp" alt="Insert / Update Candidate - Help on line"/></a>-->
                <span onClick="openHelp_InsUpdCand();">Insert / Update Candidate - Help on line</span>
            </div>
        </div>
        <div id="adSearchStyling">
        	<div id="adSearchStylingInner">
            	<input type="button" onClick="funChooseEvent(this.value)" class="inc_buttons" id="btnSubmit" value="Save" />
                <input type="reset" onClick="funResetBar()"class="inc_buttons" id="insertBtnReset" name="reset" value="Reset" />
            </div>
        </div>
    </div>
</form>   
</body>
</html>