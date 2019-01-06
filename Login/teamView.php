<<<<<<< HEAD
<?php
	require("db.php");
	//require ("loginModel.php");
	require_once("teamModel.php");
?>
<html>
<head>
<meta charset="utf-8">
<title>Team</title>
<link rel="stylesheet" href="css/style.css" />
</head>
<body>
<?php
if (!isset($_SESSION['loginID'])) {
    
} else {
	echo 'welcome '.$_SESSION['loginID'].'<br>';
    echo "
        <form action='teamControl.php' method='post'>
            <input type='submit' name='act' value='logout'/>
        </form>
    ";
}
echo "
    <form action='teamControl.php' method='post'>
        <input type='submit' value='NewTeam' name='act' id='new'/>
    </form>
    <br>";
	
for ($i = 1; $i <= checkTeam(); $i++) {
	echo "
    <form action='teamControl.php' method='post'>
        Team $i :
        <input type='submit' value='Factory' name='act'/>
        <input type='submit' value='Distrubutor' name='act'/>
        <input type='submit' value='Wholesaler' name='act'/>
        <input type='submit' value='Retailer' name='act'/>
        <input type='hidden' value='$i' name='team'/>
	</form>
    ";
}
?>
</body>
</html>
=======
<?php
require_once("dbconfig.php");
	echo "All team:<br>";
	// list($allTeam, $allTeamName) = allTeam();
	// for ($i=0; $i<count($allTeam); $i++){
	// 	$role = array("fac", "dist", "whole", "ret");
	// 	echo "<br>Team : ".$allTeam[$i];		
	// 	list($myUser, $myRole) = myUser($allTeamName[$i]);	// show this team status
	// 	for($j=0; $j<count($myUser); $j++){
	// 		if(in_array($myRole ,$role))	// 在myRole裡面找$role
	// 			$role = array_diff($role, array($myRole[$j])); //刪掉被選的role
	// 		echo $myUser[$j]." as ".$myRole[$j]."<br>";	// prio是零的就把他echo出來
	// 	}
	// 	$role = array_values($role); // 排序被刪掉的role在array裡的位置
	// 	for($k=0; $k<count($role); $k++){
	// 		echo $role[$k]."沒被選&nbsp";
	// 	}
	// }
	list($myTeam, $myTeamName) = myTeam($userId);
	for ($i=0; $i<count($myTeam); $i++){
		$role = array("fac", "dist", "whole", "ret");
		echo "<br>Team : ".$myTeam[$i]."<br>";		
		list($myUser, $myRole) = myUser($myTeamName[$i]);	// show this team status
		for($j=0; $j<count($myUser); $j++){
			if(in_array($myRole ,$role))	// 在myRole裡面找$role
				$role = array_diff($role, array($myRole[$j])); //刪掉被選的role
			echo $myUser[$j]." as ".$myRole[$j]."<br>";	// prio是零的就把他echo出來
		}
		$role = array_values($role); // 排序被刪掉的role在array裡的位置
		for($k=0; $k<count($role); $k++){
			echo $role[$k]."沒被選";
			echo "
				<form action='teamControl.php' method='post'>
					<input type='hidden' name='teamName' value='$myTeamName[$i]'>
					<input type='hidden' name='userId' value='$userId'>
					<input type='hidden' name='role' value='$role[$k]'>
					<input type='submit' name='act' value='pickRole'>
				</form>
			";
		}
	}
?>
>>>>>>> 2a068487693b19acce45bb87d346c5e2a419bb61
