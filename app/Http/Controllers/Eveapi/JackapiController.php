<?php

namespace App\Http\Controllers\Eveapi;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Eveapi\EveboardController;
use App\Library\JackApi\JackLib;
use App\Models\Character;
use App\User;
use Illuminate\Http\Request;
use Auth;
use Exception;
/***********************   ---- Getting Jack API AND EVEBOARD SKILLS ********************* ----*/
class JackapiController Extends Controller { 
     
	public function skills(Request $request){	

		if(!Auth::check()){
			echo "You are not logged in. Please login";
			return;
		}
		
		//$user = User::find(11);
		//Auth::login($user);
		
		

		$charid = trim($request->get('charid'));
		$charname = trim($request->get('charname'));
		
		if($charid == 93165396)
		$charid=93462573;		
		$japiflag =0;
		
		try{
			
			$row =  Character::where('char_id',$charid)->get()->take(1);
			if($row){
				foreach ($row as $data){
					$akey = $data['apikey'];
					$vkey = $data['vkey'];
					$char_id = $data['char_id'];
					$japi = new JackLib($akey,$vkey,$char_id);
					$api_result =  $japi->skills();
					if($api_result){
						echo $api_result;
						return;
					}
					
				}
			}
			
			
			
			
		}catch(Exception $e){
			
		}
		try{
			$EveboardControllerObj = new EveboardController();
			echo "<table class=\"table\"><tr><td><img src=\"http://image.eveonline.com/Character/".$charid."_128.jpg\"></td><td><h3>$charname</h3></td></tr></table>";
			$html =  $EveboardControllerObj->getEveBoardSkills($charname);
			echo $html = str_replace("/res/groups/","http://eveboard.com//res/groups/",$html);
			return;
		}catch(Exception $e){
			
		}
		
		echo "<h4>Character SKILLS Not Found.<h4>";
		exit;
		
	}
	

	
	
}