<?php
use \Model\Db_follow;
use \Model\Loginout;
use Model\db_customer;
class Controller_Clist extends Controller
{
	/*
	 *	セッション情報の確認
	*/
// 	public function before()
// 	{
// 		session_start();
// 		parent::before();
// 		if (!Loginout::logincheck()){
// 			header('Location: /login/');
// 			exit();
// 		}
// 	}

	/*
	 *	フォロー一覧画面
	*/
	public function action_index()
	{
		$post = Input::post();
		$data["search"]		=	empty($post["search"])?"" : $post["search"];
		$data["del"]		=	empty($post["del"])	?	"": $post["del"];
		$data["del_flg"]	=	empty($post["del_flg"])?"": $post["del_flg"];
		$data["check"]		=	empty($post["check"]) ?"" : $post["check"];
		$data["delete"]		=	empty($post["delete"])? "": $post["delete"];
		$data["check2"]		=	empty($post["check2"])? "": $post["check2"];




		if($data["check"]==1){
			//一括削除処理
			if(!empty($data["del"])){
				for($i=0; $i<count($data["del"]); $i++){
					db_customer::del_company($data["del"][$i]);
					db_customer::del_customer($data["del"][$i]);
				}
			//削除ボタン 単体削除
			}else if(!empty($data["delete"])){
					db_customer::del_company($data["delete"]);
					db_customer::del_customer($data["delete"]);
			}
		}

		//検索
		if($data["check2"]==2 && !empty($data["search"])){
				$data["view"]	=	db_customer::search_company(strval($data["search"]));
		}else{
			//初期表示用
			$data["view"]	=	db_customer::get_name();
		}







		return View::forge('clist/index',$data);
	}
}