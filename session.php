<?php

	session_start();
	if(!isset($_SESSION['username'])) {
		header("Location: phonebookMainPage.php");
		exit;
	} else {
		if($_SESSION['timeout'] + 6000 < time()) {
			header("Location: logout.php");
		} else {
			$_SESSION['timeout'] = time();
		}
	}

?>