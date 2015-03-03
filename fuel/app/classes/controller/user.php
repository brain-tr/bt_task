<?php

use \Model\Db_user;
use \Model\User;
use \Model\Loginout;
class Controller_User extends Controller
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

	/*
	 *	ユーザー登録画面
	*/
	public function action_create()
	{
		// ログイン情報
		$data['userlog_id']		= $_SESSION['id'];
		$data['userlog_name']	= $_SESSION['name'];
		$data['userlog_adflag'] = $_SESSION['admin_flag'];

		// POST
		$post = Input::post();
		$data["name"]			= empty($post["name"]) ? "" : $post["name"];
		$data["mail"]			= empty($post["mail"]) ? "" : $post["mail"];
		$data["job_type"]		= empty($post["job_type"]) ? "" : $post["job_type"];
		$data["send_flag"]		= empty($post["send_flag"]) ? 0 : $post["send_flag"];
		$data["msg"]			= empty($post["msg"]) ? "1" : $post["msg"];
		$data["result"]			= empty($post["result"]) ? 1 : $post["result"];
		$data["user_id"]		= empty($post["user_id"]) ? "" : $post["user_id"];
		$data["rank_id"]		= empty($post["rank_id"]) ? "10" : $post["rank_id"];
		$data["btn_send"]		= empty($post["btn_send"]) ? "" : $post["btn_send"];
		$data["delete"]			= empty($post["delete"]) ? "" : $post["delete"];
		$data["password"]		= empty($post["password"]) ? "" : $post["password"];
		$data["password_conf"]	= empty($post["password_conf"]) ? "" : $post["password_conf"];

		// ボタン数字化
		if($data["btn_send"] == "この内容で登録する") {
			$data["btn_send"] = 1;
		} else if($data["btn_send"] == "この内容で変更する"){
			$data["btn_send"] = 2;
		}

		// 情報を登録
		if(!empty($post["result"]) && $data["btn_send"] == 1) {

			// 入力チェック
			$flag = array(1,2,3,4,5,6);
			$check = User::check_php($flag,$data['name'],$data['password'],$data['password_conf']);

			if(empty($check)){
				$searchName = db_user::get_user_name($data['name']);	//名前を検索
				if(empty($searchName)) {
					db_user::ins_user($data);
					$data['msg'] = "ユーザー情報を登録しました。";
				} else {
					$data['msg'] = "すでに登録されている名前です。";
				}
			} else {
				$data["msg"] = $check;
			}

		// 情報の変更
		} else if(!empty($post["result"]) && $data["btn_send"] == 2) {

			// 入力チェック
			$flag = array(1);
			$check = User::check_php($flag,$data['name'],$data['password'],$data['password_conf']);

			if(empty($check)){
				$searchName = db_user::get_user_id($data["user_id"]);	//idを検索
				if(!empty($searchName)) {
					db_user::upd_user($data);
					$data['msg'] = "ユーザー情報を変更しました。";
				} else {
					$data['msg'] = "変更ユーザーが見つかりません。データを確認してください。";
				}
			} else {
				$data["msg"] = $check;
			}
		}

		// 情報の削除
		if(!empty($data["delete"])) {
			$searchName = db_user::get_user_id($data["user_id"]);	//idを検索
			if(!empty($searchName)) {
				db_user::delete_user($data["user_id"]);
				$data['msg'] = "ユーザー情報を削除しました。";
			} else {
					$data['msg'] = "削除ユーザーが見つかりません。データを確認してください。";
			}
		}

		// 登録情報を検索
		$data['userData'] = db_user::user_list();
		return View::forge('user/create', $data);
	}



	/*
	 *	サブウィンドウ（パスワードの変更）
	*/
	public function action_pass()
	{
		// ログイン情報
		$data['userlog_id']		= $_SESSION['id'];
		$data['userlog_name']	= $_SESSION['name'];

		// GET
		$get = Input::get();
		$data["user_id"]	= empty($get["user"]) ? "" : $get["user"];

		// POST
		$post = Input::post();
		$data["password"]		= empty($post["password"]) ? "" : $post["password"];
		$data["new_pass"]		= empty($post["new_pass"]) ? "" : $post["new_pass"];
		$data["new_pass_conf"]	= empty($post["new_pass_conf"]) ? "" : $post["new_pass_conf"];
		$data["btn_send"]		= empty($post["btn_send"]) ? "" : $post["btn_send"];
		$data["pass_up"]		= empty($post["pass_up"]) ? 1 : $post["pass_up"];
		$data["msg"]			= empty($post["msg"]) ? "1" : $post["msg"];
		if(!empty($post["user_id"])){
			$data["user_id"]	= $post["user_id"];
		}

		// パスワードの変更
		$box = 1;
		if(!empty($post['pass_up'])){
			$searchName = db_user::get_user_id($data["user_id"]);	//idを検索
			if(!empty($searchName)){

				if(empty($data["password"]) || empty($data["new_pass"]) || empty($data["new_pass_conf"])) {
					$data['msg'] = "空欄があります。入力内容を確認してください。";
					$box = 1;
				} else {

					// 入力チェック
					$flag = array(2,3,4,5,6);
					$check = User::check_php($flag,$data['password'],$data['new_pass'],$data['new_pass_conf']);
					if(empty($check)){
						if($searchName['password'] != $data['password']) {
							$data['msg'] = "現在のパスワードが違います。";
							$box = 1;
						} else {
							db_user::upd_user_pass($data);
							$data['msg'] = "パスワードを変更しました。";
							$box = 2;
						}
					} else {
						$data["msg"] = $check;
						$box = 1;
					}
				}
			} else {
				$data['msg'] = "変更対象ユーザーが見つかりません。データを確認してください。";
				$box = 2;
			}
		}

		switch($box) {
			case 1:
				return View::forge('user/pass', $data);
				break;
			case 2:
				return View::forge('user/close', $data);
				break;
		}
	}
}