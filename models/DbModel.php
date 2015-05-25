<?php
class DbModel{	
	
	//Вставить нужное
	
	const HOST = 'localhost';
	const USER = 'root';
	const PASS = '';
	const DB = 'uport_gssr';
	
	protected $connect;
	
	//Соединяемся с базой данных
	public function __construct(){
		$this->connect = @mysql_connect(self::HOST, self::USER, self::PASS);
		if (!$this->connect) {
			$this->connect = @mysql_connect('localhost','root','') or die('Ошибка соединения с MySQL');
		}
		if(!@mysql_select_db(self::DB,$this->connect)){
			@mysql_select_db('uport_gssr', $this->connect) or die('Ошибка соединения с базой данных.');
		}
		@mysql_query("set names 'utf8'");
	}
	//Обращяемся к базе и переводим результат запроса в ассоциативный массив. В $string SQL запрос к бд.
	public function mysql_query_str($string){
		$row = mysql_query($string);
		if($row){
			return $row;
		}else{
			return false;
		}
	}
	
	//ID последнего INSERT
	public function mysql_query_id(){
		return mysql_insert_id($this->connect);
	}
	//Переводим результат запроса в много мерный массив в $ress результат запроса
	public function mysql_query_many_dimensional($ress){
		if($ress){
			$result=array();
			for($i=0; $e=mysql_fetch_array($ress, MYSQL_ASSOC);$i++){
				$result[$i] = $e;
			}
			return $result;
		}else{
			return FALSE;
		}
	}
	//Закрываем соединение с базой данных
	public function __destruct(){
		mysql_close($this->connect);
	}

}