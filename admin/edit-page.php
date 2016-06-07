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
	
	
	$error='';
	$songid=$_GET['songid'];
	$query=$pdo->prepare('SELECT * FROM songs WHERE song_id=?');
	$query->bindValue(1,$songid);
	$query->execute();
	$Song=$query->fetch();
    

	if(isset($_SESSION['logged_in']))
	{
			if(isset($_POST['title']))
			{
				$title=$_POST['title'];
				$artist=$_POST['artist'];
				$movie=$_POST['movie'];
				$lyrics=nl2br($_POST['lyrics']);

				for($id=0;$id<count($_FILES['file']['name']);$id++)
        		{
            
        
        			if($id==0)
        			{
            			if(empty($_FILES['file']['name'][$id]))
        				{

        					$link=$Song['link'];
        				}
        			
        				else{
            			$link=$_FILES['file']['name'][$id];
            			$link_temp=$_FILES['file']['tmp_name'][$id];
            			move_uploaded_file($link_temp,"../Mp3/{$_FILES['file']['name'][$id]}");
            			}
        			}
        			else
        			{
        				if(empty($_FILES['file']['name'][$id]))
        				{

        					$img=$Song['img'];
        				}
        				else
        				{
        				$img=$_FILES['file']['name'][$id];
        				$img_temp=$_FILES['file']['tmp_name'][$id];
            			move_uploaded_file($img_temp,"../Mp3/img/{$_FILES['file']['name'][$id]}");
            			}
        			}
        		}
				$insert=$pdo->prepare('UPDATE songs SET song_title=?,song_artist=?,song_lyrics=?,song_movie=?, link=?, img=? WHERE song_id=? ');
				$insert->bindValue(1,$title);
				$insert->bindValue(2,$artist);
				$insert->bindValue(3,$lyrics);
				$insert->bindValue(4,$movie);
				$insert->bindValue(5,$link);
				$insert->bindValue(6,$img);
				$insert->bindValue(7,$songid);
				$insert->execute();
				echo 'successfully done!';
			}
	
?>
<!DOCTYPE HTML>
<html>
<head>
	<title>Edit Song</title><link rel="shortcut icon" href="../favicon.ico">
		<link rel="stylesheet" type="text/css" href="css/default.css" />
		<link rel="stylesheet" type="text/css" href="css/component.css" />
		
		<script src="js/modernizr.custom.js"></script>
	</head>
</head>
<body>
<div class="container">	
			<header class="clearfix">
				<h1> <span></span></h1>	
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
				<p><?php echo $error; ?></p>
			
	<form action="edit-page.php?songid=<?php echo $songid; ?>" method="post" enctype="multipart/form-data">
	<input type="text" name="title" value="<?php echo $Song['song_title']; ?>" placeholder="song title" size=110> <br>
	<input type="text" name="artist" value="<?php echo $Song['song_artist']; ?>" placeholder="Artist" size=110> <br>
	<input type="text" name="movie" value="<?php echo $Song['song_movie']; ?>" placeholder="Movie" size=110> <br>
	<input type="text" name="link" value="<?php echo $Song['link']; ?>" placeholder="Link" size=110><br>
	<label>Change Mp3 File<input type="file" name="file[]"> </label> <br>
	<input type="text" name="img" value="<?php echo $Song['img']; ?>" placeholder="Image Source" size=110><br>
	<label>Change Image<input type="file" name="file[]"></label><br>
	
	<textarea name="lyrics" cols="80" rows="40" placeholder="content"><?php echo $Song['song_lyrics']; ?> </textarea><br>
	<input type="submit" value="Save Changes"> <br> <br>

			</div>
		</div><!-- /container -->
		<script src="js/ytmenu.js"></script>


	

</body>


</html>
<?php

	}
	else
	{	
		header('location:index.php');
	}

	?>

