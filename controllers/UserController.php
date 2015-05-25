<?php
class UserController implements IController {
	public function indexAction(){
		// var_dump($_SESSION['user']);exit;
		$model = new LoadModel();
		// echo $time = date("Y-m-d h:i:s");
		// exit;
		$model->report['login']=str_replace('+','',$_SESSION['user']["login"]);
		$model->report['sum']=trim(file_get_contents(DIR.'/data/sum.txt'));
		$select = new SelectModel();
		
		$model->data=$select->select_pay($model->report['login']);
		// var_dump($model->data);exit;
		$fc = FrontController::getInstance();
		$output  = $model->render('user_header.php');
		$output .= $model->render('user_menu.php');
		$output .= $model->render('user_cp_link.php');
		$output .= $model->render('user_pay.php');
		$output .= $model->render('user_foter.php');
		$fc->setBody($output);
	}
	
	public function editAction(){
		$model  = new LoadModel();
		$select = new SelectModel();
		$model->data=$select->select_user_edit($_SESSION['user']["id_reg"]);
		if($model->data == false){
			$model->error[]="Ошибка";
		}
		$fc = FrontController::getInstance();
		$output    = $model->render('user_header.php');
		$output   .= $model->render('user_menu.php');
		$output   .= $model->render('user_cp_link.php');
		if(!empty($model->error)){$output .= $model->render('user_error.php');}
		$output .= $model->render('user_edit.php');
		$output .= $model->render('user_foter.php');
		$fc->setBody($output);
	}
	
	public function edit_validateAction(){
		$pars = new MickModel();
		$phone_1 = $pars->valid_phone_edit($_POST["phone_1"]);
		$phone_2 = $pars->valid_phone_edit($_POST["phone_2"]);
		$phone_3 = $pars->valid_phone_edit($_POST["phone_3"]);
		$email   = $pars->valid_email($_POST["email"]);
		$skype   = $pars->valid_string($_POST["skype"]);
		$model = new LoadModel();
		if(($phone_1 == "Не соответствует номеру телефона") || ($phone_1 == "Лишние символы в номере телефона")){$model->error[] = $phone_1;}
		if(($phone_2 == "Не соответствует номеру телефона") || ($phone_2 == "Лишние символы в номере телефона")){$model->error[] = $phone_2;}
		if(($phone_3 == "Не соответствует номеру телефона") || ($phone_3 == "Лишние символы в номере телефона")){$model->error[] = $phone_3;}
		if($email == "Некорректный емайл"){$model->error[] = $email;}
		if(empty($model->error)){
			$select = new SelectModel();
			$res = $select->updata_user_edit($phone_1,$phone_2,$phone_3,$email,$skype,$_SESSION['user']["id_reg"],$_SESSION['user']["id"]);
			if($res == false){$model->error[] = 'Неудалось обновить данные.';}
			else{header('Location: '.DEFAULT_DIR.'/user/edit');}
		}
		if(!empty($model->error)){
			$fc = FrontController::getInstance();
			$output  = $model->render('user_header.php');
			$output .= $model->render('user_menu.php');
			$output .= $model->render('user_cp_link.php');
			$output .= $model->render('user_error.php');
			$output .= $model->render('user_edit.php');
			$output .= $model->render('user_foter.php');
			$fc->setBody($output);
		}
	}
	
	public function main_merchandiseAction(){
		$model = new LoadModel();
		$select = new SelectModel();
		
		$model->data=$select->select_main_merchandise($_SESSION['user']["id_reg"]);
		
		// var_dump($model->data);exit;
		
		$fc = FrontController::getInstance();
		$output  = $model->render('user_header.php');
		$output .= $model->render('user_menu.php');
		// $output .= $model->render('user_cp_link.php');
		if(!empty($model->error)){
			$output .= $model->render('user_error.php');
		}
		$output .= $model->render('user_view_list.php');
		$output .= $model->render('user_foter.php');
		$fc->setBody($output);
	}
	
	public function edit_itemsAction(){
		$fc = FrontController::getInstance();
		$model = new LoadModel();
		$select = new SelectModel();
		$pars = new MickModel();
		$get=$fc->getParams();
		if(isset($get['name']) && !empty($get['name'])){
			$int=$pars->valid_int($get['name']);
		}
		if(($int==false)||($int=="Недопустимые символы")){
			$model->error[]='Ошибка URL адресса';
		}
		if(empty($model->error)){
			$model->data=$select->select_edit_sale($int,$_SESSION['user']["id_reg"]);
		}
		
		$output  = $model->render('user_header.php');
		$output .= $model->render('user_menu.php');
		if(!empty($model->error)){
			$output .= $model->render('user_error.php');
		}
		// $output .= $model->render('user_fuul_view.php');
		$output .= $model->render('user_view_full.php');
		// $output .= $model->render('user_edit_photo.php');
		$output .= $model->render('user_foter.php');
		$fc->setBody($output);
	}
	public function lookAction(){
		$fc = FrontController::getInstance();
		$model = new LoadModel();
		$select = new SelectModel();
		$pars = new MickModel();
		$get=$fc->getParams();
		if(isset($get['name']) && !empty($get['name'])){
			$int=$pars->valid_int($get['name']);
		}
		if(($int==false)||($int=="Недопустимые символы")){
			$model->error[]='Ошибка URL адресса';
		}
		if(empty($model->error)){
			$model->data=$select->select_edit_sale($int,$_SESSION['user']["id_reg"]);
		}
		
		$output  = $model->render('user_header.php');
		$output .= $model->render('user_menu.php');
		if(!empty($model->error)){
			$output .= $model->render('user_error.php');
		}
		$output .= $model->render('user_look.php');
		$output .= $model->render('user_foter.php');
		$fc->setBody($output);
	}
	public function add_fotoAction(){
		$fc = FrontController::getInstance();
		$model = new LoadModel();
		$select = new SelectModel();
		$pars = new MickModel();
		$get=$fc->getParams();
		$model->url=$get['name'];
		$output  = $model->render('user_header.php');
		$output .= $model->render('user_menu.php');
		if(!empty($model->error)){
			$output .= $model->render('user_error.php');
		}
		$output .= $model->render('user_add_foto.php');
		$output .= $model->render('user_foter.php');
		$fc->setBody($output);
	}
	
	public function upload_photoAction(){
		$model = new LoadModel();
		$fc = FrontController::getInstance();
		$get=$fc->getParams();
		$model->url = $get['name'];
		if(!is_numeric($model->url)){
			$model->error[]="Ошибка загрузки файла";
		}
		$dir = DIR."/user_fil/";
		$catalog = md5($_SESSION['user']["id_reg"]).'/';
		if(!is_dir($dir.$catalog)){
			mkdir($dir.$catalog);
		}
		if(!empty($_FILES)){
			if(empty($model->error)){
				$ress = $model->upload_img_file($_FILES,$dir,$catalog);
				// Запрос к бд на инсерт
				$insert = new InsertModel();
				$retu = $insert->insert_file_image($ress,$model->url);
				if(($retu==false)||(empty($retu))){
					$model->error[]="Ошибка загрузки файла";
				}else{
					header('Location:'.DEFAULT_DIR.'/user/edit_items/name/'.$model->url);
				}
			}
		}else{
			$model->error[]="Ошибка загрузки файла";
		}
		
		$fc = FrontController::getInstance();
		
		
		$output  = $model->render('user_header.php');
		$output .= $model->render('user_menu.php');
		if(!empty($model->error)){
			$select = new SelectModel();
			$pars = new MickModel();
			$get=$fc->getParams();
			$model->url = $get['name'];
			$output .= $model->render('user_error.php');
		}
		$output .= $model->render('user_add_foto.php');
		$output .= $model->render('user_foter.php');
		$fc->setBody($output);
	}
	
	
	public function edit_fotoAction(){
		$model = new LoadModel();
		$fc = FrontController::getInstance();
		$get=$fc->getParams();
		$model->url = $get['name'];
		$select = new SelectModel();
		$model->data = $select->select_edit_photo($model->url);
		$output  = $model->render('user_header.php');
		$output .= $model->render('user_menu.php');
		// $output .= $model->render('user_add_foto.php');
		$output .= $model->render('user_edit_photo.php');
		$output .= $model->render('user_foter.php');
		$fc->setBody($output);
	}
	public function update_photoAction(){
		$model=new LoadModel();
		$fc = FrontController::getInstance();
		$get=$fc->getParams();
		$model->url = $get['name'];
	// Гоняем дел и хайд и если ни один дел не подошел к хайду, то оставляем.
		if(isset($_POST['del'][0])){
			for($i = 0; $r = $_POST['hide'][$i];$i++){
				for($a = 0; $b = $_POST['del'][$a];$a++){
					if($r == $b){
						unset($_POST['hide'][$i]);
						if(file_exists(DIR.$_POST['del'][$a])){
							// echo DIR.$_POST['del'][$a]."<br />";
							unlink(DIR.$_POST['del'][$a]);
						}
					}
				}
			}
		}
		if(!empty($_FILES)){
			$dir = DIR."/user_fil/";
			$catalog = md5($_SESSION['user']["id_reg"]).'/';
			
			$uplode = new LoadModel();
			$ress = $uplode->upload_img_file($_FILES,$dir,$catalog);
			
		}
		
		if(isset($ress) && !empty($ress)){
			$ress = array_merge($ress, $_POST['hide']);
		}else{
			$ress = $_POST['hide'];
			sort($ress,SORT_NUMERIC);
		}
		
		
		
		$insert = new InsertModel();
		$insert->update_file_image($model->url,$ress);
		
		//Вывожу файлы которые я удалю.
		// var_dump($ress);exit;
		header('Location: '.DEFAULT_DIR.'/user/edit_items/name/'.$model->url);
	}
	public function deleteAction(){
		unset($_SESSION['caph']);
		$fc = FrontController::getInstance();
		$get=$fc->getParams();
		$pars = new MickModel();
		$model = new LoadModel();
		$model->url = $pars->valid_int($get["name"]);
		if($model->url === false){
			$model->error[]='Ошибка URL адресса';
		}
		$model->img=$model->captcha(4, 0);
		$output  = $model->render('user_header.php');
		$output .= $model->render('user_menu.php');
		// $output .= $model->render('user_cp_link.php');
		if(!empty($model->error)){
			$output .= $model->render('user_error.php');
		}
		$output .= $model->render('user_delete.php');
		$output .= $model->render('user_foter.php');
		$fc->setBody($output);
	}
	
	public function post_deleteAction(){
		$fc = FrontController::getInstance();
		$model = new LoadModel();
		$pars = new MickModel();
			
		$get=$fc->getParams();
		$model->url = $pars->valid_int($get["name"]);
		
		if($_POST['caph'] == $_SESSION['caph']){
			
			unset($_SESSION['caph']);
			
			$del=new InsertModel();
			$delete=$del->delete($model->url);
			if($delete == false){				
				// $model->error[]='Ошибка удаления , выцепления';
			}else{
				if($delete["photo_1"]!=''){ unlink(DIR.$delete["photo_1"]);}
				if($delete["photo_2"]!=''){ unlink(DIR.$delete["photo_2"]);}
				if($delete["photo_3"]!=''){ unlink(DIR.$delete["photo_3"]);}
				if($delete["photo_4"]!=''){ unlink(DIR.$delete["photo_4"]);}
				if($delete["photo_5"]!=''){ unlink(DIR.$delete["photo_5"]);}
				if($delete["photo_6"]!=''){ unlink(DIR.$delete["photo_6"]);}
				if($delete["photo_7"]!=''){ unlink(DIR.$delete["photo_7"]);}
				if($delete["photo_8"]!=''){ unlink(DIR.$delete["photo_8"]);}
				if($delete["photo_9"]!=''){ unlink(DIR.$delete["photo_9"]);}
				if($delete["photo_10"]!=''){ unlink(DIR.$delete["photo_10"]);}
				if($delete["photo_11"]!=''){ unlink(DIR.$delete["photo_11"]);}
				if($delete["photo_12"]!=''){ unlink(DIR.$delete["photo_12"]);}
				if($delete["photo_13"]!=''){ unlink(DIR.$delete["photo_13"]);}
				if($delete["photo_14"]!=''){ unlink(DIR.$delete["photo_14"]);}
				if($delete["photo_15"]!=''){ unlink(DIR.$delete["photo_15"]);}
				if($delete["photo_16"]!=''){ unlink(DIR.$delete["photo_16"]);}
				if($delete["photo_17"]!=''){ unlink(DIR.$delete["photo_17"]);}
				if($delete["photo_18"]!=''){ unlink(DIR.$delete["photo_18"]);}
				if($delete["photo_19"]!=''){ unlink(DIR.$delete["photo_19"]);}
				if($delete["photo_20"]!=''){ unlink(DIR.$delete["photo_20"]);}
				
				$model->error[]='Операция успешна';
			}
			// $resss = 
			$del->delete_data_base($model->url);
				// if($resss == false){
					// $model->error[]='Ошибка удаления';
				// }
		}else{
			unset($_SESSION['caph']);
		}
		
		$output  = $model->render('user_header.php');
		$output .= $model->render('user_menu.php');
		$output .= $model->render('user_cp_link.php');
		if(!empty($model->error)){
			$output .= $model->render('user_error.php');
		}else{
			$model->img=$model->captcha(5, 1);
			$output .= $model->render('user_delete.php');
		}
		$output .= $model->render('user_foter.php');
		$fc->setBody($output);
	}
	
	public function payAction(){
		$insert = new InsertModel();
		$select = new SelectModel();
		
		$derb = explode(' ',$_POST["ik_inv_crt"]);
		$day = explode('-',$derb[0]);
		$hour = explode(':',$derb[1]);
		$now = mktime($hour[0],$hour[1],$hour[2],$day[1],$day[2],$day[0]);
		$next = strtotime("next month",$now);
		
		$id = str_replace('+','',$_SESSION['user']["login"]);
		
		$res = $select->select_last_pay($id,$now);
		if($res != false){
			$now = $res['date_end_payment'];
			$next = strtotime("next month",$now);
		}
			$insert->insert_vize($_POST,$now,$next);
			if(isset($_SESSION['user']) && !empty($_SESSION['user'])){
				$_SESSION['user']["role"]=2;
				
			}
		header('Location:'.DEFAULT_DIR.'/user/index');
		// ["ik_co_id"]=> string(24) "53254e03bf4efc7752dd2295" 
		// ["ik_inv_st"]=> string(7) "success" 
		// ["ik_inv_crt"]=> string(19) "2014-04-23 18:21:09" 
		// ["ik_inv_prc"]=> string(19) "2014-04-23 18:21:09" 
		// ["ik_am"]=> string(7) "1000.00" 
		// ["ik_cur"]=> string(3) "RUB" 
		// ["ik_ps_price"]=> string(7) "1000.00" 
		
		
		// ["ik_inv_crt"]=> string(19) "2014-04-23 18:21:09"
		// ["ik_pm_no"]=> string(15) "7-890-345-65-43" 
		// ["ik_inv_id"]=> string(8) "27161326"
		// ["ik_co_rfn"]=> string(8) "970.0000"
		// ["ik_pw_via"]=> string(24) "test_interkassa_test_xts"
		// ["ik_desc"]=> string(70) "Оплата аккаунта пользователя 7-890-345-65-43" 
	}
	public function payerrorAction(){
		// var_dump($_POST);exit;
		// array(12) { ["ik_co_id"]=> string(24) "53254e03bf4efc7752dd2295" ["ik_inv_id"]=> string(8) "27161362" ["ik_inv_st"]=> string(8) "canceled" ["ik_inv_crt"]=> string(19) "2014-04-23 18:22:22" ["ik_inv_prc"]=> string(0) "" ["ik_pm_no"]=> string(15) "7-890-345-65-43" ["ik_pw_via"]=> string(24) "test_interkassa_test_xts" ["ik_am"]=> string(7) "1000.00" ["ik_cur"]=> string(3) "RUB" ["ik_co_rfn"]=> string(8) "970.0000" ["ik_ps_price"]=> string(7) "1000.00" ["ik_desc"]=> string(70) "Оплата аккаунта пользователя 7-890-345-65-43" } 
	}
	public function view_informationAction(){
		// var_dump($_POST);exit;
		$fc = FrontController::getInstance();
		$model = new LoadModel();
		$pars = new MickModel();
		$select = new SelectModel();
		
		$id_reg = $pars->valid_int($_POST['id_u']);
		if($id_reg != false){
			$model->data = $select->get_information($id_reg);
			$output .= $model->render('user_contacts.php');
			$fc->setBody($output);
		}
	}
	public function look_amazingAction(){
		// var_dump($_POST);exit;
		$fc = FrontController::getInstance();
	
		$model = new LoadModel();
		$pars = new MickModel();
		
		$model->data['id_hoz']=$pars->valid_int($_POST["id_u"]);
		$model->data['id_kv']=$pars->valid_int($_POST["id_k"]);
		$output .= $model->render('JQ/sent_to_kvar_hoz.php');
		$fc->setBody($output);
		
	}
	public function send_kvAction(){
		
		$pars = new MickModel();
		
		preg_match ("#[0-9]{2}.[0-9]{2}\s[0-9]{2}:[0-9]{2}#" , $_POST["dataprosmotra"], $data);
		$message=$pars->valid_string($_POST["textf"]);
		$id_user=$pars->valid_int($_POST["vlastelin"]);
		$id_sale=$pars->valid_int($_POST["kvartira"]);
		
		$insert = new InsertModel();
		$insert->insert_look($id_user, $id_sale, $message, $data[0]);
		
		header("location:". $_SERVER['HTTP_REFERER']);
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	####################################################################################
	public function sale1Action(){
		$model = new LoadModel();
		$select = new SelectModel();
		$fc = FrontController::getInstance();
		if($_SERVER['REQUEST_METHOD']=="POST"){
			// var_dump($_POST);exit;
			if($_POST['city'] == "Москва"){
				$_SESSION['sale_price']["city"]="Москва";
				$model->data = $select->select_metro();
				$output .= $model->render('add_item/user_step_2.php');
			}
			
			
		}
		if($_SERVER['REQUEST_METHOD']=="GET"){
			$model->report = $select->select_category();
			$model->data = $select->select_city();
			$output  = $model->render('user_header.php');
			$output .= $model->render('user_menu.php');
			$output .= $model->render('user_cp_link.php');
			if(!empty($_SESSION['error'])){
				$model->error=$_SESSION['error'];
				$output .= $model->render('user_error.php');
			}
			$output .= $model->render('add_item/user_step_1.php');
			$output .= $model->render('user_foter.php');
		}
		$fc->setBody($output);
	}
	
	public function sale2Action(){
		// var_dump($_POST);exit;
		$model = new LoadModel();
		$select = new SelectModel();
		$fc = FrontController::getInstance();
		if($_SERVER['REQUEST_METHOD']=="POST"){
			$eplod = explode('\w/',$_POST['metro']);
		
			if(!empty($eplod[1])){
				$model->data = $select->select_street($eplod[1]);
				$output .= $model->render('add_item/user_step_3.php');
			}
		}
		$fc->setBody($output);
	}
	
	public function sale3Action(){
		$model = new LoadModel();
		$select = new SelectModel();
		$fc = FrontController::getInstance();
		if($_SERVER['REQUEST_METHOD']=="POST"){
				$model->data = $select->select_type();
				$output .= $model->render('add_item/user_step_4.php');
		}
		$fc->setBody($output);
	}
	
	public function sale4Action(){
		$model = new LoadModel();
		$fc = FrontController::getInstance();
		if($_SERVER['REQUEST_METHOD']=="POST"){
			$output .= $model->render('add_item/user_step_5.php');
		}
		$fc->setBody($output);
	}
	
	public function sale5Action(){
		$model = new LoadModel();
		$fc = FrontController::getInstance();
		if($_SERVER['REQUEST_METHOD']=="POST"){
			$_SESSION['sale_price']["lodj"]=$_POST['lodj'];
			$output .= $model->render('add_item/user_step_6.php');
		}
		$fc->setBody($output);
	}
	
	public function sale6Action(){
		$model = new LoadModel();
		$fc = FrontController::getInstance();
		if($_SERVER['REQUEST_METHOD']=="POST"){
			// unset($_SESSION['sale_price']);//["lodj"]
			$output .= $model->render('add_item/user_step_7.php');
		}
		$fc->setBody($output);
	}
	public function sale_step_1Action(){
		$pars = new MickModel();
		
		unset($_SESSION['error']);
		$arr = array();
		
		if(isset($_POST["metro"])&& !empty($_POST["metro"])){
			$arr["metro"] = $pars->valid_string($_POST["metro"]);
			if($arr["metro"] === false){
				$_SESSION['error'][]="не указано метро";
			}
		}else{
			$arr["metro"] = "";
		}
		if(isset($_POST["lodjiyaS"])&& !empty($_POST["lodjiyaS"])){
			$arr["lodjiyaS"] = $pars->valid_string($_POST["lodjiyaS"]);
			if($arr["lodjiyaS"] === false){
				$_SESSION['error'][]="не указано наличие лоджии";
			}
		}else{
			$arr["lodjiyaS"] = 0;
		}
		$arr["category"] = $pars->valid_int($_POST["category"]);
		$arr["city"] = $pars->valid_string($_POST["city"]);
		$arr["street"] = $pars->valid_string($_POST["street"]);
		$arr["type"] = $pars->valid_int($_POST["type"]);
		$arr["sobstvennik"] = $pars->valid_int($_POST["sobstvennik"]);
		$arr["phone"] = $pars->valid_int($_POST["phone"]);
		$arr["izolyaciya"] = $pars->valid_int($_POST["izolyaciya"]);
		$arr["TYALET3AKPblT"] = $pars->valid_int($_POST["TYALET3AKPblT"]);
		$arr["freesell"] = $pars->valid_int($_POST["freesell"]);
		$arr["maloletoknet"] = $pars->valid_int($_POST["maloletoknet"]);
		$arr["ka4estvo"] = $pars->valid_int($_POST["ka4estvo"]);
		$arr["kydaokna"] = $pars->valid_int($_POST["kydaokna"]);
		$arr["planirovka"] = $pars->valid_int($_POST["planirovka"]);
		$arr["osnovanie"] = $pars->valid_int($_POST["osnovanie"]);
		$arr["osnov_poluch"] = $pars->valid_string($_POST["osnov_poluch"]);
		$arr["mortgage"] = $pars->valid_int($_POST["mortgage"]);//ипотека
		$arr["sobstvennost"] = $pars->valid_int($_POST["sobstvennost"]);
		$arr["balkon"] = $pars->valid_int($_POST["balkon"]);
		$arr["lodj"] = $pars->valid_int($_POST["lodj"]);
		$arr["number_house"] = $pars->valid_string($_POST["number_house"]);
		$arr["kolKomnat"] = $pars->valid_string($_POST["kolKomnat"]);
		$arr["price"] = $pars->valid_string($_POST["price"]);
		$arr["dometro"] = $pars->valid_string($_POST["dometro"]);
		$arr["docentra"] = $pars->valid_string($_POST["docentra"]);
		$arr["obcshayaS"] = $pars->valid_string($_POST["obcshayaS"]);
		$arr["jilayaS"] = $pars->valid_string($_POST["jilayaS"]);
		$arr["kyxnyaS"] = $pars->valid_string($_POST["kyxnyaS"]);
		$arr["koridorS"] = $pars->valid_string($_POST["koridorS"]);
		$arr["sanyzelS"] = $pars->valid_string($_POST["sanyzelS"]);
		$arr["visota"] = $pars->valid_string($_POST["visota"]);
		$arr["etag"] = $pars->valid_int($_POST["etag"]);
		$arr["etagnost"] = $pars->valid_int($_POST["etagnost"]);
		$arr["year_structure"] = $pars->valid_string($_POST["year_structure"]);
		$arr["text"] = $pars->valid_string($_POST["text"]);
		// Плодим ифы ошибок
		
		if(($arr["category"] === false) || (!isset($arr["category"]))){ $_SESSION['error'][]="не указана категория"; }
		if(($arr["city"] === false) || (!isset($arr["city"]))){ $_SESSION['error'][]="не указан город"; }
		if(($arr["street"] === false) || (!isset($arr["street"]))){ $_SESSION['error'][]="не указана улица"; }
		if(($arr["type"] === false) || (!isset($arr["type"]))){ $_SESSION['error'][]="не указан тип дома"; }
		if(($arr["sobstvennik"] === false) || (!isset($arr["sobstvennik"]))){ $_SESSION['error'][]="не указан собственник"; }
		if(($arr["phone"] === false) || (!isset($arr["phone"]))){ $_SESSION['error'][]="не указано наличие телефона"; }
		if(($arr["izolyaciya"] === false) || (!isset($arr["izolyaciya"]))){ $_SESSION['error'][]="не указана изоляция комнат"; }
		if(($arr["TYALET3AKPblT"] === false) || (!isset($arr["TYALET3AKPblT"]))){ $_SESSION['error'][]="не указан раздельный санузел или нет"; }
		if(($arr["freesell"] === false) || (!isset($arr["freesell"]))){ $_SESSION['error'][]="не указано поле свободная продажа"; }
		if(($arr["maloletoknet"] === false) || (!isset($arr["maloletoknet"]))){ $_SESSION['error'][]="не указано наличие или отсутствие несовершеннолетних"; }
		if(($arr["ka4estvo"] === false) || (!isset($arr["ka4estvo"]))){ $_SESSION['error'][]="не указано качество ремонта";}
		if(($arr["kydaokna"] === false) || (!isset($arr["kydaokna"]))){ $_SESSION['error'][]="не указано куда выходят окна квартиры"; }
		if(($arr["planirovka"] === false) || (!isset($arr["planirovka"]))){ $_SESSION['error'][]="не указана планировка"; }
		if(($arr["osnovanie"] === false) || (!isset($arr["osnovanie"]))){ $_SESSION['error'][]="не указано основание получения собственности"; }
		if(($arr["osnov_poluch"] === false) || (!isset($arr["osnov_poluch"]))){ $_SESSION['error'][]="не указано поле дополнительной информации на основание получения собственности"; }
		if(($arr["mortgage"] === false) || (!isset($arr["mortgage"]))){ $_SESSION['error'][]="не указано возможность взять ипотеку"; }
		if(($arr["sobstvennost"] === false) || (!isset($arr["sobstvennost"]))){ $_SESSION['error'][]="не указано собственость на квартиру более трех лет"; }
		if(($arr["balkon"] === false) || (!isset($arr["balkon"]))){ $_SESSION['error'][]="не указано наличие балкона"; }
		if(($arr["lodj"] === false) || (!isset($arr["lodj"])) ){ $_SESSION['error'][]="не указано наличие лоджии"; }
		if(($arr["number_house"] === false) || (!isset($arr["number_house"]))){ $_SESSION['error'][]="не указан номер дома"; }
		if(($arr["kolKomnat"] === false) || (!isset($arr["kolKomnat"]))){ $_SESSION['error'][]="не указано кол-во комнат"; }
		if(($arr["price"] === false) || (!isset($arr["price"]))){ $_SESSION['error'][]="не указаноа цена квартиры"; }
		if(($arr["docentra"] === false) || (!isset($arr["docentra"]))){ $_SESSION['error'][]="не указано растояние до центра"; }
		if(($arr["dometro"] === false) || (!isset($arr["dometro"]))){ $_SESSION['error'][]="не указано растояние до метро"; }
		if(($arr["obcshayaS"] === false) || (!isset($arr["obcshayaS"]))){ $_SESSION['error'][]="не указана общая площадь"; }
		if(($arr["jilayaS"] === false) || (!isset($arr["jilayaS"]))){ $_SESSION['error'][]="не указана жилая площадь"; }
		if(($arr["kyxnyaS"] === false) || (!isset($arr["kyxnyaS"]))){ $_SESSION['error'][]="не указана площадь кухни"; }
		if(($arr["koridorS"] === false) || (!isset($arr["koridorS"]))){ $_SESSION['error'][]="не указана площадь коридора"; }
		if(($arr["sanyzelS"] === false) || (!isset($arr["sanyzelS"]))){ $_SESSION['error'][]="не указана площадь санузла"; }
		if(($arr["visota"] === false) || (!isset($arr["visota"]))){ $_SESSION['error'][]="не указана высота потолка"; }
		if(($arr["etag"] === false) || (!isset($arr["etag"]))){ $_SESSION['error'][]="не указано на каком этаже квартира"; }
		if(($arr["etagnost"] === false) || (!isset($arr["etagnost"]))){ $_SESSION['error'][]="не указана этажность здания"; }
		if(($arr["year_structure"] === false) || (!isset($arr["year_structure"]))){ $_SESSION['error'][]="не заполнено поле год постройки"; }
		if(($arr["text"] === false) || (!isset($arr["text"]))){ $_SESSION['error'][]="не заполнено поле дополнительной информации"; }
		//если есть ошибки то редиректим на вывод ошибок и начинаем заполнение с нуля Бууу-га-га-га-га
		if(!empty($_SESSION['error'])){
			header('Location: '.DEFAULT_DIR.'/user/sale1');
		}
		//если нет ошибок кидаем это безобразие в базу
		if(empty($_SESSION['error'])){
			$arr["kv_m"]=$arr["price"]/$arr["obcshayaS"];
			
			$arr['data']=time();
			$insert=new InsertModel();
			
			if(!empty($arr["metro"])){
				$eplod = explode('\w/',$arr["metro"]);
				$select = new SelectModel();
				$beg = $select->select_street_pars($eplod[0], $arr["street"]);
				if($beg == false){
					$insert->insert_street($arr["street"],$eplod[0]);
				}
			}
			
			
			$result = $insert->insert_seller($arr);
			if($result == false){ 
				//редиректим на вывод ошибок и начинаем заполнение с нуля Бууу-га-га-га-га
				header('Location: '.DEFAULT_DIR.'/user/sale1'); 
			}else{
				header('Location: '.DEFAULT_DIR.'/user/main_merchandise');
			}
		}
	}
	
	public function exitAction(){
		unset($_COOKIE[session_name()]);
		unset($_COOKIE[session_id()]);
		session_unset();
		session_destroy();
		header('Location: '.DEFAULT_DIR);
	}
}