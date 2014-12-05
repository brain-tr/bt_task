<?php
session_start();
$taskId = mt_rand();
$_SESSION['taskId'] = $taskId;
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>点数登録</title>
<script type="text/javascript">
msg = "<?php echo $msg; ?>";
function check(send){

		touroku = confirm("登録して宜しいですか？");
		if(touroku==true){
			return true;
		}else{
			alert("登録がキャンセルされました");
			return false;
	}

}
if(msg != "1"){
	alert(msg);
}
</script>

</head>
<body>
<form action="tensu" method="post" name="form">
名前<select name="name">
<?php
 	foreach($namelist as $key => $val){
 		echo "<option value=".$val['seito_id'].">".$val["name"]."</option>";
 	}
?>
</select>
<br>
　　　<select name="kyouka_id">
		<option value="1">国語</option>
		<option value="2">数学</option>
		<option value="3">理科</option>
		<option value="4">社会</option>
		<option value="5">英語</option>
		<option value="6">保体</option>
	　</select>
<br>
点数<input type="text" name="point">
<br>
<?php print('<input type="hidden" value="' . md5($taskId) . '" name="taskId" />'); ?>
<input type="submit" name="send" value="登録" onClick="return check();">
</form>
</body>
</html>
