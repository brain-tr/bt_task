<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>エンジニア対応管理システム</title>
<link href="/assets/css/common.css" rel="stylesheet" type="text/css" media="all" />
<script type="text/javascript">
	msgcheck = "<?php echo $msg; ?>";

	window.onload = function(){
		document.form.btn_send.value = "この内容で登録する";
	}

	function userUpdate(name, mail,  job_type, send_flag ,user_id){
		document.form.name.value = name;
		document.form.mail.value = mail;
		document.form.user_id.value = user_id;

		// select・checkbox・sendのチェック
		document.form.job_type[job_type].selected = job_type;
		document.form.send_flag.checked = send_flag;
		document.form.btn_send.value = "この内容で変更する";

		//テキストボックスの背景色
		document.getElementById('formBoxText').textContent	= "内容を編集中です。";
		document.getElementById('formBox').style.backgroundColor	= '#FFD5D5' ;
	}

	function userDelete(user_id){
		deleteMsg = "この内容を削除しますか？";
		if(confirm(deleteMsg)){
			document.form.user_id.value = user_id;

			// delete作成
			var submitType2 = document.createElement("input");
			submitType2.setAttribute("name", "delete");
			submitType2.setAttribute("type", "hidden");
			submitType2.setAttribute("value", "1");
			form.appendChild(submitType2);

			form.method = "post";
			form.submit();
		}
	}
	if(msgcheck != "1"){
		alert(msgcheck);
	}
</script>
</head>
<body>
<div id="content">
<h1>ユーザー登録・更新画面</h1>
<div id ="formBox">
	<p id="formBoxText"></p>
	<form action="/user/create" method="post" name="form">
		名　　前 <input type="text" name="name" value="" size="20" />　
		<input type="checkbox" name="send_flag" value="1" /> メールを送信する<br />
		アドレス <input type="text" name="mail" value=""  size="20" />　
		<select name="job_type">
			<option value="0">営業</option>
			<option value="1">エンジニア</option>
		</select>　　　
		<input type="hidden" name="result" value="<?php echo $result; ?>" />
		<input type="hidden" name="user_id" value="" />
		<input type="submit" name="btn_send" value="" />
	</form>
</div>

<table class="tableStyle1 mB50">
	<tr>
		<th>名前</th>
		<th>アドレス</th>
		<th>業種判定</th>
		<th>メール</th>
		<th></th>
	</tr>
	<?php
		foreach ($userData as $val){
	?>
	<tr>
		<td><?php echo $val['name']; ?></td>
		<td><?php echo $val['mail']; ?></td>
		<td><?php echo empty($val['job_type']) ? "営業": "エンジニア" ?></td>
		<td><?php echo empty($val['send_flag']) ? "送信しない": "送信する" ?></td>
		<td class="cnt">
			<a href="#" onClick="userUpdate(<?php echo "'".$val['name']."','".$val['mail']."',".$val['job_type'].",".$val['send_flag'].",".$val['user_id']; ?>)">変更</a>　
			<a href="#" onClick="userDelete(<?php echo "'".$val['user_id']."'"; ?>)">削除</a>
		</td>
	</tr>
	<?php
		}
	?>
</table>
</div><!--/container-->
</body>
<html>
