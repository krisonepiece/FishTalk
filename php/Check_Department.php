<?php
	//session_start();
	if($_SESSION['identity'] != '1')
		header("location: index.php");
?>