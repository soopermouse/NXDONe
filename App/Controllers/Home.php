<?php
/**
 * Created by PhpStorm.
 * User: simona
 * Date: 24/09/2018
 * Time: 09:09
 */

namespace App\Controllers;
use \Core\View;
use App\Models\LoginModel;
require '..\vendor\autoload.php';
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
        $username = $_POST['username'];
        $password = $_POST['password'];

        if (($username != NULL) && ($password != NULL)) {
           echo $query = LoginModel::getLoginDetails($username, $password);

        } else {
            die("both fields have to be filled in");
        }
        View::renderTemplate('Home/dologin.html');



    }

    public function login2Action()
    {


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