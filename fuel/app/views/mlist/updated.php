<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>顧客管理システム | 顧客会社検索</title>
	<link href="/assets/css/common.css" rel="stylesheet" type="text/css" media="all" />
	<script type="text/javascript">
	</script>
<style type="text/css">
table.tableStylex{
	border: 2px solid #999;
}
table.tableStylex td,
table.tableStylex th {
	text-align:center;
	width:193px;
	padding: 5px 10px;
	border-left: 1px dotted #999;
	border-bottom: 1px solid #999;
	background-color:#fff;
}
table.tableStylex th {
	text-align:center;
	font-weight:bold;
	border-bottom-width: 1px;
	border-bottom-style:solid;
	border-bottom-color: #999;
	background-color:#ffe8ee;
	color:#666;
	font-size:93%;
}

table.tableStylex td {
	font-size:86%;
	text-align:left;
}
table.tableStylex td a{
	text-decoration: none;
}
</style>
</head>
<body class="white">
<h2>　更新履歴</h2>
<form action="updated" method="post" name="frm">
<table class="tableStylex">
<tr>
	<th>名前</th>
	<th>更新日時</th>
</tr>
<?php
	foreach($show as $val){
		echo "<tr>";
		echo "<td>".$val["name"]."</td>";
		echo "<td>".$val["updated_at"];
		echo "</tr>";
	}
?>
</table>
</form>

</body>
</html>