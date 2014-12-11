<?php

use \Model\Db_appointment;
use \Model\Loginout;
class Controller_Appointment extends Controller
{
	/*
	 *	セッション情報の確認
	*/
	public function before()
	{
		session_start();
		parent::before();
		//管理者以外のアクセスをブロック
		$adflag = $_SESSION['admin_flag'];
		if($adflag!=1){
			header('Location: /top/');
			exit();
		}
		if (!Loginout::logincheck()){
			header('Location: /login/');
			exit();
		}
	}

	public function action_create()
	{
		// ログイン情報
		$data['userlog_id']		= $_SESSION['id'];
		$data['userlog_name']	= $_SESSION['name'];

		 $post				=	Input::post();
		 $data["name"]		=	empty($post["name"]) ? "": $post["name"];
		 $data["ins"]		=	empty($post["ins"]) ? "": $post["ins"];
		 $data['user_id']	=	empty($post["id"]) ? "": $post["id"];
		 $data['btn']		=	empty($post["btn"]) ? "": $post["btn"];
 		 $data["get"]		=	empty($post["get"]) ? 1 : $post["get"];
 		 $data["deleate"]	=	empty($post["deleate"]) ? "" : $post["deleate"];
		 $data["msg"]		=	empty($post["msg"]) ? "1" : $post["msg"];
 		 $data["id"]		=	db_appointment::get_id();

		 if($data["btn"]=="登録"){
		 	$data["btn"]=1;
		 }else if($data["btn"]=="変更"){
		 	$data["btn"] = 2;
		 }
		//登録
	if(!empty($post["get"]) && $data["btn"] == 1) {

			if(empty($data["name"])) {
				//$data['msg'] = "名前が入力されていません。";
			} else {
				$user_name = db_appointment::get_name($data['name']);
				if(empty($user_name)) {
					db_appointment::ins_name($data);
					$data['msg'] = "ユーザー情報を登録しました。";
				} else {
					$data['msg'] = "すでに登録されている名前です。";
				}
			}
		 //ここから変更
 		}else if(!empty($post["get"]) && $data["btn"] == 2) {
 			if(!empty($post["name"])){
 				$user_id = db_appointment::get_id($data['user_id']);
 				$user_name = db_appointment::get_name($data['name']);
 			if(!empty($user_id) &&($user_name)==false) {
 				db_appointment::change_name($data);
 			}else{
 				$data["msg"] = "同じ名前が存在するため変更できませんでした。";
 			}
 			}
 		}

 		//ここから削除
 		 if(!empty($data["deleate"])){
 		 	//使用している対応方式かどうかの判定
 		 	$search = db_appointment::get_situation($data['user_id']);
 		 	$search2 = db_appointment::get_situation2($data['user_id']);
 		 	if(!empty($search) || !empty($search2)){
 		 		$data["msg"] = "[".$data['name']."]は現在使用している対応方式のため削除できません。";
 		 	}else{
 		 		db_appointment::del_user($data);
 		 		$data["msg"] = "削除しました。";
 		 	}



 		}

 		$data["namelist"] = db_appointment::get_all();
 		//$dataをviewにリターン
 		return View::forge('appointment/create',$data);

	}

}

