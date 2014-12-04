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
			return true;
		}
	}

	// メッセージ表示
	if(msgcheck != "1"){
		alert(msgcheck);
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
<h2>フォロー報告の変更</h2>

<?php
foreach ($follow_data as $val){ ?>
<form action="/follow/update" method="post" id="form1">
<table class="tableStyle3 mB20">
	<tr>
		<th>報告者</th>
		<td colspan="3"><?php echo $val['create_name']; ?></td>
	</tr>
	<tr>
		<th>発生日</th>
		<td><?php echo $val['start_date']; ?></td>
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
			<textarea name="project_text" rows="4" cols="25" <?php echo empty($follow_detail_id) ? "": "disabled" ?>><?php echo $val['project_text']; ?></textarea>
		</td>
	</tr>
	<tr>
		<th>面談内容・トラブル・<br />懸案事項</th>
		<td  colspan="3">
			<textarea name="content_text" rows="4" cols="25" <?php echo empty($follow_detail_id) ? "": "disabled" ?>><?php echo $val['content_text']; ?></textarea>
		</td>
	</tr>
	<tr>
		<th>その他連絡事項<br />（増員情報等）</th>
		<td  colspan="3">
			<textarea name="remarks" rows="4" cols="25" <?php echo empty($follow_detail_id) ? "": "disabled" ?>><?php echo $val['remarks']; ?></textarea>
		</td>
	</tr>
	</table>
	<?php if(empty($follow_detail_id)) {?>
		<p class="btnSpace mB50">
		<button type="submit" id="btnCrea" name="result" value="変更する"><img src="/assets/img/common/btn_insert.png" alt="登録する" width="180px" height="70px" /></button>　
		<button type="submit" id="btnCrea" name="result" value="削除する" onClick="followDelete()"><img src="/assets/img/common/btn_delete.png" alt="登録する" width="180px" height="70px" /></button>
<!-- 		<input type="submit" name="result" value="変更する" />　 -->
<!--		<input type="submit" name="result" value="削除する" onClick="followDelete()" /> -->
	</p>
	<?php } ?>
	<input type="hidden" name="follow_id" id="follow_id" value="<?php echo $follow_id; ?>" />
	</form>

	<?php
	if(!empty($follow_detail_up_data)){
		//echo '<h3>フォロー詳細内容の変更</h3>';
		echo '<form action="/follow/update" method="post" id="form3">';
		echo '<table class="tableStyle3 mB50">';
		echo '<tr>';

		echo '<th class="bgP">日付</th>';
		echo '<td colspan="2" style="border-right:none;">'.$follow_detail_up_data['detail_date'].'</td>';
		echo '<td style="border-left:none;"><input type="submit" name="detail_up"value="変更" />　<input type="submit" name="detail_del" value="削除" onClick="followDelete()" /></td>';
		echo '</tr><tr>';

		// 状況フラグ
		echo '<th class="bgP">状況フラグ</th>';
		echo '<td>';

		if(!empty($situation_list)) {
			echo '<select id="situation_id2" name="situation_id2">';
			foreach($situation_list as $val) {

				// 選択項目の設定
				if($follow_detail_up_data['situation_id'] == $val['situation_id']){
					$selected = "selected";
				} else {
					$selected = "";
				}
				echo '<option value="'.$val['situation_id'].'" '.$selected.'>'.$val['name'].'</option>';
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
			foreach($appointment_list as $val){

				// 選択項目の設定
				if($follow_detail_up_data['appointment_id'] == $val['appointment_id']) {
					$selected = "selected";
				} else {
					$selected = "";
				}
				echo '<option value="'.$val['appointment_id'].'" '.$selected.'>'.$val['name'].'</option>';
			}
			echo '</select>';
		} else {
			echo "対応方式が登録されていません。";
		}
		echo '</td></tr><tr>';
		echo '<th class="bgP">フォロー詳細内容</th>';
		echo '<td colspan="3"><textarea id ="remarks3" name="remarks3" rows="4" cols="20">'.$follow_detail_up_data['remarks'].'</textarea></td>';

	echo '</tr></table>';
	echo '<input type="hidden" name="follow_detail_id" value="'.$follow_detail_up_data['id'].'" />';
	echo '<input type="hidden" name="detail_date" value="'.$follow_detail_up_data['detail_date'].'" /></form>';
	} ?>


	<h3>フォロー詳細内容の一覧</h3>
	<table class="tableStyle3 mB50">
	<?php
		if(!empty($follow_detail_data)){
			foreach($follow_detail_data as $val){
				if(empty($val['del_flag'])) {
					echo '<tr><td class="bgG" colspan="4">発生日：'.$val['detail_date']."</td></tr>\r\n";
					echo '<tr><th>状況フラグ </th><td>'.$val['situation_name'].'</td><th>対応方式 </th><td>'.$val['appointment_name']."</td></tr>\r\n";
					echo '<tr><th>フォロー詳細内容</th><td colspan="3">'.$val['remarks']."</td></tr>\r\n";
				}
			}
		} else {
			echo '<tr><td>フォロー詳細内容は登録されていません</td></tr>';
	}
	?>
	</table>

	<!-- 対応内容 -->
	<h3>フォロー詳細内容の登録</h3>
	<form action="/follow/update" method="post" id="form2">
	<table class="tableStyle3 mB50">
		<tr>
			<th class="bgP">日付</th>
			<td colspan="2" style="border-right:none;"><input type="text" id="detail_date" name="detail_date" value="<?php echo date("Y-m-d"); ?>" size="15" /></td>
			<td style="border-left:none;"><button type="submit" id="btnCrea"><img src="/assets/img/common/btn_insert2.png" alt="登録する"  width="100px"/></button></td>
		</tr>

		<tr>
			<th class="bgP">状況フラグ</th>
			<td><?php
					if(!empty($situation_list)) {
						echo '<select id="situation_id" name="situation_id">';
						foreach($situation_list as $val) {
							echo '<option value="'.$val['situation_id'].'">'.$val['name'].'</option>';
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
					foreach($appointment_list as $val){
						echo '<option value="'.$val['appointment_id'].'">'.$val['name'].'</option>';

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
			<td colspan="3"><textarea id ="remarks2" name="remarks2" rows="4" cols="20"></textarea></td>
		</tr>
	</table>
	<input type="hidden" name="follow_id" value="<?php echo $follow_id; ?>" />
	<input type="hidden" name="start_date" value="<?php //echo $val['start_date']; ?>" />
	<input type="hidden" name="result" value="3" />
	</form>


<?php }?>


</div><!-- /contentIn -->
</div><!-- /content -->


<div id="side">
	<ul class="navi">
		<li><a href="/top/">TOP</a></li>
		<li><a href="/follow/create">フォロー報告</a></li>
		<li><a href="/list/">フォロー一覧</a></li>
		<li><a href="/user/create">ユーザー登録・更新</a></li>
		<li><a href="/situation/create">状況フラグ登録・更新</a></li>
		<li><a href="/appointment/create">対応方針登録・更新</a></li>
	</ul>
</div><!-- /side -->

<div class="clear"></div>
</div><!-- /main -->

</body>
<html>