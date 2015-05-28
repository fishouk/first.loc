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
		$model = new LoadModel();
		$utils = new VerificationModel();
		$fc = FrontController::getInstance();
		if(isset($_POST["but"])){
			$login = $_POST["login"];
			$password = $_POST["password"];
			if(empty($login)){
				$model->error[] .= "Введите логин.";
			}
			if(empty($password)){
				$model->error[] .= "Введите пароль.";
			}
			$login = $utils->verifacationLogin($login);
			$password = $utils->verifacationPassword($password);
			if ($login && $password) {
				$select = new SelectModel();
				$auth = $select->authorization($login, $password);
				$auth = $auth[0];
				$_SESSION["user"]=true;
				$_SESSION["user_info"]["id"]=$auth["id"];
				$_SESSION["user_info"]["login"]=$auth["login"];
				$_SESSION["user_info"]["email"]=$auth["email"];
				$_SESSION["user_info"]["fistName"]=$firstName;
				$_SESSION["user_info"]["lastName"]=$lastName;
				header("Location: /");
				exit();
			}else{
				header("Location: /");
			}
		}else{
			header("Location: /");
		}
	}
	public function regAction(){
		$model = new LoadModel();
		$fc = FrontController::getInstance();
		/* Инициализация модели */
		$output = $model->render('guest/header.php');
		$output .= $model->render('guest/menu.php');
		$output .= $model->render('guest/body_open.php');
		$output .= $model->render('guest/form.reg.php');
		$output .= $model->render('guest/body_close.php');
		$output .= $model->render('guest/footer.php');
		$fc->setBody($output);
	}
}
