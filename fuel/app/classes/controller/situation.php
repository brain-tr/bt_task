<?php

use \Model\Db_situation,\Model\Db_follow;
use \Model\Loginout;
class Controller_Situation extends Controller
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
	 *	状況フラグ登録更新画面
	*/
	public function action_create()
	{
		// ログイン情報
		$data['userlog_id']		= $_SESSION['id'];
		$data['userlog_name']	= $_SESSION['name'];

		// POST
		$post = Input::post();
		$data["name"]			= empty($post["name"]) ? "" : $post["name"];
		$data["color_code"]		= empty($post["color_code"]) ? "" : $post["color_code"];
		$data["flag"]			= isset($post["flag"]) ? $post["flag"] : 1;
		$data["result"]			= empty($post["result"]) ? 1 : $post["result"];
		$data["situation_id"]	= empty($post["situation_id"]) ? "" : $post["situation_id"];
		$data["btn_send"]		= empty($post["btn_send"]) ? "" : $post["btn_send"];
		$data["msg"]			= empty($post["msg"]) ? "1" : $post["msg"];
		$data["delete"]			= empty($post["delete"]) ? "" : $post["delete"];

 		// ボタン数字化
		if($data["btn_send"] == "この内容で登録する") {
			$data["btn_send"] = 1;
		} else {
			$data["btn_send"] = 2;
		}

	// 情報を登録
		if(!empty($post["result"]) && $data["btn_send"] == 1) {

			if(empty($data["name"])) {
				$data['msg'] = "状況名が入力されていません。";
			} else {
				$searchName = db_situation::get_situation_name($data['name']);	//名前を検索
				if(empty($searchName)) {
					db_situation::ins_situation($data);
					$data['msg'] = "状況内容を登録しました。";
				} else {
					$data['msg'] = "すでに登録されている状況名です。";
				}
			}

		// 情報の変更
		} else if(!empty($post["result"]) && $data["btn_send"] == 2 && empty($data['delete'])) {

			if(empty($data["name"])) {
				$data['msg'] = "状況名が入力されていません。";
			} else {
				$searchName = db_situation::get_situation_id($data["situation_id"]);	//idを検索
				if(!empty($searchName)) {
					db_situation::upd_situation($data);
					$data['msg'] = "状況を変更しました。";
				} else {
					$data['msg'] = "変更対象の状況が見つかりません。データを確認してください。";
				}
			}

		// 情報の削除
		} else if(!empty($post["result"]) && $data["btn_send"] == 2 && !empty($data['delete'])) {
			$search = db_follow::get_situation($data["situation_id"]);
			$search2 = db_follow::get_situation2($data["situation_id"]);
			//t_followとt_follow_detailに一致するsituation_idの有無を確認
			if(!empty($search) || !empty($search2)){
				$data["msg"] = $data['name']."は現在使用している状況のため削除できません。";
			}else{
				db_situation::delete_situation($data["situation_id"]);
				$data['msg'] = "状況を削除しました。";
			}
		}
		//var_dump($data);
		//exit;

		// 情報を検索
		$data['stationData'] = db_situation::situation_list();

		// var_dump($data);
		return View::forge('situation/create', $data);
	}
}