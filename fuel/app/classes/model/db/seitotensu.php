<?php
namespace Model;
class db_seitotensu extends \Model {
	//生徒ID(配列)
	public static function get_all()
	{
		return  \DB::select()->from('t_seito')->order_by('seito_id','desc')->execute()->as_array();
	}
	//生徒ID(一件)
	public static function get_id()
	{
		return  \DB::select()->from('t_seito')->order_by('seito_id','desc')->execute()->current();
	}

	//生徒名前(配列)
	public static function name_all($name)
	{
		return  \DB::select()->from('t_seito')->where('name', $name)->execute()->as_array();
	}
	//教科ID
	public static function kyouka_all()
	{
		return	\DB::select()->from('t_test')->where('kyouka_id','desk')->execute()->as_array();
	}

	//登録
 	public static function ins_name($data)
 	{
 		return \DB::insert('t_test')->set(array(
				'seito_id' 		=> $data['name'],
 				'kyouka_id'		=> $data['kyouka_id'],
 				'point'			=> $data['point']
 		))->execute();
 	}

 	//降順昇順
 	public static function down_data($name,$hiki,$cha)
 	{
 		return \DB::select()->from('t_test')->where('seito_id',$name)->
 			order_by($cha,$hiki)->execute()->as_array();
 	}

 	//生徒ID2(配列)
 	public static function get_all2()
 	{
 		return \DB::select()->from('t_test')->execute()->as_array();
 	}



}