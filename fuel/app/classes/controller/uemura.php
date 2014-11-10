<?php
use \Model\Db_Ranking;
class Controller_Uemura extends Controller
{
	public function action_index()
	{
	}

	// トップ
	public function action_top()
	{
		// POST
		$post = Input::post();
		$data["start"]		= empty($post["start"]) ? "" : $post["start"];
		$data["ranking"]	= empty($post["ranking"]) ? "" : $post["ranking"];

		// 画面表示
		return View::forge('uemura/top', $data);
	}

	public function action_game()
	{

	//ゲーム処理（Js）
	$post				= Input::post();
	$player 			= empty($post["player"]) ? "" : $post["player"];
	$data["point"]		= empty($post["point"]) ? 0 : $post["point"];
	$data["cpu"]		= empty($post["cpu"]) ? 0 : $post["cpu"];
	$data["result"]		= empty($post["result"]) ? 0 : $post["result"];
	$data["msg"]		= empty($post["msg"]) ? "" : $post["msg"];

	// ランキングに登録
	if(!empty($data["point"]) && strlen($data["point"]) != 0)
	{
		$data["create_date"]	= date("Y-m-d H:i:s");
		//var_dump($data);
		db_ranking::ins_ranking($data);
		$data["result"] = 1;
		$data["msg"] = "敗北！";
	}
	if($data["result"] === "haiboku")
	{
		$data["result"] = 1;
		$data["msg"] = "敗北！";
	}

	return View::forge('uemura/game', $data);
	}


	// ゲーム処理 (PHP)
// 	public function action_game()
// 	{
// 		// POST
// 		$post = Input::post();
// 		$data["start"]		= empty($post["start"]) ? "" : $post["start"];
// 		$data["ranking"]	= empty($post["ranking"]) ? "" : $post["ranking"];
// 		$data["key"]		= empty($post["key"]) ? "" : $post["key"];
// 		$data["answer"]		= empty($post["answer"]) ? "" : $post["answer"];
// 		$data["count"]		= empty($post["count"]) ? "" : $post["count"];
// 		$data["msg"]		= empty($post["msg"]) ? "" : $post["msg"];

// 		if(empty($data['count']) && strlen($data['count']) === 0)
// 		{
// 			$data['count'] = 0;
// 		}

// 		// 相手側
// 		switch ($data["key"]){
// 			case "グー":
// 				$data["answer"] = '1';
// 				break;

// 			case "チョキ":
// 				$data["answer"] = '2';
// 				break;

// 			case "パー":
// 				$data["answer"] = '3';
// 				break;
// 		}

// 		// PC側
// 		$data["num"] = rand(1,3);
// 		$data["start"] = "result";

// 		if($post["start"] == "result") {

// 			// 勝敗処理
// 			if($data["answer"] == $data["num"]){
// 				$data['msg'] = 'あいこ！';
// 			}
// 			else if($data["answer"] == 1 || $data["num"] == 2)
// 			{
// 				$data['msg'] = '勝利！';
// 				$data['count']++;
// 			}
// 			else if($data["answer"] == 1 || $data["num"] == 3)
// 			{
// 				$data['msg'] = '敗北！';
// 			}
// 			else if($data["answer"] == 2 || $data["num"] == 1)
// 			{
// 				$data['msg'] = '敗北！';
// 			}
// 			else if($data["answer"] == 2 || $data["num"] == 3)
// 			{
// 				$data['msg'] = '勝利！';
// 				$data['count']++;
// 			}
// 			else if($data["answer"] == 3 || $data["num"] == 1)
// 			{
// 				$data['msg'] = '勝利！';
// 				$data['count']++;
// 			}
// 			else if($data["answer"] == 3 || $data["num"] == 2)
// 			{
// 				$data['msg'] = '敗北！';
// 			}

// 			// ランキングに登録
// 			if($data['msg'] == '敗北！' && $data['count'] !== 0){
// 				$data["point"]			= $data['count'];
// 				$data["create_date"]	= date("Y-m-d H:i:s");
// 				db_ranking::ins_ranking($data);
// 			}
// 		}

// 		// 画面表示
// 		return View::forge('uemura', $data);
// 	}


	// ランキング
	public function action_ranking()
	{
		// POST
		$post = Input::post();
		$data["start"]				= empty($post["start"]) ? "" : $post["start"];
		$data["ranking"]			= empty($post["ranking"]) ? "" : $post["ranking"];

		//ランキングを表示する
		$rankingData = db_ranking::ranking_list();
		echo '<table cellpadding="5"><tr>';
		$i = 1;
		foreach ($rankingData as $key => $val){
			//var_dump($val);echo "<br>";
			echo '<tr>';
			echo '<td>'.$i.'</td>'.'<td>'.$val['point'].'</td>'.'<td>'.$val['create_date'].'</td>';
			echo '</tr>';
			$i++;
		}
		echo '</table>';

		// 画面表示
		return View::forge('uemura/ranking', $data);
	}
}
