<?php
use \Model\Db_customer;
use \Model\Loginout;
use \Model\Workbench;
class Controller_Customer extends Controller
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
	 *	顧客情報登録画面
	*/
	public function action_create()
	{
		// ログイン情報
// 		$data['userlog_id']		= $_SESSION['id'];
		$data['userlog_name']	= $_SESSION['name'];
// 		$data['userlog_adflag'] = $_SESSION['admin_flag'];
		// POST
		$post = Input::post();
		$data["flag"]				= empty($post["flag"]) ? ""  : $post["flag"];
		$data["c_name"]				= empty($post["c_name"])?""  : $post["c_name"];
		$data["address"]			= empty($post["address"])?"" : $post["address"];
		$data["tel"]				= empty($post["tel"]) ? ""   : $post["tel"];
		$data["mail"]				= empty($post["mail"]) ? ""  : $post["mail"];
		$data["t_name"]				= empty($post["t_name"]) ?"" : $post["t_name"];
		$data["t_tel"]				= empty($post["t_tel"]) ? "" : $post["t_tel"];
		$data["t_mail"]				= empty($post["t_mail"]) ?"" : $post["t_mail"];
		$data["t_name2"]			= empty($post["t_name2"]) ?"" : $post["t_name2"];
		$data["t_tel2"]				= empty($post["t_tel2"]) ? "" : $post["t_tel2"];
		$data["t_mail2"]			= empty($post["t_mail2"]) ?"" : $post["t_mail2"];
		$data["u_name"]				= empty($post["u_name"]) ?"" : $post["u_name"];
		$data["special"]			= empty($post["special"]) ?"": $post["special"];
		$data["check"]				= empty($post["check"]) ? "" : $post["check"];
 		$data["id"]					= empty($post["id"])? ""     : $post["id"];
 		$data["msg"]				= empty($post["msg"])?""     : $post["msg"];
 		$data["msgcheck"]			= empty($post["msgcheck"])?"1": $post["msgcheck"];

 		// 顧客担当者の空リストを排除
 		for($i=0; $i<count($data["t_name"]);$i++){
 				if(!empty($data["t_name"][$i]) || !empty($data["t_tel"][$i]) || !empty($data["t_mail"][$i])){
 					$data["t_name2"][] = $data["t_name"][$i];
 					$data["t_tel2"][] = $data["t_tel"][$i];
 					$data["t_mail2"][] = $data["t_mail"][$i];
 				}
 		}

 		// 顧客登録
 		// 顧客会社名が記入されていない場合
 		if($data["check"]==1 && empty($data["c_name"])){
 			$data["msg"] = "顧客会社名を入力してください。";
 		// 顧客会社名ある場合→重複チェック
 		}else if($data["check"]==1 && !empty($data["c_name"])){
			$checkName = db_customer::check_company($data);
			// 同じ会社名がない場合（重複がない場合）
			if(empty($checkName)){
				$id = db_customer::ins_company($data);
				//company_idの取り出しに使用
				foreach($id as $key => $val){
					$data["id"] = $val;
				}
				//担当者情報を入力
 				if(!empty($data["id"])){
 					//入力された回数文顧客担当者情報をinsertするための処理
 					for($i=0; $i<count($data["t_name"]);$i++){
 						if(!empty($data["t_name"][$i])){
 							db_customer::ins_customer($data["id"],$data["t_name"][$i],$data["t_tel"][$i],$data["t_mail"][$i]);
 						}
 					}
				}
				$data["msgcheck"] = "登録しました。";
			}else{
				$data["msg"] = "既に登録されています。";
			}

		}

		return View::forge('customer/create',$data);
	}
	//変更画面
	public function action_update()
	{
		$post = Input::post();
		$data["flag"]				= empty($post["flag"]) ? "" : $post["flag"];
		$data["c_name"]				= empty($post["c_name"]) ? "" : $post["c_name"];
		$data["address"]			= empty($post["address"]) ? "" : $post["address"];
		$data["tel"]				= empty($post["tel"]) ? "" : $post["tel"];
		$data["mail"]				= empty($post["mail"]) ? "" : $post["mail"];
		$data["t_name"]				= empty($post["t_name"]) ? "" : $post["t_name"];
		$data["t_tel"]				= empty($post["t_tel"]) ? "" : $post["t_tel"];
		$data["t_mail"]				= empty($post["t_mail"]) ? "" : $post["t_mail"];
		$data["u_name"]				= empty($post["u_name"]) ? "" : $post["u_name"];
		$data["special"]			= empty($post["special"]) ? "" : $post["special"];
		$data["check"]				= empty($post["check"]) ? "" : $post["check"];
		$data["company_id"]			= empty($post["company_id"])?"": $post["company_id"];
 		$data["msg"]				= empty($post["msg"])?""     : $post["msg"];
 		$data["msgcheck"]			= empty($post["msgcheck"])?"1": $post["msgcheck"];
		//一覧から受け取り用
		$data["c_id"]				= empty($post["c_id"])? "" : $post["c_id"];


		if($data["check"] == 2 && empty($data["c_name"])){
			$data["msg"] = "顧客会社名を入力してください。";
		}else if($data["check"] == 2 && !empty($data["c_name"])){
			db_customer::upd_company($data);
			db_customer::del_customer($data["company_id"]);
			for($i=0; $i<count($data["t_name"]);$i++){
 				if(!empty($data["t_name"][$i])){
					db_customer::upd_customer($data["company_id"],$data["t_name"][$i],$data["t_tel"][$i],$data["t_mail"][$i]);
 				}
			}
			$data["msgcheck"] = "変更しました。";
		}
		$data["company"]	=	db_customer::get_company($data["c_id"],$data["company_id"]);
		$data["customer"]	=	db_customer::get_customer($data["c_id"],$data["company_id"]);
		return view::forge('customer/update',$data);
	}

}

