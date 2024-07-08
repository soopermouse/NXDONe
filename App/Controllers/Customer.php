<?php
namespace App\Controllers;
use \Core\View;
use \Core\Rebuy;
use \Core\Order;
use App\Models\RebuyModel;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '..\vendor\autoload.php';


class Customer extends \Core\Controller
{
    public function activateAction()
    {
        $id = $this->route_params['id'];
        return $id;
    }


        public function indexAction()
    {

       // $results = CustomerModel::getCustomers();
        View::renderTemplate('Customer/index.html'
            //, [
           // 'results' => $results
       // ]
    );

    }





}








