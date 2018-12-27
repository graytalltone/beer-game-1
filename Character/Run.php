<?php
require_once("OrderModel.php");
$order = (int)$_POST["ord"];
$oid = "2";
echo $order;
updateOrder($order,$oid);

addOrder();
header("Location: Factory.php");
?>