<?php
namespace Model;

class Kisitest extends \Model {

	private static $syouhai		= array(						//勝敗判定(0：敗北　1:勝利　2：あいこ)
			"1"		=>	array("1" => 2, "2" => 1, "3" => 0),
			"2"		=>	array("1" => 0, "2" => 2, "3" => 1),
			"3"		=>	array("1" => 1, "2" => 0, "3" => 2),
	);

	private static $name		= array(						//出したもの判別
			"1"		=>	"グー",
			"2"		=>	"チョキ",
			"3"		=>	"パー",
	);
	
	/*
	*	CPUが出すものを抽選する（1：グー　2：チョキ　3：パー）
	*/
	public static function cpu_rand()
	{
		return mt_rand(1,3);
	}
	
	/*
	*	勝敗判定(1:勝利　2：敗北　3：あいこ)
	*/
	public static function cpu_judgment($player, $cpu)
	{
		return static::$syouhai[$player][$cpu];
	}
	
	public static function name_get($val)
	{
		return static::$name[$val];
	}
	

}