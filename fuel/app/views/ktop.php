<html>
<head>
	<meta charset="utf-8">
	<title>顧客管理システム | TOP</title>
	<link href="/assets/css/common.css" rel="stylesheet" type="text/css" media="all" />
	<link href="/assets/css/ktop.css" rel="stylesheet" type="text/css" media="all" />
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
	<div id="formbox4">
	<ul class="clearfix">
		<li>
			<form action="/clist" method="post" name="customer">
				<input type="submit" value="顧客一覧" name="company_list"  style="WIDTH: 200px; HEIGHT: 70px">
			</form>
		</li>
		<li>
			<form action="#" method="post" name="case">
				<input type="submit" value="要求一覧" name="case_list"  style="WIDTH: 200px; HEIGHT: 70px">
			</form>
		</li>
				<li>
			<form action="#" method="post" name="matter">
				<input type="submit" value="対応一覧" name="matter_list"  style="WIDTH: 200px; HEIGHT: 70px">
			</form>
		</li>
	</ul>
	</div>
</div><!-- /contentIn -->
</div><!-- /content -->

<div id="side">
	<ul class="navi">
		<li><a href="/ktop">TOP</a></li>
		<li><a href="/clist">顧客一覧</a></li>
		<li><a href="#">要求一覧</a></li>
		<li><a href="#">対応一覧</a></li>
	</ul>
</div>

<div class="clear"></div>
</div><!-- /main -->

</body>
</html>
