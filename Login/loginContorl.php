<<<<<<< HEAD
<?php
	require_once("loginModel.php");
	$loginID = $_POST['loginID'];
	$rows = login();
	$result = pms($loginID);
	while ($rs = mysqli_fetch_assoc($result))
	$pms = $rs['pms'];
	if($rows == 1){
		if ($pms == 0)
			header("Location: teamView.php"); // Redirect user to index.php
		else
			header("Location: startView.php");
	}else{
		echo "<div class='form'><h3>loginID/pwd is incorrect.</h3><br/>Click here to <a href='loginView.php'>Login</a></div>";
	}	
=======
<?php
	require_once('db.php');
	require_once("loginModel.php");
	$rows = login();
	if($rows == 1){
		header("Location: index.php"); // Redirect user to index.php
	} else {
		echo "<div class='form'><h3>loginID/pwd is incorrect.</h3><br/>Click here to <a href='loginView.php'>Login</a></div>";
	}
>>>>>>> 2a068487693b19acce45bb87d346c5e2a419bb61
?>