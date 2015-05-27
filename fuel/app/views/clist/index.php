<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>顧客管理システム | 顧客一覧</title>
<link href="/assets/css/common.css" rel="stylesheet" type="text/css" media="all" />
<script type="text/javascript">
msgcheck	= "<?php echo $msgcheck; ?>";
//削除確認
function del(){
	if(window.confirm('一括削除を実行')){
		document.form2.submit();
	}
}
//単体削除用
function del2(company_id){
	if(window.confirm('削除しますか')){
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

//昇順降順ボタン
function msg(msg){

	//会社名用
	if(msg == 1){
		var ipt1 = document.createElement("input");
		var ipt2 = document.createElement("input");

		ipt1.type = "hidden";
		ipt1.name = "updown1";
		ipt1.value= <?php echo $flag; ?>;

		ipt2.type = "hidden";
		ipt2.name = "check3";
		ipt2.value = 1;

		form1.appendChild(ipt1);
		form1.appendChild(ipt2);
		form1.submit();

	//客種用
	}else if(msg == 2){
		var ipt2 = document.createElement("input");
		var ipt3 = document.createElement("input");

		ipt2.type = "hidden"
		ipt2.name = "updown2";
		ipt2.value= <?php echo $flag2; ?>;

		ipt3.type = "hidden";
		ipt3.name = "check3";
		ipt3.value = 2;

		form1.appendChild(ipt2);
		form1.appendChild(ipt3);
		form1.submit();
    
    //作成日用
	}else if(msg == 3){
		var ipt2 = document.createElement("input");
		var ipt3 = document.createElement("input");

		ipt2.type = "hidden"
		ipt2.name = "updown3";
		ipt2.value= <?php echo $flag3; ?>;

		ipt3.type = "hidden";
		ipt3.name = "check3";
		ipt3.value = 3;

		form1.appendChild(ipt2);
		form1.appendChild(ipt3);
		form1.submit();
        
    //更新日用
	}else if(msg == 4){
		var ipt2 = document.createElement("input");
		var ipt3 = document.createElement("input");

		ipt2.type = "hidden"
		ipt2.name = "updown4";
		ipt2.value= <?php echo $flag4; ?>;

		ipt3.type = "hidden";
		ipt3.name = "check3";
		ipt3.value = 4;

		form1.appendChild(ipt2);
		form1.appendChild(ipt3);
		form1.submit();
	}
}
//アラートメッセージ
if(msgcheck != "1"){
	alert(msgcheck);
}
</script>

<style type="text/css">
span#com a{
	text-decoration:none;
}
input[type="button"].updown {
	margin:0;
	width:24px;
	height:24px;
	font-size:14px;
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
<h2>顧客一覧</h2>

<div class="fl">
	<input type="button" onClick="location.href='customer/create'" id="btn" value="新規登録画面" style="WIDTH: 200px; HEIGHT: 50px">
</div>

<div class="fr">
<br>
<form action="#" name="form1" id="search" method="post">
	<input type="text" name="search" class="searchBoxSize" size="10" value=<?php echo $search;?>>
	<input type="submit" id="searchbtn" name="send" value="検索">
	<input type="hidden" name="check2" value="2">
</form>
</div>
<div class="clear mB20"></div>

<form action="#" name="form2" method="post">
<table class="tableStyle1">
<?php
	$i = 0;
	$select = array(
		1 => "エンドユーザ",
		2 => "元請け",
		3 => "二次請け",
		4 => "BP（両方）",
		5 => "BP（人材元）"
	);
	echo "<tr>";
	echo "<th class='w50'>会社名　<input type='button' name='updown1' class='updown' value='$msg' onClick='msg(1);'></th>";
	echo "<th>客種　<input type='button' name='updown2' class='updown' value='$msg2' onClick='msg(2);'></th>";
	echo "<th>作成日　<input type='button' name='updown3' class='updown' value='$msg3' onClick='msg(3);'></th>";
	echo "<th>更新日　<input type='button' name='updown4' class='updown' value='$msg4' onClick='msg(4);'></th>";
	echo "<th>削除</th>";

	foreach($view as $key=> $val){
		echo "<tr>";
		echo "<td><span id='com'><a href='#' onClick='change(".$val['company_id'].");'  name='c_name'>".$val["company_name"]."</a></span></td>";
		echo "<td>".$select[$val["c_flag"]]."</td>";
		echo "<td>".$val["creation_time"]."</td>";
		echo "<td>".$val["modification_time"]."</td>";
		echo "<td><input type='checkbox' name='del[]' value=".$val['company_id'].">　　　";
		echo "<input type='button' onClick='del2(".$val["company_id"].");' value='削除' style='WIDTH: 60px; HEIGHT: 35px'></td>";
		echo "</tr>";
	}
?>
</table>
<br>
<input type="hidden" name="check" value="1">
<p class="r"><input type="button"  value="一括削除" id="delbtn" onClick="del();" style="WIDTH: 150px; HEIGHT: 40px"></p>
</form>

<div class="clear"></div>


</div><!-- /content -->
</div><!-- /contentIn -->

<?php
	// サイドメニューの読み込み
	require_once(dirname(__FILE__)."/../side.php");
?>

<div class="clear"></div>
</div><!-- /main -->

</body>
</html>
