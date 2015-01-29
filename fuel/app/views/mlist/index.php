<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>顧客管理システム | 顧客一覧</title>
<link href="/assets/css/kcommon.css" rel="stylesheet" type="text/css" media="all" />
<script type="text/javascript">
month	= "<?php echo $month; ?>";
year	= "<?php echo $year; ?>";
//変更用
function test(id){
	var form  = document.createElement("form");
	var input = document.createElement("input");
	var input2= document.createElement("input");

	form.action = "matter/update";
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

function sear(){
	window.open("/mlist/csearch","window","width=400,height=400,scrollbars=yes");
}
//先月翌月表示
function weekchange(check){
	document.form3.check4.value = check;
	document.form3.submit();
}
//日表示
function daychange(day){
	var form  = document.createElement("form");
	var input = document.createElement("input");
	var input2= document.createElement("input");
	var input3= document.createElement("input");
	var input4= document.createElement("input");

	form.action = "matter/day";
	form.method = "post";

	input.type = "hidden";
	input.name = "day";
	input.value= day;

	input2.type  = "hidden";
	input2.name  = "check2";
	input2.value = "1";

	input3.type = "hidden";
	input3.name = "month";
	input3.value= month;

	input4.type = "hidden";
	input4.name = "year";
	input4.value= year;

	form.appendChild(input);
	form.appendChild(input2);
	form.appendChild(input3);
	form.appendChild(input4);
	document.body.appendChild(form);
	form.submit();
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
    font-weight: bold;
    border-bottom: 1px solid #999;
    background-color: #FFE8EE;
    color: #666;
    vertical-align: middle;
    text-align: center;
}
table.tableStylex {
	border-collapse: collapse;
	border: 2px solid #999;
	width: 700px;
}
span#big {
	font-size:20px;
}
div#resize {
	width:700px;
}
div.floatbtn {
	margin-left:300px;
	float:right;
}
.change a{
	font-size:20px;
	text-decoration:none;
}
span#com a{
	text-decoration:none;
    color: #000;
}
span#com2 a{
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
<div id="resize">
<div class="floatbtn">
	<input type="button" onClick="location.href='/matter/create'"  name="create" value="新規対応登録" style="WIDTH: 100px; HEIGHT: 40px">
</div>
<div class="floatbtn">
	顧客会社検索
	<input type="text" value="<?php echo $msg; ?>"  size="10" disabled>
	<input type="button" name="flg1" onClick="sear();" value="検索">
	<form action="mlist" name="form1" method="post">
		<input type="hidden" id="search" name="search" value="">
		<input type="hidden" name="check1" value="1">
		<input type="hidden" name="check4" value=3>
		<input type="hidden" name="cnt_week" value=<?php echo $cnt_week;?>>
	</form>
</div>
<div class="floatbtn">
	<form action="mlist" name="form2" method="post">
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
		<input type="hidden" name="check4" value=3>
		<input type="submit" name="flg2" value="検索">
		<input type="hidden" name="cnt_week" value=<?php echo $cnt_week;?>>
	</form>
</div>

<div  class="clear">
<form action="mlist" name="form3" method="post">
	<?php echo "<span id='big'>本日：".$today."</span>"; ?>
	<div class="floatbtn change">
		<a href="#" onClick="weekchange(1);">先月</a>/
		<a href="/mlist">今月</a>/
		<a href="#" onClick="weekchange(2);">翌月</a>
	</div>
	<br />
	<?php echo "<span id='big'>".$year."年".$month."月</span>"; ?>
	<div class="floatbtn change">
		<a href="/week">週</a>/
		<a href="/mlist">月</a>
	</div>
	<input type="hidden" name="check4" value="1">
	<input type="hidden" name="cnt_week" value=<?php echo $cnt_week;?>>
</form>
<table class="tableStylex">
	<tr>
		<th>日</th>
		<th>月</th>
		<th>火</th>
		<th>水</th>
		<th>木</th>
		<th>金</th>
		<th>土</th>
	</tr>
	<tr>
	<?php
		$cnt = 0;
		foreach($calendar as $key => $val){
			echo "<td><span id='com2'><a href='#' onClick='daychange(".$val["day"].");'>".$val["day"]."</a></span><br>";
			//日付を生成
			$comp = $year."-".$month."-".$val['day'];
			$cnt++;
			//検索が行われたら
			if($check1 == 1 || $check2 == 1){
				//会社名取り出し
				foreach($company as $val2){
					$color = $val2["color_code"];
					//該当の日付と登録日が一致かつdateが空でなければ。
					if(strtotime($comp) == strtotime($val2["date"]) && !empty($val2["date"])){
						echo "<span id='com'><a href='#' onClick='test(".$val2['matter_id'].");'  name='c_name' style='background-color:$color'>".$val2["company_name"]."</a></span><br>";
					}
				}
			}
			if($cnt == 7){
				echo "</div></td></tr>";
				$cnt = 0;
			}
		}
	?>
</table>
</div><!-- /clear -->

</div><!-- /resize -->
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
</html>
