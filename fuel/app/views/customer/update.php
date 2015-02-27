<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>顧客管理システム | 顧客情報登録</title>
<link href="/assets/css/kcommon.css" rel="stylesheet" type="text/css" media="all" />
<script type="text/javascript" src="/assets/js/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="/assets/js/jquery-ui.min.js"></script>
<script type="text/javascript">
msgcheck	= "<?php echo $msgcheck; ?>";
$(function(){
	// "品目の追加"ボタンを押した場合の処理
	$('#add').click(function(){
		// 品目入力欄を追加
			var new_list = '<tr>';
			var new_list2 ='<td><input type="text" name="t_name[]" size="8"></td><td><input type="text" name="t_tel[]" size="8"></td>';
			var new_list3 ='<td><input type="text" name="t_mail[]" size="8"></td></tr>';
			$('#list').append(new_list,new_list2,new_list3);

	});
});
// アラートメッセージ
if(msgcheck != "1"){
	alert(msgcheck);
}

</script>
<style type="text/css">
p#big{
	font-size:30px;
	color:red;
}
#content table.tableStyle {
    border: 1px solid #999;
}
#thbtn {
	float:left;
}
#add {
	float:right;
	margin-right:15px;
}
#content table.tableStyle6 {
	width:700px;
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
	$listing_select = "";
	$selected1 = "";
	$selected2 = "";
	$selected3 = "";
	$selected4 = "";
	$selected5 = "";
	foreach($company as $key => $val){
		if($val["listing_flag"]==1){
			$listing_select = "checked='checked'";
		}
	
		if($val["c_flag"]==1){
			$selected1 = "selected";
		}else if($val["c_flag"]==2){
			$selected2 = "selected";
		}else if($val["c_flag"] == 3){
			$selected3 = "selected";
		}else if($val["c_flag"] == 4){
			$selected4 = "selected";
		}else if($val["c_flag"] == 5){
			$selected5 = "selected";
		}
?>
<form action="#" name="form1" id="form1" method="post">
<p id="big"><?php echo $msg; ?></p><br />
<table class="tableStyle6">
	<tr>
		<th>客主</th>
		<td colspan='2'>
			<select name="flag">
			<?php
				echo "<option value='1' $selected1>エンドユーザ</option>";
				echo "<option value='2' $selected2>元請け</option>";
				echo "<option value='3' $selected3>二次請け</option>";
				echo "<option value='4' $selected4>BP（両方）</option>";
				echo "<option value='5' $selected5>BP（人材元）</option>";
			?>
			</select>
			<?php
				echo "上場済み<input type='checkbox' name='listing_flag' value='1' $listing_select>";
			?>
		</td>
	<tr>
	<tr>
		<th>顧客会社名</th>
		<td colspan='2'><input type="text" name="c_name" size="30" value="<?php echo $val["company_name"];?>"></td>
	<tr>
	<tr>
		<th>顧客会社住所</th>
		<td colspan='2'>
			<div class="container" ng-controller="CalendarCtrl">
				郵便番号：<input type="text" name="zip01" size="10" value="<?php echo $val["company_add_code"];?>" maxlength="8" onKeyUp="AjaxZip3.zip2addr(this,'','addr11','addr11');">
				<p>住所:<input type="text" name="addr11" size="40" value="<?php echo $val["company_add"]; ?>" >
			</div>
		</td>
	<tr>

	<tr>
		<th>資本金</th>
		<td colspan='2'><input type="text" name="capital" size="15" style="text-align:right" value="<?php echo $val["capital"];?>" ></td>
	</tr>
	<tr>
		<th>従業員数</th>
		<td colspan='2'><input type="text" name="employees" size="15" style="text-align:right" value="<?php echo $val["employees"];?>" ></td>
	</tr>
	<tr>
		<th>売上高</th>
		<td colspan='2'><input type="text" name="sales" size="15" style="text-align:right" value="<?php echo $val["sales"];?>" ></td>
	</tr>

	<tr>
		<th>
			顧客会社<br/>
			詳細情報
		</th>
		<td colspan='2'>
			<table class="tableStyle">
				<tr>
					<th>TEL</th>
					<th>Mail</th>
				</tr>
				<tr>
					<td><input type="text" name="tel"size="12" value="<?php echo $val["company_tel"]; ?>"></td>
					<td><input type="text" name="mail"size="25" value="<?php echo $val["company_mail"]; ?>"></td>
				</tr>
			</table>
		</td>
	</tr>

	<tr>
		<th>
			<span id="thbtn">
				請求担当者<br />
				<br />
			</span>
			<input type="button" name="any" value="追加" id="add"></th>
		<td colspan='2'>
		<table class="tableStyle" id="list">
		<tr>
			<th>名前</th>
			<th>TEL</th>
			<th>Mail</th>
			<th>備考</th>
		</tr>
		<?php
		foreach($claim as $key2 => $val2){
			echo "<tr>";
				echo "<td><input type='text' name='t_name4[]'size='8' value=".$val2["name"]."></td>";
				echo "<td><input type='text' name='t_tel4[]'size='12' value=".$val2["tel"]."></td>";
				echo "<td><input type='text' name='t_mail4[]'size='25' value=".$val2["mail"]."></td>";
				echo "<td><textarea name='t_remarks4[]' cols='50'>".$val2["remarks"]."</textarea></td>";
			echo "</tr>";
		}
		?>
		</table>
		</td>
	</tr>

	<tr>
		<th>
			<span id="thbtn">
				担当者<br />
				<br />
			</span>
			<input type="button" name="any" value="追加" id="add"></th>
		<td colspan='2'>
		<table class="tableStyle" id="list">
		<tr>
			<th>名前</th>
			<th>TEL</th>
			<th>Mail</th>
			<th>備考</th>
		</tr>
		<?php
		foreach($customer as $key2 => $val2){
			echo "<tr>";
				echo "<td><input type='text' name='t_name[]'size='8' value=".$val2["name"]."></td>";
				echo "<td><input type='text' name='t_tel[]'size='12' value=".$val2["tel"]."></td>";
				echo "<td><input type='text' name='t_mail[]'size='25' value=".$val2["mail"]."></td>";
				echo "<td><textarea name='t_remarks[]' cols='50'>".$val2["remarks"]."</textarea></td>";
			echo "</tr>";
		}
		?>
		</table>
		</td>
	</tr>
	<tr>
		<th>弊社担当者</th>
		<td colspan='2'><input type="text" name="u_name"size="15" value="<?php echo $val["user_name"]; ?>"></td>
	</tr>
	<tr>
		<th>特記事項</th>
		<td colspan='2'><textarea name="special" cols="20"><?php echo $val["special_text"]; ?></textarea>
	<tr>
</table>
<input type="hidden" name="check" value="2">
<input type="hidden" name="company_id" value="<?php echo $val["company_id"]; ?>">
<p class="btnSpace"><button type="submit" id="btnCrea"><img src="/assets/img/common/btn_update.png" alt="変更する" /></button></p>

</form>



<?php }?>





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
