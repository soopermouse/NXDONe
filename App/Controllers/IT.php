<?php
/**
 * Created by PhpStorm.
 * User: SimonaThrussell
 * Date: 01/02/2019
 * Time: 10:52
 */

namespace App\Controllers;
use App\Models\EventModel;
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
class IT extends \Core\Controller
{
    public function indexAction()
    {


        //$results=ITModel::getStatus();
        View::renderTemplate('IT/index.html'
            //, [

            //'results'=> $results
       // ]
    );

    }








}