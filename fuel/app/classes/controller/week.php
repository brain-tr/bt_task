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
		parent::before();
		session_cache_limiter('none');
		session_start();
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
		$data["check4"] =	empty($post["check4"])?"": $post["check4"];
		$data["person"] =	empty($post["respon"])?"": $post["respon"];
		$data["delete"]		=	empty($post["delete"])? "": $post["delete"];
		$data["del"]		=	empty($post["del"])	?	"": $post["del"];
		$data["msg"]	=	empty($post["msg"])?   "": $post["msg"];
		$data["today"]	=	empty($post["today"])?   "": $post["today"];
		$data["cnt_week"]	=	empty($post["cnt_week"])?   "0": $post["cnt_week"];
		$data["weekchange"]	=	empty($post["weekchange"])?   "": $post["weekchange"];

		//日付取得用の処理
		$data["year"]	= date('Y');
		$data["month"]	= date('m');
		$data["lastday"] = date('t');
		$data["week"]	= date('d');
		// 基準日付
		$tday	= date("Y-m-d");
		$tday_y	= date("Y");
		$tday_m	= date("m");
		$tday_d	= date("d");
		$data["calendar"]	= array();
		$data["calendar2"]	= array();
		//先週表示
		if($data["check4"]==1){
			$data["cnt_week"]  += 1;
		//翌週表示
		}else if($data["check4"]==2){
			$data["cnt_week"]  -= 1;
		}
		$data["year"]	= date('Y', mktime(0, 0, 0, $tday_m, $tday_d-$data["cnt_week"]*7, $tday_y));
		$data["month"]	= date('m', mktime(0, 0, 0, $tday_m, $tday_d-$data["cnt_week"]*7, $tday_y));
		$data["lastday"] = date('t', mktime(0, 0, 0, $tday_m, $tday_d-$data["cnt_week"]*7, $tday_y));
		$data["week"]	= date('d', mktime(0, 0, 0, $tday_m, $tday_d-$data["cnt_week"]*7, $tday_y));
		//日付を入れる作業
		$cnt	= 1;
		for($i=0; $i< 7; $i++){
			//最終日までは日にちをそのまま入力
			if($data["week"] + $i <= $data["lastday"]){
				$data["calendar"][$i]['day'] = $data["week"] + $i;
			//最終日を過ぎるとカウンターで日にちを入力
			}else{
				$data["calendar"][$i]['day'] = $cnt;
				$cnt += 1;
			}
		}
		//年月日を入れる作業
		for($i=0; $i< 7; $i++){
			$data["calendar2"][$i] = date('Y-m-d', mktime(0, 0, 0, $tday_m, $tday_d-$data["cnt_week"]*7+$i, $tday_y));
		}

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
			$data["msg"] = $data["company"][0]["company_name"];
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
		$data["today1"]	=	date("Y年m月d日", mktime(0, 0, 0, $data["month"], $data["week"], $data["year"]));
		$data["today2"]	=	date("Y年m月d日", mktime(0, 0, 0, $data["month"], $data["week"]+6, $data["year"]));

		return View::forge('week/index',$data);
	}




}

