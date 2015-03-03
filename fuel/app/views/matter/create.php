<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>顧客管理システム | 顧客対応登録</title>
<link href="/assets/css/common.css" rel="stylesheet" type="text/css" media="all" />
<script type="text/javascript" src="/assets/js/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="/assets/js/jquery-ui.min.js"></script>
<script type="text/javascript">
msgcheck	= "<?php echo $msgcheck; ?>";
function sear(){
	window.open("/mlist/search","window","width=400,height=400,scrollbars=yes");
}
// アラートメッセージ
if(msgcheck != "1"){
	alert(msgcheck);
}
</script>
<style type="text/css">
p#msg{
	color:red;
	font-size:30px;
}
#searchbtn {
	margin:0px 5px;
}
.disabled {
	background-color: #e0e0e0;
}
#content table.tableStyle {
    border: 1px solid #999;
}

#content table.tableStyle6 {
	width:700px;
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
<p id="msg"><?php echo $msg; ?></p><br />
<form action="create" method="post">
<table class="tableStyle6">
	<tr>
		<th>日付</th>
		<td colspan="3"><input type="text" name="date" value="<?php echo date("Y-m-d"); ?>" size="12"></td>
	</tr>
	<tr>
		<th>記入者</th>
		<td colspan="3"><?php echo $userlog_name; ?></td>
	</tr>
	<tr>
		<th>顧客会社名</th>
		<td colspan="2">
			<input type="text" id="one" class="disabled" disabled size="12">
			<input type="button" id="searchbtn" name="search" onClick="sear();" value="検索">
		</td>
		<td>客種:<input type="text" id="two" class="disabled" disabled size="12"></td>
	</tr>
	<tr>
		<th>要求フラグ</th>
		<td colspan="3">
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
		<td colspan="3"><input type="text" name="user" size="10"></td>
	</tr>
	<tr>
		<th>対応内容</th>
		<td colspan="3"><textarea name="detail"></textarea></td>
	</tr>
	<tr>
		<th>住所</th>
		<td colspan="3"><input type="text" id="three" class="disabled" disabled size="15"></td>
	</tr>
	<tr>
		<th>顧客会社<br />詳細情報</th>
		<td colspan="3">
			<table class="tableStyle">
				<tr>
					<th>TEL</th>
					<th>Mail</th>
				</tr>
				<tr>
					<td><input type="text" id="four" class="disabled" disabled size="10"></td>
					<td><input type="text" id="five" class="disabled" disabled size="10"></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<th>請求担当者</th>
		<td colspan="3">
			<div id="tbl_claim">
			</div>
		</td>
	</tr>
	<tr>
		<th>担当者</th>
		<td colspan="3">
			<div id="tbl_customer">
			</div>
		</td>
	</tr>
	<tr>
		<th>特記事項</th>
		<td colspan="3"><textarea id="nine" class="disabled" disabled cols="20"></textarea></td>
	</tr>
</table>
<input type="hidden" id="ten" name="company_id" value="">
<input type="hidden" name="check" value="1">
<p class="btnSpace"><button type="submit" id="btnCrea"><img src="/assets/img/common/btn_insert.png" alt="登録する" /></button></p>
</form>
</div><!-- /contentIn -->
</div><!-- /content -->

<?php
	// サイドメニューの読み込み
	require_once(dirname(__FILE__)."/../side.php");
?>

<div class="clear"></div>
</div><!-- /main -->

</body>
<html>
