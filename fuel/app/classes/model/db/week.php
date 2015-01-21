<?php
namespace Model;
class db_week extends \Model {


	/*
	 *  対応を削除する
	*/
	public static function del_matter($matter_id)
	{
		\DB::delete('k_matter')->where('matter_id',$matter_id)->execute();

	}
}