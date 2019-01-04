<?php
	require_once('db.php');
	require_once("registrationView.php");
	function registration(){
		global $db;
		if (isset($_REQUEST['loginID'])){
			$loginID = stripslashes($_REQUEST['loginID']); // removes backslashes
			$loginID = mysqli_real_escape_string($db,$loginID); //escapes special characters in a string
			$pwd = stripslashes($_REQUEST['pwd']);
			$pwd = mysqli_real_escape_string($db,$pwd);
			
			$sql = "select `loginID` from `user` where loginID='".$loginID."'";
			$result = $db -> query($sql);
			$r = mysqli_num_rows($result);
			return $r;
		}
	}
	function success(){
		if (isset($_REQUEST['loginID'])){
			global $db;
			$loginID = stripslashes($_REQUEST['loginID']);
			$loginID = mysqli_real_escape_string($db,$loginID); //escapes special characters in a string
			$pwd = stripslashes($_REQUEST['pwd']);
			$pwd = mysqli_real_escape_string($db,$pwd);
			
			$sql = "select `loginID` from `user` where loginID='".$loginID."'";
			$result = $db -> query($sql);
			$query = "INSERT into `user` (loginID, pwd) VALUES ('$loginID', '$pwd')";
			$result = mysqli_query($db,$query);
			return $result;
		}
	}
?>