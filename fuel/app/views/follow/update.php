<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>エンジニア対応管理システム | フォロー報告</title>
<link href="/assets/css/common.css" rel="stylesheet" type="text/css" media="all" />
<script type="text/javascript">
	msgcheck = "<?php echo $msg; ?>";

	// 削除の確認
	function followDelete(){
		deleteMsg = "この内容を削除しますか？";
		if(confirm(deleteMsg)){
			var submitType = document.createElement("input");
			submitType.setAttribute("name", "result");
			submitType.setAttribute("type", "hidden");
			submitType.setAttribute("value", "2");
			form.appendChild(submitType);

			form.method = "post";
			form.submit();
		}
	}

	// メッセージ表示
	if(msgcheck != "1"){
		alert(msgcheck);
	}

	// 更新者履歴の確認
	function disp(follow_id){
		var follow_id = follow_id;
		window.open('/follow/check?id=' + follow_id , "id", "width=450,height=450,scrollbars=yes");
	}
</script>
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
// 	var_dump($follow_data);
// 	exit;
	foreach ($follow_data as $val){
	$disabled = "";
	$end_msg  = "";
	if($val["end_date"]!='0000-00-00'){
		$disabled = "disabled";
		$end_msg = '<br />このフォロー情報は終了しました';
	}
 	echo "<p class='alert' style='color:#d64040; font-size:22px; font-weight:bold;'>".$end_msg."</p>";
 ?>
<h2>フォロー報告の変更</h2>

<form action="/follow/update" method="post" id="form1" name="form">
<table class="tableStyle3 mB20">
	<tr>
		<th>報告者</th>
		<td colspan="3"><?php echo $val['create_name']; ?>　<a onclick="disp(<?php echo "'".$val['follow_id']."'"; ?>)" href="#">更新履歴</a></td>
	</tr>
	<tr>
		<th>発生日/終了日</th>
		<td><?php echo $val['start_date']; ?>　/
		<?php
			if($val['end_date']!='0000-00-00'){
				echo $val['end_date'];
			}
		?>

		</td>
		<th>エンジニア名</th>

		<td><?php echo $val['engineer_name']; ?></td>
	</tr>
	<tr>
		<th>状況フラグ</th>
		<td><?php echo $val['situation_name']; ?></td>
		<th>対応方式</th>
		<td><?php echo $val['appointment_name']; ?></td>
	</tr>
	<tr>
		<th>案件内容</th>
		<td  colspan="3">
			<textarea name="project_text" rows="4" cols="35" <?php echo empty($follow_detail_id) ? "": "disabled" ?>><?php echo $val['project_text']; ?></textarea>
		</td>
	</tr>
	<tr>
		<th>面談内容・トラブル・<br />懸案事項</th>
		<td  colspan="3">
			<textarea name="content_text" rows="4" cols="35" <?php echo empty($follow_detail_id) ? "": "disabled" ?>><?php echo $val['content_text']; ?></textarea>
		</td>
	</tr>
	<tr>
		<th>その他連絡事項<br />（増員情報等）</th>
		<td  colspan="3">
			<textarea name="remarks" rows="4" cols="35" <?php echo empty($follow_detail_id) ? "": "disabled" ?>><?php echo $val['remarks']; ?></textarea>
		</td>
	</tr>
	</table>
	<?php if(empty($follow_detail_id)) {?>
		<p class="c" style="width:850px;"><input type="submit" class="btnSpace mB50" name="result" value="変更する" style="WIDTH: 200px; HEIGHT: 50px">　
		<input type="button" class="btnSpace mB50" name="result" value="削除する" onClick="followDelete()" style="WIDTH: 200px; HEIGHT: 50px"></p>

	<?php } ?>
	<input type="hidden" name="follow_id" id="follow_id" value="<?php echo $follow_id; ?>" />
	<input type="hidden" name="create_user_id" value="<?php echo $val["create_user_id"]; ?>">
	</form>

	<?php
	if(empty($disabled)){
		if(!empty($follow_detail_up_data)){
			echo '<form action="/follow/update" method="post" id="form3">';
			echo '<table class="tableStyle3 mB50">';
			echo '<tr><td colspan="4">フォロー詳細内容の変更</td></tr>';
			echo '<tr>';

			echo '<th class="bgP">日付</th>';
			echo '<td colspan="2" style="border-right:none;">'.$follow_detail_up_data['detail_date'].'</td>';
			echo '<td style="border-left:none;"><input type="submit" name="detail_up"value="変更" '.$disabled.' />　<input type="button" name="detail_del" value="削除" '.$disabled.' onClick="followDelete()" /></td>';
			echo '</tr><tr>';

			// 状況フラグ
			echo '<th class="bgP">状況フラグ</th>';
			echo '<td>';

			if(!empty($situation_list)) {
				echo '<select id="situation_id2" name="situation_id2">';
				foreach($situation_list as $val2) {

					// 選択項目の設定
					if($follow_detail_up_data['situation_id'] == $val2['situation_id']){
						$selected = "selected";
					} else {
						$selected = "";
					}
					echo '<option value="'.$val2['situation_id'].'" '.$selected.''.$disabled.'>'.$val2['name'].'</option>';
					}
					echo '</select>';
				} else {
					echo "状況フラグが登録されていません。";
			}
			echo '</td>';


			// 対応方式
			echo '<th class="bgP">対応方式</th>';
			echo '<td>';

			if(!empty($appointment_list)) {
				echo '<select id="appointment_id2" name="appointment_id2">';
				foreach($appointment_list as $val2){

					// 選択項目の設定
					if($follow_detail_up_data['appointment_id'] == $val2['appointment_id']) {
						$selected = "selected";
					} else {
						$selected = "";
					}
					echo '<option value="'.$val2['appointment_id'].'" '.$selected.''.$disabled.'>'.$val2['name'].'</option>';
				}
				echo '</select>';
			} else {
				echo "対応方式が登録されていません。";
			}
			echo '</td></tr><tr>';
			echo '<th class="bgP">フォロー詳細内容</th>';
			echo '<td colspan="3"><textarea '.$disabled.' id ="remarks3" name="remarks3" rows="4" cols="35">'.$follow_detail_up_data['remarks'].'</textarea></td>';

		echo '</tr></table>';
		echo '<input type="hidden" name="create_user_id" value="'.$val['create_user_id'].'" />';
		echo '<input type="hidden" name="follow_detail_id" value="'.$follow_detail_up_data['id'].'" />';
		echo '<input type="hidden" name="follow_id" value="'.$follow_id.'" />';
		echo '<input type="hidden" name="detail_date" value="'.$follow_detail_up_data['detail_date'].'" /></form>';
		}
	}?>

	<table class="tableStyle3 mB50">
	<tr><td colspan="4"><p class="lg18 mT10 mB10">フォロー詳細内容の一覧</p></td></tr>
	<?php
		if(!empty($follow_detail_data)){
			foreach($follow_detail_data as $val2){
				if(empty($val2['del_flag'])) {
					echo '<tr><td class="bgG" colspan="4">発生日：'.$val2['detail_date']."</td></tr>\r\n";
					echo '<tr><th>状況フラグ </th><td>'.$val2['situation_name'].'</td><th>対応方式 </th><td>'.$val2['appointment_name']."</td></tr>\r\n";
					echo '<tr><th>フォロー詳細内容</th><td colspan="3">'.$val2['remarks']."</td></tr>\r\n";
				}
			}
		} else {
			echo '<tr><td colspan="4">フォロー詳細内容は登録されていません</td></tr>';
	}
	?>
	</table>

	<!-- 対応内容 -->
	<form action="/follow/update" method="post" id="form2">
	<table class="tableStyle3 mB50">
		<tr>
			<td colspan="3"><p class="lg18">フォロー詳細内容の登録</p></td>
			<td style="border-left:none;"><button type="submit" id="btnCrea" <?php echo $disabled; ?>><img src="/assets/img/common/btn_insert2.png" alt="登録する"  width="100px"/></button></td>
		</tr>
		<tr>
			<th class="bgP">日付</th>
			<td colspan="3" style="border-right:none;"><input type="text" id="detail_date" name="detail_date" value="<?php echo date("Y-m-d") ; ?>" size="15" <?php echo $disabled; ?>/></td>
		</tr>

		<tr>
			<th class="bgP">状況フラグ</th>
			<td><?php
					if(!empty($situation_list)) {
						echo '<select id="situation_id" name="situation_id">';
						foreach($situation_list as $val2) {
							echo '<option value="'.$val2['situation_id'].'" '.$disabled.'>'.$val2['name'].'</option>';

						}
						echo '</select>';
					} else {
						echo "状況フラグが登録されていません。";
					}
				?>
			</td>
			<th class="bgP">対応方式</th>
			<td><?php
				if(!empty($appointment_list)) {
					echo '<select id="appointment_id" name="appointment_id">';
					foreach($appointment_list as $val2){
						echo '<option value="'.$val2['appointment_id'].'" '.$disabled.'>'.$val2['name'].'</option>';
					}
					echo '</select>';
				} else {
					echo "対応方式が登録されていません。";
				}
				?>

			</td>
		</tr>
		<tr>
		</tr>
		<tr>
			<th class="bgP">フォロー詳細内容</th>
			<td colspan="3"><textarea <?php echo $disabled; ?> id ="remarks2" name="remarks2" rows="4" cols="35" ></textarea></td>
		</tr>
	</table>

	<input type="hidden" name="follow_id" value="<?php echo $follow_id; ?>" />
	<input type="hidden" name="start_date" value="<?php //echo $val['start_date']; ?>" />
	<input type="hidden" name="result" value="3" />
	<input type="hidden" name="create_user_id" value="<?php echo $val["create_user_id"]; ?>">
	</form>

<?php }?>


</div><!-- /contentIn -->
</div><!-- /content -->


<?php
	// サイドメニューの読み込み
	require_once(dirname(__FILE__)."/../side.php");
?>

<div class="clear"></div>
</div><!-- /main -->

</body>
<html>
