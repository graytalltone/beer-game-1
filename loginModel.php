<?php
	require_once('db.php');
	require_once("loginView.php");
	function login(){
		if (isset($_POST['loginID'])){
			global $db;		
			$loginID = stripslashes($_REQUEST['loginID']); // removes backslashes
			$loginID = mysqli_real_escape_string($db, $loginID); //escapes special characters in a string
			$pwd = stripslashes($_REQUEST['pwd']);
			$pwd = mysqli_real_escape_string($db, $pwd);		
			$sql = "select * from user where loginID='$loginID' and pwd='$pwd'";
			$stmt = mysqli_prepare($db, $sql);
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt); 
			$r=mysqli_fetch_assoc($result);
			$_SESSION['uid'] = $r['uid'];
			$_SESSION['loginID'] = $loginID;
			$query = "SELECT * FROM `user` WHERE loginID='$loginID' and pwd='$pwd'";
			$result = mysqli_query($db,$query) or die(mysql_error());
			$rows = mysqli_num_rows($result);
			return $rows;
		}
	}
?>