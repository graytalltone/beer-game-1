<?php
require_once("db.php");
require_once("OrderModel.php");
?>
<head>
	<title>Beer-game</title>

    <style>
    table {
        width: 100%;
        border-spacing: 0px;
        border: 1px solid;
    }
    caption {
        text-align: left;
        padding-bottom: .25em;
        font-size: 1.5em;
    }
    thead th {
        background: #333;
        color: #fff;
    }
    td,
    th {
        padding: .5em;
    }
    th:not(:last-child),
    td:not(:last-child) {
        border-right: 1px solid;
    }
    tr:not(:last-child) td,
    tr:not(:last-child) th {
        border-bottom: 1px solid;
    }
    tbody tr:first-child td {
        border-top: 1px solid;
    }
    tbody tr:focus-within {
        background: #aee8f5;
    }
      
    tbody tr:hover {
        background: #aee8f5;
    }
    a {
        font-weight: bold;
        color: #000;
    }
    a:hover,
    a:focus {
        background: #000;
        color: #fff;
        outline: 4px solid #000;
    }
    body {
        font-family: Arial;
        padding: 20px 40px;
    }
    </style>
</head>

<body>

    <div class="">
		<table>
        <caption>
          Factory
        </caption>
        <thead>
			<tr>
			<th scope="col">
				訂貨量
			</th>
			<th scope="col">
				進貨量
            </th>
            <th scope="col">
				需求量
            </th>
            <th scope="col">
				銷貨量
            </th>
			<th scope="col">
				庫存量
            </th>
			<th scope="col">
				成本
            </th>
			<th scope="col">
				累積成本
            </th>
          </tr>
        </thead>
		<tbody>
<?php

$result = orderlist();
while (	$rs = mysqli_fetch_assoc($result)) {
    echo"<tr><td>" , $rs['ord'],"</td>";
	echo"<td>" , $rs['purc'],"</td>";
	echo"<td>" , $rs['need'],"</td>";
	echo"<td>" , $rs['sales'],"</td>";
	echo"<td>" , $rs['stock'],"</td>";
}
?>

<tr><td>
<form method = "POST" action = "Run.php">
    <input type = "text" name = "ord">
    <input type = "submit" value = "下單">
</form>
</td></tr>
</tbody>
</table>
</div>

</body>
</html>