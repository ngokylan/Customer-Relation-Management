<?php
	session_cache_limiter("nocache");
	session_start();
		if(isset($_POST['submit'])){
			echo '<script language="javascript">window.location = "../index.php?info=out";</script>';
			exit;
		}

			if(isset($_SESSION['userName'])&&isset($_SESSION['userID'])){
				$agentID = $_SESSION['userID'];
				$consultant = $_SESSION['userName'];
			}else{
				echo "Return to Index Page";
				echo '<script language="javascript">window.location = "../index.php?info=Please Login";</script>';
				exit;
			}
		//session_destroy();
		
		$day = date("d");
		$month = date("m");
		$year = date("Y");
    ?>
<!--
    Team:			blueSky
    Programmer:		Liam Handasyde | Tommy Wijaya | Sonia Schiavon
    Purpose:		CRM to manage mileston Search Candidates
    Client:			Milestone Search
    Version:		16.0 22.10.2010
    File:			index1.php
-->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>Milestone Search Version 13</title>
   
	  	<script type="text/javascript" src="js/crm_browserDetector.js"></script>
    
    
	<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
	<script type="text/javascript" src="js/jquery-ui-1.8.5.custom.min.js"></script>
    <script type="text/javascript" src="js/jquery.ui.datepicker.js"></script>
    <script type="text/javascript" src="js/helpSystem.js"></script>
    <script type="text/javascript" src="js/SupportFunction.js"></script>
 	
    <script type="text/javascript" src="admin/tinymce/tiny_mce/tiny_mce.js"></script>

<script type="text/javascript">
tinyMCE.init({
        // General options
        mode : "exact",
		elements : "txaWfaMessage", 
		// just pass the ID's of your textarea for which you want to add the editor
        theme : "advanced",  
		// Theme options
       
		
        theme_advanced_buttons3 : "", 
		theme_advanced_buttons6 : "insertimage,font", 
		
		theme_advanced_toolbar_location : "top",
        theme_advanced_toolbar_align : "center",
       
});
</script>


     <link href="css/ui-lightness/others.css" rel="stylesheet" type="text/css">	
     <link href="css/progress_css/stylesheet.css" rel="stylesheet" type="text/css">	 <!-- wfa progress bar css-->
     <link href="css/progress_css/jquery-ui-1.8.6.css" rel="stylesheet" type="text/css">	
  
    <style type="text/css">
<!--
body {
	background-image: url(assets/graphics/backgroundBar.png);
	background-repeat: repeat-x;
}
-->
</style>

	</head>
    
<!--This Div Used for waiting the css until it loaded-->
<body onLoad="delayLoading();">
	
    <div id="bigTag" style="visibility:hidden">
   
    
    
    <div id="suggestionDivTom" class="suggestionsBoxTom">
        <div class="suggestionList" id="autoSuggestionsListTom" style="list-style-type:none"></div>
    </div>

	<!--This Div Used for Candidate Summary by TomTom-->
    <div id="candidateSummaryDiv" onClick="hideSummaryDiv()" >
        <div id="candidateSummaryContent">
        </div>
        <div style="width:10px; float:right">
            <span style="color:#FC0">&#9658;</span>
        </div>
    </div>

	<!--This Div Ued for Help System-->
    <div id="helpDivTom" onClick="closeHelpSummary()">
        <div style="width:140px; float:left;">
            <div id="helpDivTomHeader">
                <label id="labelHelpHeaderTom"></label>
                <strong class="xRightPos" onClick="closeHelpSummary()">X</strong>
            </div>
            <div id="helpDivTomContent">
            </div>
        </div>
        <div style="width:10px; float:right">
            <span style="color:#FC0">&#9658;</span>
        </div>
    </div>

    <div id="insertFromDatabase"></div><!--To call javascript for ajax functionality DON'T DELETE-->
        <div id="crmPanel" >
            <div class="crmContent" >
                <input type="hidden" id="crmWindowStatus" value="Close" />
                <div id="rightContent" ><!--RIGHT CONTENT -->
                <!-- ACCORDION -->
                <div id="accordion" style="background-color:#FFF">
                    <!--
                    Advanced Search
                    -->
                    <div>
                        <h3 id="advanSearch"><a href="#0">Advanced Search</a></h3>
                        <div id="zeroContent">
                            <?php include('include_php/advancedsearch.php'); ?>
                        </div>
                    </div>
                    <!--
                    Insert New Candidate
                    -->
                    <div>
                        <h3 id="can"><a href="#1"><label id="candidateLabel">Insert New Candidate</label></a></h3>
                        <div id="firstContent">
                            <?php include("include_php/insert.php"); ?>
                        </div>
                    </div>
                    <!--
                    Work Flow Action
                    -->
                    <div>
                        <h3 id="WFA_panel"><a href="#3"><label id="WFALabel">Customise Email</label></a></h3>
                        <div id="thirdContent">
                            <?php include "include_php/wfa.php"; ?>
                        </div>
                    </div>
                    <!--
                    Update Candidate
                    -->
                    <div>
                        <h3 id="AgentToDoList_panel"><a href="#2">Agent To Do List</a></h3>
                        <div id="secondContent">
                            <?php //include("include_php/update.php"); ?>
                            <?php include("include_php/agent_todolist.php"); ?>
                        </div>
                    </div>
                </div><!-- ACCORDION END -->
			</div><!--RIGHT CONTENT END -->
        </div>
    </div>

	<div id="outerContainer"><!-- OUTER -->
        <div id="innerContent"><!-- INNER -->
        	<!-- HEADER -->
            <div id="header">
                <?php include('include_php/search_header.php'); ?>
            </div>
			<!-- HEADER END -->	
            <div id="leftContent"><!-- LEFT CONTENT -->
				<div id="extractHelpContainer">
                	<div id="extractBtnContainer">
                        <input name="btnExractResume" id="btnExtractResume" type="button" value="Resume Sample" class="searchbutton2" onClick='isysButtonSelector()'>
                    </div>
                    <div id="helpContainer" >
                    	<div id="helpPos">
                           <span onClick="openHelp_help_crm_index();"> <a class="mainHelp" href="#">CRM-Help Online</a> </span>
                        </div>
                    </div>
            	</div>
				<iframe id="isys" src="http://version9.isysdemo.com/resumes/"></iframe>
            </div><!-- ISYS END --><!-- LEFT CONTENT END-->           
            <!-- 
            Help System: sch09297795 - 05/10/10 
            -->
            <div>
                 <?php include "include_php/helpSystem.php"; ?> 
            </div>
    	</div><!-- INNER END-->
	</div><!-- OUTER END -->
    
    
    
    
    
    </div>
    
</body>
</html>