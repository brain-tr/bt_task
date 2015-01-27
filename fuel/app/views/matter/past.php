<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>顧客管理システム | 顧客対応変更</title>
<link href="/assets/css/kcommon.css" rel="stylesheet" type="text/css" media="all" />
<script type="text/javascript" src="/assets/js/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="/assets/js/jquery-ui.min.js"></script>
<script type="text/javascript">
msgcheck	= "<?php echo $msg; ?>";
//昇順降順ボタン
function sortbtn(number){
	if(number == 1){
		var ipt1 = document.createElement("input");
		var ipt2 = document.createElement("input");

		ipt1.type = "hidden";
		ipt1.name = "updown";
		ipt1.value= "<?php echo $updown; ?>";

		ipt2.type = "hidden";
		ipt2.name = "check3";
		ipt2.value = 1;

		document.form.appendChild(ipt1);
		document.form.appendChild(ipt2);
		document.form.submit();
	}else if(number == 2){
		var ipt3 = document.createElement("input");
		var ipt4 = document.createElement("input");

		ipt3.type = "hidden";
		ipt3.name = "updown2";
		ipt3.value= "<?php echo $updown2; ?>";

		ipt4.type = "hidden";
		ipt4.name = "check3";
		ipt4.value = 2;

		document.form.appendChild(ipt3);
		document.form.appendChild(ipt4);
		document.form.submit();
	}
}
//フラグ変更用サブウィンドウを開く。
function upda(id){
	var form  = document.createElement("form");
	var input = document.createElement("input");
	var input2= document.createElement("input");

	form.action = "/matter/update";
	form.method = "post";

	input.type = "hidden";
	input.name = "list_id";
	input.value= id;

	input2.type  = "hidden";
	input2.name  = "flag";
	input2.value = "1";

	form.appendChild(input);
	form.appendChild(input2);
	document.body.appendChild(form);
	form.submit();
}
//フラグ削除
function del(matter_id){
	Msg = "削除しますか？";
	if(confirm(Msg)){
	document.form.check.value = 3;
	document.form.matter_id.value = matter_id;
	form.method = "post";
	form.submit();
	}
}
//アラートメッセージ
if(msgcheck != "1"){
	alert(msgcheck);
}
</script>
<style type="text/css">
p#msg{
	color:red;
	font-size:30px;
}
table.tableStyley{
	margin-top:40px;
}
table.tableStylex{
	border: 2px solid #999;
	margin-top:20px;
}
table.tableStylex td,
table.tableStylex th {
	text-align:center;
	width:193px;
	padding: 5px 10px;
	border-left: 1px dotted #999;
	border-bottom: 1px solid #999;
	background-color:#fff;
}
table.tableStylex th {
	text-align:center;
	font-weight:bold;
	border-bottom-width: 1px;
	border-bottom-style:solid;
	border-bottom-color: #999;
	background-color:#ffe8ee;
	color:#666;
	font-size:93%;
}

table.tableStylex td {
	font-size:86%;
	text-align:center;
}
table.tableStylex td a{
	text-decoration: none;
}
span#com {
	text-decoration:none;
}
span#com {
	color:white;
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
<?php
	$selected1 = "";
	$flg	=	"";

	foreach($view as $key=>$val){
		if($val["c_flag"]==1){
			$flg = "案件";
		}else if($val["c_flag"]==2){
			$flg = "人材";
		}else if($val["c_flag"] == 3){
			$flg = "両方";
		}
?>
<form action="past" method="post" name="form">
<table class="tableStyley">
	<tr>
		<th>日付</th>
		<td><input type="text" name="date" disabled value="<?php echo $val['date']; ?>" size="6"></td>
		<th>記入者:</th>
		<td><?php echo $val['user_name']; ?></td>
	</tr>
	<tr>
		<th>顧客会社名</th>
		<td><input type="text" id="one" disabled size="10" value="<?php echo $val["company_name"];?>"></td>
		<th>客種</th>
		<td><input type="text" id="two" disabled size="1" value="<?php echo $flg; ?>"></td>
	</tr>

	<tr>
		<th>住所</th>
		<td><input type="text" id="three" disabled size="15" value="<?php echo $val["company_add"];?>"></td>
	</tr>
	<tr>
		<th>TEL</th>
		<td><input type="text" id="four" disabled size="10" value="<?php echo $val["company_tel"];?>"></td>
		<th>Mail</th>
		<td><input type="text" id="five" disabled size="10" value="<?php echo $val["company_mail"];?>"></td>
	</tr>
	<tr>
		<th>顧客担当者名</th>
		<td><input type="text" id="six" disabled size="10" value="<?php echo $val["name"];?>"></td>
	</tr>
	<tr>
		<th>担当者Tel</th>
		<td><input type="text" id="seven" disabled size="10" value="<?php echo $val["tel"];?>"></td>
		<th>担当者Mail</th>
		<td><input type="text" id="eight" disabled size="10" value="<?php echo $val["mail"];?>"></td>
	</tr>
	<tr>
		<th>特記事項</th>
		<td><textarea id="nine" disabled><?php echo $val["special_text"]; ?></textarea></td>
	</tr>
</table>
<input type="hidden" id="ten" name="company_id" value="<?php echo $val["company_id"];?>">
<input type="hidden" name="matter_id" value="<?php echo $val["matter_id"]; ?>">
<input type="hidden" name="check" value="1">
<input type="hidden" name="list_id" value=<?php echo $list_id;?>>
<table class="tableStylex">
<tr>
<th>日付<input type='button' value=<?php echo $sortbtn;?> onClick='sortbtn(1);'></th>
<th>要求フラグ<input type='button' value=<?php echo $sortbtn2;?> onClick='sortbtn(2);'></th>
<th>対応者</th>
<th>対応内容</th>
<th>編集</th>
</tr>
<?php
	foreach($past as $key2 => $val2){
		$color = $val2["color_code"];
		echo "<tr>";
		echo "<td>".$val2["date"]."</td>";
		echo "<td style='background-color:$color'><span id='com'>".$val2["name"]."</span><br></td>";
		echo "<td>".$val2["respone_name"]."</td>";
		echo "<td>".$val2["content_text"]."</td>";
		echo "<td>";
  		echo "<input type='button' value='変更' onClick=\"upda('".$val2["matter_id"]."')\">";
 		echo " / ";
		echo "<input type='button' value='削除' onClick=del(".$val2["matter_id"].")>";
		echo "</td>";
		echo "</tr>";
	}




?>
</table>
</form>
</div><!-- /contentIn -->
</div><!-- /content -->
<?php }?>
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
