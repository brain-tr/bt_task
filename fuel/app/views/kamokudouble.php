<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>点数表示</title>

<script type="text/javascript">


</script>
<style>
table th,td{
	text-align:center;
}
</style>

</head>
<body>
<h1>科目別一覧表</h1>

<table border="1" width="600px">
	<tr>
		<th>名前</th>
		<th>国語</th>
		<th>数学</th>
		<th>理科</th>
		<th>社会</th>
		<th>英語</th>
		<th>保体</th>
	</tr>
<?php
	$wk_id	= "";
	$tk_id	= "";
	$wk_id2	= 1;
	$cnt	= 0;
	$ch_id	=	array(1,2,3,4,5,6);
	echo '<tr>';
	//データベース名前・点数・教科ID配列の値を一件づつ取得
	foreach($japan as $val){
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

</table>
</body>
</html>
