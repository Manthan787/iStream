<?php
	include_once 'scripts/connection.php';

	if(isset($_GET['id']))
	{
		$songid=$_GET['id'];
		$song=$pdo->prepare('SELECT * FROM songs WHERE song_id=?');
		$song->bindValue(1,$songid);
		$song->execute();
		$s=$song->fetch();
		

?>
<!DOCTYPE HTML>
<html>
<head>
<link rel="stylesheet" href="css/song.css">
<script>
	
</script>
</head>
<body>
	
		<center><div class="header"><?php echo $s['song_title']; ?></div></center>
		
		<div class="player">
		
		<audio id="player" controls autoplay>
		<source src="Mp3/<?php echo $s['link']; ?>" type="audio/mpeg">
		</audio>
		
		</div>
		
		<div class="imageartist">
		
		<div id="image">
		<img src="Mp3/img/<?php echo $s['img']; ?>">
		
		</div>
		
		<div id="artist">
		<center id="text1">Artist</center><br>
		<center id="text2"><?php echo $s['song_artist'];?></center><br>
		<center id="text3"><?php echo $s['song_movie'];?></center>
		
		</div>
		</div>
		<div class="Lyrics">
		<center><span id="parth">Lyrics </span></center><br>
		<div id="chokshi"><?php echo $s['song_lyrics'];?></div>
		</div>

</body>
</html>
<?php 
	}
?>