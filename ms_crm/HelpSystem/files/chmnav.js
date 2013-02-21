/*************************************************************************
 chm2web Navigation Script 1.0 
 Copyright (c) 2002-2007 A!K Research Labs (http://www.aklabs.com)
 http://chm2web.aklabs.com - HTML Help Conversion Utility
**************************************************************************/

var NV = ["Help_AboutMilestoneSearch.htm","Help_CRMS_Overview.htm","Help_Login.htm","Help_AdvSearch.htm","Help_InsUpdCand.htm","Help_InsUpdWFA.htm","Help_Agent_To-do_list.htm","Help_PerSimilarities.htm","Help_AdminAccount.htm","Help_Reports.htm","Help_Glossary.htm"];
var s = "";
function getNav(op) { var p=chmtop.c2wtopf.pageid;var n=s+p; var m=NV.length-1;for(i=0;i<=m;i++){if(NV[i]==p){if(op=="next"){if (i<m) {curpage=i+1;return s+NV[i+1];} else return n;}else{if(i>0) {curpage=i-1;return s+NV[i-1];} else return n;}}} return n;}
function syncTopic(){open('helpheaderc.html', 'header');open('helpcontents.html','toc');}
