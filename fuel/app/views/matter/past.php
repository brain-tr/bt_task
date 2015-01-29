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

jQuery(function($) {
    $('.textOverflowTest3').each(function() {
        var $target = $(this);

        // オリジナルの文章を取得する
        var html = $target.html();

        // 対象の要素を、高さにautoを指定し非表示で複製する
        var $clone = $target.clone();
        $clone
            .css({
                display: 'none',
                position : 'absolute',
                overflow : 'visible'
            })
            .width($target.width())
            .height('auto');

        // DOMを一旦追加
        $target.after($clone);

        // 指定した高さになるまで、1文字ずつ消去していく
        while((html.length > 0) && ($clone.height() > $target.height())) {
            html = html.substr(0, html.length - 1);
            $clone.html(html + "...");
        }

        // 文章を入れ替えて、複製した要素を削除する
        $target.html($clone.html());
        $clone.remove();
    });
});
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
	width:700px;
	border: 2px solid #999;
	margin-top:20px;
}
table.tableStylex td,
table.tableStylex th {
	text-align:center;
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
#content table.tableStyle {
    border: 1px solid #999;
}
#content table.tableStyle6 {
	width:700px;
}
span#com {
	text-decoration:none;
}
span#com {
	color: #000;
}
/* overflow:hidden、heightは必ず指定する */
.textOverflowTest3 {
    overflow: hidden;
    padding: 10px;
    width: 200px;
    height: 24px;
}

.disabled {
	background-color: #e0e0e0;
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
<br />
<table class="tableStyle6">
	<tr>
		<th>顧客会社名</th>
		<td colspan="2"><input type="text" id="one" class="disabled" disabled size="10" value="<?php echo $val["company_name"];?>"></td>
		<td>客種:<input type="text" id="two" class="disabled" disabled size="1" value="<?php echo $flg; ?>"></td>
	</tr>
	<tr>
		<th>住所</th>
		<td colspan="3"><input type="text" id="three" class="disabled" disabled size="15" value="<?php echo $val["company_add"];?>"></td>
	</tr>
	<tr>
		<th>顧客会社<br />詳細情報</th>
		<td colspan="3">
			<table class="tableStyle">
				<tr>
					<th>TEL(請求担当)</th>
					<th>Mail(請求担当)</th>
				</tr>
				<tr>
					<td><input type="text" id="four" class="disabled" disabled size="10" value="<?php echo $val["company_tel"];?>"></td>
					<td><input type="text" id="five" class="disabled" disabled size="10" value="<?php echo $val["company_mail"];?>"></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<th>顧客担当者<br />詳細情報</th>
		<td colspan="3">
			<table class="tableStyle">
				<tr>
					<th>顧客担当者名</th>
					<th>TEL(顧客担当者)</th>
					<th>Mail(顧客担当者)</th>
				</tr>
				<?php
					foreach($customer as $key3 => $val3){
						echo "<tr>";
							echo "<td><input type='text' id='six' class='disabled' disabled size='8' value='".$val3["name"]."'></td>";
							echo "<td><input type='text' id='seven' class='disabled' disabled size='8' value=".$val3["tel"]."></td>";
							echo "<td><input type='text' id='eight' class='disabled' disabled size='8' value='".$val3["mail"]."'></td>";
						echo "</tr>";
					}
				?>
			</table>
		</td>
	</tr>
	<tr>
		<th>特記事項</th>
		<td colspan="3"><textarea id="nine" class="disabled" disabled><?php echo $val["special_text"]; ?></textarea></td>
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
		echo "<td class='style1'>".$val2["date"]."</td>";
		echo "<td class='style1' style='background-color:$color'><span id='com'>".$val2["name"]."</span><br></td>";
		echo "<td class='style1'>".$val2["respone_name"]."</td>";
		echo "<td><p class='textOverflowTest3'>".$val2["content_text"]."</p></td>";
		echo "<td class='style1'>";
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
