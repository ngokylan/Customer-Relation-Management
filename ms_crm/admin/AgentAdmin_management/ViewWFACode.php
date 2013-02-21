<link href="../style/tablestyle.css" rel="stylesheet" type="text/css" />

<?php
	require("../../db_conection/db_connect.php");
	
	if(isset($_GET['assignTemplate']) && $_GET['assignTemplate'] == 'y')
	{
		echo '
		<h1>Assign Template To Work Flow Action <a href="#"><img src="../../image/help_icon.jpg" width="20"/></a></h1>


		<table summary="Work Flow Action Code" align="left">
			<tr valign="top">
				<td style="border-right:thin; border-right-color:#0CF">
					<table width="150px" border="0">
						<thead>
						  <tr valign="top">
							   <th scope="col"><font color="#6699FF" style="font-size:12">WFA Name</font></th>                         
						  </tr>
						  </thead>
						  <tbody>
						  <tr>
				';
				
			//-------------------------MInh-------------------------------
			//-----------Display WFA code on the left of the table--------          
            
            //3 Construct SQL statement
            $sql1 = 'select * from wfa order by wfa_ID;';
            
            //4 Get Recordset based on SQL above
            $dbRecords1 = mysql_query($sql1, $db_con ) 
                    Or die('Query failed:'.mysql_error());
            
            //5 Loop through records
            while( $arrRecords1 = mysql_fetch_array($dbRecords1)) 
            {
                
                if(isset($_GET['wfa_ID']))
				{
					if($arrRecords1['WFA_ID'] == $_GET['wfa_ID'])
					{
						echo '
                            <tr valign="top">
                              <th scope="col"><font style="font-size:12"><a href="ViewWFACode.php?wfa_ID='.$arrRecords1['WFA_ID'].'&assignTemplate=y">'.$arrRecords1["Title"].'</a></font></th>                                                         
                            </tr>
                        ';
					}
					else
					{
						echo '
                            <tr valign="top">
                              <td><font style="font-size:12"><a href="ViewWFACode.php?wfa_ID='.$arrRecords1["WFA_ID"].'&assignTemplate=y">'.$arrRecords1["Title"].'</a></font></td>                                                         
                            </tr>
                        ';
					}
				}
				else
				{
					if($arrRecords1['WFA_ID'] == 1)
					{
						echo '
                            <tr valign="top">
                              <th scope="col"><font style="font-size:12"><a href="ViewWFACode.php?wfa_ID='.$arrRecords1["WFA_ID"].'&assignTemplate=y">'.$arrRecords1["Title"].'</a></font></th>                                                         
                            </tr>
                        ';
					}
					else
					{
						echo '
                            <tr valign="top">
                              <td><font style="font-size:12"><a href="ViewWFACode.php?wfa_ID='.$arrRecords1["WFA_ID"].'&assignTemplate=y">'.$arrRecords1["Title"].'</a></font></td>                                                         
                            </tr>
                        ';
					}
				}
            }
            //6 Free Recordset and Close connection
            mysql_free_result($dbRecords1);
			
			echo '
				 </tr>
               </tbody>
            </table>
        </td>
        <td width="400">
        	<table border="0" width="400" id="gradient-style" >
            	 <thead>
                  <tr>        
                  		<th scope="col" width="70">Email Day</th>                
                        <th scope="col" width="100">Work Flow Action Subject</th>              
                        <th scope="col width="200">Work Flow Template Content</th>
                        <th scope="col width="15"></th> 
                        <th scope="col width="15"></th>          
                    </tr>
                </thead>';
				
				
			//------------------Minh-----------------------------------------
			//------load the WFA tempalte follow by WFA code-----------------
			
			
			$get_wfa_ID ="";
			
			if(isset($_GET['wfa_ID']))
			{
				$get_wfa_ID = $_GET['wfa_ID'];				
			}
			else
			{
				$get_wfa_ID = 1;			
			}
			
			$sql = 'select wht.email_day, wht.wfa_ID, wht.wfa_template_ID, wt.subject, LEFT(wt.content,100) as content
						from wfa_template wt, wfa_has_template wht
						where wt.wfa_template_ID = wht.wfa_template_ID
						and wht.wfa_ID = "'.$get_wfa_ID.'" 
						order by wht.email_day';
			
			//load the templates which are not existed in a selected wfa
			$loadTemplateQuery = '
			select wt.subject, wt.wfa_template_ID, LEFT(wt.content,100) as content
			from wfa_template wt
			where wt.wfa_template_ID not in (select wht.wfa_template_ID 
											 from wfa_has_template wht
											 where wht.wfa_ID = "'.$get_wfa_ID.'")
			order by wt.wfa_template_ID';
			
			$TemplateRecords = mysql_query($loadTemplateQuery, $db_con ) 
					Or die('Query failed:'.mysql_error());
				
			settype($template_array,"array");
			
			     
			for($i=0;$i<mysql_numrows($TemplateRecords);$i++)
			{
					for($j=0;$j<mysql_num_fields($TemplateRecords);$j++)
					{
							$template_array[$i][mysql_field_name($TemplateRecords,$j)] = mysql_result($TemplateRecords,$i,mysql_field_name($TemplateRecords,$j));
					}//end inner loop
			}//end outer loop
		
			
						
			//4 Get Recordset based on SQL above
			$dbRecords = mysql_query($sql, $db_con ) 
					Or die('Query failed:'.mysql_error());
					
			echo '<form name="UpdateTemplate" action="AssignTemplate.php" method="post">';
			
			//5 Loop through records
			
			$k = 1; //use for naming the update and remove button in WFA assignment
			
			while( $arrRecords = mysql_fetch_array($dbRecords)) 
			{				
				echo '				
				
							<tr>				
							  <td width="70" align="center">							  
							  <input type="text" name="email_'.$arrRecords["wfa_template_ID"].'" value="'.$arrRecords["email_day"].'" style="width:50px"/>							  
							  </td>
							  <td width="100">
							  <select name="Update_cbTemplate_'.$arrRecords["wfa_template_ID"].'" >
							 <option selected="selected" value="'.$arrRecords['wfa_template_ID'].'">'.$arrRecords['subject'].'</option>';
							  
							  	
							  //load all template with the correct wfa's assignment
							  for($i=0;$i<count($template_array);$i++)
							  	{
									echo '<option value="'.$template_array[$i]['wfa_template_ID'].'">'.$template_array[$i]['subject'].'</option>';	  
								}
							  
				echo '		  </select>
							  </td>
							  <td width="200">'.$arrRecords["content"].'</td>					  
							  <td width="15"><input id="upd'.$k.'" type="submit" name="upd_submit" value="Update" onclick="javascript:return confirm(\'Update the Template from WFA may change the candidate email progression - Do you really want to update?\')" disabled/></td>
							  <td width="15"><input id="rmv'.$k.'" type="submit" name="rmv_submit" onclick="javascript:return confirm(\'Update the Template from WFA may change the candidate email progression - Do you really want to update?\')" value="Remove" disabled/> <input name="rdTemplateChosen" type="radio" onclick="enable_button(\'upd'.$k.'\',\'rmv'.$k.'\',\''.count($arrRecords).'\')" value="check_'.$arrRecords["wfa_template_ID"].'" /></td>
							</tr>							
				';
				
				$k++;
			}
			
			//hidden form to store the wfa_ID and wfa_template_ID which are used to send through the assignTemplate.php page
			echo '
				<input type="text" name="wfa_ID" value="'.$get_wfa_ID.'" style="visibility:hidden"/>
				</form>';
			
			//6 Free Recordset and Close connection
			mysql_free_result($dbRecords);
			mysql_close($db_con);
		
			echo '
					<tr>
					<td colspan="5" align="left"><a href="ViewWFACode.php?assignTemplate=y&addTemplate=y&wfa_ID='.$get_wfa_ID.'">Assign new template</a></td>
					</tr>';
					
				
				
			//new form for assign new template
			echo '<form name="assignTemplate" action="AssignTemplate.php" method="post">';
					
			if(isset($_GET['addTemplate']) && $_GET['addTemplate'] == "y")
			{
				require("../../db_conection/db_connect.php");
				
				$template_Query = '
				select wt.subject, wt.wfa_template_ID, LEFT(wt.content,100) as content
				from wfa_template wt
				where wt.wfa_template_ID not in (select wht.wfa_template_ID 
												 from wfa_has_template wht
												 where wht.wfa_ID = "'.$get_wfa_ID.'")
				order by wt.wfa_template_ID';
			
				//4 Get Recordset based on SQL above
				$template_Records = mysql_query($template_Query, $db_con ) 
						Or die('Query failed:'.mysql_error());
				
				echo '<tr>
						<td align="center"><input type="text" name="AssignEmailDay" value="0" style="width:50px"/></td>
						<td><select name="cbTemplate" >';
				
				//5 Loop through records
				while( $Template_arrRecords = mysql_fetch_array($template_Records)) 
				{
					echo '<option value="'.$Template_arrRecords['wfa_template_ID'].'">'.$Template_arrRecords['subject'].'</option>';
				}
						
				echo '</select></td>
					<td></td>
					<td><input name="btnAssign" type="submit" value="Insert "/></td>
					<td></td>
					
					</tr>';		
			}
			
			echo '<input type="text" name="wfa_ID" value="'.$get_wfa_ID.'" style="visibility:hidden"/>
				</form>';
					
					
					
					
			echo '</table>
				</td>
			</tr>
		</table>';
	}
	else
	{	
		
		echo '
		<h1>Work Flow Action Details <a href="#"><img src="../../image/help_icon.jpg" width="20"/></a></h1>
		<table id="gradient-style" summary="Work Flow Action Code" align="center">
			<thead>
			  <tr>
		<th scope="col">WFA Code</th>
					<th scope="col" align="center">WFA Description</th>
					<th scope="col"></th>
					<th scope="col"></th>
				</tr>
			</thead>
		   
			<tbody>
		';

		//3 Construct SQL statement
		$sql = 'select * from wfa order by WFA_ID;';
		
		//4 Get Recordset based on SQL above
		$dbRecords = mysql_query($sql, $db_con ) 
				Or die('Query failed:'.mysql_error());
		
		//5 Loop through records
		while( $arrRecords = mysql_fetch_array($dbRecords)) 
		{
			echo '
						<tr>
						  <td width="200">'.$arrRecords["Title"].'</td>
						  <td width="400">'.$arrRecords["Description"].'</td>
						  <td align="center"><a href="EditWFACode.php?txtID='.$arrRecords["WFA_ID"].'">Edit</a></td>
						  <td align="center"><a href="DeleteWFACode.php?txtID='.$arrRecords["WFA_ID"].'" onclick="return confirm(\'Are you sure to delete?\');">Delete</a></td>
						</tr>
					';
		}
		
		echo '
		  </tbody>
		   <tfoot>
			  <tr>
				<!--<td colspan="4">Give background color to the table cells to achieve seamless transition</td>-->
				<td colspan="2" align="left"><a href="AddWFACode.php">Add New Record</a></td>			
				<td></td>
				<td></td>
			  </tr>
			</tfoot>
		</table>
		';
		
		
		//6 Free Recordset and Close connection
		mysql_free_result($dbRecords);
		mysql_close($db_con);
		
		
		
	}
?>
<script language="javascript">
	//javascript for disabling or enabling the update or remove button in the WFA assignment
	function enable_button(updateButton, removeID, countRow)
	{		
		//disable the rest of other button 
		for(i = 1 ;i <= countRow; i++)
		{
			if(updateButton == ("upd" + i))
			{
				document.getElementById(updateButton).disabled = false;
				document.getElementById(removeID).disabled = false;					
			}
			else if(document.getElementById("upd" + i).value != null && document.getElementById("rmv" + i).value != null)
			{
				//alert("upd" + i);
				document.getElementById("upd" + i).disabled = true;
				document.getElementById("rmv" + i).disabled = true;
			}		
				
		}
	}
	

	function confirmSubmit()
	{
	    var agree=confirm("Update the Template from WFA may change the candidate email progression - Do you really want to update?");
		if (agree)
			return true ;
		else
			return false ;
	}



</script>



	
