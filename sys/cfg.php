<?php
@session_start();

if(!$_SESSION['uid'] && !$_SESSION['gm']) {
	if(!file_exists('config.php')) {
		echo '<script>location.replace("./install");</script>';
	} else {
		echo '<script>location.replace("sys/login.php");</script>';
	}
}

//$_SESSION['uid']="6";
//$_SESSION['gm']="4";

@include('../config.php');


?>