// JavaScript Document
/*
    Team:			blueSky
    Programmer:		Tommy Saputra Wijaya
    Purpose:		Support Function
    Client:			Milestone Search
    Version:		10.0 03.10.2010
    File:			helpSystem.js
	
	LIAM VERSION
*/
	//<!-- choose .css styling based on browser / device type -->
	var browserDetect = "blank_value";
	var value = 0;
	
	if(BrowserDetect.browser == "Firefox")
	{
		browserDetect = "firefox Sniffer css";//FIREFOX CSS
		value = 1;
	}
	if(BrowserDetect.browser == "Explorer")
	{
		browserDetect = "explorer Sniffer css";//EXPLORER CSS
		value = 2;
	}
	if(BrowserDetect.browser == "Safari")
	{
		browserDetect = "Un-supported browser type!";
		value = 3;	
	}
	if(BrowserDetect.browser == "Chrome")
	{
		browserDetect = "chrome Sniffer css";
		value = 4;
	}
	
	//document.write(browserDetect);
	//document.write("-------------"+csslink);
//<!-- implements browser / device sniffer decission  -->	

	function addCSS() {
            var headtg = document.getElementsByTagName('head')[0];
            if (!headtg) {
                return;
            }
			
            var linktg = document.createElement('link');
            linktg.type = 'text/css';
            linktg.rel = 'stylesheet';
			
				if (value == 1)	{
	            linktg.href = 'css/ui-lightness/ff.css';
				//alert ("ff");
            }else if (value == 2){
	            linktg.href = 'css/ui-lightness/ie.css';//--------Internet Explorer
				//alert ("ie");
			}else if(value == 3){
				linktg.href = 'css/ui-lightness/s.css';
				//alert ("s");
			}else if(value == 4){
				//alert ("chrome");
				linktg.href = 'css/ui-lightness/gc.css';//--------Google Chrome
			}else {
			    linktg.href = 'css/ui-lightness/gc.css';
				//alert ("other");
			}	
				
			linktg.title = 'Rounded Corners';
            headtg.appendChild(linktg);
   }

//sliding panel functionality
$(document).ready(function(){
	//adding the toggle function to the tab
	$('#openClose').toggle(function(){
		//sliding the panel 
		$('#crmPanel').stop().animate({width:"560px", opacity:1.0}, 650, function() {
			//slieds the content into view
			document.getElementById('openClose').value="Close CRM";
			$('.crmContent').fadeIn('fast');
			$("#accordion").accordion({ header: "h3" });
		});
	},
	//when the tab is next clicked
	function(){
		//fade out the content
		document.getElementById('openClose').value="Open CRM";
		$('.crmContent').fadeOut('slow', function() {
		});
	});	
});
//sliding panel functionality END
			
			//defined open WFA in Agent To Do List ********************MINH******20/04/2011***********************
			
			//defined open location *********************************MINH*****************************	
			//Search WFA By Their ID to Read from Search Result into WFA Details
			function searchWFAByCandidateID(inputString) {
				document.getElementById('txtWfaCanId').value = inputString ;
				if(inputString.length == 0) {
					// Hide the suggestion box.
					$('#suggestions').hide();
				} else {
					$.post("include_php/readWfaCandidateDetails.php", {queryString: ""+inputString+""}, function(data){
						if(data.length >0) {
							$('#insertFromDatabase').html(data);
							$('#suggestions').hide();
						}
					});
				}
			} // lookup
			
			function openCandidate_update( candidateID, candidateName, wfaID){
				$('#can').click();//--id of the tab needed to open
				//document.getElementById('txtInsertFName').value=candidateID;//parses info 
				document.getElementById('candidateLabel').innerHTML = "Update Candidate | Name: " + candidateName + " | ID : "+candidateID;	
				searchCandidateByID(candidateID);
				document.getElementById('btnSubmit').value="Update";
				document.getElementById('hiddenCandidateID').value = candidateID;
				
				/* Wfa 01112010: Check if WFA exist	*/
				if (!(wfaID == "")){
					document.getElementById('WFALabel').innerHTML = "Customise Email";	
					searchWFAByCandidateID(candidateID);
					document.getElementById('btnSubmitWFA').value="Update";
					document.getElementById('hiddenCandidateID').value = candidateID;
					
					
					$.post("include_php/searchWfaDescr_WfaEmailContent.php",{queryString: ""+wfaID+"", type: "WFA_code", candidateID: ""+candidateID+""}, function(data)																																		  						{
					if(data.length >0) 
					//alert(data);			
						$('#insertFromDatabase').html(data);
					});;
					
					
				} else {
					document.getElementById('WFALabel').innerHTML = "Insert Work Flow Action";	
					document.getElementById('btnSubmitWFA').value="Save";
					$('#btnResetWFA').click();
				}
				//get the value of the candidate id in the wfa form
				//document.getElementById('txtWfaCanId').value = candidateID;
				/* 	END Wfa 01112010: Check if WFA exist */
			}			
			
			function openCandidate( candidateID, wfaTimestamID){
				$('#can').click();//--id of the tab needed to open
				//document.getElementById('txtInsertFName').value=candidateID;//parses info 
				document.getElementById('candidateLabel').innerHTML = "Update Candidate | Candidate ID : "+candidateID;	
				searchCandidateByID(candidateID);
				document.getElementById('btnSubmit').value="Update";
				document.getElementById('hiddenCandidateID').value = candidateID;
				
				/* Wfa 01112010: Check if WFA exist	*/
				if (!(wfaTimestamID == "")){
					document.getElementById('WFALabel').innerHTML = "Customise Email";	
					searchWFAByCandidateID(candidateID);
					document.getElementById('btnSubmitWFA').value="Update";
					document.getElementById('hiddenCandidateID').value = candidateID;
				} else {
					document.getElementById('WFALabel').innerHTML = "Insert Work Flow Action";	
					document.getElementById('btnSubmitWFA').value="Save";
					$('#btnResetWFA').click();
				}
				//get the value of the candidate id in the wfa form
				//document.getElementById('txtWfaCanId').value = candidateID;
				/* 	END Wfa 01112010: Check if WFA exist */
			}
			
			//Reset The Candidate Form & Tab to Insert New Candidate
			function funResetBar(){
				document.getElementById('candidateLabel').innerHTML = "Insert New Candidate";	
				document.getElementById('btnSubmit').value="Save";
				
			}
			
			//Search Candidate By Their ID to Read from Search Result In to Candidate Details
			function searchCandidateByID(inputString) {
				// move the folling line into function searchWFAByCandID(candidateID) -> pollon
				//document.getElementById('txtWfaCanId').value = inputString ;
				if(inputString.length == 0) {
					// Hide the suggestion box.
					$('#suggestions').hide();
				} else {
					$.post("include_php/readCandidateDetails.php", {queryString: ""+inputString+""}, function(data){
						if(data.length >0) {
							$('#insertFromDatabase').html(data);
							$('#suggestions').hide();
						}
					});
				}
			} // lookup
			
			//To Auto Choose for Save the Candidate or Update The Candidate
			function funChooseEvent(strValue){
				if (document.getElementById('txtInsertFName').value == "")		{alert ("Please Fill First Name"); return false;}
				if (document.getElementById('txtInsertSurname').value == "")	{alert ("Please Fill Surname"); return false;}
				if (document.getElementById('txtInsertStNum').value == "")		{alert ("Please Fill Street Number"); return false;}
				if (document.getElementById('txtInsertStName').value == "")		{alert ("Please Fill Street Name"); return false;}
				if (document.getElementById('txtInsertCity').value == "")		{alert ("Please Fill City"); return false;}
				if (document.getElementById('txtInsertPostCode').value == "")	{alert ("Please Fill Post Code"); return false;}
				if (document.getElementById('txtInsertCountry').value == "")	{alert ("Please Fill Country"); return false;}
				if (document.getElementById('txtInsertMobile').value == "")		{alert ("Please Fill Mobile"); return false;}
				if (document.getElementById('txtInsertHPhone').value == "")		{alert ("Please Fill Home Phone"); return false;}
				if (document.getElementById('txtInsertComp').value == "")		{alert ("Please Fill Company"); return false;}
				if (document.getElementById('txtInsertWorkPhone').value == "")	{alert ("Please Fill Work Phone"); return false;}
				if (document.getElementById('txtInsertWorkFax').value == "")	{alert ("Please Fill Work Fax"); return false;}
				if (document.getElementById('dateInsertNextAvailable').value == ""){alert ("Please Fill Next Available Date"); return false;}
				if (document.getElementById('dateInsertInitialContact').value == ""){alert ("Please Fill Initial Contact"); return false;}
				if (document.getElementById('txtInsertSellRate').value == "")	{alert ("Please Fill Sell Rate"); return false;}
				if (document.getElementById('txtInsertBuyRate').value == "")	{alert ("Please Fill Buy Rate"); return false;}
				if (document.getElementById('txtInsertRate').value == "")		{alert ("Please Fill Rate"); return false;}
				if (document.getElementById('txtInsertNotes').value == "")		{alert ("Please Fill Notes"); return false;}	
				if (document.getElementById('txtInsertEmail').value == "")		{alert ("Please Fill Email"); return false;}
				if (document.getElementById('txtInsertJobTitle').value == "")	{alert ("Please Fill Job Title"); return false;}
				if (document.getElementById('txtInsertJobDescription').value == ""){alert ("Please Fill Job Description"); return false;}
				if (document.getElementById('txtInsertSkill').value == "")		{alert ("Please Fill Major Skill"); return false;}
				if (document.getElementById('txtInsertSkillDes').value == "")	{alert ("Please Fill Skill Description"); return false;}
				
				if (document.getElementById('cboInsertState').value == "notSelected") 		{alert ("Please Select State"); return false;}
				if (document.getElementById('cboInsertScoring').value == "notSelected") 	{alert ("Please Select Scoring"); return false;}
				if (document.getElementById('cboInsertRelatStatus').value == "notSelected") {alert ("Please Select Relation Status"); return false;}
				if (document.getElementById('cboInsertCurrEngageType').value == "notSelected") {alert ("Please Select Engagement Type"); return false;}
				if (document.getElementById('rateType').value == "notSelected") 			{alert ("Please Select Rate Type"); return false;}
				if (document.getElementById('sellRateType').value == "notSelected") 		{alert ("Please Select Sell Rate Type"); return false;}
				if (document.getElementById('buyRateType').value == "notSelected") 			{alert ("Please Select Buy Rate Type"); return false;}
				if (document.getElementById('cboInsertStatus').value == "notSelected") 		{alert ("Please Select Status"); return false;}
				
				if(strValue == "Save"){
					funInsertCandidate();
				}else{
					if(confirm('Are you sure, you want to update?')){
						funUpdateCandidate();
					}else{ 
					//alert('Update Canceled!');
					}
				}
			}
			/*
			
			
			//Search WFA description By WFA ID to Read from Search Result into WFAID Details  -> test for retrieve wfa description after selecting wfaid from form //soniaaaaaaa
			function searchWFAByWfaID(inputString) {
				//document.getElementById('cboWfaWFAID').value = inputString ;
				if(inputString.length == 0) {
					// Hide the suggestion box.
					$('#suggestions').hide();
				} else {
					$.post("include_php/readWfaDetails.php", {queryString: ""+inputString+""}, function(data){
						if(data.length >0) {
							$('#insertFromDatabase').html(data);
							$('#suggestions').hide();
						}
					});
				}
			} // lookup*/
			
			//Insert Candidate To Database
			function funInsertCandidate()
			{
				var ajaxRequest; // The variable that makes Ajax possible!
				try{
					// Opera 8.0+, Firefox, Safari
					ajaxRequest = new XMLHttpRequest();
				} catch (e){
					// Internet Explorer Browsers
					try{
						ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
					} catch (e) {
						try{
							ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
						} catch (e){
							// Something went wrong
							alert("Your browser broke!");
							return false;
						}
					}
				}
				// Create a function that will receive data sent from the server
				ajaxRequest.onreadystatechange = function(){
					if(ajaxRequest.readyState == 4){
						document.myForm.time.value = ajaxRequest.responseText;
					}
				}
				
				var fName = document.getElementById('txtInsertFName').value;
				var lName = document.getElementById('txtInsertSurname').value;
				var streeNum = document.getElementById('txtInsertStNum').value;
				var streetName = document.getElementById('txtInsertStName').value;
				var city = document.getElementById('txtInsertCity').value;
				var state = document.getElementById('cboInsertState').value;
				var postCode = document.getElementById('txtInsertPostCode').value;
				var country = document.getElementById('txtInsertCountry').value;
				var mobile = document.getElementById('txtInsertMobile').value;
				var homePhone = document.getElementById('txtInsertHPhone').value;
				var company = document.getElementById('txtInsertComp').value;
				var workPhone = document.getElementById('txtInsertWorkPhone').value;
				var workFax = document.getElementById('txtInsertWorkFax').value;
				var nextAvailable = document.getElementById('dateInsertNextAvailable').value;
				var initialContact = document.getElementById('dateInsertInitialContact').value;
				var scoring = document.getElementById('cboInsertScoring').value;
					
				var relationshipStatus = document.getElementById('cboInsertRelatStatus').value;
				var sellRate = document.getElementById('txtInsertSellRate').value;
				var buyRate = document.getElementById('txtInsertBuyRate').value;
				var rate = document.getElementById('txtInsertRate').value;
			
				var currentEngageType = document.getElementById('cboInsertCurrEngageType').value;
				var notes = document.getElementById('txtInsertNotes').value;	
				var email = document.getElementById('txtInsertEmail').value;
					
				var typeRate =document.getElementById('rateType').value;
				var typeSellRate=document.getElementById('sellRateType').value;
				var typeBuyRate=document.getElementById('buyRateType').value;
				
				var statusID=document.getElementById('cboInsertStatus').value;
				
				var jobTitle =document.getElementById('txtInsertJobTitle').value;
				var jobDescription =document.getElementById('txtInsertJobDescription').value;
				
				var skillShortDesc=document.getElementById('txtInsertSkill').value;
				var skillLongDesc=document.getElementById('txtInsertSkillDes').value;
				
				var agentID=document.getElementById('hiddenAgentID').value;
				var wfa_id = document.getElementById('cbAssignWFA').value;
				
				var queryString = 
				"?fName=" + fName+
				"&lName=" + lName+
				"&streeNum=" + streeNum+
				"&streetName=" + streetName+
				"&city=" + city+
				"&state=" + state+
				"&postCode=" + postCode+
				"&country=" + country+
				"&mobile=" + mobile+
				"&homePhone=" + homePhone+
				"&company=" + company+
				"&workPhone=" + workPhone+
				"&workFax=" + workFax+
				"&nextAvailable=" + nextAvailable+
				"&initialContact=" + initialContact+
				"&scoring=" + scoring+
				"&relationshipStatus=" + relationshipStatus+
				"&sellRate=" + sellRate+
				"&buyRate=" + buyRate+
				"&rate=" + rate+
				"&currentEngageType=" + currentEngageType+
				"&notes=" + notes+
				
				"&email=" + email+
				"&typeRate=" + typeRate+
				"&typeSellRate=" + typeSellRate+
				"&typeBuyRate=" + typeBuyRate+
				"&statusID=" + statusID+
				"&jobTitle=" + jobTitle+
				"&jobDescription=" + jobDescription+
				"&skillShortDesc=" + skillShortDesc+
				"&skillLongDesc=" + skillLongDesc+
				"&wfaid=" + wfa_id+
				"&agentID=" + agentID;
										
				ajaxRequest.open("GET", "include_php/insertCandidate.php" + queryString, true);
				ajaxRequest.send(null); 
				//alert(queryString);
				alert ('Insert Success');
				$('#insertBtnReset').click();
				
			}
			
			//For Send Value To Update the Candidate inside the database
			function funUpdateCandidate()
			{
				$('#AgentToDoList_panel').click();
				alert ('Update Success');
				var ajaxRequest; // The variable that makes Ajax possible!
				try{
					// Opera 8.0+, Firefox, Safari
					ajaxRequest = new XMLHttpRequest();
				} catch (e){
					// Internet Explorer Browsers
					try{
						ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
					} catch (e) {
						try{
							ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
						} catch (e){
							// Something went wrong
							alert("Your browser broke!");
							return false;
						}
					}
				}
				// Create a function that will receive data sent from the server
				ajaxRequest.onreadystatechange = function(){
					if(ajaxRequest.readyState == 4){
						document.myForm.time.value = ajaxRequest.responseText;
					}
				}
				
				var fName = document.getElementById('txtInsertFName').value;
				var lName = document.getElementById('txtInsertSurname').value;
				var streeNum = document.getElementById('txtInsertStNum').value;
				var streetName = document.getElementById('txtInsertStName').value;
				var city = document.getElementById('txtInsertCity').value;
				var state = document.getElementById('cboInsertState').value;
				var postCode = document.getElementById('txtInsertPostCode').value;
				var country = document.getElementById('txtInsertCountry').value;
				var mobile = document.getElementById('txtInsertMobile').value;
				var homePhone = document.getElementById('txtInsertHPhone').value;
				var company = document.getElementById('txtInsertComp').value;
				var workPhone = document.getElementById('txtInsertWorkPhone').value;
				var workFax = document.getElementById('txtInsertWorkFax').value;
				var nextAvailable = document.getElementById('dateInsertNextAvailable').value;
				var initialContact = document.getElementById('dateInsertInitialContact').value;
				var scoring = document.getElementById('cboInsertScoring').value;
					
				var relationshipStatus = document.getElementById('cboInsertRelatStatus').value;
				var sellRate = document.getElementById('txtInsertSellRate').value;
				var buyRate = document.getElementById('txtInsertBuyRate').value;
				var rate = document.getElementById('txtInsertRate').value;
			
			
				var currentEngageType = document.getElementById('cboInsertCurrEngageType').value;
				var notes = document.getElementById('txtInsertNotes').value;	
				
				//var engagementType = document.getElementById('cboInsertEngageType').value; "&engagementType="+engagementType+
				var email = document.getElementById('txtInsertEmail').value;
					
				var typeRate =document.getElementById('rateType').value;
				var typeSellRate=document.getElementById('sellRateType').value;
				var typeBuyRate=document.getElementById('buyRateType').value;
				
				var statusID=document.getElementById('cboInsertStatus').value;
				
				var jobTitle =document.getElementById('txtInsertJobTitle').value;
				var jobDescription =document.getElementById('txtInsertJobDescription').value;
				
				var skillShortDesc=document.getElementById('txtInsertSkill').value;
				var skillLongDesc=document.getElementById('txtInsertSkillDes').value;
				
				var agentID		= document.getElementById('hiddenAgentID').value;
				var candidateID	= document.getElementById('hiddenCandidateID').value;
				
				// ----- Minh 17/05/2011----				
				var wfa_id = document.getElementById('cbAssignWFA').value;
				
				//var contactID=document.getElementById('hiddenContactID').value;
				
				var queryString = "?fName="+fName+
				"&lName="+lName+
				"&streeNum="+streeNum+
				"&streetName="+streetName+
				"&city="+city+
				"&state="+state+
				"&postCode="+postCode+
				"&country="+country+ "&mobile="+mobile+ "&homePhone="+homePhone+ "&company="+company+ "&workPhone="+workPhone+ "&workFax="+workFax+ "&nextAvailable="+nextAvailable+ "&initialContact="+initialContact+ "&scoring="+scoring+ "&relationshipStatus="+relationshipStatus+ "&sellRate="+sellRate+ "&buyRate="+buyRate+ "&rate="+rate+ "&currentEngageType="+currentEngageType+ "&notes="+notes+  "&email="+email+ "&typeRate="+typeRate+ "&typeSellRate="+typeSellRate+ "&typeBuyRate="+typeBuyRate+ "&statusID="+statusID+ "&jobTitle="+jobTitle+ "&jobDescription="+jobDescription+ "&skillShortDesc="+skillShortDesc+ "&skillLongDesc="+skillLongDesc+ "&candidateID="+candidateID+"&agentID="+agentID+"&wfaid=" + wfa_id;
				
				ajaxRequest.open("GET", "include_php/updateCandidate.php" + queryString, true);
				ajaxRequest.send(null); 
				loadTodoList(agentID);
			}

							
				
				$(function() {		
						   $( "#adSearchNextAvailable" ).datepicker();		
						   $( "#adSearchNextAvailable" ).change(function() {			
						   $( "#adSearchNextAvailable" ).datepicker( "option", "dateFormat", "yy-mm-dd" );		});	
						   });

				$(function() {		
						   $( "#dateInsertNextAvailable" ).datepicker();		
						   $( "#dateInsertNextAvailable" ).change(function() {			
						   $( "#dateInsertNextAvailable" ).datepicker( "option", "dateFormat", "yy-mm-dd" );		});	
						   });
				$(function() {		
						   $( "#dateInsertInitialContact" ).datepicker();		
						   $( "#dateInsertInitialContact" ).change(function() {			
						   $( "#dateInsertInitialContact" ).datepicker( "option", "dateFormat", "yy-mm-dd" );		});	
						   });
				
				$(function() {		
						   $( "#wfaNextAvailable" ).datepicker();		
						   $( "#wfaNextAvailable" ).change(function() {			
						   $( "#wfaNextAvailable" ).datepicker( "option", "dateFormat", "yy-mm-dd" );		});	
						   });
			
			//To Search Candidate and display it
			function search(inputString) {
				
				var checkOnlyMine;
				if(document.getElementById('openClose').value == "Open CRM"){
					$('#openClose').click();
				}
				
				if(inputString.length == 0) {
					$('#suggestions').hide();
				}
				else 
				{
						if (document.getElementById('chkOnlyMe').checked == true){
							checkOnlyMine = document.getElementById('hiddenAgentID').value;// "yes";
							//alert (checkOnlyMine);
						}
						else
						{
							checkOnlyMine = "no";
						}
						$.post("include_php/resultCandidateList.php", {queryString: ""+inputString+"",checkMine: ""+checkOnlyMine+""}, function(data){
						if(data.length >0) {
							$('#searchResult').show();
							$('#advanceSearchResult').hide();
							$('#suggestions').hide();
							$('#adStblLeftRecordsColumn').html(data);
							$('#advanSearch').click();//Open Advance Search TAB ------------------------------------------
						}
						
					});
				}	
				
				
			} 
			//TommyChange
			function advanceSearch() {
				//alert("Advance Search");
				var inputString = "Hore";
				var vState = $("#adSearchState").val();
				var vNextDate = $("#adSearchNextAvailable").val();
				var vStatus = $("#cboAdSearchStatus").val();
				var vSkill = $("#txtAdSearchSkillSet").val();
				var checkOnlyMine;
				//alert (vState +" "+ vNextDate +" "+ vStatus +" "+ vSkill);
				
				if(vStatus == "notSelected"){
					vStatus = "";
				}
				if(vState == "notSelected"){
					vState = "";
				}
				
				if (document.getElementById('chkOnlyMe').checked == true){
						checkOnlyMine = document.getElementById('hiddenAgentID').value;// "yes";
					}else{
						checkOnlyMine = "no";
					}
					
				if(vState =="" && vNextDate=="" && vStatus=="" && vSkill=="") {
					alert("Please at least input one criteria");
				} else {
						//alert(checkOnlyMine);
						$.get("include_php/resultCandidateAdvanceList.php", {
							  qState: vState,
							  qNextDate: vNextDate,
							  qStatus: vStatus,
							  qSkill: vSkill,
							  checkMine: checkOnlyMine
							  }, function(data){
						if(data.length >0) {
							//alert(data);
							$('#searchResult').hide();
							$('#advanceSearchResult').show();
							$('#adStblLeftRecordsColumnAdvance').html(data);
							
						}
					});
				}
			} 
			

			
			//This for AutoComplete on Search Text Box Field.
			function lookup(inputString) {
				if(inputString.length == 0) {
					$('#suggestionDivTom').hide();
				} else {
					$.post("include_php/resultList.php", {queryString: ""+inputString+""}, function(data){
						if(data.length >0) {
							$('#suggestionDivTom').show();
							$('#autoSuggestionsListTom').html(data);
						}
					});
				}
			} 
			// To Fill From Search Function
			function filltoTextbox(thisValue) {
				$('#searchHeaderTxtBox').val(thisValue);
				setTimeout("$('#suggestionDivTom').hide();", 200);
			}
			
			function hideSuggestionDiv(){
				setTimeout("$('#suggestionDivTom').hide();", 200);
			}
			
			//This for Skill AutoSuggestion on SkillSet Text Box Field.
			function lookupSkillSet(inputString) {
				if(inputString.length == 0) {
					$('#suggestionDivTom').hide();
				} else {
					$.post("include_php/getSkillSet.php", {queryString: ""+inputString+""}, function(data){
						if(data.length >0) {
							$('#suggestionDivTom').show();
							$('#autoSuggestionsListTom').html(data);
						}
					});
				}
			} 
			// To Fill From SkillSet Function
			function filltoSkillTextbox(thisValue) {
				$('#txtAdSearchSkillSet').val(thisValue);
				setTimeout("$('#suggestionDivTom').hide();", 200);
			}
			
			
//<!--//---------------------------------+
//  Developed by Roshan Bhattarai 
//  Visit http://roshanbh.com.np for this script and more.
//  This notice MUST stay intact for legal use
// --------------------------------->
$(document).ready(function(){
	$("#txtInsertPostCode").keypress(function (e)  	{  if( e.which!=8 && e.which!=0 && (e.which<48 || e.which>57)) 					{ return false;}		});
	$("#txtInsertMobile").keypress(function (e)  	{  if( e.which!=8 && e.which!=0 && e.which!=32 && (e.which<48  || e.which>57)) 	{ return false;}		});
	$("#txtInsertHPhone").keypress(function (e)  	{  if( e.which!=8 && e.which!=0 && e.which!=32 && (e.which<48 || e.which>57)) 	{ return false;}		});
	$("#txtInsertWorkPhone").keypress(function (e)  {  if( e.which!=8 && e.which!=0 && e.which!=32 && (e.which<48 || e.which>57)) 	{ return false;}		});
	$("#txtInsertWorkFax").keypress(function (e)  	{  if( e.which!=8 && e.which!=0 && e.which!=32 && (e.which<48 || e.which>57)) 	{ return false;}		});
	$("#txtInsertRate").keypress(function (e)  		{  if( e.which!=8 && e.which!=0 && e.which!=46 && (e.which<48 || e.which>57)) 	{ return false;}		});
	$("#txtInsertBuyRate").keypress(function (e)  	{  if( e.which!=8 && e.which!=0 && e.which!=46 && (e.which<48 || e.which>57)) 	{ return false;}		});
	$("#txtInsertSellRate").keypress(function (e)  	{  if( e.which!=8 && e.which!=0 &&  e.which!=46 &&(e.which<48 || e.which>57)) 	{ return false;}		});
  });

//this for validating email
function isValidEmailAddress(emailAddress) {
var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
return pattern.test(emailAddress);
}

$(document).ready(function() {
$("#txtInsertEmail").keyup(function(){
	var email = $("#txtInsertEmail").val();
		if(email != 0)
		{
			if(isValidEmailAddress(email))
			{
			$("#txtInsertEmail").css({ "background-color": "#FFF" });
			} else {
			$("#txtInsertEmail").css({ "background-color": "#FC3" });
			}
		} else {
			$("#txtInsertEmail").css({ "background-color": "#FFF" });
		}
	});
});

//<!--//---------------------------------+
//  Manage WFA Sonia 01112010
// --------------------------------->
/* Wfa 01112010: Reset The WFA Form & Tab to Insert New WFA */
	function funResetBarWFA(){
		document.getElementById('WFALabel').innerHTML = "Insert Work Flow Action";	
		document.getElementById('btnSubmitWFA').value="Save";
	} /* END Wfa 01112010: Reset The WFA Form & Tab to Insert New WFA */
			
/* Wfa 01112010: Search WFA By Their ID to Read from Search Result into WFA Details */
	function searchWFAByCandID(inputString, temp_id) {
			
		$('#WFA_panel').click();//--id of the tab needed to open
		if(inputString.length == 0) {
			// Hide the suggestion box.
			$('#suggestions').hide();
		} else {
			$.post("include_php/readWfaDetails.php", {queryString: ""+inputString+"", tempid: ""+temp_id+""}, function(data){
				if(data.length >0) {
					//alert(data);
					$('#insertFromDatabase').html(data);
					$('#suggestions').hide();
				}
			});
		}
	} /* END Wfa 01112010: Search WFA By Their ID to Read from Search Result into WFA Details */

/* Wfa 01112010: Search WFA description By WFA ID to Read from Search Result into WFAID Details  
					-> test for retrieve wfa description after selecting wfaid from form */
	function searchWFAByWfaID(inputString) {
		//document.getElementById('cboWfaWFAID').value = inputString ;
		if(inputString.length == 0) {
			// Hide the suggestion box.
			$('#suggestions').hide();
		} else {
			$.post("include_php/readWfaDetails.php", {queryString: ""+inputString+""}, function(data){
				if(data.length >0) {
					$('#insertFromDatabase').html(data);
					$('#suggestions').hide();
				}
			});
		}
	} /* END Wfa 01112010: Search WFA description By WFA ID to Read from Search Result into WFAID Details  */

/* Wfa 01112010: Retrieve WFA description By WFA ID table name  */
	function funRetrDescrWFA(strValue, wfaTable) 
	{
		$('#WFA_panel').click();//--id of the tab needed to open
		if (!(strValue == "notSelected")) {
			$.post("include_php/searchWfaDescr_WfaEmailContent.php",{queryString: ""+strValue+"", type: ""+wfaTable+""}, function(data){
				if(data.length >0) 
				//alert(data);			
					$('#insertFromDatabase').html(data);
			});;
		}
	}/* END Wfa 01112010: Retrieve WFA description By WFA ID table name  */

/* Wfa 01112010: Auto Choose for Save or Update the WFA  */
	function funChooseEventWFA(strValue){
		//Validation fields: 
		if (document.getElementById('cboWfaWFAID').value 	== "notSelected")	{alert ("Please Specify WFA id"); 		return false;}
		if (document.getElementById('cboWfaStatus').value 	== "notSelected")	{alert ("Please Fill Status"); 			return false;}
		if (document.getElementById('cboWfaStatus').value 	== "Inactive" && strValue == "Save")
												{alert ("You cannot insert a Work Flow Action with inactive status!"); 	return false;}
		if (document.getElementById('cboAssTemp').value 	== "notSelected")	{alert ("Please Specify WFA Template"); return false;}
		if (document.getElementById('wfaSubject').value 	== "")				{alert ("Please Fill Subject"); 		return false;}
		if (document.getElementById('txaWfaMessage').value 	== "")				{alert ("Please Fill WFA Template"); 	return false;}
		
		var wfaId = document.getElementById('cboWfaWFAID').value;
		var wfaCandId = document.getElementById('txtWfaCanId').value;
		var wfaDescr = document.getElementById('txtWfaDescription').value;	
		var wfaStatus = document.getElementById('cboWfaStatus').value;
		var wfaAssignTemp = document.getElementById('cboAssTemp').value;
		var wfaExpDt = document.getElementById('wfaExpDt').value;
		var wfaNote = document.getElementById('wfaNotes').value;
		var wfaEmSubject = document.getElementById('wfaSubject').value;
		var wfaEmContent = document.getElementById('txaWfaMessage').value;
		
		
		if(strValue == "Save"){;
			funInsertWfa();
		}else{
			if(confirm('Do you sure want to update?')){	
				funUpdateWfa();
			}else{ 
				alert('Update Canceled!');}
		} 
	} /* END Wfa 01112010: Auto Choose for Save or Update the WFA  */
			
/* Wfa 01112010: Insert WFA into DB  */
	function funInsertWfa()
	{
		var ajaxRequest; // The variable that makes Ajax possible!
		try{
			// Opera 8.0+, Firefox, Safari
			ajaxRequest = new XMLHttpRequest();
		} catch (e){
			// Internet Explorer Browsers
			try{
				ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
			} catch (e) {
				try{
					ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
				} catch (e){
					// Something went wrong
					alert("Your browser broke!");
					return false;
				}
			}
		}
		// Create a function that will receive data sent from the server
		ajaxRequest.onreadystatechange = function(){
			if(ajaxRequest.readyState == 4){
				document.myForm.time.value = ajaxRequest.responseText;
			}
		}
		
		var wfaId = document.getElementById('cboWfaWFAID').value;
		var wfaCandId = document.getElementById('txtWfaCanId').value;
		var wfaDescr = document.getElementById('txtWfaDescription').value;
		
		var wfaStatus = document.getElementById('cboWfaStatus').value;
		var wfaAssignTemp = document.getElementById('cboAssTemp').value;
		var wfaExpDt = document.getElementById('wfaExpDt').value;
		
		var wfaNote = document.getElementById('wfaNotes').value;
		var wfaEmSubject = document.getElementById('wfaSubject').value;
		var wfaEmContent = document.getElementById('txaWfaMessage').value;
	
		var queryString = 
		"?wfaId=" + wfaId+
		"&wfaCandId=" + wfaCandId+
		"&wfaDescr=" + wfaDescr+
		"&wfaStatus=" + wfaStatus+
		"&wfaAssignTemp=" + wfaAssignTemp+
		"&wfaExpDt=" + wfaExpDt+
		"&wfaNote=" + wfaNote+
		"&wfaEmSubject=" + wfaEmSubject+
		"&wfaEmContent=" + wfaEmContent;
		//alert (queryString);
		ajaxRequest.open("GET", "include_php/insertWfa.php" + queryString, true);
		ajaxRequest.send(null); 
		
		alert ('Insert WFA Successfully! :-)');
	} /* END Wfa 01112010: Insert WFA into DB  */
			
/* Wfa 01112010: Update WFA into DB  */
	function funUpdateWfa()
	{
		//alert ('Lets start to do the validation Successfully! ;-)');
		var ajaxRequest; // The variable that makes Ajax possible!
		try{
			// Opera 8.0+, Firefox, Safari
			ajaxRequest = new XMLHttpRequest();
		} catch (e){
			// Internet Explorer Browsers
			try{
				ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
			} catch (e) {
				try{
					ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
				} catch (e){
					// Something went wrong
					alert("Your browser broke!");
					return false;
				}
			}
		}
		// Create a function that will receive data sent from the server
		ajaxRequest.onreadystatechange = function(){
			if(ajaxRequest.readyState == 4){
				document.myForm.time.value = ajaxRequest.responseText;
			}
		}

		var wfaId = document.getElementById('cboWfaWFAID').value;
		var wfaCandId = document.getElementById('txtWfaCanId').value;
		var wfaDescr = document.getElementById('txtWfaDescription').value;
		
		var wfaStatus = document.getElementById('cboWfaStatus').value;
		var wfaAssignTemp = document.getElementById('cboAssTemp').value;
		var wfaExpDt = document.getElementById('wfaExpDt').value;
		
		var wfaNote = document.getElementById('wfaNotes').value;
		var wfaEmSubject = document.getElementById('wfaSubject').value;
		var wfaEmContent = document.getElementById('txaWfaMessage').value;
						
		var queryString = 
		"?wfaId=" + wfaId+
		"&wfaCandId=" + wfaCandId+
		"&wfaDescr=" + wfaDescr+
		"&wfaStatus=" + wfaStatus+
		"&wfaAssignTemp=" + wfaAssignTemp+
		"&wfaExpDt=" + wfaExpDt+
		"&wfaNote=" + wfaNote+
		"&wfaEmSubject=" + wfaEmSubject+
		"&wfaEmContent=" + wfaEmContent;
		//alert ("Query: " + queryString);
		
		ajaxRequest.open("GET", "include_php/updateWfa.php" + queryString, true);
		ajaxRequest.send(null); 
	} /* END Wfa 01112010: Update WFA into DB  */



//------------------------------------------Tommy New Function--------------------------------------

//This Function to Set the autoSuggestion div to under the TextBox
function setSuggestionDiv(obj,divID,cWidth){
	var posX = obj.offsetLeft;
	var posY = obj.offsetTop;

	while(obj.offsetParent){
		posX=posX+obj.offsetParent.offsetLeft;
		posY=posY+obj.offsetParent.offsetTop;
			if(obj==document.getElementsByTagName('body')[0]){
				break;
				}else{
					obj=obj.offsetParent;
					}
	}
	document.getElementById(divID).style.left =posX+"px";
	document.getElementById(divID).style.top = posY+22+"px";
	document.getElementById(divID).style.width = cWidth+3+"px";
}
//This Function to Set the Candidate Summary beside the Candidate Result List
function setSummaryDiv(obj,divID,candidateID){
	var posX = obj.offsetLeft;
	var posY = obj.offsetTop;
	while(obj.offsetParent){
		posX=posX+obj.offsetParent.offsetLeft;
		posY=posY+obj.offsetParent.offsetTop;
			if(obj==document.getElementsByTagName('body')[0]){
				break;
				}else{
					obj=obj.offsetParent;
					}
	}
	summaryDivY = posY;
	document.getElementById(divID).style.left =posX-150+"px";
	document.getElementById(divID).style.top = posY+"px";
	getCandidateSummaryByID(candidateID);
	
}

function hideSummaryDiv(){
	$('#candidateSummaryDiv').hide();
}
//Search Candidate By Their ID to Read from Search Result In to Candidate Details
function getCandidateSummaryByID(inputString) {
	if(inputString.length == 0) {
		// Hide the suggestion box.
		$('#candidateSummaryDiv').hide();
	} else {
		$.post("include_php/getCandidateSummary.php", {queryString: ""+inputString+""}, function(data){
			if(data.length >0) {
				$('#candidateSummaryContent').html(data);
				$('#candidateSummaryDiv').show();
			}
		});
	}
} // lookup


//This Function to Set the Help Div and Assign Value Inside beside the Candidate Result List
function setHelpDiv(obj,containText, containHText){
	var posX = obj.offsetLeft;
	var posY = obj.offsetTop;
	while(obj.offsetParent){
		posX=posX+obj.offsetParent.offsetLeft;
		posY=posY+obj.offsetParent.offsetTop;
			if(obj==document.getElementsByTagName('body')[0]){
				break;
				}else{
					obj=obj.offsetParent;
					}
	}
	document.getElementById('helpDivTom').style.left =posX-150+"px";
	document.getElementById('helpDivTom').style.top = posY+"px";
	$('#labelHelpHeaderTom').html(containHText);
	$('#helpDivTomContent').html(containText);
	$('#helpDivTom').show();
	
}

function updateAgentDone(chkValue,inputString,candidateID){
	if(inputString.length == 0) {
	} else {
		if(chkValue == 'on'){
			$.post("include_php/updateAgentToDoListDone.php", {chkValue: ""+chkValue+"",queryString: ""+inputString+"",candidate: ""+candidateID+""}, function(data){
			if(data.length >0) {}});
			reloadTodoList();
		}else{
			$.post("include_php/updateAgentToDoListDone.php", {chkValue: ""+chkValue+"",queryString: ""+inputString+"",candidate: ""+candidateID+""}, function(data){
			if(data.length >0) {
			}});
		}
	}
}


//---------------------------------Minh----------------------
//21-3-2011
function delayLoading()
{	
	setTimeout("loadAll()",1000);	
	
}

function loadAll(){
	document.getElementById('bigTag').style.visibility = 'visible';
	//document.getElementById('progess').style.visibility = 'hidden';
	var agentID=document.getElementById('hiddenAgentID').value;
	addCSS();
	loadTodoList(agentID);
	loadWFAID();
	loadTempleteID();	
	//loadTemplateFollowWFA();
	loadStatus() 
}


function loadTodoList(inputString) {
	if(inputString.length == 0) {
	} else {
		$.post("include_php/getAgentToDoList.php", {queryString: ""+inputString+""}, function(data){
			if(data.length >0) {
				$('#agentTodoListData').html(data);
				
			}
		});
	}
} 

function loadWFAID() {
		$.post("include_php/loadComboBox.php", {queryString: "wfaID"}, function(data){
			if(data.length >0) {
				$('#cboWfaWFAID').html(data);
			}
		});
} 

//---------------------MINH load wfa_template follow by wfa---------------
function loadTemplateFollowWFA(wfa_ID) {
		$.post("include_php/loadComboBox.php?wfa_ID="+wfa_ID, {queryString: "loadTemplateFollowWFA"}, function(data){
			if(data.length >0) {
				$('#cboWfaWFAID').html(data);
			}
		});
} 


function loadTempleteID() {
		$.post("include_php/loadComboBox.php", {queryString: "templete"}, function(data){
			if(data.length >0) {
				$('#cboAssTemp').html(data);
			}
		});
} 

function loadStatus() {
		$.post("include_php/loadComboBox.php", {queryString: "status"}, function(data){
			if(data.length >0) {
				$('#cboInsertStatus').html(data);
				$('#cboAdSearchStatus').html(data);
			}
		});
} 

function extractResumeFromIframe(inputString) {
	if(inputString.length == 0) {
	} else {
	var url = inputString;
	var fileN = url.substring(url.lastIndexOf('/')+1);
	$.get(inputString, function(data) {
	  $('.result').html(data);
		  $.post("include_php/resumeExtractorV2.php", {queryString: ""+data+"",txtfilename: ""+fileN+""}, function(data){
				if(data.length >0) {
					$('#insertBtnReset').click();
					
					if(document.getElementById('openClose').value == "Open CRM"){
						$('#openClose').click();
						$('#insertFromDatabase').html(data);
					}else{
						$('#can').click();
						$('#insertFromDatabase').html(data);
					}
					
					checkCandidateExist();
				}
			});
	});
	}
} 

//------------------------------------------Tommy New Function--------------------------------------------------

//------------------------------------------Tommy New Function  18/11/2010--------------------------------------
//Fix an error in the ShowSummaryDiv that cause by the div is attacted each other
var summaryDivY;
jQuery(document).ready(function(){
   $(document).mousemove(function(e){
	if(e.pageY > (summaryDivY+10) || e.pageY < (summaryDivY-0) ){
		hideSummaryDiv();
	}
   }); 
})

//Add Consultant Name and Date, Time to end of comment.
function addComment(){
	var textAreaValue = document.getElementById('txtInsertNotes').value;
	var currentTime = new Date();
	var month = currentTime.getMonth();
	var day = currentTime.getDate();
	var year = currentTime.getFullYear();
	var minutes = currentTime.getMinutes();
	if (minutes < 10){
		minutes = "0" + minutes;
		}
	document.getElementById('txtInsertNotes').value = " \n(By : "+document.getElementById('lblAgentName').innerHTML+", "+day +"/"+ month +"/"+ year+", "+ currentTime.getHours()+":"+minutes+")" + "\n" + textAreaValue ;
}

function isysButtonSelector(){
	if (document.getElementById("btnExtractResume").value == "Resume Sample"){
		document.getElementById("btnExtractResume").value = "Extract Resume";
		document.getElementById("isys").className="ui-state-focus";
		document.getElementById("isys").src="resumeSample/";	 
	}else if (document.getElementById("isys").value = "Extract Resume") {
		extractResumeFromIframe(document.getElementById("isys").contentWindow.document.body.baseURI);
	}
}

//To Able Reload Agent todo list after click done
function reloadTodoList(){
	var agentID=document.getElementById('hiddenAgentID').value;
	loadTodoList(agentID);
}


//	-----------------------------Minh--13/04/2011------------------------------------
//Send multiple Emails in the Agent To Do List via AJAX through php
function sendAllEmail(){

	var EmailList = "";
	var totalCheckList =  document.getElementById("NoChecked").value;
	document.getElementById("chkAll").checked = false;
	
	for(var i = 1; i <= totalCheckList; i++)
	{		
		
		if(document.getElementById('chkAll'+i).checked == 1)
		{
			if(EmailList == "")
				EmailList = document.getElementById('chkAll'+i).value;
			else
				EmailList = EmailList + "," + document.getElementById('chkAll'+i).value;
			
		}
		
	}	

	$.post("include_php/sendEmail.php", {EmailList: ""+EmailList+""}, function(data){
		if(data.length >0) {
			//alert(data);
			
	//use for removing the previous rows -> use as refresh the page after updating data					
	for(var i = 0; i <document.getElementById("agentTodoListData").rows.length; i++)
	{
		document.getElementById("agentTodoListData").deleteRow(i -1);
	}
			var agentID=document.getElementById('hiddenAgentID').value;
			loadTodoList(agentID);
		}
	});
	
		
}


//Send single Email via AJAX through php
function sendEmail(){
	//Minh modified 11/05/2011
	var agentID=document.getElementById('hiddenAgentID').value;
	$('#AgentToDoList_panel').click();//--id of the tab needed to open
		
	txtNote = document.getElementById('wfaNotes').value
	
	if((txtTemplateID = document.getElementById('cboAssTemp').value)==""){
		alert ("Template Not Found");
		return false;
	}
	
	if((txtWFAID = document.getElementById('cboWfaWFAID').value)==""){
		alert ("WFA Not Found");
		return false;
	}
	
	if((txtCandidateID = document.getElementById('txtCanID').value)==""){
		alert ("Candidate ID Not Found");
		return false;
	}
    //end 
	
	if((txtTo = document.getElementById('txtEmail').value)==""){
		alert ("Candidate Email Not Found");
		return false;
	}
	
	if ((txtSubject = document.getElementById('wfaSubject').value)==""){
		alert ("Please Type The Email Subject");
		return false;
	}
	
	if((txtMessage = tinyMCE.get('txaWfaMessage').getContent())==""){
		alert ("Please Type The Message You Want To Send");
		return false;
	}
	
	var txtHeader = "From : Milestone - "+document.getElementById('lblAgentName').innerHTML;

	//----Minh -------
	$.post("include_php/sendEmail.php", {strTo: ""+txtTo+"",strSubject: ""+txtSubject+"", strMessage: ""+txtMessage+"",strHeader: ""+txtHeader+"", strCandidateID: ""+txtCandidateID+"", strWFAID: ""+txtWFAID+"", strTemplateID: ""+txtTemplateID+"", strNote: ""+txtNote+""}, function(data){
		if(data.length >0) {
			//alert(data);
			loadTodoList(agentID);
		}
	});
	//end
}

function checkCandidateExist(){
	var strFirstname 	= document.getElementById('txtInsertFName').value.trim();
	var strLastname 	= document.getElementById('txtInsertSurname').value.trim();
	var strMobile 		= document.getElementById('txtInsertMobile').value.trim();
	var strEmail 		= document.getElementById('txtInsertEmail').value.trim();
	
	$.post("include_php/getCandidateExist.php", {firstName: ""+strFirstname+"",lastName: ""+strLastname+"",mobile: ""+strMobile+"",email: ""+strEmail+""}, function(data){
		if(data.length >0) {
			confirmed = window.confirm("The Candidate from this resume already exist, Click OK to Update. Click Cancel  to Preview this Data");
			if (confirmed)
			{
				var strData=data.split(",");
				openCandidate(strData[0],strData[1]);
			} 
			else 
			{
			}
		}
	});
}

//http://www.delphifaq.com/faq/f1031.shtml
String.prototype.trim = function () {
    return this.replace(/^\s*/, "").replace(/\s*$/, "");
}


//-----Minh----------30 May 2011-----------------
//Inactive candidate email
function InactiveCandidate()
{
	$('#AgentToDoList_panel').click();//--id of the tab needed to open
	var agentID=document.getElementById('hiddenAgentID').value;
	
	if((txtCandidateID = document.getElementById('txtCanID').value)==""){
		alert ("Candidate ID Not Found");
		return false;
	}
	//alert(txtCandidateID);
	
   
   if(document.getElementById('cboWfaStatus').value!="Inactive"){
		alert ("Inactive contact status must be chosen to update");
		return false;
	}
	
	//----Minh -------
	$.post("include_php/inactiveCandidate.php", {CandidateID: ""+txtCandidateID+""}, function(data){
		if(data.length >0) {
			//alert(data);
			loadTodoList(agentID);
		}
	});
	//end
}
