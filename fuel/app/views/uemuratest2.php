<html>
<head>
	<title>じゃんけんゲーム</title>
</head>
<body>

<form action="uemuratest2" method="post">



<?php

	//相手の解答
	$dataArray = array('グー','チョキ','パー');
	foreach($dataArray as $val){
		echo '<input type="submit" name="question" value="'.$val.'" />';
	}

	//正解
	echo $answer;



?>

</form>

</body>
</html>