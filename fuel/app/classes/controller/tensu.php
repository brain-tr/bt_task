<?php
use \Model\Db_seitotensu;


class Controller_Tensu extends Controller
{

	public function action_index()
	{
		error_reporting(0);
		session_start();
		$taskId = $_SESSION['taskId'];
		unset($_SESSION['taskId']);

		$post				=	Input::post();
		$data["msg"]		=	empty($post["msg"]) ? "1" : $post["msg"];
		$data["send"]		=	empty($post["send"]) ? "": $post["send"];
		$data["kyouka_id"]	=	empty($post["kyouka_id"])?"": $post["kyouka_id"];
		$data["point"]		=	empty($post["point"])? "": $post["point"];
		$data["name"]		=	empty($post["name"])?"": $post["name"];
		$data["seito_id"]	=	empty($post["seito_id"])?"": $post["seito_id"];


		if (md5($taskId) == $_POST['taskId']) {
			if(!empty($data['name']) && !empty($data['point'])){
				if (is_numeric($data['point'])&&($data['point']>=1)&&($data['point']<=100)
						&&(preg_match('/^[0-9]+$/', $data['point']))){
				db_seitotensu::ins_name($data);
				$data["msg"]	= '登録されました。';
			}else if(!is_numeric($data['point'])){
				$data["msg"]	= '半角数字で入力してください。';
			}else{
				$data["msg"]	= '0から100までの数値で入力してください';
			}
			}else{
				$data["msg"]	= '未入力です。入力してください。';
			}
		}




		$data["namelist"] = db_seitotensu::get_all();
 		return View::forge('tensu',$data);

	}


}