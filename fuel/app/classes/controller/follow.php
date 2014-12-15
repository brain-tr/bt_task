<?php
use \Model\Db_follow;
use \Model\Loginout;
use \Model\Workbench;
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
		$data['userlog_adflag'] = $_SESSION['admin_flag'];

		// POST
		$post = Input::post();
		$data["engineer_user_id"]	= empty($post["engineer_user_id"]) ? "" : $post["engineer_user_id"];
		$data["situation_id"]		= empty($post["situation_id"]) ? "" : $post["situation_id"];
		$data["situation_flag"]		= empty($post["situation_flag"]) ? "" : $post["situation_flag"];
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

			//フラグ検索

			return View::forge('follow/create', $data);

		} else {

			// ユーザーIDのセット
			$data["create_user_id"] = $data['userlog_id'];

			//フラグ検索用の値をセット
			$situation_flag		= db_follow::select_flag($data);

			// フォロー情報の登録
			if(empty($situation_flag)){
				$data["end_date"]		= empty($post["start_date"]) ? date('Y-m-d') : $post["start_date"];
			}


			$last_id = db_follow::ins_follow($data);
			//メール送信
			$to = db_follow::get_sflag($data);
			$mailto = "";
			foreach($to as $val){

				if (empty($mailto)) {
					$mailto .= $val["mail"];
				} else {
					$mailto .= ",".$val["mail"];
				}
			}


			$from	 = "test";
			$subject = str_replace("{title}",			"登録",						FOLLOW_SUBJECT);
			$message = str_replace("{user_name}",		$data['userlog_name'],		FOLLOW_MESSAGE);
			$message = str_replace("{title}",			"登録",						$message);
			$message = str_replace("{follow_url}",		"http://192.168.11.50/follow/update/?follow_id=".$last_id ['LAST_INSERT_ID()']."&follow_detail_id=0",		$message);
			if(!Workbench::sendMail($mailto,"test",$subject,$message)){
				return Response::forge(View::forge('welcome/404', $data), 404);
			}

			header('Location: /list/index?today='.$data["start_date"]);
			exit;
		}
	}


	/*
	 *	フォロー変更画面
	*/
	public function action_update()
	{
		// ログイン情報
		$data['userlog_id']		= $_SESSION['id'];
		$data['userlog_name']	= $_SESSION['name'];
		$data['userlog_adflag'] = $_SESSION['admin_flag'];

		// POST
		$post = Input::post();
		$data["follow_id"]				= empty($post["follow_id"]) ? "" : $post["follow_id"];
		$data["follow_data"]			= empty($post["follow_data"]) ? "" : $post["follow_data"];
		$data["msg"]					= empty($post["msg"]) ? "1" : $post["msg"];
		$data["result"]					= empty($post["result"]) ? "" : $post["result"];
		$data["project_text"]			= empty($post["project_text"]) ? "" : $post["project_text"];
		$data["content_text"]			= empty($post["content_text"]) ? "" : $post["content_text"];
		$data["remarks"]				= empty($post["remarks"]) ? "" : $post["remarks"];
		$data["start_date"]				= empty($post["start_date"]) ? "" : $post["start_date"];
		$data['appointment_list']		= empty($post["appointment_list"]) ? "" : $post["appointment_list"];
		$data['situation_list']			= empty($post["situation_list"]) ? "" : $post["situation_list"];
		$data["remarks2"]				= empty($post["remarks2"]) ? "" : $post["remarks2"];
		$data['appointment_id']			= empty($post["appointment_id"]) ? "" : $post["appointment_id"];
		$data['appointment_id2']		= empty($post["appointment_id2"]) ? "" : $post["appointment_id2"];
		$data['detail_date']			= empty($post["detail_date"]) ? "" : $post["detail_date"];
		$data['situation_id']			= empty($post["situation_id"]) ? "" : $post["situation_id"];
		$data['situation_id2']			= empty($post["situation_id2"]) ? "" : $post["situation_id2"];
		$data['follow_detail_data']		= empty($post["follow_detail_data"]) ? "" : $post["follow_detail_data"];
		$data['follow_detail_id']		= empty($post["follow_detail_id"]) ? "" : $post["follow_detail_id"];
		$data['follow_detail_up_data']	= empty($post["follow_detail_up_data"]) ? "" : $post["follow_detail_up_data"];
		$data['detail_up']				= empty($post["detail_up"]) ? "" : $post["detail_up"];
		$data['detail_del']				= empty($post["detail_del"]) ? "" : $post["detail_del"];
		$data["remarks3"]				= empty($post["remarks3"]) ? "" : $post["remarks3"];
		$data["user_id"]				= empty($post["create_user_id"])? "" : $post["create_user_id"];

		// GET
		$get = Input::get();
		if(!empty($get['follow_id'])){
			$data["follow_id"] = $get['follow_id'];
		}
		if(!empty($get['follow_detail_id'])){
			$data["follow_detail_id"] = $get['follow_detail_id'];
		}

		// 数字に変換
		if (!empty($data["result"])){
			if($data["result"] == "変更する") {
				$data["result"] = "1";
			} else if($data["result"] == "削除する") {
				$data["result"] = "2";
			}
		}

		// 変更処理
		if($data["result"] === "1"){
			$checkFollow = db_follow::get_follow($data["follow_id"]);		// フォローの検索
			if(!empty($checkFollow)) {
				db_follow::upd_follow($data);
				db_follow::ins_update($data);

				//メール送信
				$to = db_follow::get_sflag($data);
				$mailto = "";
				foreach($to as $val){

					if (empty($mailto)) {
						$mailto .= $val["mail"];
					} else {
						$mailto .= ",".$val["mail"];
					}
				}


				$from	 = "test";
				$subject = str_replace("{title}",			"変更",						FOLLOW_SUBJECT);
				$message = str_replace("{user_name}",		$data['userlog_name'],		FOLLOW_MESSAGE);
				$message = str_replace("{title}",			"変更",						$message);
				$message = str_replace("{follow_url}",		"http://192.168.11.50/follow/update/?follow_id=".$data["follow_id"]."&follow_detail_id=0",		$message);
				if(!Workbench::sendMail($mailto,"test",$subject,$message)){
					return Response::forge(View::forge('welcome/404', $data), 404);
				}
				$data["msg"] = "フォロー情報を変更しました。";
			} else {
				$data["msg"] = "フォロー情報がみつかりません。データを確認してください。";
			}


		// 削除処理
		} else if($data["result"] === "2") {
			$checkFollow = db_follow::get_follow($data["follow_id"]);	// フォローの検索
			if(!empty($checkFollow)) {
				db_follow::follow_del_flag($data['follow_id']);
				//メール送信
				$to = db_follow::get_sflag($data);
				$mailto = "";
				foreach($to as $val){

					if (empty($mailto)) {
						$mailto .= $val["mail"];
					} else {
						$mailto .= ",".$val["mail"];
					}
				}


				$from	 = "test";
				$subject = str_replace("{title}",			"削除",						FOLLOW_SUBJECT);
				$message = str_replace("{user_name}",		$data['userlog_name'],		FOLLOW_MESSAGE);
				$message = str_replace("{title}",			"削除",						$message);
				$message = str_replace("{follow_url}",		"http://192.168.11.50/list",		$message);
				if(!Workbench::sendMail($mailto,"test",$subject,$message)){
					return Response::forge(View::forge('welcome/404', $data), 404);
				}

				$data["msg"] = "フォロー情報を一覧から削除しました。";
				header('Location: /list/index?msg='.$data["msg"]."&today=".$data["start_date"]);
				exit;
			} else {
				$data["msg"] = "フォロー情報がみつかりません。データを確認してください。";
			}


		// フォロー情報の追加
		} else  if($data["result"] === "3") {
			//フラグ検索用の値をセット
			$situation_flag		= db_follow::select_child($data);
// 			var_dump($situation_flag);

			if(!empty($situation_flag)){
				db_follow::upd_follow_detail2($data);
			}


			$last_id = db_follow::ins_follow_detail($data);
			//メール送信
			$to = db_follow::get_sflag($data);
			$mailto = "";
			foreach($to as $val){

				if (empty($mailto)) {
					$mailto .= $val["mail"];
				} else {
					$mailto .= ",".$val["mail"];
				}
			}


			$from	 = "test";
			$subject = str_replace("{title}",			"詳細登録",						FOLLOW_SUBJECT);
			$message = str_replace("{user_name}",		$data['userlog_name'],		FOLLOW_MESSAGE);
			$message = str_replace("{title}",			"詳細登録",						$message);
			$message = str_replace("{follow_url}",		"http://192.168.11.50/follow/update/?follow_id=".$data["follow_id"]."&follow_detail_id=".$last_id ['LAST_INSERT_ID()']."",		$message);

			if(!Workbench::sendMail($mailto,"test",$subject,$message)){
				return Response::forge(View::forge('welcome/404', $data), 404);
			}
			$data["msg"] = "フォロー詳細情報を登録しました。";
		}


		// フォロー詳細情報の取得
		if(!empty($data['follow_detail_id'])){
			$data['follow_detail_up_data'] = db_follow::get_follow_detail($data['follow_detail_id']);
			//var_dump($data['follow_detail_up_data']);
		}

		// フォロー詳細情報の変更
		if(!empty($data['detail_up'])) {
			$detail_up_data = db_follow::get_follow_detail($data['follow_detail_id']);
			if(!empty($detail_up_data)) {
				db_follow::upd_follow_detail($data);
				db_follow::ins_update($data);
				//メール送信
				$to = db_follow::get_sflag($data);
				$mailto = "";
				foreach($to as $val){

					if (empty($mailto)) {
						$mailto .= $val["mail"];
					} else {
						$mailto .= ",".$val["mail"];
					}
				}


				$from	 = "test";
				$subject = str_replace("{title}",			"詳細変更",						FOLLOW_SUBJECT);
				$message = str_replace("{user_name}",		$data['userlog_name'],		FOLLOW_MESSAGE);
				$message = str_replace("{title}",			"詳細変更",						$message);
				$message = str_replace("{follow_url}",		"http://192.168.11.50/follow/update/?follow_id=".$data["follow_id"]."&follow_detail_id=".$data["follow_detail_id"]."",		$message);

				if(!Workbench::sendMail($mailto,"test",$subject,$message)){
					return Response::forge(View::forge('welcome/404', $data), 404);
				}

				$data["msg"] = "フォロー詳細情報を変更しました。";
				header('Location: /list/index?msg='.$data["msg"]."&today=".$data["detail_date"]);
				exit;

			} else {
				$data["msg"] = "対象のフォロー詳細情報が見つかりません。データを確認してください。";
			}
		}

		// フォロー詳細情報の削除フラッグを設定
		if(!empty($data['detail_del'])){
			$detail_up_data = db_follow::get_follow_detail($data['follow_detail_id']);
			if(!empty($detail_up_data)) {
				db_follow::upd_follow_detail_del($data);
				//メール送信
				$to = db_follow::get_sflag($data);
				$mailto = "";
				foreach($to as $val){

					if (empty($mailto)) {
						$mailto .= $val["mail"];
					} else {
						$mailto .= ",".$val["mail"];
					}
				}


				$from	 = "test";
				$subject = str_replace("{title}",			"詳細削除",						FOLLOW_SUBJECT);
				$message = str_replace("{user_name}",		$data['userlog_name'],		FOLLOW_MESSAGE);
				$message = str_replace("{title}",			"詳細削除",						$message);
				$message = str_replace("{follow_url}",		"http://192.168.11.50/follow/update/?follow_id=".$data["follow_id"]."&follow_detail_id=0",		$message);

				if(!Workbench::sendMail($mailto,"test",$subject,$message)){
					return Response::forge(View::forge('welcome/404', $data), 404);
				}

				$data["msg"] = "フォロー詳細情報を一覧から削除しました。";
				header('Location: /list/index?msg='.$data["msg"]."&today=".$data["detail_date"]);
				exit;

			} else {
				$data["msg"] = "対象のフォロー詳細情報が見つかりません。データを確認してください。";
			}
		}

		// 対応方式の検索
		$data['appointment_list'] = db_follow::appointment_list();

		// 対応方式の検索
		$data['situation_list'] = db_follow::situation_list2();

		// フォロー情報の検索
		$data["follow_data"] = db_follow::follow_data($data["follow_id"]);

		// フォロー詳細情報の検索
		$data["follow_detail_data"] = db_follow::follow_detail_list($data["follow_id"]);

		return View::forge('follow/update', $data);
	}

	//更新者履歴の確認
	public function action_check()
	{
		//ユーザー情報の確認
		$data['userlog_id']		= $_SESSION['id'];
		$data['userlog_name']	= $_SESSION['name'];
		$data['userlog_adflag'] = $_SESSION['admin_flag'];
		//フォローid取得用
		$get = Input::get();
		$follow_id	= empty($get["id"]) ? "" : $get["id"];

		$data["show"] = db_follow::get_change($data,$follow_id);

		return View::forge('follow/check',$data,$follow_id);
	}

}

