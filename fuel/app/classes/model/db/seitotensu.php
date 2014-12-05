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

 	//全件表示用 昇降ボタン
 	public static function get_all1($select,$hiki)
 	{
		$query =\DB::query("SELECT * FROM t_seito a,t_test b where a.seito_id=b.seito_id order by ".$select." ".$hiki." ");
		$result	=	$query->execute()->as_array();
		return $result;
 	}

 	//全件表示用 判定:all
 	public static function get_result($sel,$sel2,$sel3,$updown,$updown2,$updown3)
 	{
 		$query =\DB::query("SELECT * FROM t_seito a,t_test b where a.seito_id=b.seito_id order by
 			  $sel  $updown , $sel2  $updown2 , $sel3  $updown3
 				 ");
 		$result	=	$query->execute()->as_array();
 		return $result;
 	}

 	//全件表示用 判定:1
 	public static function get_result2($sel,$updown)
 	{
 		$query =\DB::query("SELECT * FROM t_seito a,t_test b where a.seito_id=b.seito_id order by
 				$sel  $updown
 				");
 		$result	=	$query->execute()->as_array();
 		return $result;
 	}

 	//全件表示用 判定:1/2
 	public static function get_result3($sel,$sel2,$updown,$updown2)
 	{
 		$query =\DB::query("SELECT * FROM t_seito a,t_test b where a.seito_id=b.seito_id order by
 				$sel  $updown , $sel2 $updown2
 				");
 		$result	=	$query->execute()->as_array();
 		return $result;
 	}

 	//全件表示用 二番目/三番目のみ入力時
 	public static function get_illegal($sel,$sel2,$updown,$updown2)
 	{
 		$query =\DB::query("SELECT * FROM t_seito a,t_test b where a.seito_id=b.seito_id order by
 				$sel  $updown , $sel2 $updown2
 				");
 		$result	=	$query->execute()->as_array();
 		return $result;
 	}




}