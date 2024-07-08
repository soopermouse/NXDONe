<?php
/**
 * Created by PhpStorm.
 * User: SimonaThrussell
 * Date: 01/10/2018
 * Time: 09:30
 */

namespace App\Controllers;
use App\Models\CustomerModel;
use App\Models\EventModel;
use App\Models\OrderModel;
use App\Models\ReturnModel;
use App\Models\ShippingModel;
use \Core\View;
use App\Models\SDModel;
use App\Models\RebuyModel;
use App\Models\RMAModel;
use PHPMailer\PHPMailer\PHPMailer;
require '../vendor/autoload.php';


class SD extends \Core\Controller
{
    public function indexAction()
    {

        //$results = SDModel::getOrders();
        View::renderTemplate('SD/index.html'
            //['results'=>$results]
        );

    }

    public function activateAction()
    {
        $id = $this->route_params['id'];
        return $id;
    }

    public function RMAIntakeAction()
    {

        $results = SDModel::getRMAbyStatus(1);
        View::renderTemplate('SD/RMAintake.html',
        ['results'=>$results]
        );

    }

    public function RMAAcceptAction()
    {
        $rma_id=$this->activateAction();
        $imei=SDModel::getIMEI($rma_id);
        $results=SDModel::getRMA($rma_id);


        $event=EventModel::CreateEvent(1,7,$imei,5);
        $_SESSION['event_id']=$event;
        View::renderTemplate('SD/RMAaccept.html',
            ['results'=>$results]
        );
    }

    public function RmaacceptupdateAction()
    {
        $rma_id=$this->activateAction();
        $status=$_POST['status'];
        echo $event_id=$_SESSION['event_id'];
        echo $endevent=EventModel::EndEvent($event_id);
        unset($_SESSION['event_id']);
        $update=SDModel::updateRMAStatus($rma_id,$status);
        $results=SDModel::getRMA($rma_id);
        View::renderTemplate('SD/RMAacceptupdate.html',
            ['results'=>$results]
        );
    }

    public function rmashippinglabel()
    {
        $rma_id=$this->activateAction();

        $address=SDModel::getAddress($rma_id);
        $results=SDModel::getRMA($rma_id);
        //$update=SDModel::updateRMAStatus($status,$rma_id);
        View::renderTemplate('SD/rmashippinglabel.html',
            ['results'=>$results,
             'address'=>$address  ]
        );
    }

    public function sendlabelAction()
    {
        $rma_id=$this->activateAction();
        $update=SDModel::updateRMAStatus(2,$rma_id);
        View::renderTemplate('SD/sendlabel.html');
    }

    public function rmashippingAction()
    {
        $results = SDModel::getShipping();
        View::renderTemplate('SD/rmashipping.html',[
            'results'=>$results
        ]);

    }

    public function editrmashippingAction()
    {
        $rma_id=$this->activateAction();
        $_SESSION['rma_id']=$rma_id;
        $results = SDModel::getShippingbyId($rma_id);
        View::renderTemplate('SD/editrmashipping.html',[
            'results'=>$results
        ]);
    }

    public function rmashippingupdateAction()
    {
        $rma_id=$_SESSION['rma_id'];
        if(isset($_POST['submit'])) {
            //var_dump($_POST['submit']);
            echo $fstatus = $_POST['status'];
            $query=SDModel::updateOStatus($fstatus, $rma_id);

            switch($fstatus) {
                case 3:
                    $fstatus = 3;
                    $query = SDModel::updateRMAStatus(3, $rma_id);
                    $status=SDModel::updateOStatus(3,$rma_id);
                    break;

                case 7:
                    //$action = 1;
                    $query = SDModel::updateRMAStatus(7, $rma_id);
                    $status=SDModel::updateOStatus(3,$rma_id);
                    break;

            }

        }
        else{

            echo "no info was sent";
        }
        $results = SDModel::getShippingById($rma_id);
        View::renderTemplate('SD/rmashippingupdate.html', [
                'results' => $results
            ]
        );
    }

    public function gethistoryAction()
    {
                $rma_id=$this->activateAction();
                echo $imei=SDModel::getIMEI($rma_id);
                $results = SDModel::getRMAHistory($imei);

                View::renderTemplate('SD/gethistory.html'
                    , [
                        'results' => $results
                    ]
                );


    }



    public function RebuyIntakeAction()
    {

        $results = SDModel::getRebuyOrders();
        View::renderTemplate('SD/rebuyintake.html',
        ['results'=>$results]
        );

    }


    public function RebuyShippingAction()
    {


        $results = ShippingModel::getRebuyShipping();
        View::renderTemplate('SD/rebuyshipping.html',
        ['results'=>$results]
        );

    }

    public function editrebuyshippingAction()
    {
        $order_id=$this->activateAction();
        $results = ShippingModel::getRebuyShippingbyId($order_id);
        View::renderTemplate('SD/editrebuyshipping.html',
            ['results'=>$results]
        );

    }

    public function rebuyshippingupdateAction()
    {
        $order_id=$this->activateAction();
        //$order_id=$_SESSION['order_id'];
        if(isset($_POST['submit'])) {
            //var_dump($_POST['submit']);
            $status = $_POST['status'];
            $query=ShippingModel::updateRebuyShipping($status, $order_id);

            switch($status) {
                case 3:
                    $fstatus = 3;
                    $query = RebuyModel::updateFStatus(3, $order_id);
                    $update= RebuyModel::setAction(2, $order_id);
                    break;

                case 7:
                    $action = 1;
                    $query = RebuyModel::updateFStatus(7, $order_id);
                    $query2 = RebuyModel::setAction(1, $order_id);
                    break;

            }

        }
        else{

            echo "no info was sent";
        }
        $results = ShippingModel::getRebuyShippingById($order_id);
        View::renderTemplate('SD/rebuyshippingupdate.html', [
                'results' => $results
            ]
        );


    }

    public function RebuyOrdersAction()
    {

        $results = SDModel::getRebuyStatus();

        View::renderTemplate('SD/RebuyOrders.html',
        ['results'=>$results]
        );

    }

    public function RMAOrdersAction()
    {

        $results = SDModel::getRMAs();
        View::renderTemplate('SD/RMAOrders.html',
        ['results'=>$results]
        );

    }
    public function checkImeiAction()
    {

        //$results = SDModel::getOrders();
        View::renderTemplate('SD/checkimei.html'
        //['results'=>$results]
        );

    }

    public function checkAction()
    {


        $imei = $_POST['imei'];
        $_SESSION['imei']=$imei;
        $count=RMAModel::checkIMEI($imei);
        if($count!=0) {
            //echo'<pre>';
           // print_r(
            $results = RMAModel::getWarranty($imei);
            View::renderTemplate('SD/check.html'
                , [
                    'results' => $results]
            );
        }else{
            View::renderTemplate('SD/checkfailed.html');
        }

    }

    public function editordersAction()
    {
        //$results = SDModel::getOrders();
        View::renderTemplate('SD/editorders.html'
        //['results'=>$results]
        );
    }

    public function CustomerDataAction()
    {
        //$results = SDModel::getOrders();
        View::renderTemplate('SD/CustomerData.html'
        //['results'=>$results]
        );
    }

    public function retailcustomerdataAction()
    {

        View::renderTemplate('SD/Retailcustomerdata.html');
    }

    public function findretailcustomerdataAction()
    {
        $order_id=$_POST['order_id'];
        $results=CustomerModel::getRetailCustomerData($order_id);
        View::renderTemplate('SD/findRetailcustomerdata.html',
            ['results'=>$results]);
    }

    public function rmacustomerdataAction()
    {

        View::renderTemplate('SD/rmacustomerdata.html');
    }

    public function findrmacustomerdataAction()
    {
        $order_id=$_POST['order_id'];
        $results=CustomerModel::getRmaCustomerData($order_id);
        View::renderTemplate('SD/findrmacustomerdata.html',
            ['results'=>$results]);
    }
    public function rebuycustomerdataAction()
    {

        View::renderTemplate('SD/rebuycustomerdata.html');
    }

    public function findrebuycustomerdataAction()
    {
        $order_id=$_POST['order_id'];
        $results=CustomerModel::getRebuyCustomerData($order_id);
        View::renderTemplate('SD/findrebuycustomerdata.html',
            ['results'=>$results]);
    }

    public function RetailOrdersAction()
    {
        $results = OrderModel::getSaleOrders(1);
        View::renderTemplate('SD/RetailOrders.html',
        ['results'=>$results]
        );
    }

    public function BusinessOrdersAction()
    {
        $results = OrderModel::getSaleOrders(2);
        View::renderTemplate('SD/BusinessOrders.html',
        ['results'=>$results]
        );
    }


    public function ReportsAction()
    {
        //$results = SDModel::getOrders();
        View::renderTemplate('SD/reports.html'
        //['results'=>$results]
        );
    }

    public function RMAReportsAction()
    {
        //$results = SDModel::getOrders();
        View::renderTemplate('SD/rmareports.html'
        //['results'=>$results]
        );
    }

    public function RebuyReportsAction()
    {
        //$results = SDModel::getOrders();
        View::renderTemplate('SD/rebuyreports.html'
        //['results'=>$results]
        );
    }

    public function CustomerReportsAction()
    {
        //$results = SDModel::getOrders();
        View::renderTemplate('SD/customerreports.html'
        //['results'=>$results]
        );
    }

    public function SDUserReportsAction()
    {
        //$results = SDModel::getOrders();
        View::renderTemplate('SD/sduserreports.html'
        //['results'=>$results]
        );
    }


    public function mailAction()
    {
        //$order_id=$this->activateAction();
        //$results = RebuyModel::getQuote($order_id);
        View::renderTemplate('SD/mail.html'
            //, [
            //'results' => $results
        //]
    );

    }
    public function sendmailAction()
    {
        $order_id=$this->activateAction();
        $results = RebuyModel::getQuote($order_id);
        View::renderTemplate('Rebuy/sendmail.html', [
            'results' => $results
        ]);

    }

    public function mailsentAction()
    {
        $order_id=$this->activateAction();
        View::renderTemplate('SD/mailsent.html');

        if(isset($_POST['submit'])) {
            $name=$_POST['name'];
            $email=$_POST['email'];
            $subject="Offer from Forza";
            $quote=$_POST['msg'];
            $body="Thank you for sending us your device. 
          We would like to offer you \r\n $quote \r\n euro for it". 'To accept or refuse please visit <a href='.'"'.'http://forzaerp.local/rebuy/'.$order_id.'/'.'acceptquote'.'"'.'>This Link</a>';
            echo '<pre>';
            var_dump($_POST);

            $mail = new PHPMailer(TRUE);

            try {

                $mail->setFrom('simona.thrussell@forza-refurbished.nl', $name);
                $mail->addAddress($email, 'your name');
                $mail->Subject = $subject;
                $mail->Body = $body;

                /* SMTP parameters. */
                $mail->isSMTP();
                $mail->Host = 'smtp.office365.com';
                $mail->SMTPAuth = TRUE;
                $mail->SMTPSecure = 'tls';
                $mail->Username = 'simona.thrussell@forza-refurbished.nl';
                $mail->Password = 'DcadkA7h';
                $mail->Port = 587;

                /* Disable some SSL checks. */
                $mail->SMTPOptions = array(
                    'ssl' => array(
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                        'allow_self_signed' => true
                    )
                );

                /* Finally send the mail. */
                $mail->send();
                $status=RebuyModel::updateFStatus(9,$order_id);
                $action=RebuyModel::setAction(14,$order_id);
            }
            catch (Exception $e)
            {
                echo $e->errorMessage();
            }



        }
        else{

            echo "no input submitted";

        }

    }

    public function returnsAction()
    {
        $results=ReturnModel::getReturns();
        View::renderTemplate('SD/returns.html',
            [
                'results'=>$results
            ]);
    }

    public function checkreturnsAction()
    {
        $results=ReturnModel::getReturns();
        View::renderTemplate('SD/checkreturns.html',
            [
                'results'=>$results
            ]);
    }

    public function checkreturnAction()
    {

            echo $imei=$_POST['imei'];

            print_r($results=ReturnModel::checkReturnbyimei($imei));

        View::renderTemplate('SD/checkreturn.html',
            [
                'results'=>$results
            ]);
    }

    public function checkreturnorderAction()
    {
        echo $order_id=$_POST['orderid'];

        print_r($results=ReturnModel::checkReturnbyorderid($order_id));

        View::renderTemplate('SD/checkreturnorder.html',
            [
                'results'=>$results
            ]);
    }

    public function findcustomerdataAction()
    {
        $first_name=$_POST['first_name'];
        $last_name=$_POST['last_name'];
        $results=CustomerModel::getCustomerData($first_name,$last_name);
        View::renderTemplate('SD/findcustomerdata.html',
            [
                'results'=>$results
            ]);
    }



    public function editcustomerdataAction()
    {
        $first_name=$_POST['first_name'];
        $last_name=$_POST['last_name'];
        $customer_id=$_POST['customer_id'];
        $update=CustomerModel::editCustomerData($first_name,$last_name,$customer_id);
        $message="Customer id ".$update." has been updated";
        View::renderTemplate('SD/editcustomerdata.html',
            [
                'message'=>$message
            ]);
    }

    public function customerdatabynameAction()
    {
        View::renderTemplate('SD/customerdatabyname.html');
    }




}