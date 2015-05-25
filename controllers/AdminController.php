<?php
class AdminController implements IController {
	
	public function templatesAction(){
		$model = new LoadModel();
		$select = new AdminSelectModel();
		$model->data = $select->select_templates();
		if($model->data == false){
			$model->error[]="Нет шаблонов Электронной почты";
		}
		
		$fc = FrontController::getInstance();
		$output = $model->render('user_header.php');
		$output .= $model->render('user_menu.php');
		if(!empty($model->error)){
			$output .= $model->render('user_error.php');
		}
		$output .= $model->render('adm_templates.php');
		$output .= $model->render('user_foter.php');
		$fc->setBody($output);
	}
	public function statisticsAction(){
		$model = new LoadModel();
		
		$fc = FrontController::getInstance();
		$output = $model->render('user_header.php');
		$output .= $model->render('user_menu.php');
		$output .= $model->render('adm_statistics.php');
		$output .= $model->render('user_foter.php');
		$fc->setBody($output);
	}
	public function listAction(){
		$fc = FrontController::getInstance();
		$pars = new VerificationModel();
		$model = new LoadModel();
		$select = new AdminSelectModel();
		$model->data = $select->select_list_user();
		if($model->data == false){
			$model->error[] = "Нет юзеров (потерялись!) ну или ошибка...";
		}
		$output = $model->render('user_header.php');
		$output .= $model->render('user_menu.php');
		if(!empty($model->error)){
			$output .= $model->render('user_error.php');
		}
		$output .= $model->render('adm_list.php');
		$output .= $model->render('user_foter.php');
		$fc->setBody($output);
	}
	public function categoryAction(){
		$model = new LoadModel();
		$select = new AdminSelectModel();
		
		$ress = $select->select_category($cat);
		if($ress == false){
			$model->error[]= "Нет ни одной категории";
		}else{
			$model->data=$ress;
		}
		$fc = FrontController::getInstance();
		$output = $model->render('user_header.php');
		$output .= $model->render('user_menu.php');
		if(!empty($model->error)){
			$output .= $model->render('user_error.php');
		}
		$output .= $model->render('adm_categ.php');
		$output .= $model->render('user_foter.php');
		$fc->setBody($output);
	}
	public function optionsAction(){
		$model = new LoadModel();
		$select = new AdminSelectModel();
		
		$ress = $select->select_options($options);
		if($ress == false){
			$model->error[]= "Нет не одного типа квартир";
		}else{
			$model->data=$ress;
		}
		
		$fc = FrontController::getInstance();
		$output = $model->render('user_header.php');
		$output .= $model->render('user_menu.php');
		if(!empty($model->error)){
			$output .= $model->render('user_error.php');
		}
		$output .= $model->render('adm_options.php');
		$output .= $model->render('user_foter.php');
		$fc->setBody($output);
	}
	public function addcategoryAction(){
		$pars = new VerificationModel();
		$category = $pars->verifacationLogin($_POST["category"]);
		$model = new LoadModel();
		if($category == '0'){
			$model->error[] = "Нет данных";
		}
		
		if(empty($model->error)){
			$isert = new AdminInsertModel();
			if($isert->insert_category($category) == false){
				$model->error[]= "данные не добавлены";
			}
		}else{
			$fc = FrontController::getInstance();
			$output = $model->render('user_header.php');
			$output .= $model->render('user_menu.php');
			if(!empty($model->error)){
				$output .= $model->render('user_error.php');
			}
			$output .= $model->render('adm_categ.php');
			$output .= $model->render('user_foter.php');
			$fc->setBody($output);
		}
		header('Location: '.DEFAULT_DIR.'/admin/category');
	}
	public function addoptionsAction(){
		$pars = new VerificationModel();
		$options = $pars->verifacationLogin($_POST["options"]);
		$model = new LoadModel();
		if($options == '0'){
			$model->error[] = "Нет данных";
		}
		
		if(empty($model->error)){
			$isert = new AdminInsertModel();
			if($isert->insert_options($options) == false){
				$model->error[]= "данные не добавлены";
			}
		}else{
			$fc = FrontController::getInstance();
			$output = $model->render('user_header.php');
			$output .= $model->render('user_menu.php');
			if(!empty($model->error)){
				$output .= $model->render('user_error.php');
			}
			$output .= $model->render('adm_options.php');
			$output .= $model->render('user_foter.php');
			$fc->setBody($output);
		}
		header('Location: '.DEFAULT_DIR.'/admin/options');
	}
	public function streetAction(){
			$model = new LoadModel();
			$select = new AdminSelectModel();
			$model->data=$select->select_metro();
			$fc = FrontController::getInstance();
			$output = $model->render('user_header.php');
			$output .= $model->render('user_menu.php');
			if(!empty($model->error)){
				$output .= $model->render('user_error.php');
			}
			$output .= $model->render('adm_street.php');
			$output .= $model->render('user_foter.php');
			$fc->setBody($output);
	}
	public function metroAction(){
			$fc = FrontController::getInstance();
			$param = $fc->getParams();
			$model = new LoadModel();
			if($param['edit'] == metro){
				$select = new AdminSelectModel();
				$model->data=$select->select_metro();
			}
			$output = $model->render('user_header.php');
			$output .= $model->render('user_menu.php');
			if(!empty($model->error)){
				$output .= $model->render('user_error.php');
			}
			if($param['edit'] == metro){
				$output .= $model->render('adm_edit_metro.php');
			}else{
				$output .= $model->render('adm_metro.php');
			}
			$output .= $model->render('user_foter.php');
			$fc->setBody($output);
	}
	public function addmetroAction(){
			$pars = new VerificationModel();
			$metro = $pars->verifacationLogin($_POST["metro"]);
			// var_dump($metro);exit;
			$model = new LoadModel();
			if($metro == '0'){
				$model->error[]="Ошибка ввода данных";
			}
			if(empty($model->error)){
				$ins = new AdminInsertModel();
				$ress = $ins->insert_metro($metro);
				if($ress == false){
					$model->error[]="Ошибка. Добавление в базу не произошло.";
					if(empty($model->error)){
						header('Location: '.DEFAULT_DIR.'/admin/metro');
					}
				}
			}
			$fc = FrontController::getInstance();
			$output = $model->render('user_header.php');
			$output .= $model->render('user_menu.php');
			if(!empty($model->error)){
				$output .= $model->render('user_error.php');
			}
			$output .= $model->render('adm_metro.php');
			$output .= $model->render('user_foter.php');
			$fc->setBody($output);
	}
	public function addstreetAction(){
			$pars = new VerificationModel();
			$metro = $pars->verifacationLogin($_POST["metro"]);
			$street = $pars->verifacationLogin($_POST["street"]);
			var_dump($_POST);exit;
			$model = new LoadModel();
			if($street == '0'){
				$model->error[]="Ошибка ввода данных";
			}
			if(empty($model->error)){
				$ins = new AdminInsertModel();
				$ress = $ins->insert_street($street,$metro);
				if($ress == false){
					$model->error[]="Ошибка. Добавление в базу не произошло.";
					if(empty($model->error)){
						header('Location: '.DEFAULT_DIR.'/admin/metro');
					}
				}
			}
			$fc = FrontController::getInstance();
			$output = $model->render('user_header.php');
			$output .= $model->render('user_menu.php');
			if(!empty($model->error)){
				$output .= $model->render('user_error.php');
			}
			$output .= $model->render('adm_metro.php');
			$output .= $model->render('user_foter.php');
			$fc->setBody($output);
	}
	public function editmetroAction(){
		$fc = FrontController::getInstance();
		$param = $fc->getParams();
		$pars = new VerificationModel();
		$id = $pars->verifacationLogin($param['name']);
		$model = new LoadModel();
		if(($id == false)||($id == "Недопустимые символы")){
			$model->error[]='Недопустимые символы';
		}
		if(empty($model->error)){
			$select = new AdminSelectModel();
			$model->data = $select->select_edit_metro($id);
			$model->url='metro';
		}
		
		$output = $model->render('user_header.php');
		$output .= $model->render('user_menu.php');
		if(!empty($model->error)){
			$output .= $model->render('user_error.php');
		}
		$output .= $model->render('adm_edit.php');
		$output .= $model->render('user_foter.php');
		$fc->setBody($output);
	}
	public function addeditmetroAction(){
		$fc = FrontController::getInstance();
		$param = $fc->getParams();
		$pars = new VerificationModel();
		$id = $pars->verifacationInt($param['name']);
		$metro = $pars->verifacationLogin($_POST['metro']);
		$model = new LoadModel();
		if(($id == false)||($id == "Недопустимые символы")){
			$model->error[]='Недопустимые символы';
		}
		if($metro == false){
			$model->error[]='Недопустимые символы';
		}
		if(empty($model->error)){
			$iser = new AdminInsertModel();
			$ress = $iser->update_metro($metro,$id);
			if($ress == false){
				$model->error[]='Не удача, редактирования';
			}else{
				header('Location: '.DEFAULT_DIR.'/admin/metro/edit/metro');
			}
		}
		
		$output = $model->render('user_header.php');
		$output .= $model->render('user_menu.php');
		if(!empty($model->error)){
			$output .= $model->render('user_error.php');
		}
		$output .= $model->render('adm_edit.php');
		$output .= $model->render('user_foter.php');
		$fc->setBody($output);
	}
	public function editcategoryAction(){
		$model = new LoadModel();
		$fc = FrontController::getInstance();
		$param=$fc->getParams();
		$pars = new VerificationModel();
		$id = $pars->verifacationInt($param['name']);
		$model->url = 'category';
		$select = new AdminSelectModel();
		$model->data = $select->add_select_category($id);
		if($model->data == false){
			$model->error[]="Нет ни одной категории";
		}
		
		$output = $model->render('user_header.php');
		$output .= $model->render('user_menu.php');
		if(!empty($model->error)){
			$output .= $model->render('user_error.php');
		}
		$output .= $model->render('adm_edit.php');
		$output .= $model->render('user_foter.php');
		$fc->setBody($output);
	}
	public function addeditcategoryAction(){
		$model = new LoadModel();
		$fc = FrontController::getInstance();
		$param=$fc->getParams();
		$pars = new VerificationModel();
		$categ = $pars->verifacationLogin($_POST['metro']);
		$id = $pars->verifacationInt($param['name']);
		if($categ == false){
			$model->error[]="Ошибка: не удалось редактировать";
		}
		if(($id == false)||($id =="Недопустимые символы")){
			$model->error[]="Нет ни одной категории";
		}
		if(empty($model->error)){
			$insert = new AdminInsertModel();
			$insert->update_category($categ,$id);
		}
		header('Location: '.DEFAULT_DIR.'/admin/category');
	}
}
?>