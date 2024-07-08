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
require 'C:\xampp2\htdocs\FORZAERP\erpdemo\vendor\autoload.php';
//require 'C:\xampp\htdocs\FORZAERP\vendor\autoload.php';
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
        $this->username = $_POST['username'];
        $this->password = $_POST['password'];

        if (($this->username != NULL) && ($this->password != NULL)) {
            $query = LoginModel::getLoginDetails($this->username, $this->password);

        } else {
            die("both fields have to be filled in");
        }
        View::renderTemplate('Home/login2.html');
        //echo $this->message."</br>";
        echo "welcome " . $this->username;

        $this->user=LoginModel::getLoginDetails($this->username,$this->password);
        echo $this->user['user_id'];
        //echo "welcome " . $this->username." ".$this->user;



    }









}
