<<<<<<< HEAD
<?php
require_once('db.php');
//require_once("loginView.php");
function NewTeam(){
	global $db;
    //echo '<input type="submit" value="CTeam" name="new" id="new"/>';
    if (isset($_POST['act'])) {
        $sql = "insert into team (rank, Tcost) values (0, 0)";
        $stmt = mysqli_prepare($db, $sql);
        mysqli_stmt_execute($stmt);
		header("Location: teamView.php");
    }
}

function checkTeam() {
	global $db;
	$sql = "select * FROM team";
	$stmt = mysqli_prepare($db, $sql);
	mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $r = mysqli_num_rows($result);
    return $r;
}

function selectRole($tid, $rid) {
	echo $rid, $tid;
	echo $_SESSION['loginID'];
	global $db;
	//$tid=$_REQUEST['team'];
    $sql = "UPDATE `user` SET `rid`=?, `tid`=? where loginID=?";
	$stmt = mysqli_prepare($db, $sql); //prepare sql statement
	mysqli_stmt_bind_param($stmt, "iis", $rid, $tid, $_SESSION['loginID']); //bind parameters with variables
	mysqli_stmt_execute($stmt); 
	header("Location: waiting.php");
}
function logOut() {
	session_destroy();
}

function getUid() {
	global $db;
	$sql = "select * from user where loginID=?";
	$stmt = mysqli_prepare($db, $sql);
	mysqli_stmt_bind_param($stmt, "s", $_SESSION['loginID']);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);
	$rs = mysqli_fetch_assoc($result);
	$_SESSION['uid'] = $rs['uid'];
}
=======
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
>>>>>>> 2a068487693b19acce45bb87d346c5e2a419bb61
?>