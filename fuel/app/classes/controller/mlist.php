<?php
use \Model\Db_matter;
use \Model\Loginout;
use Model\db_customer;
use Model\db_case;
class Controller_Mlist extends Controller
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
	 *	顧客対応一覧画面
	*/
	public function action_index()
	{
		// ログイン情報
		$data['userlog_id']		= $_SESSION['id'];
		$data['userlog_name']	= $_SESSION['name'];
		$data['userlog_adflag'] = $_SESSION['admin_flag'];

		//POST
		$post = Input::post();
		$data["flg1"]	=	empty($post["flg1"])? "" : $post["flg1"];
		$data["search"] =	empty($post["search"])?"": $post["search"];
		$data["check1"] =	empty($post["check1"])?"": $post["check1"];
		$data["check2"] =	empty($post["check2"])?"": $post["check2"];
		$data["check4"] =	empty($post["check4"])?"": $post["check4"];
		$data["person"] =	empty($post["respon"])?"": $post["respon"];
		$data["name"]   =	empty($post["name"])?  "": $post["name"];
		$data["msg"]	=	empty($post["msg"])?   "": $post["msg"];
		$data["today"]	=	empty($post["today"])?   "": $post["today"];
		$data["cnt_week"]	=	empty($post["cnt_week"])?   "0": $post["cnt_week"];
		$data["weekchange"]	=	empty($post["weekchange"])?   "": $post["weekchange"];


		//日付取得用の処理
		$data["year"]	= date('Y');
		$data["month"]	= date('m');
		$data["lastday"]= date('t');
		// 基準日付
		$tday	= date("Y-m-d");
		$tday_y	= date("Y");
		$tday_m	= date("m");
		$tday_d	= date("d");
		$data["calendar"]	= array();
		//先月表示
		if($data["check4"]==1){
			$data["cnt_week"]  += 1;
			$data["year"]	= date('Y', mktime(0, 0, 0, $tday_m-$data["cnt_week"], 1, substr($tday,0,4)));
			$data["month"]	= date('m', mktime(0, 0, 0, $tday_m-$data["cnt_week"], 1, substr($tday,0,4)));
			$data["lastday"] = date('t', mktime(0, 0, 0, $tday_m-$data["cnt_week"], 1, substr($tday,0,4)));
		//翌月表示
		}else if($data["check4"]==2){
			$data["cnt_week"]  -= 1;
			$data["year"]	= date('Y', mktime(0, 0, 0, $tday_m-$data["cnt_week"], 1, $tday_y));
			$data["month"]	= date('m', mktime(0, 0, 0, $tday_m-$data["cnt_week"], 1, $tday_y));
			$data["lastday"] = date('t', mktime(0, 0, 0, $tday_m-$data["cnt_week"], 1, $tday_y));
		//対応者検索で月を固定させておく場合
		}else if($data["check4"]==3){
			$data["year"]	= date('Y', mktime(0, 0, 0, substr($tday,5,2)-$data["cnt_week"], 1, substr($tday,0,4)));
			$data["month"]	= date('m', mktime(0, 0, 0, substr($tday,5,2)-$data["cnt_week"], 1, substr($tday,0,4)));
			$data["lastday"] = date('t', mktime(0, 0, 0, substr($tday,5,2)-$data["cnt_week"], 1, substr($tday,0,4)));
		}
		//カレンダーに空白をいれる作業
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

		return View::forge('mlist/index',$data);
	}

	//顧客会社名検索用サブウインドウ
	public function action_csearch()
	{
		//POST
		$post = Input::post();
		$data["check"] = empty($post["check"])? "" : $post["check"];
		$data["s_name"]= empty($post["s_name"])?"" : $post["s_name"];

		if($data["check"]==1 && !empty($data["s_name"])){
			$data["name"] = db_matter::search_cname($data["s_name"]);
		}else{
			$data["name"] = db_matter::all_name();
		}
		return View::forge('mlist/csearch',$data);
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

		return View::forge('mlist/search',$data);
	}

	public function action_searchid($company_id)
	{
		$rtn_html = array();
		$data	=	db_customer::get_customer($company_id,0);
		$html = "";

		if (!empty($data)){
			$html = '<table class="tableStyle8"><tr><th>名前</th><th>TEL</th><th>Mail</th><th>備考</th></tr>';
			foreach($data as $key => $val){
				$html .= '<tr><td><input type="text" class="disabled" disabled style="width:110px" value="'.$val["name"].'"></td>';
				$html .= '<td><input type="text" class="disabled" disabled style="width:110px" value="'.$val["tel"].'"></td>';
				$html .= '<td><input type="text" class="disabled" disabled style="width:270px" value="'.$val["mail"].'"></td>';
				$html .= '<td><input type="text" class="disabled" disabled style="width:250px" value="'.$val["remarks"].'"></td></tr>';
			}
			$html .= "</table>";
		}
		$rtn_html["customer"] = $html;

		$data	=	db_customer::get_claim($company_id,0);
		$html = "";

		if (!empty($data)){
			$html = '<table class="tableStyle8"><tr><th>名前</th><th>TEL</th><th>Mail</th><th>備考</th></tr>';
			foreach($data as $key => $val){
				$html .= '<tr><td><input type="text" class="disabled" disabled style="width:110px" value="'.$val["name"].'"></td>';
				$html .= '<td><input type="text" class="disabled" disabled style="width:110px" value="'.$val["tel"].'"></td>';
				$html .= '<td><input type="text" class="disabled" disabled style="width:270px" value="'.$val["mail"].'"></td>';
				$html .= '<td><input type="text" class="disabled" disabled style="width:250px" value="'.$val["remarks"].'"></td></tr>';
			}
			$html .= "</table>";
		}
		$rtn_html["claim"] = $html;

		return json_encode($rtn_html);
	}

	/*
	 *	更新履歴画面
	*/
	public function action_updated()
	{
		//ユーザー情報の確認
		$data['userlog_id']		= $_SESSION['id'];
		$data['userlog_name']	= $_SESSION['name'];
		$data['userlog_adflag'] = $_SESSION['admin_flag'];
		//フォローid取得用
		$get = Input::get();
		$data["matter_id"]	= empty($get["id"]) ? "" : $get["id"];

		$data["show"] = db_matter::get_updated($data["matter_id"]);

		return View::forge('mlist/updated',$data);
	}


}
