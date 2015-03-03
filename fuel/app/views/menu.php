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
	<h2 class="top">TOP画面</h2>
	<div id="formbox2">
	<ul class="clearfix">
		<li>
			<form action="/ttop" method="post" name="f_follow">
				<input type="submit" value="タスク管理システムTOP" name="task"  style="WIDTH: 200px; HEIGHT: 70px">
			</form>
		</li>
		<li>
			<form action="/ktop" method="post" name="f_list">
				<input type="submit" value="顧客管理システムTOP" name="customer"  style="WIDTH: 200px; HEIGHT: 70px">
			</form>
		</li>

	<!--   -->
	</ul>
	</div><!-- /formbox2  -->
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
