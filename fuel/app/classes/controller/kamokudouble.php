<?php
use \Model\Db_eachpoint;
class Controller_Kamokudouble extends Controller
{

	public function action_index()
	{
		$post	=	Input::post();
		$select	=	empty($post["select"])?"id":$post["select"];



		$data["japan"]	=	db_eachpoint::get_japanese();
 		return View::forge('kamokudouble',$data);
	}
}