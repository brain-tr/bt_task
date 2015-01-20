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
 		$data["msg"]				= empty($post["msg"])?"1": $post["msg"];
		$data["check"]	=	empty($post["check"])? "" : $post["check"];
		$data["flag_id"]	=	empty($post["flag_id"])? "" : $post["flag_id"];

 		if($data["check"] == 3){
 			\Model\db_case::del_flag($data);
 			$data["msg"] = "削除しました。";
 		}
		$data['name']				= \Model\db_case::get_name();
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
		$data["check"]	=	empty($post["check"])? "" : $post["check"];
		$data["flag_id"]	=	empty($post["flag_id"])? "" : $post["flag_id"];
 		$data["msg"]				= empty($post["msg"])?"1": $post["msg"];

		if($data["check"] == 1){
			$checkName = \Model\db_case::check_flag($data);
			if(empty($checkName)){
				\Model\db_case::ins_flag($data);
				$data["msg"] = "2";
			}else{
				$data["msg"] = "既に登録されています。";
			}
		}else if($data["check"] == 2){
				\Model\db_case::update_flag($data);

		}

		return View::forge('case/create',$data);
	}

}

