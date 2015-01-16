<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>顧客管理システム | 顧客情報登録</title>
<link href="/assets/css/kcommon.css" rel="stylesheet" type="text/css" media="all" />
<script type="text/javascript" src="/assets/js/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="/assets/js/jquery-ui.min.js"></script>
<script type="text/javascript">
var counter = 0;
$(function(){
		// "品目の追加"ボタンを押した場合の処理
		$('#add').click(function(){
			counter++;
			// 品目入力欄を追加
			if(counter ==1){
				var new_list = '<br><br><br>';
				var new_list2 ='<li>顧客担当者名<br><input type="text" name="t_name[]" size="8"></li><li>TEL(顧客担当者)<br><input type="text" name="t_tel[]" size="8"></li>';
				var new_list3 ='<li>Mail(顧客担当者)<br><input type="text" name="t_mail[]" size="8"></li>';
				$('#list').append(new_list,new_list2,new_list3);
			}else{
				var new_list = '<br><br>';
				var new_list2 ='<li><input type="text" name="t_name[]" size="8"></li><li><input type="text" name="t_tel[]" size="8"></li>';
				var new_list3 ='<li><input type="text" name="t_mail[]" size="8"></li>';
				$('#list').append(new_list,new_list2,new_list3);
			}

		});
});

</script>
<style type="text/css">
ul#list li{
	margin-left:5px;
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
<table>
	<tr>
		<th>客主</th>
		<td>
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
		<th>顧客会社名></th>
		<td><input type="text" name="c_name" size="20" value="<?php echo $val["company_name"];?>"></td>
	<tr>
	<tr>
		<th>顧客会社住所</th>
		<td><input type="text" name="address"size="20" value="<?php echo $val["company_add"]; ?>"></td>
	<tr>
	<tr>
		<th>TEL(請求担当)</th>
		<td><input type="text" name="tel"size="10" value="<?php echo $val["company_tel"]; ?>"></td>
		<th>Mail(請求担当)</th>
		<td><input type="text" name="mail"size="10" value="<?php echo $val["company_mail"]; ?>"></td>

	</tr>


	<?php
		foreach($customer as $key2 => $val2){
			echo "<tr>";
				echo "<td>顧客担当者名</td>";
				echo "<td><input type='text' name='t_name[]'size='20' value=".$val2["name"]."></td>";
			echo "</tr>";



			echo "<tr>";
				echo "<th>TEL(顧客担当者)</th>";
				echo "<td><input type='text' name='t_tel[]'size='10' value=".$val2["tel"]."></td>";
				echo "<th>Mail(顧客担当者)</th>";
				echo "<td><input type='text' name='t_mail[]'size='10' value=".$val2["mail"]."></td>";
			echo "</tr>";
		}
	?>
	<tr>
		<th><input type="button" name="any" value="追加" id="add"></th>
		<td class="wid">
			<ul id="list">
			</ul>
		</td>

	</tr>
	<tr>
		<th>弊社担当者</th>
		<td><input type="text" name="u_name"size="15" value="<?php echo $val["user_name"]; ?>"></td>
	</tr>
	<tr>
		<th>特記事項</th>
		<td><textarea name="special" cols="14"><?php echo $val["special_text"]; ?></textarea>
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
		<li><a href="#">要求一覧</a></li>
		<li><a href="#">対応一覧</a></li>
	</ul>
</div>
<div class="clear"></div>
</div><!-- /main -->

</body>
<html>
