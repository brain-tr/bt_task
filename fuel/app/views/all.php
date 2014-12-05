<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>点数表示</title>

<script type="text/javascript">
</script>
<style>
table th,td{
	text-align:center;
}
</style>

</head>
<body>
<h1>生徒点数一覧表</h1>

<form action="all" name="change" method="post">

<!-- select1 -->
<?php
echo "<select name='sel'>";
echo "<option value='kara'>---</option>";
foreach($view as $key => $val){
	if ($sel == $key) {
		print '<option value="' .$key. '" selected="selected">' .$val. '</option>';
	}else{
		print '<option value="' .$key. '"">' .$val. '</option>';
	}
}
echo "</select>";
?>
<!-- //select1 -->

<!-- updown1 -->
<?php
echo "<select name='updown'>";
foreach($view2 as $key => $val){
	if($updown == $key){
		print '<option value="' .$key. '" selected="selected">' .$val. '</option>';
	}else{
		print '<option value="' .$key. '"">' .$val. '</option>';
	}
}
echo "</select>";
?>
<!-- //updown1 -->

<!-- select2 -->
<?php
echo "<select name='sel2'>";
echo "<option value='kara'>---</option>";
foreach($view as $key => $val){
	if ($sel2 == $key) {
		print '<option value="' .$key. '" selected="selected">' .$val. '</option>';
	}else{
		print '<option value="' .$key. '"">' .$val. '</option>';
	}
}
echo "</select>";
?>
<!-- //select2 -->

<!-- updown2 -->
<?php
echo "<select name='updown2'>";
foreach($view2 as $key => $val){
	if($updown2 == $key){
		print '<option value="' .$key. '" selected="selected">' .$val. '</option>';
	}else{
		print '<option value="' .$key. '"">' .$val. '</option>';
	}
}
echo "</select>";
?>
<!-- //updown2 -->

<!-- select3 -->
<?php
echo "<select name='sel3'>";
echo "<option value='kara'>---</option>";
foreach($view as $key => $val){
	if ($sel3 == $key) {
		print '<option value="' .$key. '" selected="selected">' .$val. '</option>';
	}else{
		print '<option value="' .$key. '"">' .$val. '</option>';
	}
}
echo "</select>";
?>
<!-- //select3 -->

<!-- updown3 -->
<?php
echo "<select name='updown3'>";
foreach($view2 as $key => $val){
	if($updown3 == $key){
		print '<option value="' .$key. '" selected="selected">' .$val. '</option>';
	}else{
		print '<option value="' .$key. '"">' .$val. '</option>';
	}
}
echo "</select>";
?>
<!-- //updown3 -->

<input type="submit" name="sub" value="送信">
</form>


<form action="all" name="form" method="post">
<table border="1" width="600px">
	<th>登録ID<input type="submit" name="btn" value="<?php echo $msg; ?>"></th>
	<th>生徒ID<input type="submit" name="btn2" value="<?php echo $msg2; ?>"></th>
	<th>生徒名<input type="submit" name="btn3" value="<?php echo $msg3; ?>"></th>
	<th>教科名<input type="submit" name="btn4" value="<?php echo $msg4; ?>"></th>
	<th>点数<input type="submit" name="btn5" value="<?php echo $msg5; ?>"></th>
<input type="hidden" name="check" value="1">
<?php
$kamoku	=	array(
		1	=>	'国語',
		2	=>	'数学',
		3	=>	'理科',
		4	=>	'社会',
		5	=>	'英語',
		6	=>	'保体'
);

	foreach($test as $key => $val){
		echo "<tr>";
		echo "<td>".$val["id"]."</td>";
		echo "<td>".$val["seito_id"]."</td>";
		echo "<td>".$val["name"]."</td>";
		echo "<td>".$kamoku[$val["kyouka_id"]]."</td>";
		echo "<td>".$val["point"]."</td>";
		echo "</tr>";

	}
?>
</table>
</form>
</body>
</html>
