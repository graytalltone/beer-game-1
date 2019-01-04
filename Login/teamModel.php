<?php
require_once("dbconfig.php");
function allTeam($teamName){
	$sql = "select * from `teamstatus`";
	$result = getDb($sql);
	$teamName = array();
	while($rs = mysqli_fetch_assoc($result)){
		array_push($teamName, $rs['teamName']);
	}
	return array($teamName);
}
function createTeam($teamName,$userId){
	$checkIfAvailable = "select * from team where teamName='$teamName'";
	$result = getDb($checkIfAvailable);
	$rows = mysqli_num_rows($result);
	if($rows>0){
		echo "You  cannot create team anymore";
	}else{
		$sql = "insert into `team` (teamName,teamOwner)VALUES('$teamName','$userId')";
		$sql2 = "insert into `teamstatus` (loginID,teamName,prio)VALUES('$userId','$teamName',1)";
		getDb($sql);
		getDb($sql2);
		echo "Team  created success! Team ".$teamName;
	}
}
function pickRole($userId, $role){
	$sql = "update `teamstatus` set `role`='$role' where loginID='$userId'";
	getDb($sql);
}
function joinTeam($userId,$teamName){
	$sql = "insert into `teamstatus` (loginID,teamName,prio)VALUES('$userId','$teamName','1')";
	getDb($sql);
}
function myUser($teamName){
	$sql = "select * from `teamstatus` where teamName='$teamName' and prio=0";
	$result = getDb($sql);
	$myStat = array();
	$myRole = array();
	while ($rs = mysqli_fetch_assoc($result)){
		array_push($myStat, $rs['userId']);
		array_push($myRole, $rs['role']);
	}
	return array($myStat, $myRole);
}
function myTeam($userId){
	$sql = "select * from teamstatus where loginID='$userId'";
	$result = getDb($sql);
	$teamName = array();
	while ($rs = mysqli_fetch_assoc($result)){
		array_push($teamName, $rs["teamName"]);
	}
	return array($teamName);
}
function getDb($sql){
	$db = mysqli_connect("localhost", "root", "", "beer game");
	mysqli_set_charset($db, "utf8");
	$result = mysqli_query($db, $sql);
	return $result;
}
?>