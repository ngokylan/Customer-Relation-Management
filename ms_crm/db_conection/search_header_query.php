<?php

//capture variable
$candidateNameSearch = ""; $can_name = "";
//error variable
$errorEmpty = 0;

if(isset($_POST["submit"]))
{
	if($_POST["candidateNameSearch"] == NULL)
	{
		$errorEmpty = 1;
	}
	else
	{
		$candidateNameSearch = $_POST["candidateNameSearch"];
	}
	
	/*connect to the db
	$db_connection = mysql_connect("127.0.0.1","root","root")
						or die("Connection failure: " . mysql_error());
	*/
	require_once("db_connect.php");					
	//select the db
	mysql_select_db("crmdatabase", $db_connection_Localhost)
						or die("Database selection failure: " . mysql_error());
						
	//create aquery
	//$sql = "SELECT can_fName FROM candidate WHERE can_fName='$candidateNameSearch'";
	//$sql = "SELECT can_fName FROM candidate WHERE can_fName LIKE '%$candidateNameSearch%'";//use if you want LIKE
	//$sql = "SELECT candidate.can_fName, skill_set.skill_longDescr FROM candidate RIGHT JOIN skill_set ON candidate.candidate_ID=skill_set_has_candidate.candidate_ID  WHERE can_fName='$candidateNameSearch'";
	
	//SELECT Persons.LastName, Persons.FirstName, Orders.OrderNo
	//FROM Persons
	//INNER JOIN Orders
	//ON Persons.P_Id=Orders.P_Id
	//ORDER BY Persons.LastName
	
	//send for retreaval sql query
	$db_records = mysql_query($sql, $db_connection_Localhost)
						or die("Query failure: " . mysql_error()); 
	//print result
	echo "<table border='1'>
		<tr>
			<td>First name</td>
		</tr>";
	while($result = mysql_fetch_array($db_records))
	{
		$can_name = $result["can_fName"];
	}
	
	//---- Only used when returning records
	mysql_free_result($db_records);
	
	//---- closes conection
	mysql_close($db_connection_Localhost);
	//echo ("Run: " + $can_name) ;
	
	if(isset($_POST["submit"])&& $errorEmpty == 0)
	{
		echo "<p>You Made it into the if</p>";
		echo "<script language='javascript'>window.location = '../index1.php?can_name=$can_name';</script>";
	}
	else
		{
			echo "<p>You Made it Else</p>";
			//header("Location:../index1.php?");
		}
}
//<?php if(isset($_POST['submit']) && !($intErrorA + $intErrorB + $intErrorC + $intErrorD)){header("Location: tutorial3_3ver2_2.php?a=$a&b=$b&c=$c&d=$d");} ?>
?>