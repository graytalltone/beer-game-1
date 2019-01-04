<?php
	require_once('db.php');
	require_once("loginModel.php");
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Login</title>
<link rel="stylesheet" href="css/style.css" />
</head>
<body>

<div class="form">
<h1>Log In</h1>
<form action="loginContorl.php" method="post" name="login">
<input type="text" name="loginID" placeholder="LoginID" required />
<input type="pwd" name="pwd" placeholder="Password" required /><br>
<input name="submit" type="submit" value="Login" />
</form>
<p>Not registered yet? <a href='registration.php'>Register Here</a></p>


</body>
</html>