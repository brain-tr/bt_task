<?php

use \Model\Db_Ranking;

class Controller_Ranking extends Controller
{

	public function action_insert()
	{
		$data["point"]			= mt_rand(1,99);
		$data["create_date"]	= date("Y-m-d H:i:s");
		db_project::get_project_id_kind($post["find_ids"]);
	}


}