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
	 * 指定したフォロー情報を１レコードだけ持ってくる
	*/
	public static function follow_data($follow_id)
	{
		$query	=\DB::query("select a.name as engineer_name, b.engineer_user_id, e.name as create_name, b.create_user_id, b.situation_id, b.start_date, b.end_date,b.project_text, b.content_text, b.remarks, c.name as situation_name, d.name as appointment_name, d.appointment_id from t_user a, t_user e, t_follow b, m_situation c, m_appointment d where b.engineer_user_id = a.user_id and b.create_user_id = e.user_id and b.situation_id = c.situation_id and b.appointment_id = d.appointment_id and follow_id = :follow_id;");
		$result	= $query->bind('follow_id', $follow_id)->bind('day2', $day2)->execute()->as_array();
		return $result;
	}

	/*
	 * 状況を取得する(親)
	*/
	public static function situation_list()
	{
		return  \DB::select()->from('m_situation')->where('flag', '0')->order_by('situation_id','desc')->execute()->as_array();
	}

	/*
	 * 状況を取得する(子)
	*/
	public static function situation_list2()
	{
		return  \DB::select()->from('m_situation')->where('flag', '1')->order_by('situation_id','desc')->execute()->as_array();
	}


	/*
	 * 一覧用のデータを取得する
	*/
	public static function list_data($day1,$day2)
	{
		//return  \DB::select('a.name', 'b.engineer_user_id', 'b.situation_id', 'c.name', 'b.start_date')->from('t_user a', 't_follow b', 'm_situation c')->where('b.engineer_user_id', 'a.user_id')->where('b.situation_id', 'c.situation_id')->execute()->as_array();
// 		$query	=\DB::query("select * from ( select a.name as user_name, a.job_type, a.user_id, b.engineer_user_id, b.situation_id, c.color_code, c.name, b.start_date, b.follow_id, b.del_flag from ( t_user a left join t_follow b on b.engineer_user_id = a.user_id and b.start_date >= :day1 and b.start_date <= :day2 ) left join m_situation c on 	b.situation_id = c.situation_id where a.job_type = '1' union select d.name as user_name, d.job_type, d.user_id, g.engineer_user_id, g.situation_id, f.color_code, f.name, e.detail_date, e.follow_id, g.del_flag from t_user d, t_follow g, t_follow_detail e, m_situation f where d.user_id = g.engineer_user_id and e.follow_id = g.follow_id and e.situation_id = f.situation_id and d.job_type = '1' ) h order by h.user_id, h.start_date;");
		$query	=\DB::query("select * from ( select a.name as user_name, a.job_type, a.user_id, b.engineer_user_id, b.situation_id, c.color_code, c.name, b.start_date, b.follow_id, b.del_flag, 0 as follow_detail_id from ( t_user a left join t_follow b on b.engineer_user_id = a.user_id and b.start_date >= :day1 and b.start_date <= :day2 ) left join m_situation c on b.situation_id = c.situation_id where a.job_type = '1' union select d.name as user_name, d.job_type, d.user_id, g.engineer_user_id, g.situation_id, f.color_code, f.name, e.detail_date, e.follow_id, e.del_flag, e.id from t_user d, t_follow g, t_follow_detail e, m_situation f where d.user_id = g.engineer_user_id and e.follow_id = g.follow_id and e.situation_id = f.situation_id and e.detail_date >= :day1 and e.detail_date <= :day2 and d.job_type = '1' ) h order by h.user_id, h.start_date;");
		$result	= $query->bind('day1', $day1)->bind('day2', $day2)->execute()->as_array();

//  	echo "--------------";
// 		echo $day1."<br>";
//  	echo $day2;
//  	var_dump($query);
//  	echo "--------------";

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
	 * 指定したフォロー情報を１レコードだけ持ってくる
	*/
	public static function get_follow($follow_id)
	{
		return  \DB::select()->from('t_follow')->where('follow_id', $follow_id)->execute()->current();
	}

	/*
	 * 指定したフォロー詳細情報を取得する
	*/
	public static function follow_detail_list($follow_id)
	{
		$query	=\DB::query("select a.detail_date, a.remarks, a.del_flag, b.follow_id, c.name as situation_name, d.name as appointment_name from t_follow_detail a, t_follow b, m_situation c, m_appointment d where b.follow_id = a.follow_id and a.appointment_id = d.appointment_id and a.situation_id = c.situation_id and a.follow_id = :follow_id order by detail_date;");
		$result	= $query->bind('follow_id', $follow_id)->execute()->as_array();
		return $result;

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
	 *	フォロー情報を登録する(終了日入り)
	*/
	public static function ins_follow2($data)
	{
		return \DB::insert('t_follow')->set(array(
			//	'follow_id'			=> "",
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
	 *	フォロー情報を変更する
	*/
	public static function upd_follow($data)
	{
		return \DB::update('t_follow')->set(array(
				'project_text'		=> $data['project_text'],
				'content_text'		=> $data['content_text'],
				'remarks'			=> $data['remarks']
		))->where('follow_id', $data['follow_id'])
		->execute();
	}


	/*
	 *	フォロー情報の削除フラッグを入力する
	*/
	public static function follow_del_flag($follow_id)
	{
		return \DB::update('t_follow')->set(array(
				'del_flag'		=> '1'
		))->where('follow_id', $follow_id)
		->execute();
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
	 *	フォロー詳細情報を1レコードだけ取得する
	*/
	public static function get_follow_detail($follow_detail_id)
	{
		return  \DB::select()->from('t_follow_detail')->where('id', $follow_detail_id)->execute()->current();
	}


	/*
	 *	フォロー詳細情報を登録する
	*/
	public static function ins_follow_detail($data)
	{
		return \DB::insert('t_follow_detail')->set(array(
				//		'follow_id'		=> "",
				'follow_id'			=> $data['follow_id'],
				'detail_date'		=> $data['detail_date'],
				'situation_id'		=> $data['situation_id'],
				'appointment_id'	=> $data['appointment_id'],
				'remarks'			=> $data['remarks2'],
				'del_flag'			=> 0,
		))->execute();
	}


	/*
	 *	フォロー詳細情報を変更する
	*/
	public static function upd_follow_detail($data)
	{
		return \DB::update('t_follow_detail')->set(array(
				//'detail_date'		=> $data['detail_date'],
				'situation_id'		=> $data['situation_id2'],
				'appointment_id'	=> $data['appointment_id2'],
				'remarks'			=> $data['remarks3']
		))->where('id', $data['follow_detail_id'])
		->execute();
	}


	/*
	 *	フォロー詳細情報の削除フラッグを設定する
	*/
	public static function upd_follow_detail_del($data)
	{
		return \DB::update('t_follow_detail')->set(array(
				'del_flag'		=> 1
		))->where('id', $data['follow_detail_id'])
		->execute();
	}


	/*
	 *	フォロー情報を取得する
	*/
	public static function get_follow_id()
	{
		return  \DB::select()->from('t_follow')->order_by('follow_id','desc')->execute()->current();
	}

	/*
	 * 状況フラグ確認
	*/
	public static function get_situation($situation_id)
	{

		$select =\DB::query("select situation_id from t_follow where situation_id = $situation_id");
		$result	=	$select->execute()->current();
		return $result;
	}

	/*
	 * 状況フラグ確認2
	*/
	public static function get_situation2($situation_id)
	{
		$select2 =\DB::query("select situation_id from t_follow_detail where situation_id = $situation_id");
		$result2 = $select2->execute()->current();
		return $result2;
	}

	/*
	 *	situation_flagとsituation_idを比較する。
	*/
	public static function select_flag($data)
	{
		return  \DB::select('situation_flag')->from('m_situation')->where('situation_id', $data["situation_id"])->where('situation_flag', '1')->execute()->current();
	}





}