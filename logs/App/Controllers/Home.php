<?php
/**
 * Created by PhpStorm.
 * User: simona
 * Date: 24/09/2018
 * Time: 09:09
 */

namespace App\Controllers;
use \Core\View;
require 'C:\xampp2\htdocs\FORZAERP\erpdemo\vendor\autoload.php';
//require 'C:\xampp\htdocs\FORZAERP\vendor\autoload.php';
class Home extends \Core\Controller
{
   public function indexAction()
   {

       View::renderTemplate('Home/index.html',[
               'name'=>'Mouse',
               'colours'=>['red','green','yellow']

           ]
           );

   }

       public function loginAction()
    {
        View::renderTemplate('Home/login.html');

    }

    public function dologinAction()
    {
        View::renderTemplate('Home/dologin.html');
        $username=$_POST['username'];
        $password=$_POST['password'];


    }



   protected function before()
    {
        //echo "(before) ";
        //return false;
    }

    protected function after()
    {
        //echo "(after) ";
    }



}