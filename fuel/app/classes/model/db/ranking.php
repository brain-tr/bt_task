<?php
namespace Model;

class db_ranking extends \Model {

	/*
	 * 指定したランキング情報を１レコードだけ持ってくる
	 */
	public static function get_ranking($id)
	{

		return  \DB::select()->from('t_ranking')->where('id', $id)->execute()->current();

	}

	/*
	 * ランキング情報を高得点から10件取得する
	*/
	public static function ranking_list()
	{
		return  \DB::select()->from('t_ranking')->order_by('post','desc')->limit(10)->execute()->as_array();
	}

	/*
	*	ランキング情報を登録する
	*/
	public static function ins_ranking($data)
	{

		return \DB::insert('t_ranking')->set(array(
				'point'					=> $data['point'],
				'create_date'			=> $data['create_date'],
		))->execute();

	}

	/*
	*	指定したランキング情報を削除
	*/
	public static function delete_ranking($id)
	{
		\DB::delete('t_ranking')->where('id', $id)->execute();
	}

}