<?php

use \Model\Db_user;
use \Model\Loginout;
class Controller_Login extends Controller
{
	/*
	 * セッション情報の確認
	*/
// 	public function before()
// 	{
// 		parent::before();
// 		if (!Loginout::logincheck()){
// 			header('Location: /top/');
// 			exit();
// 		}
// 	}

	/*
	 * ログイン画面
	*/
	public function action_index()
	{
		session_start();

		// POST
		$post = Input::post();
		$data["mail"]			= empty($post["mail"]) ? "" : $post["mail"];
		$data["password"]		= empty($post["password"]) ? "" : $post["password"];
		$data["msg"]			= empty($post["msg"]) ? "1" : $post["msg"];
		$data["result"]			= empty($post["result"]) ? "" : $post["result"];

		if(!empty($post['result'])){

			// 入力チェック
			if(empty($_POST['mail']) || empty($_POST['password'])) {
				$data['msg'] = "メールアドレスまたはパスワードを入力してください。";
			} else {

				// ログインチェック
				$user = db_user::confirm_user($data['mail'],$data['password']);
				if (empty($user)) {
					$data['msg'] = "メールアドレスもしくはパスワードが異なります。";
					return View::forge('login/index',$data);
				} else {
					$_SESSION['id']		= $user["user_id"];
					$_SESSION['name']	= $user["name"];
					$_SESSION['admin_flag']= $user["admin_flag"];
					header('Location: /menu');
					exit();
				}
			}
		}
		return View::forge('login/index',$data);
	}


	// ログアウト画面
	public function action_logout()
	{
		session_start();

		// セッションのクリア
		unset($_SESSION['id']);
		unset($_SESSION['name']);
		unset($_SESSION['admin_flag']);

		header('Location: /login/');
		exit();
	}
}