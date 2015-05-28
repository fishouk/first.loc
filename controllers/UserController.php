<?php
class UserController implements IController {
	public function indexAction(){
		$model = new LoadModel();
	    $fc = FrontController::getInstance();
	    $output = $model->render('guest/header.php');
		$output .= $model->render('guest/menu.php');
	    $output .= $model->render('user/user_menu.php');
	    $output .= $model->render('guest/body_open.php');
		$output .= $model->render('user/user_info_table.php');
		$output .= $model->render('guest/body_close.php');
		$output .= $model->render('guest/footer.php');
	    $fc->setBody($output);
 	}
 	public function exitAction(){
  		unset($_COOKIE[session_name()]);
  		unset($_COOKIE[session_id()]);
  		session_unset();
  		session_destroy();
  		header('Location: '.DEFAULT_DIR);
 	}
}