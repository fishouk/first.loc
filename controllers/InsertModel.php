<?php
class InsertModel extends DbModel{

	public function __construct(){
		parent::__construct();
	}
	// Переписать функицию. Чтобы она добавляла нового пользователя в базу
	public function insert_registration($phone,$email,$password,$organiz,$adressat){
		$time=time();
		$query = "INSERT INTO `plut_registration`(`addressee`, `organization`, `id_tbl_autoriz`, `date_reg`, `phone_1`, `phone_2`, `phone_3`, `phone_4`, `email`, `skype`) VALUES ('{$adressat}', '{$organiz}', '0', '{$time}','{$phone}','0','0','0','{$email}', '0')";
		$res = parent::mysql_query_str($query);
		
		// $hash = md5($phone.$email);
		// $password = md5($password);
		return true;
	}
	// UPD. Переписать функцию. Чтобы она обновляла дату последней авторизации
	public function update_user_vize(){
		$time=time(); // 
		$query_update="UPDATE `plut_authorisation` SET `role`='{$_SESSION[user][role]}' WHERE `id_reg`='{$_SESSION[user][id_reg]}'";
		$res = parent::mysql_query_str($query_update);
		if($res == false){
			return false;
		}
		return true;
	}
	public function update_mail_validation($id,$hash){
		$query_update="UPDATE `plut_authorisation` SET `validity_email`=1 WHERE `id`='{$id}' AND `hash`='{$hash}'";
		$res = parent::mysql_query_str($query_update);
		if($res == false){
			return false;
		}
		return true;
	}
	public function __destruct(){
		parent::__destruct();
	}
}