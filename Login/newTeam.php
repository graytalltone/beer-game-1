<?php 
    //點了new team後資料庫team會增加一筆
    echo '<input type="submit" value="New Team" name="new" id="new"/>';
    if (isset($_POST['new'])) {
        $sql = "insert into team (rank, Tcost) values (0, 0)";
        $stmt = mysqli_prepare($db, $sql);
        mysqli_stmt_execute($stmt);
    }
?>