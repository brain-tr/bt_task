<?php
namespace Model;

class db_user extends \Model {

	/*
	 * 指定したユーザー情報（名前）を１レコードだけ持ってくる
	*/
	public static function get_user_name($name)
	{
		return  \DB::select()->from('t_user')->where('name', $name)->execute()->current();
	}

	/*
	 * 指定したユーザー情報（id）を１レコードだけ持ってくる
	*/
	public static function get_user_id($user_id)
	{
		return  \DB::select()->from('t_user')->where('user_id', $user_id)->execute()->current();
	}

	/*
	 * ユーザー情報を降順で取得する
	*/
	public static function user_list()
	{
		return  \DB::select()->from('t_user')->order_by('rank_id','asc')->order_by('user_id','desc')->execute()->as_array();
	}

	/*
	 *	ユーザー情報を登録する
	*/
	public static function ins_user($data)
	{
		return \DB::insert('t_user')->set(array(
//				'user_id'		=> "",
				'name'			=> $data['name'],
				'mail'			=> $data['mail'],
				'job_type'		=> $data['job_type'],
				'send_flag'		=> $data['send_flag'],
				'rank_id'		=> $data['rank_id'],
				'password'		=> $data['password'],
		))->execute();
	}

	/*
	 *	ユーザー情報を変更する
	*/
	public static function upd_user($data)
	{
		return \DB::update('t_user')->set(array(
				//'user_id'		=> "",
				'name'			=> $data['name'],
				'mail'			=> $data['mail'],
				'job_type'		=> $data['job_type'],
				'send_flag'		=> $data['send_flag'],
				'rank_id'		=> $data['rank_id'],
				//'password'	=> $data['password'],
		))->where('user_id', $data['user_id'])
		->execute();

	}

	/*
	 *	パスワードを変更する
	*/
	public static function upd_user_pass($data)
	{
		return \DB::update('t_user')->set(array(
				'password'		=> $data['new_pass'],
		))->where('user_id', $data['user_id'])
		->execute();

	}

	/*
	 *	ユーザー情報を削除
	*/
	public static function delete_user($id)
	{
		\DB::delete('t_user')->where('user_id', $id)->execute();
	}

	/*
	 * ユーザ存在確認
	* メールアドレスとパスワードが一致する本登録済みユーザを取得
	*/
	public static function confirm_user($mail,$pass)
	{
		return \DB::select()->from('t_user')->where('mail', $mail)->where('password', $pass)->execute()->current();
	}
}