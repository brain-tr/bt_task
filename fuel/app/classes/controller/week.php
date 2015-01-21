<?php
use \Model\Db_matter;
use \Model\Loginout;
use \Model\Workbench;
use Model\db_week;
class Controller_Week extends Controller
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
	 *	顧客対応一覧画面（週表示）
	*/
	public function action_index()
	{
		//POST
		$post = Input::post();
		$data["flg1"]	=	empty($post["flg1"])? "" : $post["flg1"];
		$data["search"] =	empty($post["search"])?"": $post["search"];
		$data["check1"] =	empty($post["check1"])?"": $post["check1"];
		$data["check2"] =	empty($post["check2"])?"": $post["check2"];
		$data["check3"] =	empty($post["check3"])?"": $post["check3"];
		$data["person"] =	empty($post["respon"])?"": $post["respon"];
		$data["delete"]		=	empty($post["delete"])? "": $post["delete"];
		$data["del"]		=	empty($post["del"])	?	"": $post["del"];


		//日付取得用の処理
		$data["year"]	= date('Y');
		$data["month"]	= date('m');
		$data["lastweek"]	= intval(date('d')) - 6;
		$data["week"]	= date('d');
		$data["calendar"]	= array();
		$cnt	=0;
		for($i=0; $i< 7; $i++){
			$data["calendar"][$i]['day'] = $data["lastweek"] + $i;
		}

		//注意：一括削除はまだできていません
		//単体削除はできます。
		if($data["check3"]==1){
			//一括削除処理
			if(!empty($data["del"])){
				for($i=0; $i<count($data["del"]); $i++){
					db_week::del_matter($data["del"][$i]);
				}
				//削除ボタン 単体削除
			}else if(!empty($data["delete"])){
				db_week::del_matter($data["delete"]);
			}
		}

		//会社名検索用表示
		if($data["check1"] == 1 && !empty($data["search"])){
			$data["company"] = db_matter::search_list($data["search"]);
		}else if($data["check2"]==1 && !empty($data["person"]) && $data["person"] != '----'){
			$data["company"] = db_matter::search_respon($data["person"]);
		}else{
			//初期表示
			$data["company"] = db_matter::get_list();
		}






		//対応者セレクトボックス表示用
		$data["respon"]	=	db_matter::get_respon();
		//本日の日付(表示用)
		$data["today"]	=	date("Y年m月d日");

		return View::forge('week/index',$data);
	}




}

