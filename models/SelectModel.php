<?php
class SelectModel extends DbModel{

	public function __construct(){
		parent::__construct();
	}
	public function authorization($login, $password){
		$query = "SELECT 
						* 
				  FROM 
				  		`accounts` 
				  WHERE 
				  		`login` = '{$login}' 
					  AND 
					  	`password` = '{$password}'
				";
		$res = parent::mysql_query_str($query);
		$account = parent::mysql_query_many_dimensional($res);
		if($account == false){
			return false;
		}else{
			return $account;
		}
	}
	public function __destruct(){
		parent::__destruct();
	}
}