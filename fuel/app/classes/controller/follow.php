<?php
use \Model\Db_follow;
use \Model\Loginout;
class Controller_Follow extends Controller
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
	 *	フォロー登録画面
	*/
	public function action_create()
	{
		// ログイン情報
		$data['userlog_id']		= $_SESSION['id'];
		$data['userlog_name']	= $_SESSION['name'];

		// POST
		$post = Input::post();
		$data["engineer_user_id"]	= empty($post["engineer_user_id"]) ? "" : $post["engineer_user_id"];
		$data["situation_id"]		= empty($post["situation_id"]) ? "" : $post["situation_id"];
		$data["appointment_id"]		= empty($post["appointment_id"]) ? "" : $post["appointment_id"];
		$data["project_text"]		= empty($post["project_text"]) ? "" : $post["project_text"];
		$data["content_text"]		= empty($post["content_text"]) ? "" : $post["content_text"];
		$data["remarks"]			= empty($post["remarks"]) ? "" : $post["remarks"];
		$data["create_user_name"]	= empty($post["create_user_name"]) ? "" : $post["create_user_name"];
		$data["create_user_id"]		= empty($post["create_user_id"]) ? "" : $post["create_user_id"];
		$data["start_date"]			= empty($post["start_date"]) ? date('Y-m-d') : $post["start_date"];
		$data["end_date"]			= empty($post["end_date"]) ? "" : $post["end_date"];
		$data["result"]				= empty($post["result"]) ? "" : $post["result"];
		$data["msg"]				= empty($post["msg"]) ? "1" : $post["msg"];


		if(empty($post["result"])) {

			// 報告者の検索
			$searchUser = db_follow::get_user_id($data['userlog_id']);
			$data['create_user_name']	= $searchUser['name'];
			$data['create_user_id']		= $searchUser['user_id'];

			// エンジニアの検索
			$data["engineer_user_id"]	= db_follow::engineer_list();

			// 状況フラグ検索
			$data["situation_id"]		= db_follow::situation_list();

			// 対応方式検索
			$data["appointment_id"]		= db_follow::appointment_list();

			return View::forge('follow/create', $data);

		} else {

			// ユーザーIDのセット
			$data["create_user_id"] = $data['userlog_id'];

			// フォロー情報の登録
			db_follow::ins_follow($data);

			header('Location: /list/index?today='.$data["start_date"]);
			exit();
		}



	}
}