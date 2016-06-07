<?php

session_start();
try{
	$pdo=new PDO('mysql:host=127.0.0.1;dbname=music','root','');

} catch(PDOException $e)
{
	die('Database Error.');
}


?>