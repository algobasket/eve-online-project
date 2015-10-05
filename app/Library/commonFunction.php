<?php 
namespace App\Library;

class commonFunction {
	
	function dbGlobalVar(){
		
		$DB['DB_HOST'] = getenv('DB_HOST');
		$DB['DB_DATABASE'] = getenv('DB_DATABASE');
		$DB['DB_USERNAME'] = getenv('DB_USERNAME');
		$DB['DB_PASSWORD'] = getenv('DB_PASSWORD');
		return $DB;
		
	}
	
	
}


?>