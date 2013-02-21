<?php
//Send Email

if(isset($_POST['EmailList']))	//process for sending multiple emails
{
	//define a variable to receive ann array of the emaillist from the Ajax (SupportFunction.js - sendAllEmail() function)
		
	include("../db_conection/AjaxConnection.php");	
	if(!$db)
	{
		echo 'ERROR: Could not connect to the database.';
	}
	else
	{
		$emailList = $db->real_escape_string($_POST['EmailList']);
		$query = $db->query("SELECT wc.wfa_temp_can_id, wt.subject, wt.content, e.email_ID, a.ag_lName, c.can_fName, c.can_lName
								FROM  wfa_template_for_candidate wc, wfa_template wt, candidate c, multi_email e, agent_has_candidate ac, agent a
								WHERE wc.wfa_template_ID = wt.wfa_template_ID
								AND wc.candidate_ID = c.candidate_ID
								AND c.candidate_ID = e.candidate_id
								AND e.primary_email = '1'
								AND ac.candidate_id = c.candidate_ID
								AND ac.agent_id = a.agent_ID
								AND wc.wfa_temp_can_id IN (".$emailList.")"); // The Query String
			
			if($query)
			{
				$sentmessage = "";
				$can_fullname = "";
				while ($result = $query ->fetch_object()) 
				{	
					$can_fullname = $result->can_fName." ".$result->can_lName;
					$to = $result->email_ID;
					$subject = $result->subject;
					$message = $result->content;
					$headers = "Agent : " . $result->ag_lName;
					$id = $result->wfa_temp_can_id;
					
					$mail_sent = @mail( $to, $subject, $message, "duc@localhost.com" );					
					if($mail_sent)
					{
						echo "Mail sent";
						//update into database
						$sql="UPDATE wfa_template_for_candidate
						SET sent_status = '1',	date_sent = NOW()
						WHERE wfa_temp_can_id = '$id '";
						$db->query($sql);						
					} 
					else
					{
						echo "Mail failed";
					}	
				}	
				//header("Location:getAgentToDoList.php");
			} 
			else 
			{
				echo 'ERROR: There was a problem with the query.';
			}	
		//printf($sentmessage);
	}
}
else //process for sending single email
{
	
	if(isset($_POST['strCandidateID']))
	{
		//printf("aaa");
		include("../db_conection/AjaxConnection.php");	
		if(!$db)
		{
			echo 'ERROR: Could not connect to the database.';
		}
		else
		{		
			//define the receiver of the email
			$to = $_POST['strTo'];
			//define the subject of the email
			$subject = $_POST['strSubject']; 
			//define the message to be sent. Each line should be separated with \n
			$message = $_POST['strMessage'];
			//define the headers we want passed. Note that they are separated with \r\n
			$headers = $_POST['strHeader'];
			
			//send the email
			$mail_sent = @mail( $to, $subject, $message,  "duc@localhost.com" );
			//if the message is sent successfully print "Mail sent". Otherwise print "Mail failed" 
			
			
			if($mail_sent)
			{
				echo "Mail sent";
				//update into database
				
				//define the receiver of details for updating database
				$can_id = $db->real_escape_string($_POST['strCandidateID']);		
				$wfa_id = $db->real_escape_string($_POST['strWFAID']);		
				$template_id = $db->real_escape_string($_POST['strTemplateID']);
				$note = $db->real_escape_string($_POST['strNote']);
				
				$sql="UPDATE wfa_template_for_candidate
				SET sent_status = '1',	date_sent = NOW(), comment = '$note'
				WHERE wfa_template_ID = '$template_id'
				AND wfa_id = '$wfa_id'
				AND candidate_ID = '$can_id'";
				//printf($sql);
				$db->query($sql);						
			} 
			else
			{
				echo "Mail failed";
			}
		}
	}
}


?>