<?php
require_once("OrderModel.php");
require_once("func.php");
$order = (int)$_POST["ord"];
$oid = "24";
if(checkOrder($order)){
	//if(status != 4){
		updateOrder($order,$oid);	
		//status++;
	//}
	else{
	countPurc();
	countNeed();
	countsales();
	countstock();
	
	addOrder();
	header("Location: Factory.php");

	}
}
else{
	header("Location: Factory.php");
}
?>