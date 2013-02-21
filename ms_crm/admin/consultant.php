<!--
    Team:			blueSky
    Programmer:		Liam Handasyde | Tommy Wijaya | Sonia Schiavon
    Purpose:		CRM to manage mileston Search Candidates
    Client:			Milestone Search
    Version:		20.0 05.11.2010
    File:			consultant.php
-->
<div class="includeContainer" style="overflow:scroll"><!--OUTER CONTAINER-->
<div class="adminHeadingContainer">
    	<div class="adminHeadingPos"><strong>Administration</strong> of Agent Attributes</div>
  </div>
    <div align="center">
    <input id="btnAgentAdd" type="button" value="Add New Agent" onclick="addAgent();" style="text-align:center" />
    <input id="btnAgentView" type="button" value="View Agent List" onclick="viewAgent();" style="text-align:center" />
    </div>
    <form id="formAccount" style="display:none" >
	<div class="adminFloatRow"><!--adminFloatRow CONTAINER-->
    	<div class="tirdsContainer">
        	<div class="adminTxt">
            	<div class="adminTxtPos">
     				<label for="txtAgentFirstName2">First Name</label>
				</div>
            </div>
            <div class="adminCaptureAsset">  
            		<input type="text" name="txtAgentFirstName" id="txtAgentFirstName" class="" />
            </div>
        </div>
        <div class="tirdsContainer">
        	<div class="adminTxt">
            	<div class="adminTxtPos"><label for="txtAgentFirstName3">Surname</label></div>
            </div>
            <div class="adminCaptureAsset"><input type="text" name="txtAgentSurname" id="txtAgentSurname" class="" /></div>
        </div>
      	<div class="tirdsContainer">
        	<div class="adminTxt">
            	<div class="adminTxtPos"><label for="txtAgentFirstName4">Password</label></div>
            </div>
            <div class="adminCaptureAsset"> <input type="text" name="txtAgentPassword" id="txtAgentPassword" class="" /></div>
        </div>
    </div><!--adminFloatRow CONTAINER END-->
    
    <div class="adminFloatRow"><!--adminFloatRow CONTAINER-->
    	<div class="tirdsContainer">
        	<div class="adminTxt">
            	<div class="adminTxtPos"><label for="txtAgentFirstName5">Level of Access</label></div>
            </div>
            <div class="adminCaptureAsset">
            	<select name="cboAgentAccessLevel" class="selectNonDate" id="cboAgentAccessLevel">
                	<option value="2" selected="selected">User</option>
                	<option value="1">Administrator</option>
              	</select>
            </div>
        </div>
        <div class="tirdsContainer">
        	<div class="adminTxt">
            	<div class="adminTxtPos"><label for="txtAgentFirstName6">Account Access</label></div>
            </div>
            <div class="adminCaptureAsset">
            		 <select name="cboAgentAccessStatus" class="selectNonDate" id="cboAgentAccessStatus"><!--==========================================-->
                        <option value="3">Locked</option>
                        <option value="0" selected="selected">Un Lock</option>
					</select> 
            </div>
        </div>
        <div class="tirdsContainer">
        	<div class="adminTxt">
            	<div class="adminTxtPos">
            	</div>
            </div>
            <div class="adminCaptureAsset">
            		
            </div>
        </div>
    </div><!--adminFloatRow CONTAINER END-->
    
    <div class="adminFloatRow"><!--adminFloatRow CONTAINER-->
	&nbsp;&nbsp;<label id="labelInformation">Contact Information</label>
    </div><!--adminFloatRow CONTAINER END-->
    <div class="adminFloatRow"><!--adminFloatRow CONTAINER-->
    	<div class="tirdsContainer">
        	<div class="adminTxt">
            	<div class="adminTxtPos">
            		<lable for="txtAgentFirstName">Street Number</label>
            	</div>
            </div>
            <div class="adminCaptureAsset">
            		<input type="text" name="txtAgentStreetNumber" id="txtAgentStreetNumber" class="" />
            </div>
        </div>
    	<div class="tirdsContainer">
        	<div class="adminTxt">
            	<div class="adminTxtPos">
            		<label for="txtAgentFirstName">Street Name</label>
            	</div>
            </div>
            <div class="adminCaptureAsset">
            		<input type="text" name="txtAgentStreetName" id="txtAgentStreetName" class="" />
            </div>
        </div>
        <div class="tirdsContainer">
        	<div class="adminTxt">
            	<div class="adminTxtPos">
            		<label for="txtAgentFirstName">City</label>
            	</div>
            </div>
            <div class="adminCaptureAsset">
            		 <input type="text" name="txtAgentCity" id="txtAgentCity" class="" />
            </div>
        </div>
       
    </div><!--adminFloatRow CONTAINER END-->
    
    <div class="adminFloatRow"><!--adminFloatRow CONTAINER-->
    
    	<div class="tirdsContainer">
        	<div class="adminTxt">
            	<div class="adminTxtPos">
            		<label for="txtAgentFirstName">State</label>
            	</div>
            </div>
            <div class="adminCaptureAsset">
            		<select name="cboAgentState" class="selectNonDate" id="cboAgentState">
                        <option value="">Please select </option>
                        <option value="VIC" selected="selected">Victoria</option>
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
        </div>
         <div class="tirdsContainer">
        	<div class="adminTxt">
            	<div class="adminTxtPos">
            		<lable for="txtAgentFirstName">Postcode</label>
            	</div>
            </div>
            <div class="adminCaptureAsset">
            		<input type="text" name="txtAgentPostCode" id="txtAgentPostCode" class="" />
            </div>
        </div>
        <div class="tirdsContainer">
        	<div class="adminTxt">
            	<div class="adminTxtPos">
            		<label for="txtAgentFirstName">Country</label>
            	</div>
            </div>
            <div class="adminCaptureAsset">
            		 <input name="txtAgentCountry" type="text" class="" id="txtAgentCountry" value="Australia" />
            </div>
        </div>
       
    </div><!--adminFloatRow CONTAINER END-->
    
    <div class="adminFloatRow"><!--adminFloatRow CONTAINER-->
     <div class="tirdsContainer">
        	<div class="adminTxt">
            	<div class="adminTxtPos">
            		<lable for="txtAgentFirstName">Mobile</label>
            	</div>
            </div>
            <div class="adminCaptureAsset">
            		<input type="text" name="txtAgentMobile" id="txtAgentMobile" class="" />
            </div>
      </div>
    	<div class="tirdsContainer">
        	<div class="adminTxt">
            	<div class="adminTxtPos">
            		<label for="txtAgentFirstName">Phone</label>
            	</div>
            </div>
            <div class="adminCaptureAsset">
            		<input type="text" name="txtAgentPhone" id="txtAgentPhone" class="" />
            </div>
        </div>
        <div class="tirdsContainer">
        	<div class="adminTxt">
            	<div class="adminTxtPos">
            		<label for="txtAgentFirstName"></label>
            	</div>
            </div>
            <div class="adminCaptureAsset">
       		  <input name="btnSave" id="btnSave" type="button" value="Save" style="width:70px" onclick="checkBtnSaveFunction();" />
              <input name="btnReset" type="reset" style="width:70px" />
            </div>
        </div>
       
    </div><!--adminFloatRow CONTAINER END-->
  </form>

<iframe id="iframeAdmin" src="AgentAdmin_management/ViewAgent.php"></iframe>

</div><!--OUTER CONTAINER END-->
    
