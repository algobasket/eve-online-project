<?php 

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Auth;
use Input;
use Validator;
use Redirect;
use Carbon\Carbon;
use App\Models\Eveapi\Eveapi;
use App\Models\Eveapi\Evebid;
use App\Models\Character;


class CharactersaleController Extends Controller {
	
    protected $title;
	
	function index(){	
		$search = trim(Input::get('search'));
		$data_table = 	Eveapi::join('bid_posts', function ($j) {
							$j->on('bid_details.id', '=', 'bid_posts.bid_id')
							->where('bid_posts.post_rank',"=",1);      
							})
						->where(function($query) use ($search){
							if (!empty($search)) {
								$query->where('bid_posts.wall_post',"LIKE" ,"%$search%");
								$query->orWhere('bid_details.maintitle',"LIKE" ,"%$search%");
								$query->orWhere('bid_details.pilotname',"LIKE" ,"%$search%");
							}
						})
						->orderBy('bid_details.lastpost_time', 'desc')->where('bid_details.status',0)		
						->select( '*','bid_details.id as id1','bid_posts.id as id2')
						->paginate(10);

		$view_data = ["title"=>"Bazaar","content"=>$data_table];
		
		return view('charactersale/bids',$view_data);
	}
	
	
	function bidpost($tid){ /**-------For bid post Detail -------**/
		if(!Auth::check()){
			return Redirect::to('/login');
		}
		$threaddetail = Eveapi::where('id', $tid)->get();
		
		$first_post = Evebid::where('bid_id', $tid)->where('post_rank',"=", 1)->get();
		
		$all_posts = Evebid::where('bid_id', $tid)->orderBy('post_rank', 'asc')->paginate(10);
		
		$last_three_posts = Evebid::where('bid_id', $tid)->orderBy('post_rank', 'desc')->take(3)->get();
		
		
		 $top_bid = $this->getHighestBids($tid);
		
		$view_data = ["title"=>"Bazaar","content"=>$all_posts,"threaddetail"=>$threaddetail,"firstpost"=>$first_post,"last_three_posts"=>$last_three_posts,"top_bid"=>$top_bid];

		return view('charactersale/bidpost',$view_data);
	}
	/* --------------------- sellNow Following method Will be Used to Start New Auction ---------*/
	function sellNow(Request $request){ 
		
		if(!Auth::check()){
			return Redirect::to('/login');
		}
		if ($request->isMethod('post')) {			
			
			$rules = array(
				'inc_value'    => 'required|numeric',
				'char_detail' => 'required',
				'title' => 'required',
				'charname' => 'required', 
				'charid' => 'required' 
			);	
			
			$formData = $request->all();
			$validator = Validator::make($formData, $rules);
			if($validator->fails()){
				return Redirect::to('/mycharacters')->withInput()->withErrors($validator);
			}
			
			$title = trim($request->get('title'));
			$char_detail = trim($request->get('char_detail'));
			$charid = trim($request->get('charid'));
			$inc_value = trim($request->get('inc_value'));
			$charname = trim($request->get('charname'));
			
			
			$id = Auth::user()->id;			
			
			$characters  = Character::where('uid', "=",$id)->where('char_id','=',$charid)->first();
			//$characters  = Character::where('uid', "=",$id)->where('char_id','=',$charid)->get()->take(1);
			//$charObj = $characters;
			foreach($characters as $char_dt){
				if($char_dt['sell_status'] != 0) 
				return Redirect::to('/bazaar');
			}
			
			$row_count = $characters->count();
			
			
			
			if(!empty($characters)){
				$auction = new Eveapi;
				
				//$auction->uid = $id;
				//$auction->char_id = $charid;
				$auction->maintitle = $title;
				$auction->pilotname = $charname;
				$auction->lastpost_time = Carbon::now();
				$auction->update_status = 1;
				$auction->page = 1;
				$auction->status = 0;
				
				$auction->save();
				
				$last_inserid = $auction->id;
				
				$post_thread = new Evebid;
				$post_thread->bid_id = $last_inserid;
				$post_thread->char_id = $charid;
				$post_thread->post_rank = 1;
				$post_thread->post_time = Carbon::now();
				$post_thread->update_time = Carbon::now();
				$post_thread->wall_post = $char_detail;
				$post_thread->profile_link = $charid."_128.jpg";
				$post_thread->username = $charname;
				$post_thread->bid_amount = $inc_value;
				$post_thread->save();
				$characters->sell_status = 1;
				$characters->save();
				
				
			}
			
			
			
			
			return Redirect::to('/bazaar');
			
		}
			
	}
	
	
	function bidNow(Request $request){ 
		
		if(!Auth::check()){
			return Redirect::to('/login');
		}
		if ($request->isMethod('post')) {			
			
			$rules = array(
				'bid_am'    => 'required|numeric',
				'post_message' => 'required'
			);
			
			$id = Auth::user()->id;
			$characters  = Character::join('character_profile', function ($j) {
							$j->on('characters.char_id', '=', 'character_profile.char_id');
							//->where('bid_posts.post_rank',"=",1);      
							})->where('characters.uid', "=",$id)->where('characters.status','=',1)
							->orderBy('characters.id','asc')->get()->take(1);
			foreach($characters as $char){
				$charname = $char['username'];
				$charid = $char['char_id'];				
			}

			$post_message = trim($request->get('post_message'));
			$bid_am = trim($request->get('bid_am'));		
			$bid_id = trim($request->get('bid_id'));		
			
			$bid_post_detail =  Evebid::where('bid_id', $bid_id)->orderBy('post_rank', 'desc')->take(1)->get();
			
			foreach($bid_post_detail as $dt){
				$post_rank = $dt['post_rank'];
			}
			
			
			$bid_detail =  Eveapi::where('id', $bid_id)->first();
			
			if(!empty($bid_detail)){
				$bid_detail->topicreplies = $bid_detail['topicreplies'] + 1;
				$bid_detail->save();
			}
			
			
			$post_thread = new Evebid;
			$post_thread->bid_id = $bid_id;
			$post_thread->char_id = $charid;
			$post_thread->post_rank = $post_rank+1;
			$post_thread->post_time = Carbon::now();
			$post_thread->update_time = Carbon::now();
			$post_thread->wall_post = $post_message;
			$post_thread->profile_link = $charid."_128.jpg";
			$post_thread->username = $charname;
			$post_thread->bid_amount = $bid_am;
			$post_thread->save();
			
			return Redirect::to('bazaar/'.$bid_id);
		}
	}
	
	public function getHighestBids($tid){/**-------Get Highest Bid -------**/
		
		$top_three_bids = Evebid::where('bid_id', $tid)->where('post_rank',"!=", 1)->orderBy('bid_amount', 'desc')->take(3)->get();
		$top_bid = array();
		foreach($top_three_bids as $top_bids){
			$top_bid[] = $top_bids['bid_amount'];
		}		
		return $top_bid;
		
	}/**-------Get Highest End -------**/
	
}