<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>顧客管理システム | 顧客一覧</title>
<link href="/assets/css/common.css" rel="stylesheet" type="text/css" media="all" />
<script type="text/javascript">
//変更用
function test(id){
	var form  = document.createElement("form");
	var input = document.createElement("input");
	var input2= document.createElement("input");

	form.action = "../matter/update";
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
//削除確認
function del(){
	if(window.confirm('一括削除を実行')){
		alert('削除しました');
		document.form4.submit();
	}
}
//単体削除用
function del2(matter_id){
	if(window.confirm('削除しますか')){
		alert('削除しました');
		var submitType = document.createElement("input");
		submitType.setAttribute("name", "delete");
		submitType.setAttribute("type", "hidden");
		submitType.setAttribute("value", matter_id);
		form3.appendChild(submitType);
		document.form4.submit();
	}
}
//会社名検索用
function sear(){
	window.open("/mlist/csearch","window","width=400,height=400,scrollbars=yes");
}
//先週翌週表示
function weekchange(check){
	document.form3.check4.value = check;
	document.form3.submit();
}
</script>

<style type="text/css">
table.tableStylex tr,th,td{
	padding:15px;
	text-align:center;
    border: 1px solid #999;
	text-decoration:none;
}
table.tableStylex th {
    border-bottom: 1px solid #999;
    background-color: #FFE8EE;
    vertical-align: middle;
    text-align: center;
}
table.tableStylex th.w80 {
	width:80px;
}
table.tableStylex {
	border-collapse: collapse;
	border: 2px solid #999;
	width: 800px;
}
span#big {
	font-size:18px;
}
div#resize {
	width:800px;
}
div.floatbtnL {
	float:left;
}
div.floatbtnR {
	float:right;
}
.change a{
	font-size:18px;
	text-decoration:none;
}
span#com a{
	text-decoration:none;
    color: #000;
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
<h2>対応一覧</h2>

<div id="resize">

<div class="floatbtnR">
	<input type="button" onClick="location.href='/matter/create'"  name="create" id="create" value="新規対応登録" style="WIDTH: 180px; HEIGHT: 50px">
</div><!-- /floatbtnR -->

<div class="floatbtnL mB30">
	<div class="floatbtnL mR20">
	<form action="/week/index" name="form1" method="post" class="formstyle1">
		顧客会社検索
		<input type="text" value="<?php echo $msg; ?>"  style="width:180px;" disabled>
		<input type="button" name="flg1" onClick="sear();" value="検索">
		<input type="hidden" id="search" name="search" value="">
		<input type="hidden" name="check1" value="1">
		<input type="hidden" name="cnt_week" value=<?php echo $cnt_week;?>>
	</form>
	</div><!-- /floatbtnL -->

<div class="floatbtnL">
	<form action="/week/index" name="form2" method="post">
		対応者検索
		<select name="respon">
			<option>----</option>
			<?php
				foreach($respon as $key3=> $val3){
					echo "<option value='".$val3['respone_name']."'>".$val3["respone_name"]."</option>";
				}
			?>
		</select>
		<input type="hidden" name="check2" value="1">
		<input type="submit" name="flg2" value="検索">
		<input type="hidden" name="cnt_week" value=<?php echo $cnt_week;?>>
	</form>
	</div><!-- /floatbtnL -->
	<div class="clear"></div>
</div><!-- /floatbtnL -->

<div class="clear">
<form action="/week/index" name="form3" method="post">
	<?php echo "<span id='big'>本日：".$today."</span>"; ?>
	<div class="floatbtnR change">
		<a href="#" onClick="weekchange(1);">先週</a>/
		<a href="/week">今週</a>/
		<a href="#" onClick="weekchange(2);">翌週</a>
	</div>
	<?php echo "<br /><span id='big'>".$today1."</span>"; ?>～<?php echo "<span id='big'>".$today2."</span>"; ?>
	<div class="floatbtnR change">
		<a href="/week">週</a>/
		<a href="/mlist">月</a>
	</div>
	<input type="hidden" name="cnt_week" value=<?php echo $cnt_week;?>>
	<input type="hidden" name="check4" value="1">
</form>

<form action="/week/index" name="form4" method="post">
<table class="tableStylex mB30">
	<tr>
		<th class="w80">日付</th>
		<th>会社 / 用件</th>
		<th>編集</th>
	</tr>
	<tr>
	<?php

		foreach($calendar as $key => $val){
			$cnt = 0;
			$cnt2 = 0;
			echo "<td>".$val["day"]."</td>";
			$cnt++;
			//会社名取り出し
			echo "<td>";
			foreach($company as $val2){
				$color = $val2["color_code"];
				//該当の日付と登録日が一致かつdateが空でなければ。
				if(strtotime($calendar2["$key"]) == strtotime($val2["date"]) && !empty($val2["date"])){
					if($cnt2 > 0){
						echo "</td>";
						echo "<tr>";
						echo "<td></td>";
						echo "<td>";
					}
					echo "<span id='com'><a href='#' onClick='test(".$val2['matter_id'].");'  name='c_name' style='background-color:$color'>".$val2["company_name"]."</a></span><br></td>";
					echo "<td><input type='checkbox' name='del[]' value=".$val2['matter_id'].">";
					echo "　　　<input type='button' onClick='del2(".$val2["matter_id"].");' value='削除' style='WIDTH: 50px; HEIGHT: 35px'>";
					$cnt2 += 1;
				}
			}
			if($cnt2 == 0){
				echo "<td></td>";
			}
			echo "</td></tr>";

		}
	?>
</table>
<input type="hidden" name="check3" value="1">
<p class="c"><input type="button"  value="一括削除" id="delbtn" onClick="del();" style='WIDTH: 180px; HEIGHT: 45px'></p>
</form>

</div><!-- /clear -->
</div><!-- /resize -->
</div><!-- /contentIn -->
</div><!-- /content -->

<?php
	// サイドメニューの読み込み
	require_once(dirname(__FILE__)."/../side.php");
?>

<div class="clear"></div>
</div><!-- /main -->

</body>
</html>
