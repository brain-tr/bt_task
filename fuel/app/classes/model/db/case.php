<?php
namespace Model;
class db_case extends \Model {


	/*
	 *  一覧用の要求フラグ名を全件取得する
	 */
	public static function get_name()
	{
		return \DB::select('case_id', 'name','color_code')->from('k_case')->order_by('case_id','asc')->execute()->as_array();
	}

	/*
	 *	要求フラグを登録する
	*/
	public static function ins_flag($data)
	{
		\DB::insert('k_case')->set(array(
				'name'	=> $data['new_name'],
				'color_code'	=> $data['new_color'],
				'rank_id'		=> 0
		))->execute();
	}

	/*
	 *	顧客会社情報重複チェック
	*/
	public static function check_flag($data)
	{
		return \DB::select('name')->from('k_case')->where("name",$data["new_name"])->execute()->as_array();
	}

	/*
	 *	要求フラグを削除する
	*/
	public static function del_flag($data)
 	{
 		\DB::query("delete from k_case where case_id = ".$data["flag_id"]."")
		->execute();
 	}

 	/*
 	 *	要求フラグを更新する
 	*/
 	public static function update_flag($data)
 	{
 		\DB::query("update k_case set name = '".$data["new_name"]."', color_code = '".$data["new_color"]."' where case_id = ".$data["flag_id"]."")
 		->execute();
 	}

 	/*
 	 *	要求フラグをソートする
 	*/
 	public static function sort($data)
 	{

 		$query = \DB::query("SELECT * FROM k_case order by name ".$data["updown"]." ");
 		$result	=	$query->execute()->as_array();
 		return $result;
 	}

 	/*
 	 *	要求フラグが対応で使われているか検索
 	*/
 	public static function search_flag($data)
 	{

 		$query = \DB::query("SELECT case_id FROM k_matter where case_id=".$data["flag_id"]." group by case_id");
 		$result	=	$query->execute()->as_array();
 		return $result;
 	}
}