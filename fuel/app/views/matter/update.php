<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>顧客管理システム | 顧客対応変更</title>
<link href="/assets/css/kcommon.css" rel="stylesheet" type="text/css" media="all" />
<script type="text/javascript" src="/assets/js/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="/assets/js/jquery-ui.min.js"></script>
<script type="text/javascript">
//変更用
id = <?php echo $list_id;?>;
function test(company_id){
	var form  = document.createElement("form");
	var input = document.createElement("input");
	var input2= document.createElement("input");
	var input3= document.createElement("input");

	form.action = "/matter/past";
	form.method = "post";

	input.type = "hidden";
	input.name = "list_id";
	input.value= id;

	input2.type  = "hidden";
	input2.name  = "flag";
	input2.value = "1";

	input3.type = "hidden";
	input3.name = "company_id";
	input3.value= company_id;

	form.appendChild(input);
	form.appendChild(input2);
	form.appendChild(input3);
	document.body.appendChild(form);
	form.submit();
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
<form action="update" method="post">
<br />
<table class="tableStyle6">
	<tr>
		<th>日付</th>
		<td colspan="3"><input type="text" name="date"  value="<?php echo $val['date']; ?>" size="6"></td>
	</tr>
	<tr>
		<th>記入者</th>
		<td colspan="3"><?php echo $val['user_name']; ?></td>
	</tr>
	<tr>
		<th>顧客会社名</th>
		<td colspan="2"><input type="text" id="one" disabled size="10" value="<?php echo $val["company_name"];?>"></td>
		<td>客種:<input type="text" id="two" disabled size="1" value="<?php echo $flg; ?>"></td>
	</tr>
	<tr>
		<th>要求フラグ</th>
		<td colspan="3">
			<select name="case">
				<?php
					foreach($select as $val2){
						echo "<option value='".$val2['case_id']."'>".$val2["name"]."</option>";
					}
				?>
			</select>
		</td>
	</tr>
	<tr>
		<th>対応者</th>
		<td colspan="3"><input type="text" name="user" value="<?php echo $val["respone_name"];?>" size="10"></td>
	</tr>
	<tr>
		<th>対応内容</th>
		<td colspan="3"><textarea name="detail"><?php echo $val["content_text"]; ?></textarea></td>
	</tr>

	<tr>
		<th>住所</th>
		<td colspan="3"><input type="text" id="three" disabled size="15" value="<?php echo $val["company_add"];?>"></td>
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
					<td><input type="text" id="four" disabled size="10" value="<?php echo $val["company_tel"];?>"></td>
					<td><input type="text" id="five" disabled size="10" value="<?php echo $val["company_mail"];?>"></td>
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
				<tr>
					<td><input type="text" id="six" disabled size="10" value="<?php echo $val["name"];?>"></td>
					<td><input type="text" id="seven" disabled size="10" value="<?php echo $val["tel"];?>"></td>
					<td><input type="text" id="eight" disabled size="10" value="<?php echo $val["mail"];?>"></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<th>特記事項</th>
		<td colspan="2"><textarea id="nine" disabled cols="20"><?php echo $val["special_text"]; ?></textarea></td>
		<td><a href="#" onclick=test(<?php echo $val["company_id"];?>)>履歴詳細はこちら</a></td>
	</tr>
</table>
<input type="hidden" id="ten" name="company_id" value="<?php echo $val["company_id"];?>">
<input type="hidden" name="matter_id" value="<?php echo $val["matter_id"]; ?>">
<input type="hidden" name="check" value="1">
<input type="hidden" name="list_id" value=<?php echo $list_id;?>>
<p class="btnSpace"><button type="submit" id="btnCrea"><img src="/assets/img/common/btn_update.png" alt="変更する" /></button></p>

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
