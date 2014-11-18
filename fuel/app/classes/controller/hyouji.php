<?php
use \Model\Db_seitotensu;
class Controller_Hyouji extends Controller
{

	public function action_index()
	{
		$post	=	Input::post();

		$hiki	=	empty($post["hiki"])? "":$post["hiki"];
		$cha	=	empty($post["cha"])? "id":$post["cha"];

		$data["btn"]	=	empty($post["btn"])? "":$post["btn"];
		$data["btn2"]	=	empty($post["btn2"])? "":$post["btn2"];
		$data["btn3"]	=	empty($post["btn3"])? "":$post["btn3"];
		$data["msg"]	=	empty($post["msg"])? "↓":$post["msg"];
		$data["msg2"]	=	empty($post["msg2"])? "↓":$post["msg2"];
		$data["msg3"]	=	empty($post["msg3"])? "↓":$post["msg3"];
		$data["check"]	=	empty($post["check"])? "":$post["check"];
		$data["name"]	=	empty($post["name"])? "":$post["name"];



		//ボタン一
		if($data["btn"]=="↑"){
			$hiki	=	'asc';
			$cha	=	'id';
			$data["msg"]	=	'↓';
		}else if($data["btn"]=='↓'){
			$hiki	=	'desc';
			$cha	=	'id';
			$data["msg"]	=	'↑';
		}

		//ボタン二
		if($data["btn2"]=="↑"){
			$hiki	=	'asc';
			$cha	=	'kyouka_id';
			$data["msg2"]	=	'↓';
		}else if($data["btn2"]=='↓'){
			$hiki	=	'desc';
			$cha	=	'kyouka_id';
			$data["msg2"]	=	'↑';
		}

		//ボタン三
		if($data["btn3"]=="↑"){
			$hiki	=	'asc';
			$cha	=	'point';
			$data["msg3"]	=	'↓';
		}else if($data["btn3"]=='↓'){
			$hiki	=	'desc';
			$cha	=	'point';
			$data["msg3"]	=	'↑';
		}


		//ID
		$down		=	db_seitotensu::down_data($data["name"],$hiki,$cha);
		$data["down"]	=	$down;
		$data["namelist"]	=	db_seitotensu::get_all();
 		return View::forge('hyouji',$data,$hiki,$cha);
	}


}