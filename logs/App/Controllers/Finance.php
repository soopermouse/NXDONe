<?php
/**
 * Created by PhpStorm.
 * User: simona
 * Date: 28/09/2018
 * Time: 16:57
 */

namespace App\Controllers;
use \Core\View;
use App\Models\FinanceModel;
require 'C:\xampp2\htdocs\FORZAERP\erpdemo\vendor\autoload.php';
//require 'C:\xampp\htdocs\FORZAERP\vendor\autoload.php';

class Finance extends \Core\Controller
{
    public function indexAction()
    {
        //$results=RebuyModel::getOrders();
        View::renderTemplate('Finance/index.html'
            //['results'=>$results]
        );
    }


}