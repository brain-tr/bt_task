<?php
use \Model\Db_eachpoint;
class Controller_Sum extends Controller
{

	public function action_index()
	{
		$post	=	Input::post();
		$select	=	empty($post["select"])?"":$post["select"];
		$hiki	=	empty($post["hiki"])?"":$post["hiki"];
		$hiki2	=	empty($post["hiki2"])?"":$post["hiki2"];
		$h_r	=	empty($post["hiki"])?"":$post["hiki"];

		//各教科判定用
		$data["shimei"]	=	empty($post["shimei"])?"":$post["shimei"];
		$data["jpn"]	=	empty($post["jpn"])?"":$post["jpn"];
		$data["math"]	=	empty($post["math"])?"":$post["math"];
		$data["scie"]	=	empty($post["scie"])?"":$post["scie"];
		$data["socie"]	=	empty($post["socie"])?"":$post["socie"];
		$data["eng"]	=	empty($post["eng"])?"":$post["eng"];
		$data["tra"]	=	empty($post["tra"])?"":$post["tra"];
		$data["total"]	=	empty($post["total"])?"":$post["total"];
		//submitのvalueに代入用
		$data["msg"]	=	empty($post["msg"]) ? "1" : $post["msg"];
		//教科が選択されたとき用に設定。
		$data["check"]	=	empty($post["check"])? "":$post["check"];
		//合計抽出用　横
		$data["sum"]	=	empty($post["sum"])?"":$post["sum"];
		//合計抽出用　縦
		$data["sum2"]	=	empty($post["sum2"])?"":$post["sum2"];


		//全件表示用
		$data["double"]	=	db_eachpoint::get_sum2();

		if($data["check"]=="1"){
			//国語用判定
			if($data["jpn"]=="1"){
				$hiki = 'asc';
				$select = '1';
				$h_r	= 'max';
				$data["msg"]	= '2';
			}else if($data["jpn"]=='2'){
				$hiki = 'desc';
				$select = '1';
				$h_r	= 'min';
				$data["msg"]	= '1';
			}

			//数学判定
			if($data["math"]=="1"){
				$hiki = 'asc';
				$select = '2';
				$h_r	= 'max';
				$data["msg"]	= '2';
			}else if($data["math"]=='2'){
				$hiki = 'desc';
				$select = '2';
				$h_r	= 'min';
				$data["msg"]	= '1';
			}

			//理科判定
			if($data["scie"]=="1"){
				$hiki = 'asc';
				$select = '3';
				$h_r	= 'max';
				$data["msg"]	= '2';
			}else if($data["scie"]=='2'){
				$hiki = 'desc';
				$select = '3';
				$h_r	= 'min';
				$data["msg"]	= '1';
			}

			//社会判定
			if($data["socie"]=="1"){
				$hiki = 'asc';
				$select = '4';
				$h_r	= 'max';
				$data["msg"]	= '2';
			}else if($data["socie"]=='2'){
				$hiki = 'desc';
				$select = '4';
				$h_r	= 'min';
				$data["msg"]	= '1';
			}

			//英語判定
			if($data["eng"]=="1"){
				$hiki = 'asc';
				$select = '5';
				$h_r	= 'max';
				$data["msg"]	= '2';
			}else if($data["eng"]=='2'){
				$hiki = 'desc';
				$select = '5';
				$h_r	= 'min';
				$data["msg"]	= '1';
			}

			//保体判定
			if($data["tra"]=="1"){
				$hiki = 'asc';
				$select = '6';
				$h_r	= 'max';
				$data["msg"]	= '2';
			}else if($data["tra"]=='2'){
				$hiki = 'desc';
				$select = '6';
				$h_r	= 'min';
				$data["msg"]	= '1';
			}

			//合計判定
			if($data["total"]=="1"){
				$hiki = 'asc';
				$select = '7';
				$h_r	= 'max';
				$data["msg"]	= '2';
			}else if($data["total"]=='2'){
				$hiki = 'desc';
				$select = '7';
				$h_r	= 'min';
				$data["msg"]	= '1';
			}
			$data["double"] =	db_eachpoint::on_change2($hiki,$select,$h_r);
		}

		$data["sum"]	=	db_eachpoint::get_sum();





 		return View::forge('sum',$data);

	}
}