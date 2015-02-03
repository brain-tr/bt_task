<?php
use \Model\Db_matter;
use \Model\db_customer;
use \Model\Loginout;
use \Model\Workbench;
use Model\db_case;
class Controller_Matter extends Controller
{
	/*
	 *	セッション情報の確認
	*/
	public function before()
	{
		session_cache_limiter('private_no_expire');
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
		$data["case"]	=	empty($post["case"])	?  "": $post["case"];
		$data["msgcheck"]	=	empty($post["msgcheck"])? "1": $post["msgcheck"];

		$hyphen1 = substr($data["date"], 4, 1);
		$hyphen2 = substr($data["date"], 7, 1);
		if($data["check"]==1 && empty($data["user"])){
			$data["msg"]	=	"対応者名は必須項目です。";
		}else if($data["check"]==1 && empty($data["c_id"])){
			$data["msg"] = "顧客会社を選択してください。";
		}else if($data["check"]==1 && ($hyphen1 != "-" || $hyphen2 != "-")){
			$data["msg"] = "日付は「年-月-日」のハイフン付きで入力してください。";
		}else if($data["check"]==1 && !empty($data["user"]) && !empty($data["c_id"]) && $hyphen1 == "-" && $hyphen2 == "-"){
			$check	=	db_matter::check_matter($data);
			if(empty($check)){
				db_matter::ins_matter($data);
				$data["msgcheck"] = "登録しました。";
			}
		}

		//セレクトボックス取り出し用
		$data["select"]	=	db_case::get_name();

		return View::forge('matter/create',$data);
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
		$data["c_id"]		=	empty($post["company_id"])?"": $post["company_id"];
		$data["date"]		=	empty($post["date"])	?  "": $post["date"];
		$data["detail"]		=	empty($post["detail"])	?  "": $post["detail"];
		$data["user"]		=	empty($post["user"])	?  "": $post["user"];
		$data["check"]		=	empty($post["check"])	?  "": $post["check"];
		$data["m_id"]		=	empty($post["matter_id"])? "": $post["matter_id"];
		$data["list_id"]	=	empty($post["list_id"])?   "": $post["list_id"];
		$data["check2"] 	=	empty($post["flag"])?	   "": $post["flag"];
		$data["case"]		=	empty($post["case"])?	   "": $post["case"];
		$data["msg"]		=	empty($post["msg"])		?  "": $post["msg"];
		$data["msgcheck"]	=	empty($post["msgcheck"])? "1": $post["msgcheck"];

		//一覧から遷移してきた時の処理
		if($data["check2"]==1 && !empty($data["list_id"])){
			//表示用
			$data["view"]	=	db_matter::get_matter($data["list_id"]);
			$data["c_id"]	=	$data["view"][0]["company_id"];
		}

		$hyphen1 = substr($data["date"], 4, 1);
		$hyphen2 = substr($data["date"], 7, 1);
		//変更した時の処理
		if($data["check"]==1 && empty($data["user"])){
			$data["msg"]	=	"対応者名は必須項目です。";
			$data["view"]	=	db_matter::get_matter($data["m_id"]);
		}else if($data["check"]==1 && ($hyphen1 != "-" || $hyphen2 != "-")){
			$data["msg"] = "日付は「年-月-日」のハイフン付きで入力してください。";
			$data["view"]	=	db_matter::get_matter($data["m_id"]);
		}else if($data["check"]==1 && !empty($data["user"]) && $hyphen1 == "-" && $hyphen2 == "-"){
			db_matter::upd_matter($data);
			db_matter::ins_updated($data);
			//表示用
			$data["view"]	=	db_matter::get_matter($data["m_id"]);
			$data["msgcheck"] = "変更しました。";
		}
		//顧客会社担当者一覧取得
		$data["customer"]	=	db_customer::get_customer($data["c_id"],$data["c_id"]);
		//セレクトボックス取り出し用
		$data["select"]	=	db_case::get_name();
		return view::forge('matter/update',$data);
	}

	/*
	 *	顧客対応履歴画面
	 */
	public function action_past()
	{
		// ログイン情報
		$data['userlog_id']		= $_SESSION['id'];
		$data['userlog_name']	= $_SESSION['name'];
		// POST
		$post = Input::post();
		$data["company_id"]	=	empty($post["company_id"])?"": $post["company_id"];
		$data["date"]	=	empty($post["date"])	?  "": $post["date"];
		$data["detail"]	=	empty($post["detail"])	?  "": $post["detail"];
		$data["user"]	=	empty($post["user"])	?  "": $post["user"];
		$data["check"]	=	empty($post["check"])	?  "": $post["check"];
		$data["m_id"]	=	empty($post["matter_id"])? "": $post["matter_id"];
		$data["list_id"]=	empty($post["list_id"])?   "": $post["list_id"];
		$data["c_flag"]=	empty($post["c_flag"])? ""  : $post["c_flag"];
		$data["check2"] =	empty($post["flag"])?	   "": $post["flag"];
		$data["check3"]	=	empty($post["check3"])? ""	 : $post["check3"];
		$data["case"]	=	empty($post["case"])?	   "": $post["case"];
		$data["flag_id"]=	empty($post["flag_id"])? ""  : $post["flag_id"];
		$data["sortbtn"]=	empty($post["sortbtn"])	?"↑": $post["sortbtn"];
		$data["sortbtn2"]=	empty($post["sortbtn2"])	?"↑": $post["sortbtn2"];
		$data["updown"]	=	empty($post["updown"])?	"asc": $post["updown"];
		$data["updown2"]	=	empty($post["updown2"])?	"asc": $post["updown2"];
		$data["msg"]	=	empty($post["msg"])		?  "1": $post["msg"];

		//一覧から遷移してきた時の処理
		if($data["check2"]==1 && !empty($data["list_id"])){
			//表示用
			$data["view"]	=	db_matter::get_matter($data["list_id"]);
			$data["company_id"]	=	$data["view"][0]["company_id"];
		}

		//履歴取り出し
		$data["past"]	=	db_matter::get_past($data);
		$data["view"]	=	db_matter::get_matter($data["list_id"]);

		//ソート
		if($data["check3"] == 1){
			if($data["updown"] == "asc"){
				$data["updown"] = "desc";
				$data["sortbtn"] = "↓";
				$data['past'] = \Model\db_matter::past_sort($data, $data["updown"]);
			}else{
				$data["updown"] = "asc";
				$data["sortbtn"] = "↑";
				$data['past'] = \Model\db_matter::past_sort($data, $data["updown"]);
			}
		}else if($data["check3"] == 2){
			if($data["updown2"] == "asc"){
				$data["updown2"] = "desc";
				$data["sortbtn2"] = "↓";
				$data['past'] = \Model\db_matter::past_sort2($data, $data["updown2"]);
			}else{
				$data["updown2"] = "asc";
				$data["sortbtn2"] = "↑";
				$data['past'] = \Model\db_matter::past_sort2($data, $data["updown2"]);
			}
		}

		//変更
		if($data["check"] == 2){

		//削除
		}else if($data["check"] == 3){
			\Model\db_matter::past_delete($data);
			$data["msg"] = "削除しました。";
			$data['past'] = db_matter::get_past($data);
		}
		//顧客会社担当者一覧取得
		$data["customer"]	=	db_customer::get_customer($data["company_id"], $data["company_id"]);

		//セレクトボックス取り出し用
		$data["select"]	=	db_case::get_name();
		return view::forge('matter/past',$data);
	}


	/*
	 *	顧客対応一覧画面（週表示）
	*/
	public function action_day()
	{
		//POST
		$post = Input::post();
		$data["check1"] =	empty($post["check1"])?"": $post["check1"];
		$data["check2"] =	empty($post["check2"])?"": $post["check2"];
		$data["check3"] =	empty($post["check3"])?"": $post["check3"];
		$data["msg"]	=	empty($post["msg"])?   "": $post["msg"];
		$data["search"]	=	empty($post["search"])?   "": $post["search"];
		$data["person"]	=	empty($post["person"])?   "": $post["person"];
		$data["delete"]	=	empty($post["delete"])?   "": $post["delete"];
		$data["del"]		=	empty($post["del"])	?	"": $post["del"];
		$data["day"]	=	empty($post["day"])?""	 : $post["day"];
		$data["month"]	=	empty($post["month"])?""	 : $post["month"];
		$data["year"]	=	empty($post["year"])?""	 : $post["year"];
		$data["searchday"]	=	empty($post["searchday"])?   "": $post["searchday"];
		$data["today"]	=	empty($post["today"])?   "": $post["today"];

		//単体削除はできます。
		if($data["check3"]==1){
			//一括削除処理
			if(!empty($data["del"])){
				for($i=0; $i<count($data["del"]); $i++){
					db_matter::daydel_matter($data["del"][$i]);
				}
				//削除ボタン 単体削除
			}else if(!empty($data["delete"])){
				db_matter::daydel_matter($data["delete"]);
			}
		}

		//一覧から遷移してきた時の処理
		if($data["check2"]==1 && !empty($data["day"])){
			//表示用
			$data["searchday"]  =	date("Y-m-d", mktime(0, 0, 0, $data["month"], $data["day"], $data["year"]));
			$data["today"]		=	date("Y年m月d日", mktime(0, 0, 0, $data["month"], $data["day"], $data["year"]));
		}

		//会社名検索用表示
		if($data["check1"] == 1 && !empty($data["search"])){
			$data["company"] = db_matter::daysearch_list($data);
			$data["msg"] = $data["search"];
		}else if($data["check1"]==2 && !empty($data["person"]) && $data["person"] != '----'){
			$data["company"] = db_matter::daysearch_person($data);
		}else{
			//初期表示
			$data["company"] = db_matter::dayget_list($data);
		}


		//対応者セレクトボックス表示用
		$data["respon"]	=	db_matter::get_respon();

		return View::forge('matter/day',$data);
	}





}

