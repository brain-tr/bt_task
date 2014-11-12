<?php
use \Model\Db_user;
class Controller_User extends Controller
{

	public function action_index()
	{
	}
	/*
	 *	ユーザー登録画面
	*/
	public function action_create()
	{
		// POST
		$post = Input::post();
		$data["name"]		= empty($post["name"]) ? "" : $post["name"];
		$data["mail"]		= empty($post["mail"]) ? "" : $post["mail"];
		$data["job_type"]	= empty($post["job_type"]) ? "" : $post["job_type"];
		$data["send_flag"]	= empty($post["send_flag"]) ? 0 : $post["send_flag"];
		$data["msg"]		= empty($post["msg"]) ? "1" : $post["msg"];
		$data["result"]		= empty($post["result"]) ? 1 : $post["result"];
		$data["user_id"]	= empty($post["user_id"]) ? "" : $post["user_id"];
		$data["btn_send"]	= empty($post["btn_send"]) ? "" : $post["btn_send"];
		$data["delete"]		= empty($post["delete"]) ? "" : $post["delete"];

		// ボタン数字化
		if($data["btn_send"] == "この内容で登録する") {
			$data["btn_send"] = 1;
		} else {
			$data["btn_send"] = 2;
		}

		// 情報を登録
		if(!empty($post["result"]) && $data["btn_send"] == 1) {

			if(empty($data["name"])) {
				$data['msg'] = "名前が入力されていません。";
			} else {
				$searchName = db_user::get_user_name($data['name']);	//名前を検索
				if(empty($searchName)) {
					db_user::ins_user($data);
					$data['msg'] = "ユーザー情報を登録しました。";
				} else {
					$data['msg'] = "すでに登録されている名前です。";
				}
			}

		// 情報の変更
		} else if(!empty($post["result"]) && $data["btn_send"] == 2) {

			if(empty($data["name"])) {
				$data['msg'] = "名前が入力されていません。";
			} else {
				$searchName = db_user::get_user_id($data["user_id"]);	//idを検索
				if(!empty($searchName)) {
					db_user::upd_user($data);
					$data['msg'] = "ユーザー情報を変更しました。";
				} else {
					$data['msg'] = "変更ユーザーが見つかりません。データを確認してください。";
				}
			}
		}

		// 情報の削除
		if(!empty($data["delete"])){
			db_user::delete_user($data["user_id"]);
			$data['msg'] = "ユーザー情報を削除しました。";
		}

		// 登録情報を検索
		$data['userData'] = db_user::user_list();

	// var_dump($data);
	return View::forge('user/create', $data);
	}
}