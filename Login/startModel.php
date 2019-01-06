<?php
require_once('db.php');
function teamlist(){
    global $db;
	$sql = "select loginID,tid,rid from user where pms = 0 and tid != 0 ORDER by tid,rid";
	$stmt = mysqli_prepare($db, $sql);
	mysqli_stmt_execute($stmt);
    //mysqli_stmt_bind_param($stmt, "i", $tid);
	$result = mysqli_stmt_get_result($stmt);
	return $result;
}

function start() { //將隊伍的status為4的轉乘0
    global $db;
	$sql = "update team set status = 1 where tid = 1";
	$stmt = mysqli_prepare($db, $sql);
	mysqli_stmt_execute($stmt);
	return ;
}
?>