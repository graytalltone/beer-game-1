<?php
require_once("db.php");
//計算總COST
function TeamTotalCost() {
    global $db;
        $sql = "Select count(user.Ucost) from team,user 
        where team.tid = user.tid group by team.tid";
        $stmt = mysqli_prepare($db, $sql);
        mysqli_stmt_execute($stmt); //執行SQL
        $result = mysqli_stmt_get_result($stmt); 
        $r=mysqli_fetch_assoc($result);
        return;
}
//計算排名
function TeamRank() {
    global $db;
        $sql = "Select team.tid,count(user.Ucost) uc 
        from team,user where team.tid = user.tid 
        group by team.tid order by uc";
        $stmt = mysqli_prepare($db, $sql);
        //mysqli_stmt_bind_param($stmt, "ss", $id, $pwd);
        mysqli_stmt_execute($stmt); //執行SQL
        $result = mysqli_stmt_get_result($stmt); 
        $r=mysqli_fetch_assoc($result);
        return;
}
?>
