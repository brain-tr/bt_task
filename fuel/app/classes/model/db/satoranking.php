
<?php
namespace Model;

class db_satorank extends \Model {

	/*
	 * 指定したランキング情報を１レコードだけ持ってくる
	 */
	public static function get_ranking($id)
	{

		return  \DB::select()->from('db_satoranking')->where('id', $id)->execute()->current();

	}

	/*
	 * ランキング情報を高得点から10件取得する
	*/
	public static function ranking_list()
	{
		return  \DB::select()->from('db_satoranking')->order_by('point','desc')->limit(10)->execute()->as_array();
	}

	/*
	*	ランキング情報を登録する
	*/
	public static function ins_ranking($data)
	{

		return \DB::insert('db_ranking')->set(array(
				'point'					=> $data['point'],
				'create_date'			=> $data['create_date'],
		))->execute();

	}

	/*
	*	指定したランキング情報を削除
	*/
	public static function delete_ranking($id)
	{
		\DB::delete('db_ranking')->where('id', $id)->execute();
	}

}