<<<<<<< HEAD
<?php
	require_once("registrationModel.php");
	$loginID = registration();
	$pwd = registration();
	$r = registration();
	if($r > 0) {
		echo "<div class='form'><h3>You LoginID was exist.</h3><br/>Click here to <a href='registrationView.php'>Registration</a></div>";
	} else {
		success();
		header("Location: loginView.php");	
	}
=======
<?php
	require_once("registrationModel.php");
	$loginID = registration();
	$pwd = registration();
	$r = registration();
	if($r > 0) {
		echo "<div class='form'><h3>You LoginID was exist.</h3><br/>Click here to <a href='registrationView.php'>Registration</a></div>";
	} else {
		success();
		echo "<div class='form'><h3>You are registered successfully.</h3><br/>Click here to <a href='loginView.php'>Login</a></div>";	
	}
>>>>>>> 2a068487693b19acce45bb87d346c5e2a419bb61
?>