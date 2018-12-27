<?php 
include("auth.php"); //include auth.php file on all secure pages 
require("db.php");
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Welcome Home</title>
<link rel="stylesheet" href="css/style.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
</head>
<body>
<p>Welcome <?php echo $_SESSION['loginID']; ?></p>
<form id="beerGame" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
<?php 
    //點了new team後資料庫team會增加一筆
    echo '<input type="submit" value="New Team" name="new" id="new"/>';
    if (isset($_POST['new'])) {
        $sql = "insert into team (accost, rank, cost) values (0, 0 ,0)";
        $stmt = mysqli_prepare($con, $sql);
        mysqli_stmt_execute($stmt);
    }
    //從資料庫顯示目前隊伍數量
    $sql = "select * from team;";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    while ( $rs = mysqli_fetch_assoc($result)){
        echo "<br>Team".$rs['tid'].get_buttons();
    }
    function get_buttons(){
        $str='';
        $btns = array(
                    1=>'Factory',
                    2=>'Distributor',
                    3=>'Wholesaler',
                    4=>'Retailer',);
        while(list($k,$v)=each($btns)){
            $str.='&nbsp;<input type="submit" value="'.$v.'" name="btn_'.$k.'" id="btn_'.$k.'"/>';
        }
        echo "<br>";
        return $str;
    }
    // 選擇角色然後更新資料庫user裡的rid, tid
    if(isset($_POST['btn_1'])){
        $sql = "update user set rid=1 where loginID=?";
        $stmt = mysqli_prepare($con, $sql); //prepare sql statement
        mysqli_stmt_bind_param($stmt, 's' ,$_SESSION['loginID']); //bind parameters with variables
        mysqli_stmt_execute($stmt);
        echo "<br><br>Player A choosed!";
    }
    if(isset($_POST['btn_2'])){
        $sql = "update user set rid=2 where loginID=?";
        $stmt = mysqli_prepare($con, $sql); //prepare sql statement
        mysqli_stmt_bind_param($stmt, 's', $_SESSION['loginID']); //bind parameters with variables
        mysqli_stmt_execute($stmt);
        echo "<br><br>Player B choosed!";
    }
    if(isset($_POST['btn_3'])){
        $sql = "update user set rid=3 where loginID=?";
        $stmt = mysqli_prepare($con, $sql); //prepare sql statement
        mysqli_stmt_bind_param($stmt, 's', $_SESSION['loginID']); //bind parameters with variables
        mysqli_stmt_execute($stmt);
        echo "<br><br>Player C choosed!";
    }
    if(isset($_POST['btn_4'])){
        $sql = "update user set rid=4 where loginID=? ";
        $stmt = mysqli_prepare($con, $sql); //prepare sql statement
        mysqli_stmt_bind_param($stmt, 's', $_SESSION['loginID']); //bind parameters with variables
        mysqli_stmt_execute($stmt);
        echo "<br><br>Player D choosed!";
    }
?>
<br><br>
</form>
<a href="logout.php">Logout</a>
</body>
</html>
