<?php
// все проверки на валид
class  VerificationModel{
	
	public function verifacationPhone($phone){
		$phone = trim($phone);
		$phone2 = strip_tags($phone);
		if($phone2 == $phone){
			preg_match("/((8|\+7)-?)?\(?\d{3,5}\)?-?\d{1}-?\d{1}-?\d{1}-?\d{1}-?\d{1}((-?\d{1})?-?\d{1})?/", $phone2, $verifPhone);
			if(strlen($verifPhone[0])!==16 && strlen($verifPhone[0])<11){
				$error = "Не соответствует номеру телефона";
			}else{
				return $verifPhone[0];
			}
		}else{
			$error = "Лишние символы в номере телефона";
		}
		return $error;
	}
	
	public function verifacationInt($int){ // int = integer = ЦЕЛОчисленное значение
		$int = trim($int);
		$int2 = strip_tags($int);
		if($int2 == $int){
			if(is_int($int2) && is_int($int2)>0){ // numeric = ЛЮБОЕ число.
				return $int2;
			}
		}
		return false;
	}
	public function verifacationPassword($password){
		$password = trim($password);
		$password = strip_tags($password);
		if(is_string($password)){
				return $password;
			}else{
				return false;
			}
	}
	public function verifacationEmail($email){
		$email = trim($email);
		$email = strip_tags($email);
		preg_match("/[^(\w)|(\@)|(\.)|(\-)]/", $email, $verifEmail);
			if($verifEmail == 0){
				$error = "Некорректный емайл";
			}else{
				return $verifEmail[0];
			}
		return $error;
	}
	public function verifacationLogin($string){
		$string = trim($string);
		$string = strip_tags($string);
			if(is_string($string)){
				return $string;
			}else{
				return false;
			}
	}
}