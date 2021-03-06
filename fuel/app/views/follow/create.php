<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>エンジニア対応管理システム | フォロー報告</title>
<link href="/assets/css/common.css" rel="stylesheet" type="text/css" media="all" />
<script type="text/javascript">
	msg = <?php echo $msg; ?>;
	if(msg != "1"){
		alert($msg);
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
<h2>フォロー報告</h2>
<form action="/follow/create" method="post">
<table class="tableStyle6">
	<tr>
		<th>報告者</th>
		<td><?php echo $create_user_name; ?></td>
	</tr>
	<tr>
		<th>発生日/終了日</th>
		<td><input type="text" name="start_date" value="<?php echo $start_date; ?>" /></td>
	</tr>
	<tr>
		<th>エンジニア名</th>
		<td>
		<?php
			if(!empty($engineer_user_id)) {
				echo '<select name="engineer_user_id">';
				var_dump($engineer_user_id);
				foreach ($engineer_user_id as $val) {
					echo '<option value="'.$val['user_id'].'">'.$val['name'].'</option>';
				}
				echo '</select>';
			} else {
				echo "エンジニアが登録されていません。";
			}
		?>
		</td>
	</tr>
	<tr>
		<th>状況フラグ</th>
		<td>
		<?php
			if(!empty($situation_id)) {
				echo '<select name="situation_id">';
				foreach($situation_id as $val) {
					echo '<option value="'.$val['situation_id'].'">'.$val['name'].'</option>';
				}
				echo '</select>';
			} else {
				echo "状況フラグが登録されていません。";
			}
		?>
		</td>
	</tr>
	<tr>
		<th>対応方式</th>
		<td>
		<?php
			if(!empty($appointment_id)) {
				echo '<select name="appointment_id">';
				foreach($appointment_id as $val){
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
		<th>案件内容</th>
		<td><textarea name="project_text" rows="4" cols="35"></textarea></td>
	</tr>
	<tr>
		<th>面談内容・トラブル・<br />懸案事項</th>
		<td><textarea name="content_text" rows="4" cols="35"></textarea></td>
	</tr>
	<tr>
		<th>その他連絡事項<br />（増員情報等）</th>
		<td><textarea name="remarks" rows="4" cols="35"></textarea></td>
	</tr>
	</table>
	<input type="hidden" name="result" value="1" />
	<p class="btnSpace"><input type="submit" value="登録する" style="WIDTH: 200px; HEIGHT: 50px"></p>
</form>
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
