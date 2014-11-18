<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>点数表示</title>

<script type="text/javascript">
</script>
</head>
<body>
<form action="hyouji" method="post" name="form" >
<?php
echo "名前<select name='name'>";
 	foreach($namelist as  $val){
		if ($name == $val['seito_id']) {
		print '<option value="' .$val['seito_id']. '" selected="selected">' .$val["name"]. '</option>';
	}else{
		print '<option value="' .$val['seito_id']. '"">' .$val["name"]. '</option>';
}

}
echo "</select>";
?>
<input type="submit" name="search" value="検索">
<br>
<table border="1">
	<tr>
		<th>ID<input type="submit" name="btn" value="<?php  echo $msg; ?>" ></th>
		<th>科目<input type="submit" name="btn2" value="<?php  echo $msg2; ?>" ></th>
		<th>点数<input type="submit" name="btn3" value="<?php  echo $msg3; ?>" ></th>
	</tr>
	<?php
	$kamoku	=	array(
		1	=>	'国語',
		2	=>	'数学',
		3	=>	'理科',
		4	=>	'社会',
		5	=>	'英語',
		6	=>	'保体'
	);
	foreach($down as $key => $val){
		echo "<tr>";
		echo "<td>".$val["id"]."</td>";
		echo "<td>".$kamoku[$val["kyouka_id"]]."</td>";
		echo "<td>".$val["point"]."</td>";
		echo "</tr>";
	}
?>

</table>
</form>

</body>
</html>
