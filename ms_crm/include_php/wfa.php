<!--
    Team:			isync
    Programmer:		Minh | Giang | Michael | June
    Purpose:		Manages the Work Flow Action functionality
    Client:			Milestone Search
    Version:		13.1 10-3-2011
    File:			wfa.php
    
-->

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
	if ($arrRecords["hs_fieldID"] == 'Work Flow Action (WFA)')
	{
		$hs_wfaID = $arrRecords["hs_msg"];
		$hs_HwfaID = $arrRecords["hs_fieldID"];
	}
	if ($arrRecords["hs_fieldID"] == 'Candidate')
	{
		$hs_candidate = $arrRecords["hs_msg"];
		$hs_Hcandidate = $arrRecords["hs_fieldID"];
	}
}
	
//6 Free Recordset and Close connection
mysql_free_result($dbRecords);
mysql_close($db_con);
?>
<!-- Help System: sch09297795 - 05/10/10 END -->


<form action="" method="post" >
	<div class="floatRowWFA">
    	<div class="wfaLeft">
        	<!-- Help System: sch09297795 - 05/10/10 -->
            <label for="cboWfaWFAID" class="wfaLabelStyle"
            	onMouseOut="closeHelpSummary();" 
            	onMouseOver="helpSummary(this,'<?php echo $hs_wfaID?>', '<?php echo $hs_HwfaID." field"?>');" 
            	onDblClick="helpSummary(this,'<?php echo $hs_wfaID?>', '<?php echo $hs_HwfaID." field"?>');">WFA ID</label>
            <!--Wfa onclick: retrive WFAID description -->
            
                        <!--********MINH************** -->
                        <select name="cboWfaWFAID" class="wfaCboStyle" id="cboWfaWFAID" onChange="funRetrDescrWFA(this.value, 'WFA_code');" disabled="disabled">
            </select>
		</div>
        <div class="wfaRight">
            <label for="txtWfaCanId" class="wfaLabelStyle">Candidate Name</label>
            <input type="text" class="wfaTxtStyle" id="txtWfaCanId" name="txtWfaCanId" /><input type="hidden" id="txtCanID" name="txtCanID" />
		</div>
    </div>	
    <div class="floatRowWFA">
    	<div class="wfaLeft">
    	<label for="cboAssTemp" class="wfaLabelStyle">Template Assign</label>
        	<!--Wfa onclick: retrive WFATempID for Email Content -->
            <select name="cboAssTemp" class="wfaCboStyle" id="cboAssTemp" onChange="funRetrDescrWFA(this.value, 'WFA_template');" disabled="disabled">
			</select>
		</div>
                                                       
    	<div class="wfaRight">							
            <label for="wfaExpDt" class="wfaLabelStyle">WFA Expire</label>
				<input type="text" class="wfaTxtStyle"  id="wfaExpDt">
        </div>
    </div>
    <div class="floatRowWFA">
    	        
        <div class="wfaLeft">
        	<!-- Help System: sch09297795 - 05/10/10 -->
        	<label for="cboWfaStatus" class="wfaLabelStyle" id="wfaStatus"
            	onMouseOut="closeHelpSummary();"
        		onMouseOver="helpSummary(this,'State of the WFA assign to the candidate', 'WFA Status field');" 
                onDblClick="helpSummary(this,'State of the WFA assign to the candidate', 'WFA Status field');" >Contact Status</label>	
            <select name="cboWfaStatus" class="wfaCboStyle" id="cboWfaStatus">
                        <option value="notSelected"  selected="selected">Please select </option>
                        <option value="Active">Active</option>
                        <option value="Inactive">Inactive</option>
			</select>
            
        </div> 
        <div class="wfaRight">
        <input type="button" name="btnCanSatus" id="btnCanSatus" class="inc_buttons" value="Save" onClick="InactiveCandidate()">
        </div>
	</div>
   
    
    																							<!--DONE-->
    
    
    <div class="floatRowWFA">
    	<div class="wfaNotes">
        	<!-- Help System: sch09297795 - 05/10/10 -->
            <label for="wfaNotes" class="wfaLabelStyle"
            	onMouseOut="closeHelpSummary();"
        		onMouseOver="helpSummary(this,'Comment that the agent may insert after or before to contact the candidate', 'Notes field');"
                onDblClick="helpSummary(this,'Comment that the agent may insert after or before to contact the candidate', 'Notes field');">Notes</label>
            <input type="text" name="wfaNotes" class="wfaTxtStyle" id="wfaNotes"/>
        </div>
    </div>
    
    <div class="floatRow">	
    	<label class="labelStyleInfo">WFA Email Details</label>
        <input type="hidden" id="txtEmail"/> 
    </div>

    <div class="floatRowWFA">
    					                                <!-- sonia14102010 name conventioning for Email Subject ????-->
    	<div class="wfaNotes">
        	<!-- Help System: sch09297795 - 05/10/10 -->
            <label for="wfaSubject" class="wfaLabelStyle"
            	onMouseOut="closeHelpSummary();"
        		onMouseOver="helpSummary(this,'Subject content of the WFA template associated to the candidate that the agent may send to the candidate', 'Subject field');"
                onDblClick="helpSummary(this,'Subject content of the WFA template associated to the candidate that the agent may send to the candidate', 'Subject field');">Subject</label>
            <input type="text" name="wfaSubject" class="wfaTxtStyle" style="width:400px" id="wfaSubject"/>
        </div>
    </div>
    
        												 <!-- sonia14102010 name conventioning for Email Content ????-->
    <div class="floatRowWFATxa">
    	<div class="wfaTxa">
        	<!-- Help System: sch09297795 - 05/10/10 -->
            <label for="txaWfaMessage" class="wfaLabelTxaStyle"
            	onMouseOut="closeHelpSummary();"
        		onMouseOver="helpSummary(this,'Email content of the WFA template associated to the candidate that the agent may send to the candidate', 'Message content field');"
                onDblClick="helpSummary(this,'Email content of the WFA template associated to the candidate that the agent may send to the candidate', 'Message content field');">WFA Template</label>
		</div>
		<div id="wfaTextarea">
            	<div id="wfaTextareaInner">
            	  <textarea class="wfaTxaStyle" id="txaWfaMessage" name="txaWfaMessage" style="width:406px; height:245px"></textarea>
            	</div>
               
		</div>
    </div>
  
    <div class="floatRowWFA">
   		 <div id="adSearchHelp">
        	<div id="adSearchHelpInner"> 
                <span onClick="openHelp_InsUpdWFA();"><img src="image/help_icon.jpg" width="20" alt="Help" title="Help"/></span>
            </div>
        </div>
    	<div id="wfaSendBtnPosi">
        	<input type="button" name="wfaSendBtn" id="wfaSendBtn" class="inc_buttons" value="Send Email" onClick="sendEmail()">
        </div>
    </div>
   
    
    <div class="floatRowWFA">
       
       <div class="contentText">
        <div id="tableProgress" style="float: left; width: 100%; padding-top: 5px; padding-left: 0;">
         
        </div>
      </div>
       
         
    </div>
    
    <div class="floatRowWFA">
       
       <div class="contentText">
        <div id="tableReference" style="float: left; width: 95%; padding-top: 5px; padding-left: 0;">
       
        </div>
      </div>
       
         
    </div>
    
    
</form>
