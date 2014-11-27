<?php
namespace Model;

class db_follow extends \Model {

	/*
	 * 指定したユーザー情報を１レコードだけ持ってくる
	*/
	public static function get_user_id($user_id)
	{
		return  \DB::select()->from('t_user')->where('user_id', $user_id)->execute()->current();
	}

	/*
	 * エンジニア情報を降順で取得する
	*/
	public static function engineer_list()
	{
		return  \DB::select()->from('t_user')->where('job_type', '1')->order_by('user_id','desc')->execute()->as_array();
	}

	/*
	 * エンジニア情報カレンダー用
	*/
// 	public static function engineer_id_list()
// 	{
// 		return  \DB::select()->from('t_follow')->order_by('s','desc')->execute()->as_array();
// 	}

	/*
	 * 状況を取得する
	*/
	public static function situation_list()
	{
		return  \DB::select()->from('m_situation')->where('flag', '0')->order_by('situation_id','desc')->execute()->as_array();
	}



	/*
	 * カレンダー用のデータを取得する
	*/
	public static function list_data($day1,$day2)
	{
		//return  \DB::select('a.name', 'b.engineer_user_id', 'b.situation_id', 'c.name', 'b.start_date')->from('t_user a', 't_follow b', 'm_situation c')->where('b.engineer_user_id', 'a.user_id')->where('b.situation_id', 'c.situation_id')->execute()->as_array();
		$query	=\DB::query("select a.name as user_name, a.job_type, a.user_id, b.engineer_user_id, b.situation_id, c.name, b.start_date from ( t_user a left join t_follow b on b.engineer_user_id = a.user_id and b.start_date >= :day1 and b.start_date <= :day2) left join m_situation c on b.situation_id = c.situation_id order by user_id,start_date;");
		$result	= $query->bind('day1', $day1)->bind('day2', $day2)->execute()->as_array();
		return $result;

	}

	/*
	 * 対応方式を降順で取得する
	*/
	public static function appointment_list()
	{
		return  \DB::select()->from('m_appointment')->order_by('appointment_id','desc')->execute()->as_array();
	}

	/*
	 *	フォロー情報を登録する
	*/
	public static function ins_follow($data)
	{
		return \DB::insert('t_follow')->set(array(
		//		'follow_id'		=> "",
				'engineer_user_id'	=> $data['engineer_user_id'],
				'situation_id'		=> $data['situation_id'],
				'appointment_id'	=> $data['appointment_id'],
				'project_text'		=> $data['project_text'],
				'content_text'		=> $data['content_text'],
				'remarks'			=> $data['remarks'],
				'create_user_id'	=> $data['create_user_id'],
				'start_date'		=> $data['start_date'],
				'end_date'			=> $data['end_date'],
				'del_flag'			=> 0,
		//		'created_at'		=> $data['created_at'],
		))->execute();
	}

	/*
	 *	更新者情報を登録する
	*/
	public static function ins_updated($follow_id,$user_id)
	{
		return \DB::insert('t_updated')->set(array(
		//		'id'				=> "",
				'follow_id'			=> $follow_id,
				'user_id'			=> $user_id,
		//		'updated_at'		=> $updated_at,
		))->execute();
	}

	/*
	 *	フォロー情報を降順で1つ取得する
	*/
	public static function get_follow_id()
	{
		return  \DB::select()->from('t_follow')->order_by('follow_id','desc')->execute()->current();
	}


}