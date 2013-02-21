<!--
    Team:			isync
    Programmer:		Minh 
    Purpose:		Manages the Work Flow Action functionality
    Client:			Milestone Search
    Version:		3.4.3 11/05/2011
    File:			wfa.php
    
-->
<?php

	function strToEnter($strText)
	{
		$strProcessText="";
		$i=0;
		while($i<strlen($strText))
		{
			if(ord(substr($strText,$i,1))==10 )
			{
				
			}
			elseif(ord(substr($strText,$i,1))==13 )
			{
				$strProcessText .="\\n";							  
			}else
			{
				$strProcessText .= substr($strText,$i,1); 
			}
			$i++;
		}
		return $strProcessText;
	}
	
	

	require("../db_conection/AjaxConnection.php");
	if(!$db) {
		echo 'ERROR: Could not connect to the database.';
	} else {
		if(isset($_POST['queryString'])) {
			$canID = $db->real_escape_string($_POST['queryString']);	
			if(strlen($canID) >0) {				
				$query = $db->query("
			
					
					SELECT wa.wfa_ID, c.can_fName, c.can_lName, wa.status_complete, wc.wfa_template_ID, wc.enduration, wc.comment, wt.content, c.candidate_ID, e.email_ID, wt.subject, MIN( wc.date_sent ) AS minday
					
					FROM wfa_template_for_candidate wc, candidate c, wfa_assignment wa, wfa_template wt, multi_email e
					
					WHERE wc.wfa_template_ID = wt.wfa_template_ID
					AND wc.candidate_ID = c.candidate_ID
					AND wa.candidate_ID = c.candidate_ID
					AND wa.wfa_ID = wc.wfa_id
					AND wc.sent_status =  '0'
					AND c.candidate_ID =  '$canID'
					AND c.candidate_ID = e.candidate_id
					AND c.candidate_ID = wa.candidate_ID
					AND wa.status_complete =  'Active';");
			
				if($query)
				{
					while ($result = $query ->fetch_object()) 
					{
						$canName = $result->can_fName . " " . $result->can_lName;
						echo "<SCRIPT LANGUAGE=\"javascript\">";
						echo 'function fill(){';
					
						echo 'document.getElementById(\'cboWfaWFAID\').value=\''.$result->wfa_ID.'\';';
						// candidate id implemente by the function searchWFAByID( of supportFunction.js
						
						echo 'document.getElementById(\'txtWfaCanId\').value =\''.$canName.'\';';				
						echo 'document.getElementById(\'cboWfaStatus\').value=\''.$result->status_complete.'\';';
						echo 'document.getElementById(\'cboAssTemp\').value=\''.$result->wfa_template_ID.'\';';
						echo 'document.getElementById(\'wfaExpDt\').value=\''.$result->enduration.'\';';
						echo 'document.getElementById(\'wfaNotes\').value=\''.$result->comment.'\';';
						//replace the string "(FirstName)" into the real candidate name
						$replaced_name = str_replace("(FirstName)",$canName,strToEnter(addslashes($result->content)));
						echo 'tinyMCE.get("txaWfaMessage").setContent(\''.str_replace("../images/milestone_logo.jpg", "admin/images/milestone_logo.jpg",  $replaced_name).'\');';	
						echo 'document.getElementById(\'txtCanID\').value=\''.strToEnter(addslashes($result->candidate_ID)).'\';';	
						echo 'document.getElementById(\'txtEmail\').value=\''.strToEnter(addslashes($result->email_ID)).'\';';	
						echo 'document.getElementById(\'wfaSubject\').value=\''.strToEnter(addslashes($result->subject)).'\';';
						
						// need to see what we should display into subject email template??
						// echo 'document.getElementById(\'wfaSubject\').value=\''.$resultWfaCode->wfa_Descr.'\';'; // Commented Out By Tommy
						
							
						
						echo '}';
						echo "fill();";
						echo "</SCRIPT>";	
						break;
					}
					
					//use for making email progression
					$newQuery = $db->query("SELECT * 
					FROM wfa_template_for_candidate wc, candidate c, wfa_assignment wa, wfa_template wt, wfa_has_template wht
					WHERE wht.wfa_ID = wc.wfa_ID
					AND wht.wfa_template_ID = wt.wfa_template_ID
					AND wc.wfa_template_ID = wt.wfa_template_ID
					AND wc.candidate_ID = c.candidate_ID
					AND wa.candidate_ID = c.candidate_ID
					AND wa.wfa_ID = wc.wfa_id
					AND c.candidate_ID =  '$canID'
					AND wa.status_complete =  'Active'
					Order by wht.email_day ASC
									 ");
					
					if($newQuery)
					{
						
						
						echo "<SCRIPT LANGUAGE=\"javascript\">";
							//<!-- Minh 28/04/2011 --- WFA Email Progress-->
							//Making table javascript function 
							
							echo '
							function makeTable() 
							{
								divContainer = document.getElementById("tableProgress");
								deltable = "";
								if(document.getElementById("newtable") != null)
								{
									deltable = document.getElementById("newtable");
									while(divContainer.hasChildNodes())
										divContainer.removeChild(divContainer.lastChild);
								}
																
								row = new Array();
								cell = new Array();
								
								row_num = 3; 
								cell_num = '.$newQuery->num_rows.';
								
								tab = document.createElement("table");
								tab.setAttribute("id","newtable");
								tab.setAttribute("border","0");
								tab.setAttribute("width","95%");
								tab.setAttribute("cellspacing","0");
								tab.setAttribute("cellpadding","2");
								tab.setAttribute("style","padding-top:20px;");
								
								tbo = document.createElement("tbody");
								percent = 0;
								';
							
								// calculate the number of the emails have already sent
						// to make the fill the correct progression
						$countPercent = 0;
						$NoTemp = $newQuery->num_rows;
						$temp = "";
						$flag = "";
						$i = 0;	
						while ($result = $newQuery ->fetch_object()) 
						{
							$sendStatus = $result->sent_status;																									
							
							if($i == $NoTemp - 1)
							{
								$temp .= "'" . $result->subject . "'";	
								if($sendStatus == 0)
								{										
									$flag .= "'emailBarTo'";
								}
								else
								{
									$countPercent = $countPercent + 100 / $NoTemp;
									$flag .= "'emailBarCurrent'";
								}
								
							}
							else
							{
								$temp .= "'" . $result->subject . "',";	
								if($sendStatus == 0)
								{										
									$flag .= "'emailBarTo'" . "," ;
								}
								else
								{
									$countPercent = $countPercent + 100 / $NoTemp;
									$flag .= "'emailBarCurrent'" . ",";
								}
								
							}
								
							
							
							$i++;
						}
							//echo $flag;
							//echo 'document.write(myCars[0]);';	
								
								
								//use javascript to generate the progression via HTML table
								echo 'percent = '.$countPercent.';
								
										
									
								for(c=0 ; c < row_num ; c++)
								{
									if(c == 0)
									{
										row= document.createElement("tr");
							
										cell=document.createElement("td");
										cell.setAttribute("colspan",cell_num);
										
										
										cont=document.createTextNode("Email Progression");
										cell.appendChild(cont);
										row.appendChild(cell);
										tbo.appendChild(row);
										
									}
									else if(c == 1)
									{										
										row[c]= document.createElement("tr");
							
										cell = document.createElement("td");
										cell.setAttribute("colspan",cell_num);
																													
										bar = document.createElement("div");
										bar.setAttribute("style","height: 5px;");
										bar.setAttribute("class","ui-progressbar ui-widget ui-widget-content ui-corner-all");
										bar.setAttribute("role","progressbar");
										bar.setAttribute("aria-valuemin","0");
										bar.setAttribute("aria-valuemax","100");
										bar.setAttribute("aria-valuenow","33");
										
										barFill = document.createElement("div");
										barFill.setAttribute("style","width: " + percent + "%;");
										barFill.setAttribute("class","ui-progressbar-value ui-widget-header ui-corner-left");
										
										bar.appendChild(barFill);
										
										cell.appendChild(bar);
										row[c].appendChild(cell);
										tbo.appendChild(row[c]);
										
										
									}
									else
									{
										row[c]=document.createElement("tr");	
										mailed = ['.$flag.'];
										//mailed = "";
										//document.write("'.$flag.'");
										for(k=0;k<cell_num;k++)
										{
											cell[k]=document.createElement("td");
											cell[k].setAttribute("align","center");
											cell[k].setAttribute("width","\'" + percent + "%\'");										  		
							
											cell[k].setAttribute("class", mailed[k]);											
											
											cont=document.createTextNode("Email " +  (k+1));
											cell[k].appendChild(cont);
											row[c].appendChild(cell[k]);
										}
										tbo.appendChild(row[c]);
									}
									
									
								}
								tab.appendChild(tbo);
								
				// assign to div tag in wfa.php where the WFA email progress is display at the bottom of the Work Flow Action panel
								document.getElementById(\'tableProgress\').appendChild(tab); 
								
				//---------------------Email Details Table------------------------				
								
								divContainer = document.getElementById("tableReference");
								deltable = "";
								if(document.getElementById("emailTable") != null)
								{
									deltable = document.getElementById("emailTable");
									while(divContainer.hasChildNodes())
										divContainer.removeChild(divContainer.lastChild);
								}
								row = new Array();
								cell = new Array();
								
								row_num = '.$newQuery->num_rows.';
								cell_num = 2;
								
								tab = document.createElement("table");
								tab.setAttribute("id","emailTable");
								tab.setAttribute("border","1");
								tab.setAttribute("width","95%");
								tab.setAttribute("cellspacing","4");
								tab.setAttribute("cellpadding","2");
								tab.setAttribute("style","padding-top:0");
																
							
								percent = 0;							
							
								
								//use javascript to generate the progression via HTML table

								emailSubject = ['.$temp.'];
								//emailSubject = "";
								//document.write("'.$temp.'");
								for(c=0 ; c < row_num ; c++)
								{									
									row[c]=document.createElement("tr");
									row[c].setAttribute("valign","top");
									subject = emailSubject[c];
									
									for(k=0;k<cell_num;k++)
									{
										if(k==0)
										{
											cell[k]=document.createElement("td");																				
										
											cont=document.createTextNode("Email " + (c+1));
											cell[k].appendChild(cont);
											row[c].appendChild(cell[k]);
										}
										else
										{
											cell[k]=document.createElement("td");											
											cont=document.createTextNode(subject);
											cell[k].appendChild(cont);
											row[c].appendChild(cell[k]);
										}
									}
									tab.appendChild(row[c]);
								}
								
				// Display the Email Details
								document.getElementById(\'tableProgress\').appendChild(tab); 
								
							}';
						
							echo "makeTable();";
							echo "</SCRIPT>";	
						
						} 
				}
				else 
				{
					echo 'ERROR: There was a problem with the query.';
				}
			}
			else 
			{
				// Dont do anything.
			}
		} 
		else 
		{
			echo 'There should be no direct access to this script!';
		}
	}
	
?>