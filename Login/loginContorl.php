<?php
	require_once('db.php');
	require_once("loginModel.php");
	$rows = login();
	if($rows == 1){
		header("Location: index.php"); // Redirect user to index.php
	} else {
		echo "<div class='form'><h3>loginID/pwd is incorrect.</h3><br/>Click here to <a href='loginView.php'>Login</a></div>";
	}
?>