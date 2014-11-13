<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>エンジニア対応管理システム</title>
	<link href="/assets/css/create.css" rel="stylesheet" type="text/css" media="all" />

<style>

</style>
<script type="text/javascript">
	msg = "<?php echo $msg; ?>";
	window.onload = function(){
		document.form.btn.value = "登録";
	}

	function change(name,appointment_id){
		document.form.btn.value = "変更";
		document.form.name.value = name;
		document.form.id.value = appointment_id;
		document.getElementById('formBoxText').textContent	= "内容を編集中です。";
		document.getElementById('formBox').style.backgroundColor	= '#FFD5D5' ;
		//キャンセルボタン表示
		document.form.cancel.disabled = false;

	}

	function reload(cancel){
		document.form.name.value="";
		document.form.btn.value = "登録";
		document.getElementById('formBoxText').textContent	= "";
		document.getElementById('formBox').style.backgroundColor	= '';



	}


	function deleate(name,appointment_id){
		//テキストボックスの背景色
		Msg = "削除しますか？";
		if(confirm(Msg)){
		document.form.id.value = appointment_id;
		var submitType = document.createElement("input");
		submitType.setAttribute("name", "deleate");
		submitType.setAttribute("type", "hidden");
		submitType.setAttribute("value", "1");
		form.appendChild(submitType);
		form.method = "post";
		form.submit();
		}
	}

	function check(btn){
		if(document.form.btn.value == "登録"){
			touroku = confirm("登録して宜しいですか？");
			if(touroku == true){
				return true;
			}else{
				return false;
		}
		}

		if(document.form.btn.value == "変更"){
			touroku = confirm("変更して宜しいですか？");
			if(touroku == true){
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
<div id="content">
<h1>ユーザー登録・更新画面</h1>
<div id ="formBox">
	<p id="formBoxText"></p>
	<form action="create" method="post" name="form">
		名　　前<input type="text" name="name" value="" >
	<input type="hidden" name="get" value="<?php echo $get; ?>">
	<input type="hidden" name="id" value="">
	<input type="submit" name="btn" value="" onClick="return check();">
	<input type="button" value="キャンセル" name="cancel" id="cancel" disabled onClick="reload();">
</form>
</div>
<table class="tableStyle1 mB50">
	<tr>
		<th>ID</th>
		<th>名前</th>
		<th>変更/削除</th>
	</tr>
<?php
 	foreach($namelist as $key => $val){
 		echo "<tr>";
  		echo "<td>".$val["appointment_id"]."</td>";
  		echo "<td>".$val["name"]."</td>";
  		echo "<td><input type='button' value='変更' onClick=change('".$val["name"]."',".$val["appointment_id"].");>
	    　　　　　<input type='button' value='削除' onClick=deleate('".$val["name"]."',".$val["appointment_id"].");></td>";
		echo "</tr>";
	}
?>

</table>
</div><!--/container-->



</body>
</html>