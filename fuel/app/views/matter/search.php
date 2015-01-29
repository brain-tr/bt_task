<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>顧客管理システム | 顧客会社検索</title>
	<script type="text/javascript">
	function setFormInput(val){
		var data = val.split(",");
		if(data[1]==1){
			data[1] = "案件";
		}else if(data[1]==2){
			data[1] = "人材";
		}else if(data[1]==3){
			data[1] = "両方";
		}
        if(!window.opener || window.opener.closed){
            //親ウィンドウが存在しない場合の処理
            window.close();
        } else{
            //window.openerで親ウィンドウのオブジェクトを操作
            window.opener.document.getElementById('one').value = data[0];
            window.opener.document.getElementById('two').value = data[1];
            window.opener.document.getElementById('three').value = data[2];
            window.opener.document.getElementById('four').value = data[3];
            window.opener.document.getElementById('five').value = data[4];
            window.opener.document.getElementById('six').value = data[5];
            window.opener.document.getElementById('seven').value = data[6];
            window.opener.document.getElementById('eight').value = data[7];
            window.opener.document.getElementById('nine').value = data[8];
            window.opener.document.getElementById('ten').value = data[9];
            window.close();
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
<form action="search" method="post">
<p>
<input type="text" name="s_name" size="30">
<input type="submit"  value="検索">
</p>
<table class="tableStylex">
	<tr>
		<th colspan="2">会社名</th>
	</tr>
	<?php
		foreach($name as $key => $val){
			if($key % 2 == 0){
				echo "<tr>";
			}
			echo "<td><a href=\"javascript:setFormInput('".$val["company_name"].",".$val["c_flag"].",".$val["company_add"].",".$val["company_tel"].",".$val["company_mail"].",".$val["name"].",".$val["tel"].",".$val["mail"].",".$val["special_text"].",".$val["company_id"]."');\">".$val['company_name']."</a></td>";
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