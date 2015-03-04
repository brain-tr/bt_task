<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>顧客管理システム | 要求フラグ一覧</title>
<link href="/assets/css/common.css" rel="stylesheet" type="text/css" media="all" />
<script type="text/javascript" src="/assets/js/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="/assets/js/jquery-ui.min.js"></script>
<script type="text/javascript">
msgcheck	= "<?php echo $msg; ?>";
// 新規フラグ登録用サブウィンドウを開く。
function crea(){
	document.form.check.value = 1;
	document.form.flag_id.value = "";
	document.form.new_name.value = "";
	document.form.new_color.value = "";
	window.open("/case/create","window","width=450,height=400,scrollbars=yes");
}
//フラグ変更用サブウィンドウを開く。
function upda(case_id, name, color_code){
	document.form.check.value = 2;
	document.form.flag_id.value = case_id;
	document.form.new_name.value = name;
	document.form.new_color.value = color_code;
	window.open("/case/create","window","width=450,height=400,scrollbars=yes");
//	form.method = "post";
//	form.submit();
}
//フラグ削除
function del(case_id){
	Msg = "削除しますか？";
	if(confirm(Msg)){
	document.form.check.value = 3;
	document.form.flag_id.value = case_id;
	form.method = "post";
	form.submit();
	}
}
//昇順降順ボタン
function sortbtn(){
		var frm1 = document.createElement("form");
		var ipt1 = document.createElement("input");
		var ipt2 = document.createElement("input");

		frm1.action = "case";
		frm1.method = "post";

		ipt1.type = "hidden";
		ipt1.name = "updown";
		ipt1.value= "<?php echo $updown; ?>";

		ipt2.type = "hidden";
		ipt2.name = "check2";
		ipt2.value = 1;

		frm1.appendChild(ipt1);
		frm1.appendChild(ipt2);
		document.body.appendChild(frm1);
		frm1.submit();
}
//アラートメッセージ
if(msgcheck != "1"){
	alert(msgcheck);
}
</script>
<style type="text/css">
table.tableStylex {
    width: 800px;
}
table.tableStylex tr,th,td{
	padding:5px;
    border: 1px dotted #999;
    border-left: 1px solid #999;
	text-align:center;
}
table.tableStylex td.w150{
	width:150px;
}
#btn{
	margin:40px 0 10px 540px;
}
input[type="button"].updown {
	margin:0;
	width:24px;
	height:24px;
	font-size:12px;
	text-align:center;
}
#content table.tableStylex th {
    border-bottom: 1px solid #999;
    vertical-align: middle;
    text-align: center;
    font-size: 93%;
}
table {
   border-collapse: collapse;
   border: 2px solid #999;
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
<div class="fl">
	<h2>要求一覧</h2>
</div>

<div class="fl">
<br>
<input type="button" id="btn" onClick="crea();" value="新規登録画面" style="WIDTH: 150px; HEIGHT: 50px">
</div>
<div class="clear"></div>

<form action="case" method="post" name="form" style="clear:both;">
<table border="1" class="tableStylex">
	<tr>
		<th><span class="lg18">要求名</span> <input type='button' class='updown' value=<?php echo $sortbtn;?> onClick='sortbtn();'></th>
		<th><span class="lg18">編集</span></th>
	</tr>
	<?php
		foreach($name as $key => $val){
			echo "<tr>";
			echo "<td style='background-color:".$val["color_code"].";'>".$val["name"]."</td>";
			echo "<td>";
	  		echo "<input type='button' value='変更' onClick=\"upda('".$val["case_id"]."', '".$val["name"]."', '".$val["color_code"]."')\" style='WIDTH: 60px; HEIGHT: 35px'>";
	 		echo " / ";
			echo "<input type='button' value='削除' onClick=del(".$val["case_id"].") style='WIDTH: 60px; HEIGHT: 35px'>";
			echo "</td>";
			echo "</tr>";
		}
	?>
</table>

<input type="hidden" value="1" name="check">
<input type="hidden" value="" name="flag_id">
<input type="hidden" value="" name="new_name">
<input type="hidden" value="" name="new_color">
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
