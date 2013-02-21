// JavaScript Document
function init(){
	var stretchers = document.getElementsByClassName('box');
	var toggles = document.getElementsByClassName('tab');
	var myAccordion = new fx.Accordion(
		toggles, stretchers, {opacity: false, height: true, duration: 600}
	);
	//hash functions
	var found = false;
	toggles.each(function(h3, i){
		var div = Element.find(h3, 'nextSibling');
			if (window.location.href.indexOf(h3.title) > 0) {
				myAccordion.showThisHideOpen(div);
				found = true;
			}
		});
		if (!found) myAccordion.showThisHideOpen(stretchers[0]);
}

function loadAll(){
	loadAgentTable();
	loadClientTable();
	//loadTemplateSubject();
}
//-------------------------------------------------------------------------AGENT---------------------------------------------------------
//Tommy - 19 November 2010
/*function checkBtnSaveFunction(){
		if(	document.getElementById('btnSave').value == "Save"){
			insertAgent();
		}else{
			updateAgent();
		}
	}
	
//Insert Agent
function insertAgent(){
	var pAccessLevel = document.getElementById('cboAgentAccessLevel').value;
	var pAccessStatus = document.getElementById('cboAgentAccessStatus').value;
	
	if((pFirstName = document.getElementById('txtAgentFirstName').value)=="")		{alert("Please Fill First Name"); return false;} ;
	if((pSurname = document.getElementById('txtAgentSurname').value)=="")			{alert("Please Fill Surname"); return false;} ;
	if((pPassword = document.getElementById('txtAgentPassword').value)=="")			{alert("Please Fill Password"); return false;} ;
	
	if((pStreetNumber = document.getElementById('txtAgentStreetNumber').value)=="")	{alert("Please Fill Street Number"); return false;} ;
	if((pStreetName = document.getElementById('txtAgentStreetName').value)=="")		{alert("Please Fill Street Name"); return false;} ;
	if((pCity = document.getElementById('txtAgentCity').value)=="")					{alert("Please Fill City"); return false;} ;
	if((pState = document.getElementById('cboAgentState').value)=="")				{alert("Please Fill State"); return false;} ;
	if((pPostCode = document.getElementById('txtAgentPostCode').value)=="")			{alert("Please Fill Post Code"); return false;} ;
	if((pCountry = document.getElementById('txtAgentCountry').value)=="")			{alert("Please Fill Agent Country"); return false;} ;
	if((pMobile = document.getElementById('txtAgentMobile').value)=="")				{alert("Please Fill Mobile Number"); return false;} ;
	if((pPhone  = document.getElementById('txtAgentPhone').value)=="")				{alert("Please Fill Phone Number"); return false;} ;
	
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
				alert(ajaxRequest.responseText);
			}
		}
	
		var queryString = "?"+
			"firstName="+pFirstName+ 
			"&surname="+pSurname+ 
		  	"&password="+pPassword+
		  	"&accessLevel="+pAccessLevel+ 
		  	"&accessStatus="+pAccessStatus+ 
		  	"&streetNumber="+pStreetNumber+  
		  	"&streetName="+pStreetName+  
		  	"&city="+pCity+  
		  	"&state="+pState+  
		  	"&postCode="+pPostCode+
		  	"&country="+pCountry+
		  	"&mobile="+pMobile+
		  	"&phone="+pPhone;
		ajaxRequest.open("GET", "include_php/agent/insertAgent.php" + queryString, true);
		ajaxRequest.send(null); 
}
*/
//Update Agent
function updateAgent(){
	var pAccessLevel = document.getElementById('cboAgentAccessLevel').value;
	var pAccessStatus = document.getElementById('cboAgentAccessStatus').value;
	
	if((pFirstName = document.getElementById('txtAgentFirstName').value)=="")		{alert("Please Fill First Name"); return false;} ;
	if((pSurname = document.getElementById('txtAgentSurname').value)=="")			{alert("Please Fill Surname"); return false;} ;
	if((pPassword = document.getElementById('txtAgentPassword').value)=="")			{alert("Please Fill Password"); return false;} ;
	
	if((pStreetNumber = document.getElementById('txtAgentStreetNumber').value)=="")	{alert("Please Fill Street Number"); return false;} ;
	if((pStreetName = document.getElementById('txtAgentStreetName').value)=="")		{alert("Please Fill Street Name"); return false;} ;
	if((pCity = document.getElementById('txtAgentCity').value)=="")					{alert("Please Fill City"); return false;} ;
	if((pState = document.getElementById('cboAgentState').value)=="")				{alert("Please Fill State"); return false;} ;
	if((pPostCode = document.getElementById('txtAgentPostCode').value)=="")			{alert("Please Fill Post Code"); return false;} ;
	if((pCountry = document.getElementById('txtAgentCountry').value)=="")			{alert("Please Fill Agent Country"); return false;} ;
	if((pMobile = document.getElementById('txtAgentMobile').value)=="")				{alert("Please Fill Mobile Number"); return false;} ;
	if((pPhone  = document.getElementById('txtAgentPhone').value)=="")				{alert("Please Fill Phone Number"); return false;} ;
	
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
				alert(ajaxRequest.responseText);
			}
		}
		var queryString = "?"+
			"firstName="+pFirstName+ 
			"&surname="+pSurname+ 
		  	"&password="+pPassword+
		  	"&accessLevel="+pAccessLevel+ 
		  	"&accessStatus="+pAccessStatus+ 
		  	"&streetNumber="+pStreetNumber+  
		  	"&streetName="+pStreetName+  
		  	"&city="+pCity+  
		  	"&state="+pState+  
		  	"&postCode="+pPostCode+
		  	"&country="+pCountry+
		  	"&mobile="+pMobile+
		  	"&phone="+pPhone;
			
		ajaxRequest.open("GET", "include_php/agent/insertAgent.php" + queryString, true);
		ajaxRequest.send(null); 
}

//Load Agent
function loadAgentTable(){
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
				document.getElementById('divAgentTableList').innerHTML = ajaxRequest.responseText;
				//alert(ajaxRequest.responseText);
			}
		}
			
		ajaxRequest.open("GET", "include_php/agent/loadAgent.php", true);
		ajaxRequest.send(null); 
}
var globalAgentID;
//Read Agent
function loadAgentInformation(agentID){
	globalAgentID = agentID;
	alert(agentID);
	
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
				alert(ajaxRequest.responseText);
				document.getElementById('divJavaScriptExe').innerHTML = ajaxRequest.responseText;
				fill();
			}
		}
			
		ajaxRequest.open("GET", "include_php/agent/readAgent.php?pAgentID="+agentID, true);
		ajaxRequest.send(null); 
}

//Delete Agent
function deleteAgent(agentID){
}

//----------------------------------------------------------------------------------------------------------------Client
//Tommy - 19 November 2010
function checkClientBtnSaveFunction(){
		if(	document.getElementById('btnClientSave').value == "Save"){
			insertClient();
		}else{
			updateClient();
		}
	}
	
//Insert Client
function insertClient(){
	if((pFirstName = document.getElementById('txtClientFirstName').value)=="")		{alert("Please Fill First Name"); return false;} ;
	if((pSurname = document.getElementById('txtClientSurname').value)=="")			{alert("Please Fill Surname"); return false;} ;
	if((pCompany = document.getElementById('txtClientCompany').value)=="")			{alert("Please Fill Company"); return false;} ;
	
	if((pStreetNumber = document.getElementById('txtClientStreetNumber').value)=="")	{alert("Please Fill Street Number"); return false;} ;
	if((pStreetName = document.getElementById('txtClientStreetName').value)=="")		{alert("Please Fill Street Name"); return false;} ;
	if((pCity = document.getElementById('txtClientCity').value)=="")					{alert("Please Fill City"); return false;} ;
	if((pState = document.getElementById('cboClientState').value)=="")				{alert("Please Fill State"); return false;} ;
	if((pPostCode = document.getElementById('txtClientPostCode').value)=="")			{alert("Please Fill Post Code"); return false;} ;
	if((pCountry = document.getElementById('txtClientCountry').value)=="")			{alert("Please Fill Client Country"); return false;} ;
	if((pMobile = document.getElementById('txtClientMobile').value)=="")				{alert("Please Fill Mobile Number"); return false;} ;
	if((pPhone  = document.getElementById('txtClientPhone').value)=="")				{alert("Please Fill Phone Number"); return false;} ;
	
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
				alert(ajaxRequest.responseText);
			}
		}
	
		var queryString = "?"+
			"firstName="+pFirstName+ 
			"&surname="+pSurname+
			"&company="+pCompany+
		  	"&streetNumber="+pStreetNumber+  
		  	"&streetName="+pStreetName+  
		  	"&city="+pCity+  
		  	"&state="+pState+  
		  	"&postCode="+pPostCode+
		  	"&country="+pCountry+
		  	"&mobile="+pMobile+
		  	"&phone="+pPhone;
		ajaxRequest.open("GET", "include_php/client/insertClient.php" + queryString, true);
		ajaxRequest.send(null); 
}

//Update Client
function updateClient(){
	if((pFirstName = document.getElementById('txtClientFirstName').value)=="")		{alert("Please Fill First Name"); return false;} ;
	if((pSurname = document.getElementById('txtClientSurname').value)=="")			{alert("Please Fill Surname"); return false;} ;
	
	if((pStreetNumber = document.getElementById('txtClientStreetNumber').value)=="")	{alert("Please Fill Street Number"); return false;} ;
	if((pStreetName = document.getElementById('txtClientStreetName').value)=="")		{alert("Please Fill Street Name"); return false;} ;
	if((pCity = document.getElementById('txtClientCity').value)=="")					{alert("Please Fill City"); return false;} ;
	if((pState = document.getElementById('cboClientState').value)=="")				{alert("Please Fill State"); return false;} ;
	if((pPostCode = document.getElementById('txtClientPostCode').value)=="")			{alert("Please Fill Post Code"); return false;} ;
	if((pCountry = document.getElementById('txtClientCountry').value)=="")			{alert("Please Fill Client Country"); return false;} ;
	if((pMobile = document.getElementById('txtClientMobile').value)=="")				{alert("Please Fill Mobile Number"); return false;} ;
	if((pPhone  = document.getElementById('txtClientPhone').value)=="")				{alert("Please Fill Phone Number"); return false;} ;
	
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
				alert(ajaxRequest.responseText);
			}
		}
		var queryString = "?"+
			"firstName="+pFirstName+ 
			"&surname="+pSurname+ 
		  	"&password="+pPassword+
		  	"&accessLevel="+pAccessLevel+ 
		  	"&accessStatus="+pAccessStatus+ 
		  	"&streetNumber="+pStreetNumber+  
		  	"&streetName="+pStreetName+  
		  	"&city="+pCity+  
		  	"&state="+pState+  
		  	"&postCode="+pPostCode+
		  	"&country="+pCountry+
		  	"&mobile="+pMobile+
		  	"&phone="+pPhone;
			
		ajaxRequest.open("GET", "include_php/Client/insertClient.php" + queryString, true);
		ajaxRequest.send(null); 
}

//Load Client
function loadClientTable(){
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
				document.getElementById('divClientTableList').innerHTML = ajaxRequest.responseText;
				//alert(ajaxRequest.responseText);
			}
		}
			
		ajaxRequest.open("GET", "include_php/client/loadClient.php", true);
		ajaxRequest.send(null); 
}
var globalClientID;
//Read Client
function loadClientInformation(ClientID){
	globalClientID = ClientID;
	alert(ClientID);
	
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
				alert(ajaxRequest.responseText);
				document.getElementById('divJavaScriptExe').innerHTML = ajaxRequest.responseText;
				fill();
			}
		}
			
		ajaxRequest.open("GET", "include_php/Client/readClient.php?pClientID="+ClientID, true);
		ajaxRequest.send(null); 
}

//Delete Client
function deleteClient(clientID){
}


//------------------------- 21 November 2010 -------------------------------------------------------
//June modified 1/05/2011(function addAgent(), function addClient())
//function addAgent(){
//	document.getElementById('formAccount').style.display="compact";
//	document.getElementById('iframeAdmin').style.display="none";
//}
function addAgent(){
	document.getElementById('iframeAdmin').src="AgentAdmin_management/AddAgent.php";
}
//
function viewAgent(){
	document.getElementById('formAccount').style.display="none";
	document.getElementById('iframeAdmin').style.display="compact";
	document.getElementById('iframeAdmin').src="AgentAdmin_management/ViewAgent.php";
}

//function addClient(){
//	document.getElementById('formClient').style.display="compact";
//	document.getElementById('iframeClient').style.display="none";
//}
////---------minh-------------
function listTemplate(){
	document.getElementById('iframeContainerTemplete').src="AgentAdmin_management/ViewWFATemplate.php";
}
function addTemplate(){
	document.getElementById('iframeContainerTemplete').src="AgentAdmin_management/AddWFATemplate.php";
}

function listStatus(){
	document.getElementById('iframeContainerStatusList').src="AgentAdmin_management/ViewStatus.php";
}
function addStatus(){
	document.getElementById('iframeContainerStatusList').src="AgentAdmin_management/AddStatus.php";
}

function listWFAcode(){
	document.getElementById('iframeContainerWFACode').src="AgentAdmin_management/ViewWFACode.php";
}
function addWFAAssignment(){
	document.getElementById('iframeContainerWFACode').src="AgentAdmin_management/ViewWFACode.php?assignTemplate=y";
}


function listHelpSystem(){
	document.getElementById('iframeContainerHelp').src="AgentAdmin_management/ViewHelpSystemDescr.php";
}
function addHelpSystem(){
	document.getElementById('iframeContainerHelp').src="AgentAdmin_management/AddHelpSystemDescr.php";
}


function addClient(){
	document.getElementById('iframeClient').src="AgentAdmin_management/AddClient.php";
}

function viewClient(){
	document.getElementById('formClient').style.display="none";
	document.getElementById('iframeClient').style.display="compact";
	document.getElementById('iframeClient').src="AgentAdmin_management/ViewClient.php";
}



//-----------------------------------MINH 16-3-2011----------------------------------
//	load template to assign to the wfa

//load template's title into combobox
function loadTemplateSubject(){
	
	
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
				alert(ajaxRequest.responseText);
				document.getElementById('divJavaScriptExe').innerHTML = ajaxRequest.responseText;
				fill();
			}
		}
			
		ajaxRequest.open("GET", "include_php/wfa/loadTemplate.php", true);
		ajaxRequest.send(null); 
}

//load the template's content follow by the combobox
function loadTemplateContent(agentID){
	globalAgentID = agentID;
	alert(agentID);
	
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
				alert(ajaxRequest.responseText);
				document.getElementById('divJavaScriptExe').innerHTML = ajaxRequest.responseText;
				fill();
			}
		}
			
		ajaxRequest.open("GET", "include_php/agent/readAgent.php?pAgentID="+agentID, true);
		ajaxRequest.send(null); 
}



//This JQuery Date Function for Date Text Box
				//----------------------Minh-----10/5/201-------------
				$(document).ready(function() {		
						   $( "#txtEmailDate" ).datepicker();		
						   $( "#txtEmailDate" ).change(function() {			
						   $( "#txtEmailDate" ).datepicker( "option", "dateFormat", "yy-mm-dd" );		});	
						   });
				//----------------------end------------------