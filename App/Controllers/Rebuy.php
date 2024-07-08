<?php
/**
 * Created by PhpStorm.
 * User: simona
 * Date: 28/09/2018
 * Time: 16:57
 */

namespace App\Controllers;
use App\Helpers\Checkstatus;
use App\Helpers\mail;
use App\Helpers\Validate;
use App\Models\EventModel;
use App\Models\InspectionModel;
use App\Models\InventoryModel;
use App\Models\SalesModel;
use App\Models\StatusModel;
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
use App\Models\RepairModel;
use App\Models\ActionModel;
use App\Models\SuppliersModel;
//local setup
require '..\vendor\autoload.php';


class Rebuy extends \Core\Controller
{
    public function indexAction()
    {


        $results = rebuyModel::getStatus();
        View::renderTemplate('Rebuy/index.html', [

            'results' => $results
        ]);

    }

    public function activateAction()
    {
        $id = $this->route_params['id'];
        return $id;
    }

    public function latestordersAction()
    {
        $results = RebuyModel::getOrders();
        View::renderTemplate('Rebuy/latestorders.html', [
            'results' => $results,

        ]);

    }

    public function inspectionAction()
    {
        $results = RebuyModel::getInspection();
        View::renderTemplate('Rebuy/inspection.html', [
            'results' => $results
        ]);

    }

    public function inspectAction()
    {

        $device_id = $this->activateAction();
        $imei=RebuyModel::getIMEIbyDeviceId($device_id);

      $message = print_r($results = RebuyModel::getDevice($imei));
        View::renderTemplate('Rebuy/inspect.html'
           , [
           'results' => $results
           , 'message' => $message
        ]
    );


    }

    public function editAction()
    {
        $results = RebuyModel::getOrders();
        View::renderTemplate('Rebuy/edit.html', [
            'results' => $results
        ]);
    }

    public function mailaction()
    {

        $results = RebuyModel::getQuoted();
        View::renderTemplate('Rebuy/mail.html', [
            'results' => $results
        ]);
        //use php mailer script in rebuy/mail.php

    }

    public function sendmailAction()
    {

        $order_id = $this->activateAction();

        $quote = RebuyModel::getOrderQuotes($order_id);
        $details = CustomerModel::getRebuyCustomerData($order_id);
        // echo '<pre/>';
        //print_r($details);
        $firstname = $details['customer_first_name'];
        $lastname = $details['customer_last_name'];
        $email = $details['customer_email'];
        echo $firstname . '</br>' . $lastname . '</br>' . $email;
        $results = RebuyModel::getOrderOffers($order_id);
        //print_r($results);
        $setquote = RebuyModel::setOrderQuote($order_id, 1, $quote);
        View::renderTemplate('Rebuy/sendmail.html'
            , [
                'results' => $results,
                'quote' => $quote,
                'details' => $details,
                'firstname' => $firstname,
                'lastname' => $lastname,
                'email' => $email

            ]
        );

    }

    public function inspectsubmitAction()

    {

        $device_id= $this->activateAction();
        $IMEI=RebuyModel::getIMEIbyDeviceId($device_id);
        //$order_id=RebuyModel::getOrderIdbyImei($IMEI);
        $date = date('Y-m-d');
        $devicetype = $_POST['device_type'];
        $devicestorage = $_POST['device_storage'];
        $deviceconnection = $_POST['device_connection'];
        $devicecondition = $_POST['device_condition'];
        $devicecolour = $_POST['device_colour'];
        //$images=$_POST['images'];
        $devicecomments = $_POST['device_comments'];
       // $device_id = RebuyModel::getDeviceId($IMEI);
        $query = RebuyModel::InspectSubmit($device_id, $devicetype, $devicestorage, $deviceconnection, $devicecondition, $devicecolour, $devicecomments, $date, $IMEI);
        $status = StatusModel::updateForzaRebuyDeviceStatus(16, $IMEI);
        $action = ActionModel::setRebuyDeviceAction(18, $IMEI);
        //$devicestatus=StatusModel::updateRebuyDeviceStatus(3,1,7,$IMEI);


        $event = EventModel::CreateEvent(1, 1, $IMEI, 1);
        // $device_id=DeviceModel::getDeviceId($IMEI);
        $entry = DeviceModel::updateNewDevice($devicetype, $devicestorage, $deviceconnection, $devicecolour, $IMEI);
        $update = DeviceModel::updateRebuyDevice($devicetype, $devicestorage, $devicecondition, $deviceconnection, $devicecolour, $IMEI);
        $message = $query . "</br>" . $status . "</br>" . $action . "</br>" . "event id " . $event . "has been created</br>" . $entry;
        sleep(5);
        $results = RebuyModel::getInspectionById($IMEI);

        View::renderTemplate('Rebuy/inspectsubmit.html'
            , [
                'results' => $results
                , 'message' => $message

            ]
        );


    }


    public function orderstatusAction()
    {
        $results = RebuyModel::getOrderStatus();
        View::renderTemplate('Rebuy/orderstatus.html', [
            'results' => $results
        ]);

    }


    public function mailsentAction()
    {
        $order_id = $this->activateAction();


        //echo '<pre>';
        //var_dump($_POST);

        $name = $_POST['firstname'] . ' ' . $_POST['lastname'];

        $email = $_POST['email'];
        $subject = "Offer from Forza";
        $quote = $_POST['quote'];

        $mail = mail::sendmail($name, $email, $subject, $order_id, $quote);
        $devices = RebuyModel::getOrderDevices($order_id);
        foreach($devices as $device)
        {
            $imei=$device['device_imei'];
            $devicestatus=StatusModel::updateForzaRebuyDeviceStatus(9,$imei);
            $deviceaction=ActionModel::setRebuyDeviceAction(14,$imei);
        }

       $orderstatus=RebuyModel::updateFStatus(4,$order_id);
        $orderaction=RebuyModel::setAction(12,$order_id);
        View::renderTemplate('Rebuy/mailsent.html'
        // ,[
        //   'message'=>$message
        //]
        );

    }

    public function checkordersAction()
    {
        $results = RebuyModel::getCheck();
        View::renderTemplate('Rebuy/checkorders.html', [
            'results' => $results
        ]);


    }

    public function checkAction()
    {
        $device_id = $this->activateAction();
        //$results = RebuyModel::getDevice($order_id);
        View::renderTemplate('Rebuy/check.html');
    }

    public function checksubmitAction()
    {
        $device_id = $this->activateAction();

        //echo '<pre>';
        //var_dump($_POST['check']);
        if (isset($_POST['check'])) {
            if (empty($_POST['IMEI'])) {

                die("IMEI not present. Please go back and enter it.");


            } else {
                $validate = Device::validateIMEI($_POST['IMEI']);
                $IMEI = $_POST['IMEI'];
            }


            if (empty($_POST['check'])) {
                echo "No options were checked";


            } else {
                $check = $_POST['check'];


                $N = count($check);
                if ($N == 3 && isset($IMEI)) {

                    echo "check passed!";
                    $checked = 1;
                    $stolen = 0;
                    $date = date('Y-m-d');
                    $count = InventoryModel::getDevice($IMEI);
                    if ($count == 0) {
                        $query = RebuyModel::checksubmit($device_id, $IMEI, $checked, $stolen);
                        $check = RebuyModel::checkupdate($IMEI, $device_id);
                        echo $query . " has been set";
                        if (is_numeric($query)) {
                            //$message = "check submitted";
                            $status = StatusModel::updateForzaRebuyStatuscheck(4, $IMEI, $device_id);
                            echo $status . "has bene set </br>";
                            $action = ActionModel::setRebuyCheckAction(6, $device_id);
                            echo "action " . $action . "has bene set ";
                            //$order_date=RebuyModel::getOrderdate($order_id);
                            //$devicestatus=StatusModel::updateRebuyDeviceStatus(4,1,6,$order_id,$IMEI);

                            $event = EventModel::CreateEvent(1, 2, $IMEI, 1);

                            $inv = DeviceModel::addToInventory($IMEI, 1);
                            $new = DeviceModel::makeNewDevice($IMEI);
                            //$message=$query."was created </br>".$status." was created </br>".$action."was created </br>"."event id " . $event." was created</br>".$inv." was moved</br>"."device id " . $new."was created</br>".
                            //$status."was updated</br>".$action."was updated";
                        } else {
                            echo "An Error has ocurred";
                        }
                    } elseif ($count == 1) {
                        $move = InventoryModel::movedeviceLocation(1, $IMEI);
                        $status = StatusModel::updateForzaRebuyStatuscheck(4, $IMEI, $device_id);
                        $action = ActionModel::setRebuyCheckAction(6, $device_id);
                        $check = RebuyModel::checkupdate($IMEI, $device_id);
                        $query = RebuyModel::checksubmit($device_id, $IMEI, $checked, $stolen);
                        $event = EventModel::CreateEvent(1, 2, $IMEI, 1) . "has been created";
                        $message = $move . "</br>" . $status . "</br>" . $action . "</br>" . "event id " . $event;
                    }

                    // $message1=OrderModel::updateRebuyDevice($order_id,$IMEI);
                } else {
                    $note = "the device did not pass check, please see notes.";
                    $checked = 0;
                    $date = date('Y-m-d');
                    // $query = RebuyModel::checksubmit($IMEI, $checked, $order_id,$date);
                    //$status = StatusModel::updateForzaRebuyStatus(5, $order_id);
                    // $action = ActionModel::setRebuyDeviceAction(4, $order_id);
                    //$message=$note."</br>".$query."</br>".$status."</br>".$action;

                }
            }

        } else {

            $message = "no data was submitted";
        }

        sleep(5);
        //$results=RebuyModel::getActionButtons($order_id);
        View::renderTemplate('Rebuy/checksubmit.html'
            , [
                //'results'=>$results
                // 'message'=>$message
                //   //,'message1'=>$message1
                'device_id'=>$device_id
            ]
        );


    }

    public function checkdeviceAction()
    {

        $order_id = $this->activateAction();

        $results = RebuyModel::getDevice($order_id);
        View::renderTemplate('Rebuy/checkdevice.html', [
            'results' => $results
        ]);
        $_SESSION['order_id'] = $order_id;

    }

    /*public function checkdevicesubmit()
    {
        $order_id = $_SESSION['order_id'];

        //$order_id=$this->activateAction();


        $IMEI = RebuyModel::getIMEI($order_id);
        $date = date('Y-m-d');
        $devicetype = $_POST['device_type'];
        $devicestorage = $_POST['device_storage'];
        $deviceconnection = $_POST['device_connection'];
        $devicecondition = $_POST['device_condition'];
        $devicecolour = $_POST['device_colour'];
        //$images=$_POST['images'];
        $devicecomments = $_POST['device_comments'];
        $query = RebuyModel::InspectSubmit($order_id, $devicetype, $devicestorage, $deviceconnection, $devicecondition, $devicecolour, $devicecomments, $date, $IMEI);
        $status = StatusModel::updateForzaRebuyDeviceStatus(16, $order_id);
        $action = ActionModel::setRebuyDeviceAction(7, $IMEI);


        echo "event id " . $event = EventModel::CreateEvent(1, 1, $IMEI, 1) . "has been created";
        $device_id = DeviceModel::getDeviceId($IMEI);
        echo $entry = DeviceModel::makeDevice($IMEI, $devicetype, $devicestorage, $deviceconnection, $devicecolour);
        sleep(5);
        $results = RebuyModel::getInspectionById($order_id);
        View::renderTemplate('Rebuy/inspectsubmit.html', [
            'results' => $results

        ]);


    }*/


    public function reportsAction()
    {
        View::renderTemplate('Rebuy/reports.html'
        //, [
        //  'results' => $results
        //]
        );

    }

    public function quoteAction()
    {
        $device_id= $this->activateAction();
        $imei=RebuyModel::getIMEIbyDeviceId($device_id);
        //$order_id=RebuyModel::getOrderIdbyImei($imei);
        $results = RebuyModel::getInspectionById($imei);
        View::renderTemplate('Rebuy/quote.html', [
            'results' => $results
        ]);

    }


    public function quoteordersAction()
    {
        $results = RebuyModel::getInspected();
        View::renderTemplate('Rebuy/quoteorders.html', [
            'results' => $results
        ]);

    }


    public function submitquoteAction()
    {
        $device_id= $this->activateAction();
        $imei=RebuyModel::getIMEIbyDeviceId($device_id);
        $order_id = RebuyModel::getOrderIdbyImei($imei);

        $quote = $_POST['quote'];
        $offer_type = "first offer";
        //$offer=new Offer($quote,$imei,$order_id,$offer_type);
        //$offer_id=Offer::makerebuyOrderOffer($quote,$imei,$order_id);
        //print_r($offer_id);
        $update = RebuyModel::setAccepted($imei, $order_id, 0);
        $query = RebuyModel::SubmitQuote($order_id, $quote, $imei);


        $devicestatus = StatusModel::updateRebuyDeviceStatus(17, 1, 8, $imei);
        //echo '<pre>';
        $results = RebuyModel::getDeviceQuote($imei);
        //print_r($results);
        $status = RebuyModel::getOrderDevicesStatus($order_id);
        //print_r($status);
        $state = Checkstatus::checkstatus($status, 17);
        //echo 'the order device status is '. $state;
        echo $state;
        if ($state == true) {
            $query = RebuyModel::updateFStatus(9, $order_id);
            $action = RebuyModel::setAction(4, $order_id);
            $deviceaction=ActionModel::setRebuyDeviceAction(19,$imei);
            $message= "order status updated, all devices have been processed and are ready for the next step";

        } else {
            $message= "order devices not completely processed";
            $deviceaction=ActionModel::setRebuyDeviceAction(19,$imei);
        }
        View::renderTemplate('Rebuy/submitquote.html'
            ,
            [
                'results' => $results,
                'message'=>$message

            ]
        );


    }

    public function overviewAction()
    {

        $results = RebuyModel::Overview();
        View::renderTemplate('Rebuy/overview.html', [
                'results' => $results
            ]
        );

    }


    public function enterorderAction()
    {

        View::renderTemplate('Rebuy/enterorder.html');


    }


    public function entersubmitAction()
    {

        // echo '<pre>';
        // var_dump($_POST);
        //var_dump($_POST['device1']["quantity1"]);

        //IF(($_POST['device1']["quantity1"])==1)
        //{

        //}
        /*if(($_POST['device1']['quantity1'])>0)
        {
            $device1=[
                'model'=>$_POST[0]['device1']['model'],
                'storage'=>$_POST[0]['device1']['storage'],
                'quote1'=>$_POST[0]['device1']['quote1'],
                'grade1'=>$_POST[0]['device1']['grade1'],
                'quantity'=>$_POST[0]['device1']['quantity1']
            ];
            print_r($device1);
        }*/
        /*$devicetype = $_POST['device_type'];
        $devicestorage = $_POST['device_storage'];
        $deviceconnection = $_POST['device_connection'];
        $devicecondition = $_POST['device_condition'];
        $devicecolour = $_POST['device_colour'];
        $quantity=$_POST['quantity'];*/

        $firstname = $_POST['first_name'];
        $lastname = $_POST['last_name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $customer_type = $_POST['customer_type'];
        $postcode = $_POST['postcode'];
        $streetnumber = $_POST['street_number'];
        $addition = $_POST['addition'];
        $streetname = $_POST['street_name'];
        $city = $_POST['city'];
        $country = $_POST['country'];

        $paymenttype = $_POST['payment'];
        $IBAN = $_POST['IBAN'];
        $Tnv = $_POST['Tnv'];


        $customer_id = CustomerModel::createCustomer($firstname, $lastname, $email, $phone, $customer_type);
        echo "customer " . $customer_id . " was created </br>";
        $address = CustomerModel::createAddress($customer_id, $postcode, $streetnumber, $addition, $streetname, $city, $country);
        echo "address" . $address . " was created </br>";

        $order_id = OrderModel::createRebuyOrder($customer_id, $paymenttype);
        echo "order " . $order_id . " was created </br>";
        //$order=RebuyModel::OrderSubmit($order_id, $devicetype, $devicestorage, $deviceconnection, $devicecondition, $devicecolour);

        //$device=DeviceModel::makeRebuyDevice($order_id,$devicetype,$devicestorage,$deviceconnection,$devicecondition);
        $status = RebuyModel::makeRebuyOrderStatus($order_id);
        echo "status " . $status . "was created </br>";
        $shipping = RebuyModel::createShippingStatus($order_id);
        echo "shipping status " . $shipping . " was created </br>";
        $payment = FinanceModel::createPaymentData($customer_id, $order_id, $IBAN, $Tnv);
        echo "payment " . $payment . "was created </br>";
        $device1 = $_POST['device1'];
        $device2 = $_POST['device2'];
        $device3 = $_POST['device3'];
        $device4 = $_POST['device4'];
        $device5 = $_POST['device5'];
        $device6 = $_POST['device6'];
        $device7 = $_POST['device7'];
        $device8 = $_POST['device8'];
        $device9 = $_POST['device9'];

        $devices = array($device1, $device2, $device3, $device4, $device5, $device6, $device7, $device8, $device9);
        foreach ($devices as $device) {
            $device_model = $device['model'];
            $device_storage = $device['storage'];
            $device_grade = $device['grade'];
            $device_quote = $device['quote'];
            $quantity = $device['quantity'];
            if ($device["quantity"] > 0) {
                print_r($device);
                $new = OrderModel::addDeviceToRebuyOrder($order_id, $device_model, $device_storage, $device_grade, $device_quote, $quantity);
                $i = 1;
                echo $new . " has been added to the order " . $order_id;

                do {
                    $device = DeviceModel::makeRebuyDevice($order_id, $device_model, $device_storage, 3, $device_grade);
                    $devicestatus = StatusModel::makerebuydevicestatus($order_id, $device, 1, 1, 1, 1);
                    //print_r($device);
                    echo $new . "device was created";
                    echo $devicestatus . " device status was created";
                    $i++;
                } while ($i <= $quantity);


            }
        }
        /* $message='Created customer id ' .$customer_id."</br>"."created address ".$query."</br>"."created order id ".$order_id."</br>"."created status". $status."</br>"."created shipping ".$shipping."</br>"."created payment".$payment;*/
        View::renderTemplate('Rebuy/entersubmit.html'
        // ,
        //[
        //  'message'=>$message

        // ]
        );
    }

    public function serviceAction()
    {
        View::renderTemplate('Rebuy/service.html');

    }

    public function setstatusAction()
    {
        $order_id = $this->activateAction();
        $results = RebuyModel::setStatus($order_id);
        View::renderTemplate('Rebuy/setstatus.html', [
            'results' => $results
        ]);
        echo '<pre>';
        var_dump($results);
        foreach ($results as $result) {
            $co = $results["customer_order_status"];
            $fo = $results["forza_order_status"];
            echo $co;
            echo $fo;


        }


    }

    public function acceptQuoteAction()
    {
        $order_id = $this->activateAction();
        $quote = RebuyModel::getOrderQuote($order_id,1);
        print_r($quote);
        $results = RebuyModel::getOrderOffers($order_id);
        View::renderTemplate('Rebuy/acceptquote.html'
            , [
                'results' => $results,
                'quote' => $quote
            ]
        );


    }


    public function confirmAction()
    {
        $order_id = $this->activateAction();


        //echo $order_id;
        $offer_type = 'first offer';
        $date = date('Y-m-d');
        $quote = RebuyModel::getOrderQuote($order_id);
        //$accepted=1;
        $devices = RebuyModel::getOrderDevices($order_id);
        print_r($devices);
        $accept = RebuyModel::acceptOrderOffer($order_id, 1, 1);
        $status = RebuyModel::updateFStatus(5, $order_id);
        $action = RebuyModel::setAction(7, $order_id);

        //$acceptdevicesoffer=RebuyModel::acceptOffer($accepted,$order_id,$imei);


        //$devicestatus=StatusModel::updateRebuyDeviceStatus(11,4,9,$imei);

        View::renderTemplate('Rebuy/confirm.html'

        );


    }

    public function refuseoptionsAction()
    {
        $order_id = $this->activateAction();
        $results = RebuyModel::getQuote($order_id);

        //echo $order_id;
        $offer_type = 'first offer';
        $date = date('Y-m-d');
        $status = RebuyModel::updateFStatus(12, $order_id);
        $action = RebuyModel::setAction(6, $order_id);
        $cstatus = RebuyModel::UpdateOrderCustomerStatus(5, $order_id);
        $accept = RebuyModel::acceptOrderOffer($order_id, 0, 1);

        View::renderTemplate('Rebuy/refuseoptions.html');

    }


    public function addtagsAction()
    {

        $results = RebuyModel::getOrders();
        View::renderTemplate('Rebuy/addtags.html', [
                'results' => $results
            ]
        );


    }

    public function tagordersAction()
    {
        View::renderTemplate('Rebuy/tagorders.html');
    }

    public function tagorderAction()
    {

        $order_id = $this->activateAction();
        $results = RebuyModel::getRebuyOrder($order_id);
        View::renderTemplate('Rebuy/tagorder.html'
            , [
                'results' => $results
            ]);
    }

    public function addtagAction()
    {

        $order_id = $this->activateAction();
        //echo $order_id=$_POST['order_id'];
        $sales_tag = $_POST['sales_tag'];
        $add = SalesModel::addtag($order_id, $sales_tag);
        View::renderTemplate('Rebuy/addtag.html');

    }


    public function devicereceivedAction()
    {
        $results = RebuyModel::Shipping();
        View::renderTemplate('Rebuy/devicereceived.html', [
                'results' => $results
            ]
        );


    }

    public function ordereditAction()
    {
        $order_id = $this->activateAction();
        $results = RebuyModel::GetOrders();
        View::renderTemplate('Rebuy/devicereceived.html', [
                'results' => $results
            ]
        );

    }

    public function shippingAction()
    {
        $results = RebuyModel::getShipping();
        View::renderTemplate('Rebuy/shipping.html', [
                'results' => $results
            ]
        );


    }

    public function editshippingAction()
    {
        $order_id = $this->activateAction();
        $_SESSION['order_id'] = $order_id;
        $results = RebuyModel::getShippingById($order_id);
        View::renderTemplate('Rebuy/editshipping.html', [
                'results' => $results
            ]
        );


    }

    public function shippingupdateAction()
    {
        //$order_id=$this->activateAction();
        $order_id = $_SESSION['order_id'];
        if (isset($_POST['submit'])) {
            //var_dump($_POST['submit']);
            $status = $_POST['status'];
            $query = RebuyModel::updateShipping($status, $order_id);

            switch ($status) {
                case 3:
                    $fstatus = 2;
                    $query = RebuyModel::updateFStatus(2, $order_id);
                    $update = RebuyModel::setAction(2, $order_id);
                    $devicestatus = RebuyModel::massdeviceupdatestatus(3, 2, $order_id);

                    break;

                case 7:
                    $action = 1;
                    $query = RebuyModel::updateFStatus(7, $order_id);
                    $query2 = RebuyModel::setAction(1, $order_id);
                    break;

            }

        } else {

            echo "no info was sent";
        }
        $results = RebuyModel::getShippingById($order_id);
        View::renderTemplate('Rebuy/shippingupdate.html', [
                'results' => $results
            ]
        );


    }


    public function secondOfferAction()
    {
        //$order_id=$this->activateAction();
        $results = RebuyModel::getRefusedFirstOffers();
        View::renderTemplate('Rebuy/secondOffer.html', [
            'results' => $results
        ]);


    }

    public function submitsecondquoteAction()
    {
        $order_id = $this->activateAction();


        if (!empty($_POST)) {
            $quote = $_POST['quote'];
            $offer_type = 2;
            $offer_id = Offer::makerebuyOrderOffer($order_id, $offer_type, $quote, 0);
            // $update=RebuyModel::setAccepted($imei,$order_id);
            //echo $query = RebuyModel::submitSecondQuote($imei, $quote)." second quote entered";
            $action = RebuyModel::setAction(6, $order_id);

        } else {

            echo "please enter new offer";
        };
        sleep(5);


        // $query = RebuyModel::SubmitQuote($order_id,$quote,$imei);
        $results = RebuyModel::retrievesecondquote($order_id);

        View::renderTemplate('Rebuy/submitsecondquote.html', [
            'results' => $results

        ]);
    }

    public function entersecondofferAction()
    {
        $order_id = $this->activateAction();
        $check = RebuyModel::validateOrderOffer($order_id, 1);
        $results = RebuyModel::retrieveFirstOrderOffer($order_id);
        $devices = RebuyModel::getOrderOffers($order_id);

        View::renderTemplate('Rebuy/entersecondoffer.html'
            , [
                'results' => $results,
                'devices' => $devices
                
            ]
        );


    }

    public function sendsecofferAction()
    {
        $order_id = $this->activateAction();

        $results = RebuyModel::retrievesecondquote($order_id);
        // print_r($results);
        $name = $results[0]['customer_first_name'] . ' ' . $results[0]['customer_last_name'];
        echo $name;
        $email = $results[0]['customer_email'];
        echo $email;
        $subject = "second offer from Forza";
        $quote = $results[0]['quote'];
        echo $quote;
        $mail = Mail::sendsecondoffer($name, $email, $subject, $order_id, $quote);
        View::renderTemplate('Rebuy/sendsecoffer.html'
            , [
                'results' => $results
            ]
        );

    }

    public function ftstatusreportsAction()
    {


    }

    public function offersAction()
    {
        $results = RebuyModel::getOffers();
        View::renderTemplate('Rebuy/offers.html'
            , [
                'results' => $results
            ]
        );


    }

    public function paymentsAction()
    {
        $results = RebuyModel::getAcceptedOffers();
        View::renderTemplate('Rebuy/payments.html'
            , [
                'results' => $results
            ]
        );


    }


    public function returnsAction()
    {
        $results = RebuyModel::getReturns();
        View::renderTemplate('Rebuy/returns.html'
            , [
                'results' => $results
            ]
        );


    }

    public function recycleAction()
    {
        $device_id= $this->activateAction();
        $imei=RebuyModel::getIMEIbyDeviceId($device_id);

        $move = InventoryModel::movedeviceLocation(6, $imei);
        $fstatus = StatusModel::updateForzaRebuyDeviceStatus(8, $imei);
        $action = ActionModel::setRebuyDeviceAction(12, $imei);
        $status = RebuyModel::UpdateDeviceCustomerStatus(6, $imei);
        $devicestatus = StatusModel::updateRebuyDeviceStatus(8, 6, 12, $order_id, $imei);

        View::renderTemplate('Rebuy/recycle.html');


    }

    public function closeAction()
    {
        $results = RebuyModel::getClose();
        View::renderTemplate('Rebuy/close.html'
            , [
                'results' => $results
            ]
        );


    }

    public function closeorderAction()
    {
        $order_id = $this->activateAction();
        //$order_id=RebuyModel::getOrderIdbyImei($imei);
        $results = RebuyModel::getOrderToClose($order_id);
        View::renderTemplate('Rebuy/closeorder.html', [
            'results' => $results

        ]);

    }

    public function ordercloseAction()
    {
        $order_id = $this->activateAction();
        //$order_id=RebuyModel::getOrderIdbyImei($imei);
        //if(isset($_POST['submit']))
        //{
        //$result=RebuyModel::closeOrder($order_id);
        //echo $imei;
        //}
        View::renderTemplate('Rebuy/orderclose.html');
        echo $status = RebuyModel::updateFStatus(8, $order_id);
        echo $action = RebuyModel::setAction(11, $order_id);
        $devices = RebuyModel::getOrderDevicesImei($order_id);
        foreach ($devices as $device) {
            $imei = $device['device_imei'];
            $devicestatus = StatusModel::updateForzaRebuyDeviceStatus(15, $imei);

            $action = ActionModel::setRebuyDeviceAction(16, $imei);
        }


    }


    public function acceptedAction()
    {
        View::renderTemplate('Rebuy/accepted.html');

    }

    public function payAction()
    {
        $order_id = $this->activateAction();

        $results = RebuyModel::getPaymentDetails($order_id);
        View::renderTemplate('Rebuy/pay.html', [
            'results' => $results

        ]);


    }

    public function sendAction()
    {
        $order_id = $this->activateAction();

        $results = RebuyModel::getPaymentDetails($order_id);

        $status = RebuyModel::updateFStatus(7, $order_id);
        $action = RebuyModel::setAction(10, $order_id);
        //$update=InventoryModel::movedeviceLocation(2,$imei);
        $devices = RebuyModel::getOrderDevicesImei($order_id);
        foreach ($devices as $device) {
            $imei = $device['device_imei'];
            $devicestatus = StatusModel::updateForzaRebuyDeviceStatus(12, $imei);
            $location = InventoryModel::movedeviceLocation(2, $imei);
            $action = ActionModel::setRebuyDeviceAction(13, $imei);
        }
        $message = $status . "</br>" . $action . "</br>";
        View::renderTemplate('Rebuy/send.html'
            , [
                'results' => $results
                , 'message' => $message
            ]

        );
        // var_dump($results);


    }

    public static function refusedoffersAction()
    {
        $results = RebuyModel::getRefusedFirstOffers();
        View::renderTemplate('Rebuy/refusedoffers.html'
            , [
                'results' => $results

            ]);

    }

    public static function recycleordersAction()
    {
        $results = RebuyModel::getRecycle();

        View::renderTemplate('Rebuy/recycleorders.html'
            , [
                'results' => $results
            ]
        );

    }

    public function returndeviceAction()
    {
        $device_id= $this->activateAction();
        $imei=RebuyModel::getIMEIbyDeviceId($device_id);

        $status = RebuyModel::UpdateDeviceCustomerStatus(5, $imei);
        $action = ActionModel::setRebuyDeviceAction(15, $imei);
        $status = StatusModel::updateForzaRebuyDeviceStatus(8, $imei);
        $devicestatus = StatusModel::updateRebuyDeviceStatus(8, 5, 15, $imei);
        $message = $status . "</br>" . $action;
        View::renderTemplate('Rebuy/returndevice.html'
            , [
                'message' => $message
            ]);


    }

    public function secreturndeviceAction()
    {
        $device_id= $this->activateAction();
        $imei=RebuyModel::getIMEIbyDeviceId($device_id);

        $status = RebuyModel::UpdateDeviceCustomerStatus(5, $imei);
        $action = ActionModel::setRebuyDeviceAction(11, $imei);
        $status = StatusModel::updateForzaRebuyDeviceStatus(8, $imei);
        $devicestatus = StatusModel::updateRebuyDeviceStatus(8, 5, 11, $imei);
        $message = $status . "</br>" . $action;
        View::renderTemplate('Rebuy/secreturndevice.html'
            , [
                'message' => $message
            ]);


    }

    public function sendsecondoffermailAction()

    {
        $order_id = $this->activateAction();

        View::renderTemplate('Rebuy/sendsecondoffermail.html');
        $name = $_POST['firstname'] . ' ' . $_POST['lastname'];

        $email = $_POST['email'];
        $subject = "Second Offer from Forza";
        $quote = $_POST['quote'];

        $sendmail = mail::sendsecondoffer($name, $email, $subject, $order_id, $quote);
        /*
        if(isset($_POST['submit'])) {
            $name=$_POST['name'];
            $email=$_POST['email'];
            $subject="Second Offer from Forza";
            $quote=$_POST['msg'];
            $body="Thank you for sending us your device. 
                We would like to offer you \r\n $quote \r\n euro for it". 'To accept or refuse please visit <a href='.'"'.'http://forzaerp.local/rebuy/'.$imei.'/'.'acceptsecquote'.'"'.'>This Link</a>';
            echo '<pre>';
            var_dump($_POST);

            $mail = new PHPMailer(TRUE);

            try {

                $mail->setFrom('simona.thrussell@forza-refurbished.nl', $name);
                $mail->addAddress($email, 'your name');
                $mail->Subject = $subject;
                $mail->Body = $body;

                /* SMTP parameters. */
        /*$mail->isSMTP();
        $mail->Host = 'smtp.office365.com';
        $mail->SMTPAuth = TRUE;
        $mail->SMTPSecure = 'tls';
        $mail->Username = 'simona.thrussell@forza-refurbished.nl';
        $mail->Password = 'DcadkA7h';
        $mail->Port = 587;

        /* Disable some SSL checks. */
        /* $mail->SMTPOptions = array(
             'ssl' => array(
                 'verify_peer' => false,
                 'verify_peer_name' => false,
                 'allow_self_signed' => true
             )
         );

         /* Finally send the mail. */
        /*$mail->send();
        $status=StatusModel::updateForzaRebuyDeviceStatus(10,$imei);
        $action=ActionModel::setRebuyDeviceAction(14,$imei);
    }
    catch (Exception $e)
    {
        echo $e->errorMessage();
    }



}
else{

    echo "no input submitted";

}*/

    }


    public function sendsecmailAction()
    {
        $order_id = $this->activateAction();
        $quote = RebuyModel::getOrderSecondQuotes($order_id);
        $details = CustomerModel::getRebuyCustomerData($order_id);
        // echo '<pre/>';
        //print_r($details);
        $firstname = $details['customer_first_name'];
        $lastname = $details['customer_last_name'];
        $email = $details['customer_email'];
        echo $firstname . '</br>' . $lastname . '</br>' . $email;
        $results = RebuyModel::getOrderSecondOffers($order_id);
        $setquote = RebuyModel::setOrderQuote($order_id, 2, $quote);


        // $results=RebuyModel::retrievesecondquote($imei);


        View::renderTemplate('Rebuy/sendsecmail.html'
            , [
                'results' => $results,
                'quote' => $quote,
                'details' => $details,
                'firstname' => $firstname,
                'lastname' => $lastname,
                'email' => $email
            ]
        );


    }

    public function acceptsecquoteAction()
    {
        $order_id = $this->activateAction();
        //$order_id=RebuyModel::getOrderIdbyImei($imei);
        $quote = RebuyModel::getOrderQuote($order_id,2);
        print_r($quote);
        $results = RebuyModel::getOrderSecondOffers($order_id);


        View::renderTemplate('Rebuy/acceptsecquote.html', [
            'results' => $results,
            'quote' => $quote
        ]);


    }

    public function secconfirmAction()
    {
        $order_id = $this->activateAction();

        $results = RebuyModel::retrievesecondquote($order_id);
        //echo $order_id;
        $offer_type = 'second offer';
        $date = date('Y-m-d');
        // $order_id=RebuyModel::getOrderIdbyImei($imei);

        $accept = RebuyModel::acceptOrderOffer($order_id, 1, 2);
        //$offer=new Offer($results[0]['offer'],$imei,$offer_type,1);
        View::renderTemplate('Rebuy/secconfirm.html'
            , [
                'results' => $results
            ]);
        //TO DO : check that second offer amount is entered
        //$results=RebuyModel::getQuote($order_id);
        ;

        $status = RebuyModel::updateFStatus(14, $order_id);
        $action = RebuyModel::setAction(7, $order_id);


    }

    public function secrefuseoptionsAction()
    {
        $device_id= $this->activateAction();
        $imei=RebuyModel::getIMEIbyDeviceId($device_id);
        $order_id = RebuyModel::getOrderIdbyImei($imei);

        //echo $order_id;
        $offer_type = 'second offer';
        $date = date('Y-m-d');

        $accept = RebuyModel::acceptOrderOffer($order_id, 0, 2);
        //$offer=new Offer($results[0][21],$order_id,$results[0][14],$date,$offer_type,0);
        View::renderTemplate('Rebuy/secrefuseoptions.html');

    }

    public function returnAction()
    {
        $device_id= $this->activateAction();
        $imei=RebuyModel::getIMEIbyDeviceId($device_id);
        $order_id = RebuyModel::getOrderIdbyImei($imei);
        $results = RebuyModel::getAddressbyOrderId($order_id);
        View::renderTemplate('Rebuy/return.html', ['results' => $results]);

    }

    public function failcardAction()
    {
        $device_id = $this->activateAction();

        View::renderTemplate('Rebuy/failcard.html');
    }

    public function setfailcardAction()
    {


        $device_id= $this->activateAction();
        $imei=RebuyModel::getIMEIbyDeviceId($device_id);

        $order_id = RebuyModel::getOrderIdbyImei($imei);
        $results = RebuyModel::getOrderActionById($imei);


        echo '<pre>';
        print_r($_POST);
        $now = new \DateTime();
        $now->getTimestamp();
        $date = $now->format('Y-m-d H:i:s');


        function IsChecked($chkname, $value)
        {
            if (!empty($_POST[$chkname])) {
                foreach ($_POST[$chkname] as $chkval) {
                    if ($chkval == $value) {
                        return true;
                    }
                }
            }
            return false;
        }


        if (isset($_POST['sound'])) {
            print_r($_POST['sound']);
            if (IsChecked('sound', '30')) {
                $speakers = 1;
            } else {
                $speakers = 0;
            }
            if (IsChecked('sound', '7')) {
                $front_speaker = 1;
            } else {
                $front_speaker = 0;
            }
            if (IsChecked('sound', '24')) {
                $microphone_bottom = 1;
            } else {
                $microphone_bottom = 0;
            }
            if (IsChecked('sound', '26')) {
                $internal_speakers = 1;
            } else {
                $internal_speakers = 0;
            }
            if (IsChecked('sound', '13')) {
                $microphone_back = 1;
            } else {
                $microphone_back = 0;
            }
            if (IsChecked('sound', '3')) {
                $microphone_top = 1;
            } else {
                $microphone_top = 0;
            }

            print_r($_POST['sound']);

            $sound_inspection_id = InspectionModel::makeSoundInspection($imei, $speakers, $internal_speakers, $microphone_bottom, $microphone_back, $front_speaker, $microphone_top);
            echo "the id of the sound inspection is " . $sound_inspection_id;
        } else {
            echo 'no sound issues';
            $sound_inspection_id = 0;
        }

        if (isset($_POST['power'])) {
            print_r($_POST['power']);
            if (IsChecked('power', '29')) {
                $power = 1;
            } else {
                $power = 0;
            }

            if (IsChecked('power', '23')) {
                $battery = 1;
            } else {
                $battery = 0;
            }

            if (IsChecked('power', '12')) {
                $dock_connector = 1;
            } else {
                $dock_connector = 0;
            }
            print_r($_POST['power']);
            $power_inspection_id = InspectionModel::makePowerInspection($imei, $battery, $dock_connector, $power);
            echo "the id of the power inspection is " . $power_inspection_id;
        } else {
            $power_inspection_id = 0;
            echo "no power issues";
        }

        if (isset($_POST['screen'])) {
            print_r($_POST['screen']);
            if (IsChecked('screen', '28')) {
                $LCD = 1;
            } else {
                $LCD = 0;
            }
            if (IsChecked('screen', '11')) {
                $multi_touch = 1;
            } else {
                $multi_touch = 0;
            }
            if (IsChecked('screen', '0')) {
                $img_quality = 1;
            } else {
                $img_quality = 0;
            }
            if (IsChecked('screen', '6')) {
                $ambient_light = 1;
            } else {
                $ambient_light = 0;
            }
            if (IsChecked('screen', '5')) {
                $auto_brightness = 1;
            } else {
                $auto_brightness = 0;
            }
            if (IsChecked('screen', '4')) {
                $proximity = 1;
            } else {
                $proximity = 0;
            }

            print_r($_POST['screen']);
            $screen_inspection_id = InspectionModel::makeScreenInspection($imei, $LCD, $multi_touch, $img_quality, $ambient_light, $auto_brightness, $proximity);
            echo "the id of the screen inspection is  " . $screen_inspection_id;
        } else {
            $screen_inspection_id = 0;
            echo "No screen problems";
        }

        if (isset($_POST['buttons'])) {
            print_r($_POST['buttons']);

            if (IsChecked('buttons', '25')) {
                $headset_jack = 1;
            } else {
                $headset_jack = 0;
            }
            if (IsChecked('buttons', '21')) {
                $power_button = 1;
            } else {
                $power_button = 0;
            }


            if (IsChecked('buttons', '16')) {
                $home_button = 1;
            } else {
                $home_button = 0;
            }


            if (IsChecked('buttons', '9')) {
                $volume_flex_cable = 1;
            } else {
                $volume_flex_cable = 0;
            }

            if (IsChecked('buttons', '8')) {
                $touch_id = 1;
            } else {
                $touch_id = 0;
            }
            $buttons_inspection_id = InspectionModel::makeButtonsInspection($imei, $headset_jack, $power_button, $volume_flex_cable, $home_button, $touch_id);
            echo "the id of the buttons inspection is " . $buttons_inspection_id;
        } else {
            $buttons_inspection_id = 0;
            echo "no jacks/buttons problems";
            //print_r($_POST['buttons']);
        }

        If (isset($_POST['connections'])) {
            Print_r($_POST['connections']);
            if (IsChecked('connections', '17')) {
                $SIM_fail = 1;
            } else {
                $SIM_fail = 0;
            }
            if (IsChecked('connections', '18')) {
                $no_cell_conn = 1;
            } else {
                $no_cell_conn = 0;
            }
            if (IsChecked('connections', '19')) {
                $signal_strength = 1;
            } else {
                $signal_strength = 0;
            }
            if (IsChecked('connections', '20')) {
                $wifi_bt = 1;
            } else {
                $wifi_bt = 0;
            }
            $connections_inspection_id = InspectionModel::makeConnsInspection($imei, $wifi_bt, $signal_strength, $no_cell_conn, $SIM_fail);;
            echo "the id of the connections inspection is " . $connections_inspection_id;


        } else {
            $connections_inspection_id = 0;
            echo "no connections problems";
            //print_r($_POST['connections']);
        }

        if (isset($_POST['misc'])) {
            print_r($_POST['misc']);

            if (IsChecked('misc', '27')) {
                $vibration_motor = 1;
            } else {
                $vibration_motor = 0;
            }

            if (IsChecked('misc', '22')) {
                $GPS = 1;
            } else {
                $GPS = 0;
            }

            if (IsChecked('misc', '14')) {
                $torch = 1;
            } else {
                $torch = 0;
            }
            $misc_inspection_id = InspectionModel::makeMiscInspection($imei, $vibration_motor, $GPS, $torch);
            echo "the id of the miscellaneous inspection is " . $misc_inspection_id;

        } else {
            $misc_inspection_id = 0;
            echo "no misc problems";
            //print_r($_POST['misc']);
        }

        if (isset($_POST['camera'])) {
            print_r($_POST['camera']);

            if (IsChecked('camera', '15')) {
                $rear_camera = 1;
            } else {
                $rear_camera = 0;
            }
            if (IsChecked('camera', '2')) {
                $front_camera = 1;
            } else {
                $front_camera = 0;
            }


            if (IsChecked('camera', '1')) {
                $fcfc = 1;
            } else {
                $fcfc = 0;
            }
            $camera_inspection_id = InspectionModel::makeCameraInspection($imei, $rear_camera, $front_camera, $fcfc);
            echo "the camera inspection id is " . $camera_inspection_id;
        } else {
            $camera_inspection_id = 0;
            echo "no camera problems";
            //print_r($_POST['camera']);
        }


        if (IsChecked('failcard', '12')) {
            $physical_damage = 1;
        } else {
            $physical_damage = 0;
        }


        if (IsChecked('failcard', '16')) {
            $charging = 1;
        } else {
            $charging = 0;
        }

        if (IsChecked('failcard', '20')) {
            $power_flex_cable = 1;
        } else {
            $power_flex_cable = 0;
        }


        $date = date('Y-m-d');
        echo $date . "</br>";
        echo $imei . "</br>";
        $status = StatusModel::updateForzaRebuyDeviceStatus(6, $imei);
        echo $status . "Status set </br>";
        $event = EventModel::CreateEvent(1, 1, $imei, 1);
        echo $event . "Event created </br>";

        $action = ActionModel::setRebuyDeviceAction(7, $imei);
        echo $action . "Action set </br>";

        sleep(5);
        $inspection_id = InspectionModel::makeInspection($order_id, $imei, $buttons_inspection_id, $camera_inspection_id, $connections_inspection_id, $misc_inspection_id, $power_inspection_id, $screen_inspection_id, $sound_inspection_id, 1);
        echo $inspection_id . "INspection created </br>";
        $repair = RepairModel::makeRepairOrder($imei, $inspection_id, 2);
        echo $repair . "Repair order created </br>";
        $repairstatus = RepairModel::makerepairstatus($repair, $imei, 2, 2);
        echo $repairstatus . "Repair status created</br>";
        $results = RebuyModel::getOrderActionById($imei);
        View::renderTemplate('Rebuy/setfailcard.html'
            , ['results' => $results]
        );

    }


    public function takeactionAction()
    {
        $order_id = $this->activateAction();
        $results = RebuyModel::getQuote($order_id);
        View::renderTemplate('Rebuy/takeaction.html',
            ['results' => $results]

        );

    }

    public function returnorderAction()
    {
        $device_id= $this->activateAction();
        $imei=RebuyModel::getIMEIbyDeviceId($device_id);
        $order_id = RebuyModel::getOrderIdbyImei($imei);
        $status = StatusModel::updateForzaRebuyDeviceStatus(15, $imei);
        $action = ActionModel::setRebuyDeviceAction(13, $imei);
        $cstatus = RebuyModel::UpdateDeviceCustomerStatus(15, $order_id);
        $devicestatus = StatusModel::updaterebuydevicestatus(13, 15, 13, $imei);
        $results = RebuyModel::getQuote($order_id);
        View::renderTemplate('Rebuy/returnorder.html',
            ['results' => $results]

        );

    }

    public function recycledeviceAction()
    {
        $device_id= $this->activateAction();
        $imei=RebuyModel::getIMEIbyDeviceId($device_id);
        $order_id = RebuyModel::getOrderIdbyImei($imei);
        $status = StatusModel::updateForzaRebuyDeviceStatus(14, $imei);
        $action = ActionModel::setRebuyDeviceAction(13, $imei);
        $cstatus = RebuyModel::UpdateDeviceCustomerStatus(15, $order_id);
        $results = RebuyModel::getOrderActionById($imei);
        $inv = InventoryModel::movedeviceLocation(2, $imei);

        View::renderTemplate('Rebuy/recycledevice.html',
            ['results' => $results]

        );

    }


    public function orderrecycledAction()
    {
        $order_id = $this->activateAction();
        $imei = RebuyModel::getIMEI($order_id);
        $status = StatusModel::updateForzaRebuyDeviceStatus(12, $imei);
        $action = ActionModel::setRebuyDeviceAction(13, $imei);
        $status = RebuyModel::UpdateDeviceCustomerStatus(14, $imei);
        $devicestatus = StatusModel::updateRebuyDeviceStatus(14, 14, 13, $order_id, $imei);
        View::renderTemplate('Rebuy/orderrecycled.html');
    }

    public function devicefailcardAction()
    {
        //$imei=$this->activateAction();
        //$order_id=RebuyModel::getOrderIdbyImei($imei);
        /*$status=StatusModel::updateForzaRebuyDeviceStatus(12,$imei);
        $action=ActionModel::setRebuyDeviceAction(13,$imei);
        $status=RebuyModel::UpdateDeviceCustomerStatus(14,$imei);*/
        $results = RebuyModel::getInspected();
        View::renderTemplate('Rebuy/devicefailcard.html'
            , [
                'results' => $results
            ]);
    }

    public function getDeviceAction()
    {
        View::renderTemplate('Rebuy/getdevice.html');
    }

    public function finddeviceAction()
    {
        $IMEI = $_POST['IMEI'];
        $results = RebuyModel::findDevice($IMEI);
        View::renderTemplate('Rebuy/finddevice.html',
            [
                'results' => $results
            ]);
    }

    public function printorderlabelAction()
    {
        $order_id = $this->activateAction();

        View::renderTemplate('Rebuy/printorderlabel.html');

        $results = RebuyModel::getOrderDevices($order_id);
        View::renderTemplate('Rebuy/printorderlabel.html', [
            'order_id' => $order_id
        ]);

    }

    public function devicestatusAction()
    {
        $results = RebuyModel::getDeviceStatus();
        $checks = RebuyModel::getCheck();
        View::renderTemplate('Rebuy/devicestatus.html', [
            'results' => $results,
            'checks' => $checks
        ]);
    }

    public function viewdevicesAction()
    {
        $order_id = $this->activateAction();
        $results = RebuyModel::getOrderDevices($order_id);
        View::renderTemplate('Rebuy/viewdevices.html'
            , [
                'results' => $results
            ]);
    }

    public function overrideAction()
    {
        $imei = $_POST['imei'];
        $action = $_POST['action'];
        $update = ActionModel::setRebuyDeviceAction($action, $imei);
        sleep(5);
        $results = RebuyModel::getOrderActionById($imei);
        print_r($results);
        View::renderTemplate('Rebuy/override.html'
            , [
                'results' => $results
            ]);
    }

    public function orderstateAction()
    {
        $order_id = $this->activateAction();
        $status = rebuyModel::getOrderDevicesStatus($order_id);

        //echo '<pre>';
        //print_r($status);

        $status_id = 15;
        $state = checkstatus::checkstatus($status, $status_id);

        /*function isHomogenous($status) {
            $status_id = current($status);
            foreach ($status as $state) {
                if ($state !== 15) {
                    return false;
                }
            }
            return true;
        }*/

        $state = Checkstatus::checkstatus($status, 15);


        if ($state == true) {
            $quotes = rebuyModel::getAcceptedOffersByOrder($order_id);
            //sum quotes and send to finance
            $message = "Order Complete!";
            $orderstatus = RebuyModel::updateFStatus(4, $order_id);
        } else {
            $message = "This order is still processing";
        }
        View::renderTemplate('Rebuy/orderstate.html',
            [
                'message' => $message
            ]);

    }


    public function orderpaymentsAction()
    {
        $order_id = $this->activateAction();
        $status = rebuyModel::getOrderDevicesStatus($order_id);
        $state = Checkstatus::checkstatus($status, 17);

        if ($state == true) {
            $results = RebuyModel::getAcceptedOffersByOrder($order_id);
            View::renderTemplate('Rebuy/orderpayments.html',
                ['results' => $results
                ]);
        } else {
            $message = "this order is still processing";
            View::renderTemplate('Rebuy/orderpayments.html',
                ['message' => $message
                ]);

        }

        $results = RebuyModel::getAcceptedOffersByOrder($order_id);
        View::renderTemplate('Rebuy/orderpayments.html',
            ['results' => $results
            ]);


    }

    public function checkorderquotesAction()
    {

        $order_id = $this->activateAction();
        $quote = RebuyModel::getOrderQuotes($order_id);
        print_r($quote);
        $results = RebuyModel::getOrderOffers($order_id);
        $setquote = RebuyModel::setOrderQuote($order_id, 1, $quote);
        echo $setquote;
        View::renderTemplate('Rebuy/checkorderstatus.html'
            , [
                'results' => $results,
                'quote' => $quote
            ]
        );
    }

    public function checkstateAction()
    {
        $results = RebuyModel::getOrderState();
        foreach ($results as $result) {
            $order_id = $result['order_id'];
            $quote = RebuyModel::getOrderQuotes($order_id);
            if (is_numeric($quote)) {
                echo $order_id;
                echo $quote;
            }
        }
        //print_r($results);
        View::renderTemplate('Rebuy/checkstate.html'
            , [
                'results' => $results
            ]);
    }

    public function checkorderimei()
    {
        $order_id = $this->activateAction();
        $results = $results = RebuyModel::getOrderDevicesbyStatus($order_id, 3);
        View::renderTemplate('Rebuy/checkorderimei.html'
            , [
                'results' => $results
            ]);
    }

    public function acceptchoicesAction()
    {
        $order_id = $this->activateAction();
        echo '<pre>';
        print_r($_POST);
        $results = RebuyModel::getOrderOffers($order_id);
        foreach ($results as $result) {
            $imei = $result['device_imei'];
            echo '</br>';

            foreach ($_POST as $key => $value) {
                if ($key == $imei) {
                    if ($value == 'accept') {
                        echo $key . ' is ' . $value;

                        $update=RebuyModel::AcceptDeviceOffer(1,$imei,$order_id);
                        $status = StatusModel::updateForzaRebuyDeviceStatus(7, $imei);
                        $action = ActionModel::setRebuyDeviceAction(9, $imei);
                    } else {
                        echo $key . " is refused.";

                        $update=RebuyModel::AcceptDeviceOffer(0,$imei,$order_id);
                        $status = StatusModel::updateForzaRebuyDeviceStatus(8, $imei);
                        $action = ActionModel::setRebuyDeviceAction(15, $imei);
                    }
                }
            }
        }
        $option='accept';
        $array=$_POST;


            if(in_array('refuse',$_POST))
            {
                $orderstatus = RebuyModel::updateFStatus(12, $order_id);
                $action = RebuyModel::setAction(6, $order_id);
                //$results=$results=RebuyModel::getOrderDevicesbyStatus($order_id,3);
                $status = RebuyModel::getDeviceOfferStatus($order_id);
            }else{
                $accept = RebuyModel::acceptOrderOffer($order_id, 1, 1);
                $status = RebuyModel::updateFStatus(5, $order_id);
                $action = RebuyModel::setAction(7, $order_id);

            }


        View::renderTemplate('Rebuy/acceptchoices.html'
            , [
                'results' => $results

            ]
        );
    }

    public function secquotedevicesAction()
    {

        $order_id = $this->activateAction();
        echo '<pre>';
        print_r($_POST);

        $results = RebuyModel::getOrderOffers($order_id);

        foreach ($results as $result) {
            $imei = $result['device_imei'];
            echo '</br>';

            foreach ($_POST as $key => $value) {
                if ($key == $imei) {


                    // echo $key.' is '.$value;
                    $query = RebuyModel::makeRebuyDeviceSecondOffer($value, $imei, $order_id);
                    echo $query . ' second quote set for device ' . $key;
                    //$update=RebuyModel::setAccepted($key,$order_id,1);
                    if($value!=0) {
                        $status = StatusModel::updateForzaRebuyDeviceStatus(7, $imei);
                        $action = ActionModel::setRebuyDeviceAction(9, $imei);
                    }

                }
            }
        }


        $orderstatus = RebuyModel::updateFStatus(12, $order_id);
        $action = RebuyModel::setAction(6, $order_id);
        View::renderTemplate('Rebuy/secquotedevices.html');
    }

    public function viewrefusedOffer()
    {
        View::renderTemplate('Rebuy/viewrefusedOffer.html');

    }

    public function acceptsecchoicesAction()
    {
        $order_id = $this->activateAction();
        echo '<pre>';
        print_r($_POST);
        if (in_array('refuse', $_POST,true)) {
            echo 'Offer not accepted';
            $offer=RebuyModel::acceptOrderOffer($order_id,0,2);
            $status=RebuyModel::updateFStatus(7,$order_id);
            $action=RebuyModel::setAction(7,$order_id);
            $cstatus=RebuyModel::UpdateOrderCustomerStatus(8,$order_id);
        }else{
            echo 'offer accepted';
            $status=RebuyModel::updateFStatus(14,$order_id);
            $action=RebuyModel::setAction(7,$order_id);
            $cstatus=RebuyModel::UpdateOrderCustomerStatus(7,$order_id);
            $offer=RebuyModel::acceptOrderOffer($order_id,1,2);
        }
        $results = RebuyModel::getOrderOffers($order_id);
        foreach ($results as $result) {
            $imei = $result['device_imei'];
            echo '</br>';
            foreach ($_POST as $key => $value) {
                if ($key == $imei) {
                    if ($value == 'accept') {
                        echo $key . ' is ' . $value;
                        $update=RebuyModel::AcceptDeviceOffer(1,$imei,$order_id);
                        $status = StatusModel::updateForzaRebuyDeviceStatus(7, $imei);
                        $action = ActionModel::setRebuyDeviceAction(9, $imei);
                    } else {
                        echo $key . " is refused.";
                        $update=RebuyModel::AcceptDeviceOffer(0,$imei,$order_id);
                        $status = StatusModel::updateForzaRebuyDeviceStatus(8, $imei);
                        $action = ActionModel::setRebuyDeviceAction(15, $imei);
                    }
                }
            }
            $option='accepted';
            $array=$_POST;

           /* $check=Checkstatus::validateOptions($_POST,$option);
            if($check==true)
            {
                echo "order completed";
            }   else{
                echo "offer not accepted";
            }*/

            View::renderTemplate('Rebuy/acceptsecchoices.html');
        }

    }

    public function checkrefusedofferAction()
    {
        $order_id = $this->activateAction();
        $results=RebuyModel::getOrderOffer($order_id,1);
        print_r($results);
        View::renderTemplate('Rebuy/checkrefusedoffer.html'
        ,[
            'results'=>$results
            ]);

    }

    public function refusedOfferOptionsAction()
    {
        View::renderTemplate('Rebuy/refusedOfferOptions.html');
    }

    public function refusechoicesAction()
    {
        $order_id = $this->activateAction();
        echo '<pre>';
        print_r($_POST);
        $results = RebuyModel::getOrderOffers($order_id);
        foreach ($results as $result) {
            $imei = $result['device_imei'];
            echo '</br>';

            foreach ($_POST as $key => $value) {
                if ($key == $imei) {
                    if ($value == 'return') {
                        echo $key . ' is ' . $value;

                        $update=RebuyModel::AcceptDeviceOffer(0,$imei,$order_id);
                        $status = StatusModel::updateForzaRebuyDeviceStatus(7, $imei);
                        $action = ActionModel::setRebuyDeviceAction(15, $imei);
                    } else {
                        echo $key . " is recycled.";

                        $update=RebuyModel::AcceptDeviceOffer(0,$imei,$order_id);
                        $status = StatusModel::updateForzaRebuyDeviceStatus(8, $imei);
                        $action = ActionModel::setRebuyDeviceAction(12, $imei);
                    }
                }
            }
        }
        $orderstatus = RebuyModel::updateFStatus(12, $order_id);
        $action = RebuyModel::setAction(6, $order_id);


        /*if(in_array('refuse',$_POST))
        {
            $orderstatus = RebuyModel::updateFStatus(12, $order_id);
            $action = RebuyModel::setAction(6, $order_id);
            //$results=$results=RebuyModel::getOrderDevicesbyStatus($order_id,3);
            $status = RebuyModel::getDeviceOfferStatus($order_id);
        }else{
            $accept = RebuyModel::acceptOrderOffer($order_id, 1, 1);
            $status = RebuyModel::updateFStatus(5, $order_id);
            $action = RebuyModel::setAction(7, $order_id);

        }*/


        View::renderTemplate('Rebuy/refusechoices.html'
            , [
                'results' => $results

            ]
        );

    }

    public function refusequoteAction()
    {
        $order_id = $this->activateAction();

        $results = RebuyModel::getOrderOffers($order_id);
        View::renderTemplate('Rebuy/refusequote.html'
            , [
                'results' => $results,

            ]
        );

    }

    public function refusesecquoteAction()
    {
        $order_id = $this->activateAction();

        $results = RebuyModel::getOrderOffers($order_id);
        View::renderTemplate('Rebuy/refusesecquote.html'
            , [
                'results' => $results,

            ]
        );

    }

    public function refusesecchoicesAction()
    {
        $order_id = $this->activateAction();
        echo '<pre>';
        print_r($_POST);
        $results = RebuyModel::getOrderOffers($order_id);
        foreach ($results as $result) {
            $imei = $result['device_imei'];
            echo '</br>';

            foreach ($_POST as $key => $value) {
                if ($key == $imei) {
                    if ($value == 'return') {
                        echo $key . ' is ' . $value;

                        $update=RebuyModel::AcceptDeviceOffer(0,$imei,$order_id);
                        $status = StatusModel::updateForzaRebuyDeviceStatus(11, $imei);
                        $action = ActionModel::setRebuyDeviceAction(9, $imei);
                    } else {
                        echo $key . " recycled";

                        $update=RebuyModel::AcceptDeviceOffer(0,$imei,$order_id);
                        $status = StatusModel::updateForzaRebuyDeviceStatus(8, $imei);
                        $action = ActionModel::setRebuyDeviceAction(12, $imei);
                    }
                }
            }
        }
        $option='accept';
        $array=$_POST;


        if(in_array('refuse',$_POST))
        {
            $orderstatus = RebuyModel::updateFStatus(12, $order_id);
            $action = RebuyModel::setAction(6, $order_id);
            //$results=$results=RebuyModel::getOrderDevicesbyStatus($order_id,3);
            $status = RebuyModel::getDeviceOfferStatus($order_id);
        }else{
            $accept = RebuyModel::acceptOrderOffer($order_id, 1, 1);
            $status = RebuyModel::updateFStatus(5, $order_id);
            $action = RebuyModel::setAction(7, $order_id);

        }


        View::renderTemplate('Rebuy/refusesecchoices.html'
            , [
                'results' => $results

            ]
        );

    }

}
