<?php

use \Model\Db_Ranking;

class Controller_Satotest2 extends Controller
{

	public function action_index()
	{
		$post			= Input::post();
		if ( isset($post['jan']) ) {

   			 $janken = array(1 => 'グー',2 => 'チョキ',3 => 'パー');

	   		 $keka = array('あいこ','負け','勝ち',);

			 $sentaku = array_flip($janken);
	   		 $sentaku = $sentaku[$post['jan']];

	         $en = rand(1, 3);

	         $fin = ( $sentaku - $en + 3 ) % 3;

	         echo '自分：'. $janken[$sentaku]."<br>";
	         echo 'COM：'. $janken[$en]."<br>";
	 	 	 echo '結果：'. $keka[$fin]."<br>";

	 	 	 $hiki= $keka[$fin];

	 	 switch($hiki)
	 	 {
	 	 	case "勝ち":
	 	 		echo "勝利<br>";
	 	 		break;

	 	 	 case "あいこ":
	 	 	 	echo "あいこです。もう一度<br>";
	 	 	 	break;

	 	 	 case "負け":
	 	 	 	echo "負けです残念<br>";
	 	 	 	break;



		 }
		session_start();
		 if (!isset($_SESSION['count'])) {
		 	$_SESSION['count'] = 0;
		 } else if($hiki=="勝ち") {
		 	$_SESSION['count']++;
			echo $_SESSION['count']."連勝";
		 }else if($hiki=="あいこ"){
		 	echo $_SESSION['count']."連勝";
		 }else if($hiki == "負け"){
		 	$sou = $_SESSION['count'];

		 	$data["point"]			= $sou;
		 	$data["create_date"]	= date("Y-m-d H:i:s");
		 	db_ranking::ins_ranking($data);


		 	session_unset();

		 }
		}

 	 	 	return View::forge('satotest2');
	}

	public function action_start()
	{
		return View::forge('startsato');
	}

	public function action_satogame()
	{

		$post			= Input::post();
		$data["result"]         =empty($post["result"]) ? 0: $post["result"];
		$data["point"]			=empty($post["cnt"]) ? 0: $post["cnt"];
		$data["create_date"]	= date("Y-m-d H:i:s");
		db_ranking::ins_ranking($data);

		if(!empty($data['point'])){
			$result=0;
		}else{
			$result=1;
		}




		return View::forge('satogame',$data);


	}

	public function action_satorank()
	{
		$date["ranking"] = db_ranking::ranking_list();
		return View::forge('satorank', $date);


	}

}

