<?php
/**
 * Created by PhpStorm.
 * User: simona
 * Date: 29/09/2018
 * Time: 08:00
 */

namespace App\Controllers;
use \Core\View;
use App\Models\LoginModel;
require '..\vendor\autoload.php';
class Login extends \Core\Controller
{

    public $message;
    public $username;
    public $password;
    public $user=[];

    public function indexAction()
    {

        View::renderTemplate('Home/login.html');

        //require_once __DIR__."/../templates/login.php";

    }

    public function loginAction()
    {
        $username = $_POST['username'];
        $password = $_POST['password'];

        if (($username != NULL) && ($password != NULL)) {
            $query = LoginModel::getLoginDetails($this->username, $this->password);

        } else {
            die("both fields have to be filled in");
        }
        View::renderTemplate('Home/login2.html');
        //echo $this->message."</br>";
        echo "welcome " . $this->username;

        $user=LoginModel::getLoginDetails($this->username,$this->password);
        echo $user['user_id'];
        //echo "welcome " . $this->username." ".$this->user;



    }









}
