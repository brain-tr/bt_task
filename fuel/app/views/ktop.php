<html>
<head>
	<meta charset="utf-8">
	<title>顧客管理システム | TOP</title>
	<link href="/assets/css/common.css" rel="stylesheet" type="text/css" media="all" />
	<link href="/assets/css/top.css" rel="stylesheet" type="text/css" media="all" />
</head>
<body class="top">
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
	<h2 id="top">顧客管理システム</h2>
	<div id="formbox2">
	<ul class="clearfix">
		<li>
			<form action="/clist" method="post" name="customer">
				<input type="submit" value="顧客一覧" name="company_list"  style="WIDTH: 250px; HEIGHT: 70px">
			</form>
		</li>
		<li>
			<form action="/case" method="post" name="case">
				<input type="submit" value="要求一覧" name="case_list"  style="WIDTH: 250px; HEIGHT: 70px">
			</form>
		</li>
		<li>
			<form action="/mlist" method="post" name="matter">
				<input type="submit" value="対応一覧" name="matter_list"  style="WIDTH: 250px; HEIGHT: 70px">
			</form>
		</li>
		<li>
			<form action="/menu" method="post" name="menu">
				<input type="submit" value="menu画面" name="menu"  style="WIDTH: 250px; HEIGHT: 70px">
			</form>
		</li>
	</ul>
	</div>
</div><!-- /contentIn -->
</div><!-- /content -->

<?php
	// サイドメニューの読み込み
	require_once(dirname(__FILE__)."/side.php");
?>

<div class="clear"></div>
</div><!-- /main -->

</body>
</html>
