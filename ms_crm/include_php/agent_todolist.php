<!--
    Team:			ISYNC
    Programmer:		Minh Duc Nguyen
    Purpose:		CRM to manage mileston Search Candidates
    Client:			Milestone Search
    Version:		3.3.2 13/04/2011
    File:			agent_todolist.php
-->

<!--needs to be "include into updatecandidate"-->

<style type="text/css">
<!--
.scrollTable{
	overflow: auto; 
	width: 100%; 
	border-left: 1px gray solid; 
	border-bottom: 1px gray solid; 
	padding:0px; 
	argin: 0px; 
	font-size: 12px; 
	font-weight: bold;
}
-->
</style>



<table width="501" cellpadding="0" cellspacing="0">
    <tr style="color:#FFF">
    <!-- this button will use AJAX to collect all the candidate ids need to be emailed and submit to sendEmail.php page for precocessing-->
          <td colspan="5" align="right"><input id="btnSendAll" name="btnSendAll" type="button" value="Send" disabled onclick="sendAllEmail();"/></th>
          </td>
    </tr>
    <tr bgcolor="#FF9900" style="color:#FFF" valign="top">
   	  <th width=70 height="15" align="left">Due Date</th>
      <th width=110 height="15" align="left">Name</th>
      <th width=150 height="15" align="left">Template</th>
      <th width=110 align="left">Notes</th>      
	  <th width=60 align="center">
      	<table width="100%" cellpadding="0" cellspacing="0">
        	<tr valign="top">
            	<td>Select All</td>
            </tr>
            <tr>
            	<td align="center"><input id="chkAll" name="chkAll" type="checkbox" value="" onclick="check_all();"/><input id="NoChecked" name="NoChecked" type="hidden" value=""/></td>
            </tr>
        </table>
        </th>
    </tr>
</table>  

<div style="overflow: auto; width: 500px; height: 450px; border-left: 1px gray solid; border-bottom: 1px gray solid; padding:0px; margin: 0px; font-size: 12px; color:#000;">
<table id="agentTodoListData" width="501" cellpadding=0 cellspacing=0>
</table>
</div>
<span onClick="openHelp_AgentToDoList();"><img src="image/help_icon.jpg" width="20" alt="Help" title="Help"/></span>
