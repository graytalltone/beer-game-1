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
		header("Location: teamView1.php");
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

function selectRole($rid, $tid) {
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
?>