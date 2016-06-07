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

$msg='';
if(isset($_SESSION['logged_in']))
{
	if(isset($_GET['songid']))
	{

		$songid=$_GET['songid'];
		$f=$pdo->prepare('SELECT * FROM songs WHERE song_id=?');
		$f->bindValue(1,$songid);
		$f->execute();
		$r=$f->fetch();
		$DelMp3='../Mp3/'.$r['link'];
		$DelImg='../Mp3/img/'.$r['img'];
		
		if(unlink($DelMp3) && unlink($DelImg))
		{
			echo $r['song_title'];
		}
		
		
		
		
		$del=$pdo->prepare('DELETE FROM songs WHERE song_id=?');
		$del->bindValue(1,$songid);
		$del->execute();
		
		
		
		header('location:delete.php');
	}
	$fetch=$pdo->prepare('SELECT * FROM songs');
	$fetch->execute();

}

else
{
	header('location:index.php');
}
?>
<!DOCTYPE HTML>
<html>
<head>
	<title>Delete Song</title>
<link rel="stylesheet" type="text/css" href="css/default.css" />
		<link rel="stylesheet" type="text/css" href="css/component.css" />
		<script src="js/modernizr.custom.js"></script>
	</head>
</head>
<body>
<div class="container">	
			<header class="clearfix">
				<h1>Delete Songs <span></span></h1>	
			</header>
			<div class="main">
			<?php echo $msg; ?>

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
				
			<ul>
	<?php while($s=$fetch->fetch()) { ?>
	<li>
	<a href="delete.php?songid=<?php echo $s['song_id'];?>"><?php echo $s['song_title'];?></a>
	</li>
	<?php } ?>
	</ul>
	
		
	</ul>
	
		</div>
	</div>
	<script src="js/ytmenu.js"></script>
	
</body>

</html>