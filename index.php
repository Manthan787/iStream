<?php
	
	include_once('scripts/connection.php');
	if(isset($_SESSION['username']))
	{
		$name=$_SESSION['username'];
		$query=$pdo->prepare('SELECT * FROM songs');
		$query->execute();

?>
<!DOCTYPE HTML>
<html>
<head>
	<!--<link rel="stylesheet" href="css/style.css"> -->
	<link rel="shortcut icon" href="../favicon.ico"> 
		<link rel="stylesheet" type="text/css" href="css/default.css" />
		<link rel="stylesheet" type="text/css" href="css/component.css" />
		<script src="js/modernizr.custom.js"></script>
</head>
<body>

	<h1><?php echo 'hello '.$name;?></h1>
	<a href="logout.php">Logout</a>
			
<div class="container">
<header class="clearfix">
				<h1>Music Streaming Site <span>By Manthan & Parth</span></h1>	
			</header>

	<div class="main">
				<ul id="og-grid" class="og-grid">
					<?php while($r=$query->fetch()) { ?>
        	
                <li>                                      
                <a href="song.php?id=<?php echo $r['song_id']; ?>" data-title="<?php echo $r['song_title']; ?>" data- description="<?php echo $r['song_artist']; ?>"><img src="Mp3/img/<?php echo $r['img'];?>"></a>                   
               
				 </li>
             
            <?php } ?>
            	</ul>
   	</div>
   </div>

         
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
		<script src="js/grid.js"></script>
		<script>
			$(function() {
				Grid.init();
			});
		</script>

</body>


</html>
<?php 
	}
	else
	{	
		header('location:login.php');
	}

?>

