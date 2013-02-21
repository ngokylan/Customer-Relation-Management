<? ob_start(); ?>
<?php
/*
	Team:			blueSky
    Programmer:		Tommy Wijaya edited by Liam Handasyde
    Purpose:		Login Screen
    Client:			Milestone Search
	Purpose:		Secure login to the CRM contents
    Version:		18.0 04.11.2010
    File:			index.php
*/


  
  
  
$logBool='0';
//echo $_GET['info'];
if (isset($_GET['info'])){
	if($_GET['info']=="out"){
		$_GET['info']="Logout Success";
		$logBool='1';
		setcookie("username",'',time()-3600);
		setcookie("id",'',time()-3600);
		session_start();
		if(isset($_SESSION['userID']))
			session_destroy();
		//die;
	}else{
	}
}

if (isset($_COOKIE["username"])&& isset($_COOKIE["id"])){
	if($logBool == '0'){
	session_start();
	$_SESSION['userName']=$_COOKIE['username'];
	$_SESSION['userID']=$_COOKIE['id'];
	echo '<script language="javascript">window.location = "ms_crm/index.php?'.$_SESSION['id'].'";</script>';
	exit();
	}
}

$info="";
$userNote="";
$passNote="";
$user="";

if(isset($_GET['info'])){$info=$_GET['info'];}

if(isset($_POST['submit'])){
	
	$user = trim($_POST['txtUsername']);
	$pass = trim($_POST['txtPassword']);
	
	$userNote=" ";
	$passNote=" ";
	$tempLogin=0;
	$tempMax = 3;
	$errorCode =0;
	
		if($user == "")
		{
			$userNote = "Please Fill Username"; // Give Error If The User Field Empty
		}
		
		if($pass =="")
		{
			$passNote = "Please Fill Password"; // Give Error if The Password Field Empty
		}
	
		if(($user != "")&&($pass !=""))
		{
			//Select Data Using the User Name
			$queryStatement="SELECT * FROM  `agent` WHERE  `ag_fName` LIKE  '$user'";
			
			require_once("ms_crm/db_conection/db_connect.php");
			
			$dbRecord = mysql_query($queryStatement,$db_con) 
				or die ("Problem Reading Table: ".mysql_error());
				
			if($dbRecord)
			{
	 
			 	//Gives error if user dosen't exist
				$check2 = mysql_num_rows($dbRecord);
				if ($check2 == 0) 
				{
					 $userNote = "Username Not Found";
				}
				
				
				while($recs = mysql_fetch_array($dbRecord))
				{
					if ($user == $recs["ag_fName"])
					{
						$password = "";
						require("ms_crm/include_php/password_function.php");
						$tempLogin = $recs["ag_logAttempts"];
						$agentID = $recs["agent_ID"]; //Get the Agent ID
						$password = $recs["ag_password"];
				

						
						if($tempLogin >= $tempMax)
						{
							$userNote = "Username Locked, Please Contact Administrator"; //Gives error if the Agent User Name Locked
						}						
						//call validate password function using sha1 algorithm
						elseif(validate_password($pass, $password))
							{
									//$codeString = $recs["agent_ID"].$user; //Set The String That Will Encode to The Main Page
									//$eUser = base64_encode($codeString); 
									$query="UPDATE  `agent` SET  `ag_logAttempts` =  '0' WHERE  `agent`.`agent_ID` =$agentID"; // Update the log Temp In Database
									mysql_query($query)	or die('<br /> Query failed :'.mysql_error());
									$agentID = $recs['agent_ID'];
									$agentLevel = $recs['ag_levelAccess'];
									//set Cookie
									setcookie("username",$user,time()+3600);
									setcookie("id",$agentID,time()+3600);
									
									//set Session
									session_start();
									$_SESSION['userName']=$user;
									$_SESSION['userID']=$recs["agent_ID"];
									$_SESSION['usrType']=$agentLevel;//minh 10/5/2011
									
									if ($agentLevel == "2"){
										//header("Location:ms_crm/index.php?".$_SESSION['id']."");
										echo '<script language="javascript">window.location = "ms_crm/admin/index.php?'.$_SESSION['id'].'";</script>';										
									}
									if ($agentLevel == "1"){
										echo '<script language="javascript">window.location = "ms_crm/admin/index.php?'.$_SESSION['id'].'";</script>';			
										
									}
																	
									
									//header("Location:ms_crm/index1.php?o=$eUser");
									exit;
							}
							else
								{	// add Temp Login error + 1
									$tempLogin +=1; 
									// Update the log Temp In Database
									$query="UPDATE  `agent` SET  `ag_logAttempts` =  '$tempLogin' WHERE  `agent`.`agent_ID` =$agentID"; 
									mysql_query($query) 
										or die('<br /> Query failed :'.mysql_error());
									$changes = 3 - $tempLogin;
									//Give the Number of change the User can try
									$passNote="Warning! Password is not Match<br />You Only Can Try : ".$changes." times!"; 
								}
					}
				}			
			}
			else
				{
					$userNote = "Error Login";
				}
		}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!--<!DOCTYPE html>
<html>-->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>..:: Welcome to Milestone Search CRM ::.. Ver 18</title>

<!--css styling-->
<!--<link href="viewing/css/ls_viewing.css" rel="stylesheet" type="text/css" />
<link href="ms_crm/css/ui-lightness/jquery-ui-1.8.5.custom.css" rel="stylesheet" type="text/css" />-->

        		<script type="text/javascript" src="ms_crm/js/crm_browserDetector.js"></script>
        
        <!-- choose .css styling based on browser / device type -->
<script type="text/javascript">
	//document.write("Testing");
	var browserDetect = "blank_value";
	var value = 0;
	
	if(BrowserDetect.browser == "Firefox")
	{
		browserDetect = "firefox Sniffer css";//FIREFOX CSS
		value = 1;
	}
	if(BrowserDetect.browser == "Explorer")
	{
		browserDetect = "explorer Sniffer css";//EXPLORER CSS
		value = 2;
	}
	if(BrowserDetect.browser == "Safari")
	{
		browserDetect = "Un-supported browser type!";
		value = 3;	
	}
	if(BrowserDetect.browser == "Chrome")
	{
		browserDetect = "chrome Sniffer css";
		value = 4;
	}
	
	//document.write(browserDetect);
	//document.write("-------------"+csslink);
<!-- implements browser / device sniffer decission  -->	

	function addCSS() {
            var headtg = document.getElementsByTagName('head')[0];
            if (!headtg) {
                return;
            }
			
            var linktg = document.createElement('link');
            linktg.type = 'text/css';
            linktg.rel = 'stylesheet';
			
			if (value == 1)	{
	            linktg.href = 'ms_crm/css/ui-lightness/jquery-ui-1.8.5.custom.css';
            }else if (value == 2){
	            linktg.href = 'ms_crm/css/ui-lightness/ie.css';//--------Internet Explorer
			}else if(value == 3){
				linktg.href = 'ms_crm/css/ui-lightness/gc.css';
			}else if(value == 4){
				linktg.href = 'ms_crm/css/ui-lightness/gc.css';//--------Google Chrome
			}else {
			    linktg.href = 'ms_crm/css/ui-lightness/jquery-ui-1.8.5.custom.css';
			}	
				
			linktg.title = 'Rounded Corners';
            headtg.appendChild(linktg);
   }
</script>
</head>

<body onLoad="addCSS();">
<form action="index.php" method="post" name="form1" id="form1"><!--<form action="ms_crm/db_conection/log.php" method="post">-->
<div id="loginContainer">
	<div class="containerInner">
    	<div id="centerLog">
            <div class="rowsContainer">
            	<div id="header">
                	<p><b id="heading">Welcome to Milestone Search CRM</b><br/>
                    <b id="informTxt">Please  type in your username and password to login.</b></p>
                </div>
            	<div class="spacerRow">
                	<div class="errorLeft"></div>
                    <div class="errorRight">
                		<?php echo $info; ?>
                    </div>
                </div>
                <!--USERNAME-->
                <div class="row">
                    <div class="text">
                        <label for="txtUserName" class="txt">Username</label>
                    </div>
                    <div class="capture">
                        <input type="text" class="txtBox" id="txtUsername" name="txtUsername" value="<?php echo $user;?>" size="0"  autocomplete=off />
                    </div>
                </div>
                <div class="spacerRow">
               		<div class="errorLeft"></div>
                    <div class="errorRight">
						<?php echo $userNote; ?>
                    </div>
                </div>
                <!--PASSWORD-->
                <div class="row">
                    <div class="text">
                        <label for="txtPassword" class="txt">Password</label>
                    </div>
                    <div class="capture">
                        <input type="password" class="txtBox" id="txtPassword" name="txtPassword" />
                    </div>
                </div>
                <div id="spacerRow">
                	<div class="errorLeft"></div>
                    <div class="errorRight">
                		<?php echo $passNote; ?>
                    </div>
                </div>
                <!--BUTTONS-->
                <div class="row">
                <div class="text"><a href="#"><img src="ms_crm/image/help_icon.jpg" width="20"/></a></div>
                    <div class="errorRight">
                		<input type="reset" class="btns" id="reset" name="reset" value="Clear" />
                        <input type="submit" class="btns" id="submit" name="submit" value="Submit" />
                    </div>
                   
                </div>
			</div>
		</div>
	</div>
</div>
</form>
</body>
</html>
<? ob_flush(); ?>
