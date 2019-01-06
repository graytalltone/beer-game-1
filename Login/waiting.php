<<<<<<< HEAD
<?php
	require_once("db.php");
	global $db;
	$sql = "select * from team where tid = 1";
	$stmt = mysqli_prepare($db, $sql);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);
	$r=mysqli_fetch_assoc($result);
	$a = $r['status'];
	if($a == 1){
		header("Location: http://localhost/beer-game/Character/gameView.php");
	}
	echo "
		Waiting  Host to Start the Game!<br>
		<img src='loading.gif' alt='This is an animated gif image, but it does not move'/>
	";
?>
=======
<?php
require("dbconfig.php");
	echo "
		Waiting  Host to Start the Game!<br>
		<img src='loading.gif' alt='This is an animated gif image, but it does not move'/>
	";
?>
>>>>>>> 2a068487693b19acce45bb87d346c5e2a419bb61
