<?php
namespace Model;

class db_seitoname extends \Model {

	public static function get_all()
	{
		return  \DB::select()->from('t_seito')->order_by('seito_id','desc')->execute()->as_array();
	}

	public static function get_id()
	{
		return  \DB::select()->from('t_seito')->order_by('seito_id','desc')->execute()->current();
	}

	public static function get_name($name)
	{
		return  \DB::select()->from('t_seito')->where('name', $name)->execute()->current();
	}
	//登録
 	public static function ins_name($data)
 	{
 		return \DB::insert('t_seito')->set(array('name'=> $data['name']))->execute();
 	}

 	//データベース変更
 	public static function change_name($data)
	{
		return \DB::update('t_seito')->set(array(
				'name'=> $data['name']))->where('seito_id', $data['user_id'])->execute();
	}

	public static function delete_user($data)
	{
		\DB::delete('t_seito')->where('seito_id', $data['user_id'])->execute();
	}
}