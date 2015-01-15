<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>エンジニア対応管理システム | フォロー一覧</title>
<link href="/assets/css/common.css" rel="stylesheet" type="text/css" media="all" />
<script type="text/javascript">
	msgcheck = "<?php echo $msg; ?>";
	// メッセージ表示
	if(msgcheck != "1"){
		alert(msgcheck);
	}
</script>
</head>

<body>

<div id="header">
<div id="headerInner">
	<h1><img src="/assets/img/common/logo.png" alt="ブレイントラスト" /></h1>
	<p class="r">[ <a href="/login/logout">ログアウト</a> ]</p>
	<div class="clear"></div>
</div><!-- /header -->
</div><!-- /headerInner -->


<div id="main">
<div id="content">
<div id="contentIn">

<div class="listBox">
<h2>フォロー一覧</h2>
<?php
	// 日付
	$cDay		= $today;
	$cDay		= explode("-", $today);		// 現在の日付
	$cLastday	= substr($lastday,8,2);		// 月の最終日

	// もし0があったら削除（日）
	if(substr($cDay[2],0,1) === "0"){
		$cDay[2] = ltrim ($cDay[2],"0");
	}
	// もし0があったら削除（月）
	if(substr($cDay[1],0,1) === "0"){
		$cDay[1] = ltrim ($cDay[1],"0");
	}
	// 年月日の表示
	if(!empty($carenderKey)){
		echo '<div class="listTitle">'.$cDay[0]."年".$cDay[1]."月".$cDay[2]."日".'</div>';
	}else{
		echo '<div class="listTitle">'.$cDay[0]."年".$cDay[1]."月".'</div>';
	}
?>


<div class="listBoxInner">
<ul class="listMenu clearfix">
	<li class="mR100">
		<form action="/list/" method="post">
			<input type="submit" name="carender" value="<?php echo $carender; ?>" />
			<input type="hidden" name="today" value="<?php echo $today; ?>" />
		</form>
	</li>

	<?php if(!empty($carenderKey)){?>
	<li>
		<form action="/list/" method="post">
			<input type="submit" name="backWeek" value="前週" />
			<input type="hidden" name="carender" value="週表示" />
			<input type="hidden" name="today" value="<?php echo $today; ?>" />
		</form>
	</li>
	<li>
		<form action="/list/" method="post">
			<input type="submit" name="backDay"  value="前日" />
			<input type="hidden" name="carender" value="週表示" />
			<input type="hidden" name="today" value="<?php echo $today; ?>" />
		</form>
	</li>
	<li>
		<form action="/list" method="post">
			<input type="submit" name="carenderToday" value="今日" />
			<input type="hidden" name="carender" value="週表示" />
			<input type="hidden" name="today" value="<?php echo date("Y-m-j"); ?>" />

		</form>
	</li>
	<li>
		<form action="/list/" method="post">
			<input type="submit" name="nextDay" value="翌日" />
			<input type="hidden" name="carender" value="週表示" />
			<input type="hidden" name="today" value="<?php echo $today; ?>" />
		</form>
	</li>
	<li>
		<form action="/list/" method="post">
			<input type="submit" name="nextWeek" value="翌週" />
			<input type="hidden" name="carender" value="週表示" />
			<input type="hidden" name="today" value="<?php echo $today; ?>" />

		</form>
	</li>
	<?php } else {?>
	<li>
		<form action="/list/" method="post">
			<input type="submit" name="backMonth" value="前月" />
			<input type="hidden" name="carender" value="月表示" />
			<input type="hidden" name="tMonth" value="1" />
			<input type="hidden" name="today" value="<?php echo $today; ?>" />
		</form>
	</li>
	<li>
		<form action="/list/" method="post">
			<input type="submit" name="carenderToday"  value="今日" />
			<input type="hidden" name="carender" value="月表示" />
			<input type="hidden" name="tMonth" value="1" />
			<input type="hidden" name="today" value="<?php echo date("Y-m-j"); ?>" />
		</form>
	</li>
	<li>
		<form action="/list" method="post">
			<input type="submit" name="nextMonth" value="翌月" />
			<input type="hidden" name="carender" value="月表示" />
			<input type="hidden" name="today" value="<?php echo $today; ?>" />
		</form>
	</li>
	<?php }?>
</ul>
</div><!-- /listBoxInner -->
</div><!-- /listBox -->
<div class="clear"></div>


<table class="tableStyle4">
	<tr>
	<th class="name"></th>
	<?php

	// 日付(週表示)
	if(!empty($carenderKey)){
		for($i=0; $i<7; $i++){
			echo '<th>'.$cDay[2].'日</th>';
			$cDay[2] += 1;
			if($cDay[2] == ($cLastday+1)){
				$cDay[2] = 1;
			}
		}
	// 日付（月表示）
	} else {
		for($i=1; $i<32; $i++){
			echo '<th>'.$i.'日</th>';
			if($i == ($cLastday)){
				break;
			}
		}
	}
	?>
	</tr>

	<?php
		// 予定（週表示）
		if(!empty($carenderKey)) {
			$flag	= 0;		// 予定のない空のtdチェック用
			echo '<tr>';
			$wk_id2	= $today;	// 表示日
			$date	= $today;	// 表示日
			$wk_id	= "　";		// IDチェック用の変数（前の予定が誰か？）;
			$num = 7;
			foreach($engineer_list as $val){
				if(!empty($val['job_type'])){

					// エンジニアの確認
					if($wk_id != $val['user_id']){
							if($wk_id != "　") {		// 2人目以降の処理

								// 予定の無かった日付を埋める
								for($i=$flag; $i<$num-1; $i++) {
									echo '</td><td>';
								}
								echo '</td></tr><tr>';		// 改行
								$wk_id2	= $today;		// 登録日
								$flag	= 0;			// フラッグを初期化
							}
							echo '<td>'.$val['user_name'].'</td>';
							echo '<td>';
							$wk_id = $val['user_id'];	// エンジニアのIDをセット
					}

					for($i=$flag; $i<$num; $i++){

						//比較日付を設定する
						$wk_id2 = date("Y-m-d",mktime(0,0,0,substr($today,5,2),substr($today,8,2)+$i,substr($today,0,4)));

						// 予定日の前のセルを作る
						if($wk_id2 < $val['start_date']){
							echo "</td><td>";
							$flag++;

						// 予定日を表示
						}else if($wk_id2 == $val['start_date']){
							if(empty($val['del_flag'])){
								echo '<p class="btnStyle" style="background:#'.$val['color_code'].'"><a href="/follow/update/?follow_id='.$val['follow_id']."&follow_detail_id=".$val['follow_detail_id'].'">'.$val['name'].'</a></p>';
							}
							break;
						}else{
							break;
						}
					}
				}
			}
			for($i=$flag; $i<$num-1; $i++) {
				echo '</td><td>';
			}
			echo '</td>';
			echo '</tr>';


		// 月表示
		} else {
			$flag	= 1;		// 予定のない空のtdチェック用
			echo '<tr>';
			$date	= $today;	// 表示日
			$wk_id	= "　";		// IDチェック用の変数（前の予定が誰か？）
			$wk_id2 = substr($today,0,8);
			$wk_id2 = $wk_id2."01";

			foreach($engineer_list as $val){
				if(!empty($val['job_type'])){

					// エンジニアの確認
					if($wk_id != $val['user_id']){

						if($wk_id != "　") {		// 2人目以降の処理

							// 予定の無かった日付を埋める
							for($i=$flag; $i<$cLastday; $i++) {
								echo '</td><td>';
							}
							echo '</tr><tr>';		// 行の終わり
							$wk_id2 = substr($today,0,8);
							$wk_id2 = $wk_id2."01";
							$flag	= 1;			// フラッグを初期化
						}
						echo '<td>'.$val['user_name'].'</td>';
						echo '<td>';
						$wk_id = $val['user_id'];	// エンジニアのIDをセット
					}

					//まわす回数を取得
					$end = date("d",mktime(0,0,0,substr($lastday,5,2),substr($lastday,8,2),substr($lastday,0,4)));

					for($i=$flag; $i<$end; $i++){

						//比較日付の設定
						$wk_id2 = date("Y-m-d",mktime(0,0,0,substr($today,5,2),0+$i,substr($today,0,4)));

						// 予定日の前のセルを作る
						if($wk_id2 < $val['start_date']){
							echo "</td><td>";
							$flag++;

						// 予定日を表示
						}else if($wk_id2 == $val['start_date']){
							if(empty($val['del_flag'])){	// 削除フラッグ
								echo '<p class="btnStyle" style="background:#'.$val['color_code'].'"><a href="/follow/update/?follow_id='.$val['follow_id']."&".$val['follow_detail_id'].'">'.$val['name'].'</a></p>';
							}
							break;
						}else{
							break;
						}
					}
				}
			}
			for($i=$flag; $i<$cLastday; $i++) {
				echo '</td><td>';
				if($i == $cLastday){
					break;
				}
			}
			echo '</tr>';
		}
	?>
</table>
</div><!-- /content -->
</div><!-- /contentIn -->

<div id="side">
	<ul class="navi">
		<li><a href="/ttop/">TOP</a></li>
		<li><a href="/follow/create">フォロー報告</a></li>
		<li><a href="/list/">フォロー一覧</a></li>
	<!--管理者以外のアクセスをブロック-->
	<?php if($userlog_adflag!=0){?>
		<li><a href="/user/create">ユーザー登録・更新</a></li>
		<li><a href="/situation/create">状況フラグ登録・更新</a></li>
		<li><a href="/appointment/create">対応方針登録・更新</a></li>
	<?php }?>
	<!--  -->
	</ul>
</div><!-- /side -->

<div class="clear"></div>
</div><!-- /main -->

</body>
</html>
