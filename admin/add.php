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
	
	$error="";
	if(isset($_POST['title']))
	{
		$title=$_POST['title'];
		$artist=$_POST['artist'];
		$movie=$_POST['movie'];
		$lyrics=$_POST['lyrics'];
		
        for($id=0;$id<count($_FILES['file']['name']);$id++)
        {
            
        
        if($id==0)
        {
            $link=$_FILES['file']['name'][$id];
            $link_temp=$_FILES['file']['tmp_name'][$id];
            move_uploaded_file($link_temp,"../Mp3/{$_FILES['file']['name'][$id]}");

        }
        else
        {
        	$img=$_FILES['file']['name'][$id];
        	$img_temp=$_FILES['file']['tmp_name'][$id];
            move_uploaded_file($img_temp,"../Mp3/img/{$_FILES['file']['name'][$id]}");
        }
        }

		
		if((!$title)||(!$link))
		{
			$error="Title and Link are mandatory fields.";
		}
		else
		{
			
			$lyrics=nl2br($lyrics);
			$insert=$pdo->prepare('INSERT INTO songs(song_title,song_artist,song_lyrics,song_movie,link,img) VALUES (?,?,?,?,?,?)');
			$insert->bindValue(1,$title);
			$insert->bindValue(2,$artist);
			$insert->bindValue(3,$lyrics);
			$insert->bindValue(4,$movie);
			$insert->bindValue(5,$link);
			$insert->bindValue(6,$img);
			$insert->execute();
			
			$error="Success!";

		} 
	}
?>
<html>
<head>
	<title>Add Song Details</title>
</head>
<body>
<head>	
	<title>Admin-Panel</title>
	<link rel="shortcut icon" href="../favicon.ico">
		<link rel="stylesheet" type="text/css" href="css/default.css" />
		<link rel="stylesheet" type="text/css" href="css/component.css" />
		<link rel="stylesheet" type="text/css" href="css/style.css"/>
		<script src="js/modernizr.custom.js"></script>
	</head>
</head>
<body>
<div class="container">	
			<header class="clearfix">
				<h1>Add Songs <span></span></h1>	
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
	<form action="add.php" method="post" enctype="multipart/form-data">
	<input type="text" name="title" placeholder="Song Title" size=110><br>
	<input type="text" name="artist" placeholder="Artist" size="110"><br>
	<input type="text" name="movie" placeholder="Movie" size="110"><br>
	<label>Upload Song
	<input type="file" name="file[]" id="file" placeholder="link"><br> </label>
	<label> Upload Image
	<input type="file" name="file[]" id="file" placeholder="Image Source"><br> </label>
	<textarea name="lyrics" rows="40" cols="80" placeholder="lyrics"></textarea><br>
	<input type="submit" name="submit" value="Add">
	
			</div>
		</div><!-- /container -->
		<script src="js/ytmenu.js"></script>


	
	

</body>
	
</html>