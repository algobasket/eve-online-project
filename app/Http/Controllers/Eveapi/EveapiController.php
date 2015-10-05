<?php 

namespace App\Http\Controllers\Eveapi;
use App\Http\Controllers\Controller;
use App\Models\Eveapi\Eveapi;
use App\Models\Eveapi\Evebid;
use Redirect;
class EveapiController Extends Controller {
	 

	protected $layout = 'layouts/master';
    protected $title;
	
	public function __construct(){
		$this->layout = view($this->layout);
    }
	 
	
	public function index($pid){
		//EveapiController
		
		if($pid >= 25){
			echo "Updation Completed";
			exit;
		}
		$url = "https://forums.eveonline.com/default.aspx?g=topics&f=277&p=$pid";
		$data = $this->getEveCurl($url);
		
		$lineschar = array("\t","\n","\r","\x20\x20","\0","\x0B");
		$mainpage = str_replace($lineschar, "", html_entity_decode($data));
		$mainpage=str_replace("<br />","<br>",$mainpage);
		
		
		preg_match_all("{<table class=\"content topics\" width=\"100%\">(.*?)</table>}",$mainpage,$all_table,PREG_SET_ORDER);

		preg_match_all("{<tr class=\"(topicRow post|topicRow_Alt post_alt)\">(.*?)</tr>}",$all_table[0][1],$data_row,PREG_SET_ORDER);
			
		$count = 1;
		if(count($data_row)>0){
			for($i=0;$i<count($data_row);$i++)
			{
				
				preg_match_all("{<td class=(.*?)\">(.*?)</td>}",$data_row[$i][0],$data_col,PREG_SET_ORDER);
				
				$post_detail = array();
				
				
				if(count($data_col) > 0){
					preg_match_all("{<a href=\"(.*?)\" class=\"(.*?)\">(.*?)</a>}",$data_col[0][2],$data_title,PREG_SET_ORDER);
					preg_match_all("{<a title=\"(.*?)\" href=\"(.*?)\">(.*?)</a>}",$data_col[1][2],$data_profile,PREG_SET_ORDER);
					$title_url = $data_title[0][1];
					$pattern1 = '/t=[0-9]*/';
					preg_match($pattern1, $title_url, $matches_thread);
					
					$time_last_post = $data_col[5][2];
					$time_array = explode("<br>",$time_last_post);					
					$post_detail['maintitle'] = $data_title[0][3];
					$post_detail['topicreplies'] = $data_col[2][2];
					$post_detail['topicviews'] = $data_col[3][2];
					$post_detail['topiclikes'] = $data_col[4][2];
					$post_detail['threadid'] = trim(str_replace("t=","",$matches_thread[0]));
					//echo "<pre>";
					//print_r($data_profile);
					//continue;
					
					if(isset($data_profile[0][3])){
					$post_detail['pilotname'] =  trim($data_profile[0][3]);
					}else{
						$post_detail['pilotname'] ="";
					}
					$post_detail['lastpost_time'] =  trim($time_array[0]);
					$this->insert_detail($post_detail);
				}else{
				echo "Col Detail Not Found";
			}
				//print_r($post_detail);
				//print_r($data_col);
			}
		}else{
			echo "Row Detail Not Found";
		}
		
		$pid++;
		$view_data = ["pid"=>$pid];
		return view('eveapi/eveapi',$view_data);
	}
	
	public function getEveCurl($url,$data=""){
		
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
	
	public function insert_detail($post_detail){
		$Eveapi = new Eveapi;
		$date1 =  $post_detail['lastpost_time'];
		$date = str_replace('.', '-', $date1);
		//echo strtotime($date1);
		//echo date('Y-m-d',strtotime($post_detail['lastpost_time']));
		$tid = Eveapi::where('threadid', $post_detail['threadid'])->pluck('id');
		if(empty($post_detail )){
			return false;
		}
		
		if(!empty($tid)){
			echo "<br>";
			$row = $Eveapi->find($tid);
			if($row->lastpost_time == date('Y-m-d H:i:s',strtotime($date))){
				echo "Already Updated";
				$row->topicreplies = $post_detail['topicreplies'];
				$row->topiclikes = $post_detail['topiclikes'];
				$row->topicviews = $post_detail['topicviews'];
				$save = $row->save();			
				return $save;
				
			}
			echo "<br>";
			echo $tid." updated with ".$date;
			$row->lastpost_time = date('Y-m-d H:i:s',strtotime($date));
			$row->update_status = 0;
			$save = $row->save();			
			return $save;
		}
		
		
        $Eveapi->maintitle = $post_detail['maintitle'];
        $Eveapi->threadid = $post_detail['threadid'];
        $Eveapi->pilotname = $post_detail['pilotname'];
        $Eveapi->topicreplies = $post_detail['topicreplies'];
        $Eveapi->topiclikes = $post_detail['topiclikes'];
        $Eveapi->topicviews = $post_detail['topicviews'];
        $Eveapi->lastpost_time = date('Y-m-d H:i:s',strtotime($date));
		echo "<br>";
		echo "Inserted";
        $save_Eveapi = $Eveapi->save();
		return $save_Eveapi;
		
	}
	
	
	public function posts(){
		
		$thread1 = $this->getThread();
		foreach($thread1 as $t){
			echo $thread = $t->threadid;
			$pid = $t->page;
			$bid_id = $t->id;
		}
		if(empty($thread)){
			echo "Completed";
			exit;
		}
		
		if($pid == 0){
			$pid =1;
		}
		echo $url = "https://forums.eveonline.com/default.aspx?g=posts&t=$thread&p=$pid";
		$data = $this->getEveCurl($url);
		
		$mainlines = array("\t","\n","\r","\x20\x20","\0","\x0B");
		$mainpage = str_replace($mainlines, "", html_entity_decode($data));
		$mainpage=str_replace("<br />","<br>",$mainpage);
			
		preg_match_all("{<table class=\"(content postContainer|content postContainer_Alt)\" width=\"100%\">(.*?)</table>}",$mainpage,$data_table,PREG_SET_ORDER);
		//echo count($data_table);
		if(count($data_table)>0){
			for($i=0;$i<count($data_table);$i++)
			{
		
		
		$main_table_data = $data_table[$i][2];
		
		
		// Profile Image
		//preg_match_all("{<div class=\"userbox\" (.*?)>(.*?)</a></div>}",$main_table_data,$data_profile,PREG_SET_ORDER);
		//var_dump($data_profile);
		//exit;
		
		
		
		preg_match_all("{<img class=\"avatarimage lazy\" src=\"(.*?)\" alt=\"\" />}",$main_table_data,$profile_mage,PREG_SET_ORDER);	
		
		//For User name
		preg_match_all("{<a href=\"(.*?)\" title=\"(.*?)\" onclick=\"(.*?)\" class=\"box\">(.*?)</a>}",$main_table_data,$user_name,PREG_SET_ORDER);
		if(!empty($user_name))	{
			$username  = $user_name[0][4];
		}else{
			$username  = "";
		}
		
		
		//exit;
		
		//Post Rank and Post Time
		preg_match_all("{<div class=\"date\">(.*?)</div>}",$main_table_data,$data_post_detail,PREG_SET_ORDER);	
		preg_match_all("{<a href='(.*?)'>#(.*?)</a>}",$data_post_detail[0][1],$data_post_rank,PREG_SET_ORDER);
		preg_match_all("{<span class=\"posted\" title=\"\" data-time=\"(.*?)\"> -(.*?) UTC</span>}",$data_post_detail[0][1],$data_post_time,PREG_SET_ORDER);
		
		// Post  Detail 
		preg_match_all("{<div class=\"postdiv\" >(.*?)</div>}",$main_table_data,$post_data,PREG_SET_ORDER);	
		preg_match_all("{<div id=\"(.*?)\" style=\"display:block\"><div id=\"(.*?)\">(.*?)</div>}",$post_data[0][0],$post_found ,PREG_SET_ORDER);
	
		
		if(isset($data_post_rank)){
		
			$pattern1 = '/m=[0-9]*/';
			preg_match($pattern1, $data_post_rank[0][1], $matches_post);
			$post_id = trim(str_replace("m=","",$matches_post[0]));
			$post_rank = $data_post_rank[0][2];
		}
		if(isset($data_post_time)){
			
			
			$post_time = $data_post_time[0][2];
		}
		
		if(isset($post_found)){
			$wall_post = $post_found[0][3];
		}
		if(isset($profile_mage)){			
			$profile_link1 = $profile_mage[0][1];			
			$prlink_start = strrpos($profile_link1,"/");					
			$profile_link = substr($profile_link1,$prlink_start+1);
			$profile_link = trim($profile_link);
			$char_id_pos = strpos($profile_link,"_");
			$char_id = substr($profile_link,0,$char_id_pos);
		
		}else{
			$profile_link ="";
		}
		
		$post_detail['threadid'] = $thread;
		$post_detail['bid_id'] = $bid_id;
		$post_detail['post_id'] = $post_id;
		$post_detail['post_rank'] = $post_rank;
		$post_detail['post_time'] = $post_time;
		$post_detail['wall_post'] = $wall_post;
		$post_detail['profile_link'] = $profile_link;
		$post_detail['username'] = $username;
		$post_detail['char_id'] = $char_id;
		//print_r($post_detail);
		$this->insert_posts($post_detail);
		
		
			}
			
			
			if(count($data_table) == 20){
				$this->updateThreadPost($thread,0,$pid+1);
			}elseif(count($data_table) < 20){
				$this->updateThreadPost($thread,1,$pid);
			}
			
		}else{
			$this->updateThreadPost($thread,1,$pid);
			echo "No Record Found";
		}
		
		return view('eveapi/eveposts');
		
	}
	
	
	public function insert_posts($post_detail){
			$Evebidpost = new Evebid;
			$date1 =  $post_detail['post_time'];
			$date = str_replace('.', '-', $date1);
			$post_id = $Evebidpost->where('post_id', $post_detail['post_id'])->pluck('id');
			if(empty($post_detail )){
				return false;
			}
			
			if(!empty($post_id)){
				echo "<br>";
				$row = $Evebidpost->find($post_id);
				if($row->lastpost_time == date('Y-m-d H:i:s',strtotime($date))){
					echo "Already Updated";
					return true;
				}
				return;
			}
			
			
			
			$Evebidpost->threadid = $post_detail['threadid'];
			$Evebidpost->post_id = trim(strip_tags($post_detail['post_id']));
			$Evebidpost->bid_id = trim(strip_tags($post_detail['bid_id']));
			$Evebidpost->char_id = trim(strip_tags($post_detail['char_id']));
			$Evebidpost->post_rank = trim(strip_tags($post_detail['post_rank']));
			$Evebidpost->post_time = trim(strip_tags($post_detail['post_time']));
			$Evebidpost->profile_link = trim(strip_tags($post_detail['profile_link']));
			$Evebidpost->username = trim(strip_tags($post_detail['username']));
			$Evebidpost->wall_post = trim($post_detail['wall_post']);
			$Evebidpost->update_time = date('Y-m-d H:i:s');
			echo "<br>";
			echo "Inserted";
			$save_Eveapi = $Evebidpost->save();
			return $save_Eveapi;
		}
	
	
	
	
	public function getThread(){
		$Eveapi = new Eveapi;
		$tid = $Eveapi->where('update_status', 0)->orderBy('lastpost_time', 'desc')->take(1)->get();
		return $tid;
	}
	
	
	public function updateThreadPost($tid,$status,$page){
		$Eveapi = new Eveapi;
		$Eveapi->where('threadid', $tid)->update(array('update_status' => $status,"page"=>$page));
		return $tid;
	}
	
	
	
	/*
		Route::get('/eveapi/{pid}', 'EveapiController@index');
		Route::get('/posts/', 'EveapiController@posts');
	*/
	
	
}

/*

$content = file_get_contents("http://example.com/image.jpg");


//Store in the filesystem.
$fp = fopen("/location/to/save/image.jpg", "w");
fwrite($fp, $content);
fclose($fp);
*/