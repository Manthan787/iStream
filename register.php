<?php
	include_once 'scripts/connection.php';
	$error='';
	if(isset($_POST['username']))
	{
		$username=$_POST['username'];
		$fullname=$_POST['userfullname'];
		$email=$_POST['email'];
		$password1=$_POST['password1'];
		$password2=$_POST['password2'];
		if((!$username)||(!$fullname)||(!$email)||(!$password1)||(!$password2))
		{
			$error='All the fields are mandatory. Make sure you have filled each one of them.';
		}
		else
		{
			if($password1!=$password2)
			{
				$error="Your Passwords Do Not Match";
			}
			else
			{
				

				$userq=$pdo->prepare('SELECT * FROM users WHERE username=?');
				$userq->bindValue(1,$username);
				$userq->execute();
				$count=$userq->rowCount();

				if($count>0)
				{
					$error='The Username has already been taken. Please Try Something Else.';
				}

				else
				{

				$password=md5($password1);
				$fullname=preg_replace("#[^a-z]#i", "", "$fullname");
				$username=preg_replace("#[^a-z0-9]#i", "", "$username");

				$query=$pdo->prepare("INSERT INTO users(username,userfullname,email,password) VALUES (?,?,?,?)");
				$query->bindValue(1,$username);
				$query->bindValue(2,$fullname);
				$query->bindValue(3,$email);
				$query->bindValue(4,$password);
				$query->execute();
				$error="Successfully Registered.";

				}
				
			}
		}
	}

?>
<!DOCTYPE HTML>
<html>
<head>	
	<title>SignUp</title>
	<link rel="stylesheet" href="css/register.css">
	<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
	<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script>
$(document).ready(function(){
$("#gayab").slideUp(5000);
});
</script>
</head>
<body style="background:url('back.jpg') no-repeat;background-size:100% 800px;">
	<form action="register.php" method="post">
	<div style="margin-top:-90px;margin-left:0px;">
	<center>
	<table>
	
	<tr><td>Username</td> <td>:</td> <td><input id="username" type="text" name="username" ></td></tr> <br>
	<tr><td>Fullname</td> <td> :</td> <td> <input id="fullname" type="text" name="userfullname" ></td></tr> <br>
	<tr><td>E-mail</td> <td> : </td> <td><input id="email" type="text" name="email" ></td></tr><br>
	<tr><td>Password </td> <td>: </td> <td><input id="passsword" type="password" name="password1"></td></tr><br>
	<tr><td>Re-Type Password </td> <td>: </td> <td><input type="password" name="password2"></td></tr><br>
	</table>
	<input type="submit" value="Sign Up">
	<a href="login.php"><button id="login" type="button">Login</button></a>
	</center>
	</div>
	</form>
	
	<center id="gayab"><?php echo $error; ?></center>
</body>

</html>