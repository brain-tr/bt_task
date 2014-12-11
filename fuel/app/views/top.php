<html>
<head>
	<meta charset="utf-8">
	<title>エンジニア対応管理システム | TOP</title>
<link href="/assets/css/common.css" rel="stylesheet" type="text/css" media="all" />
<link href="/assets/css/top.css" rel="stylesheet" type="text/css" media="all" />
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
	<h2>エンジニア対応管理システム</h2>
	<div id="formbox2">
	<ul class="clearfix">
		<li>
			<form action="/follow/create" method="post" name="f_follow">
				<input type="submit" value="フォロー報告" name="follow"  style="WIDTH: 200px; HEIGHT: 70px">
			</form>
		</li>
		<li>
			<form action="/list/" method="post" name="f_list">
				<input type="submit" value="フォロー一覧" name="list"  style="WIDTH: 200px; HEIGHT: 70px">
			</form>
		</li>
	<!-- 管理者以外のアクセスをブロック -->
	<?php if($userlog_adflag!=0){?>
		<li>
			<form action="/user/create" method="post" name="f_user">
				<input type="submit" value="ユーザ登録・更新" name="user"  style="WIDTH: 200px; HEIGHT: 70px">
			</form>
		</li>
		<li>
			<form action="/situation/create" method="post" name="f_flag">
				<input type="submit" value="状況フラグ登録・更新" name="flag"  style="WIDTH: 200px; HEIGHT: 70px">
			</form>
		</li>
		<li>
			<form action="/appointment/create" method="post" name="f_flag">
				<input type="submit" value="対応方式登録・更新" name="form"  style="WIDTH: 200px; HEIGHT: 70px">
			</form>
		</li>
	<?php }?>
	<!--   -->
	</ul>
	</div>
</div><!-- /contentIn -->
</div><!-- /content -->

<div id="side">
	<ul class="navi">
		<li><a href="/top/">TOP</a></li>
		<li><a href="/follow/create">フォロー報告</a></li>
		<li><a href="/list/">フォロー一覧</a></li>
	<!-- 管理者以外のアクセスをブロック -->
	<?php if($userlog_adflag!=0){?>
		<li><a href="/user/create">ユーザー登録・更新</a></li>
		<li><a href="/situation/create">状況フラグ登録・更新</a></li>
		<li><a href="/appointment/create">対応方針登録・更新</a></li>
	<?php }?>
	<!--  -->
	</ul>
</div>

<div class="clear"></div>
</div><!-- /main -->

</body>
</html>
