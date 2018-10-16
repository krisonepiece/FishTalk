<?php
	if($_SESSION['rid'] != 1)
		header("location: admin_login.php");
?>