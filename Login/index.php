<?php
require("dbconfig.php");
checkLogin();
require("teamModel.php");
$userId = $_SESSION['loginID'];
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Welcome Home</title>
<link rel="stylesheet" href="css/style.css" />
</head>
<body>
<p>Welcome <?php echo $userId; ?></p>
<table id="beerGame">
<form id="beerGame" action="teamControl.php" method="post">
    Create a team<br>Team name:
    <input type='text' name='teamName' value=''>
    <input type='hidden' name='userId' value="<?php echo $userId?>">
    <input type='submit' name='act' value='createTeam'>
</form>
<form id="beerGame" action="teamControl.php" method="post">
    <br><br>Join a Team<br>Team name:
    <input type='text' name='teamName' value=''>
    <input type='hidden' name='userId' value="<?php echo $userId?>">
    <input type='submit' name='act' value='joinTeam'>
</form>
<br><br>
<?php include("teamView.php"); ?>
<br><br>
</form>
</table>
<a href="logout.php">Logout</a>
</body>
</html>