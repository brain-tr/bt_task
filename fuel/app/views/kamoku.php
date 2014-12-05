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

<?php
$wk_id = "";
$cnt	= 0;
//教科ID用の配列
$ch_id	=	array(1,2,3,4,5,6);
//データベース名前・点数・教科ID配列の値を一件づつ取得
foreach($japan as $key => $val){
	//foreachで取り出した生徒IDと前回処理を行った生徒IDが
	//一致している場合に再処理する事のないためif文で判別。
	if($val["seito_id"]!=$wk_id){
		//初回回転時に判別用 $wk_idが空でなければ
		if(!empty($wk_id)){
			//データベースの教科IDと$ch_id[$i]が一致して処理を行い、
			//教科IDが6未満$cntが6未満であれば空のtdタグを作成する。
			for($i=$cnt; $i<6; $i++){
				//空のtdタグを作成
				echo "<td></td>";
			}

		}
		//生徒IDと$wk_idが一致しなければ前の<tr>を閉じて新たに開く
		echo "</tr><tr>";
		//nameを書き込む
		echo "<td>".$val['name']."</td>";
		//現時点の生徒IDの値を代入。
		$wk_id = $val["seito_id"];
		//次回回転用にcntを初期化する。
		$cnt = 0;
	}
	//教科ID1-6に入っている値を出力するための処理
	for($i=$cnt;$i<6;$i++){
		//データベースの教科IDと$ch_id[$i]が一致すれば
		if($val["kyouka_id"]==$ch_id[$i]){
			//一致したポイントを書き込む
			echo "<td>".$val["point"]."</td>";
			//処理を抜ける。
			break;
		//データベースの教科IDと$ch_id[$i]が一致しなければ。
		}else{
			//空のtdタグを書き込む
			echo "<td></td>";
		}
	}
	print $cnt;
	//カウンターのcntに現在までの回転数$iを渡す。
	$cnt=++$i;
}
//foreachが終わった後に$cntが6でなければ
for($i=$cnt;$i<6;$i++){
	//空のtdタグを作成
	echo "<td></td>";
}
//最後のfor文から抜けた所で、trを閉じる。
echo "</tr>";



?>
</table>
</body>
</html>
