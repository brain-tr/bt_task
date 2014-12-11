<?php

use \Model\Db_Ranking;
use \Model\kisitest;
use \Model\Workbench;

class Controller_Kisitest extends Controller
{
	
	public function action_mail()
	{
	
		$subject = str_replace("{title}",			"登録",						FOLLOW_SUBJECT);
		$message = str_replace("{user_name}",		"キシハラ",					FOLLOW_MESSAGE);
		$message = str_replace("{follow_url}",		"http://yahoo.co.jp",		$message);
		if(!Workbench::sendMail("kab06835@yahoo.co.jp","test",$subject,$message)){
			return Response::forge(View::forge('welcome/404', $data), 404);
		}
	
	}
	
	/*
	*	ＴＯＰ画面
	*/
	public function action_top()
	{
		return View::forge('kisitest/top');
	}
	
	/*
	*	ゲーム画面
	*		player       int  プレイヤーが選択した物
	*/
	public function action_game($player = 0)
	{	
		$post				= Input::post();
		$date["point"]		= empty($post["point"]) ? 0: $post["point"];
		$date["result"]		= 9;
		
		//出すものが選ばれた時
		if ($player > 0 && $player < 4){
			
			//CPUの出すもの抽選
			$cpu = kisitest::cpu_rand();
			
			//勝敗判定
			$date["result"] = kisitest::cpu_judgment($player,$cpu);

			//出したものの日本語名取得
			$date["play_name"]	= kisitest::name_get($player);
			$date["cpu_name"]	= kisitest::name_get($cpu);
			
			switch ($date["result"]) {
			case 0:
				$date["msg"] = "あなた：".$date["play_name"]." CPU：".$date["cpu_name"]."　負けました・・・";
				
				$sql["point"]			= $date["point"];
				$sql["create_date"]		= date("Y-m-d H:i:s");
				db_ranking::ins_ranking($sql);

				break;
			case 1:
				$date["msg"] = "あなた：".$date["play_name"]." ".$date["cpu_name"]."　勝利！";
				$date["point"]++;
				break;
			case 2:
				$date["msg"] = "あなた：".$date["play_name"]." CPU：".$date["cpu_name"]."　あいこ";
				break;
			}
		}
		
		return View::forge('kisitest/game', $date);
	}

	/*
	*	ゲーム画面2（Ajax使用）
	*		player       int  プレイヤーが選択した物
	*/
	public function action_game2()
	{	
		$post				= Input::post();
		$player 			= empty($post["player"]) ? 0: $post["player"];
		$date["point"]		= empty($post["point"]) ? 0: $post["point"];
		$date["result"]		= 9;
		
		//出すものが選ばれた時
		if ($player > 0 && $player < 4){
			
			//CPUの出すもの抽選
			$cpu				= kisitest::cpu_rand();
			
			//勝敗判定
			$date["result"]		= kisitest::cpu_judgment($player,$cpu);
			
			//出したものの日本語名取得
			$date["play_name"]	= kisitest::name_get($player);
			$date["cpu_name"]	= kisitest::name_get($cpu);
			
			switch ($date["result"]) {
			case 0:
				$date["msg"] = "あなた：".$date["play_name"]." CPU：".$date["cpu_name"]."　負けました・・・";
				
				$sql["point"]			= $date["point"];
				$sql["create_date"]		= date("Y-m-d H:i:s");
				db_ranking::ins_ranking($sql);

				break;
			case 1:
				$date["msg"] = "あなた：".$date["play_name"]." CPU：".$date["cpu_name"]."　勝利！";
				$date["point"]++;
				break;
			case 2:
				$date["msg"] = "あなた：".$date["play_name"]." CPU：".$date["cpu_name"]."　あいこ";
				break;
			}
		}
		
		return View::forge('kisitest/game2', $date);
	}

	
	/*
	*	ランキング画面
	*/
	public function action_ranking()
	{
	
		$date["ranking"] = db_ranking::ranking_list();
		return View::forge('kisitest/ranking', $date);
	
	}

	public function action_redistest()
	{

        $redis = Redis::instance('default');

        $staff = array(
                     'staff1' => 30,
                     'staff2' => 25,
                     'staff3' => 42,
                     'staff4' => 60,
                     'staff5' => 38
                 );

        foreach ($staff as $name => $age) {
            // 年齢をスコアとして、スタッフ名をメンバーとして登録
            $redis->zadd('mysort', $age, $name);
        }

        // 年齢の昇順リスト
        $list = $redis->zrange('mysort', 0, count($staff));

        // 年齢の降順リスト
        $rlist = $redis->zrevrange('mysort', 0, count($staff));

        // 昇順の場合の staff4 の順位(ランクが0から始まる為、1を足す)
        $rank = $redis->zrank('mysort', 'staff4') + 1;

        // 降順の場合の staff4 の順位(ランクが0から始まる為、1を足す)
        $rrank = $redis->zrevrank('mysort', 'staff4') + 1;
		
		var_dump($list);
		var_dump($rlist);
		var_dump($rank);
		var_dump($rrank);
	
	}
}