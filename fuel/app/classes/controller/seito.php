<?php
use \Model\Db_seitoname;

class Controller_Seito extends Controller
{

	public function action_index()
	{

		 $post				=	Input::post();
		 $data["name"]		=	empty($post["name"]) ? "": $post["name"];
		 $data["ins"]		=	empty($post["ins"]) ? "": $post["ins"];
		 $data['user_id']	= empty($post["id"]) ? "": $post["id"];
		 $data['send']		=	empty($post["send"]) ? "": $post["send"];
 		 $data["get"]		= empty($post["get"]) ? 1 : $post["get"];
 		 $data["delete"]	= empty($post["delete"]) ? "" : $post["delete"];
		 $data["msg"]		= empty($post["msg"]) ? "1" : $post["msg"];
 		 $data["id"]		=	db_seitoname::get_id();

		 if($data["send"]=="登録"){
		 	$data["send"]=1;
		 }else if($data["send"]=="変更"){
		 	$data["send"] = 2;
		 }

		//登録
		if(!empty($post["get"]) && $data["send"] == 1) {

			if(empty($data["name"])) {
				//$data['msg'] = "名前が入力されていません。";
			} else {
				$user_name = db_seitoname::get_name($data['name']);
				if(empty($user_name)) {
					db_seitoname::ins_name($data);
					$data['msg'] = "ユーザー情報を登録しました。";
				} else {
					$data['msg'] = "すでに登録されている名前です。";
				}
			}
		 //変更
 		}else if(!empty($post["get"]) && $data["send"] == 2) {
 			if(!empty($post["name"])){
 				$user_id = db_seitoname::get_id($data['user_id']);
 				$user_name = db_seitoname::get_name($data['name']);
 			if(!empty($user_id) &&($user_name)==false) {
 				db_seitoname::change_name($data);
 			}else{
 				$data["msg"] = "同じ名前が存在するため変更できませんでした。";
 			}
 			}
 		}

 		//削除
 		 if(!empty($data["delete"])){

 			db_seitoname::delete_user($data);
 			$data["msg"] = "削除しました。";

 		}




 		$data["namelist"] = db_seitoname::get_all();
 		return View::forge('seito',$data);

	}

}