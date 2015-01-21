<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>顧客管理システム | 顧客対応登録</title>
<link href="/assets/css/kcommon.css" rel="stylesheet" type="text/css" media="all" />
<script type="text/javascript" src="/assets/js/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="/assets/js/jquery-ui.min.js"></script>
<script type="text/javascript">
function sear(){
	window.open("/matter/search","window","width=400,height=400,scrollbars=yes");
}



</script>
<style type="text/css">
p#msg{
	color:red;
	font-size:30px;
}
</style>

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
<p id="msg"><?php echo $msg; ?></p>
<form action="create" method="post">
<table>
	<tr>
		<th>日付</th>
		<td><input type="text" name="date"  value="<?php echo date("Y-m-d"); ?>" size="6"></td>
		<th>記入者:</th>
		<td><?php echo $userlog_name; ?></td>
	</tr>
	<tr>
		<th>顧客会社名</th>
		<td><input type="text" id="one" disabled size="10"><input type="button" name="search" onClick="sear();" value="検索"></td>
		<th>客種</th>
		<td><input type="text" id="two" disabled size="1"></td>
		<th>要求フラグ</th>
		<td>
			<select name="case">
				<?php
					foreach($select as $val){
						echo "<option value='".$val['case_id']."'>".$val["name"]."</option>";

					}
				?>
			</select>
		</td>
	</tr>

	<tr>
		<th>対応者</th>
		<td><input type="text" name="user" size="10"></td>
	</tr>
	<tr>
		<td>対応内容</td>
		<td><textarea name="detail"></textarea></td>
	</tr>

	<tr>
		<th>住所</th>
		<td><input type="text" id="three" disabled size="15"></td>
	</tr>
	<tr>
		<th>TEL</th>
		<td><input type="text" id="four" disabled size="10"></td>
		<th>Mail</th>
		<td><input type="text" id="five" disabled size="10"></td>
	</tr>
	<tr>
		<th>顧客担当者名</th>
		<td><input type="text" id="six" disabled size="10"></td>
	</tr>
	<tr>
		<th>担当者Tel</th>
		<td><input type="text" id="seven" disabled size="10"></td>
		<th>担当者Mail</th>
		<td><input type="text" id="eight" disabled size="10"></td>
	</tr>
	<tr>
		<th>特記事項</th>
		<td><textarea id="nine" disabled></textarea></td>
	</tr>
</table>
<input type="hidden" id="ten" name="company_id" value="">
<input type="hidden" name="check" value="1">
<p class="btnSpace"><button type="submit" id="btnCrea"><img src="/assets/img/common/btn_insert.png" alt="登録する" /></button></p>

</form>
</div><!-- /contentIn -->
</div><!-- /content -->

<div id="side">
	<ul class="navi">
		<li><a href="/ktop">TOP</a></li>
		<li><a href="/clist">顧客一覧</a></li>
		<li><a href="/case">要求一覧</a></li>
		<li><a href="/mlist">対応一覧</a></li>
	</ul>
</div>
<div class="clear"></div>
</div><!-- /main -->

</body>
<html>
