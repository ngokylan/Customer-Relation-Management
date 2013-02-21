// JavaScript Document

//search_header.php
function candidateNameSearchFunction()
{
	var ajaxRequest;  // The variable that makes Ajax possible!
	
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
	//capture asset values and assign to a variable
	//
	var search_header_fName = document.getElementById('searchHeaderTxtBox').value;
	
	//create string
	var queryString = "?search_header_fName"+search_header_fName;
	
	ajaxRequest.open("GET", "insertCandidate.php" + queryString, true);
	ajaxRequest.send(null); 
}
//=====================================================================

//advancedsearch.php
function advancedSearchFunction()
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
	//capture asset values and assign to a variable
	//
	var adSearch_fName = document.getElementById('txtAdSearchFName').value;
	var adSearch_status = document.getElementById('cboAdSearchStatus').value;
	var adSearch_skillSet = document.getElementById('txtAdSearchSkillSet').value;
	//var adSearch_date = document.getElementById('addSerch_date').value;
	
	//create string
	var queryString = "?adSearch_fName"+adSearch_fName+"&adSearch_status"+adSearch_status+"&adSearch_skillSet"+adSearch_skillSet;
	
	ajaxRequest.open("GET", "insertCandidate.php" + queryString, true);
	ajaxRequest.send(null); 
}
//=====================================================================

//insert.php

function insertCandidateFunction()
{
	
	alert ('pass ajax');
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
	var prevCompany = document.getElementById('txtInsertPreComp').value;
	var workPhone = document.getElementById('txtInsertWorkPhone').value;
	var workFax = document.getElementById('txtInsertWorkFax').value;
	var nextAvailable = "2010-10-10";// Until work out date function
	var initialContact = "2010";// Until work out date function
	var scoring = document.getElementById('cboInsertScoring').value;
		
	var relationshipStatus = document.getElementById('cboInsertRelatStatus').value;
	var sellRate = document.getElementById('txtInsertSellRate').value;
	var buyRate = document.getElementById('txtInsertBuyRate').value;
	var rate = document.getElementById('txtInsertRate').value;

	var currentEngageType = document.getElementById('cboInsertCurrEngageType').value;
	var notes = document.getElementById('cboInsertCurrEngageType').value;	
	
	var engagementType = document.getElementById('cboInsertEngageType').value;
	var email = document.getElementById('txtInsertEmail').value;
		
	var typeRate ="per Hour";
	var typeSellRate="per DAY";
	var typeBuyRate="per ANUMM";
	
	var statusID="2a";
	
	var jobTitle ="Developer";
	var jobDescription ="Java and php developer";
	
	var skillShortDesc="Office Excel";
	var skillLongDesc="Microsoft Office Excel 2007";
	
	var agentID="2";
	
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
	"&prevCompany=" + prevCompany+
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
	"&engagementType=" + engagementType+
	"&email=" + email+
	"&typeRate=" + typeRate+
	"&typeSellRate=" + typeSellRate+
	"&typeBuyRate=" + typeBuyRate+
	"&statusID=" + statusID+
	"&jobTitle=" + jobTitle+
	"&jobDescription=" + jobDescription+
	"&skillShortDesc=" + skillShortDesc+
	"&skillLongDesc=" + skillLongDesc+
	"&agentID=" + agentID;
	
	alert (queryString);
	document.write(queryString);
	ajaxRequest.open("GET", "insertCandidate.php" + queryString, true);
	ajaxRequest.send(null); 
	
	
}
//=====================================================================
