<html>
<head>
</head>
<body>
<form action="uemuratest" method="post">
	<?php
		if($err != ""){
			echo $err.'<br /><br />';
		}
	?>
	<input type="text" name="free_word1" value="<?php echo $free_word1; ?>" size="5" />
	<select name="mark">
	<?php
		$markArray = array('1'=>'+','2'=>'-','3'=>'×','4'=>'÷');
		foreach($markArray as $key => $val){
			if($key == $mark){
				$selected = "selected";
			}else{
				$selected = "";
			}
			echo '<option value="'.$key.'" '.$selected.' >'.$val.'</option>';
		}
	?>
	</select>
	<input type="text" name="free_word2" value="<?php echo $free_word2; ?>" size="5" />
	=
	<input type="text" name="total" value="<?php echo $total; ?>" size="5" />
	<input type="hidden" name="execute" value="<?php echo $execute; ?>"  />
	<input type="submit" value="計算" />
</form>

</body>
</html>