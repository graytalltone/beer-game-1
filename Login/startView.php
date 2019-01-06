<?php
	require_once('startModel.php');
?>
<head>
<title>StartGame</title>
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
          隊伍狀況
        </caption>
        <thead>
			<tr>
			<th scope="col">
				隊伍
			</th>
            <th scope="col">
				loginID
            </th>
            <th scope="col">
				角色
            </th>
          </tr>
        </thead>
		<tbody>
<?php
    $result = teamlist();
    while (	$rs = mysqli_fetch_assoc($result)) {
        if ($rs['rid'] == 1)
            $role = "factory";
        else if ($rs['rid'] == 2)
            $role = "distributor";
        else if ($rs['rid'] == 3)
            $role = "wholesaler";
        else 
            $role = "retailer";
        echo "<tr><td>",$rs['tid'],"</td><td>",$rs['loginID'],"</td><td>",$role,"</td></tr>";
        
    }
     header('refresh: 3;url="startView.php"');
?>
<form action="startContorl.php" method="post" name="start">
<input name="submit" type="submit" value="Start" />
</form>
</div>
</body>