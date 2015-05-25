<?php
// все проверки на валид
class MickModel{
	
	public function valid_phone_edit($phone){
		$phone = trim($phone);
		$phone1=strip_tags($phone);
		if($phone1 == $phone){
			preg_match("#[0-9-+]{16}#", $phone, $arr);
			if(strlen($arr[0])!==16){
				$error = "Не соответствует номеру телефона";
			}else{
				return $arr[0];
			}
		}else{
			$error = "Лишние символы в номере телефона";
		}
		return $error;
	}
	
	public function valid_int($int){ // int = integer = ЦЕЛОчисленное значение
		$int = trim($int);
		$int1=strip_tags($int);
		if($int1 == $int){
			if(is_numeric($int1)){ // numeric = ЛЮБОЕ число.
				return $int1;
			}
		}
		return false;
	}
	public function valid_password($password){
		$password=trim($password);
		$password=strip_tags($password);
		if(strlen($password)<3){
				$error = "Ваш пароль меньше 3 символов";
		}else{
			return $password;
		}
			return $error;
	}
	public function valid_email($email){
		$email = trim($email);
		$email=strip_tags($email);
			$p = preg_match("#[а-яА-Яa-zA-Z0-9_-]{3,64}@[а-яА-Яa-zA-Z0-9_-]{2,32}\.[а-яА-Яa-zA-Z]{2,5}#", $email, $arr);
			// var_dump($arr); exit;
			if($p == 0){
				$error = "Некорректный емайл";
			}else{
				return $arr[0];
			}
		return $error;
	}
	public function valid_string($string){
		$string = trim($string);
		$string=strip_tags($string);
			if(is_string($string)){
				return $string;
			}else{
				return false;
			}
	}
}