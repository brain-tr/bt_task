<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>エンジニア対応管理システム</title>
	<link href="/assets/css/common.css" rel="stylesheet" type="text/css" media="all" />
	<script type="text/javascript">

	</script>
</head>
<body class="white">
<div class="passBox">
<h2>更新履歴</h2>
<table width="400px" border="1">
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

</div><!-- /passBox -->

</body>
</html>