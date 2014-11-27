<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>エンジニア対応管理システム | 状況フラグの登録・更新</title>
<link href="/assets/css/common.css" rel="stylesheet" type="text/css" media="all" />
<link rel="stylesheet" media="screen" type="text/css" href="/assets/css/colorpicker.css" />
<script type="text/javascript" src="/assets/js/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="/assets/js/colorpicker.js"></script>
<script type="text/javascript">
	msgcheck	= "<?php echo $msg; ?>";
	deleteFlag	= 1;

	window.onload = function(){
		document.form.btn_send.value = "この内容で登録する";
	}

	function situation(name, color_code,  flag, situation_id){
		document.form.name.value = name;
		document.form.color_code.value = color_code;
		document.form.situation_id.value = situation_id;

		// checkbox・sendのチェック
		if(flag == 1){
			document.form.flag.checked = false;
		}else{
			document.form.flag.checked = true;
		}
		document.form.btn_send.value = "変更する";

		// 変更・削除のとき背景色を変更
		document.getElementById('formBoxText').textContent	= "内容を編集中です。";
		document.getElementById('formBox').style.backgroundColor	= '#FFD5D5' ;

		// 削除とキャンセルボタン
		if(deleteFlag === 1){
			// 削除
			var submitType1 = document.createElement("input");
			submitType1.setAttribute("name", "delete");
			submitType1.setAttribute("type", "submit");
			submitType1.setAttribute("value", "削除する");
			submitType1.setAttribute("id", "btn1");
			form.appendChild(submitType1);

			// キャンセル
			var submitType2 = document.createElement("input");
			submitType2.setAttribute("type", "button");
			submitType2.setAttribute("value", "キャンセル");
			submitType2.setAttribute("id", "btn2");
			submitType2.setAttribute("onClick", "resetBtn()");
			form.appendChild(submitType2);
		}
		deleteFlag = 2;
	}

	// formをリセットする
	function resetBtn(){
		document.form.reset();
		document.getElementById('formBoxText').textContent			= "";
		document.getElementById('formBox').style.backgroundColor	= '#FFFFFF' ;
		document.form.btn_send.value = "この内容で登録する";

 		var btn1		= document.getElementById('btn1');
 		var btn1_parent	= btn1.parentNode;
 		var btn2 = document.getElementById('btn2');
 		var btn2_parent	= btn2.parentNode;
 		btn1_parent.removeChild(btn1);
 		btn2_parent.removeChild(btn2);
 		deleteFlag = 1;
	}

	// アラートメッセージ
	if(msgcheck != "1"){
		alert(msgcheck);
	}

	// カラーピッカー
	jQuery( function() {
    jQuery( '#jquery-colorpicker-field' ) . ColorPicker( {
        onSubmit: function( hsb, hex, rgb, el ) {
            jQuery( el ) . val( hex );
            jQuery( el ) . ColorPickerHide();
        },
        onBeforeShow: function () {
            jQuery( this ) . ColorPickerSetColor( this . value );
        }
    } );
    jQuery( '#jquery-colorpicker-field' ) . bind( 'keyup', function() {
        jQuery( this ) . ColorPickerSetColor( this . value );
    } );
	} );
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
<h2>状況フラグの登録・更新</h2>
<div id ="formBox">
	<p id="formBoxText"></p>
	<form action="/situation/create" method="post" name="form" class="formstyle1">
		状況名 <input type="text" name="name" value="" size="10" />　
		色 <input type="text" name="color_code" id="jquery-colorpicker-field" maxlength="6" size="6" value="" />　
		<input type="checkbox" name="flag" value="0" checked /> 親フラグ　
		<input type="hidden" name="result" value="<?php echo $result; ?>" />
		<input type="hidden" name="situation_id" value="" />
		<input type="submit" name="btn_send" value="" />

		<!--<p>※色のテキストボックスをクリックするとカラーパレットが表示されます。</p> -->

	</form>
</div>
<table class="tableStyle2">
	<tr><td>
	<div class="boxRainR">
	<p class="situTitle">親状況</p>
	<?php
	$a = 0;
	foreach($stationData as $val) {
		if($a != $val['flag']) {
			echo  '</div></td><td><div class="boxRainL">';
			echo  '<p class="situTitle">子状況</p>';
			$a = $val['flag'];
		}
		echo '<span class="stationStyle" style="background:#'.$val['color_code'].';"><a href="#" onClick="situation(\''.$val['name'].'\',\''.$val['color_code'].'\','.$val['flag'].',\''.$val['situation_id'].'\')">'.$val['name'].'</a></span><br /><br />';
	}
	?>
	</div></td></tr>
</table>
<div class="clear"></div>
</div><!-- /contentIn -->
</div><!-- /content -->

<div id="side">
	<ul class="navi">
		<li><a href="/top/">TOP</a></li>
		<li><a href="/follow/create">フォロー報告</a></li>
		<li><a href="/list/">フォロー一覧</a></li>
		<li><a href="/user/create">ユーザー登録・更新</a></li>
		<li><a href="/situation/create">状況フラグ登録・更新</a></li>
		<li><a href="/appointment/create">対応方針登録・更新</a></li>
	</ul>
</div><!-- /side -->


<div class="clear"></div>
</div><!-- /main -->

</body>
<html>
