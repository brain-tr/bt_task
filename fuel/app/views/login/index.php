<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>エンジニア対応管理システム | ログイン</title>
<link href="/assets/css/common.css" rel="stylesheet" type="text/css" media="all" />
<script type="text/javascript">
	msgcheck = "<?php echo $msg; ?>";
	function formCheck() {
		var mail = document.getElementById('password').value;
		var pass = document.getElementById('password').value;
		if(mail == "" || pass == "") {
			alert("空欄があります。入力内容を確認してください。");
			return false;
		}
	}
	if(msgcheck != "1"){
		alert(msgcheck);
	}
</script>
</head>

<body class="login">
	<div id="loginBox">
	<p class="c"><img src="/assets/img/login/logo.png" alt="ブレイントラスト" /></p>
	<div id="loginBoxInner">
	<form action="/login/" method="post" class="formstyle3">
		メールアドレス<br />
		<input type="text" name="mail" id="mail" value="" /><br />
		パスワード<br />
		<input type="password" name="password" id="pass" value="" /><br />
		<input type="hidden" name="result" value="1" />
		<p class="c mT10"><button type="submit" id="loginBtn" onClick="return formCheck();"><img src="/assets/img/login/btn_login.png" alt="ログイン" /></button></p>
	</form>
	</div><!-- /loginBoxInner -->
	</div><!-- /loginBox -->
</body>

<html>