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
<h2>フォロー報告の変更</h2>

<?php foreach ($follow_data as $val){ ?>
<form action="/follow/create" method="post">
<table class="tableStyle3">
	<tr>
		<th>報告者</th>
		<td><?php echo $val['create_name']; ?></td>
	</tr>
	<tr>
		<th>発生日</th>
		<td><?php echo $val['start_date']; ?></td>
	</tr>
	<tr>
		<th>エンジニア名</th>
		<td><?php echo $val['engineer_name']; ?></td>
	</tr>
	<tr>
		<th>状況フラグ</th>
		<td><?php echo $val['situation_name']; ?></td>
	</tr>
	<tr>
		<th>対応方式</th>
		<td><?php echo $val['appointment_name']; ?></td>
	</tr>
	<tr>
		<th>案件内容</th>
		<td>
			<textarea name="project_text" rows="4" cols="25"><?php echo $val['project_text']; ?></textarea>
		</td>
	</tr>
	<tr>
		<th>面談内容・トラブル・<br />懸案事項</th>
		<td>
			<textarea name="content_text" rows="4" cols="25"><?php echo $val['content_text']; ?></textarea>
		</td>
	</tr>
	<tr>
		<th>その他連絡事項<br />（増員情報等）</th>
		<td>
			<textarea name="remarks" rows="4" cols="25"><?php echo $val['remarks']; ?></textarea>
		</td>
	</tr>
	</table>
	<input type="hidden" name="result" value="1" />
	<p class="c mT20"><button type="submit" id="btnCrea"><img src="/assets/img/common/btn_insert.png" alt="登録する" /></button></p>
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
