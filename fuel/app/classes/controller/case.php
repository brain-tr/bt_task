<?php
use \Model\Db_case;
use \Model\Loginout;
use \Model\Workbench;
class Controller_Case extends Controller
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
	 *	要求フラグ一覧画面
	*/
	public function action_index()
	{
		// ログイン情報
// 		$data['userlog_id']		= $_SESSION['id'];
		$data['userlog_name']	= $_SESSION['name'];
// 		$data['userlog_adflag'] = $_SESSION['admin_flag'];
		// POST
		$post = Input::post();
		$data['name']				= \Model\db_case::get_name();
 		$data["msg"]		=	empty($post["msg"])?"1": $post["msg"];
		$data["check"]		=	empty($post["check"])? "" : $post["check"];
		$data["check2"]		=	empty($post["check2"])? "" : $post["check2"];
		$data["flag_id"]	=	empty($post["flag_id"])? "" : $post["flag_id"];
		$data["sortbtn"]	=	empty($post["sortbtn"])	 ?"↑": $post["sortbtn"];
		$data["updown"]		=	empty($post["updown"])?	"asc": $post["updown"];

		// 削除（チェック = 3）
 		if($data["check"] == 3){
 			$checkName = \Model\db_case::search_flag($data);
			if(empty($checkName)){
	 			\Model\db_case::del_flag($data);
	 			$data["msg"] = "削除しました。";
				$data['name'] = \Model\db_case::get_name();
			}else{
				$data["msg"] = "このフラグは対応詳細で使われているため削除できません。";
			}
 		}
 		if($data["check2"] == 1){
 			if($data["updown"] == "asc"){
 				$data["updown"] = "desc";
 				$data["sortbtn"] = "↓";
 				$data['name'] = \Model\db_case::sort($data);
 			}else{
 				$data["updown"] = "asc";
 				$data["sortbtn"] = "↑";
 				$data['name'] = \Model\db_case::sort($data);
 			}
 		}
		return View::forge('case/index',$data);
	}

	/*
	 *	要求フラグ登録画面
	*/
	public function action_create()
	{
		// POST
		$post = Input::post();
		$data["new_name"]	=	empty($post["new_name"])? "" : $post["new_name"];
		$data["new_color"]	=	empty($post["new_color"])? "" : $post["new_color"];
		$data["check"]		=	empty($post["check"])? "" : $post["check"];
		$data["flag_id"]	=	empty($post["flag_id"])? "" : $post["flag_id"];
 		$data["msg"]		=	empty($post["msg"])?"1": $post["msg"];

 		// 登録（チェック = 1）
		if($data["check"] == 1){
			$checkName = \Model\db_case::check_flag($data);
			if(empty($checkName)){
				\Model\db_case::ins_flag($data);
				$data["msg"] = "2";
			}else{
				$data["msg"] = "既に登録されています。";
			}
		// 変更（チェック = 2）
		}else if($data["check"] == 2){
				\Model\db_case::update_flag($data);

		}

		return View::forge('case/create',$data);
	}

}

