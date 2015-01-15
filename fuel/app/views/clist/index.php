<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>顧客管理システム | 顧客一覧</title>
<link href="/assets/css/kcommon.css" rel="stylesheet" type="text/css" media="all" />
<script type="text/javascript">
//削除確認
function del(){
	if(window.confirm('一括削除を実行')){
		alert('削除しました');
		document.form2.submit();
	}
}
//単体削除用
function del2(company_id){
	if(window.confirm('削除しますか')){
		alert('削除しました');
		var submitType = document.createElement("input");
		submitType.setAttribute("name", "delete");
		submitType.setAttribute("type", "hidden");
		submitType.setAttribute("value", company_id);
		form2.appendChild(submitType);
		document.form2.submit();
	}
}
//変更用
function change(company_id){
	var form  = document.createElement("form");
	var input = document.createElement("input");

	form.action = "customer/update";
	form.method = "post";

	input.name = "c_id";
	input.value= company_id;

	form.appendChild(input);
	document.body.appendChild(form);
	form.submit();
}




</script>

<style type="text/css">
table.tableStylex tr,th,td{
	padding:5px;
	text-align:center;
}

#delbtn{
	margin-left:450px;
}

#search{
	margin-left:500px;
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
<input type="button" onClick="location.href='customer/create'" id="btn" value="新規登録画面" style="WIDTH: 100px; HEIGHT: 40px">
<br>
<form action="#" name="form1" id="search" method="post">
	<input type="text" name="search" size="10">
	<input type="submit" name="send" value="検索">
	<input type="hidden" name="check2" value="2">
</form>


<form action="#" name="form2" method="post">
<table border="1" class="tableStylex">

<?php
	$i = 0;
	$select = array(
		1 => "案件",
		2 => "人材",
		3 => "両方"
	);

	echo "<tr>";
	echo "<td>会社名</td>";
	echo "<td>客種</td>";
	echo "<td>削除</td>";

	foreach($view as $key=> $val){
		echo "<tr>";
		echo "<td><a href='#' onClick='change(".$val['company_id'].");'  name='c_name'>".$val["company_name"]."</a></td>";
		echo "<td>".$select[$val["c_flag"]]."</td>";
		echo "<td><input type='checkbox' name='del[]' value=".$val['company_id'].">　　　<input type='button' onClick='del2(".$val["company_id"].");' value='削除'></td>";
		echo "<tr>";

	}

?>

</table>
<br>
<input type="hidden" name="check" value="1">
<input type="button"  value="一括削除" id="delbtn" onClick="del();">
</form>

<div class="clear"></div>


</div><!-- /content -->
</div><!-- /contentIn -->

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
