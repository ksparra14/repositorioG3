<?php
/* logo de errores para valdiad el funcionamiento de la api*/ 
ini_set('display_errors', 1);
ini_set("log_errors", 1);
ini_set("error_log",  "c:/xampp/htdocs/api/php_error_log");

/* corss */ 
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials: true');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE,OPTIONS');
header('content-type: application/json; charset=utf-8');

/* llamamos a nuestro routes controler */
require_once "controllers/routes.controllers.php";

$index = new RoutesController();
$index -> index();
?>