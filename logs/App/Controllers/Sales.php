<?php
/**
 * Created by PhpStorm.
 * User: SimonaThrussell
 * Date: 01/10/2018
 * Time: 09:28
 */
namespace App\Controllers;
use \Core\View;
use App\Models\SalesModel;
require 'C:\xampp2\htdocs\FORZAERP\erpdemo\vendor\autoload.php';
//require 'C:\xampp\htdocs\FORZAERP\vendor\autoload.php';

class Sales extends \Core\Controller
{
    public function indexAction()
    {

        //$results = RebuyModel::getOrders();
        View::renderTemplate('Sales/index.html'
            //['results'=>$results]
        );

    }
}