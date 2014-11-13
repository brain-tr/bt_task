<?php
namespace Model;

class db_appointment extends \Model {

	/*
	 * 指定した情報を配列に入っている分だけ
	 */
	public static function get_all()
	{

		//リターン			   //テーブルの場所						//降順で	       //実行		//配列形式で。
		return  \DB::select()->from('m_appointment')->order_by('appointment_id','desc')->execute()->as_array();

	}

	public static function get_id()
	{

		//リターン			   //テーブルの場所						//降順で	       //実行
		return  \DB::select()->from('m_appointment')->order_by('appointment_id','desc')->execute()->current();

	}



	//データベースからnameを一件づつ取得する。
	public static function get_name($name)
	{																//変数
		return  \DB::select()->from('m_appointment')->where('name', $name)->execute()->current();


	}

	//データベースに登録
 	public static function ins_name($data)
 	{


 		return \DB::insert('m_appointment')->set(array(
 				'name'					=> $data['name']

 		))->execute();


 	}

 	//データベース変更
 	public static function change_name($data)
	{
		return \DB::update('m_appointment')->set(array(
				'name'			=> $data['name'],
				'rank_id'		=> 10,
		))->where('appointment_id', $data['user_id'])->execute();
	}

	public static function del_user($data)
	{
		\DB::delete('m_appointment')->where('appointment_id', $data['user_id'])->execute();
	}
}