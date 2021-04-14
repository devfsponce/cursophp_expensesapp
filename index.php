<?php
error_reporting(E_ALL); //Error/Exception engine, always use E_ALL

ini_set('ignore_repeated_errors', TRUE);

ini_set('display_errors', FALSE);

ini_set('log_errors', TRUE);

ini_set("error_log", "C:/xampp/htdocs/cursoPHP/expenses-app-mvc/php-error.log");
error_log("inicio de aplicacion web");

require_once 'libs/app.php';


$app = new App();
