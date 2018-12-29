<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Registration</title>
<link rel="stylesheet" href="css/style.css" />
</head>
<body>
<?php
	require('db.php');
    // If form submitted, insert values into the database.
    if (isset($_REQUEST['loginID'])){
		$loginID = stripslashes($_REQUEST['loginID']); // removes backslashes
		$loginID = mysqli_real_escape_string($con,$loginID); //escapes special characters in a string
		$pwd = stripslashes($_REQUEST['pwd']);
		$pwd = mysqli_real_escape_string($con,$pwd);
		
		$sql = "select `loginID` from `user` where loginID='".$loginID."'";
		$result = $con -> query($sql);
		if(mysqli_num_rows($result)>0)
        {
            echo "<div class='form'><h3>You LoginID was exist.</h3><br/>Click here to <a href='registration.php'>Registration</a></div>";
        }else{
        $query = "INSERT into `user` (loginID, pwd) VALUES ('$loginID', '$pwd')";
        $result = mysqli_query($con,$query);
			if($result){
				echo "<div class='form'><h3>You are registered successfully.</h3><br/>Click here to <a href='login.php'>Login</a></div>";
			}
		}
    }else{
?>
<div class="form">
<h1>Registration</h1>
<form name="registration" action="" method="post">
<input type="text" name="loginID" placeholder="LoginID" required />
<input type="password" name="pwd" placeholder="Password" required />
<input type="submit" name="submit" value="Register" />
</form>
<br /><br />
</div>
<?php } ?>
</body>
</html>
