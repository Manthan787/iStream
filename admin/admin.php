<?php
include_once '../scripts/connection.php';
if(isset($_SESSION['admin']))
{
$name=$_SESSION['admin'];
}
else
{
	header('location:index.php');
}

?>
<!DOCTYPE HTML>
<html>
<head>	
	<title>Admin-Panel</title>
	<link rel="shortcut icon" href="../favicon.ico">
		<link rel="stylesheet" type="text/css" href="css/default.css" />
		<link rel="stylesheet" type="text/css" href="css/component.css" />
		<script src="js/modernizr.custom.js"></script>
	</head>
</head>
<body>
<div class="container">	
			<header class="clearfix">
				<h1>Welcome To The Admin Panel <span></span></h1>	
			</header>
			<div class="main">
				<div class="side">
					<nav class="dr-menu">
						<div class="dr-trigger"><span class="dr-icon dr-icon-menu"></span><a class="dr-label">Account</a></div>
						<ul>
							<li><a class="dr-icon dr-icon-user" href="#"><?php echo $name;?></a></li>
							<li><a  href="admin.php">Home</a></li>
							<li><a  href="add.php">Add Songs</a></li>
							<li><a  href="edit.php">Edit Songs</a></li>
							<li><a  href="delete.php">Delete Songs</a></li>
							<li><a  href="logout.php">Logout</a></li>
							
								</ul>
					</nav>

				</div>
				<p>You Can Moderate the content of the entire website from here. No Kidding.</p>
				
			</div>
		</div><!-- /container -->
		<script src="js/ytmenu.js"></script>

	
</body>

</html>

