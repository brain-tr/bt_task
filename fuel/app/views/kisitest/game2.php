<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>じゃんけん</title>
	
<script type="text/javascript">
	function jyanken(form, player){
		var submitType = document.createElement("input");
		submitType.setAttribute("name", "player");
		submitType.setAttribute("type", "hidden");
		submitType.setAttribute("value", player);//判定用の値
		form.appendChild(submitType);
		form.method = "post";
		form.submit();
	}
	
</script>

</head>
<body>
連勝数 <?php echo empty($point) ? "0": $point; ?>回<br>

<?php echo empty($msg) ? "出すものを選んでください。": $msg; ?><br>

<form method="post" action="/kisitest/game2" enctype="multipart/form-data" name="form1">
<input type="button" value="グー"  onclick="jyanken(document.form1, 1)" <?php echo empty($result) ? "disabled": "" ?>>
<input type="button" value="チョキ" onclick="jyanken(document.form1, 2)" <?php echo empty($result) ? "disabled": "" ?>>
<input type="button" value="パー"  onclick="jyanken(document.form1, 3)" <?php echo empty($result) ? "disabled": "" ?>>
<input type="hidden" name="point" value="<?php echo empty($point) ? "0": $point; ?>">
</form>

<?php echo empty($result) ? "<form method='post' action='/kisitest/top/'><input type='submit' value='TOPへ戻る'></form>": "" ?>

</body>
</html>
