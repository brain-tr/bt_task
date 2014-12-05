<?php
namespace Model;
class db_eachpoint extends \Model {


 	//全件表示用 昇降ボタン
 	public static function get_all1($select,$hiki)
 	{
		$query =\DB::query("SELECT * FROM t_seito a,t_test b where a.seito_id=b.seito_id order by ".$select." ".$hiki." ");
		$result	=	$query->execute()->as_array();
		return $result;
 	}

 	//点数取得用
//  	public static function get_point()
//  	{
//  		$query =\DB::query("SELECT * FROM t_seito a,t_test b where a.seito_id=b.seito_id group by name ");
//  		$result	=	$query->execute()->as_array();
//  		return $result;
//  	}

 	//全件抽出
 	public static function get_japanese()
 	{
 		$query =\DB::query("select a.seito_id,a.name,b.kyouka_id,b.point from t_seito a left join t_test b
 				on a.seito_id = b.seito_id order by name,kyouka_id; ");
 		$result	=	$query->execute()->as_array();
 		return $result;
	}

	//重複抽出
	public static function get_double()
	{
		$query =\DB::query("select * from t_test where(seito_id,kyouka_id) in(select seito_id,kyouka_id from t_test
							group by kyouka_id,seito_id having count(*)>1); ");
		$double	=	$query->execute()->as_array();
		return $double;
	}
	//全件抽出　昇降ボタン(0付)
	public static function on_change2($hiki,$select,$h_r)
	{
 		if($select!=7){
			$query2 = \DB::query
			(
				"	select
		a.seito_id,
		a.name,
		COALESCE(a.kyouka_id, NULL) as kyouka_id,
		COALESCE(b.point, 0) as point,
		c.max_point
	from
			(
				select
					seito_id,
					name,
					kyouka_id
				from
				(
					select
						distinct(kyouka_id) as kyouka_id
					from
						t_test
				) a,
				t_seito
			) a left join
				t_test b on a.seito_id = b.seito_id and
							a.kyouka_id = b.kyouka_id
			left join
			(
				select
					seito_id,
					kyouka_id,
					max(point) as max_point
				from
					t_test
				where
					kyouka_id = $select
				group by
					seito_id
			) c on c.seito_id = a.seito_id

	where
		a.kyouka_id

					union
					(
						select
							b.seito_id,
							name,
							'7' as
							kyouka_id ,
							sum(point),
							c.max_point
						from
							(
								select
									seito_id,
									max(point) as max_point
								from
									t_test
								where
									kyouka_id = $select
								group by
									seito_id
							) c,

							t_seito a left join
							t_test b on a.seito_id = b.seito_id
						where
							a.seito_id = c.seito_id

						group by
							b.seito_id
					)

					order by
	 				max_point $hiki,
	 				name,
					kyouka_id;"

			);
 		}else{
 			$query2 = \DB::query
 			(
 			"select
		a.seito_id,
		a.name,
		COALESCE(a.kyouka_id, NULL) as kyouka_id,
		COALESCE(b.point, 0) as point,
		c.max_point
	from
			(
				select
					seito_id,
					name,
					kyouka_id
				from
				(
					select
						distinct(kyouka_id) as kyouka_id
					from
						t_test
				) a,
				t_seito
			) a left join
				t_test b on a.seito_id = b.seito_id and
							a.kyouka_id = b.kyouka_id
			left join
			(
				select
					seito_id,
					kyouka_id,
					sum(point) as max_point
				from
					t_test
				where
					kyouka_id
				group by
					seito_id
			) c on c.seito_id = a.seito_id

	where
		a.kyouka_id

					union
					(
						select
							b.seito_id,
							name,
							'7' as
							kyouka_id ,
							sum(point),
							c.max_point
						from
							(
								select
									seito_id,
									sum(point) as max_point
								from
									t_test
								where
									kyouka_id
								group by
									seito_id
							) c,

							t_seito a left join
							t_test b on a.seito_id = b.seito_id
						where
							a.seito_id = c.seito_id

						group by
							b.seito_id
					)

					order by
	 				max_point $hiki,
	 				name,
					kyouka_id;"
 			);
 		}
			$result	=	$query2->execute()->as_array();
			return $result;
	}

 	//全件抽出 昇降ボタン
 	public static function on_change($hiki,$select,$h_r)
 	{
 		if($select!=7){
	 		$query =\DB::query
	 		(
			 "select
					a.seito_id,
					a.name,
					b.kyouka_id,
					b.point,
					c.max_point
				 from
					(
						select
							seito_id,
							max(point) as max_point
						from
							t_test
						where
							kyouka_id = $select
						group by
							seito_id
					) c,
					  t_seito a left join
					  t_test b on a.seito_id = b.seito_id
				where
					  a.seito_id = c.seito_id
				union
					(
						select
							b.seito_id,
							name,
							'7' as
							kyouka_id ,
							sum(point),
							c.max_point
						from
							(
								select
									seito_id,
									max(point) as max_point
								from
									t_test
								where
									kyouka_id = $select
								group by
									seito_id
							) c,

							t_seito a left join
							t_test b on a.seito_id = b.seito_id
						where
							a.seito_id = c.seito_id

						group by
							b.seito_id
					)

					order by
	 				max_point $hiki,
	 				name,
					kyouka_id"
			);
 		}else{
 			$query =\DB::query
	 		(
			 "select
					a.seito_id,
					a.name,
					b.kyouka_id,
					b.point,
					c.max_point
				 from
					(
						select
							seito_id,
							sum(point) as max_point
						from
							t_test
						group by
							seito_id
					) c,
					  t_seito a left join
					  t_test b on a.seito_id = b.seito_id
				where
					  a.seito_id = c.seito_id
				union
					(
						select
							b.seito_id,
							name,
							'7' as
							kyouka_id ,
							sum(point),
							c.max_point
						from
							(
								select
									seito_id,
									sum(point) as max_point
								from
									t_test
								group by
									seito_id
							) c,

							t_seito a left join
							t_test b on a.seito_id = b.seito_id
						where
							a.seito_id = c.seito_id

						group by
							b.seito_id
					)

					order by
	 				max_point $hiki,
	 				name,
					kyouka_id"
			);
 		}


 		//var_dump($query);

 		$result	=	$query->execute()->as_array();
 		return $result;
	}

	//合計抽出　各科目
	public static function get_sum()
	{
		$goukei =\DB::query("select sum(point)as 'point' from t_test group by kyouka_id; ");
		$sum	=	$goukei->execute()->as_array();
		return $sum;
	}

	//合計抽出　生徒ずつ
	public static function get_sum2()
	{
//12/02作業メモ
	//select min(kyouka_id)+1 from t_test a
	//where not exists (select null from t_test x where x.kyouka_id between a.id+1 and a.id+1+1);
	//名前も教科もあれば記述する
	//・NULLになっているところは0にする。
	//教科IDをグループバイして、1-6までがなかったらNULLを挿入する。
	//or
	//サブクエリで1-6までに無い部分をNULLにするものを作成するか。

		$goukei =\DB::query("
				select
					a.seito_id,
					a.name,
					COALESCE(a.kyouka_id, NULL) as kyouka_id,
					COALESCE(b.point, 0) as point
				from
					(
						select
							seito_id,
							name,
							kyouka_id
						from
						(
							select
								distinct(kyouka_id) as kyouka_id
							from
								t_test
						) a,
						t_seito
					) a left join
					t_test b on a.seito_id = b.seito_id and
								a.kyouka_id = b.kyouka_id
				union
				(
				select
					b.seito_id,
					name,
					'7' as
					kyouka_id,
					sum(point)
				from
					t_seito a left join
					t_test b on a.seito_id = b.seito_id
				where
					kyouka_id
				group by
					b.seito_id
				)
				order by
					name,
					kyouka_id;");
		$sum	=	$goukei->execute()->as_array();
		return $sum;
	}



}