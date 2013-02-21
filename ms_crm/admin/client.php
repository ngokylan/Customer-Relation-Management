<div class="includeContainer" style="overflow:scroll"><!--OUTER CONTAINER-->
	<div class="adminHeadingContainer">
    	<div class="adminHeadingPos">
        	<strong>Administration</strong> of Client Attributes</div>
    </div>
    <div align="center">
        <input id="btnClientAdd" type="button" value="Add New Client" onclick="addClient();" style="text-align:center" />
        <input id="btnClientView" type="button" value="View Client List" onclick="viewClient();" style="text-align:center" />
    </div>
    <form id="formClient" style="display:none"> 
	<div class="adminFloatRow"><!--adminFloatRow CONTAINER-->
    	<div class="tirdsContainer">
        	<div class="adminTxt">
            	<div class="adminTxtPos">
            		<label for="txtClientFirstName">First Name</label>
            	</div>
            </div>
            <div class="adminCaptureAsset">
            		<input type="text" name="txtClientFirstName" id="txtClientFirstName" class="" />
            </div>
        </div>
        <div class="tirdsContainer">
        	<div class="adminTxt">
            	<div class="adminTxtPos">
            		<label for="txtClientFirstName">Surname</label>
            	</div>
            </div>
            <div class="adminCaptureAsset">
            		<input type="text" name="txtClientSurname" id="txtClientSurname" class="" />
            </div>
        </div>
        <div class="tirdsContainer">
        	<div class="adminTxt">
            	<div class="adminTxtPos">
                	<label for="txtClientFirstName">Company</label>
            	</div>
            </div>
            <div class="adminCaptureAsset">
		            <input type="text" name="txtClientCompany" id="txtClientCompany" class="" />
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
            		<lable for="txtClienFirstName">Street Number</label>
            	</div>
            </div>
            <div class="adminCaptureAsset">
            		<input type="text" name="txtClientStreetNumber" id="txtClientStreetNumber" class="" />
            </div>
        </div>
    	<div class="tirdsContainer">
        	<div class="adminTxt">
            	<div class="adminTxtPos">
            		<label for="txtClienFirstName">Street Name</label>
           	  </div>
            </div>
            <div class="adminCaptureAsset">
            		<input type="text" name="txtClientStreetName" id="txtClientStreetName" class="" />
            </div>
        </div>
        <div class="tirdsContainer">
        	<div class="adminTxt">
            	<div class="adminTxtPos">
            		<label for="txtClienFirstName">City</label>
           	  </div>
            </div>
            <div class="adminCaptureAsset">
            		 <input type="text" name="txtClientCity" id="txtClientCity" class="" />
            </div>
        </div>
       
    </div><!--adminFloatRow CONTAINER END-->
    
    <div class="adminFloatRow"><!--adminFloatRow CONTAINER-->
    
    	<div class="tirdsContainer">
        	<div class="adminTxt">
            	<div class="adminTxtPos">
            		<label for="txtClienFirstName">State</label>
           	  </div>
            </div>
            <div class="adminCaptureAsset">
            		<select name="cboClientState" class="selectNonDate" id="cboClientState">
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
            		<lable for="txtClienFirstName">Postcode</label>
            	</div>
            </div>
            <div class="adminCaptureAsset">
            		<input type="text" name="txtClientPostCode" id="txtClientPostCode" class="" />
            </div>
        </div>
        <div class="tirdsContainer">
        	<div class="adminTxt">
            	<div class="adminTxtPos">
            		<label for="txtClienFirstName">Country</label>
           	  </div>
            </div>
            <div class="adminCaptureAsset">
            		 <input name="txtClientCountry" type="text" class="" id="txtClientCountry" value="Australia" />
            </div>
        </div>
       
    </div><!--adminFloatRow CONTAINER END-->
    
    <div class="adminFloatRow"><!--adminFloatRow CONTAINER-->
     <div class="tirdsContainer">
        	<div class="adminTxt">
            	<div class="adminTxtPos">
            		<lable for="txtClienFirstName">Mobile</label>
            	</div>
            </div>
            <div class="adminCaptureAsset">
            		<input type="text" name="txtClientMobile" id="txtClientMobile" class="" />
            </div>
        </div>
    	<div class="tirdsContainer">
        	<div class="adminTxt">
            	<div class="adminTxtPos">
            		<label for="txtClienFirstName">Phone</label>
           	  </div>
            </div>
            <div class="adminCaptureAsset">
            		<input type="text" name="txtClientPhone" id="txtClientPhone" class="" />
            </div>
        </div>
        <div class="tirdsContainer">
        	<div class="adminTxt">
            	<div class="adminTxtPos">
            		<label for="txtClienFirstName"></label>
           	  </div>
            </div>
            <div class="adminCaptureAsset">
       		  <input name="btnClientSave" id="btnClientSave" type="button" value="Save" style="width:70px" onclick="checkClientBtnSaveFunction();" />
              <input name="btnReset" type="reset" style="width:70px" />
            </div>
        </div>
       
    </div><!--adminFloatRow CONTAINER END-->
    </form>
    
    <iframe id="iframeClient" src="AgentAdmin_management/ViewClient.php"></iframe>
</div><!--OUTER CONTAINER END-->
