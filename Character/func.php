<?php
require_once("db.php");

function getCurrentUiD(){
	return $_SESSION['uid'];
}

function getCurrentRole(){
	return $_SESSION['role'];
}

function getCurrentTeam(){ //拿到當前team
	return $_SESSION['tid'];
}

// getCurrentWeek拿到當前week
function getCurrentWeek($lid){ 
    
}

function updateOrd($lid, $order){
    $uid = getCurrentUiD($lid);
    global $db;
    $sql = "update ord set ord=? WHERE uid=?;";
    $stmt = mysqli_prepare($db, $sql);
    mysqli_stmt_bind_param($stmt, "ii", $order, $uid);
    mysqli_stmt_execute($stmt);
}

// get某人的某欄位的資訊(user table)
function getFromUser ($uid, $thing) {
	global $db;
    $sql = "select '$thing' from user where uid=?;";
    $stmt = mysqli_prepare($db, $sql);
    mysqli_stmt_bind_param($stmt, "i", $uid);
    mysqli_stmt_execute($stmt);
    $rs = mysqli_stmt_get_result($stmt);
    return $rs;
}
//get某人在某周的某欄位值(ord table)
function getFromOrd ($uid, $week, $thing) {
	global $db;    
    $sql = "select '$thing' from ord where uid=? AND week=?;";
    $stmt = mysqli_prepare($db, $sql);
    mysqli_stmt_bind_param($stmt, "ii", $uid, $week);
    mysqli_stmt_execute($stmt);
    $rs = mysqli_stmt_get_result($stmt);
    return $rs;
}

//修改某人在某周的某欄位值
function updateToOrd ($uid, $week, $thing, $rs) {
	global $db;	
    $sql = "update ord set '$thing'=? where uid=? AND week=?;";
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

    $sql = "select uid from user where tid=? AND rid=?;";
    $stmt = mysqli_prepare($db, $sql);
    mysqli_stmt_bind_param($stmt, "ii", $tid, $rid);
    mysqli_stmt_execute($stmt);
    $id = mysqli_stmt_get_result($stmt);    //下游的uid
    return $downstream;
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

    $sql = "select uid from user where tid=? AND rid=?;";
    $stmt = mysqli_prepare($db, $sql);
    mysqli_stmt_bind_param($stmt, "ii", $tid, $rid);
    mysqli_stmt_execute($stmt);
    $id = mysqli_stmt_get_result($stmt);    //上游的uid
    return $upstream;
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
            $purc = getFromOrd ($upstream, $Ago, "sales");    //上游上上週的銷售量
        }
    }
    updateToOrd ($uid, $week, "purc", $purc);
}

// countNeed計算need
function countNeed ($uid, $week) {
	global $db;
    $rid =  getFromUser($uid, "rid");
    if ($rid == 4) {    //零售商沒有下游了
        $sql = "select quantity from consumer where week=?;";
        $stmt = mysqli_prepare($db, $sql);
        mysqli_stmt_bind_param($stmt, "i", $week);
        mysqli_stmt_execute($stmt);
        $ord = mysqli_stmt_get_result($stmt);    //消費者本週的訂購量
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

// countAccost計算累積成本
// countCost計算本期成本
?>