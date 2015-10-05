<?php 

namespace App\Http\Controllers\Eveapi;
use App\Http\Controllers\Controller;
use App\Models\Eveapi\Characterprofile;
/*------------- Character Detail -------------*/
class EveboardController Extends Controller {
	 

	public function index($username){

		
		$username = urldecode(trim($username));
		$username1 = str_replace(" ","_",$username);
		$character_detail = Characterprofile::where('username', $username)->get();
		$count = $character_detail->count();
		$message ="";
		if( $count == 0 ){
			$message = $this->getCharacterProfileApi($username1);
			$character_detail = Characterprofile::where('username', $username)->get();			
		}
		
		$view_data =["char_detail"=>$character_detail,"message"=>$message];
		
		return view('eveapi/character_profile',$view_data);		
	}
	
	public function getCharacterProfileApi($username1){
		$url = "http://eveboard.com/pilot/$username1";
		
		$username = trim(str_replace("_"," ",$username1));
		
		$data = $this->getEveBoardCurl($url);
		
		$profile_detail = array();
		$lineschar = array("\t","\n","\r","\x20\x20","\0","\x0B");
		$homepage = str_replace($lineschar, "", html_entity_decode($data));
		$homepage=str_replace("<br />","<br>",$homepage);
		
		
		
		$access_string = "The access to this character is restricted, please enter the password to continue";
		
		$password_protected_pos = strpos($homepage,$access_string);
		
		if($password_protected_pos !== false){
			$post_detail['username'] = $username;
			$post_detail['is_protected'] = 1;
			$this->insertProfileDetail($post_detail);
			return "The Character Information is Protected";
		}
		
		
		//get table For Login Detail From EVEBOARD
		preg_match_all("{<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">(.*?)</table>}",$homepage,$all_table,PREG_SET_ORDER);
		
		if(empty($all_table)){
			//echo "Error:No Record Found";
			return;
		}
		//Get Row of Login Detail 
		preg_match_all("{<tr>(.*?)</tr>}",$all_table[0][0],$data_row,PREG_SET_ORDER);	
			
			
		$count = 1;
		if(count($data_row)>0){
			
			for($i=0;$i<1;$i++){
				
				//Profile Image
				preg_match_all("{<img src=\"(.*?)\" (.*?)>}",$data_row[0][0],$profile_image,PREG_SET_ORDER);
				
				
				if(!empty($profile_image)){
					
					$profile_link1 = $profile_image[0][1];			
					$prlink_start = strrpos($profile_link1,"/");					
					$profile_link = substr($profile_link1,$prlink_start+1);
					$profile_detail['profile_link'] = trim($profile_link);
					$char_id_pos = strpos($profile_detail['profile_link'],"_");
					$profile_detail['char_id'] = substr($profile_detail['profile_link'],0,$char_id_pos);
					
				}				
				
				if(!empty($data_row[1][1])){
					preg_match_all("{Character updated (.*?) ago}",$data_row[1][1],$last_update_character,PREG_SET_ORDER);
					$profile_detail['last_update_character'] = $last_update_character[0][1];
				}else{
					$profile_detail['last_update_character']="";
				}
				//sheet_viewd
				if(!empty($data_row[2][1])){				
					preg_match_all("{Sheet viewed (.*?) time}",$data_row[2][1],$sheet_viewd,PREG_SET_ORDER);
					$profile_detail['sheet_viewd'] = trim($sheet_viewd[0][1]);				
				}else{
					$profile_detail['sheet_viewd']="";
				}				
				
				//login_details
				if(!empty($data_row[4][1])){				
					preg_match_all("{<td (.*?)>(.*?)</td>}",$data_row[4][1],$login_details,PREG_SET_ORDER);
					$profile_detail['login_details'] = trim($login_details[1][2]);				
				}else{
					$profile_detail['login_details']="";
				}
				//daily_average
				if(!empty($data_row[5][1])){				
					preg_match_all("{<td (.*?)>(.*?)</td>}",$data_row[5][1],$daily_average,PREG_SET_ORDER);
					$profile_detail['daily_average'] = trim($daily_average[1][2]);				
				}else{
					$profile_detail['daily_average']=0;
				}
			
				
				//login_count
				if(!empty($data_row[6][1])){				
					preg_match_all("{<td (.*?)>(.*?)</td>}",$data_row[6][1],$login_count,PREG_SET_ORDER);
					$profile_detail['login_count'] = trim($login_count[1][2]);				
				}else{
					$profile_detail['login_count']=0;
				}
				
			}
			
		}
		
		preg_match_all("{<table width=\"460\" (.*?)>(.*?)</table>}",$homepage,$skill_data,PREG_SET_ORDER);
		if(count($skill_data>0)){
			if(!empty($skill_data[0][2])){
				preg_match_all("{<tr>(.*?)</tr>}",$skill_data[0][2],$skill_row,PREG_SET_ORDER);
					
				
				if(count($skill_row)>0){
					$skill_table = array();
					
					for($j=1;$j<count($skill_row);$j++){
						
						preg_match_all("{<td (.*?)>(.*?)</td>}",$skill_row[$j][1],$data_col,PREG_SET_ORDER);
						
						for($k = 0; $k<1;$k++){
							
							$ctitle = trim(strip_tags($data_col[$k][2]));					
							$cvalue = trim(strip_tags($data_col[$k+1][2]));					
							$skill_table[$ctitle] = $cvalue;
							
							$ctitle1 = trim(strip_tags($data_col[$k+2][2]));					
							$cvalue1 = trim(strip_tags($data_col[$k+3][2]));					
							$skill_table[$ctitle1] = $cvalue1;
							
						}
					}
				}
			}else{
				
				return "Cannot get Character Detail";
			}
		}else{
			return "Cannot get Character Detail";
		}
		$char_rba = explode("/",$skill_table['R / B / A']);
		
		$profile_detail['r_character'] = $char_rba[0];
		$profile_detail['b_character'] = $char_rba[1];
		$profile_detail['a_character'] = $char_rba[2];	
		
		$profile_detail['corporation'] = trim($skill_table['Corporation']);
		
		$profile_detail['intelligence'] = trim($skill_table['Intelligence']);
		
		$profile_detail['alliance'] = trim($skill_table['Alliance']);
		
		$profile_detail['perception'] = trim($skill_table['Perception']);
		
		$profile_detail['dob'] = trim($skill_table['Date of Birth']);
		
		$profile_detail['charisma'] = trim($skill_table['Charisma']);
		
		$profile_detail['skillpoints'] = trim($skill_table['Skill points']);
		
		$profile_detail['memory'] = trim($skill_table['Memory']);
		
		$profile_detail['isk'] = trim($skill_table['ISK']);
		
		$profile_detail['avg_speed'] = trim($skill_table['Avg. SP/hour']);
		
		$profile_detail['clone'] = trim($skill_table['Clone']);
		
		$profile_detail['unallocated'] = trim($skill_table['Unallocated']);
		
		$profile_detail['security_status'] = trim($skill_table['Security Status']);
		
		$profile_detail['remaps'] = trim($skill_table['Remaps']);
		
		$profile_detail['willpower'] = trim($skill_table['Willpower']);		
		
		$profile_detail['username'] = trim($username);	
		
		$profile_detail['uid'] = 0;		
		
		if($profile_detail['isk'] == "Hidden"){
			$profile_detail['isk'] = -1.00;//if isk is -1.0 then the ISK is hidden
		}
		
		$profile_detail['security_status'] = trim(substr($profile_detail['security_status'],0,4));
		
		
		$this->insertProfileDetail($profile_detail);
		
		
		
		
		
		
	}
	
	public function getEveBoardCurl($url,$data=""){
		
		$ch = curl_init($url);
		
		$curlConfig = array(
			CURLOPT_URL            => $url,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_SSL_VERIFYPEER => false
			
		);
		
		curl_setopt_array($ch, $curlConfig);
		
		$curl_data = curl_exec($ch);		
		
		curl_close($ch);
		
		return $curl_data;
	}
	
	public function insertProfileDetail($post_detail){
		
		$Characterprofile = new Characterprofile;
		$character_id = Characterprofile::where('username', $post_detail['username'])->first();
		
			if(!empty($character_id)){
				$row = $character_id;
			}else{
				$row = $Characterprofile;
			}
			
			foreach($post_detail as $key=>$value){
				$row->$key = $value;
			}
		
        return $row->save();
		
	}
	
	public function getEveBoardSkills($username){
		
		$username = urldecode(trim($username));
		$username1 = str_replace(" ","_",$username);
		
		$url = "http://eveboard.com/pilot/$username1";
		
		$username = trim(str_replace("_"," ",$username1));
		
		$data = $this->getEveBoardCurl($url);
		
		$skills = array();
		$lineschar = array("\t","\n","\r","\x20\x20","\0","\x0B");
		$homepage = str_replace($lineschar, "", html_entity_decode($data));
		$homepage=str_replace("<br />","<br>",$homepage);
		//echo "123";
		//<table width="100%" border="0" cellpadding="0" cellspacing="0">
		
		preg_match_all("{<table width=\"98%\" border=\"0\" cellpadding=\"2\" cellspacing=\"2\">(.*?)</table></td></tr></table>}",$homepage,$all_table,PREG_SET_ORDER);
		//preg_match_all("{<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">(.*?)</table>}",$homepage,$all_table,PREG_SET_ORDER);
		
	//	echo "<pre>";
//print_r($all_table);
		return $all_table[0][0];
		//return;
				
	}
	
	
}