<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>エンジニア対応管理システム | ユーザー登録・更新</title>
<link href="/assets/css/common.css" rel="stylesheet" type="text/css" media="all" />
<script type="text/javascript">
	msgcheck = "<?php echo $msg; ?>";
	cancellFlag = 1;
	window.onload = function(){
		document.form.btn_send.value = "この内容で登録する";
	}

	// 入力チェック
	function formCheck() {
		var pass		= document.getElementById('password').value;
		var pass_conf	= document.getElementById('password_conf').value;
		var namec		= document.getElementById('name').value;
		var passCount	= pass.length;

		if(namec == "") {
			alert("お名前を入力してください。");
			return false;
		} else if(pass != "変更できません"){
//			if(pass_conf == "" || pass == "") {
//				alert("パスワードまたはパスワード(確認用)を入力してください。");
//				return false;
//			} else  if(pass.match (/[^0-9a-zA-Z_]+/)) {
//				alert("パスワードは半角英数で入力してください。");
//				return false;
//			} else if(pass != pass_conf) {
//				alert("パスワードとパスワード(確認用)の文字が一致しません。");
//				return false;
//			} else if(passCount < 4) {
//				alert("4文字以上のパスワードを入力してください。");
//				return false;
//			} else if(passCount > 12) {
//				alert("12文字以下のパスワードを入力してください。");
//				return false;
//			} else {
//				return true;
//			}
		} else {
			return true;
		}
	}

	// 変更処理
	function userUpdate(name, mail,  job_type, send_flag, user_id, rank_id){
		document.form.name.value			= name;
		document.form.mail.value			= mail;
		document.form.user_id.value			= user_id;
		document.form.rank_id.value			= rank_id;
		document.form.password.value		= "変更できません";
		document.form.password_conf.value	= "変更できません";

		document.form.job_type[job_type].selected						= job_type;				// セレクト
		document.form.send_flag.checked									= send_flag;			// チェックボックス
		document.form.btn_send.value									= "この内容で変更する";	// submit表示
		document.getElementById('formBoxText').textContent				= "内容を編集中です。";	// メッセージ
		document.getElementById('formBox').style.backgroundColor		= '#FFD5D5' ;			// 背景色

		// パスワードのdisabled
		password.setAttribute("disabled", "disabled");
		document.getElementById('password').style.backgroundColor		= "#e0e0e0" ;
		document.getElementById('password').style.border				= "1px solid #cccccc" ;
		document.getElementById('password').type						= "txt" ;
		password_conf.setAttribute("disabled", "disabled");
		document.getElementById('password_conf').style.backgroundColor	= "#e0e0e0" ;
		document.getElementById('password_conf').style.border			= "1px solid #cccccc" ;
		document.getElementById('password_conf').type					= "txt" ;

		if(cancellFlag == 1) {
			// キャンセル
			var submitType = document.createElement("input");
			submitType.setAttribute("type", "button");
			submitType.setAttribute("value", "キャンセル");
			submitType.setAttribute("id", "btn");
			submitType.setAttribute("onClick", "resetBtn()");
			document.getElementById("btnGroup").appendChild(submitType);

		}
		cancellFlag = 2;
	}

	// formをリセットする
	function resetBtn(){
		document.form.reset();
		document.getElementById('formBoxText').textContent				= "";
		document.getElementById('formBox').style.backgroundColor		= '#FFFFFF' ;
		document.form.btn_send.value = "この内容で登録する";

 		var btn		= document.getElementById('btn');
 		var btn_parent	= btn.parentNode;
 		btn_parent.removeChild(btn);

 		// パスワードのdisabled
 		var disabledPass = document.getElementById("password");
 		disabledPass.removeAttribute("disabled");
 		disabledPass.removeAttribute("disabled");

 		var disabledPass2 = document.getElementById("password_conf");
 		disabledPass2.removeAttribute("disabled");
 		disabledPass2.removeAttribute("disabled");

		document.getElementById('password').style.backgroundColor		= "";
		document.getElementById('password').style.border				= "";
		document.getElementById('password').type						= "password";
		document.getElementById('password_conf').style.backgroundColor	= "";
		document.getElementById('password_conf').style.border			= "";
		document.getElementById('password_conf').type					= "password";
		cancellFlag = 1;
	}

	// 削除処理
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

	// php側のメッセージ表示
	if(msgcheck != "1"){
		alert(msgcheck);
	}

	// パスワードの変更
	function userPass(user_id) {
		var user_id = user_id;
		window.open('/user/pass?user=' + user_id , 'pass', 'width=400, height=300, menubar=no, toolbar=no, scrollbars=yes');
	}
</script>
</head>

<body>

<div id="header">
<div id="headerInner">
	<h1><img src="/assets/img/common/logo.png" alt="ブレイントラスト" /></h1>
	<p class="r">[ <a href="/login/logout">ログアウト</a> ]</p>
	<div class="clear"></div>
</div><!-- /header -->
</div><!-- /headerInner -->

<div id="main">
<div id="content">
<div id="contentIn">
<h2>ユーザー登録・更新</h2>
<div id ="formBox">
	<p id="formBoxText"></p>
	<form action="/user/create" method="post" name="form" class="formstyle1">
		名　前 <input type="text" name="name" id="name" value="" />　
		アドレス <input type="text" name="mail" id="mail" value="" />　

		<input type="checkbox" name="send_flag" value="1" /> メールを送信する<br />
		パスワード <input type="password" name="password" id="password" value="" size="10" />　
		パスワード(確認用) <input type="password" name="password_conf" id="password_conf" value ="" size="10" />　
		<select name="job_type">
			<option value="0">営業</option>
			<option value="1">エンジニア</option>
		</select><br />
		<p class="rd sm">※パスワードは半角英数（4文字以上 12文字以下）</p>
		表示順位 <input type="text" name="rank_id" id="rank_id" value="" />　

		<input type="hidden" name="result" value="<?php echo $result; ?>" />
		<input type="hidden" name="user_id" value="" />
		<p class="c" id="btnGroup"><input type="submit" name="btn_send" value="" onClick="return formCheck();" /></p>
	</form>
</div>

<table class="tableStyle1 mB50">
	<tr>
		<th>名前</th>
		<th>アドレス</th>
		<th>業種判定</th>
		<th>メール</th>
		<th>表示順位</th>
		<th></th>
	</tr>
	<?php
	if(!empty($userData)){
		foreach ($userData as $val){
	?>
	<tr>
		<td><?php echo $val['name']; ?></td>
		<td><?php echo $val['mail']; ?></td>
		<td><?php echo empty($val['job_type']) ? "営業": "エンジニア" ?></td>
		<td><?php echo empty($val['send_flag']) ? "送信しない": "送信する" ?></td>
		<td><?php echo $val['rank_id']; ?></td>
		<td class="cnt">
			<a href="#" onClick="userUpdate(<?php echo "'".$val['name']."','".$val['mail']."',".$val['job_type'].",".$val['send_flag'].",".$val['user_id'].",".$val['rank_id']; ?>)">変更</a>｜
			<a href="#" onClick="userDelete(<?php echo "'".$val['user_id']."'"; ?>)">削除</a>｜
			<a href="#" onClick="userPass(<?php echo "'".$val['user_id']."'"; ?>)">パスワードの変更</a>
		</td>
	</tr>
	<?php
		}
	} else { ?>
	<tr>
		<td colspan="5">ユーザーは登録されていません。</td>
	</tr>
	<?php }
	?>
</table>
</div><!-- /contentIn -->
</div><!-- /content -->

<div id="side">
	<ul class="navi">
		<li><a href="/top/">TOP</a></li>
		<li><a href="/follow/create">フォロー報告</a></li>
		<li><a href="/list/">フォロー一覧</a></li>
		<li><a href="/user/create">ユーザー登録・更新</a></li>
		<li><a href="/situation/create">状況フラグ登録・更新</a></li>
		<li><a href="/appointment/create">対応方針登録・更新</a></li>
	</ul>
</div><!-- /side -->

<div class="clear"></div>
</div><!-- /main -->
</body>
<html>
