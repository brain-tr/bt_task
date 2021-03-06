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
		parent::before();
		session_cache_limiter('private_no_expire');
		session_start();
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
 		$data['userlog_adflag'] = $_SESSION['admin_flag'];

		// POST
		$post = Input::post();
		$data["c_id"]	=	empty($post["company_id"])?"": $post["company_id"];
		$data["date"]	=	empty($post["date"])	?  "": $post["date"];
		$data["detail"]	=	empty($post["detail"])	?  "": $post["detail"];
		$data["content_text2"]	=	empty($post["content_text2"])	?  "": $post["content_text2"];
		$data["content_text3"]	=	empty($post["content_text3"])	?  "": $post["content_text3"];
		$data["content_text4"]	=	empty($post["content_text4"])	?  "": $post["content_text4"];
		$data["content_text5"]	=	empty($post["content_text5"])	?  "": $post["content_text5"];
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
				$id = db_matter::ins_matter($data);
				//company_idの取り出しに使用
				foreach($id as $key => $val){
					$data["m_id"] = $val;
				}
				db_matter::ins_updated($data);
				$data["msgcheck"] = "登録しました。";
			}else{
				$data["msg"] = "既に対応内容は登録されています。";
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
		$data['userlog_adflag'] = $_SESSION['admin_flag'];

		// POST
		$post = Input::post();
		$data["company_id"]		=	empty($post["company_id"])?"": $post["company_id"];
		$data["date"]			=	empty($post["date"])	?  "": $post["date"];
		$data["detail"]			=	empty($post["detail"])	?  "": $post["detail"];
		$data["content_text2"]	=	empty($post["content_text2"])	?  "": $post["content_text2"];
		$data["content_text3"]	=	empty($post["content_text3"])	?  "": $post["content_text3"];
		$data["content_text4"]	=	empty($post["content_text4"])	?  "": $post["content_text4"];
		$data["content_text5"]	=	empty($post["content_text5"])	?  "": $post["content_text5"];
		$data["user"]			=	empty($post["user"])	?  "": $post["user"];
		$data["check"]			=	empty($post["check"])	?  "": $post["check"];
		$data["m_id"]			=	empty($post["matter_id"])? "": $post["matter_id"];
		$data["list_id"]		=	empty($post["list_id"])?   "": $post["list_id"];
		$data["check2"] 		=	empty($post["flag"])?	   "": $post["flag"];
		$data["check3"]			=	empty($post["check3"])? ""	 : $post["check3"];
		$data["check4"] 		=	empty($post["check4"])?""	 : $post["check4"];
		$data["sortbtn"]		=	empty($post["sortbtn"])	?"↑": $post["sortbtn"];
		$data["sortbtn2"]		=	empty($post["sortbtn2"])?"↑": $post["sortbtn2"];
		$data["updown"]			=	empty($post["updown"])?	"asc": $post["updown"];
		$data["updown2"]		=	empty($post["updown2"])?"asc": $post["updown2"];
		$data["case"]			=	empty($post["case"])?	   "": $post["case"];
		$data["msg"]			=	empty($post["msg"])		?  "": $post["msg"];
		$data["msg_comp"]		=	empty($post["msg_comp"])? "0": $post["msg_comp"];
		$data["msgcheck"]		=	empty($post["msgcheck"])? "1": $post["msgcheck"];
		$data["cnt"]			=	empty($post["cnt"])?"0"		 : $post["cnt"];


		// 日付を「年-月-日」の形で登録される。
		$hyphen1 = substr($data["date"], 4, 1);
		$hyphen2 = substr($data["date"], 7, 1);
		//変更した時の処理
		if($data["check"]==1 && empty($data["user"])){
			$data["msg"]	=	"対応者名は必須項目です。";
		}else if($data["check"]==1 && ($hyphen1 != "-" || $hyphen2 != "-")){
			$data["msg"] = "日付は「年-月-日」のハイフン付きで入力してください。";

		}else if($data["check"]==1 && !empty($data["user"]) && $hyphen1 == "-" && $hyphen2 == "-"){
			db_matter::upd_matter($data);
			db_matter::ins_updated($data);
			$data["msgcheck"] = "変更しました。";
		}

		//一覧から遷移してきた時の処理
		if($data["check2"]==1 && !empty($data["list_id"])){
			$data["view"]	=	db_matter::get_matter($data["list_id"]);
			$data["company_id"]	=	$data["view"][0]["company_id"];
		//削除用
		}else if($data["check2"] == 2){
			$data["msgcheck"] = "削除しました。";
			\Model\db_matter::past_delete($data);
			//詳細表示している対応を削除したとき
			if($data["list_id"] == $data["m_id"]){
				$pullmatter = \Model\db_matter::pull_matter($data["company_id"]);
				//その会社の他の対応を詳細表示
				if(!empty($pullmatter)){
					$data["list_id"] = $pullmatter["matter_id"];
				//他の対応がない場合は顧客会社詳細に遷移
				}else{
					$data["msgcheck"] = "削除しました。顧客詳細画面へ遷移します。";
					$data["company"]	=	db_customer::get_company($data["company_id"],$data["company_id"]);
					$data["customer"]	=	db_customer::get_customer($data["company_id"],$data["company_id"]);
					return view::forge('customer/update',$data);
				}
			}
		}

		//履歴取り出し
		$data["past"]	=	db_matter::get_past($data);
		$data["view"]	=	db_matter::get_matter($data["list_id"]);

		//ソート
		if($data["check3"] == 1){
			if($data["check4"] == 1){
				if($data["updown"] == "asc"){
					$data["updown"] = "desc";
					$data["sortbtn"] = "↓";
					$data["updown2"] = "asc";
					$data["sortbtn2"] = "↑";
				}else{
					$data["updown"] = "asc";
					$data["sortbtn"] = "↑";
					$data["updown2"] = "asc";
					$data["sortbtn2"] = "↑";
				}
			}
			$data['past'] = \Model\db_matter::past_sort($data, $data["updown"]);
			$data["view"]	=	db_matter::get_matter($data["list_id"]);
		}else if($data["check3"] == 2){
			if($data["check4"] == 1){
				if($data["updown2"] == "asc"){
					$data["updown2"] = "desc";
					$data["sortbtn2"] = "↓";
					$data["updown"] = "asc";
					$data["sortbtn"] = "↑";
				}else{
					$data["updown2"] = "asc";
					$data["sortbtn2"] = "↑";
					$data["updown"] = "asc";
					$data["sortbtn"] = "↑";
				}
			}
			$data['past'] = \Model\db_matter::past_sort2($data, $data["updown2"]);
			$data["view"]	=	db_matter::get_matter($data["list_id"]);
		}

		//顧客会社担当者一覧取得
		$data["customer"]	=	db_customer::get_customer($data["company_id"],$data["company_id"]);
		$data["claim"]	=	db_customer::get_claim($data["company_id"],$data["company_id"]);
		//セレクトボックス取り出し用
		$data["select"]	=	db_case::get_name();
		return view::forge('matter/update',$data);
	}


	/*
	 *	顧客対応一覧画面（週表示）
	*/
	public function action_day()
	{
		// ログイン情報
		$data['userlog_id']		= $_SESSION['id'];
		$data['userlog_name']	= $_SESSION['name'];
		$data['userlog_adflag'] = $_SESSION['admin_flag'];

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

