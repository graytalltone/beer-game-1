<?php
    if(isset($_POST['btn_1'])){
        $sql = "update user set rid=1, tid=? where loginID=?";
        $stmt = mysqli_prepare($db, $sql); //prepare sql statement
        mysqli_stmt_bind_param($stmt, 'is', $rs['tid'], $_SESSION['loginID']); //bind parameters with variables
        mysqli_stmt_execute($stmt);
        echo '<br><br>Player '.$_SESSION['loginID'].' as Team'.$rs['tid'].' Factory';
    }
    if(isset($_POST['btn_2'])){
        $sql = "update user set rid=2, tid=? where loginID=?";
        $stmt = mysqli_prepare($db, $sql); //prepare sql statement
        mysqli_stmt_bind_param($stmt, 'is', $rs['tid'], $_SESSION['loginID']); //bind parameters with variables
        mysqli_stmt_execute($stmt);
        echo '<br><br>Player '.$_SESSION['loginID'].' as Team'.$rs['tid'].' Distributor';
    }
    if(isset($_POST['btn_3'])){
        $sql = "update user set rid=3, tid=? where loginID=?";
        $stmt = mysqli_prepare($db, $sql); //prepare sql statement
        mysqli_stmt_bind_param($stmt, 'is', $rs['tid'], $_SESSION['loginID']); //bind parameters with variables
        mysqli_stmt_execute($stmt);
        echo '<br><br>Player '.$_SESSION['loginID'].' as Team'.$rs['tid'].' Wholesaler';
    }
    if(isset($_POST['btn_4'])){
        $sql = "update user set rid=4, tid=? where loginID=? ";
        $stmt = mysqli_prepare($db, $sql); //prepare sql statement
        mysqli_stmt_bind_param($stmt, 'is', $rs['tid'], $_SESSION['loginID']); //bind parameters with variables
        mysqli_stmt_execute($stmt);
        echo '<br><br>Player '.$_SESSION['loginID'].' as Team'.$rs['tid'].' Retailer';
    } 
?>