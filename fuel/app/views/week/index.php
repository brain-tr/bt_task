<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>顧客管理システム | 顧客一覧</title>
<link href="/assets/css/kcommon.css" rel="stylesheet" type="text/css" media="all" />
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
table {
    width: 500px;
    border-collapse:collapse;
}
table th {
    background: #EEEEEE;
}
table th,
table td {
    border: 1px solid grey;
    text-align: center;
    padding: 15px;
}
#create{
	margin-left:400px;
}

span#one{
	margin-left:220px;
}

span#two{
	margin-left:326px;
}

span#big{
	font-size:20px;
}
span#change{
	margin-left:20px;
}

span#change a,
span#change2 a{
	font-size:20px;;
}

span#change a,
span#change2 a,
span#com a{
	text-decoration:none;
}

span#com a{
	text-decoration:none;
}
span#com a{
	color:white;
}
#delbtn{
	margin-left:400px;
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
<input type="button" onClick="location.href='/matter/create'"  name="create" id="create" value="新規対応登録" style="WIDTH: 100px; HEIGHT: 40px"><br>
<span id="one">顧客会社検索</span>
<input type="text" value="<?php echo $msg; ?>"  size="10" disabled>
<input type="button" name="flg1" onClick="sear();" value="検索">
<form action="index" name="form1" method="post">
	<input type="hidden" id="search" name="search" value="">
	<input type="hidden" name="check1" value="1">
	<input type="hidden" name="cnt_week" value=<?php echo $cnt_week;?>>
</form>

<form action="index" name="form2" method="post">
	<span id="two">対応者検索</span>
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

<form action="index" name="form3" method="post">
<span id='big'>本日：</span>
<?php echo "<span id='big'>".$today."</span>"; ?><br />
<?php echo "<span id='big'>".$today1."</span>"; ?>～<?php echo "<span id='big'>".$today2."</span>"; ?>
<span id="change"><a href="#" onClick="weekchange(1);">先週</a></span>　
<span id="change2"><a href="#" onClick="weekchange(2);">翌週</a></span>　
<span id="change2"><a href="#">週</a></span>/
<span id="change2"><a href="../mlist">月</a></span>
<table>
	<tr>
		<th>日付</th>
		<th>会社 / 用件</th>
		<th>編集</th>
	</tr>
	<tr>
	<?php

		foreach($calendar as $key => $val){
			$cnt = 0;
			$cnt2 = 0;
			echo "<td>".$val["day"]."</td>";
			//0000-00-0型の日付を生成
			$comp = $year."-".$month."-".$val['day'];
			$cnt++;
			//会社名取り出し
			echo "<td>";
			foreach($company as $val2){
				$color = $val2["color_code"];
				//該当の日付と登録日が一致かつdateが空でなければ。
				if(strtotime($comp) == strtotime($val2["date"]) && !empty($val2["date"])){
					if($cnt2 > 0){
						echo "</td>";
						echo "<tr>";
						echo "<td></td>";
						echo "<td>";
					}
					echo "<span id='com'><a href='#' onClick='test(".$val2['matter_id'].");'  name='c_name' style='background-color:$color'>".$val2["company_name"]."</a></span><br>";
					echo "<td><input type='checkbox' name='del[]' value=".$val2['matter_id'].">";
					echo "　　　<input type='button' onClick='del2(".$val2["matter_id"].");' value='削除'></td>";
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
<input type="hidden" name="check4" value="1">
	<input type="hidden" name="cnt_week" value=<?php echo $cnt_week;?>>
<input type="button"  value="一括削除" id="delbtn" onClick="del();">
</form>

</div><!-- /content -->
</div><!-- /contentIn -->

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
