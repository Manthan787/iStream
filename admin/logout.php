<?php
	include_once '../scripts/connection.php';
	session_destroy();
	header('location:index.php');
?>