<?php
require_once("OrderModel.php");
$order = (int)$_POST["ord"];
$oid = "11";
if(checkOrder($order)){
	updateOrder($order,$oid);
	addOrder();
	header("Location: Factory.php");
}
else{
	header("Location: Factory.php");
}
?>