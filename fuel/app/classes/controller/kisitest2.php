<?php

use \Model\Db_Ranking;
use \Model\kisitest;

class Controller_Kisitest2 extends Controller_Rest
{
	
	public function post_game3()
	{	
		$post				= Input::post();
		error_log("aaaaaaaaaaaaaaa");
		$array = array("test1", 
               "test2", 
	       "test3"
	      );
		echo json_encode($post);

	}
	

}