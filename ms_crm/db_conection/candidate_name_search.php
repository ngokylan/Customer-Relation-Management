<?php
	session_cache_limiter("nocache");
	session_start();
/*
	Team:			blueSky
    Programmer:		Liam Handasyde
    Purpose:		used by multiple .php files for connection calls to the database - require_once();
    Client:			Milestone Search
    Version:		11.0 06.10.2010
    File:			candidate_name_search.php
*/

//capture form result with validation

//collection variables
$candidateNameSearch = "";
//error variables
$candidateNameSearchEmpty = 0;

if(!isset($_POST["txtFstNumb"]))//if not requested from form
{
	echo "<script language='javascript'>window.location = 'index1.php';</script>";
	die;
}
else if(isset($_POST["submit"]))//if legit and from request from the form
{
	if($_POST["candidateNameSearch"] == NULL)
	{
		$candidateNameSearchEmpty = 1;
	}
	else
		{
			$candidateNameSearch = $_POST["candidateNameSearch"];
			
			//Call for database results
	
			//call for connection to the db through the db_connect.php connection file
			require_once("db_connect.php");
			
			//sql request string
			$sql = "SELECT can_fName FROM candidate WHERE can_fName=$candidateNameSearch";
			
			//send query
			$db_query = mysql_query($sql, $db_connection_Localhost)
							or die ("Query failed: " . mysql_error());
			
			//instanciate an array object
			//$candName["can_fName"] = array();				
			//assign result to an array
			//$arrayRecords = mysql_fetch_array($db_query)
			while($arrayRecords = mysql_fetch_array($db_query_records))
			{
				$candName["can_fName"][] = $arrayRecords["can_fName"];
			}
							
			//free memory alocation space
			mysql_free_result($db_query);
			//close the db connection
			mysql_close($db_connection_Localhost);
	
		}
	//send captured results back to the advancedsearch.php
	echo "<script language='javascript'>window.location = '../include_php/advancedsearch.php?candName=$arrayRecords';</script>";/*sending an array back through the header*/
		
}
//header("Location:../index1.php?");
/*header("Location:tut3_qu3_headerReciever.php?sendTest=$test&recSubjectId=$subjectId& recTutorial=$tutorial&recProject=$project&recExam=$exam");}*/
?>