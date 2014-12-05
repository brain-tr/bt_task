<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>点数表示</title>

<script type="text/javascript">


//国語選択用
function kokugo(jpn)
{
	msg = "<?php echo $msg; ?>";
	var submitType = document.createElement("input");
	submitType.setAttribute("name", "jpn");
	submitType.setAttribute("type", "hidden");
	submitType.setAttribute("value",msg);
	form.appendChild(submitType);
	form.method = "post";
	form.submit();
}
//数学選択用
function sugaku(math)
{
	msg = "<?php echo $msg; ?>";
	var submitType = document.createElement("input");
	submitType.setAttribute("name", "math");
	submitType.setAttribute("type", "hidden");
	submitType.setAttribute("value",msg);
	form.appendChild(submitType);
	form.method = "post";
	form.submit();
}

//理科選択用
function rika(scie)
{
	msg = "<?php echo $msg; ?>";
	var submitType = document.createElement("input");
	submitType.setAttribute("name", "scie");
	submitType.setAttribute("type", "hidden");
	submitType.setAttribute("value",msg);
	form.appendChild(submitType);
	form.method = "post";
	form.submit();
}

//社会選択用
function syakai(socie)
{
	msg = "<?php echo $msg; ?>";
	var submitType = document.createElement("input");
	submitType.setAttribute("name", "socie");
	submitType.setAttribute("type", "hidden");
	submitType.setAttribute("value",msg);
	form.appendChild(submitType);
	form.method = "post";
	form.submit();
}

//英語選択用
function english(eng)
{
	msg = "<?php echo $msg; ?>";
	var submitType = document.createElement("input");
	submitType.setAttribute("name", "eng");
	submitType.setAttribute("type", "hidden");
	submitType.setAttribute("value",msg);
	form.appendChild(submitType);
	form.method = "post";
	form.submit();
}

//保体選択用
function hotai(tra)
{
	msg = "<?php echo $msg; ?>";
	var submitType = document.createElement("input");
	submitType.setAttribute("name", "tra");
	submitType.setAttribute("type", "hidden");
	submitType.setAttribute("value",msg);
	form.appendChild(submitType);
	form.method = "post";
	form.submit();
}




</script>
<style>
table th,td{
	text-align:center;
}

a{
	text-decoration: none;
}
</style>

</head>
<body>
<h1>科目別一覧表</h1>
<form action="kupdown" method="post" name="form">
<table border="1" width="600px">
	<tr>
		<th>名前</th>
		<th><a href="" name="jpn"  value="" onclick="kokugo();return false;">国語</a></th>
		<th><a href="" name="math"  value="" onclick="sugaku();return false;">数学</a></th>
		<th><a href="" name="scie"  value="" onclick="rika();return false;">理科</a></th>
		<th><a href="" name="socie"  value="" onclick="syakai();return false;">社会</a></th>
		<th><a href="" name="eng"  value="" onclick="english();return false;">英語</a></th>
		<th><a href="" name="tra"  value="" onclick="hotai();return false;">保体</a></th>
		<input type="hidden" name="check" value="1">
		<a href="" name="first" value="" onClick="syoki();retuen false;">初期表示</a>
	</tr>
<?php
	$wk_id	= "";
	$tk_id	= "";
	$wk_id2	= 1;
	$cnt	= 0;
	$ch_id	=	array(1,2,3,4,5,6);
	echo '<tr>';
	//データベース名前・点数・教科ID配列の値を一件づつ取得
	foreach($double as $val){
		//foreachで取り出した生徒IDと前回処理を行った生徒IDが
		//一致している場合に再処理する事のないためif文で判別。
		if($val["seito_id"] != $wk_id){
			//初回回転時に判別用 $wk_idが空でなければ
			if(!empty($wk_id)){
				//データベースの教科IDと$ch_id[$i]が一致して処理を行い、
				//空のtdタグを作成する。
				for($i=$cnt; $i<7; $i++){
					//空のtdタグを作成
					echo "</td><td>";
				}
				//生徒IDと$wk_idが一致しなければ前の<tr>を閉じて新たに開く
				echo "</tr><tr>";
				//カウンタ2に値をセット
				$wk_id2	= 1;
				$cnt	= 0;
			}
			echo "<td>".$val['name']."</td>";
			//現時点の生徒IDの値を代入。
			$wk_id = $val["seito_id"];
		}
		//教科IDが同じ物であれば処理を継続するため
		if($val["kyouka_id"] != $tk_id){
			//前回がnameタグの場合
			if($cnt==0){
				echo "<td>";
			}
		}
		//同一の教科idに点数が複数あった場合の判別用に作成
		for($i=$wk_id2; $i<7; $i++){
			//カウンタの値が教科IDより大きければ
			if($i < $val["kyouka_id"]){
				//tdタグを閉じて開く
				echo "</td><td>";
				//カウンタ2に現在の教科IDを代入して正規の番号に戻す
				$wk_id2 = $val["kyouka_id"];
			//教科idとカウンタ$iが一致すれば
			}else if($val["kyouka_id"] == $i){
				//ポイントを書き込む
				echo $val["point"];
			}else{
				//いずれにも一致しなければ処理をやめる。
				break;
			}
		}
		//カウンターのcntに現在までの回転数$iを渡す。
		$cnt=$i;
	}
	for($i=$cnt;$i<7;$i++){
		echo "</td><td>";
	}
	echo "</tr>";
?>
</form>
</table>
</body>
</html>
