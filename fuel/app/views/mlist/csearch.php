<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>顧客管理システム | 顧客会社検索</title>
	<link href="/assets/css/common.css" rel="stylesheet" type="text/css" media="all" />
	<script type="text/javascript">
	function setFormInput(val){
        if(!window.opener || window.opener.closed){
            //親ウィンドウが存在しない場合の処理
            window.close();
        } else{
            //window.openerで親ウィンドウのオブジェクトを操作
            window.opener.document.getElementById('search').value = val;
            window.close();
            window.opener.form1.submit();
        }

    }
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

<form action="csearch" method="post" name="frm">
<table class="tableStylex">
	<tr>
		<td><input type="text" name="s_name" size="10"></td>
		<td><input type="submit"  value="検索"></td>
	</tr>

	<tr>
		<th colspan="2">会社名</th>
	</tr>
	<?php
		foreach($name as $key => $val){
			if($key % 2 == 0){
				echo "<tr>";
			}
			echo "<td><a href=javascript:setFormInput('".$val["company_name"]."');>".$val['company_name']."</a></td>";
			if($key % 2 == 1 || $key == count($name)){
				echo "</tr>";
			}
		}
	?>
</table>
<input type="hidden" name="check" value="1">
</form>

</body>
</html>