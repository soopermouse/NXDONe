<?php
/**
 * Created by PhpStorm.
 * User: simona
 * Date: 28/09/2018
 * Time: 16:57
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
//local setup
require 'C:\xampp2\htdocs\FORZAERP\erpdemo\vendor\autoload.php';
//require 'C:\xampp\htdocs\FORZAERP\vendor\autoload.php';
class Rebuy extends \Core\Controller
{
    public function indexAction()
    {


        $results=rebuyModel::getStatus();
        View::renderTemplate('Rebuy/index.html', [

            'results'=> $results
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
        $order_id=$this->activateAction();

        $results = RebuyModel::getDevice($order_id);
        View::renderTemplate('Rebuy/inspect.html', [
            'results' => $results
        ]);
        $_SESSION['order_id']=$order_id;

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
        View::renderTemplate('Rebuy/newmail.html', [
            'results' => $results
        ]);
        //use php mailer script in rebuy/mail.php

    }

    public function sendmailAction()
    {
        $order_id=$this->activateAction();
            $results = RebuyModel::getQuote($order_id);
            View::renderTemplate('Rebuy/sendmail.html', [
                'results' => $results
            ]);

    }

    public function inspectsubmitAction()

    {
        $order_id=$_SESSION['order_id'];

        //$order_id=$this->activateAction();


        $results = RebuyModel::getInspectionById($order_id);
        View::renderTemplate('Rebuy/inspectsubmit.html',[
                'results'=>$results

            ]
        );






        $devicetype = $_POST['device_type'];
        $devicestorage = $_POST['device_storage'];
        $deviceconnection = $_POST['device_connection'];
        $devicecondition = $_POST['device_condition'];
        $devicecolour = $_POST['device_colour'];
        //$images=$_POST['images'];
        $devicecomments = $_POST['device_comments'];
        $query = RebuyModel::InspectSubmit($order_id, $devicetype, $devicestorage, $deviceconnection, $devicecondition, $devicecolour, $devicecomments);
        $status=RebuyModel::updateFStatus(16,$order_id);
        $action=RebuyModel::setAction(7,$order_id);


        //$failcard=$_POST['failcard'];
        if (!isset($_POST['failcard'])) {


            echo "no parts require  replacement";

        } else {
            echo '<pre>';
            //var_dump($_POST['failcard']);
           // echo "See below for parts required";
            $failcard = $_POST['failcard'];
            echo '<pre>';
            echo '<h3>Parts Needed </h3></br>';
            foreach ($failcard as $value) {
                echo $value . "</br>";
            }


        }





    }

    public function statusAction()
    {
        $results = RebuyModel::getStatus();
        View::renderTemplate('Rebuy/status.html', [
            'results' => $results
        ]);

    }







    public function mailsentAction()
    {
        $order_id=$this->activateAction();
        View::renderTemplate('Rebuy/mailsent.html');

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

    public function checkordersAction()
    {
        $results = RebuyModel::getCheck();
        View::renderTemplate('Rebuy/checkorders.html', [
            'results' => $results
        ]);


    }

    public function checkAction()
    {
        $order_id=$this->activateAction();
        $results = RebuyModel::getDevice($order_id);
        View::renderTemplate('Rebuy/check.html');
    }

    public function checksubmitAction()
    {
        $order_id = $this->activateAction();

        $results=RebuyModel::getActionButtons($order_id);
        View::renderTemplate('Rebuy/checksubmit.html',['results'=>$results]);
        echo '<pre>';
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
                if ($N == 3) {
                    echo "check passed!";
                    $checked = 1;
                    $query = RebuyModel::checksubmit($IMEI, $checked, $order_id);
                    $status = RebuyModel::updateFStatus(4, $order_id);
                    $action = RebuyModel::setAction(6, $order_id);


                } else {
                    echo "the device did not pass check, please see notes.";
                    $checked = 0;
                    $query = RebuyModel::checksubmit($IMEI, $checked, $order_id);
                    $status = RebuyModel::updateFStatus(5, $order_id);
                    $action = RebuyModel::setAction(4, $order_id);


                }
            }


        }else{

            echo "no data was submitted";
        }


    }

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
        $order_id=$this->activateAction();
        $results = RebuyModel::getDevice($order_id);
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
        $order_id=$this->activateAction();
       $quote = $_POST['quote'];
        $query = RebuyModel::SubmitQuote($order_id,$quote);
        $status=RebuyModel::updateFStatus(17,$order_id);
        $action=RebuyModel::setAction(8,$order_id);
       $results = RebuyModel::getQuote($order_id);
        View::renderTemplate('Rebuy/submitquote.html',
             [
            'results' => $results]);


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

        View::renderTemplate('Rebuy/entersubmit.html');

        $devicetype = $_POST['device_type'];
        $devicestorage = $_POST['device_storage'];
        $deviceconnection = $_POST['device_connection'];
        $devicecondition = $_POST['device_condition'];
        $devicecolour = $_POST['device_colour'];

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

        $paymenttype=$_POST['payment'];
        $IBAN=$_POST['IBAN'];
        $Tnv=$_POST['Tnv'];


       $customer_id= CustomerModel::createCustomer($firstname,$lastname,$email,$phone, $customer_type);
        echo '<pre>';
       echo $customer_id;
       $query=CustomerModel::createAddress($customer_id,$postcode,$streetnumber,$addition,$streetname,$city,$country);
       // RebuyModel::OrderSubmit($order_id, $devicetype, $devicestorage, $deviceconnection, $devicecondition, $devicecolour);
        echo $query;
        $order_id=OrderModel::createRebuyOrder($customer_id,$paymenttype);
       echo $order_id;
       //var_dump($_POST);
      echo  $device=DeviceModel::makeRebuyDevice($order_id,$devicetype,$devicestorage,$deviceconnection,$devicecondition);
      echo $status=RebuyModel::makeStatus($order_id)."</br>";
      echo $shipping=RebuyModel::createShippingStatus($order_id);
        echo $payment=FinanceModel::createPaymentData($customer_id,$order_id,$IBAN,$Tnv);

    }

    public function serviceAction()
    {
        View::renderTemplate('Rebuy/service.html');

    }

     public function setstatusAction()
     {
         $order_id=$this->activateAction();
         $results=RebuyModel::setStatus($order_id);
         View::renderTemplate('Rebuy/setstatus.html', [
             'results' => $results
         ]);
         echo '<pre>';
         var_dump($results);
        foreach($results as $result){
          $co=$results["customer_order_status"];
          $fo=$results["forza_order_status"];
          echo $co;
          echo $fo;




        }


     }

    public function acceptQuoteAction()
    {
        $order_id=$this->activateAction();
        $_SESSION['order_id']=$order_id;
        $results=RebuyModel::getQuote($order_id);
        View::renderTemplate('Rebuy/acceptquote.html',[
            'results'=>$results
        ]);




    }


    public function confirmAction()
    {
        //$order_id=$this->activateAction();
        $order_id=$_SESSION['order_id'];
        echo $order_id;

        $date=date('d-m-Y');
        echo $date;
        View::renderTemplate('Rebuy/confirm.html');
        $update=RebuyModel::setAccepted($order_id,$date);
        $action=RebuyModel::setAction(9,$order_id);
        $fstatus=RebuyModel::updateFStatus(11,$order_id);
        $status=RebuyModel::UpdateDeviceCustomerStatus(4,$order_id);



    }

    public function refuseoptionsAction()
    {
        View::renderTemplate('Rebuy/refuseoptions.html');

    }


    public function addtagsAction()
    {

        $results = RebuyModel::Overview();
        View::renderTemplate('Rebuy/addtags.html', [
                'results' => $results
            ]
        );


    }

    public function setStatus()
    {
        //$order_id=$this->activateAction();
        $results = RebuyModel::getStatus();

        foreach ($results as $result) {
            $order_id = $result['order_id'];
            $cstatus = $result['customer_order_status'];
            $fstatus = $result['status_id'];
            $action = $result['next_action_id'];
            $update=self::setAction($cstatus,$fstatus);



        }
        View::renderTemplate('Rebuy/setstatus.html', [
                'results' => $results
            ]
        );
    }

    public function setAction($cstatus,$fstatus)
    {


        //$action;
        $status = RebuyModel::setAction($action, $order_id);
    }


    public function setQuote()
    {




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
         $order_id=$this->activateAction();
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
         $order_id=$this->activateAction();
         $_SESSION['order_id']=$order_id;
         $results = RebuyModel::getShippingById($order_id);
         View::renderTemplate('Rebuy/editshipping.html', [
                 'results' => $results
             ]
         );


     }

     public function shippingupdateAction()
     {
         //$order_id=$this->activateAction();
         $order_id=$_SESSION['order_id'];
         if(isset($_POST['submit'])) {
             //var_dump($_POST['submit']);
             $status = $_POST['status'];
             $query=RebuyModel::updateShipping($status, $order_id);

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
         $results = RebuyModel::getShippingById($order_id);
         View::renderTemplate('Rebuy/shippingupdate.html', [
                 'results' => $results
             ]
         );


     }


     public function secondOfferAction()
     {
         //$order_id=$this->activateAction();
         $results = RebuyModel::GetReturns();
         View::renderTemplate('Rebuy/secondOffer.html', [
             'results' => $results
         ]);



     }

     public function submitsecondquoteAction()
     {
         $order_id=$this->activateAction();
         //$_SESSION['order_id'];
         $results=RebuyModel::retrievesecondquote($order_id);

         $order_id=$_SESSION['order_id'];
        // var_dump($_POST);
         $_SESSION['order_id']=$order_id;
         if(isset($_POST['submit'])) {
             $quote=$_POST['quote'];
            echo $query = RebuyModel::submitSecondQuote($order_id, $quote);
            $action=RebuyModel::setAction(10,$order_id);
         }else{

             echo "please enter new offer";
         };

         View::renderTemplate('Rebuy/submitsecondquote.html',[
             'results'=>$results

         ]);
     }

     public function entersecondofferAction()
     {
         $order_id=$this->activateAction();
         //$order_id=$_SESSION['order_id'];
         $_SESSION['order_id']=$order_id;
         $results=RebuyModel::retrievefirstoffer($order_id);
         View::renderTemplate('Rebuy/entersecondoffer.html',[
             'results' => $results
         ]);


     }

     public function sendsecofferAction()
     {
        $order_id=$this->activateAction();
         //$order_id=$_SESSION['order_id'];
        $results=RebuyModel::retrievesecondquote($order_id);
         View::renderTemplate('Rebuy/sendsecoffer.html',[
             'results' => $results
         ]);

     }

     public function ftstatusreportsAction()
     {
         



     }

     public function offersAction()
     {
        $results=RebuyModel::getOffers();
         View::renderTemplate('rebuy/offers.html'
             ,[
             'results' => $results
         ]
         );


     }

    public function paymentsAction()
    {
        $results=RebuyModel::getAcceptedOffers();
        View::renderTemplate('rebuy/payments.html'
            ,[
                'results' => $results
            ]
        );


    }


    public function returnsAction()
    {
        $results=RebuyModel::getReturns();
        View::renderTemplate('rebuy/returns.html'
            ,[
                'results' => $results
            ]
        );


    }

    public function recycleAction()
    {
        $order_id=$_SESSION['order_id'];
        View::renderTemplate('Rebuy/recycle.html');
        $status=RebuyModel::UpdateDeviceCustomerStatus(6,$order_id);
        $fstatus=RebuyModel::updateFStatus(8,$order_id);
        $action=RebuyModel::setAction(12,$order_id);



    }

    public function closeAction()
    {
        $results=RebuyModel::getClose();
        View::renderTemplate('Rebuy/close.html'
            ,[
                'results' => $results
            ]
        );


    }

    public function closeorderAction()
    {
        $order_id=$this->activateAction();
        $results=RebuyModel::getOrderToClose($order_id);
        View::renderTemplate('Rebuy/closeorder.html',[
            'results'=>$results

        ]);

    }

    public function ordercloseAction()
    {
        $order_id=$this->activateAction();
        if(isset($_POST['submit']))
        {
            $result=RebuyModel::closeOrder($order_id);
        }
        View::renderTemplate('Rebuy/orderclose.html');


    }


    public function acceptedAction()
    {
        View::renderTemplate('Rebuy/accepted.html');

    }

    public function payAction()
    {
        $order_id=$this->activateAction();
        $results=RebuyModel::getPaymentDetails($order_id);
        View::renderTemplate('Rebuy/pay.html',[
            'results'=>$results

        ] );


    }

    public function sendAction()
    {
        $order_id=$this->activateAction();
        $results=RebuyModel::getPaymentDetails($order_id);
        $status=RebuyModel::updateFStatus(12,$order_id);
        View::renderTemplate('Rebuy/send.html'
            ,[
            'results'=>$results

        ]

    );
        var_dump($results);


    }

    public static function refusedoffersAction()
    {
        $results=RebuyModel::getRefused1();
        View::renderTemplate('Rebuy/refusedoffers.html'
            ,[
            'results'=>$results

        ]);

    }

    public static function recycleordersAction()
    {
        $results=RebuyModel::getRecycle();

        View::renderTemplate('Rebuy/recycleorders.html'
            ,[
                'results' => $results
            ]
        );

    }

    public function returndeviceAction()
    {
        $order_id=$_SESSION['order_id'];
        View::renderTemplate('Rebuy/returndevice.html');
        $status=RebuyModel::UpdateDeviceCustomerStatus(12,$order_id);
        $action=RebuyModel::setAction(11,$order_id);


    }

    public function sendsecondoffermailAction()

         {
             $order_id=$this->activateAction();
             View::renderTemplate('Rebuy/sendsecondoffermail.html');

             if(isset($_POST['submit'])) {
                 $name=$_POST['name'];
                 $email=$_POST['email'];
                 $subject="Second Offer from Forza";
                 $quote=$_POST['msg'];
                 $body="Thank you for sending us your device. 
                We would like to offer you \r\n $quote \r\n euro for it". 'To accept or refuse please visit <a href='.'"'.'http://forzaerp.local/rebuy/'.$order_id.'/'.'acceptsecquote'.'"'.'>This Link</a>';
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
                     $status=RebuyModel::updateFStatus(10,$order_id);
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


    public function sendsecmailAction()
    {
        $order_id=$_SESSION['order_id'];
        $results=RebuyModel::getSecQuote($order_id);

        View::renderTemplate('Rebuy/sendsecmail.html',['results'=>$results]);




    }

    public function acceptsecquoteAction()
    {
             $order_id=$this->activateAction();
             $_SESSION['order_id']=$order_id;
             $results=RebuyModel::retrievesecondquote($order_id);
             View::renderTemplate('Rebuy/acceptsecquote.html',[
                 'results'=>$results
             ]);


    }

    public function secconfirmAction()
    {
        $order_id=$_SESSION['order_id'];

        $results=RebuyModel::getQuote($order_id);
        //echo $order_id;
        $offer_type='second offer';
        $date = date('Y-m-d');


        $offer=new Offer($results[0][21],$order_id,$results[0][14],$date,$offer_type,1);
        View::renderTemplate('Rebuy/secconfirm.html');
       // $update=RebuyModel::setAccepted($order_id,$date);
        $action=RebuyModel::setAction(9,$order_id);
        $fstatus=RebuyModel::updateFStatus(11,$order_id);
        $status=RebuyModel::UpdateDeviceCustomerStatus(7,$order_id);


    }

    public function secrefuseoptionsAction()
    {
        $order_id=$_SESSION['order_id'];
        $results=RebuyModel::getQuote($order_id);
        //echo $order_id;
        $offer_type='second offer';
        $date = date('Y-m-d');


        $offer=new Offer($results[0][21],$order_id,$results[0][14],$date,$offer_type,0);
        View::renderTemplate('Rebuy/secrefuseoptions.html');

    }

    public function returnAction()
    {
        $order_id=$this->activateAction();
        $results=RebuyModel::getAddressbyOrderId($order_id);
        View::renderTemplate('Rebuy/return.html',['results'=>$results]);

    }

    public function failcardAction()
    {
        $order_id=$this->activateAction();
        $_SESSION['order_id']=$order_id;
        View::renderTemplate('Rebuy/failcard.html');
    }

    public function setfailcardAction()
    {
        //$order_id=$_SESSION['order_id'];

        $order_id=$this->activateAction();
        $results=RebuyModel::getOrderActionById($order_id);

        $rma_id=$this->activateAction();
        $imei=$_SESSION['imei'];
        $date=date('Y-m-d');
        View::renderTemplate('RMA/rmafailcard.html');
        echo '<pre>';
        print_r($_POST);
        /**$failcard=$_POST['failcard'];**/
        function IsChecked($chkname,$value)
        {
            if(!empty($_POST[$chkname]))
            {
                foreach($_POST[$chkname] as $chkval)
                {
                    if($chkval == $value)
                    {
                        return true;
                    }
                }
            }
            return false;
        }
        if(isset($_POST['sound'])){
            print_r($_POST['sound']);
            if(IsChecked('sound','30'))
            {
                $speakers=1;
            }else{
                $speakers=0;
            }
            if(IsChecked('sound','7'))
            {
                $front_speaker=1;
            }else{
                $front_speaker=0;
            }
            if(IsChecked('sound','24'))
            {
                $microphone_bottom=1;
            }else{
                $microphone_bottom=0;
            }
            if(IsChecked('sound','26'))
            {
                $internal_speakers=1;
            }else{
                $internal_speakers=0;
            }
            if(IsChecked('sound','13'))
            {
                $microphone_back=1;
            }else{
                $microphone_back=0;
            }
            if(IsChecked('sound','3'))
            {
                $microphone_top=1;
            }else{
                $microphone_top=0;
            }
            $sound_inspection_id=RMAModel::makeRMASoundInspection($rma_id,$imei,$date,$speakers,$internal_speakers,$microphone_bottom,$microphone_back,$front_speaker,$microphone_top);
            echo "the id of the sound inspection is ".$sound_inspection_id;
        }else{
            echo 'no sound issues';
            $sound_inspection_id=0;
        }

        if(isset($_POST['power']))
        {
            print_r($_POST['power']);
            if(IsChecked('power','29'))
            {
                $power=1;
            }else{
                $power=0;
            }

            if(IsChecked('power','23'))
            {
                $battery=1;
            }else{
                $battery=0;
            }

            if(IsChecked('power','12'))
            {
                $dock_connector=1;
            }else{
                $dock_connector=0;
            }
            $power_inspection_id=RMAModel::makeRMAPowerInspection($rma_id,$imei,$date,$battery,$dock_connector,$power);
            echo "the id of the power inspection is ".$power_inspection_id;
        }else{
            $power_inspection_id=0;
            echo "no power issues";
        }

        if(isset($_POST['screen']))
        {
            print_r($_POST['screen']);
            if(IsChecked('screen','28'))
            {
                $LCD=1;
            }else{
                $LCD=0;
            }
            if(IsChecked('screen','11'))
            {
                $multi_touch=1;
            }else{
                $multi_touch=0;
            }
            if(IsChecked('screen','0'))
            {
                $img_quality=1;
            }else{
                $img_quality=0;
            }
            if(IsChecked('screen','6'))
            {
                $ambient_light=1;
            }else{
                $ambient_light=0;
            }
            if(IsChecked('screen','5'))
            {
                $auto_brightness=1;
            }else{
                $auto_brightness=0;
            }
            if(IsChecked('screen','4'))
            {
                $proximity=1;
            }else{
                $proximity=0;
            }
            $screen_inspection_id=RMAModel::makeRMAScreenInspection($rma_id,$imei,$date,$LCD,$multi_touch,$img_quality,$ambient_light,$auto_brightness,$proximity);
            echo "the id of the screen inspection is  ".$screen_inspection_id;
        }else{
            $screen_inspection_id=0;
            echo "No screen problems";
        }

        if(isset($_POST['buttons']))
        {
            print_r($_POST['buttons']);

            if(IsChecked('buttons','25'))
            {
                $headset_jack=1;
            }else{
                $headset_jack=0;
            }
            if(IsChecked('buttons','21'))
            {
                $power_button=1;
            }else{
                $power_button=0;
            }


            if(IsChecked('buttons','16'))
            {
                $home_button=1;
            }else{
                $home_button=0;
            }


            if(IsChecked('buttons','9'))
            {
                $volume_flex_cable=1;
            }else{
                $volume_flex_cable=0;
            }

            if(IsChecked('buttons','8'))
            {
                $touch_id=1;
            }else{
                $touch_id=0;
            }
            $buttons_inspection_id=RMAModel::makeRMAButtonsInspection($rma_id,$imei,$date,$headset_jack,$power_button,$volume_flex_cable,$home_button,$touch_id);
            echo "the id of the buttons inspection is ".$buttons_inspection_id;
        }else{
            $buttons_inspection_id=0;
            echo "no jacks/buttons problems";
        }

        If(isset($_POST['connections']))
        {
            Print_r($_POST['connections']);
            if(IsChecked('connections','17'))
            {
                $SIM_fail=1;
            }else{
                $SIM_fail=0;
            }
            if(IsChecked('connections','18'))
            {
                $no_cell_conn=1;
            }else{
                $no_cell_conn=0;
            }
            if(IsChecked('connections','19'))
            {
                $signal_strength=1;
            }else{
                $signal_strength=0;
            }
            if(IsChecked('connections','20'))
            {
                $wifi_bt=1;
            }else{
                $wifi_bt=0;
            }
            $connections_inspection_id=RMAModel::makeRMAConnsInspection($rma_id,$imei,$date,$wifi_bt,$signal_strength,$no_cell_conn,$SIM_fail);;
            echo "the id of the connections inspection is ".$connections_inspection_id;


        }else{
            $connections_inspection_id=0;
            echo "no connections problems";
        }

        if(isset($_POST['misc']))
        {
            print_r($_POST['misc']);

            if(IsChecked('misc','27'))
            {
                $vibration_motor=1;
            }else{
                $vibration_motor=0;
            }

            if(IsChecked('misc','22'))
            {
                $GPS=1;
            }else{
                $GPS=0;
            }

            if(IsChecked('misc','14'))
            {
                $torch=1;
            }else{
                $torch=0;
            }
            $misc_inspection_id=RMAModel::makeRMAMiscInspection($rma_id,$imei,$date,$vibration_motor,$GPS,$torch);
            echo "the id of the miscellaneous inspection is ".$misc_inspection_id;

        }else{
            $misc_inspection_id=0;
            echo "no misc problems";
        }

        if(isset($_POST['camera']))
        {
            print_r($_POST['camera']);

            if(IsChecked('camera','15'))
            {
                $rear_camera=1;
            }else{
                $rear_camera=0;
            }
            if(IsChecked('camera','2'))
            {
                $front_camera=1;
            }else{
                $front_camera=0;
            }



            if(IsChecked('camera','1'))
            {
                $fcfc=1;
            }else{
                $fcfc=0;
            }
            $camera_inspection_id=RMAModel::makeRMACameraInspection($rma_id,$imei,$date,$rear_camera,$front_camera,$fcfc);
            echo "the camera inspection id is ".$camera_inspection_id;
        }else{
            $camera_inspection_id=0;
            echo "no camera problems";
        }




        if(IsChecked('failcard','12'))
        {
            $physical_damage=1;
        }else{
            $physical_damage=0;
        }



        if(IsChecked('failcard','16'))
        {
            $charging=1;
        }else{
            $charging=0;
        }

        if(IsChecked('failcard','20'))
        {
            $power_flex_cable=1;
        }else{
            $power_flex_cable=0;
        }


        $date=date('Y-m-d');
        echo $date;
        echo $imei;
        echo $status=RMAModel::setRMAStatus(4,$rma_id);
        echo "created history event ". $event=EventModel::createHistoryEvent($imei,1);
        echo $inspection=RMAModel::makeRMAInspection($rma_id,$imei,$buttons_inspection_id,$camera_inspection_id,$connections_inspection_id,$misc_inspection_id,$power_inspection_id,$screen_inspection_id,$sound_inspection_id,$date);



    }

    public function takeactionAction()
    {
        $order_id=$this->activateAction();
        $results=RebuyModel::getQuote($order_id);
        View::renderTemplate('Rebuy/takeaction.html',
          ['results'=>$results]

            );

    }

    public function returnorderAction()
    {
        $order_id=$this->activateAction();
        $results=RebuyModel::getQuote($order_id);
        View::renderTemplate('Rebuy/returnorder.html',
            ['results'=>$results]

        );

    }

     public function recycledeviceAction()
     {
         $order_id=$this->activateAction();
         $status=RebuyModel::updateFStatus(14,$order_id);
         $action=rebuyModel::setAction(13,$order_id);
         $results=RebuyModel::getOrderActionById($order_id);
         View::renderTemplate('Rebuy/recycledevice.html',
             ['results'=>$results]

         );

     }

}
















