<?php
require_once("gameModel.php");
$order = (int)$_POST["ord"];
$uid = getCurrentUid();
$rid = getCurrentRole();
$team = getCurrentTeam();
$week = getCurrentWeek();
if(checkOrder($order)){
	updateOrder($order,$oid);
    countPurc($uid, $week);
    countNeed($uid, $week);
    countsales($uid, $week);
    countstock($uid, $week);

	addOrder();
	header("Location: gameView.php");
}
else{
	header("Location: gameView.php");
}
?>