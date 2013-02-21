<link href="../style/tablestyle.css" rel="stylesheet" type="text/css" />
<h1>Work Flow Action Template</h1>


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
                  		<?php
			
			
			//-------------------------MInh-------------------------------
			//-----------Display WFA code on the left of the table--------
            require("../../db_conection/db_connect.php");
			
			
			//check if submit link with "remove" or "assign" template
			/*
			$template_ID = $_GET['wfa_template_ID'];
			$flag = $_GET['assign'];
			$wfa_id = $_GET['wfa_id'];
			if((isset($template_ID) || $wfa_id) && isset($flag))
			{
				$query = "";
				if($flag == "assign")
				{
					//take the first day which candidate was added into database + the next email day
					$query2 = "select date_add(datetime, interval 10 day) from wfa_assignment where wfa_ID = '$wfa_id'";
					
					$dbRecords_query2 = mysql_query($query2, $db_con ) 
                    Or die('Query failed:'.mysql_error());
					
					$arrRecords_query2 = mysql_fetch_array($dbRecords_query2);
					
					$nextEmailDay = $arrRecords_query2['datetime'];
					
					$query = "insert into wfa_has_template ('wfa_id','wfa_template_ID','email_day')
													values ('$wfa_id','$template_ID','')";
				}
				if($flag == "remove")
				{
					$query = "delete from wfa_has_template where wfa_template_ID = '".$template_ID ."'";
				}
					
			}
			*/
			
			
			
			
            
            //3 Construct SQL statement
            $sql1 = 'select * from wfa order by wfa_ID;';
            
            //4 Get Recordset based on SQL above
            $dbRecords1 = mysql_query($sql1, $db_con ) 
                    Or die('Query failed:'.mysql_error());
            
            //5 Loop through records
            while( $arrRecords1 = mysql_fetch_array($dbRecords1)) 
            {
                
                if(isset($_GET["wfa_ID"]))
				{
					if($arrRecords1["WFA_ID"] == $_GET["wfa_ID"])
					{
						echo '
                            <tr valign="top">
                              <th scope="col"><font style="font-size:12"><a href="ViewWFAassignment.php?wfa_ID='.$arrRecords1['WFA_ID'].'">'.$arrRecords1["Title"].'</a></font></th>                                                         
                            </tr>
                        ';
					}
					else
					{
						echo '
                            <tr valign="top">
                              <td><font style="font-size:12"><a href="ViewWFAassignment.php?wfa_ID='.$arrRecords1["WFA_ID"].'">'.$arrRecords1["Title"].'</a></font></td>                                                         
                            </tr>
                        ';
					}
				}
				else
				{
					if($arrRecords1["WFA_ID"] == 1)
					{
						echo '
                            <tr valign="top">
                              <th scope="col"><font style="font-size:12"><a href="ViewWFAassignment.php?wfa_ID='.$arrRecords1["WFA_ID"].'">'.$arrRecords1["Title"].'</a></font></th>                                                         
                            </tr>
                        ';
					}
					else
					{
						echo '
                            <tr valign="top">
                              <td><font style="font-size:12"><a href="ViewWFAassignment.php?wfa_ID='.$arrRecords1["WFA_ID"].'">'.$arrRecords1["Title"].'</a></font></td>                                                         
                            </tr>
                        ';
					}
				}
            }
            //6 Free Recordset and Close connection
            mysql_free_result($dbRecords1);
            
            ?>
                  </tr>
               </tbody>
            </table>
        </td>
        <td width="400px">
        	<table border="0" width="400px" id="Assign_gradient_style_current" >
            	 <thead>
                  <tr>        
                  		<th scope="col" width="50px">Day</th>                
                        <th scope="col" width="300px">Current WFA Template</th>
                        <th scope="col" width="50px"></th>            
                                  
                    </tr>
                </thead>
                
            			<?php
			//------------------Minh-----------------------------------------
			//------load the WFA tempalte follow by WFA code-----------------
			
			//sql is used for loading the WFA Template follow by WFA code
			$sql="";
			
			//sql2 is used for loading the rest WFA Template which is not belong to specific WFA code on the left panel
			$sql2="";
			
			if(isset($_GET['wfa_ID']))
			{
				$sql = 'select wht.email_day, wht.wfa_ID, wht.wfa_template_ID, wt.subject, LEFT(wt.content,100) as content
						from wfa_template wt, wfa_has_template wht
						where wt.wfa_template_ID = wht.wfa_template_ID
							and wht.wfa_id ="'.$_GET['wfa_ID'].'" order by wht.wfa_template_ID';
							
							
				$sql2 = 'select wt.subject, wt.wfa_template_ID, LEFT(wt.content,100) as content
						 from wfa_template wt
						 where wt.wfa_template_ID not in (select wht.wfa_template_ID 
														  from wfa_has_template wht                         
														  where wht.wfa_ID = "'.$_GET['wfa_ID'].'")
						 order by wt.wfa_template_ID';
			}
			else
			{
				$sql = 'select wht.email_day, wht.wfa_ID, wht.wfa_template_ID, wt.subject, LEFT(wt.content,100) as content
						from wfa_template wt, wfa_has_template wht
						where wt.wfa_template_ID = wht.wfa_template_ID
							and wht.wfa_ID = "1" order by wht.wfa_template_ID';
							
				
				$sql2 = 'select wt.subject, wt.wfa_template_ID, LEFT(wt.content,100) as content
						 from wfa_template wt
						 where wt.wfa_template_ID not in (select wht.wfa_template_ID 
														  from wfa_has_template wht                         
														  where wht.wfa_ID = "1")
						 order by wt.wfa_template_ID';
			}
			
			
			
			//4 Get Recordset based on SQL above
			$dbRecords = mysql_query($sql, $db_con ) 
					Or die('Query failed:'.mysql_error());
					
			
			
			//5 Loop through records
			while( $arrRecords = mysql_fetch_array($dbRecords)) 
			{
				
				echo '		<tr>				
							  <td width="50" align="center">'.$arrRecords["email_day"].'</td>
							  <td width="350px">
							  
								  <table id="Current_gradient-style">
									<tr>
										<td valign="top">Subject: </td>
										<td align="left">'.$arrRecords["subject"].'</td>
									</tr>
						
									<tr>
									<td valign="top">Content:</td>
									<td align="left">'.$arrRecords["content"].'</td>
									</tr>
								 </table>
				
							  </td>	
							  <td><a href="ViewWFAassignment.php?wfa_template_ID='.$arrRecords['wfa_template_ID'].'&assign=remove">Remove</a></td>
							</tr>';
			}
			
			//6 Free Recordset and Close connection
			mysql_free_result($dbRecords);
			
		?>
        	<tr>
            	<td colspan="5" align="left"><a href="AddWFATemplate.php">Add new template</a></td>
            </tr>
            </table>	
        </td>
        
        
        
        
        <!-- Assign WFA Template panel-->
        
        <td>
        	<table id="Assign_gradient-style"> 
            	<thead>
                  <tr>                
                        <th scope="col" width="300px">Assign WFA Template</th>            
                        <th scope="col" width="50px">Day</th>        
                        <th scope="col" width="50px">Add</th> 
                    </tr>
                </thead>
                
                <?php
				$dbRecords_sql2 = mysql_query($sql2, $db_con ) 
					Or die('Query failed:'.mysql_error());
					
				while( $arrRecords_sql2 = mysql_fetch_array($dbRecords_sql2)) 
			{
				
				echo '		<tr>				
							  <td width="350px">
							  
								  <table id="Current_gradient-style">
									<tr>
										<td>Subject: </td>
										<td align="left">'.$arrRecords_sql2["subject"].'</td>										
									</tr>
						
									<tr>
									<td valign="top">Content:</td>
									<td align="left">'.$arrRecords_sql2["content"].'</td>
									</tr>
								 </table>
				
							  </td>			
							  <td><input name="txtNextDay" type="text" value="" maxlength="5" style="width:50"/></td>
							  <td width="50" align="center"><a href="ViewWFAassignment.php?wfa_template_ID='.$arrRecords_sql2["wfa_template_ID"].'&wfa_ID=  &assign=active">Add</a></td>
							</tr>';
			}
			
			//6 Free Recordset and Close connection
			mysql_free_result($dbRecords_sql2);
				
				mysql_close($db_con);
				?>
                
                
            </table>
        </td>
    </tr>
</table>



