<?php
use \Model\Db_follow;
use \Model\Loginout;
use Model\db_customer;
class Controller_Clist extends Controller
{
	/*
	 *	セッション情報の確認
	*/
	public function before()
	{
		session_start();
		parent::before();
		if (!Loginout::logincheck()){
			header('Location: /login/');
			exit();
		}
	}

	/*
	 *	フォロー一覧画面
	*/
	public function action_index()
	{
		$post = Input::post();
		$select 			=	empty($post["select"])?"" : $post["select"];
		$cd					=	empty($post["cd"])	?""	  : $post["cd"];
		$data["search"]		=	empty($post["search"])?"" : $post["search"];
		$data["del"]		=	empty($post["del"])	?	"": $post["del"];
		$data["del_flg"]	=	empty($post["del_flg"])?"": $post["del_flg"];
		$data["check"]		=	empty($post["check"]) ?"" : $post["check"];
		$data["delete"]		=	empty($post["delete"])? "": $post["delete"];
		$data["check2"]		=	empty($post["check2"])? "": $post["check2"];
		$data["updown1"]	=	empty($post["updown1"])?"": $post["updown1"];
		$data["updown2"]	=	empty($post["updown2"])?"": $post["updown2"];
		$data["msg"]		=	empty($post["msg"])	 ?"↑": $post["msg"];
		$data["msg2"]		=	empty($post["msg2"]) ?"↑": $post["msg2"];
		$data["check3"]		=	empty($post["check3"])? "": $post["check3"];
		$data["flag"]		=	empty($post["flag"])?	"1": $post["flag"];
		$data["flag2"]		=	empty($post["flag2"])?	"1": $post["flag2"];



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

		//昇順降順ボタン
		//顧客会社
		if($data["check3"] == 1){
			if($data["updown1"] == 1){
				$data["msg"] = "↓";
				$data["flag"] = 2;
				$select = "company_name";
				$cd = "desc";

			}else if($data["updown1"] == 2){
				$data["msg"] = "↑";
				$data["flag"] = 1;
				$select = "company_name";
				$cd = "asc";
			}
			$data["view"]	=	db_customer::up_down($select,$cd);
		//客種フラグ
		}else if($data["check3"] == 2){
			if($data["updown2"] == 1){
				$data["msg2"] = "↓";
				$data["flag2"] = 2;
				$select = "c_flag";
				$cd = "desc";

			}else if($data["updown2"] == 2){
				$data["msg"] = "↑";
				$data["flag2"] = 1;
				$select = "c_flag";
				$cd = "asc";
			}
			$data["view"]	=	db_customer::up_down($select,$cd);
		}


		return View::forge('clist/index',$data);
	}
}