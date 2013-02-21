<!--
    Team:			blueSky
    Programmer:		Liam Handasyde | Tommy Wijaya | Sonia Schiavon
    Purpose:		Search Candidate first name 
    Client:			Milestone Search
    Version:		12.0 11.10.2010
    File:			search_header.php
-->

<div id="inc_searchContainer">
    <div id="headerBack">
<!--LOGO ====================================================================================================================================-->
        <div id="logoContainer">
        	<div id="logoPos">
        		<!--<label for="MainLogo" id="logo">Milestone Search</label>-->
                
        	</div>
		</div>
<!--HELP ON LINE ============================================================================================================================-->
		<!--<div id="hlpDiv">
        	<span onClick="openHelp_help_crm_index();">
            	CRM - Help on line
			</span>
		</div>-->
<!--CENTER CONTENT ===========================================================================================================================-->
            <div id="headerCenterContainer">
            	<div id="headerCenterInner">
            		<h4>   <?php
						/*//minh 10/05/2011
						//session_start();
						if(isset($_SESSION['usrType']) && $_SESSION['usrType'] == "1")
						{
							echo '<input id="nav_userpage" type="button" value="Admin Page" onclick="window.location= \'admin/index.php\'">';
						}	*/					
						?>
            		  <label for="consultant" class="formatphpDate"> Consultant : <label id="lblAgentName" class="formatphpDate"><?php echo $consultant;?></label></label>
            		  <label class='formatphpDate'> <?php echo $day . " . " . $month . " . " . $year; ?> </label>
           		  </h4>
            		
            		<h4>
            		  <input type="hidden" name="hiddenAgentID" id="hiddenAgentID" value="<?php echo $agentID; ?>">
          		  </h4>
                </div>
                <div id="logOutBtnPos">
                	<form name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                             <input type="submit" name="submit" id="submit" value="Logout">                          
					</form>
				</div>
            </div>
<!-- FORM START ============================================================================================================================-->
            <div id="nameSearchFormContainer">
           		<div id="nameSearchFormPos">
        <form class="searchform" id="inc_search_header" onKeyPress="return event.keyCode!=13">
        	<div id="formAssetContainer"><!--formAssetContainer-->
            		<div id="openCloseBtnContainer">
                    	<div id="openCloseBtnPos">
                    		<input class="searchbutton2" name="openClose" type="button" id="openClose"  value="Open CRM">
                    	</div>
                    </div>
                    <div id="nameSearchContainer">
                        <div id="nameSearchPos">
                            <input type="text" 
                                    class="searchfield" 
                                    id="searchHeaderTxtBox" 
                                    value="Candidate Name..." 
                                    name="candidateNameSearch" 
                                    onFocus="if (this.value == 'Candidate Name...'){this.value = '';}" 
                                    onBlur="if (this.value == '') {this.value = 'Candidate Name...';}else{ filltoTextbox(); hideSuggestionDiv();}"
                                    onKeyUp="lookup(this.value);" 
                                    onMouseDown="setSuggestionDiv(this,'suggestionDivTom',this.clientWidth)"
                                    autocomplete=off
                                    />
                        </div>
                    </div>
                            <div id="onlyMine">
                                <div id="onlyMeCheckContainer">
                                    <div id="onlyMeCheckPos">
                                        <input name="chkOnlyMe" id="chkOnlyMe" type="checkbox" value="yes" checked >
                                    </div>
                                </div>
                                <div id="onlyMeTxtContainer">
                                    <div id="onlyMeTxtPos">
                                        Only Mine
                                    </div>
                                </div>
                            </div>
					<div id="nameSearchGoContainer">
                        <div id="nameSearchGoPos">
                  			<input class="searchbutton" id="searchHeaderBtn" type="button" value="Go" name="submit" onClick="search(document.getElementById('searchHeaderTxtBox').value); document.getElementById('updateForm').reset();" /> 	<br>
                    	</div>
                    </div>
			</div><!--formAssetContainer END-->
        </form>

			</div>
        </div>
<!--FROM END ==================================================================================================================================--> 
        </div>
    </div>
     <div class="suggestionsBox" id="suggestions" style=" display:none; z-index:200">
		<div class="suggestionList" id="autoSuggestionsList" style="list-style-type:none">
		</div>
	</div>
</div>

