<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>顧客管理システム | 顧客情報登録</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
    <script src="https://ajaxzip3.googlecode.com/svn/trunk/ajaxzip3/ajaxzip3-https.js" charset="UTF-8"></script>
	
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
				var new_list2 ='<td><input type="text" name="t_name[]" size="8"></td><td><input type="text" name="t_tel[]" size="12"></td>';
				var new_list3 ='<td><input type="text" name="t_mail[]" size="25"></td><td><textarea name="t_remarks[]" cols="50"></textarea></td></tr>';
				$('#list').append(new_list,new_list2,new_list3);
		});
		$('#add3').click(function(){
			// 品目入力欄を追加
				var new_list = '<tr>';
				var new_list2 ='<td><input type="text" name="t_name3[]" size="8"></td><td><input type="text" name="t_tel3[]" size="12"></td>';
				var new_list3 ='<td><input type="text" name="t_mail3[]" size="25"></td><td><textarea name="t_remarks3[]" cols="50"></textarea></td></tr>';
				$('#list3').append(new_list,new_list2,new_list3);
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
<p id="big"><?php echo $msg; ?></p>
<form action="#" name="form1" id="form1" method="post">
<br>
<table class="tableStyle6">
	<tr>
		<th>客種</th>
		<td colspan='2'>
			<select name="flag">
				<option value="1" <?php if($flag == 1){echo "selected";};?>>エンドユーザ</option>
				<option value="2" <?php if($flag == 2){echo "selected";};?>>元請け</option>
				<option value="3" <?php if($flag == 3){echo "selected";};?>>二次請け</option>
				<option value="4" <?php if($flag == 4){echo "selected";};?>>BP（両方）</option>
				<option value="5" <?php if($flag == 5){echo "selected";};?>>BP（人材元）</option>
			</select>
			上場済み<input type="checkbox" name="listing_flag" value="1" <?php if($listing_flag == 1){echo "checked='checked'";};?>>
		</td>
	</tr>
	<tr>
		<th>顧客会社名</th>
		<td colspan='2'><input type="text" name="c_name" size="30" value="<?php echo $c_name;?>" ></td>
	</tr>
	<tr>
		<th>顧客会社住所</th>
		<td colspan='2'>
			<div class="container" ng-controller="CalendarCtrl">
				郵便番号：<input type="text" name="zip01" size="10" value="<?php echo $company_add_code;?>" maxlength="8" onKeyUp="AjaxZip3.zip2addr(this,'','addr11','addr11');">
				<p>住所:<input type="text" name="addr11" size="40" value="<?php echo $address;?>" >
			</div>
		</td>
	</tr>

	<tr>
		<th>資本金</th>
		<td colspan='2'><input type="text" name="capital" size="15" style="text-align:right" value="<?php echo $capital;?>" ></td>
	</tr>
	<tr>
		<th>従業員数</th>
		<td colspan='2'><input type="text" name="employees" size="15" style="text-align:right" value="<?php echo $employees;?>" ></td>
	</tr>
	<tr>
		<th>売上高</th>
		<td colspan='2'><input type="text" name="sales" size="15" style="text-align:right" value="<?php echo $sales;?>" ></td>
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
					<td><input type="text" name="tel"size="12" value="<?php echo $tel;?>" ></td>
					<td><input type="text" name="mail"size="25" value="<?php echo $mail;?>" ></td>
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
			<input type="button" name="any" value="追加" id="add3" ></th>
		<td colspan='2'>
		<table class="tableStyle" id="list3">
		<tr>
			<th>名前</th>
			<th>TEL</th>
			<th>Mail</th>
			<th>備考</th>
		</tr>
		<tr>
			<td><input type="text" name="t_name3[]"size="8" value="<?php if(!empty($t_name4)){echo $t_name4[0];};?>" ></td>
			<td><input type="text" name="t_tel3[]"size="12" value="<?php if(!empty($t_tel4)){echo $t_tel4[0];};?>" ></td>
			<td><input type="text" name="t_mail3[]"size="25" value="<?php if(!empty($t_mail4)){echo $t_mail4[0];};?>" ></td>
			<td><textarea name="t_remarks3[]" cols="50"><?php if(!empty($t_remarks4)){echo $t_remarks4[0];};?></textarea></td>
		</tr>
		<?php
		if(count($t_name4) > 1){
			foreach($t_name4 as $key2 => $val2){
				if($key2 != 0){
					echo "<tr>";
						echo "<td><input type='text' name='t_name3[]'size='8' value=".$t_name4[$key2]."></td>";
						echo "<td><input type='text' name='t_tel3[]'size='12' value=".$t_tel4[$key2]."></td>";
						echo "<td><input type='text' name='t_mail3[]'size='25' value=".$t_mail4[$key2]."></td>";
						echo "<td><textarea name='t_remarks3[]' cols='50'>".$t_remarks4[$key2]."</textarea></td>";
					echo "</tr>";
				}
			}
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
			<input type="button" name="any" value="追加" id="add" ></th>
		<td colspan='2'>
		<table class="tableStyle" id="list">
		<tr>
			<th>名前</th>
			<th>TEL</th>
			<th>Mail</th>
			<th>備考</th>
		</tr>
		<tr>
			<td><input type="text" name="t_name[]"size="8" value="<?php if(!empty($t_name2)){echo $t_name2[0];};?>" ></td>
			<td><input type="text" name="t_tel[]"size="12" value="<?php if(!empty($t_tel2)){echo $t_tel2[0];};?>" ></td>
			<td><input type="text" name="t_mail[]"size="25" value="<?php if(!empty($t_mail2)){echo $t_mail2[0];};?>" ></td>
			<td><textarea name="t_remarks[]" cols="50"><?php if(!empty($t_remarks2)){echo $t_remarks2[0];};?></textarea></td>
		</tr>
		<?php
		if(count($t_name2) > 1){
			foreach($t_name2 as $key2 => $val2){
				if($key2 != 0){
					echo "<tr>";
						echo "<td><input type='text' name='t_name[]'size='8' value=".$t_name2[$key2]."></td>";
						echo "<td><input type='text' name='t_tel[]'size='12' value=".$t_tel2[$key2]."></td>";
						echo "<td><input type='text' name='t_mail[]'size='25' value=".$t_mail2[$key2]."></td>";
						echo "<td><textarea name='t_remarks[]' cols='50'>".$t_remarks2[$key2]."</textarea></td>";
					echo "</tr>";
				}
			}
		}
		?>
		</table>
		</td>
	</tr>

	<tr>
		<th>弊社担当者</th>
		<td colspan='2'><input type="text" name="u_name"size="15" value="<?php echo $u_name;?>" ></td>
	</tr>
	<tr>
		<th>特記事項</th>
		<td colspan='2'><textarea name="special" cols="80"><?php echo $special;?></textarea>
	<tr>
</table>
<input type="hidden" name="check" value="1">
<p class="btnSpace"><button type="submit" id="btnCrea"><img src="/assets/img/common/btn_insert.png" alt="登録する" /></button></p>

</form>








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
