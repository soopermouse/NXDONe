<?php
/**
 * Created by PhpStorm.
 * User: SimonaThrussell
 * Date: 27/02/2019
 * Time: 09:05
 */

namespace App\Controllers;
use App\Helpers\Validate;
use App\Models\EventModel;
use App\Models\InspectionModel;
use App\Models\InventoryModel;
use App\Models\ReturnModel;
use Core\Offer;
use \Core\View;
use \Core\Customer;
use \Core\Order;
use \Core\Device;
use App\Models\RebuyModel;
use App\Models\CustomerModel;
use App\Models\OrderModel;
use App\Models\FinanceModel;
use App\Models\DeviceModel;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
//local setup
require '..\vendor\autoload.php';


class Returns extends \Core\Controller
{
    public function indexAction()
    {
        $results=ReturnModel::getReturns();
        View::renderTemplate('Returns/index.html',
            ['results'=>$results]);
    }

    public function checkorderAction()
    {
        View::renderTemplate('Returns/checkorder.html');
    }

    public function testReturnAction()
    {
        View::renderTemplate('Returns/testreturn.html');

    }

    public function reportsAction()
    {
        View::renderTemplate('Returns/reports.html');

    }

    public function enterreturnAction()
    {
       print_r($_POST);
        if(isset($_POST['order_id'])&&!(empty($_POST['order_id']))){

            echo $order_id=$_POST['order_id'];
            $results=ReturnModel::checkReturnbyorderid($order_id);
        }elseif(isset($_POST['imei']))
        {
            //echo "lol";
            echo $imei=$_POST['imei'];
            $results=ReturnModel::checkReturnbyimei($imei);
        }
        View::renderTemplate('Returns/enterreturn.html',
            [
                'results'=>$results
            ]

        );

    }


}