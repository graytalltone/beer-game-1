<?php
	require_once('db.php');
	require_once("registrationModel.php");
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Registration</title>
<link rel="stylesheet" href="css/style.css" />
</head>
<body>
<div class="form">
<h1>Registration</h1>
<form name="registration" action="registrationContorl.php" method="post">
<input type="text" name="loginID" placeholder="LoginID" required />
<input type="password" name="pwd" placeholder="Password" required />
<input type="submit" name="submit" value="Register" />
</form>
<<<<<<< HEAD
<br/><br/>
=======
<br /><br />
>>>>>>> 2a068487693b19acce45bb87d346c5e2a419bb61
</div>
</body>
</html>
