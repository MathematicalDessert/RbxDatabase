<?php
	session_start();
	if ($_SESSION['loggedin'] == "1") {
		unset($_SESSION);
		session_destroy();
		header("Location: landing.php?msg=Logged+out.");
	} else { 
		header("Location: landing.php?err=1&msg=You+are+already+logged+out.");
	}
?>