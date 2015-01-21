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
			echo "<td><a href=javascript:setFormInput('".$val["company_name"]."');>".$val['company_name']."</a></td>";
			echo "</tr>";
		}
	?>
</table>
<input type="hidden" name="check" value="1">
</form>

</body>
</html>