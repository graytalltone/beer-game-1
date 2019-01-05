<?php
//require("db.php");
//require ("loginModel.php");
require ("teamModel1.php");
?>
<html>
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