<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>顧客管理システム | 要求フラグ登録</title>
	<link href="/assets/css/common.css" rel="stylesheet" type="text/css" media="all" />
	<link rel="stylesheet" media="screen" type="text/css" href="/assets/css/colorpicker.css" />
	<script type="text/javascript" src="/assets/js/jquery-2.1.1.min.js"></script>
	<script type="text/javascript" src="/assets/js/jquery-ui.min.js"></script>
	<script type="text/javascript" src="/assets/js/colorpicker.js"></script>
	<script type="text/javascript">
	msgcheck	= "<?php echo $msg; ?>";
	window.onload = function() {
		if(window.opener){
			if(window.opener.document.form.check.value == 2){
			document.form.flag_id.value = window.opener.document.form.flag_id.value;
			document.form.new_name.value = window.opener.document.form.new_name.value;
			document.form.new_color.value = window.opener.document.form.new_color.value;
			document.form.check.value = 2;
			document.form.create.value = "変更";
			}
		}
	}
	function setFormInput(){
        if(!window.opener || window.opener.closed){
	        //親ウィンドウが存在しない場合の処理
            window.close();
        } else{
            //window.openerで親ウィンドウのオブジェクトを操作
			form.method = "post";
			form.submit();
			window.opener.location.reload();
        }
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
	// アラートメッセージ
	if(msgcheck == "2"){
        window.close();
	}else if(msgcheck != "1"){
		alert(msgcheck);
	}
	</script>
</head>
<body class="white">

<form action="create" method="post" name="form">
	<table>
		<tr>
			<td>要求名</td>
			<td><input type="text" name="new_name"></td>
		</tr>
		<tr>
			<td>色</td>
			<td><input type="text" name="new_color" id="jquery-colorpicker-field" maxlength="6" size="6" value="" /></td>
		</tr>
	</table>
	<input type="button" name="create" onClick="setFormInput();" value="登録" style="WIDTH: 100px; HEIGHT: 40px">
	<input type="hidden" name="check" value="1">
	<input type="hidden" value="" name="flag_id">
</form>
</body>
</html>