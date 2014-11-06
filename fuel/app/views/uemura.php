<html>
<head>
	<title>じゃんけんゲーム</title>
</head>
<body>

<?php
	if($start == "" && $ranking == "")
	{
?>
		<form action="game" method="post">
			<input type="submit" name="start" value="スタート" />
		</form>
		<form action="ranking" method="post">
			<input type="submit" name="ranking" value="ランキング" />
		</form>
<?php
	}
	else if($start != "" && $ranking == "")
	{
?>
		<form action="game" method="post">
			<?php
				echo '勝利回数：'.$count.'<br />';
				echo $msg.'<br />';

				$gameArray = array('グー','チョキ','パー');
				if($msg != "敗北！"){
					foreach($gameArray as $val){
						echo '<input type="submit" name="key" value="'.$val.'" />';
					}
				}
			?>
			<input type="hidden" name="start" value="<?php echo $start; ?>" />
			<input type="hidden" name="count" value="<?php echo $count; ?>" />
		</form>

		<?php
			if($msg == '敗北！'){
		?>
			<form action="top" method="post">
				<input type="submit" value ="もう一度挑戦する"/>
				<input type="hidden" name="start" value =""/>
				<input type="hidden" name="count" value ="$count"/>
			</form>
		<?php
			}
	}
	else if($ranking == "ランキング")
	{
	?>
	<br />
	<form action="top" method="post">
		<input type="submit" value="トップに戻る" />
	</form>
	<?php
	}
	?>

</body>
</html>