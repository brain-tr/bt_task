<html>
<head>
	<title>じゃんけんゲーム</title>

	<script type="text/javascript">

	// 初期起動
	var point = <?php echo $point;?>;
	window.onload = function(){
		document.getElementById('point').textContent = point;
	}

	function jyanken(form, player){

		// CPUのランダム数字
		var cpu = Math.floor(Math.random() * 3 + 1);

		// 判定
		var name	= {
			"1"		:	"グー",
			"2"		:	"チョキ",
			"3"		:	"パー",
		};
		var result	= cpu_judgment(player,cpu);

		// メッセージ
		document.getElementById('point').textContent	= point;
		document.getElementById('text').textContent		= msg;

		if(msg == "敗北！" && point !== 0){

			// 相手側数値をhiddenで送信
			var submitType = document.createElement("input");

			submitType.setAttribute("name", "player");		// name値
			submitType.setAttribute("type", "hidden");		// type値
			submitType.setAttribute("value", player);		// 判定用の値
			form.appendChild(submitType);

			submitType.setAttribute("name", "cpu");		// name値
			submitType.setAttribute("type", "hidden");		// type値
			submitType.setAttribute("value", cpu);		// 判定用の値
			form.appendChild(submitType);

			submitType.setAttribute("name", "point");		// name値
			submitType.setAttribute("type", "hidden");		// type値
			submitType.setAttribute("value", point);		// 判定用の値
			form.appendChild(submitType);

			form.method = "post";
			form.submit();
		}
		if(msg == "敗北！" && point === 0){

			// 相手側数値をhiddenで送信
			var submitType = document.createElement("input");

			submitType.setAttribute("name", "player");		// name値
			submitType.setAttribute("type", "hidden");		// type値
			submitType.setAttribute("value", player);		// 判定用の値
			form.appendChild(submitType);

			submitType.setAttribute("name", "cpu");		// name値
			submitType.setAttribute("type", "hidden");		// type値
			submitType.setAttribute("value", cpu);		// 判定用の値
			form.appendChild(submitType);

			submitType.setAttribute("name", "result");		// name値
			submitType.setAttribute("type", "hidden");		// type値
			submitType.setAttribute("value", "haiboku");		// 判定用の値
			form.appendChild(submitType);

			form.method = "post";
			form.submit();
		}
	}

	// 関数
	function cpu_judgment(player, cpu)
	{
		if(cpu == player){
				msg = 'あいこ！';
			}
			else if(cpu == 1 && player == 2)
			{
				msg = '勝利！';
				point++;
			}
			else if(cpu == 1 && player == 3)
			{
				msg = '敗北！';
			}
			else if(cpu == 2 && player == 1)
			{
				msg = '敗北！';
			}
			else if(cpu == 2 && player == 3)
			{
				msg = '勝利！';
				point++;
			}
			else if(cpu == 3 && player == 1)
			{
				msg = '勝利！';
				point++;
			}
			else if(cpu == 3 && player == 2)
			{
				msg = '敗北！';
			}
		return msg;
	}
	</script>
</head>

<body>


連勝数　<span id="point"></span>回
<?php echo empty($msg) ? '<p id="text"></p>': "<p>".$msg."</p>"; ?><br />

<form method="post" action="/uemura/game" enctype="multipart/form-data" name="form1" <?php echo empty($result) ? "disabled": "" ?>>
	<input type="button" value="グー"  onclick="jyanken(document.form1, 1)" <?php echo empty($result) ? "": "disabled" ?>>
	<input type="button" value="チョキ" onclick="jyanken(document.form1, 2)" <?php echo empty($result) ? "": "disabled" ?>>
	<input type="button" value="パー"  onclick="jyanken(document.form1, 3)" <?php echo empty($result) ? "": "disabled" ?>>
</form>
<?php echo empty($result) ? "": "<form method='post' action='/uemura/top/'><input type='submit' value='TOPへ戻る'></form>" ?>
</body>

</html>