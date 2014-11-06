<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>じゃんけん</title>
</head>
<body>
連勝数 <?php echo empty($point) ? "0": $point; ?>回<br>

<?php echo empty($msg) ? "出すものを選んでください。": $msg; ?><br>

<form method="post" action="/kisitest/game/1">
<input type="hidden" name="point" value="<?php echo empty($point) ? "0": $point; ?>">
<input type="submit" value="グー" style="margin:0px; float:left;" <?php echo empty($result) ? "disabled": "" ?>> 
</form>
<form method="post" action="/kisitest/game/2">
<input type="hidden" name="point" value="<?php echo empty($point) ? "0": $point; ?>">
<input type="submit" value="チョキ" style="margin:0px; float:left;" <?php echo empty($result) ? "disabled": "" ?>>
</form>
<form method="post" action="/kisitest/game/3">
<input type="hidden" name="point" value="<?php echo empty($point) ? "0": $point; ?>">
<input type="submit" value="パー" <?php echo empty($result) ? "disabled": "" ?>>
</form>

<?php echo empty($result) ? "<form method='post' action='/kisitest/top/'><input type='submit' value='TOPへ戻る'></form>": "" ?>

</body>
</html>
