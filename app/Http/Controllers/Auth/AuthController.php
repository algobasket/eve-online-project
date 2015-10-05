<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Models\Profile;
use App\Models\Apikey;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;
use Auth;
use Input;
use Session;
use Redirect;
use Facebook;
use Config;
use App\Models\VkPhpSdk\Classes\Oauth2Proxy;
use App\Models\VkPhpSdk\Classes\VkPhpSdk;


class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
    
    public function out(){
    	Auth::logout();
    	return redirect("/");
    }
    
    
    public function index()
    {
	  	  
		$view_data = ['title'=>"Login"];
		$userdata = array(
			'email'  => Input::get('email'),
			'password'  => Input::get('password')
		);
		
		
		if(Auth::attempt($userdata)){			
			Session::flash('success_messsage', 'Successfully logged In');
			return redirect("/") ;
		}else{
			Session::flash('error_message', 'Username or password is incorrect'); 
		}		
        
        return view('login/login',$view_data);
    }
    
    
    public function fbcallback(){
    	
        $fb = new Facebook\Facebook([
		  'app_id' => Config::get("facebook.appId"),
		  'app_secret' => Config::get("facebook.secret")
		 ]);
        
		$jsHelper = $fb->getJavaScriptHelper();
		// @TODO This is going away soon
		$facebookClient = $fb->getClient();
		
		try {
		    $accessToken = $jsHelper->getAccessToken($facebookClient);
		} catch(Facebook\Exceptions\FacebookResponseException $e) {
		    // When Graph returns an error
		    return Redirect::to('/')->with('message', 'Graph returned an error: ' . $e->getMessage()); 
		} catch(Facebook\Exceptions\FacebookSDKException $e) {
		    // When validation fails or other local issues
		    return Redirect::to('/')->with('message', 'Facebook SDK returned an error: ' . $e->getMessage()); 
		}catch(Exception $e){
			// generic exception
			return Redirect::to('/')->with('message', 'There was an error');
		}
		
		if (!isset($accessToken)) return Redirect::to('/')->with('message', 'There was an error');
		$response = $fb->get('/me?fields=id,name,email', $accessToken);
		$me = $response->getGraphObject();
		
		$gotoProfileCompletePage = false;
	    $profile = Profile::whereUid($me['id'])->first();
	    if (empty($profile)) {
	
	        $user = new User;
	        $user->name = $me['name'];
	        $user->email = $me['email'];
	        //$user->photo_large = 'https://graph.facebook.com/'.$me['username'].'/picture?type=large';
	
	        $user->save();
	        $profile = new Profile();
	        $profile->uid = $me['id'];
	        $profile->username = $me['email'];
	        $profile->origin =  'fb';
	        $profile->access_token =  $accessToken;
	        $profile->access_token_secret =  $accessToken;
	        $profile = $user->profiles()->save($profile);
	        
	        // first time, need to complete profile 
	       	$gotoProfileCompletePage = true;
	    }
	
	    $profile->access_token = $accessToken;
	    $profile->save();
	
	    $user = $profile->user;
	
	    Auth::login($user);
		
		if($gotoProfileCompletePage){
			return redirect('/login/complete');
		}
		else{
			return redirect('/');
		}
    }
    
    
    
    
    
	/**
     * Update profile of newly registered user
     *
     * @param  Request  $request
     * @return Response
     */    
    
    public function complete(Request $request){
    	
		//$user = User::find(1);
		//Auth::login($user);
		
    	if ($request->isMethod('post')) {
			
			$formData = $request->all();
			$user = Auth::user();
			$id = Auth::user()->id;
			$profile = Profile::where("user_id",'=',$id)->first();
			
			
			
			if($profile['origin'] == "vk" && empty($user->vk_email)){
				
				$rules = array(
					'email'    => 'required|max:50|unique:users,email,'.$id,
					'name' => 'required|max:50' // password can only be alphanumeric and has to be greater than 3 characters
				);				
				$user->vk_email = $request->get('email');
			}else{
				$rules = array(
					'name' => 'required|max:50' // password can only be alphanumeric and has to be greater than 3 characters
				);
			}
			
			
            
            $validator = Validator::make($formData, $rules);
			if($validator->fails()){
				return Redirect::to('/login/complete')->withInput()->withErrors($validator);
			}
			
		    // $formData['email'] = Auth::user()->email;	    
		    // need server side validation before it goes to db 
		    
			
		    $user->name = trim($request->get('name'));
			
			$user->save();
			
			$eve_api_key = $request->get('eve_api_key');
			$eve_user_id = $request->get('eve_user_id');
			$i=0;
			foreach ($eve_user_id  as $key=>$value){
				$Apikey = new Apikey;
				if(empty($value) || empty($eve_api_key[$key])){
					continue;
				}
				$row_id =  Apikey::where('apikey', $value)->where("uid","=",$user->id)->first();
				if(!empty($row_id)){
					$row = $row_id;
				}else{
					$row = $Apikey;
				}
				$row->uid = $user->id;
				$row->apikey = $value;
				$row->vkey = $eve_api_key[$key];
				//$row->save();
				$i++;
			}		 
			
			/*if($i==0){			
				Session::flash('error_message', 'Username or password is incorrect'); 
				return redirect("/login/complete") ;
			}else{
				Session::flash('error_message', 'Username or password is incorrect'); 
			}*/	
						
		    return redirect('/')->withMessage("Profile Updated");
		}
	
		
		$formData = Auth::user();
		$id = $formData->id;
		$api_keys = User::find($id)->apikeys;
		$profile = Profile::where("user_id",'=',$id)->first();
		
    	
		$view_data = ['title'=>"Complete your profile", 'form_data'=>$formData,'apikey'=>$api_keys,'profileData'=>$profile];
    	
    	return view('login/complete',$view_data);
    }
    
	
    
    public function vkcallback()
    {
		
		// Init OAuth 2.0 proxy
		$oauth2Proxy = new Oauth2Proxy(
		    Config::get("vk.appId"), 									// client id
		    Config::get("vk.secret"), 									// client secret
		    'https://oauth.vk.com/access_token', 						// access token url
		    'https://oauth.vk.com/authorize', 							// dialog uri
		    'code', 													// response type
		    'http://' . $_SERVER['HTTP_HOST'] . '/login/vkcallback', 	// redirect url
			'offline,notify,friends,photos,audio,video,wall' 	// scope
		);
		
		// Try to authorize client
		
		if($oauth2Proxy->authorize() === true)
		{
			// Init vk.com SDK
			$vkPhpSdk = new VkPhpSdk();
			$vkPhpSdk->setAccessToken($oauth2Proxy->getAccessToken());
			$vkPhpSdk->setUserId($oauth2Proxy->getUserId());
			// API call - get profile
			$result = $vkPhpSdk->api('getProfiles', array(
				'uids' => $vkPhpSdk->getUserId(),
				'fields' => 'uid, first_name, last_name, nickname, screen_name, photo_big, email, photo',
			));
			
		}
		else{
			// handle error exception here
			die("error");
			return redirect('/');
		}

		$accessToken = $oauth2Proxy->getAccessToken();
		
		
		if(!@$result['response'][0]['uid']){
			die($result[0]['uid']);
			return redirect('/');
		}
		

		$vkUid = $result['response'][0]['uid'];
		$gotoProfileCompletePage = false;
	    $profile = Profile::whereUid($vkUid)->first();
	    if (empty($profile)) {
	
	        $user = new User;
	        $user->name = $result['response'][0]['first_name'] . ' ' . $result['response'][0]['last_name'];
	        $user->email = $result['response'][0]['screen_name'];
	        $user->photo_large = $result['response'][0]['photo_big'];
	        $user->photo_small = $result['response'][0]['photo'];
	
	        $user->save();
	        $profile = new Profile();
	        $profile->uid = $vkUid;
	        $profile->username = $result['response'][0]['screen_name'];;
	        $profile->origin =  'vk';
	        $profile->access_token =  $accessToken;
	        $profile->access_token_secret =  $accessToken;
	        $profile = $user->profiles()->save($profile);
	        
	        // first time, need to complete profile 
	       	$gotoProfileCompletePage = true;
	    }
	
	    $profile->access_token = $accessToken;
	    $profile->save();
	
	    $user = $profile->user;
	
	    Auth::login($user);
		
		if($gotoProfileCompletePage){
			return redirect('/login/complete');
		}
		else{
			return redirect('/');
		}
	

    	
    }
    
    
}
