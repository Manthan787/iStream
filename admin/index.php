<?php
include_once '../scripts/connection.php';
$error='';
if(isset($_SESSION['logged_in']))
{
	header('locaiton:admin.php');
}


	if(isset($_POST['username']))
	{
		$username=$_POST['username'];
		$password=$_POST['password'];
		if(empty($username) || empty($password))
		{
			$error="Please fill in all the deatails.";
		}
		else
		{
			$password=md5($password);
			$query=$pdo->prepare('SELECT * FROM admin WHERE username=? AND password=? ');
			$query->bindValue(1,$username);
			$query->bindValue(2,$password);
			$query->execute();
			$count=$query->rowCount();
			if($count==0)
			{
				$error="Invalid Username/Password!";
			}
			else
			{
				$_SESSION['admin']=$username;
				$_SESSION['logged_in']=1;
				header('location:admin.php');
			}
		}
	}

?>
<!DOCTYPE HTML>

<html>
<head>
	<title>Admin Panel </title>
	<link rel="stylesheet" href="../css/login.css">
	<link rel="stylesheet" href="../css/register.css">
	<link rel="stylesheet" href="../css/adminlogin.css">
</head>
<body>
	<center><div id="loginheader"> Admin Log In</div></center>
	<?php echo $error; ?>
	<form action="index.php" method="POST">
	<center><span id="username">Username : <input id="parth" type="text" name="username"></span> <br>
	<span id="password">Password : <input id="chokshi" type="password" name="password"></span> <br>
	<input type="submit" value="Log In">
	</center>
	</form>
</body>

</html>


