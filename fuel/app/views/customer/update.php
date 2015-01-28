<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>顧客管理システム | 顧客情報登録</title>
<link href="/assets/css/kcommon.css" rel="stylesheet" type="text/css" media="all" />
<script type="text/javascript" src="/assets/js/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="/assets/js/jquery-ui.min.js"></script>
<script type="text/javascript">
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
	$selected2 = "";
	$selected3 = "";
	foreach($company as $key => $val){
		if($val["c_flag"]==1){
			$selected1 = "selected";
		}else if($val["c_flag"]==2){
			$selected2 = "selected";
		}else if($val["c_flag"] == 3){
			$selected3 = "selected";
		}
?>
<form action="#" name="form1" id="form1" method="post">

<br>
<table class="tableStyle6">
	<tr>
		<th>客主</th>
		<td colspan='2'>
			<select name="flag">
			<?php
				echo "<option value='1' $selected1>案件</option>";
				echo "<option value='2' $selected2>人材</option>";
				echo "<option value='3' $selected3>両方</option>";
			?>
			</select>
		</td>
	<tr>
	<tr>
		<th>顧客会社名</th>
		<td colspan='2'><input type="text" name="c_name" size="15" value="<?php echo $val["company_name"];?>"></td>
	<tr>
	<tr>
		<th>顧客会社住所</th>
		<td colspan='2'><input type="text" name="address"size="15" value="<?php echo $val["company_add"]; ?>"></td>
	<tr>
	<tr>
		<th>
			顧客会社<br/>
			詳細情報
		</th>
		<td colspan='2'>
			<table class="tableStyle">
				<tr>
					<th>TEL(請求担当)</th>
					<th>Mail(請求担当)</th>
				</tr>
				<tr>
					<td><input type="text" name="tel"size="10" value="<?php echo $val["company_tel"]; ?>"></td>
					<td><input type="text" name="mail"size="10" value="<?php echo $val["company_mail"]; ?>"></td>
				</tr>
			</table>
		</td>
	</tr>

	<tr>
		<th>
			<span id="thbtn">
				顧客担当者<br />
				詳細情報<br />
			</span>
			<input type="button" name="any" value="追加" id="add"></th>
		<td colspan='2'>
		<table class="tableStyle" id="list">
		<tr>
			<th>顧客担当者名</th>
			<th>TEL(顧客担当者)</th>
			<th>Mail(顧客担当者)</th>
		</tr>
		<?php
		foreach($customer as $key2 => $val2){
			echo "<tr>";
				echo "<td><input type='text' name='t_name[]'size='8' value=".$val2["name"]."></td>";
				echo "<td><input type='text' name='t_tel[]'size='8' value=".$val2["tel"]."></td>";
				echo "<td><input type='text' name='t_mail[]'size='8' value=".$val2["mail"]."></td>";
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
