<?php
require ("teamModel1.php");
$action = $_REQUEST['act'];
switch ($action) {
	case 'Factory':
	    $rid = 1;
		selectRole($_REQUEST['team'], $rid);
		break;
		
	case 'Distrubutor':
		$rid = 2;
	    selectRole($_REQUEST['team'], $rid);
		break;
		
	case 'Wholesaler':
	    $rid = 3;
	    selectRole($_REQUEST['team'], $rid);
		break;
		
	case 'Retailer':
		$rid = 4;
	    selectRole($_REQUEST['team'], $rid);
		break;
		
	case 'NewTeam':
		NewTeam();
		break;
		
    case 'logout':
		logOut();
        header("Location: loginView.php");
		break;
        
    default:
        break;
}
?>