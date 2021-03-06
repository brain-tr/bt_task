<?php
namespace Model;
class db_customer extends \Model {


	/*
	 *	顧客会社情報を登録する
	*/
	public static function ins_company($data)
	{

		\DB::insert('k_company')->set(array(
				'company_name'		=> $data['c_name'],
				'capital'			=> $data['capital'],
				'employees'			=> $data['employees'],
				'sales'				=> $data['sales'],
				'company_add_code'	=> $data['company_add_code'],
				'company_add'		=> $data['address'],
				'company_tel'		=> $data['tel'],
				'company_mail'		=> $data['mail'],
				'user_name'			=> $data['u_name'],
				'special_text'		=> $data['special'],
				'c_flag'			=> $data['flag'],
				'listing_flag'		=> $data['listing_flag'],
				'rank_id'			=> 0,
				'creation_time'		=> date("Y-m-d H:i:s")
		))->execute();

		$query	=\DB::query("SELECT LAST_INSERT_ID();");
		$result	= $query->execute()->current();
		return $result;
	}

	/*
	 *	顧客会社情報重複チェック
	 */
	public static function check_company($data)
	{
		return \DB::select('company_name')->from('k_company')->where("company_name",$data["c_name"])->execute()->as_array();
	}



	/*
	 *	顧客担当者情報を登録する
	 */
	public static function ins_customer($id,$name,$tel,$mail,$remarks)
	{
		\DB::insert('k_customer')->set(array(
				'company_id'	=> $id,
				'name'			=> $name,
				'tel'			=> $tel,
				'mail'			=> $mail,
				'remarks'		=> $remarks,
				'rank_id'		=> 0
		))->execute();
	}
	
	/*
	 *	顧客請求担当者情報を登録する
	 */
	public static function ins_claim($id,$name,$tel,$mail,$remarks)
	{
		\DB::insert('k_claim')->set(array(
				'company_id'	=> $id,
				'name'			=> $name,
				'tel'			=> $tel,
				'mail'			=> $mail,
				'remarks'		=> $remarks,
				'rank_id'		=> 0
		))->execute();
	}

	/*
	 *	顧客会社情報を取得する
	*/
	public static function get_company($data,$data2)
	{
		 //変更処理の時と一覧から飛んできた時に判定を分けています。
		 return \DB::select()->from('k_company')->or_where_open()->where("company_id",$data)->or_where('company_id',$data2)->or_where_close()->execute()->as_array();

	}

	/*
	 *	顧客担当者情報を取得する
	*/
	public static function get_customer($data,$data2)
	{
		//変更処理の時と一覧から飛んできた時に判定を分けています。
		return \DB::select()->from('k_customer')->or_where_open()->where("company_id",$data)->or_where('company_id',$data2)->or_where_close()->execute()->as_array();

	}
	public static function get_claim($data,$data2)
	{
		//変更処理の時と一覧から飛んできた時に判定を分けています。
		return \DB::select()->from('k_claim')->or_where_open()->where("company_id",$data)->or_where('company_id',$data2)->or_where_close()->execute()->as_array();

	}

	/*
	 *	顧客会社情報を変更する
	*/
	public static function upd_company($data)
	{
		return \DB::update('k_company')->set(array(
				'company_name'		=> $data['c_name'],
				'capital'			=> $data['capital'],
				'employees'			=> $data['employees'],
				'sales'				=> $data['sales'],
				'company_add_code'	=> $data['company_add_code'],
				'listing_flag'		=> $data['listing_flag'],
				'company_add'		=> $data['address'],
				'company_tel'		=> $data['tel'],
				'company_mail'		=> $data['mail'],
				'user_name'			=> $data['u_name'],
				'special_text'		=> $data['special'],
				'c_flag'			=> $data['flag'],
				'rank_id'			=> 0,
                'modification_time'	=> date("Y-m-d H:i:s"),
		))->where('company_id', $data['company_id'])
		->execute();
	}

	/*
	 *  顧客担当者情報を削除する
	 */
	public static function del_customer($company_id)
	{
		\DB::delete('k_customer')->where('company_id',$company_id)->execute();

	}
	public static function del_claim($company_id)
	{
		\DB::delete('k_claim')->where('company_id',$company_id)->execute();

	}

	/*
	 *	顧客担当者情報を変更する
	*/
	public static function upd_customer($company_id,$name,$tel,$mail,$remarks)
	{
		return \DB::insert('k_customer')->set(array(
				'company_id'	=> $company_id,
				'name'			=> $name,
				'tel'			=> $tel,
				'mail'			=> $mail,
				'remarks'		=> $remarks,
				'rank_id'		=> 0
		))->execute();
	}
	public static function upd_claim($company_id,$name,$tel,$mail,$remarks)
	{
		return \DB::insert('k_claim')->set(array(
				'company_id'	=> $company_id,
				'name'			=> $name,
				'tel'			=> $tel,
				'mail'			=> $mail,
				'remarks'		=> $remarks,
				'rank_id'		=> 0
		))->execute();
	}

	/*
	 *  一覧用の顧客会社名を全件取得する
	 */
	public static function get_name($limitCnt)
	{
		return \DB::select('company_id','company_name','c_flag','creation_time','modification_time')->from('k_company')->order_by('company_name','asc')->limit(10)->offset($limitCnt * 10 -10)->execute()->as_array();
	}
    
    /*
	 *  一覧用の顧客会社名の数を取得する
	 */
	public static function get_name_count()
	{
        
		$result = \DB::select('*')->from('k_company')->execute()->as_array();
        return count($result);
	}
    
    public static function get_name_count_where($data)
	{
		$result = \DB::select('*')->from('k_company')->or_where_open()->where("company_name",'like','%'.$data.'%')->or_where('user_name','like','%'.$data.'%')->or_where('company_tel','like','%'.$data.'%')->or_where_close()->execute()->as_array();
        return count($result);
	}

	/*
	 *  顧客会社情報を削除する
	 */
	public static function del_company($company_id)
	{
		\DB::delete('k_company')->where('company_id',$company_id)->execute();
	}

	/*
	 *  顧客会社情報あいまい検索
	 */
	public static function search_company($data,$limitCnt)
	{
		return \DB::select('company_id','company_name','c_flag','creation_time','creation_time','modification_time')->from('k_company')->or_where_open()->where("company_name",'like','%'.$data.'%')->or_where('user_name','like','%'.$data.'%')->or_where('company_tel','like','%'.$data.'%')->or_where_close()->limit(10)->offset($limitCnt * 10 - 10)->execute()->as_array();
	}

	/*
	 *	昇順降順ボタン
	 */
	public static function up_down($select,$cd,$limitCnt)
	{
		return \DB::select('company_id','company_name','c_flag','creation_time','creation_time','modification_time')->from('k_company')->order_by($select,$cd)->limit(10)->offset($limitCnt * 10 - 10)->execute()->as_array();
	}


	/*
	 *	昇順降順ボタン(会社名検索付き)
	*/
	public static function up_down2($select,$cd,$data,$limitCnt)
	{
		return \DB::select('company_id','company_name','c_flag','creation_time','modification_time')->from('k_company')->or_where_open()->where("company_name",'like','%'.$data.'%')->or_where('company_tel','like','%'.$data.'%')->or_where_close()->order_by($select,$cd)->limit(10)->offset($limitCnt * 10 - 10)->execute()->as_array();
	}


	/*
	 *  顧客会社検索
	*/
	public static function matter_company($data)
	{
		return \DB::select('company_id')->from('k_matter')->where("company_id",$data)->execute()->as_array();
	}


}