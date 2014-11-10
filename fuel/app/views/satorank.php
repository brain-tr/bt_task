<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>じゃんけんTOP</title>
</head>
<body>

<table border="1" width="300" cellspacing="0"  bordercolor="blue">
<tr><th>ポイント</th><th>達成日</th></tr>
<?php
	foreach($ranking as $key => $val){
		echo "<tr>";
		echo "<td>".$val["point"]."</td>";
		echo "<td>".$val["create_date"]."</td>";
		echo "</tr>";
	}
?>
</table>

<form method="post" action="/satotest2/start">
<input type="submit" value="TOPへもどる">
</form>

</body>
</html>