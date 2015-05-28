<?php
session_set_cookie_params(7200);
session_start();
/* Всякое полезное */
define('DEFAULT_DIR', 'http://'.$_SERVER['SERVER_NAME']);
define('DIR', $_SERVER['DOCUMENT_ROOT']);
date_default_timezone_set('Europe/Moscow');
/* Пути по-умолчанию для поиска файлов */
set_include_path(get_include_path()
				.PATH_SEPARATOR.DIR.'/controllers'
     			.PATH_SEPARATOR.DIR.'/models'
     			.PATH_SEPARATOR.DIR.'/views');


/* Автозагрузчик классов */
function __autoload($class){
 @require_once($class.'.php');
 // if(!file_exists(DIR.'/application/controllers/'.$class.'.php')){
  // header('Location: '.DEFAULT_DIR.'/user/not');
 // }
}

/* Инициализация и запуск FrontController */
$front = FrontController::getInstance();
$front->route();

/* Вывод данных */
echo $front->getBody();
