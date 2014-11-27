<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>エンジニア対応管理システム</title>
	<link href="/assets/css/common.css" rel="stylesheet" type="text/css" media="all" />
	<script type="text/javascript">
		msgcheck = "<?php echo $msg; ?>";
		function formCheck(){
			var pass			= document.getElementById('password').value;
			var new_pass		= document.getElementById('new_pass').value;
			var new_pass_conf	= document.getElementById('new_pass_conf').value;
			var new_passCount	= new_pass.length;

			if(pass == "" || new_pass == "" || new_pass_conf == "") {
				alert("空欄があります。入力内容を確認してください。");
				return false;
			} else  if(new_pass.match (/[^0-9a-zA-Z_]+/)) {
				alert("パスワードは半角英数で入力してください。");
				return false;
			} else if(new_pass != new_pass_conf) {
				alert("パスワードとパスワード(確認用)の文字が一致しません。");
				return false;
			} else if(new_passCount < 4) {
				alert("4文字以上のパスワードを入力してください。");
				return false;
			} else if(new_passCount > 12) {
				alert("12文字以下のパスワードを入力してください。");
				return false;
			}else{
				return true;
			}
		}

		// php側のメッセージ表示
		if(msgcheck != "1"){
			alert(msgcheck);
		}
	</script>
</head>
<body>
<div class="passBox">
	<p class="passTxt">パスワードの変更</p>
	<form action="/user/pass" method="post" name="formPass" class="formstyle2">
		現在のパスワード <input type="text" name="password" id ="password" value="" /><br />
		新しいパスワード <input type="password" name="new_pass" id="new_pass" value="" /><br />
		新しいパスワード <input type="password" name="new_pass_conf" id="new_pass_conf" value="" />（確認用）<br />
		<p class="rd sm mB20">※パスワードは半角英数（4文字以上 12文字以下）</p>

		<input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
		<input type="hidden" name="pass_up" value="<?php echo $pass_up; ?>">
		<input type="submit" name="btn_send" value="パスワードを変更する" onClick="return formCheck();" />
		<input type="button" value="キャンセル" onClick="window.close(); return false;" />
	</form>
</div><!-- /passBox -->

</body>
</html>