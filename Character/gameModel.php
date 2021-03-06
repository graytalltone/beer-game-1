<?php
require_once("db.php");
require_once("gameView.php");

function getCurrentUid(){
	return $_SESSION['uid'];
}

function getCurrentRole(){
	return $_SESSION['role'];
}

function getCurrentTeam(){ //拿到當前team
	return $_SESSION['tid'];
}
// getCurrentWeek拿到當前week
function getCurrentWeek(){ 
    
}
/* function countEnd(){
	global $db;
    $sql = "select $week from ord where uid=4 and tid = 1;";
    $stmt = mysqli_prepare($db, $sql);
    mysqli_stmt_bind_param($stmt, "i", $uid);
    mysqli_stmt_execute($stmt);
    $rs = mysqli_stmt_get_result($stmt);
    $r=mysqli_fetch_assoc($rs);
    return $r[$week];
} */



function getFromUser ($uid, $thing) {
	global $db;
    $sql = "select ($thing) from user where uid=?;";
    $stmt = mysqli_prepare($db, $sql);
    mysqli_stmt_bind_param($stmt, "i", $uid);
    mysqli_stmt_execute($stmt);
    $rs = mysqli_stmt_get_result($stmt);
    $r=mysqli_fetch_assoc($rs);
    return $r[$thing];
}

//get某人在某周的某欄位值(ord table)
function getFromOrd ($uid, $week, $thing) {
	global $db;    
    $sql = "select ($thing) from ord where uid=? AND week=?;";
    $stmt = mysqli_prepare($db, $sql);
    mysqli_stmt_bind_param($stmt, "ii", $uid, $week);
    mysqli_stmt_execute($stmt);
    $rs = mysqli_stmt_get_result($stmt);
    $r=mysqli_fetch_assoc($rs);
    return $r[$thing];
}

//修改某人在某周的某欄位值
function updateToOrd ($uid, $week, $thing, $rs) {
	global $db;	
    $sql = "update ord set $thing=? where uid=? AND week=?;";
    $stmt = mysqli_prepare($db, $sql);
    mysqli_stmt_bind_param($stmt, "iii", $rs, $uid, $week);
    mysqli_stmt_execute($stmt); //執行SQL
    //echo "message updated";
    
}


// getDownstreamID()拿到下游uid
function getDownstreamID($uid) {
	global $db;
    $rid = getFromUser($uid, "rid");
    if ($rid == 4) {    //零售商沒有下游了
        return false;
    }
    $tid = getFromUser($uid, "tid");
    $rid = $rid + 1;

    $sql = "select * from user where tid=? AND rid=?;";
    $stmt = mysqli_prepare($db, $sql);
    mysqli_stmt_bind_param($stmt, "ii", $tid, $rid);
    mysqli_stmt_execute($stmt);
<<<<<<< HEAD:Character/gameModel.php
    $id = mysqli_stmt_get_result($stmt);    //下游的uid
    $r=mysqli_fetch_assoc($id);
    return $r['uid'];
=======
    $downstream = mysqli_stmt_get_result($stmt);    //下游的uid
    return $downstream;
>>>>>>> 2a068487693b19acce45bb87d346c5e2a419bb61:Character/func.php
}
// getUpstreamID()拿到上游uid
function getUpstreamID($uid) {
	global $db;
    $rid = getFromUser($uid, "rid");
    if ($rid == 1) {    //生產者沒有上游了
        return false;
    }
    $tid = getFromUser($uid, "tid");
    $rid = $rid - 1;

    $sql = "select * from user where tid=? AND rid=?;";
    $stmt = mysqli_prepare($db, $sql);
    mysqli_stmt_bind_param($stmt, "ii", $tid, $rid);
    mysqli_stmt_execute($stmt);
<<<<<<< HEAD:Character/gameModel.php
    $id = mysqli_stmt_get_result($stmt);    //上游的uid
    $r=mysqli_fetch_assoc($id);
    return $r['uid'];
=======
    $upstream = mysqli_stmt_get_result($stmt);    //上游的uid
    return $upstream;
>>>>>>> 2a068487693b19acce45bb87d346c5e2a419bb61:Character/func.php
}

// countPurc計算Purc
function countPurc ($uid, $week) {
    if ($week <= 2) {    //延遲兩週
        $purc = 0;    //上游沒出貨
    } else {
        $Ago = $week - 2;    //上上週
        $rid =  getFromUser($uid, "rid");
        if ($rid == 1) {    //生產者沒有上游了
            $purc = getFromOrd ($uid, $Ago, "ord");    //自己上上週的訂貨量
        } else {
            $upstream = getUpstreamID($uid);    //上游uid
            $purc = getFromOrd ($upstream, $Ago, "sales");//上游上上週的銷售量
        }
    }
    updateToOrd ($uid, $week, "purc", $purc);
}

// countNeed計算need
function countNeed ($uid, $week) {
	global $db;
    $rid =  getFromUser($uid, "rid");
    if ($rid == 4) {    //零售商沒有下游了
        $sql = "select * from consumer where week=?;";
        $stmt = mysqli_prepare($db, $sql);
        mysqli_stmt_bind_param($stmt, "i", $week);
        mysqli_stmt_execute($stmt);
        $rs = mysqli_stmt_get_result($stmt);    
        $r=mysqli_fetch_assoc($rs);    
        $ord = $r['quanitity'];    //消費者本週的訂購量
    } else {
        $downstream = getDownstreamID($uid);    //下游的uid
        $ord = getFromOrd ($downstream, $week, "ord");    //下游本週的訂購量
    }
    
    if ($week == 1) {    //第一周的需求＝訂購量
        $need = $ord;
    } else {
        $Ago = $week - 1;    //上週
        $Lstock = getFromOrd ($uid, $Ago, "stock");    //自己上周的庫存量    
    
        if ($Lstock < 0) {    //若有欠
            $need = (-$Lstock) + $ord;
        } else {
            $need = $ord;
        }
    }
    updateToOrd ($uid, $week, "need", $need);
}

// countsales計算sales
function countsales ($uid, $week) {
    if ($week == 1) {
        $Lstock = 15;    //第一周庫存量
    } else {
        $Ago = $week - 1;    //上週
        $Lstock = getFromOrd ($uid, $Ago, "stock");    //自己上周的庫存量
    }
    $purc = getFromOrd ($uid, $week, "purc");    //自己本週的進貨量
    $need = getFromOrd ($uid, $week, "need");    //自己本週的需求量
    
    $hand = $Lstock + $purc;    //手上擁有的量

    if($hand >= $need) {    //夠給
        $sales = $need;
    } else if ($hand > 0) {    //不夠給,先把手上的先賣出去
        $sales= $hand;    //
    } else {    //不夠給,手上也沒有東西可賣（銷售量不可能為負）
        $sales = 0;
    } 
    updateToOrd ($uid, $week, "sales", $sales);
}

// countstock計算stock
function countstock ($uid, $week) {
    if ($week == 1) {
        $Lstock = 15;    //初始庫存
    } else {
        $Ago = $week - 1;    //上週
        $Lstock = getFromOrd ($uid, $Ago, "stock");    //自己上週的庫存量
    }
    $purc = getFromOrd ($uid, $week, "purc");    //自己本週的進貨量
    $need = getFromOrd ($uid, $week, "need");    //自己本週的需求量

    $stock = $Lstock + $purc - $need;
    updateToOrd ($uid, $week, "stock", $stock);
}
	
function checkOrder($order){
	if($order < 0){
		return false;
	}
	else{
		return true;
	}
}


function updateOrder($order,$uid,$week){
	global $db;
	$sql = "update ord set ord = ? where uid = ? and week = ?";
	$stmt = mysqli_prepare($db, $sql);
	mysqli_stmt_bind_param($stmt, "iii",$order,$uid,$week);
	mysqli_stmt_execute($stmt); 
	return;
}

function addOrder($uid,$week){
    global $db;
    $sql = "insert into ord(uid,week) values(?,?)";
    $stmt = mysqli_prepare($db, $sql);
    mysqli_stmt_bind_param($stmt, "ii",$uid,$week);
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

// function countOrdCost ($uid, $week) {    //此訂單的成本
//     $stock = getFromOrd ($uid, $week, "stock");    //自己本周的庫存量
//     echo $stock;
//     if ($stock < 0) {    //欠貨成本２
//         $cost = $stock * 2;
//     } else {　　　　//庫存成本１
//         $cost = $stock * 1;
//     }

//     updateToOrd ($uid, $week, "cost", $cost);
// }

// ///////////////////////////////////////////////////////////////////////////////////////////////

// function countUserCost ($uid, $week) {    //個人累積成本
//     if ($week == 1) {
//         $Lcost = 0;
//     } else {
//         $Lcost = getFromUser($uid, "Ucost");    //此人之前的累積cost
//     }
//     $cost = getFromOrd ($uid, $week, "cost");    //這周cost
    
//     $Ucost = $Lcost + $cost;    //此人到目前為止的累積cost
//     updateToUser ($uid, "Ucost", $Ucost);
// }

// ////////////////////////////////////////////////////////////////////////////////////////////////

// function countTeamCost ($tid) {    //團隊累積成本
//     global $db;
// 	$sql = "select Ucost from user where tid=?;";
//     $stmt = mysqli_prepare($db, $sql);
//     mysqli_stmt_bind_param($stmt, "i", $tid);
// 	mysqli_stmt_execute($stmt);
// 	$result = mysqli_stmt_get_result($stmt);
    
//     $Tcost = 0;
//     while ($rs = mysqli_fetch_assoc($result)) {
// 	    $Tcost = $Tcost + $rs['Ucost'];
//     }

//     updateToTeam ($tid, "Tcost", $Tcost);
// }

?>