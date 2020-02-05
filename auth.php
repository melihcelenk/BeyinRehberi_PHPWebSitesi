<?php
	if(!isset($_SESSION)) session_start();
	if(!isset($_SESSION["userid"])){
		header("Location: girisyap.php");
		exit();
	}
?>