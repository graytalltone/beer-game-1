<?php
require_once("db.php");
require_once("Factory.php");

function updateOrder($order,$oid){
	global $db;
	$sql = "update ord set ord = ? where oid = ? ";
	$stmt = mysqli_prepare($db, $sql);
	mysqli_stmt_bind_param($stmt, "ii",$order,$oid);
	mysqli_stmt_execute($stmt); 
	return;
}

function addOrder(){
    global $db;
    $sql = "insert into ord(uid) values(3)";
    $stmt = mysqli_prepare($db, $sql);
    mysqli_stmt_execute($stmt); 
    return;
}
 
function orderlist(){
	global $db;
	$sql = "select * from ord";
	$stmt = mysqli_prepare($db, $sql);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);
	return $result;
}
?>