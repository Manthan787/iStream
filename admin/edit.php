<?php
	include_once '../scripts/connection.php';

	if(isset($_SESSION['logged_in']))
	{
	$name=$_SESSION['admin'];
	}
	else
	{
		header('location:index.php');
	}
	
	$query=$pdo->prepare('SELECT * FROM songs');
	$query->execute();


?>
<html>
<head>
	<title>Edit Song Details </title>
	<link rel="stylesheet" type="text/css" href="css/default.css" />
		<link rel="stylesheet" type="text/css" href="css/component.css" />
		
		<script src="js/modernizr.custom.js"></script>
	</head>
</head>
<body>
<div class="container">	
			<header class="clearfix">
				<h1>Edit Songs <span></span></h1>	
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
				<ul class="list">
		<?php while($Song=$query->fetch()) {?>
		<li>
			
			<a href="edit-page.php?songid=<?php echo $Song['song_id']; ?>"><?php echo $Song['song_title']; ?></a>

		</li>
		<?php } ?>
	</ul>
	
		</div>
	</div>
	<script src="js/ytmenu.js"></script>

</body>

</html>
<?php 

?>