<?php
namespace Model;

class Workbench extends \Model {

	public static function validateDate($date, $format = 'Y-m-d H:i:s')
	{
		$d = \DateTime::createFromFormat($format, $date);
		return $d && $d->format($format) == $date;
	}

	/*
	* メール送信
	*/
	public static function sendMail($to, $from, $subject, $message)
	{

		if (mb_send_mail($to, $subject, $message, "From: ".$from)) {
			return true;
		} else {
			error_log("send mail error to=".$to." from=".$from." subject=".$subject." message=".$message);
			return false;
		}

	}

}