<?php

class Controller_Satotest extends Controller
{

	public function action_index()
	{

		$post			= Input::post();
		$view["a"]	= empty($post["a"]) ? "": $post["a"];
		$view["b"]	= empty($post["b"]) ? "": $post["b"];
		$view["swi"]	= empty($post["swi"]) ? "": $post["swi"];
		$view['ans'] = "";
// 		$view["a"]	= empty($post["a"]) ? "": $post["a"];
// 		$view["a"]	= empty($post["a"]) ? "": $post["a"];
// 		$view["a"]	= empty($post["a"]) ? "": $post["a"];
// 		$view['a']=$_POST["a"];
// 		$view['b']=$_POST["b"];
// 		$view['swi']=$_POST["swi"];

		if(empty($view["a"]) && empty($view["b"])){
			echo "未記入があります";
		}else{
			print "swi = ".$view["swi"];
			switch ($view["swi"]) {
			case "":
				$view['ans'] = $view["a"] + $view["b"];
				break;

			case "1":
				$view['ans'] = $view["a"] - $view["b"];
				break;

			case "2":
				$view['ans'] = $view["a"] * $view["b"];
				break;

			case "3":
				$view['ans'] = $view["a"] / $view["b"];
				break;

			default:
				break;
			}

		}
		return View::forge('satotest',$view);


	}

	public function action_tes()
	{
		$type = array("+","-","*","/");
		foreach($type as $val){
			if($_POST['swi'] == $val){
				$selected = "selected";
			}else{
				$selected = "";
			}
			echo '<option value="'.$val.'" '.$selected.'>'.$val.'</option>';
		}

	}


	}

