<?php
require_once("db.php");
//checkLogin();
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Welcome Home</title>
<link rel="stylesheet" href="css/style.css" />
</head>
<body>
<p>Welcome <?php echo $_SESSION['loginID']; ?></p>
<form id="beerGame" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
<?php
    $i=1;
    include("newTeam.php");
    include("selRole.php");
    //從資料庫顯示目前隊伍數量
    $sql = "select * from team;";
    $stmt = mysqli_prepare($db, $sql);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    while ($rs = mysqli_fetch_assoc($result)){
        echo "<br>Team".$rs['tid'].selectRole();
        if ($rs['tid'] == $i){
            include("selRole2.php");
            $i++;
        }
    }
?>
<br><br>
</form>
<a href="logout.php">Logout</a>
</body>
</html>
