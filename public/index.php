<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(dirname(__FILE__)));
define("VIEW_PATH", ROOT.DS.'application'.DS.'views');
define('BASE_PATH', '/mvc/');

//loading init files
require_once(ROOT.DS.'core'.DS.'init.php');

$router = new Router($_SERVER['REQUEST_URI']);

/*echo "<pre>";
print_r("Route: " .$router->getRoute().PHP_EOL);
print_r("Lang: " .$router->getLanguages().PHP_EOL);
print_r("Controller: " .$router->getController().PHP_EOL);
print_r("action: " .$router->getMethodPrefix()." ".$router->getAction().PHP_EOL);
print_r("Parameters");
echo "<pre>";
print_r($router->getParams());*/
App::run($_SERVER['REQUEST_URI']);