<?php
	session_start();
	if(isset($_SESSION['roll'])){
		session_destroy();
	}
	header("location: home.php");
?>