<?php
/**
 * Created by PhpStorm.
 * User: SimonaThrussell
 * Date: 01/10/2018
 * Time: 09:41
 */
namespace App\Controllers;
use \Core\View;
use App\Models\LogisticsModel;
require 'C:\xampp2\htdocs\FORZAERP\erpdemo\vendor\autoload.php';
//require 'C:\xampp\htdocs\FORZAERP\vendor\autoload.php';
class Logistics extends \Core\Controller
{
    public function indexAction()
    {


        View::renderTemplate('Logistics/index.html'

        );

    }
}