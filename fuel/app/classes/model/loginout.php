<?php
namespace Model;

class Loginout extends \Model {

	// ログインチェック
	public static function logincheck()
	{
		if (empty($_SESSION['id'])){
			return false;
		} else {
			return true;
		}
	}

}