<?php

class Controller_Uemuratest extends Controller
{

	public function action_index()
	{
		// POST
		$post = Input::post();
			//var_dump($post);

		// 定義
		$data["err"]			= empty($post["err"]) ? "" : $post["err"];
		$data["free_word1"]		= empty($post["free_word1"]) ? "" : $post["free_word1"];
		$data["free_word2"]		= empty($post["free_word2"]) ? "" : $post["free_word2"];
		$data["mark"]			= empty($post["mark"]) ? "" : $post["mark"];
		$data["total"]			= empty($post["total"]) ? "" : $post["total"];
		$data["execute"]		= empty($post["execute"]) ? "set" : $post["execute"];
			//var_dump($post);
			//print "free_word1 = ".$post["free_word1"];
			//exit;

		if (!empty($post["execute"])) {
			//空欄のチェック
			if(empty($data["free_word1"]) || empty($data["free_word2"]))
			{
				$data["err"] = '空欄があります。数字が入力されているか確認してください。';
			}
			else if(is_numeric($data["free_word1"]) || is_numeric($data["free_word2"]))
			{
				switch ($data["mark"])
				{
			 		case "1":
				 		$data["total"] = $data["free_word1"]+$data["free_word2"];
				 		break;

				 	case "2":
						$data["total"] = $data["free_word1"]-$data["free_word2"];
						break;

				 	case "3":
						$data["total"] = $data["free_word1"]*$data["free_word2"];
						break;

				 	case "4":
						$data["total"] = $data["free_word1"]/$data["free_word2"];
						break;
			 	}
			}
			else
			{
				$data["err"] = "半角数字で入力してください。";
			}
		}
		// 画面の出力
		return View::forge('uemuratest', $data);
	}

	// public function action_hoge()
	// {
	// 	echo "bbb";
	// }

}
