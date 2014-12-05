<?php
use \Model\Db_seitotensu;
class Controller_All extends Controller
{

	public function action_index()
	{
		$post	=	Input::post();

		//昇順降順代入用
		$hiki	=	empty($post["hiki"])? "" :$post["hiki"];

		//フィールド名代入用
		$select	=	empty($post["select"])?"id":$post["select"];

		//個別検索用 フィールド名
		$sel	=	empty($post["sel"])?"kara":$post["sel"];
		$sel2	=	empty($post["sel2"])?"kara":$post["sel2"];
		$sel3	=	empty($post["sel3"])?"kara":$post["sel3"];

		//フィールドview送り用
		$data["sel"]	=	$sel;
		$data["sel2"]	=	$sel2;
		$data["sel3"]	=	$sel3;

		//個別検索用 昇降判別用
		$updown		=	empty($post["updown"])?"":$post["updown"];
		$updown2	=	empty($post["updown2"])?"":$post["updown2"];
		$updown3	=	empty($post["updown3"])?"":$post["updown3"];

		//昇降セレクトview送り用
		$data["updown"]		=	$updown;
		$data["updown2"]	=	$updown2;
		$data["updown3"]	=	$updown3;

		//↑↓ボタン代入用
		$data["msg"]	=	empty($post["msg"])?"↑":$post["msg"];
		$data["msg2"]	=	empty($post["msg2"])?"↑":$post["msg2"];
		$data["msg3"]	=	empty($post["msg3"])?"↑":$post["msg3"];
		$data["msg4"]	=	empty($post["msg4"])?"↑":$post["msg4"];
		$data["msg5"]	=	empty($post["msg5"])?"↑":$post["msg5"];

		//ボタンの値判別用
		$data["btn"]	=	empty($post["btn"])?"":$post["btn"];
		$data["btn2"]	=	empty($post["btn2"])?"":$post["btn2"];
		$data["btn3"]	=	empty($post["btn3"])?"":$post["btn3"];
		$data["btn4"]	=	empty($post["btn4"])?"":$post["btn4"];
		$data["btn5"]	=	empty($post["btn5"])?"":$post["btn5"];
		$data["check"]	=	empty($post["check"])?"":$post["check"];

		//初期表示用
		$data["test"]	=	db_seitotensu::get_all1($select,$hiki);

		//セレクトボックス表示用
		$data["view"]= array(
			'id' 			=> '登録ID',
			'b.seito_id'	=> '生徒ID',
			'name'			=> '生徒名',
			'kyouka_id'		=> '教科名',
			'point'			=> '点数'
		);

		//昇降option表示用
		$data["view2"]	= array(
			'asc'	=> '昇順',
			'desc'	=> '降順'
		);

	//昇降ボタン判定
	if($data["check"]=="1"){
		//登録ID
		if($data["btn"]=="↓"){
			$hiki = 'desc';
			$select = 'id';
			$data["msg"] = '↑';
		}else if($data["btn"]=='↑'){
			$hiki = 'asc';
			$select = 'id';
			$data["msg"] = '↓';
		}

		//生徒ID
		if($data["btn2"]=="↓"){
			$hiki = 'desc';
			$select = 'b.seito_id';
			$data["msg2"] = '↑';
		}else if($data["btn2"]=='↑'){
			$hiki = 'asc';
			$select = 'b.seito_id';
			$data["msg2"] = '↓';
		}

		//生徒名
		if($data["btn3"]=="↓"){
			$hiki = 'desc';
			$select = 'name';
			$data["msg3"] = '↑';
		}else if($data["btn3"]=='↑'){
			$hiki = 'asc';
			$select = 'name';
			$data["msg3"] = '↓';
		}

		//教科名
		if($data["btn4"]=="↓"){
			$hiki = 'desc';
			$select = 'kyouka_id';
			$data["msg4"] = '↑';
		}else if($data["btn4"]=='↑'){
			$hiki = 'asc';
			$select = 'kyouka_id';
			$data["msg4"] = '↓';
		}

		//点数
		if($data["btn5"]=="↓"){
			$hiki = 'desc';
			$select = 'point';
			$data["msg5"] = '↑';
		}else if($data["btn5"]=='↑'){
			$hiki = 'asc';
			$select = 'point';
			$data["msg5"] = '↓';
		}
		//ボタン判定用表示
		$data["test"]	=	db_seitotensu::get_all1($select,$hiki);

	//select判別処理
	}else{
		//先頭のみ選択された場合
		if(!($sel=='kara') && $sel2=='kara' && $sel3=='kara'){
			$data["test"]	=	db_seitotensu::get_result2($sel,$updown);
		//先頭と二番目のみ選択された場合
		}else if(!($sel=='kara') && !($sel2=='kara') && $sel3=='kara'){
			$data["test"]	=	db_seitotensu::get_result3($sel,$sel2,$updown,$updown2);
		//全て選択された場合
		}else if(!($sel=='kara') && !($sel2=='kara') && !($sel3=='kara')){
			$data["test"]	=	db_seitotensu::get_result($sel,$sel2,$sel3,$updown,$updown2,$updown3);
		//二番目のみ入力された場合
		}else if($sel=='kara' && !($sel2=='kara') && $sel3=='kara'){
			$sel=&$sel2;
			$updown=&$updown2;
			$data["sel"]	= 	$sel2;
			$data["updown"]	=	$updown2;
			$data["sel2"]	=	'';
			$data["updown2"]=	'';
			$data["test"]	=	db_seitotensu::get_result2($sel,$updown);
		//三番目のみ入力された場合
		}else if($sel=='kara' && $sel2=='kara' && !($sel3=='kara')){
			$sel=&$sel3;
			$updown=&$updown3;
			$data["sel"]	=	$sel3;
			$data["updown"]	=	$updown3;
			$data["sel3"]	=	'';
			$data["updown3"]=	'';
			$data["test"]	=	db_seitotensu::get_result2($sel,$updown);
		//二番目・三番目のみ入力された場合
		}else if($sel=='kara' && !($sel2=='kara') && !($sel3=='kara')){
			//各selectボックス表示用
 			$data["sel"]	= 	$sel2;
 			$data["sel2"]	=	$sel3;
 			$data["sel3"]	=	'';
			//各昇降ボックス表示用
 			$data["updown"] =	$updown2;
 			$data["updown2"]=	$updown3;
 			$data["updown3"]=	'';
 			$sel=&$sel2;
 			$sel2=&$sel3;
 			$updown=&$updown2;
 			$updown2=&$updown3;
			$data["test"]	=	db_seitotensu::get_illegal($sel,$sel2,$updown,$updown2);
		//一番目と三番目のみ入力した場合
		}else if(!($sel=='kara')&& $sel2=='kara' && !($sel3=='kara')){
			//各selectボックス表示用
			$data["sel"]	=	$sel;
			$data["sel2"]	=	$sel3;
			$data["sel3"]	=	'';
			//各昇降ボックス表示用
			$data["updown"]	=	$updown;
			$data["updown2"]=	$updown3;
			$data["updown3"]=	'';
			$sel=$sel;
			$sel2=&$sel3;
			$data["test"]	=	db_seitotensu::get_illegal($sel,$sel2,$updown,$updown2);
		}

	}

 		return View::forge('all',$data);
	}
}