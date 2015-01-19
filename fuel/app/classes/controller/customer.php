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
		session_start();
		parent::before();
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
		$data["u_name"]				= empty($post["u_name"]) ?"" : $post["u_name"];
		$data["special"]			= empty($post["special"]) ?"": $post["special"];
		$data["check"]				= empty($post["check"]) ? "" : $post["check"];
 		$data["id"]					= empty($post["id"])? ""     : $post["id"];
 		$data["msg"]				= empty($post["msg"])?""     : $post["msg"];

		if($data["check"]==1 && !empty($data["c_name"])){
			$checkName = db_customer::check_company($data);
			if(empty($checkName)){
				$id = db_customer::ins_company($data);
				//company_idの取り出しに使用
				foreach($id as $key => $val){
					$data["id"] = $val;
				}

				//担当者情報を入力
 				if(!empty($data["id"]) && !empty($data["t_name"][0])){
 					//入力された回数文顧客担当者情報をinsertするための処理
 					for($i=0; $i<count($data["t_name"]);$i++){
 						db_customer::ins_customer($data["id"],$data["t_name"][$i],$data["t_tel"][$i],$data["t_mail"][$i]);
 					}

				}
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
		//一覧から受け取り用
		$data["c_id"]				= empty($post["c_id"])? "" : $post["c_id"];



		if($data["check"] == 2 && !empty($data["c_name"])){
			db_customer::upd_company($data);
			db_customer::del_customer($data["company_id"]);
			for($i=0; $i<count($data["t_name"]);$i++){
				db_customer::upd_customer($data["company_id"],$data["t_name"][$i],$data["t_tel"][$i],$data["t_mail"][$i]);
			}

		}





		$data["company"]	=	db_customer::get_company($data["c_id"],$data["company_id"]);
		$data["customer"]	=	db_customer::get_customer($data["c_id"],$data["company_id"]);
		return view::forge('customer/update',$data);
	}

}

