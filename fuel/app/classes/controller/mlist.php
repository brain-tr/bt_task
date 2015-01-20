<?php
use \Model\Db_matter;
use \Model\Loginout;
use Model\db_customer;
class Controller_Mlist extends Controller
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
	 *	顧客対応一覧画面
	*/
	public function action_index()
	{
		//POST
		$post = Input::post();
		$data["flg1"]	=	empty($post["flg1"])? "" : $post["flg1"];
		$data["search"] =	empty($post["search"])?"": $post["search"];
		$data["check1"] =	empty($post["check1"])?"": $post["check1"];
		$data["check2"] =	empty($post["check2"])?"": $post["check2"];
		$data["person"] =	empty($post["respon"])?"": $post["respon"];


		//日付取得用の処理
		$data["year"]	= date('Y');
		$data["month"]	= date('m');
		$data["lastday"]	= date('t');
		$data["calendar"]	= array();
		$cnt	=0;
		for($i=1; $i<$data["lastday"]+1; $i++){
			$week = date('w', mktime(0, 0, 0, $data["month"], $i, $data["year"]));
			if ($i == 1) {
				for ($s = 1; $s <= $week; $s++) {
					$data["calendar"][$cnt]['day'] = '';
					$cnt++;
				}
			}
			$data["calendar"][$cnt]['day'] = $i;
			$cnt++;
			if ($i == $data["lastday"]) {
				for ($e = 1; $e <= 6 - $week; $e++) {
					$data["calendar"][$cnt]['day'] = '';
					$cnt++;
				}
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

		return View::forge('mlist/index',$data);
	}
}