<?php
use \Model\Db_matter;
use \Model\Loginout;
use \Model\Workbench;
class Controller_Matter extends Controller
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
	 *	顧客対応登録画面
	*/
	public function action_create()
	{
		// ログイン情報
 		$data['userlog_id']		= $_SESSION['id'];
		$data['userlog_name']	= $_SESSION['name'];
// 		$data['userlog_adflag'] = $_SESSION['admin_flag'];
		// POST
		$post = Input::post();
		$data["c_id"]	=	empty($post["company_id"])?"": $post["company_id"];
		$data["date"]	=	empty($post["date"])	?  "": $post["date"];
		$data["detail"]	=	empty($post["detail"])	?  "": $post["detail"];
		$data["user"]	=	empty($post["user"])	?  "": $post["user"];
		$data["check"]	=	empty($post["check"])	?  "": $post["check"];
		$data["msg"]	=	empty($post["msg"])		?  "": $post["msg"];

		if($data["check"]==1 && empty($data["user"])){
			$data["msg"]	=	"対応者名は必須項目です。";
		}else if($data["check"]==1 && empty($data["c_id"])){
			$data["msg"] = "顧客会社を選択してください。";
		}else if($data["check"]==1 && !empty($data["user"]) && !empty($data["c_id"])){
			$check	=	db_matter::check_matter($data);
			if(empty($check)){
				db_matter::ins_matter($data);
			}
		}

		return View::forge('matter/create',$data);
	}

	/*
	 *	顧客会社名検索用サブウインドウ
	 */

	public function action_search()
	{
		// POST
		$post = Input::post();
		$data["s_name"]	=	empty($post["s_name"])?"" : $post["s_name"];
		$data["check"]	=	empty($post["check"])? "" : $post["check"];

		if($data["check"]==1){
			$data["name"] = db_matter::search_name($data["s_name"]);
		}else{
			$data["name"]	=	db_matter::all_name();
		}
		return View::forge('matter/search',$data);
	}

	/*
	 *	顧客対応変更画面
	 */
	public function action_update()
	{
		// ログイン情報
		$data['userlog_id']		= $_SESSION['id'];
		$data['userlog_name']	= $_SESSION['name'];
		// POST
		$post = Input::post();
		$data["c_id"]	=	empty($post["company_id"])?"": $post["company_id"];
		$data["date"]	=	empty($post["date"])	?  "": $post["date"];
		$data["detail"]	=	empty($post["detail"])	?  "": $post["detail"];
		$data["user"]	=	empty($post["user"])	?  "": $post["user"];
		$data["check"]	=	empty($post["check"])	?  "": $post["check"];
		$data["m_id"]	=	empty($post["matter_id"])? "": $post["matter_id"];
		$data["list_id"]=	empty($post["list_id"])?   "": $post["list_id"];
		$data["check2"] =	empty($post["flag"])?	   "": $post["flag"];

		//一覧から遷移してきた時の処理
		if($data["check2"]==1 && !empty($data["list_id"])){
			//表示用
			$data["view"]	=	db_matter::get_matter($data["list_id"]);
		}

		//変更した時の処理
		if($data["check"]==1 && !empty($data["user"])){
			db_matter::upd_matter($data);
			db_matter::ins_updated($data);
			//表示用
			$data["view"]	=	db_matter::get_matter($data["m_id"]);
		}
		return view::forge('matter/update',$data);
	}




}

