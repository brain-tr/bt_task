<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>顧客管理システム | 顧客会社検索</title>
	<link href="/assets/css/common.css" rel="stylesheet" type="text/css" media="all" />
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
</head>
<body class="white">

<form action="search" method="post">
<table>
	<tr>
		<td><input type="text" name="s_name" size="10"></td>
		<td><input type="submit"  value="検索"></td>
	</tr>

	<tr>
		<th>会社名</th>
	</tr>
	<?php
		foreach($name as $key => $val){
			echo "<tr>";
			echo "<td><a href=javascript:setFormInput('".$val["company_name"].",".$val["c_flag"].",".$val["company_add"].",".$val["company_tel"].",".$val["company_mail"].",".$val["name"].",".$val["tel"].",".$val["mail"].",".$val["special_text"].",".$val["company_id"]."');>".$val['company_name']."</a></td>";
			echo "</tr>";
		}
	?>
</table>
<input type="hidden" name="check" value="1">
</form>

</body>
</html>