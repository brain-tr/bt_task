<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>じゃんけん</title>

<script type="text/javascript">
    var cnt=<?php echo $point; ?>;//連勝回数を格納


	function jyanken(form,player){
		//ランダム数字作成
		var random =Math.floor(Math.random()*(4-1));
		//配列
		var display = {"0":"グー","1":"チョキ","2":"パー"};
		//自手表示
		if(player == 0){
			document.getElementById("labelName1ID").textContent  = 'グー';
		}else if(player == 1){
			document.getElementById("labelName1ID").textContent  = 'チョキ';
		}else if(player == 2){
			document.getElementById("labelName1ID").textContent  = 'パー';
		}
		//相手の手表示
		document.getElementById("labelName2ID").textContent =display[random];


		//結果判定
		var keka = new Array('あいこ','負け','勝ち');
		var fin = ( player - random + 3 ) % 3;
		var hiki = keka[fin];

		document.getElementById("labelName3ID").textContent  = hiki;

		//勝敗カウント
		switch(hiki){
			case "勝ち":
				cnt++;
				document.getElementById("labelName0ID").textContent =cnt;
				break;

			case "あいこ":
				document.getElementById("labelName0ID").textContent =cnt;
				break;
			case "負け":
				document.getElementById("labelName0ID").textContent ="終わり！";
				//formの送信
				var submitType = document.createElement("input");
				submitType.setAttribute("name", "cnt");
				submitType.setAttribute("type", "hidden");
				submitType.setAttribute("value", cnt);//判定用の値
				form.appendChild(submitType);

				var submitType = document.createElement("input");
				submitType.setAttribute("name", "result");
				submitType.setAttribute("type", "hidden");
				submitType.setAttribute("value", 1);//判定用の値
				form.appendChild(submitType);
				form.method = "post";
				form.submit();
				break;

		}
	}

//	form.method = "post";
//	form.submit();

</script>

</head>
<body>
連勝数:<span id="labelName0ID"><?php echo $point; ?></span>
<br>
あなたの手:<LABEL id="labelName1ID"></LABEL>
<br>
相手の手:<LABEL id="labelName2ID"></LABEL>
<br>
勝敗： <LABEL id="labelName3ID"></LABEL>

<form method="post" action="/satotest2/satogame" enctype="multipart/form-data" name="form1">
<input type="button" value="グー" id="start"  onclick="jyanken(document.form1, 0)" <?php echo empty($result) ?  "" :"disabled" ?>>
<input type="button" value="チョキ" id="start"  onclick="jyanken(document.form1, 1)" <?php echo empty($result) ? "" :"disabled" ?>>
<input type="button" value="パー" id="start"   onclick="jyanken(document.form1, 2)" <?php echo empty($result) ? "" : "disabled" ?>>

</form>

<?php echo !empty($result) ? "<form method='post' action='start'><input type='submit' value='TOPへ戻る'></form>": "" ?>

</body>
</html>
