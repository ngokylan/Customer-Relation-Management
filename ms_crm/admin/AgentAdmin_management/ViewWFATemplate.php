<link href="../style/tablestyle.css" rel="stylesheet" type="text/css" />
<h1>Work Flow  Template <a href="#"><img src="../../image/help_icon.jpg" width="20"/></a></h1>


<table summary="Work Flow Action Code" align="center">
	<tr valign="top">    	
        <td width="400px">
        	<table border="0" width="400px" id="gradient-style" >
            	 <thead>
                  <tr>        
                  		        
                        <th scope="col" width="200px">WFA Subject</th>              
                        <th scope="col">WFA Template Content</th>
                        <th scope="col"></th> 
                        <th scope="col"></th>          
                    </tr>
                </thead>
                
            			<?php
			//------------------Minh-----------------------------------------
			//------load the WFA tempalte follow by WFA code-----------------
			
			require("../../db_conection/db_connect.php");
			
			
			$sql = 'select wfa_template_ID, subject, LEFT(content,150) as content from wfa_template
						order by wfa_template_ID';
			
			
			
			
			//4 Get Recordset based on SQL above
			$dbRecords = mysql_query($sql, $db_con ) 
					Or die('Query failed:'.mysql_error());
			
			//5 Loop through records
			while( $arrRecords = mysql_fetch_array($dbRecords)) 
			{				
				echo '		<tr>				
							  
							  <td width="50">'.$arrRecords["subject"].'</td>
							  <td width="50">'.$arrRecords["content"].'</td>					  
							  <td><a href="EditWFATemplate.php?txtWFATempl='.$arrRecords["wfa_template_ID"].'">Edit</a></td>
							  <td><a href="DeleteWFATemplate.php?txtWFATempl='.$arrRecords["wfa_template_ID"].'" onclick="return confirm(\'Are you sure to delete?\');">Delete</a></td>
							</tr>';
			}
			
			//6 Free Recordset and Close connection
			mysql_free_result($dbRecords);
			mysql_close($db_con);
		?>
        	<tr>
            	<td colspan="5" align="left"><a href="AddWFATemplate.php">Add new template</a></td>
            </tr>
            </table>
        </td>
    </tr>
</table>



