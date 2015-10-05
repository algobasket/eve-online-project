<?php 

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Library\Characters\EveLibrary;
use App\Models\Eveapi\Characterprofile;
use Illuminate\Http\Request;
use App\User;
use App\Models\Profile;
use App\Models\Character;
use App\Models\Apikey;
use Validator;
use Auth;
use Redirect;
use Session;

class ProfileController extends Controller
{
	
	
	public function __construct(){
		$this->middleware('auth');
	}
	
	public function index(){
		//$user = User::find(11);
		//Auth::login($user);
		$formData = Auth::user();
		$id = Auth::user()->id;
		
		$profile = Profile::where("user_id",'=',$id)->first();
		
		$view_data = ['title'=>"My Profile", 'user'=>$formData,'profileData'=>$profile];
    	return view('profile/myprofile',$view_data);
	}
	
	
	public function apikeys(){
		
		$id = Auth::user()->id;
		
		$apikeys = Apikey::where("uid",'=',$id)->get();
		
		$this->checkUpdationApiKeys($id);
		
		$view_data = ['title'=>"API Keys", 'apikey'=>$apikeys];
    	return view('profile/apikeys',$view_data);
	}
	
	
	public function characters(){
		
		
		$id = Auth::user()->id;
		
		$characters  = Character::join('character_profile', function ($j) {
							$j->on('characters.char_id', '=', 'character_profile.char_id');
							      
							})
						->where('characters.uid', "=",$id)
						->get();
		
		
		$view_data = ['title'=>"My Characters", 'characters'=>$characters];
    	return view('profile/characterlist',$view_data);
	}
	
	
	public function addkeys(Request $request){
		
		$id = Auth::user()->id;
		
		$formData = $request->all();
		$rules = array(
                'akey'    => 'required|max:20',
                'vkey' => 'required|max:100'
        );
			
		$validator = Validator::make($formData, $rules);
		if($validator->fails()){			
			Session::flash('error_message', 'All fields are Required'); 
			return Redirect::to('/apikeys');
		}			
		
		$akey = trim($request->get('akey'));
		$vkey = trim($request->get('vkey'));
		$char_data  = array();
		$eveLibrary = new EveLibrary();				
		$char_data = $eveLibrary->getCharList($akey,$vkey);
		
		if(!empty($char_data['error'])){
			if(!empty($char_data['error'][0])){
				Session::flash('error_message', "The Api Key or vCode is Incorrect. ".$char_data['error'][0]);
			}else{
				Session::flash('error_message', $char_data['error']."");
			}
			return redirect('/apikeys');
		}
		
		$row_id =  Apikey::where('apikey', $akey)->where("uid","=",$id)->first();
		if(!empty($row_id)){
			$row = $row_id;
			$added = "Updated";
		}else{
			$row = new Apikey;
			$added = "Added";
		}
		$row->uid = $id;
		$row->apikey = $akey;
		$row->vkey = $vkey;
		$row->verify = 0;
		$row->save();
		
		
		$insert = $this->insertCharList($id,$char_data,$akey,$vkey);
		if($insert){
			$status = 1;
			$this->updateApiKeyVerification($id,$akey,$vkey,$status);
		}		
		
		Session::flash('success_message', "API Key is successfully $added.");
		return redirect('/apikeys');
	}
	
	
	
	private function insertCharList($uid,$data,$akey,$vkey){
		$flag = false;
		foreach($data as $char){
			$flag=true;
			$character_id = Character::where('uid', $uid)->where("char_id","=",$char['characterID'])->first();
		
			if(!empty($character_id)){
				$row = $character_id;
			}else{
				$row = new Character;
			}
			
			
			$row->char_id = $char['characterID'];
			$row->uid =$uid;
			$row->apikey = $akey;
			$row->vkey = $vkey;
			$row->status = 1;			
			$row->save();
			$this->updateCharacterProfile($uid,$char);
			
		}
		return $flag;
	}
	
	private function updateApiKeyVerification($uid,$akey,$vkey,$status){
			
			
			$api_id = Apikey::where('uid', $uid)->where("apikey","=",$akey)->where("vkey","=",$vkey)->first();
		
			if(!empty($api_id)){
				$row = $api_id;
			}else{
				$row = new Apikey;
			}
			
			$row->uid =$uid;
			$row->apikey = $akey;
			$row->vkey = $vkey;
			$row->verify = $status;
			$row->save();
	}
	
	private function checkUpdationApiKeys($id){
		
		$api_keys = Apikey::where("uid",'=',$id)->where("verify","=",0)->get();
		
		foreach ($api_keys as $APIKEY){
			
				
			$akey = $APIKEY['apikey'];
			$vkey = $APIKEY['vkey'];				
			$eveLibrary = new EveLibrary();				
			$char_data = $eveLibrary->getCharList($akey,$vkey);
			
			if(!empty($char_data['error'])){
				continue;
			}
			

			$insert = $this->insertCharList($id,$char_data,$akey,$vkey);
			if($insert){
				$status = 1;
				$this->updateApiKeyVerification($id,$akey,$vkey,$status);
			}			
			
		}
		
	}
	
	
	private function updateCharacterProfile($uid,$char){
		$character_id = Characterprofile::where('char_id', $char['characterID'])->first();
		
		if(!empty($character_id)){
			$row = $character_id;
		}else{
			$row = new Characterprofile;
		}
		
		
		$row->uid =$uid;
		$row->char_id =$char['characterID'];
		$row->username =$char['name'];
		$row->corporation =$char['corporationName'];
		$row->alliance =$char['allianceName'];
		$row->status = 1;			
		$row->save();
		
		
	}
	
	
	
}	
	
?>
    