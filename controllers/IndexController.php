<?php
class IndexController implements IController {

	public function indexAction() {
		if(isset($_SESSION['user'])){
			header('Location: '.DEFAULT_DIR.'/user/index');
			exit;
		} else {
			$model = new LoadModel();
			$utils = new VerificationModel();
			$auth = new SelectModel();
			$fc = FrontController::getInstance();
				
			$output = $model->render('guest/header.php');
			$output .= $model->render('guest/menu.php');
			$output .= $model->render('guest/body_open.php');
			$output .= $model->render('guest/form.auth.php');
			$output .= $model->render('guest/body_close.php');
			$output .= $model->render('guest/footer.php');
			$fc->setBody($output);
		}
		
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
		$auth = new SelectModel();
		$fc = FrontController::getInstance();
		
		if(isset($_POST["but"])){
			$login = $utils->verifacationLogin($_POST["login"]);
			$password = $utils->verifacationPassword($_POST["password"]);
			$userAuth = $auth->authorization($login, $password);
			$userAuth = $userAuth[0];
			if ($userAuth) {
				$_SESSION["user"]=true;
				$_SESSION["user_info"]["id"]=$userAuth["id"];
				$_SESSION["user_info"]["login"]=$userAuth["login"];
				$_SESSION["user_info"]["email"]=$userAuth["email"];
				$_SESSION["user_info"]["fistName"]=$firstName;
				$_SESSION["user_info"]["lastName"]=$lastName;
				header("Location: /");
				exit();				
			}else header("Location: /");
		}else header("Location: /");
	}
	public function regAction(){
		$model = new LoadModel();
		$fc = FrontController::getInstance();
		$utils = new VerificationModel();
		$auth = new SelectModel();
		
		$output = $model->render('guest/header.php');
		$output .= $model->render('guest/menu.php');
		$output .= $model->render('guest/body_open.php');
		$output .= $model->render('guest/form.reg.php');
		$output .= $model->render('guest/body_close.php');
		$output .= $model->render('guest/footer.php');
		$fc->setBody($output);
		
		if (isset($_POST["registration"])){
			$login = $utils->verifacationLogin($_POST["login"]);
			$email = $utils-> verifacationEmail($_POST["email"]);
			$password = $utils->verifacationRegPassword($_POST["password"]);
			$secondPassword = $utils->verifacationRegPassword($_POST["secondPassword"]);
			
			
			/*$userAuth = $auth->authorization($login, $password);
			$userAuth = $userAuth[0];
			if ($userAuth) {
				$_SESSION["user"]=true;
				$_SESSION["user_info"]["id"]=$userAuth["id"];
				$_SESSION["user_info"]["login"]=$userAuth["login"];
				$_SESSION["user_info"]["email"]=$userAuth["email"];
				$_SESSION["user_info"]["fistName"]=$firstName;
				$_SESSION["user_info"]["lastName"]=$lastName;
				header('Location: /user/index');
				exit();
			}else{
				header('Location: /index/reg'):
			}*/else {
				header('Location: /index/reg');
			}
		}

	}
	public function missingPageAction(){
		$model = new LoadModel();
		$fc = FrontController::getInstance();
		/* Инициализация модели */
		$output = $model->render('guest/header.php');
		$output .= $model->render('guest/menu.php');
		$output .= $model->render('guest/body_open.php');
		$output .= $model->render('guest/404.php');
		$output .= $model->render('guest/body_close.php');
		$output .= $model->render('guest/footer.php');
		$fc->setBody($output);
	}
}
