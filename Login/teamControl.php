<?php
require("dbconfig.php");
require("teamModel.php");
$action = $_REQUEST['act'];
switch ($action) {
	case 'createTeam':
		$userId = stripslashes($_REQUEST['userId']); 
		$userId = mysqli_real_escape_string($db, $userId);
		$teamName = stripslashes($_REQUEST['teamName']); 
		$teamName = mysqli_real_escape_string($db, $teamName);
		createTeam($teamName, $userId);
		header("refresh:5; url=index.php");
		break;

	case 'joinTeam':
		$userId= stripslashes($_REQUEST['userId']);
		$userId = mysqli_real_escape_string($db, $userId);
		$teamName = stripslashes($_REQUEST['teamName']); 
		$teamName = mysqli_real_escape_string($db, $teamName);
		joinTeam($userId, $teamName);
		header("refresh:5; url=index.php");
		break; 

	case 'pickRole':
		$userId = stripslashes($_REQUEST['userId']); 
		$userId = mysqli_real_escape_string($db,$userId);
		$role = stripslashes($_REQUEST['role']); 
		$role = mysqli_real_escape_string($db,$role);
		pickRole($userId, $role);
		header("Location: waiting.php");
		break;

	case 'myTeam':
		myTeam($_REQUEST['userId']);
		break;

	default:
	break;
}
?>