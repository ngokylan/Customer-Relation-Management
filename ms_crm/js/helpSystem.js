/*
    Team:			blueSky
    Programmer:		Sonia Schiavon
    Purpose:		CRM to manage mileston Search help system
    Client:			Milestone Search
    Version:		10.0 03.10.2010
    File:			helpSystem.js


<div class="suggestionsBox" id="helpSummaryDiv">
        <div class="helpHeadingBar" id="helpHeadingSummaryDiv"> 							
            <label for="searchDefinition" class="helpHeadingText" id="helpHTextDiv"></label>
            <strong class="xRightPos" onClick="closeHelpSummary()">X</strong>
        </div>
        <div class="helptext" id="helpTextDiv" style="background-color:#FFC"></div>
 </div>
 */
 
function helpSummary(obj, containText, containHText) 
{
	/*$('#helpSummary').show();
	$('#helpHText').html(containHText);
	$('#helpText').html(containText);*/
	setHelpDiv(obj,containText, containHText);
} // helpSummary
	
function closeHelpSummary() 
{	
//	$('#helpSummary').hide();
	$('#helpDivTom').hide();
} // closeHelpSummary

function openHelp_AdvSearch()
{
	newWin=window.open("HelpSystem/Help_AdvSearch.htm","SummaryWindow","status=yes,toolbar=no,scrollbars=yes,width=900,height=650")
	// LATER change with true
	return false;
} //Lanch Help_AdvSearch.htm

function openHelp_InsUpdCand()
{
	newWin=window.open("HelpSystem/Help_InsUpdCand.htm","SummaryWindow","status=yes,toolbar=no,scrollbars=yes,width=900,height=650")
	// LATER change with true
	return false;
} //Lanch Help_InsUpdCand.htm

function openHelp_InsUpdWFA()
{
	newWin=window.open("HelpSystem/Help_InsUpdWFA.htm","SummaryWindow","status=yes,toolbar=no,scrollbars=yes,width=900,height=650")
	// LATER change with true
	return false;
} //Lanch Help_Help_InsUpdWFA.htm

function openHelp_AgentToDoList()
{
	newWin=window.open("HelpSystem/Help_Agent_To-do_list.htm","SummaryWindow","status=yes,toolbar=no,scrollbars=yes,width=900,height=650")
	// LATER change with true
	return false;
} //Lanch Help_Agent_To-do_list.htm

function openHelp_help_crm_index()
{
	newWin=window.open("HelpSystem/help_crm_index.html","SummaryWindow","status=yes,toolbar=no,scrollbars=yes,width=900,height=650")
	// LATER change with true
	return false;
} //Lanch help_crm_index.html