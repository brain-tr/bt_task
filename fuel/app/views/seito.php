<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>生徒</title>


<style>

</style>
<script type="text/javascript">
msg = "<?php echo $msg; ?>";
window.onload = function(){
	document.form.send.value = "登録";
}

function change(name,seito_id){
	document.form.send.value = "変更";
	document.form.name.value = name;
	document.form.id.value = seito_id;
	//キャンセルボタン
	document.form.cancel.disabled = false;
}

function reload(cancel){
	document.form.name.value="";
	document.form.send.value = "登録";
}

function del(name,seito_id){
	Msg = "削除しますか？";
	if(confirm(Msg)){
	document.form.id.value = seito_id;
	var submitType = document.createElement("input");
	submitType.setAttribute("name", "delete");
	submitType.setAttribute("type", "hidden");
	submitType.setAttribute("value", "1");
	form.appendChild(submitType);
	form.method = "post";
	form.submit();
	}
}

function check(send){
	if(document.form.send.value == "登録"){
		henkou = confirm("登録しますか？");
		if(henkou == true){
			return true;
		}else{
			return false;
	}
}

	if(document.form.send.value == "変更"){
		henkou = confirm("変更しますか？");
		if(henkou == true){
			return true;
		}else{
			return false;
		}
	}

}
if(msg != "1"){
	alert(msg);
}
</script>
</head>
<body>
<h1>生徒登録</h1>
<form action="seito" method="post" name="form">
	名前<input type="text" name="name" value="" >
<input type="hidden" name="get" value="<?php echo $get; ?>">
<input type="hidden" name="id" value="">
<input type="submit" name="send" value="" onClick="return check();">
<input type="button" value="キャンセル" name="cancel" id="cancel" disabled onClick="reload();">
</form>
</div>
<table>
<tr>
	<th>ID</th>
	<th>名前</th>
	<th>変更</th>
</tr>
<?php
	foreach($namelist as $key => $val){
		echo "<tr>";
		echo "<td>".$val["seito_id"]."</td>";
		echo "<td>".$val["name"]."</td>";
		echo "<td><input type='button' value='変更' onClick=change('".$val["name"]."',".$val["seito_id"].");>
    	<input type='button' value='削除' onClick=del('".$val["name"]."',".$val["seito_id"].");></td>";
	echo "</tr>";
}
?>

</table>
</body>
</html>