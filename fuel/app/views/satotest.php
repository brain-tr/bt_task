<!DOCTYPE HTML>
	<html>
	<head>
	<meta charset="utf-8">
	<title>Sample1</title>
	</head>
 	<body>
 	<form action="satotest" method="post">
	<input type="text" name="a" value="<?php echo $a; ?>">
	<select name="swi">
		<?php
		$type = array(
		0=>"+",
		1=>"-",
		2=>"*",
		3=>"/"
		);
		foreach($type as $val => $aaa){
			if($swi == $val){
				$selected = "selected";
			}else{
				$selected = "";
			}
			echo '<option value="'.$val.'" '.$selected.'>'.$aaa.'</option>';
		}
	?>

	</select>
	<input type="text" name="b" value="<?php echo $b; ?>">
	=
	<input type="text" name="ans" value="<?php echo $ans; ?>">
	<input type="submit" name="sub" value="送信">

	</form>

	</body>

	</html>

