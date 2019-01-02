<?php
require_once("OrderModel.php");
require_once("func.php");
$order = (int)$_POST["ord"];
$oid = "24";
if(checkOrder($order)){
	updateOrder($order,$oid);
	
	addOrder();
	header("Location: Factory.php");
}
else{
	header("Location: Factory.php");
}
?>