<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>顧客管理システム | 顧客対応変更</title>
<link href="/assets/css/common.css" rel="stylesheet" type="text/css" media="all" />
<script type="text/javascript" src="/assets/js/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="/assets/js/jquery-ui.min.js"></script>
<script type="text/javascript">
msgcheck	= "<?php echo $msgcheck; ?>";
msg_comp	= "<?php echo $msg_comp; ?>";
id = <?php echo $list_id;?>;
//昇順降順ボタン
function sort_btn(number){
	var ipt = document.createElement("input");

	ipt.type = "hidden";
	ipt.name = "check4";
	ipt.value = 1;

	document.form2.appendChild(ipt);
	document.form2.check3.value = number;
	document.form2.submit();
}
//変更画面遷移。
function upda(id){
	var form  = document.createElement("form");
	var input = document.createElement("input");
	var input2= document.createElement("input");

	form.action = "/matter/update";
	form.method = "post";

	input.type = "hidden";
	input.name = "list_id";
	input.value= id;

	input2.type  = "hidden";
	input2.name  = "flag";
	input2.value = "1";

	form.appendChild(input);
	form.appendChild(input2);
	document.body.appendChild(form);
	form.submit();
}
//削除
function del(matter_id){
	Msg = "削除しますか？";
	if(confirm(Msg)){
		var input = document.createElement("input");
		var input2= document.createElement("input");

		input.type = "hidden";
		input.name = "flag";
		input.value= 2;

		input2.type  = "hidden";
		input2.name  = "matter_id";
		input2.value = matter_id;

		document.form2.appendChild(input);
		document.form2.appendChild(input2);
		document.form2.submit();
	}
}
//変更用
function test(company_id){
	var form  = document.createElement("form");
	var input = document.createElement("input");
	var input2= document.createElement("input");
	var input3= document.createElement("input");

	form.action = "/matter/past";
	form.method = "post";

	input.type = "hidden";
	input.name = "list_id";
	input.value= id;

	input2.type  = "hidden";
	input2.name  = "flag";
	input2.value = "1";

	input3.type = "hidden";
	input3.name = "company_id";
	input3.value= company_id;

	form.appendChild(input);
	form.appendChild(input2);
	form.appendChild(input3);
	document.body.appendChild(form);
	form.submit();
}
//対応履歴遷移
function past(num){
	if(num == 1){
		document.form2.cnt.value = <?php echo $cnt-1;?>
	}else if(num == 2){
		document.form2.cnt.value = <?php echo $cnt+1;?>
	}
	document.form2.submit();
}
//対応履歴直接遷移
function directpast(num){
	document.form2.cnt.value = num-1;
	document.form2.submit();
}
// 更新履歴表示
function updated(){
	var matter_id = id;
	window.open("/mlist/updated?id="+matter_id,"id","width=400,height=400,scrollbars=yes");
}
function change(){
	form1.submit();
}
// アラートメッセージ
if(msgcheck != "1"){
	alert(msgcheck);
}
// 画面遷移
if(msg_comp != "0"){
	var form  = document.createElement("form");
	var input = document.createElement("input");

	form.action = "/customer/update";
	form.method = "post";

	input.type = "hidden";
	input.name = "c_id";
	input.value= msg_comp;

	form.appendChild(input);
	document.body.appendChild(form);
	form.submit();
}
jQuery(function($) {
    $('.textOverflowTest3').each(function() {
        var $target = $(this);

        // オリジナルの文章を取得する
        var html = $target.html();

        // 対象の要素を、高さにautoを指定し非表示で複製する
        var $clone = $target.clone();
        $clone
            .css({
                display: 'none',
                position : 'absolute',
                overflow : 'visible'
            })
            .width($target.width())
            .height('auto');

        // DOMを一旦追加
        $target.after($clone);

        // 指定した高さになるまで、1文字ずつ消去していく
        while((html.length > 0) && ($clone.height() > $target.height())) {
            html = html.substr(0, html.length - 1);
            $clone.html(html + "...");
        }

        // 文章を入れ替えて、複製した要素を削除する
        $target.html($clone.html());
        $clone.remove();
    });
});
</script>
<style type="text/css">
table.tableStylex td a{
	text-decoration: none;
}
p#msg{
	color:red;
}
div#resize {
	width:700px;
}
div.floatright {
	margin-top:10px;
	float:right;
}
#searchbtn {
	margin:0px 5px;
}
.disabled {
	background-color: #e0e0e0;
}
/* overflow:hidden、heightは必ず指定する */
.textOverflowTest3 {
    overflow: hidden;
    width: 200px;
    height: 23px;
    margin-left:40px;
}
</style>

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
<h2>対応一覧</h2>

<?php
	$selected1 = "";
	$flg	=	"";
	$flg2	=	"";

	foreach($view as $key=>$val){
		if($val["c_flag"]==1){
			$flg = "エンドユーザ";
		}else if($val["c_flag"]==2){
			$flg = "元請け";
		}else if($val["c_flag"] == 3){
			$flg = "二次請け";
		}else if($val["c_flag"] == 4){
			$flg = "BP(両方)";
		}else if($val["c_flag"] == 5){
			$flg = "BP(人材元)";
		}
		if ($val["listing_flag"] == 1){
			$flg2	=	"checked='checked'";
		}
?>
<form action="update" method="post" name="form1" class="formstyle1">
<?php if($msg != ''){ echo '<p id="msg">'.$msg.'</p><br />'; } ?>
<table class="tableStyle7 mB30">
	<tr>
		<th>日付</th>
		<td colspan="3"><input type="text" name="date" value="<?php echo $val['date']; ?>" size="12"></td>
	</tr>
	<tr>
		<th>記入者</th>
		<td colspan="3"><?php echo $val['user_name']; ?>　　<a href="#" onclick="updated()">更新履歴</a></td>
	</tr>
	<tr>
		<th>顧客会社名</th>
		<td colspan="2"><input type="text" id="one" class="disabled" disabled size="30" value="<?php echo $val["company_name"];?>"></td>
		<td>客種 <input type="text" id="two" class="disabled" disabled size="12" value="<?php echo $flg; ?>">　上場 <input type="checkbox" name="listing_flag" value="1" disabled="disabled" <?php echo $flg2;?>></td>
	</tr>
	<tr>
		<th>要求フラグ</th>
		<td colspan="3">
			<select name="case">
				<?php
					foreach($select as $key2=>$val2){
						if($val["case_id"] == $val2["case_id"]){
							echo "<option value='".$val2['case_id']."' selected>".$val2["name"]."</option>";
						}else{
							echo "<option value='".$val2['case_id']."'>".$val2["name"]."</option>";
						}
					}
				?>
			</select>
		</td>
	</tr>
	<tr>
		<th>対応者</th>
		<td colspan="3"><input type="text" name="user" value="<?php echo $val["respone_name"];?>" size="10"></td>
	</tr>
	<tr>
		<th>総論</th>
		<td colspan="3"><textarea name="detail" cols='50'><?php echo $val["content_text"]; ?></textarea></td>
	</tr>
	<tr>
		<th>ニーズ</th>
		<td colspan="3"><textarea name="content_text2" cols='50'><?php echo $val["content_text2"]; ?></textarea></td>
	</tr>
	<tr>
		<th>今後の展開</th>
		<td colspan="3"><textarea name="content_text3" cols='50'><?php echo $val["content_text3"]; ?></textarea></td>
	</tr>
	<tr>
		<th>質問内容</th>
		<td colspan="3"><textarea name="content_text4" cols='50'><?php echo $val["content_text4"]; ?></textarea></td>
	</tr>
	<tr>
		<th>断られた内容</th>
		<td colspan="3"><textarea name="content_text5" cols='50'><?php echo $val["content_text5"]; ?></textarea></td>
	</tr>

	<tr>
		<th>住所</th>
		<td colspan="3"><input type="text" class="disabled" disabled size="10" value="<?php echo $val["company_add_code"];?>"> <input type="text" id="three" class="disabled" disabled size="40" value="<?php echo $val["company_add"];?>"></td>
	</tr>
	<tr>
		<th>顧客会社<br />詳細情報</th>
		<td colspan="3">
			<table class="tableStyle8">
				<tr>
					<th>TEL</th>
					<th>Mail</th>
				</tr>
				<tr>
					<td><input type="text" id="four" class="disabled" disabled size="12" value="<?php echo $val["company_tel"];?>"></td>
					<td><input type="text" id="five" class="disabled w270" disabled value="<?php echo $val["company_mail"];?>"></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<th>請求担当者</th>
		<td colspan="3">
			<table class="tableStyle8">
				<tr>
					<th>名前</th>
					<th>TEL</th>
					<th>Mail</th>
					<th>備考</th>
				</tr>
				<?php
					foreach($claim as $key3 => $val3){
						echo "<tr>";
							echo "<td><input type='text' id='six' class='disabled w150' disabled value='".$val3["name"]."'></td>";
							echo "<td><input type='text' id='seven' class='disabled w150' disabled value=".$val3["tel"]."></td>";
							echo "<td><input type='text' id='eight' class='disabled w270' disabled value='".$val3["mail"]."'></td>";
							echo "<td><textarea name='t_remarks[]' class='disabled w250' disabled >".$val3["remarks"]."</textarea></td>";
						echo "</tr>";
					}
				?>
			</table>
		</td>
	</tr>
	<tr>
		<th>担当者</th>
		<td colspan="3">
			<table class="tableStyle8">
				<tr>
					<th>名前</th>
					<th>TEL</th>
					<th>Mail</th>
					<th>備考</th>
				</tr>
				<?php
					foreach($customer as $key3 => $val3){
						echo "<tr>";
							echo "<td><input type='text' id='six' class='disabled w150' disabled value='".$val3["name"]."'></td>";
							echo "<td><input type='text' id='seven' class='disabled w150' disabled value=".$val3["tel"]."></td>";
							echo "<td><input type='text' id='eight' class='disabled w270' disabled value='".$val3["mail"]."'></td>";
							echo "<td><textarea name='t_remarks[]' class='disabled w250' disabled >".$val3["remarks"]."</textarea></td>";
						echo "</tr>";
					}
				?>
			</table>
		</td>
	</tr>
	<tr>
		<th>特記事項</th>
		<td colspan="3"><textarea id="nine" class="disabled" disabled cols="50"><?php echo $val["special_text"]; ?></textarea></td>
	</tr>
</table>
<input type="hidden" id="ten" name="company_id" value="<?php echo $val["company_id"];?>">
<input type="hidden" name="matter_id" value="<?php echo $val["matter_id"]; ?>">
<input type="hidden" name="check" value="1">
<input type="hidden" name="list_id" value=<?php echo $list_id;?>>
<p class="c"><input type="submit" value="変更する" onclick="change()" style='WIDTH: 200px; HEIGHT: 50px'></p>
</form>
<br><br>

<form action="update" method="post" name="form2">
<table class="tableStyle9">
<tr>
<th>日付<input type='button' value=<?php echo $sortbtn;?> onClick='sort_btn(1);'></th>
<th>要求フラグ<input type='button' value=<?php echo $sortbtn2;?> onClick='sort_btn(2);'></th>
<th>対応者</th>
<th>総括</th>
<th>編集</th>
</tr>
<?php
	foreach($past as $key2 => $val2){
		if(($cnt*10 <= $key2) && ($cnt*10+10 > $key2)){
			$color = $val2["color_code"];
			echo "<tr>";
			echo "<td>".$val2["date"]."</td>";
			echo "<td style='background-color:$color'><span id='com'>".$val2["name"]."</span><br></td>";
			echo "<td>".$val2["respone_name"]."</td>";
			echo "<td><p class='textOverflowTest3'>".$val2["content_text"]."</p></td>";
			echo "<td class='c'>";
	  		echo "<input type='button' value='変更' onClick=\"upda('".$val2["matter_id"]."')\">";
	 		echo " / ";
			echo "<input type='button' value='削除' onClick=del(".$val2["matter_id"].")>";
			echo "</td>";
			echo "</tr>";
		}
	}
?>
</table>
<div class="floatright">
<?php
	$lastpage = ceil(count($past)/10);
	$nowpage = $cnt+1;
	if($lastpage >= 1 && $lastpage < 7){
		if($nowpage != 1){
			echo '<a href="#" onclick="directpast(1)">先頭</a> ';
			echo '<a href="#" onclick="past(1)">前ページ</a> ';
		}
		for($i=1; $i<=$lastpage; $i++){
			if($i == $nowpage){
				echo $i.' ';
			}else{
				echo '<a href="#" onclick="directpast('.$i.')">'.$i.'</a> ';
			}
		}
		if($nowpage != $lastpage){
			echo '<a href="#" onclick="past(2)">次ページ</a> ';
			echo '<a href="#" onclick="directpast('.$lastpage.')">末尾</a> ';
		}
	}else if($lastpage >= 7){
		if($nowpage != 1){
			echo '<a href="#" onclick="directpast(1)">先頭</a> ';
			echo '<a href="#" onclick="past(1)">前ページ</a> ';
		}
		for($i=1; $i<=$lastpage; $i++){
			//1～2ページ目まで
			if(1 <= $nowpage && $nowpage <= 3){
				if($i == $nowpage){
					echo $i.' ';
				}else if($i <= 5){
					echo '<a href="#" onclick="directpast('.$i.')">'.$i.'</a> ';
				}else if($i == $lastpage){
					echo '… ';
				}
			//3～後3ページ目まで
			}else if(3 < $nowpage && $nowpage < $lastpage-2){
				if($i == 1){
					echo '… ';
				}
				if($i == $nowpage){
					echo $i.' ';
				}else if($nowpage-2 <= $i && $i <= $nowpage+2){
					echo '<a href="#" onclick="directpast('.$i.')">'.$i.'</a> ';
				}
				if($i == $lastpage){
					echo '… ';
				}
			//後2～最後ページ目まで
			}else if($lastpage-2 <= $nowpage && $nowpage <= $lastpage){
				if($i == 1){
					echo '… ';
				}else if($i == $nowpage){
					echo $i.' ';
				}else if($i >= $lastpage-4){
					echo '<a href="#" onclick="directpast('.$i.')">'.$i.'</a> ';
				}
			}
		}
		if($nowpage != $lastpage){
			echo '<a href="#" onclick="past(2)">次ページ</a> ';
			echo '<a href="#" onclick="directpast('.$lastpage.')">末尾</a> ';
		}
	}
?>
</div>
<input type="hidden" name="cnt" value="<?php echo $cnt; ?>">
<input type="hidden" name="company_id" value="<?php echo $company_id; ?>">
<input type="hidden" name="list_id" value="<?php echo $list_id; ?>">
<input type="hidden" name="updown" value="<?php echo $updown; ?>">
<input type="hidden" name="updown2" value="<?php echo $updown2; ?>">
<input type="hidden" name="check3" value="<?php echo $check3; ?>">
<input type="hidden" name="sortbtn" value="<?php echo $sortbtn; ?>">
<input type="hidden" name="sortbtn2" value="<?php echo $sortbtn2; ?>">
</form>
</div><!-- /contentIn -->
</div><!-- /content -->
<?php }?>

<?php
	// サイドメニューの読み込み
	require_once(dirname(__FILE__)."/../side.php");
?>

<div class="clear"></div>
</div><!-- /main -->

</body>
<html>
