<?php
require_once("gameModel.php");
$order = (int)$_POST["ord"];
<<<<<<< HEAD
//$uid = getCurrentUid();
//$rid = getCurrentRole();
//$team = getCurrentTeam();
$week = '3';
$uid = '4';
//echo $uid;
if(checkOrder($order)){
    addOrder($uid,$week);
    updateOrder($order,$uid,$week);
=======
$uid = getCurrentUid();
$rid = getCurrentRole();
$team = getCurrentTeam();
$week = getCurrentWeek();
if(checkOrder($order)){
	updateOrder($order,$oid);
>>>>>>> 2a068487693b19acce45bb87d346c5e2a419bb61
    countPurc($uid, $week);
    countNeed($uid, $week);
    countsales($uid, $week);
    countstock($uid, $week);
<<<<<<< HEAD
    header("Location: http://localhost/beer-game/%E7%B8%BD%E7%B5%90/gameover.php");
	//header("Location: gameView.php");
=======

	addOrder();
	header("Location: gameView.php");
>>>>>>> 2a068487693b19acce45bb87d346c5e2a419bb61
}
else{
	header("Location: gameView.php");
}
?>