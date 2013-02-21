<?php
/*
	Team:			blueSky
    Programmer:		Liam Handasyde
    Purpose:		used by multiple .php files for connection calls to the database - require_once();
    Client:			Milestone Search
    Version:		11.0 06.10.2010
    File:			db_connect.php
*/
//Please Don't Change Any Variable Inside Thanks, TOMMY
//connection
						   /*or "localhost" to replace -"127.0.0.1"*/
$db_con = mysql_connect("isync.zzl.org", "435606_isyncuser", "CIT27AIsync")
						or die("Could not connect: " . mysql_error());
						
//Select database
mysql_select_db("isync_zzl_crmdatabase", $db_con) 
						or die("could not find: " . mysql_error());
						
//db_connect.php END
?>
