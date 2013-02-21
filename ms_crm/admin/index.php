<?php
	session_cache_limiter("nocache");
	session_start();
	if(isset($_POST['submit'])){
		echo '<script language="javascript">window.location = "../../index.php?info=out";</script>';
		exit;
	}
	elseif(isset($_POST["nav_userpage"]))
	{
		echo '<script language="javascript">window.location = "../index.php";</script>';
	}


	$usertype = "";
		if(isset($_SESSION['userName'])&&isset($_SESSION['userID'])&&isset($_SESSION['usrType'])){
			$agentID = $_SESSION['userID'];
			$consultant = $_SESSION['userName'];
			$usertype = $_SESSION['usrType'];
		}else{
			echo "Return to Index Page";
			echo '<script language="javascript">window.location = "../../index.php?info=Please Login";</script>';
			exit;
		}
		//session_destroy();
    ?>
<!--<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

    
<title>CRM Administration</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<link href="ff.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="../js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="../js/jquery-ui-1.8.5.custom.min.js"></script>
<script type="text/javascript" src="scripts/prototype.lite.js"></script>
<script type="text/javascript" src="scripts/moo.fx.js"></script>
<script type="text/javascript" src="scripts/moo.fx.pack.js"></script>
<script type="text/javascript" src="scripts/adminSupportFunction.js"></script>


<style type="text/css">
<!--
body {
	background-image: url(../assets/graphics/backgroundBar.png);
	background-repeat: repeat-x;
}
-->
</style></head>
<body onLoad="loadAll()">

<div id="headerDiv">
	<form name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
 &nbsp;Welcome,  <label id="agentID"><?php echo $consultant;?></label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; | &nbsp;
                             <input id="nav_userpage" class="tomButton" type="button" value="Go To User Page" onClick="window.location= '../index.php'">&nbsp;&nbsp;&nbsp; | <input class="tomButton" type="submit" name="submit" id="submit" value="Logout">&nbsp;
  </form>
</div>
<div id="wrapper">
	
	<div id="content">
	<h3 class="tab" <?php if($usertype==2) echo 'style="visibility:hidden"';?> title="Manage Consultant Details"><div class="tabtxt"><a href="#">Agent</a></div></h3>
	<div class="tab" <?php if($usertype==2) echo 'style="visibility:hidden"';?>><h3 class="tabtxt" title="Manage Client Details"><a href="#">Client</a></h3></div>
    <div class="tab" <?php if($usertype==1) echo 'style="visibility:hidden"';?>><h3 class="tabtxt" title="Manage Grossary"><a href="#">Glossary</a></h3></div>
	<div class="tab" <?php if($usertype==1) echo 'style="visibility:hidden"';?>><h3 class="tabtxt" title="Manage WFA"><a href="#">Work Flow Action</a></h3></div>
    <div class="tab" <?php if($usertype==1) echo 'style="visibility:hidden"';?>><h3 class="tabtxt" title="Manage Template"><a href="#">Work Flow Template</a></h3></div>
 	<div class="tab" <?php if($usertype==1) echo 'style="visibility:hidden"';?>><h3 class="tabtxt" title="Work Status"><a href="#">Work Status</a></h3></div>
    <div class="tab" <?php if($usertype==1) echo 'style="visibility:hidden"';?>><h3 class="tabtxt" title="Email Search"><a href="#">Email Search</a></h3></div>
	<div class="boxholder">
		<div class="box">
			<p>
            	<?php if($usertype == 1) include("consultant.php");
					if($usertype == 2) include("helpSystem.php");
					 ?>
            </p>
		</div>
		<div class="box">
			<p>
            	<?php if($usertype == 1) include("client.php");?>
            </p>
		</div>
		<div class="box">
			<p>
            	<?php if($usertype == 2) include("helpSystem.php")?>
            </p>
		</div>
		<div class="box">
			<p>
            	<?php if($usertype==2)include("wfaCode.php") ?>
            </p>
		</div>
        <div class="box">
			<p>
            	<?php if($usertype==2)include("wfaTemplete.php") ?>
            </p>
		</div>
        
        <!--
        <div class="box">
			<p>
            	
            </p>
		</div>
        -->
        <div class="box">
			<p>
            	<?php if($usertype==2) include("statusList.php") ?>
            </p>
		</div>
        <div class="box">
			<p>
            	<?php if($usertype==2)include("emailList.php") ?>
            </p>
		</div>
	</div>
</div>
</div>
<script type="text/javascript">
	Element.cleanWhitespace('content');
	init();
</script>
</body>
</html><!--http://www.nyokiglitter.com/tutorials/tabs.html-->