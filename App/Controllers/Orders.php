<?php
/**
 * Created by PhpStorm.
 * User: SimonaThrussell
 * Date: 06/12/2018
 * Time: 10:20
 */
namespace App\Controllers;
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
require '..\vendor\autoload.php';
class Orders extends \Core\Controller

{

    public function indexAction()
    {
        $results=OrderModel::getSaleOrders();
        View::renderTemplate('Orders/index.html',[
            'results'=>$results
        ]);


    }

    public function activateAction()
    {
        $id = $this->route_params['id'];
        return $id;
    }

    public function enterorderAction()
    {
        View::renderTemplate('Orders/enterorder.html');


    }

    public function entersubmitAction()
    {

        View::renderTemplate('Orders/entersubmit.html');

        $devicetype = $_POST['device_type'];
        $devicestorage = $_POST['device_storage'];
        $deviceconnection = $_POST['device_connection'];
        $devicegrade = $_POST['device_condition'];
        $devicecolour = $_POST['device_colour'];
        $deviceprice=$_POST['device_price'];
        $firstname=$_POST['first_name'];
        $lastname=$_POST['last_name'];
        $email=$_POST['email'];
        $phone=$_POST['phone'];
        $customer_type=$_POST['customer_type'];
        $postcode=$_POST['postcode'];
        $streetnumber=$_POST['street_number'];
        $addition=$_POST['addition'];
        $streetname=$_POST['street_name'];
        $city=$_POST['city'];
        $country=$_POST['country'];

        $paymenttype=$_POST['payment_type_id'];
      
        echo '<pre>';
        var_dump($_POST);


       $customer_id= CustomerModel::createCustomer($firstname,$lastname,$email,$phone, $customer_type);
        echo '<pre>';
        echo " customer id ".$customer_id. " has been created";
        $query=CustomerModel::createAddress($customer_id,$postcode,$streetnumber,$addition,$streetname,$city,$country);
        // RebuyModel::OrderSubmit($order_id, $devicetype, $devicestorage, $deviceconnection, $devicecondition, $devicecolour);
        echo $query;
        $order_id=OrderModel::createSaleOrder($customer_id,$paymenttype,$deviceprice);
        echo $order_id ." has been created";

       echo  $device=OrderModel::CreateOrderDevice($order_id,$devicetype,$devicestorage,$deviceconnection,$devicegrade,$devicecolour);
        echo $status=OrderModel::makeStatus($order_id)."</br>";
        //echo $shipping=RebuyModel::createShippingStatus($order_id);
        echo $payment=FinanceModel::createSalePaymentData($order_id,$customer_id,$paymenttype,$deviceprice);
        echo $warranty=OrderModel::createWarranty($order_id);

    }


    public function pickordersAction()
    {
        $results=OrderModel::getPickOrders();
        View::renderTemplate('Orders/pickorders.html',[
            'results'=>$results
        ]);
    }

    public function pickorderAction()
    {
        $order_id=$this->activateAction();
        $_SESSION['order_id']=$order_id;
        $results=OrderModel::getSaleOrder($order_id);

        View::renderTemplate('Orders/pickorder.html',[
            'results'=>$results
        ]);
    }

    public function picksubmitAction()
    {
        $order_id=$_SESSION['order_id'];
        View::renderTemplate('Orders/picksubmit.html');
        if(isset($_POST['submit']))
        {
            $imei=$_POST['imei'];
            $pickorder=OrderModel::setIMEI($order_id,$imei);
            $update=OrderModel::updateWarrantyImei($order_id,$imei);
            $status=OrderModel::updateOrderStatus(5,$order_id);
        }

    }

    public function shipordersAction()
    {
        View::renderTemplate('Orders/shiporders.html');
    }



}