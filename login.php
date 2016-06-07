<?php

include_once 'scripts/connection.php';

$error='';

if(isset($_POST['username']))
{
	$username=$_POST['username'];
	$password=$_POST['password'];

	if((!$username)||(!$password))
	{
		$error="Please Fill In All The Fields.";
	}
	else
	{
		$password=md5($password);
		$uservalid=$pdo->prepare('SELECT * FROM users WHERE username=? AND password=?');
		$uservalid->bindValue(1,$username);
		$uservalid->bindValue(2,$password);
		$uservalid->execute();
		$usercount=$uservalid->rowCount();
		if($usercount==0)
		{
			$error="Invalid Username/Password.";
		}
		else
		{
			$_SESSION['username']=$username;
			header('Location:index.php');
		}
	}
}


?>
<!DOCTYPE HTML>
<html>
<head>	
	<title>Login</title>
	<link rel="stylesheet" href="css/login.css">
	<link rel="stylesheet" href="css/component.css">
	<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
	<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script>
$(document).ready(function(){
$("#gayab").slideUp(5000);
});
</script>
	</head>
<body style="background:url('back.jpg');background-size:100% 800px;background-repeat:no-repeat;">
	
	<div id="loginform" style="display:block;">
	<form action="login.php" method="post">
	<div style="position:absolute;left:33%;top:25%;">
	<center>
	
	<div><span style="color:#57e85;font-size:30px;margin-top:110px;">Username : </span>&nbsp;&nbsp;<input type="text" id="username1" name="username" placeholder=""> <br></div>
	
	<div><span style="color:#5be85;font-size:30px;">Password : </span><input type="password" id="password1" name="password" placeholder=""><br></div>
	<input type="submit" id="submit1" value="Sign In">
	 
	<a href="register.php"><button id="signup" type="button" style="font-size:20px;background:transparent;border-radius:50%;margin-left:50px;margin-top:30px;width:90px;height:90px;border:1px solid black;">Sign Up</button></a>

	</center>
	</div>
	
	</form>
	</div>
	<span id="gayab" style="position:absolute;font-size:30px;left:250px;top:90px;"><?php echo $error; ?></span>
	
	</body>

</html>