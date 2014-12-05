<?php
use \Model\Db_eachpoint;
class Controller_Kamoku extends Controller
{

	public function action_index()
	{
		$post	=	Input::post();
		$select	=	empty($post["select"])?"id":$post["select"];
		$hiki	=	empty($post["hiki"])?"":$post["hiki"];



		$data["japan"]	=	db_eachpoint::get_japanese();
 		return View::forge('kamoku',$data);
	}
}