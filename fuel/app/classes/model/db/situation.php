<?php
namespace Model;

class db_situation extends \Model {

	/*
	 * 指定した状況名を１レコードだけ持ってくる
	*/
	public static function get_situation_name($name)
	{
		return  \DB::select()->from('m_situation')->where('name', $name)->execute()->current();
	}

	/*
	 * 指定した状況を１レコードだけ持ってくる
	*/
	public static function get_situation_id($situation_id)
	{
		return  \DB::select()->from('m_situation')->where('situation_id', $situation_id)->execute()->current();
	}

	/*
	 * 状況を高得点から取得する
	*/
	public static function situation_list()
	{
		return  \DB::select()->from('m_situation')->order_by('flag')->execute()->as_array();
	}

	/*
	 *	状況を登録する
	*/
	public static function ins_situation($data)
	{
		return \DB::insert('m_situation')->set(array(
//				'situation_id'	=> $data['situation_id'],
				'name'			=> $data['name'],
				'color_code'	=> $data['color_code'],
				'flag'			=> $data['flag'],
				'rank_id'		=> 10,
		))->execute();
	}

	/*
	 *	状況を変更する
	*/
	public static function upd_situation($data)
	{
		return \DB::update('m_situation')->set(array(
//				'situation_id'	=> $data['situation_id'],
				'name'			=> $data['name'],
				'color_code'	=> $data['color_code'],
				'flag'			=> $data['flag'],
				'rank_id'		=> 10,
		))->where('situation_id', $data['situation_id'])
		->execute();

	}

	/*
	 *	状況を削除する
	*/
	public static function delete_situation($situation_id)
	{
		\DB::delete('m_situation')->where('situation_id', $situation_id)->execute();
	}



}