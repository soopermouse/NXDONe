<?php
/**
 * Created by PhpStorm.
 * User: SimonaThrussell
 * Date: 01/10/2018
 * Time: 09:30
 */

namespace App\Controllers;
use \Core\View;
use App\Models\SDModel;
require 'C:\xampp2\htdocs\FORZAERP\erpdemo\vendor\autoload.php';
//require 'C:\xampp\htdocs\FORZAERP\vendor\autoload.php';

class CS extends \Core\Controller
{
    public function indexAction()
    {

        $results = SDModel::getOrders();
        View::renderTemplate('SD/index.html'
            //['results'=>$results]
        );

    }
}