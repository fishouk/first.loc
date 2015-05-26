<?php
class IndexController implements IController {

	public function indexAction() {
		if(isset($_SESSION['user'])){
			header('Location: '.DEFAULT_DIR.'/user/index');
			exit;
		}
		
		$model = new LoadModel();
		// $model->data=$select->select_city();
		$fc = FrontController::getInstance();
		/* Инициализация модели */
		$output = $model->render('guest/header.php');
		$output .= $model->render('guest/menu.php');
		$output .= $model->render('guest/body_open.php');
		$output .= $model->render('guest/form.auth.php');
		$output .= $model->render('guest/body_close.php');
		$output .= $model->render('guest/footer.php');
		$fc->setBody($output);
	}
	public function changeLogAction(){
		$model = new LoadModel();
		$fc = FrontController::getInstance();
		/* Инициализация модели */
		$output = $model->render('guest/header.php');
		$output .= $model->render('guest/menu.php');
		$output .= $model->render('guest/body_open.php');
		$output .= $model->render('guest/changeLog.php');
		$output .= $model->render('guest/body_close.php');
		$output .= $model->render('guest/footer.php');
		$fc->setBody($output);
	}
	public function authAction(){
		if(!isset($_GET["au"]) || !isset($_POST["but"])){
			header('Location: '.DEFAULT_DIR.'/wtf');
			exit();
		}
		$model = new LoadModel();
		$utils = new VerificationModel();
		$fc = FrontController::getInstance();
		if(empty($_POST["login"])){
			$model->error[] .= "Введите логин.";
		}
		if(empty($_POST["password"])){
			$model->error[] .= "Введите пароль.";
		}
		$output = $model->render('guest/header.php');
		$output .= $model->render('guest/menu.php');
		$output .= $model->render('guest/body_open.php');
		$output .= $model->render('guest/form.auth.php');
		$output .= $model->render('guest/body_close.php');
		$output .= $model->render('guest/footer.php');
		$fc->setBody($output);
	}
}
