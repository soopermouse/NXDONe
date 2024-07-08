

<?php
/**
 * Created by PhpStorm.
 * User: SimonaThrussell
 * Date: 07/09/2018
 * Time: 12:06
 */

//use Core\Router as Router;
session_start();
require_once dirname(__DIR__).'/vendor/autoload.php';


$dir= dirname(__FILE__);

echo 'Requested URL = "'.$_SERVER['QUERY_STRING'].'"';




/**
 * Error and Exception handling;
 */
error_reporting(E_ALL);
set_error_handler('Core\Error::errorHandler');
set_exception_handler('Core\Error::exceptionHandler');
/**
 * Routing
 *
 **/


$router=new Core\Router();
//echo get_class($router);
$router->add('',['controller'=>'Home','action'=>'index']);
$router->add('login',['controller'=>'Home','action'=>'login']);

//$router->add('rebuy',['controller'=>'Rebuy','action'=>'index']);
//$router->add('rebuy/inspect',['controller'=>'Rebuy','action'=>'inspect']);
//$router->add('rebuy/overview',['controller'=>'Rebuy','action'=>'overview']);
$router->add('{controller}/{action}');
$router->add('admin/{action}/{controller}');
$router->add('{controller}/{id:\d+}/{action}');
$router->add('admin/{controller}/{action}',['namespace'=>'Admin']);
$router->add('user',['controller'=>'User','action'=>'index']);
$router->add('admin/{controller}/{action}',['namespace'=>'Admin']);

$url=$_SERVER['QUERY_STRING'];

$router->dispatch($_SERVER['QUERY_STRING']);