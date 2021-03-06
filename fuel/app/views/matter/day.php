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

	form.action = "update";
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
//会社検索
function sear(){
	window.open("/mlist/csearch","window","width=400,height=400,scrollbars=yes");
}
//削除確認
function del(){
	if(window.confirm('一括削除を実行')){
		alert('削除しました');
		document.form3.submit();
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
		document.form3.submit();
	}
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
table.tableStylex {
	border-collapse: collapse;
	border: 2px solid #999;
	width:800px;
}
span#big{
	font-size:18px;
}
span#com a{
	text-decoration:none;
	color: #000;
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
d
div.floatbtn {
	margin-left:300px;
	float:right;
}
.change a{
	font-size:18px;
	text-decoration:none;
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
	<input type="button" onClick="location.href='/matter/create'"  name="create" id="create" value="新規対応登録" style="WIDTH: 180px; HEIGHT: 50px"><br>
</div>

<div class="floatbtnL mB30">
	<div class="floatbtnL mR20">
		<form action="day" name="form1" method="post">
			顧客会社検索
			<input type="text" value="<?php echo $msg; ?>" style="width:180px;" disabled>
			<input type="button" name="flg1" onClick="sear();" value="検索">
			<input type="hidden" id="search" name="search" value="">
			<input type="hidden" name="check1" value="1">
			<input type="hidden" name="searchday" value=<?php echo $searchday;?>>
			<input type="hidden" name="today" value=<?php echo $today;?>>
			<input type="hidden" name="day" value=<?php echo $day;?>>
		</form>
	</div><!-- /floatbtnL -->

	<div class="floatbtnL">
	<form action="day" name="form2" method="post">
		対応者検索
		<select name="person">
			<option>----</option>
			<?php
				foreach($respon as $key3=> $val3){
					echo "<option value='".$val3['respone_name']."'>".$val3["respone_name"]."</option>";
				}
			?>
		</select>
		<input type="hidden" name="check1" value="2">
		<input type="hidden" name="searchday" value=<?php echo $searchday;?>>
		<input type="hidden" name="today" value=<?php echo $today;?>>
		<input type="hidden" name="day" value=<?php echo $day;?>>
		<input type="submit" name="flg2" value="検索">
	</form>
	</div><!-- /floatbtnL -->
	<div class="clear"></div>
</div><!-- /floatbtnL -->

<div  class="clear">
	<?php echo "<span id='big'>".$today."</span>"; ?>
	<div class="floatbtnR change">
		<a href="/week">週</a>/
		<a href="/mlist">月</a>
	</div>
	<form action="day" name="form3" method="post">
		<table class="tableStylex mB30">
			<tr>
				<th>日付</th>
				<th>会社 / 用件</th>
				<th>編集</th>
			</tr>
			<tr>
			<?php
				foreach($company as $key => $val){
					$color = $val["color_code"];
					echo "<tr>";
					//最初の欄だけ日付入力
					if($key == 0){
						echo "<td>".$day."日</td>";
					}else{
						echo "<td></td>";
					}
					//会社名入力
					echo "<td><span id='com'><a href='#' onClick='test(".$val['matter_id'].");'  name='c_name' style='background-color:$color'>".$val["company_name"]."</a></td>";
					echo "<td><input type='checkbox' name='del[]' value=".$val['matter_id'].">";
					echo "　　　<input type='button' onClick='del2(".$val["matter_id"].");' value='削除' style='WIDTH: 45px; HEIGHT: 30px'></td>";
					echo "</tr>";
				}
			?>
		</table>
	<input type="hidden" name="check3" value="1">
	<input type="hidden" name="searchday" value=<?php echo $searchday;?>>
	<input type="hidden" name="today" value=<?php echo $today;?>>
	<input type="hidden" name="day" value=<?php echo $day;?>>
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
