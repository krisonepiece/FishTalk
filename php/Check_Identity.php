<?php
	session_start();
	if(!isset($_SESSION['account']) || empty($_SESSION['account']))
		header("location: login.php");
?>