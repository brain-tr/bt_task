<?php

use \Model\Db_Ranking;

class Controller_Kisitest extends Controller
{

	public function action_insert()
	{
		$data["point"]			= mt_rand(1,99);
		$data["create_date"]	= date("Y-m-d H:i:s");
		db_ranking::ins_ranking($data);
		exit;
	}
	public function action_ranking()
	{
		var_dump(db_ranking::ranking_list());
		exit;
	}


}