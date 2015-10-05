<?php 

namespace App\Library\Characters;
use SimpleXMLElement;

/*---------------Getting Character List From EVEAPI -----------------------*/

class EveLibrary{
	
	public function getCharList($keyID,$vCode){
		$url = "https://api.eveonline.com/account/Characters.xml.aspx?keyID=$keyID&vCode=$vCode";
		$xml = $this->getCurlRequest($url);
		
		
		if(!empty($xml)){
			$data = array();
			if($xml->error){
				 $data['error'] = $xml->error;
			}else{//if(!empty($xml->result->rowset->row)){			
				foreach($xml->result->rowset->row as $row){
					
					$data[] = $row->attributes();
					
				}
			}
			
		}else{
			$data['error'] = "Characters Detail Not Found.";
		}
		
		return $data;
		
	}
	
   
    private function getCurlRequest($url){
       
       
        $ch = curl_init($url);
       
        $curlConfig = array (
            CURLOPT_URL            => $url,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false
        );
       
        curl_setopt_array($ch, $curlConfig);
       
        $curl_data = curl_exec($ch);       
       
        curl_close($ch);
        return new SimpleXMLElement($curl_data);
       
    }
	
	
	
}