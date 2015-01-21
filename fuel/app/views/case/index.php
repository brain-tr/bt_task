<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>顧客管理システム | 要求フラグ一覧</title>
<link href="/assets/css/kcommon.css" rel="stylesheet" type="text/css" media="all" />
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
table.tableStylex tr,th,td{
	padding:5px;
	width:50px;
	text-align:center;
}
#btn{
	margin-left:600px;
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
<input type="button" id="btn" onClick="crea();" value="新規登録画面" style="WIDTH: 100px; HEIGHT: 40px">
<br>
<form action="case" method="post" name="form" style="clear:both;">
<table border="1" class="tableStylex">
<tr>
<td>要求名<input type='button' class='updown' value=<?php echo $sortbtn;?> onClick='sortbtn();'></td>
<td>編集</td>
</tr>
<?php
	foreach($name as $key => $val){
		echo "<tr>";
		echo "<td style='background-color:".$val["color_code"].";'>".$val["name"]."</td>";
		echo "<td>";
  		echo "<input type='button' value='変更' onClick=\"upda('".$val["case_id"]."', '".$val["name"]."', '".$val["color_code"]."')\">";
 		echo " / ";
		echo "<input type='button' value='削除' onClick=del(".$val["case_id"].")>";
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
