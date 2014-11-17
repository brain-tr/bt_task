<?php
namespace Model;

class User extends \Model {

	/*
	 *	パスワードのチェック
	*/
	public static function check_php($flag,$name,$password,$password_conf)
	{
		$passCount = mb_strlen($password);	// 文字数

		if(in_array(1,$flag)){
			if(empty($name)) {
				$msg	= "名前が入力されていません。";
				return $msg;
			}
		}
		if(in_array(2,$flag)){
			if(empty($password) || empty($password_conf)) {
				$msg	= empty($msg) ? "パスワードまたはパスワード(確認用)を入力してください。" : $msg;
				return $msg;
			}
		}
		if(in_array(3,$flag)){
			if(!preg_match("/^[a-zA-Z0-9]+$/", $password)) {
				$msg	= empty($msg) ? "パスワードは半角英数で入力してください。" : $msg;
				return $msg;
			}
		}
		if(in_array(4,$flag)){
			if($password != $password_conf) {
				$msg	= empty($msg) ? "パスワードとパスワード(確認用)の文字が一致しません。" : $msg;
				return $msg;
			}
		}
		if(in_array(5,$flag)){
			if($passCount < 4) {
				$msg	= empty($msg) ? "4文字以上のパスワードを入力してください。" : $msg;
				return $msg;
			}
		}
		if(in_array(6,$flag)){
			if($passCount > 12) {
				$msg	= empty($msg) ? "12文字以下のパスワードを入力してください。" : $msg;
				return $msg;
			}
		}
	}


}