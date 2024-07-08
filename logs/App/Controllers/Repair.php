<?php
/**
 * Created by PhpStorm.
 * User: SimonaThrussell
 * Date: 01/10/2018
 * Time: 09:41
 */
namespace App\Controllers;
use App\Models\DeviceModel;
use \Core\View;
use App\Models\RepairModel;

require 'C:\xampp2\htdocs\FORZAERP\erpdemo\vendor\autoload.php';
//require 'C:\xampp\htdocs\FORZAERP\vendor\autoload.php';
class Repair extends \Core\Controller
{
    public function indexAction()
    {

        //$results = RebuyModel::getOrders();
        View::renderTemplate('Repair/index.html'
            //['results'=>$results]
        );

    }

    public function activateAction()
    {
        $id = $this->route_params['id'];
        return $id;
    }

    public function getfailcardAction()
    {
        $order_id=$this->activateAction();

        $lookup=DeviceModel::getIMEI($order_id);
        $imei=$lookup[0]['IMEI'];
        $results=RepairModel::getfailcard($imei);
        View::renderTemplate('Repair/index.html',
        ['results'=>$results]
        );


    }
}