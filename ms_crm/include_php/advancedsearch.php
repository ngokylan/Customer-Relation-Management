<!--
    Team:			ISYNC
    Programmer:		Minh Duc Nguyen
    Purpose:		CRM to manage mileston Search Candidates
    Client:			Milestone Search
    Version:		13.0 09-03-2011
    File:			advancedsearch.php
-->

<!-- Help System: NGU09298162 - 09-03-2011 - Read glossary from DB-->
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
	if ($arrRecords["hs_fieldID"] == 'Status')
	{
		$hs_status = $arrRecords["hs_msg"];
		$hs_Hstatus = $arrRecords["hs_fieldID"];
	}
	if ($arrRecords["hs_fieldID"] == 'Availability / Next Contact')
	{
		$hs_nextContact = $arrRecords["hs_msg"];
		$hs_HnextContact = $arrRecords["hs_fieldID"];
	}
	if ($arrRecords["hs_fieldID"] == 'Category / Skill Set')
	{
		$hs_category_SkillSet = $arrRecords["hs_msg"];
		$hs_Hcategory_SkillSet = $arrRecords["hs_fieldID"];
	}
}

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
mysql_free_result($dbRecords);
mysql_free_result($dbRecords2);
mysql_close($db_con);
?>
<!-- Help System: sch09297795 - 05/10/10 END -->
<form name"adSearch" method="post">
    <div class="floatRowContainer">
        <div class="AdSearchLeft">
          <!-- Help System: sch09297795 - 05/10/10  -->
    	<label for="txtAdSearchCategories" class="AdSearchLabelStyleLeft" 
        	onMouseOut="closeHelpSummary();" 
            onMouseOver="helpSummary(this,'<?php echo $hs_category_SkillSet?>', '<?php echo $hs_Hcategory_SkillSet." field"?>');" 
            onDblClick="helpSummary(this,'<?php echo $hs_category_SkillSet?>', '<?php echo $hs_Hcategory_SkillSet." field"?>');">Skill Set</label>
            <input type="text" class="txtBoxShadowLeft" id="txtAdSearchSkillSet" name="txtAdSearchSkillSet"  onMouseDown="setSuggestionDiv(this,'suggestionDivTom',this.clientWidth)" 
            onBlur="hideSuggestionDiv()" onKeyUp="lookupSkillSet(this.value);" autocomplete=off  />
        </div>
        <div class="AdSearchRight">
        <!-- Help System: sch09297795 - 05/10/10 -->
            <label for="cboAdSearchStatus" class="AdSearchLabelStyleRight" 
            	onMouseOut="closeHelpSummary();" 
                onMouseOver="helpSummary(this,'<?php echo $hs_status?>', '<?php echo $hs_Hstatus." field"?> ');" 
                onDblClick="helpSummary(this,'<?php echo $hs_status?>', '<?php echo $hs_Hstatus." field"?>');">Work Status</label>
            <select name="cboAdSearchStatus" class="AdSearchCBOStyleRight" id="cboAdSearchStatus">
                    <option value=""  selected="selected">Please select </option>
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
    </div>
    <div class="floatRowContainer">
    	<div class="AdSearchLeft">
             <!-- Help System: sch09297795 - 05/10/10 -->
        <label for="txtAdSearchNextAvail" class="AdSearchLabelStyleLeft" 
        	onMouseOut="closeHelpSummary();" 
            onMouseOver="helpSummary(this,'<?php echo $hs_nextContact?>', '<?php echo $hs_HnextContact." field"?>');" 
            onDblClick="helpSummary(this,'<?php echo $hs_nextContact?>', '<?php echo $hs_HnextContact." field"?>');">Next Available</label>
            <input type="text" class="txtBoxShadowLeft"  id="adSearchNextAvailable">
            
        </div>
        <div class="AdSearchRight" align="right">
        <label for="cboAdSearchStatus" class="AdSearchLabelStyleRight" 
            	onMouseOut="closeHelpSummary();" 
                onMouseOver="helpSummary(this,'<?php echo $hs_status?>', '<?php echo $hs_Hstatus." field"?> ');" 
                onDblClick="helpSummary(this,'<?php echo $hs_status?>', '<?php echo $hs_Hstatus." field"?>');">State</label>
            <select name="adSearchState" class="AdSearchCBOStyleRight" id="adSearchState"><!--==========================================-->
                    <option value="notSelected"  selected="selected">Please select </option>
                      <?php echo $state;?>
			</select> 
        </div>
    </div>
    <div class="floatRowContainer">
    	<div class="AdSearchLeft">
        </div>
         <div class="AdSearchRight" align="right">
         <!-- Help System: sch09297795 - 05/10/10 -->
                <input type="button" class="inc_buttons" name="submit" id="adSearchButtonSearch" value="Search" onClick="advanceSearch()" />
        		<input type="reset" class="inc_buttons" name="reset" id="adSearchButtonReset" value="Reset" />        

		</div>
    </div>
    <div class="floatRowContainer">
    	<div class="AdSearchLeft">
        </div>
         <div class="AdSearchRight" align="right">
         <span onClick="openHelp_AdvSearch();"><img src="image/help_icon.jpg" width="20" alt="Help" title="Help"/></span>
		</div>
    </div>
    
    <!--
    Candidate Name Search scroll table: Search | Status | skill set | Categories
    -->
    <div id="searchResult" style="display:none">
        <div id="adSearchscrollTableRow" >
            <div class="innerStblContainer">
                <div class="adStblBG">
                    <label for="adBasicSearch" class="adStblHeadingTxt">Candidate Name Search</label>
                </div>
                <div class="adStblColumnHeadingBG"> 
					<div class='searchHeadingColoum'>
                    	<div class='leftCol' >
							<div id='colTxtL'>
								<strong style="color:#FFF">Name</strong>
							</div>
						</div>
                        <div class='rightCol'>
                            <div id='colTxtR'>
                                 <strong style="color:#FFF">Skill Set</strong>
                            </div>
                        </div>                            
					</div>
                </div>
                <div id="adStblLeftRecordsColumn"><!--LEFT COLUMN-->
                
                </div>
            </div>
        </div>
    </div>
    <!--
    Candidate Name Search scroll table END
    -->
    <!--
    Advanced Search scroll table
    -->
    <div id="advanceSearchResult" style=" display:none; position:relative; float:left">
        <div id="adSearchscrollTableRow"><!--class="floatRow"-->
            <div class="innerStblContainer">
                <div class="adStblBG">
                	<label class="adStblHeadingTxt">Advanced Search</label>
                </div>
                <div class="adStblColumnHeadingBG">                    
                    <div class='searchHeadingColoum'>
                    <div class='leftCol' >
							<div id='colTxtL'>
								<strong style="color:#FFF">Name</strong>
							</div>
						</div>
                        <div class='rightCol'>
                            <div id='colTxtR'>
                                 <strong style="color:#FFF">Skill Set</strong>
                            </div>
                        </div>      
                       
                    </div>
                </div>
                <div id="adStblLeftRecordsColumnAdvance"><!--LEFT COLUMN-->
                </div>
            </div>
        </div>
    </div>
    <!--
    Advanced Search scroll table END
    -->
    <div class="floatRowSpacer">
    	<!--Spacer-->
    </div>
    <div class="AdSearchfloatRowBtns">

        <div id="adSearchStyling">
        	<div id="adSearchStylingInner">
                
            </div>
        </div>
    </div>
</form>
