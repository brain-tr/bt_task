<?php
namespace Model;
class db_matter extends \Model {

	/*
	 *	顧客会社名全件取得
	 */
	public static function all_name()
	{
				$query =\DB::query("
				select
					a.company_id,
					company_name,
					company_add,
					company_tel,
					company_mail,
					special_text,
					c_flag,
					name,
					tel,
					mail
				from
					k_company a left join k_customer b
				on
					a.company_id = b.company_id
				group by
					company_name;
				");
		$result	=	$query->execute()->as_array();
		return $result;
	}


	/*
	 *  顧客会社名検索
	 */
	public static function search_name($data)
	{
		$query =\DB::query("
				select
					a.company_id,
					company_name,
					company_add,
					company_tel,
					company_mail,
					special_text,
					c_flag,
					name,
					tel,
					mail
				from
					k_company a left join k_customer b
				on
					a.company_id = b.company_id
				where
					company_name LIKE '%$data%'
				or
					company_tel LIKE '%$data%'
				group by
					company_name;
				");
		$result	=	$query->execute()->as_array();
		return $result;
	}

	/*
	 *  顧客担当者取得
	 */
	public static function all_person()
	{
		return \DB::select()->from('k_customer')->execute()->as_array();
	}

	/*
	 *  顧客対応情報登録
	 */
	public static function ins_matter($data)
	{
		//要求フラグが未完成のため、case_idには1を入れるようにしています。
		\DB::insert('k_matter')->set(array(
				'company_id'	=> $data['c_id'],
				'case_id'		=> 1,
				'respone_name'	=> $data['user'],
				'content_text'	=> $data['detail'],
				'date'			=> $data['date'],
				'user_id'		=> $data['userlog_id']
		))->execute();
	}

	/*
	 *	二重登録チェック
	*/
	public static function check_matter($data)
	{
		return \DB::select('matter_id')->from('k_matter')->or_where_open()->where("content_text",$data["detail"])->and_where('date',$data["date"])->or_where_close()->execute()->as_array();
	}

	/*
	 *	会社別対応一覧取得用
	 */
	public static function get_matter($matter)
	{
		//where文の部分は一覧ができたら必ず修正すること!
		$query =\DB::query("
				select
					matter_id,
					a.company_id,
					company_name,
					company_add,
					company_tel,
					company_mail,
					special_text,
					c_flag,
					b.name,
					tel,
					b.mail,
					respone_name,
					content_text,
					date,
					c.user_id,
					d.name as user_name
				from
					k_company a left join k_customer b
				on
					a.company_id = b.company_id
				left join
					k_matter c
				on
					b.company_id = c.company_id
				left join
					t_user d
				on
					c.user_id = d.user_id
				where
					matter_id = $matter

				group by
					company_name;
				");
		$result	=	$query->execute()->as_array();
		return $result;
	}

	/*
	 *	対応情報変更
	 */
	public static function upd_matter($data)
	{
		return \DB::update('k_matter')->set(array(
				'respone_name'		=> $data['user'],
				'content_text'		=> $data['detail'],
				'date'				=> $data['date']
		))->where('matter_id', $data['m_id'])
		->execute();
	}

	/*
	 *	更新者情報入力
	 */
	public static function ins_updated($data)
	{
		return \DB::insert('k_updated')->set(array(
				'matter_id'			=> $data["m_id"],
				'user_id'			=> $data["userlog_id"],
		))->execute();
	}

	/*
	 *	一覧表示用取得
	 */
	public static function get_list()
	{
		 $query =\DB::query("
				select
		 			a.company_id,
		 			matter_id,
					company_name,
					case_id,
					date
				from
					k_company a
				left join
					k_matter b
				on
					a.company_id = b.company_id
				");
		$result	=	$query->execute()->as_array();
		return $result;
	}

	/*
	 *	カレンダー会社名検索
	 */
	public static function search_list($search)
	{
		$query =\DB::query("
				select
		 			a.company_id,
					matter_id,
					company_name,
					case_id,
					date
				from
					k_company a
				left join
					k_matter b
				on
					a.company_id = b.company_id
				where
					company_name = '$search'
				");
		$result	=	$query->execute()->as_array();
		return $result;
	}

	/*
	 *	対応者名一覧取得
	 */
	public static function get_respon()
	{
		return \DB::select('matter_id','respone_name')->from('k_matter')->group_by('respone_name')->execute()->as_array();
	}

	/*
	 *	カレンダー対応者検索
	 */
	public static function search_respon($search)
	{
		$query =\DB::query("
				select
					a.company_id,
					matter_id,
					company_name,
					case_id,
					date
				from
					k_company a
				left join
					k_matter b
				on
					a.company_id = b.company_id
				where
					respone_name = '$search'
				");
		$result	=	$query->execute()->as_array();
		return $result;
	}

	/*
	 *	カレンダーサブウインドウ用名前一覧
	 */
	public static function all_cname()
	{
		return \DB::select('company_name')->from('k_company')->execute()->as_array();
	}


}