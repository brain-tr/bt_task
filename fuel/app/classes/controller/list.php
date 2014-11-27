<?php
use \Model\Db_follow;
use \Model\Loginout;
class Controller_List extends Controller
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
	 *	フォロー一覧画面
	*/
	public function action_index()
	{
		// ログイン情報
		$data['userlog_id']		= $_SESSION['id'];
		$data['userlog_name']	= $_SESSION['name'];

		// POST
		$post = Input::post();
		$data["engineer_list"]		= empty($post["engineer_list"]) ? "" : $post["engineer_list"];
		$data["day"]				= empty($post["day"]) ? "" : $post["day"];
		$data["dayKey"]				= empty($post["dayKey"]) ? "" : $post["dayKey"];
		$data["today"]				= empty($post["today"]) ? "" : $post["today"];
		$data["lastday"]			= empty($post["lastday"]) ? "" : $post["lastday"];
		$data["lastdayW"]			= empty($post["dayW"]) ? "" : $post["dayW"];
		$data["carender"]			= empty($post["carender"]) ? "月表示" : $post["carender"];
		$data["carenderKey"]		= empty($post["carenderKey"]) ? "1" : $post["carenderKey"];
		$data["backWeek"]			= empty($post["backWeek"]) ? "" : $post["backWeek"];
		$data["backDay"]			= empty($post["backDay"]) ? "" : $post["backDay"];
		$data["carenderToday"]		= empty($post["carenderToday"]) ? "" : $post["carenderToday"];
		$data["nextDay"]			= empty($post["nextDay"]) ? "" : $post["nextDay"];
		$data["nextWeek"]			= empty($post["nextWeek"]) ? "" : $post["nextWeek"];
		$data["backMonth"]			= empty($post["backMonth"]) ? "" : $post["backMonth"];
		$data["nextMonth"]			= empty($post["nextMonth"]) ? "" : $post["nextMonth"];

		// GET（followからの遷移）
		$get = Input::get('today');
		if(!empty($get)){
			$data["today"] = date("Y-m-d",mktime(0,0,0,substr($get,5,2),substr($get,8,2),substr($get,0,4)));
		}

		// ボタン数字化
		// 月・週
		if(empty($post["carender"])) {
			$data["carenderKey"] = 1;
			// 今日の日付を取得
		} else if($post["carender"] == "月表示") {
			$data["carenderKey"] = 0;
		} else if($post["carender"] == "週表示") {
			$data["carenderKey"] = 1;
		}

		// 週間
		if(!empty($data["carenderKey"])){

			// 基準日付
			if(empty($data["today"])){
				$tday	= date("Y-m-d");
			} else {
				$tday	= $data["today"];
			}
			// 月の最終日
			$lday	= date('Y-m-d', mktime(0, 0, 0, substr($tday,5,2)+1, 0, substr($tday,0,4)));

			// ループ用
			$ldayW	= date("Y-m-d",mktime(0,0,0,substr($tday,5,2),substr($tday,8,2)+7,substr($tday,0,4)));

			// エンジニアの一覧を取得
			$day1 = $tday;
			$day2 = date("Y-m-d",mktime(0,0,0,substr($tday,5,2),substr($tday,8,2)+7,substr($tday,0,4)));
			$day1 = $day1." 00:00:00";
			$day2 = $day2." 23:59:59";
			$data['engineer_list'] = db_follow::list_data($day1,$day2);
			//var_dump($data['engineer_list']);
			//exit;


			// 翌週
			if(!empty($data["nextWeek"])) {

				// 現在の日付
				//$dayBlok	= substr($tday,8,2)+7;
				$tday		=  date("Y-m-d",mktime(0,0,0,substr($tday,5,2),substr($tday,8,2)+7,substr($tday,0,4)));

				// その月の最終日
				$lday	= date('Y-m-d', mktime(0, 0, 0, substr($tday,5,2)+1, 0, substr($tday,0,4)));

				// ループ用
				$ldayW	= date("Y-m-d",mktime(0,0,0,substr($tday,5,2),substr($tday,8,2)+14,substr($tday,0,4)));

				// エンジニアリスト
				$day1 = $tday;
				$day2 = date("Y-m-d",mktime(0,0,0,substr($tday,5,2),substr($tday,8,2)+7,substr($tday,0,4)));
				$day1 = $day1." 00:00:00";
				$day2 = $day2." 23:59:59";
				$data['engineer_list'] = db_follow::list_data($day1,$day2);
			}


			// 前週
			if(!empty($data["backWeek"])) {

				// 現在の日付
				//$dayBlok = substr($tday,8,2);
				$tday =  date("Y-m-d",mktime(0,0,0,substr($tday,5,2),substr($tday,8,2)-7,substr($tday,0,4)));

				// その月の最終日
				$lday	= date('Y-m-d', mktime(0, 0, 0, substr($tday,5,2)+1, 0, substr($tday,0,4)));

				// ループ用
				$ldayW	= date("Y-m-d",mktime(0,0,0,substr($tday,5,2),substr($tday,8,2)+6,substr($tday,0,4)));

				// エンジニアリスト
				$day1 = $tday;
				$day2 = date("Y-m-d",mktime(0,0,0,substr($tday,5,2),substr($tday,8,2)+7,substr($tday,0,4)));
				$day1 = $day1." 00:00:00";
				$day2 = $day2." 23:59:59";
				$data['engineer_list'] = db_follow::list_data($day1,$day2);
			}


			// 翌日
			if(!empty($data["nextDay"])) {

				// 現在の日付
				//$dayBlok = substr($tday,8,2);
				$tday = date("Y-m-d",mktime(0,0,0,substr($tday,5,2),substr($tday,8,2)+1,substr($tday,0,4)));

				// その月の最終日
				$lday	= date('Y-m-d', mktime(0, 0, 0, substr($tday,5,2)+1, 0, substr($tday,0,4)));

				// ループ用
				$ldayW	= date("Y-m-d",mktime(0,0,0,substr($tday,5,2),substr($tday,8,2)+6,substr($tday,0,4)));

				// エンジニアリスト
				$day1 = $tday;
				$day2 = date("Y-m-d",mktime(0,0,0,substr($tday,5,2),substr($tday,8,2)+7,substr($tday,0,4)));
				$day1 = $day1." 00:00:00";
				$day2 = $day2." 23:59:59";
				$data['engineer_list'] = db_follow::list_data($day1,$day2);
			}


			// 前日
			if(!empty($data["backDay"])) {

				// 現在の日付
				//$dayBlok = substr($tday,8,2);
				$tday = date("Y-m-d",mktime(0,0,0,substr($tday,5,2),substr($tday,8,2)-1,substr($tday,0,4)));

				// その月の最終日
				$lday	= date('Y-m-d', mktime(0, 0, 0, substr($tday,5,2)+1, 0, substr($tday,0,4)));

				// ループ用
				$ldayW	= date("Y-m-d",mktime(0,0,0,substr($tday,5,2),substr($tday,8,2)+6,substr($tday,0,4)));

				// エンジニアリスト
				$day1 = $tday;
				$day2 = date("Y-m-d",mktime(0,0,0,substr($tday,5,2),substr($tday,8,2)+7,substr($tday,0,4)));
				$day1 = $day1." 00:00:00";
				$day2 = $day2." 23:59:59";
				$data['engineer_list'] = db_follow::list_data($day1,$day2);
			}

			$data["today"]			= $tday;
			$data["lastday"]		= $lday;
			$data["lastdayW"]		= $ldayW;
			$data["carender"]		= "月表示";


		// 月間
		} else {

			// 基準日付
			if(empty($post["today"])){
				$tday	= date("Y-m-d");
			} else {
				$tday	= $data["today"];
			}

			// 月の最終日
			$lday		= date('Y-m-d', mktime(0, 0, 0, date('m') + 1, 0, date('Y')));

			// エンジニアの一覧を取得
			//$dayBlok	= substr($tday,0,8);
			$day1		= substr($tday,0,8)."01 00:00:00";
			$day2		= $lday." 23:59:59";
			$data['engineer_list'] = db_follow::list_data($day1,$day2);


			// 翌月
			if(!empty($data["nextMonth"])){

				// 現在の日付
				$tday =  date("Y-m-d",mktime(0,0,0,substr($tday,5,2)+1,substr($tday,8,2),substr($tday,0,4)));

				// その月の最終日
				$lday	= date('Y-m-d', mktime(0, 0, 0, substr($tday,5,2)+1, 0, substr($tday,0,4)));


				// エンジニアの一覧を取得
				//$dayBlok = substr($tday,0,8);
				$day1 = substr($tday,0,8)."01 00:00:00";
				$day2 = $lday." 23:59:59";
				$data['engineer_list'] = db_follow::list_data($day1,$day2);
			}


			// 前月
			if(!empty($data["backMonth"])){

				// 現在の日付
				$tday =  date("Y-m-d",mktime(0,0,0,substr($tday,5,2)-1,substr($tday,8,2),substr($tday,0,4)));

				// その月の最終日
				$lday	= date('Y-m-d', mktime(0, 0, 0, substr($tday,5,2)+1, 0, substr($tday,0,4)));

				// エンジニアの一覧を取得
				//$dayBlok = substr($tday,0,8);
				$day1 = substr($tday,0,8)."01 00:00:00";
				$day2 = $lday." 23:59:59";
				$data['engineer_list'] = db_follow::list_data($day1,$day2);
			}

			$data["today"]			= $tday;
			$data["lastday"]		= $lday;
			$data["carender"]		= "週表示";
		}


		return View::forge('list/index', $data);
	}
}