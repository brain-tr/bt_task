<?php
use \Model\Db_follow;
use \Model\Loginout;
use Model\db_customer;
class Controller_Clist extends Controller
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
	 *	フォロー一覧画面
	*/
	public function action_index()
	{
		// ログイン情報
		$data['userlog_id']		= $_SESSION['id'];
		$data['userlog_name']	= $_SESSION['name'];
		$data['userlog_adflag'] = $_SESSION['admin_flag'];

		$post = Input::post();
		$select 			=	empty($post["select"])?"" : $post["select"];
		$cd					=	empty($post["cd"])	?""	  : $post["cd"];
		$data["search"]		=	empty($post["search"])?"" : $post["search"];
		$data["del"]		=	empty($post["del"])	?	"": $post["del"];
		$data["del_flg"]	=	empty($post["del_flg"])?"": $post["del_flg"];
		$data["check"]		=	empty($post["check"]) ?"" : $post["check"];
		$data["delete"]		=	empty($post["delete"])? "": $post["delete"];
		$data["check2"]		=	empty($post["check2"])? "": $post["check2"];
		$data["updown1"]	=	empty($post["updown1"])?"": $post["updown1"];
		$data["updown2"]	=	empty($post["updown2"])?"": $post["updown2"];
		$data["updown3"]	=	empty($post["updown3"])?"": $post["updown3"];
		$data["updown4"]	=	empty($post["updown4"])?"": $post["updown4"];
		$data["msg1"]		=	empty($post["msg1"])	 ?"↑": $post["msg1"];
		$data["msg2"]		=	empty($post["msg2"]) ?"↑": $post["msg2"];
		$data["msg3"]		=	empty($post["msg3"]) ?"↑": $post["msg3"];
		$data["msg4"]		=	empty($post["msg4"]) ?"↑": $post["msg4"];
		$data["check3"]		=	empty($post["check3"])? "": $post["check3"];
		$data["flag1"]		=	empty($post["flag1"])?	"1": $post["flag1"];
		$data["flag2"]		=	empty($post["flag2"])?	"1": $post["flag2"];
		$data["flag3"]		=	empty($post["flag3"])?	"1": $post["flag3"];
		$data["flag4"]		=	empty($post["flag4"])?	"1": $post["flag4"];
 		$data["msgcheck"]	=   empty($post["msgcheck"])?"1": $post["msgcheck"];
        $data["limitCnt"]   =   empty($post["limitCnt"])?"1": $post["limitCnt"];



		if($data["check"]==1){
			//一括削除処理
			if(!empty($data["del"])){
				for($i=0; $i<count($data["del"]); $i++){
					$checkName = db_customer::matter_company($data["del"][$i]);
					if(empty($checkName)){
						db_customer::del_company($data["del"][$i]);
						db_customer::del_customer($data["del"][$i]);
						$data["msgcheck"] = "削除しました。";
					}else{
						$data["msgcheck"] = "この顧客会社は対応詳細で登録されているため削除できません。";
					}
				}
			//削除ボタン 単体削除
			}else if(!empty($data["delete"])){
					$checkName = db_customer::matter_company($data["delete"]);
					if(empty($checkName)){
						db_customer::del_company($data["delete"]);
						db_customer::del_customer($data["delete"]);
						$data["msgcheck"] = "削除しました。";
					}else{
						$data["msgcheck"] = "この顧客会社は対応詳細で登録されているため削除できません。";
					}
			}
		}

		//検索
		if($data["check2"]==2 && !empty($data["search"])){
				$data["view"]	=	db_customer::search_company(strval($data["search"]));
		}else{
			//初期表示用
			$data["view"]	=	db_customer::get_name($data["limitCnt"]);
			$data["count"]	=	db_customer::get_name_count();
			$data["now"]	=	1;
		}
        
        //どの項目をソートするのかを配列で保持する
        $orderBy = array("company_name","c_flag","creation_time","modification_time");
        if($data["check3"] != null){
            if($data["updown".$data["check3"]] == 1){
                    $data["msg".$data["check3"]] = "↓";
                    $data["flag".$data["check3"]] = 2;
                    $select = $orderBy[$data["check3"]-1];
                    $cd = "desc";
            }else if($data["updown".$data["check3"]] == 2){
                    $data["msg"] = "↑";
                    $data["flag".$data["check3"]] = 1;
                    $select = $orderBy[$data["check3"]-1];
                    $cd = "asc";
            }
            if(!empty($data["search"])){
				$data["view"]	=	db_customer::up_down2($select, $cd, $data["search"],$data["limitCnt"]);
			}else{
				$data["view"]	=	db_customer::up_down($select,$cd,$data["limitCnt"]);
			}
        }

		return View::forge('clist/index',$data);
	}
}