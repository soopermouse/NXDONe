<?php
/**
 * Created by PhpStorm.
 * User: darke
 * Date: 31/10/2018
 * Time: 20:04
 */

namespace App\Controllers;
use App\Helpers\Inspection;
use App\Helpers\Action;
use App\Helpers\setAction;
use App\Models\ActionModel;
use App\Models\DeviceModel;
use App\Models\HistoryModel;
use App\Models\InspectionModel;
use App\Models\OrderModel;
use App\Models\CustomerModel;
use App\Models\ReportModel;
use App\Models\StatusModel;
use \Core\View;
use \Core\Customer;
use \Core\Order;
use App\Models\RMAModel;
use App\Models\RepairModel;
use App\Models\EventModel;
use \Core\Device;

require '..\vendor\autoload.php';
class RMA extends \Core\Controller
{
    public function indexAction()
    {

        //$results = RebuyModel::getOrders();
        View::renderTemplate('RMA/index.html'
        //, [
        //'results' => $results
        //]
        );

    }

    public function activateAction()
    {
        $id = $this->route_params['id'];
        return $id;
    }

    public function checkAction()
    {
        //$results = RMAModel::getOrders();
        View::renderTemplate('RMA/check.html'
        //, [
        //'results' => $results
        //]
        );

    }

    public function reportsAction()
    {


        View::renderTemplate('RMA/reports.html'
        );

    }

    public function ordersAction()
    {

        $results = RMAModel::getRMAs();
        View::renderTemplate('RMA/orders.html'
            , [
                'results' => $results
            ]
        );

    }

    public function rmastatusreportsAction()
    {
        $status_id=$_POST['status_id'];
        $results = ReportModel::RMAbyStatus($status_id);
        View::renderTemplate('RMA/rmastatusreports.html'
            , [
                'results' => $results
            ]
        );

    }

    public function rmaproblemreportsAction()
    {
        $problem_id=$_POST['problem_id'];
        $results = ReportModel::RMAByProblemType($problem_id);
        View::renderTemplate('RMA/rmastatusreports.html'
            , [
                'results' => $results
            ]
        );

    }

    public function rmadevicereportsAction()
    {
        $device_type=$_POST['device_type'];
        $results = ReportModel::RMAByDeviceType($device_type);
        View::renderTemplate('RMA/rmadevicereports.html'
            , [
                'results' => $results
            ]
        );

    }

    public function rmabusinessAction()
    {
        $results = ReportModel::getRMAs();
        View::renderTemplate('RMA/rmabusiness.html'
            , [
                'results' => $results
            ]
        );

    }

    public function refusedrmaAction()
{
    $results = ReportModel::RMAbyStatus(11);
    View::renderTemplate('RMA/refusedrma.html'
        , [
            'results' => $results
        ]
    );

}

    public function rmabyuserAction()
    {
        $user_id=$_POST['user_id'];
        $results = ReportModel::RMAbyUserId($user_id);
        View::renderTemplate('RMA/rmabyuser.html'
            , [
                'results' => $results
            ]
        );

    }


    public function inspectionAction()
    {
       $results = $results = RMAModel::getRMAsByStatus(3);
        View::renderTemplate('RMA/inspection.html'
       , [
        'results' => $results
        ]
        );


    }

    public function rmainspectAction()
    {

        $rma_id=$this->activateAction();
        $imei=RMAModel::getIMEI($rma_id);
        $_SESSION['imei']=$imei;
       $results=RMAModel::getRMA($rma_id);
        View::renderTemplate('RMA/rmainspect.html'
         , [
        'results' => $results
         ]
        );

    }

    public function repairAction()
    {

        $results = RMAModel::getRMAsByStatus(4);

        View::renderTemplate('RMA/repair.html'
        , [
        'results' => $results
        ]
        );

    }



    public function inventoryAction()
    {

        //$results = RebuyModel::getOrders();
        View::renderTemplate('RMA/inventory.html'
        //, [
        //'results' => $results
        //]
        );

    }

    public function mailAction()
    {

        $results = ReportModel::getRMAs();
        View::renderTemplate('RMA/mail.html'
         , [
        'results' => $results
         ]
        );

    }

    public function newmailAction()
    {
        $order_id=$this->activateAction();
        $results = RMAModel::getRMA($order_id);
        View::renderTemplate('RMA/newmail.html'
        , [
       'results' => $results
        ]
        );

    }

    public function sendmailAction()
    {
        print_r($_POST);
        //$order_id=$this->activateAction();
        //$results = RebuyModel::getQuote($order_id);
        View::renderTemplate('Rebuy/sendmail.html'
            //, [
           // 'results' => $results
       // ]
    );

    }

    public function mailsentAction()
    {
        $rma_id=$this->activateAction();
        View::renderTemplate('RMA/mailsent.html');

        if(isset($_POST['submit'])) {
            $name=$_POST['name'];
            $email=$_POST['email'];
            $subject="Update from Forza";
            $quote=$_POST['msg'];
            $body="This is an update about your rma order $rma_id." ;
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
                $status=RMAModel::updateOStatus(9,$order_id);
                $action=Action::setAction($status);
                $set=RMAModel::setAction($action,$rma_id);
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

    public function checkIMEIAction()
    {

            $imei = $_POST['imei'];
            $_SESSION['imei']=$imei;
           $count=RMAModel::checkIMEI($imei);
           if($count!=0) {
               //echo'<pre>';

                   $results = RMAModel::getWarranty($imei);
                //print_r($results);
               View::renderTemplate('RMA/checkIMEI.html'
                   , [
                       'results' => $results]
               );
           }else{
              View::renderTemplate('RMA/checkfailed.html');
           }




    }

    public function historyAction()
    {



        View::renderTemplate('RMA/history.html'
        //, [
        //'results' => $results
       //]
        );

    }

    public function devicehistoryAction()
    {

        $imei=$this->activateAction();


        $results=RMAModel::getRMAHistory($imei);
        // echo '<pre/>';
        //print_r($results);
        View::renderTemplate('RMA/devicehistory.html'
            , [
                'results' => $results
            ]
        );

    }

    public function gethistoryAction()
    {
        if(isset($_POST['imei'])&& !empty($_POST['imei'])) {

            $imei = $_POST['imei'];
            $count = RMAModel::checkIMEI($imei);
            if ($count != 0) {

                $results = HistoryModel::getHistory($imei);
                $message = "IMEI found!";
                // echo '<pre/>';
                //print_r($results);
                View::renderTemplate('RMA/devicehistory.html'
                    , [
                        'results' => $results,
                        'message' => $message
                    ]
                );
            }elseif($count==0)
            {
                $message="IMEI unknown";
                View::renderTemplate('RMA/gethistory.html'
                    , [
                        'message' => $message
                    ]
                );
            }

            }else{
            $message="not entered";
            View::renderTemplate('RMA/gethistory.html'
                , [
                    'message' => $message
                ]
            );
        }

    }


    public function stepsAction()
{
    View::renderTemplate('RMA/steps.html'
    //, [
    //'results' => $results
    //]
    );

}

    public function testorderAction()
    {
       $imei=$this->activateAction();
        $results=DeviceModel::getDeviceByImei($imei);
        View::renderTemplate('RMA/testorder.html'
       , [
        'results' => $results,
            'imei'=>$imei
        ]
        );


    }


    public function entertestAction()
    {

        View::renderTemplate('RMA/entertest.html'

        );

    }


    public function rmasubmitAction()
    {
        //$imei=$this->activateAction();
        //$results=DeviceModel::getDeviceByImei($imei);
        View::renderTemplate('RMA/rmasubmit.html'
        //, [
        //'results' => $results
        // ]
        );

        echo '<pre>';
        if (isset($_POST['submit'])) {
            $imei=$_POST['imei'];
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
            $problem_id=$_POST['Options'];
            $comment=$_POST['comment'];
            $date=date('Y-m-d');
        } else {
            echo 'no data entered';
        }
        $check = $_POST['check'];


        $N = count($check);
        if ($N == 3) {
            print_r($_POST);
            $customer_id= CustomerModel::createCustomer($firstname,$lastname,$email,$phone, $customer_type);
            echo '<pre>';
            echo 'Created ' .$customer_id;
            echo $query=CustomerModel::createAddress($customer_id,$postcode,$streetnumber,$addition,$streetname,$city,$country);
            //$device_id=DeviceModel::getDeviceId($imei);
            echo $rma_id=OrderModel::makeRMAOrder($customer_id,$date,$imei);
            echo $details=RMAModel::makeRMADetails($rma_id,$problem_id,$comment,$date);
            echo $status=RMAModel::createStatus($rma_id);
            echo $shipping=RMAModel::createShippingStatus($rma_id);

            echo "event id ".$event=EventModel::CreateEvent(1,12,$imei,5). "has been created";
            $action=Action::updateRMAAction($status);
            $set=RMAModel::setAction($action,$rma_id);
        }else {
            if (empty($_POST['check']['0'])) {

                die("please ensure you have removed ICloud lock and turned off Find My Iphone");


            } elseif (empty($_POST['check']['1'])) {

                die("please ensure you have switched back to factory settings");
            } elseif (empty($_POST['check']['2'])) {
                die("please accept that Forza has no responsibility over loss of data");

            }
        }




               // if (empty($_POST['check']['lock'])) {

                  //  die("please ensure you have removed ICloud lock and turned off Find My Iphone");


                //}
                //elseif (empty($_POST['check'][''])) {
                /* $validate = Device::validateIMEI($_POST['IMEI']);
                 //$IMEI = $_POST['IMEI'];
                  }

                  //if (empty($_POST['check'])) {
                 // echo "No options were checked";


                // } else {

                  echo "check passed!";
                  $checked = 1;
                 $date = date('Y-m-d');
                 // $query = RebuyModel::checksubmit($IMEI, $checked, $order_id, $date);
                  //$status = RebuyModel::updateFStatus(4, $order_id);
                 // $action = RebuyModel::setAction(6, $order_id);

                  } else {
                  echo "the device did not pass check, please see notes.";
                 $checked = 0;
                  $date = date('Y-m-d');
                 $query = RebuyModel::checksubmit($IMEI, $checked, $order_id, $date);
                  $status = RebuyModel::updateFStatus(5, $order_id);
                  $action = RebuyModel::setAction(4, $order_id);


                  }*/
           // }
        }


    public function rmastepsAction()
    {

        View::renderTemplate('RMA/rmasteps.html');
    }

    public function inspectAction()
    {
        View::renderTemplate('RMA/inspect.html');


    }

     public function rmafailcardAction()
     {
         $imei = $this->activateAction();
         $rma_id = RMAModel::getRMAId($imei);
         $date = date('Y-m-d');
         View::renderTemplate('RMA/rmafailcard.html');
         echo '<pre>';
         print_r($_POST);
         /**$failcard=$_POST['failcard'];**/
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

         if (!empty($_POST['sound'])) {
             //($_POST['sound']);
             print_r($sound[] = $_POST['sound']);
             //echo $sound_inspection_id = InspectionModel::makeSoundInspection($rma_id, $imei, $date, $sound);
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
             $sound_inspection_id=InspectionModel::makeSoundInspection($rma_id,$imei,$date,$speakers,$internal_speakers,$microphone_bottom,$microphone_back,$front_speaker,$microphone_top);
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
                 $power_inspection_id=InspectionModel::makePowerInspection($rma_id,$imei,$date,$battery,$dock_connector,$power);
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
                 $screen_inspection_id=InspectionModel::makeScreenInspection($rma_id,$imei,$date,$LCD,$multi_touch,$img_quality,$ambient_light,$auto_brightness,$proximity);
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
                 $buttons_inspection_id=InspectionModel::makeButtonsInspection($rma_id,$imei,$date,$headset_jack,$power_button,$volume_flex_cable,$home_button,$touch_id);
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
                 $connections_inspection_id=InspectionModel::makeConnsInspection($rma_id,$imei,$date,$wifi_bt,$signal_strength,$no_cell_conn,$SIM_fail);;
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
                 $misc_inspection_id=InspectionModel::makeMiscInspection($rma_id,$imei,$date,$vibration_motor,$GPS,$torch);
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
                 $camera_inspection_id=InspectionModel::makeCameraInspection($rma_id,$imei,$date,$rear_camera,$front_camera,$fcfc);
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
        // echo $imei;
         echo $status=RMAModel::setRMAStatus(4,$rma_id);
         $action=Action::updateRMAAction($status);
         $update=ActionModel::setRMAAction($action,$rma_id);
         $event=EventModel::CreateEvent(1,1,$imei,5);

         echo "created inspection id ".$inspection_id=InspectionModel::makeInspection($rma_id,$imei,$buttons_inspection_id,$camera_inspection_id,$connections_inspection_id,$misc_inspection_id,$power_inspection_id,$screen_inspection_id,$sound_inspection_id,$date,2);
         echo "created Repair order ".$repair=RepairModel::makeRepairOrder($imei,$inspection_id,1);
         echo $status=RepairModel::makerepairstatus($repair,$imei,2,2);

         }



      public function dorepairAction()
      {
          $imei= $this->activateAction();
          //echo $imei = RMAModel::getIMEI($rma_id);
         $rma_id=RMAModel::getRMAId($imei);
          $results = RMAModel::getRMA($rma_id);
          echo $device_type=DeviceModel::getDeviceModel($imei);
          $parts=RepairModel::getRepairOneParts($device_type);
          $hiss = HistoryModel::getHistory($imei);
          $sn = InspectionModel::checkSoundInspection($rma_id);
          $scn = InspectionModel::checkScreenInspection($rma_id);
          //echo $scn;
          $pwr = InspectionModel::checkPowerInspection($rma_id);
          //echo $pwr;
          $msc = InspectionModel::checkMiscInspection($rma_id);
          //echo $msc;
         $conn = InspectionModel::checkConnInspection($rma_id);
          //echo $conn;

         $warrantys = RMAModel::getWarranty($imei);
          //if ($sn != 0 && $scn != 0 && $pwr != 0) {
              $sounds = InspectionModel::getSoundInspection($rma_id);
              $screens = InspectionModel::getScreenInspection($rma_id);
              $powers = InspectionModel::getPowerInspection($rma_id);
              $miscs = InspectionModel::getMiscInspection($rma_id);
              $cons = InspectionModel::getConnInspection($rma_id);
              $cams = InspectionModel::getCameraInspection($rma_id);
              $buttons = InspectionModel::getButtonsInspection($rma_id);
              //echo '<pre>';
              //foreach ($sounds as $key => $link) {
                  //if ($link !== '1') {
                    // unset($sounds[$key]);
                 //}
                 // return $sounds;
              //}
              // print_r($sounds);*/


              //$message = $warrantys[0]['device_model'];
              //echo $_SESSION['device'] = $message;
                $event=EventModel::CreateEvent(1,4,$imei,5);

              View::renderTemplate('RMA/dorepair.html'
                  ,
                  ['results' => $results
                      ,'sounds' => $sounds,
                     'screens' => $screens,
                      'powers' => $powers,
                     'miscs' => $miscs,
                      'cons' => $cons,
                      'cams' => $cams,
                      'buttons' => $buttons,
                      'hiss' => $hiss,
                      'warrantys' => $warrantys,
                      'parts'=>$parts
                      //'message' => $message
                  ]
      );
          //} else {
             // View::renderTemplate('RMA/dorepair.html',
             //     ['results' => $results]);
              // }
          //}
      }

    public function dorepairtwoAction()
    {
        $imei=$this->activateAction();
       $rma_id=RMAModel::getRMAId($imei);

        $devices=RMAModel::getWarranty($imei);
        echo $device_id=DeviceModel::getDeviceModel($imei);
        $results=RepairModel::getRepairTwoParts($device_id);
        //$results=RepairModel::getrepair2parts();
        //$event=EventModel::CreateEvent(1,5,$imei);
        $status=RMAModel::setRMAStatus(15,$rma_id);
        $action=Action::updateRMAAction($status);
        $set=RMAModel::setAction($action,$rma_id);
       // $historyevent=EventModel::createHistoryEvent($imei,5);
        View::renderTemplate('RMA/dorepairtwo.html',[
            'rma_id'=>$rma_id,
            'imei'=>$imei,
            'devices'=>$devices,
            'results'=>$results

        ]);
    }

    public function repairdoneAction()
    {
        $imei=$this->activateAction();
        $rma_id=RMAModel::getRMAId($imei);
        $message="meow";
        $status=RMAModel::setRMAStatus(5,$rma_id);
        $action=Action::updateRMAAction($status);
        $set=RMAModel::setAction($action,$rma_id);
        $part_type=$_POST['part_type'];
        $comments=$_POST['comments'];
        $user_id=4;
        $status='completed';

        //$device=DeviceModel::;
        $date=date('Y-m-d');
        //echo '<pre>';
        //print_r($_POST);
        View::renderTemplate('RMA/repairdone.html',[
            'message'=>$message,
            'imei'=>$imei,
            //'device'=>$device,
            'date'=>$date
        ]);
        echo "repair id done" .$repair=RepairModel::DoRepairOne($imei,$comments,$part_type,$user_id,$status);
        echo "created event ".$event=EventModel::CreateEvent($user_id,4,$imei,5);

    }

    public function rmashippingAction()
    {
        $results = RMAModel::getShipping();
        View::renderTemplate('RMA/rmashipping.html',[
            'results'=>$results
        ]);

    }

    public function editshippingAction()
    {
        $rma_id=$this->activateAction();
        $_SESSION['rma_id']=$rma_id;
        $results = RMAModel::getShippingbyId($rma_id);
        View::renderTemplate('RMA/editshipping.html',[
            'results'=>$results
        ]);
    }

    public function apicheckAction()
    {
        View::renderTemplate('RMA/apicheck.html');

    }

    public function checkimeiapiAction()
    {
        $imei=$_POST['imei'];
        if (empty($_POST['imei'])) {

            die("IMEI not present. Please go back and enter it.");


        } else {
            $validate = Device::validateIMEI($_POST['imei']);
            $mei = $_POST['imei'];

        }
        $results=RMAModel::getWarranty($imei);
        View::renderTemplate('RMA/checkimeiapi.html'
           ,
            [
            'imei'=>$imei]
        );
        echo '<pre>';
       //print_r($results);
        $date=date('Y-m-d');
        if($results[0][9]>$date)
        {
            echo 'warranty valid. Please <a href="'.$imei.'/'.'testorder">click here to start an RMA </a>';
        }else{
            echo 'warranty ended. You can start a <a href='.'"https://www.forza-refurbished.nl/reparatiepaid"'.'> repair order</a>'.' instead';
            
        }
    }

    public function repairtwodoneAction()
    {
        $imei=$this->activateAction();
        $rma_id=RMAModel::getRMAId($imei);
        echo $status=RMAModel::setRMAStatus(6,$rma_id);

        $devices=RMAModel::getWarranty($imei);
        $date=date('Y-m-d');
        $part_name=$_POST['part_name'];
        $comments=$_POST['comments'];
        $user_id=2;
        $status="completed";
        View::renderTemplate('RMA/repairtwodone.html'
           ,[

            'imei'=>$imei,
            'devices'=>$devices,
            'date'=>$date,
                'rma_id'=>$rma_id,
                'part_name'=>$part_name,
                'comments'=>$comments
        ]

    );
         //echo "repair id done" .$repair=RepairModel::DoRepairTwo($imei,$comments,$part_name,$user_id,$status);
        echo "created event ".$event=EventModel::CreateEvent($user_id,5,$imei,5);

        $action=Action::updateRMAAction($status);
        $updateAction=ActionModel::setRMAAction($rma_id,$status);


    }

    public function PRInspectionAction()
    {
        $results = RMAModel::getRMAsByStatus(5);
        $results2=RMAModel::getRMAsByStatus(6);
        View::renderTemplate('RMA/PRinspection.html'
            , [
                'results' =>$results,
                'results2'=>$results2

            ]
        );

    }

    public function returnAction()
    {
        $results=RMAModel::getRMAsByStatus(12);
        View::renderTemplate('RMA/return.html'
        , [
        'results' => $results
        ]
        );

    }

    public function shippingupdateAction()
    {
        $rma_id=$_SESSION['rma_id'];
        if(isset($_POST['submit'])) {
            //var_dump($_POST['submit']);
            echo $fstatus = $_POST['status'];
            $query=RMAModel::updateShipping($fstatus, $rma_id);

            switch($fstatus) {
                case 3:
                    $fstatus = 3;
                    $query = RMAModel::updateFStatus(3, $rma_id);
                    $status=RMAModel::updateOStatus(3,$rma_id);
                    break;

                case 7:
                    //$action = 1;
                    $query = RMAModel::updateFStatus(7, $rma_id);
                    $status=RMAModel::updateOStatus(3,$rma_id);
                    break;

            }

        }
        else{

            echo "no info was sent";
        }
        $results = RMAModel::getShippingById($rma_id);
        $status=
        View::renderTemplate('RMA/shippingupdate.html', [
                'results' => $results
            ]
        );
    }

    public function PRinspectAction()
    {
        $rma_id=$this->activateAction();
        View::renderTemplate('RMA/PRinspect.html');
    }

    public function PRfailcard()
    {
        $imei=$this->activateAction();
        $rma_id=RMAModel::getRMAId($imei);
        $date=date('Y-m-d');


        if(empty($_POST['failcard'])&&(empty($_POST['sound']))&&(empty($_POST['power']))&&(empty($_POST['screen']))&&(empty($_POST['buttons'])) &&(empty($_POST['connections']))&&(empty($_POST['misc']))&&(empty($_POST['camera'])))
        {
            $message= "device has been repaired";
            $query = RMAModel::setRMAStatus(12, $rma_id);
            $status=12;

        }else {
            //$failcard = $_POST['failcard'];
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

                echo $sound = InspectionModel::makeSoundInspection($rma_id, $imei, $date, $speakers, $internal_speakers, $microphone_bottom, $microphone_back, $front_speaker, $microphone_top);
            } else {
                echo 'no sound issues';
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

                echo $power = InspectionModel::makePowerInspection($rma_id, $imei, $date, $battery, $dock_connector, $power);
            } else {

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

                echo $screen = InspectionModel::makeScreenInspection($rma_id, $imei, $date, $LCD, $multi_touch, $img_quality, $ambient_light, $auto_brightness, $proximity);
            } else {

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

                echo $buttons = InspectionModel::makeButtonsInspection($rma_id, $imei, $date, $headset_jack, $power_button, $volume_flex_cable, $home_button, $touch_id);
            } else {

                echo "no jacks/buttons problems";
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
                echo $conns = InspectionModel::makeConnsInspection($rma_id, $imei, $date, $wifi_bt, $signal_strength, $no_cell_conn, $SIM_fail);


            } else {
                echo "no connections problems";
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

                echo $misc = InspectionModel::makeMiscInspection($rma_id, $imei, $date, $vibration_motor, $GPS, $torch);

            } else {
                echo "no misc problems";
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

                echo $cam = InspectionModel::makeCameraInspection($rma_id, $imei, $date, $rear_camera, $front_camera, $fcfc);
            } else {

                echo "no camera problems";
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
            $message="redo repair";
            $message='<a href="redorepair"><button class="btn-danger">Repair </button></a>';
            echo $inspection = InspectionModel::makeInspection($rma_id, $imei, $buttons, $cam, $conns, $misc, $power, $screen, $sound, $date,3);
            $query = RMAModel::setRMAStatus(13, $rma_id);
            $repair=RepairModel::makeRepairOrder($imei,$inspection,1);
            $status=13;

        }


        $date=date('Y-m-d');
        echo $date;
        echo $imei;
        $action=Action::updateRMAAction($status);
        $set=RMAModel::setAction($action,$rma_id);
        $event=EventModel::CreateEvent(1,1,$imei,5);

        View::renderTemplate('RMA/PRfailcard.html',
            [
                'message'=>$message
            ]);
        echo '<pre>';
        print_r($_POST);
    }

    public function redorepairAction()
    {
        View::renderTemplate('RMA/redorepair.html');

    }

    public function returndeviceAction()
    {
        $imei=$this->activateAction();
        $rma_id=RMAModel::getRMAId($imei);
        print_r($customer=RMAModel::getCustomerId($rma_id));
        $customer_id=$customer[0][0];
        $results=CustomerModel::getAddress($customer_id);
        View::renderTemplate('RMA/returndevice.html',
            [
               'results'=>$results,
                'rma_id'=>$rma_id
            ]);
    }

    public function printlabelAction()
    {
        $rma_id=$this->activateAction();
        //$status=RMAModel::updateOStatus(10,$rma_id);
        View::renderTemplate('RMA/printlabel.html'
            //,
            //[
                //'results'=>$results,
                //'rma_id'=>$rma_id
            //]
    );

    }



    public function closeorderAction()
    {
        $imei=$this->activateAction();
        $rma_id=RMAModel::getRMAId($imei);
        $status=RMAModel::updateOStatus(10,$rma_id);
        View::renderTemplate('RMA/closeorder.html',
        [
           //'results'=>$results,
            'rma_id'=>$rma_id
        ]);

    }

    public function furtherrepairAction()
    {
        $imei=$this->activateAction();
         $rma_id=RMAModel::getRMAId($imei);

       $devices=RMAModel::getWarranty($imei);
       //$device_id=DeviceModel::getDeviceModel($imei);
       //$results=RepairModel::getRepairTwoParts($device_id);
       //$results=RepairModel::getrepair2parts();
       $event=EventModel::CreateEvent(1,5,$imei,5);
        $status=RMAModel::setRMAStatus(15,$rma_id);
       $action=Action::updateRMAAction($status);
       $set=RMAModel::setAction(7,$rma_id);

        View::renderTemplate('RMA/furtherrepair.html'
            ,[
           'rma_id'=>$rma_id,
          'imei'=>$imei
            ,'devices'=>$devices
           // ,'results'=>$results

        ]
    );
    }

    public function repairtwoAction()
    {


        $results = RMAModel::getRMAsByStatus(15);

        View::renderTemplate('RMA/repairtwo.html'
            , [
                'results' => $results
            ]
        );

    }

    public function replacedeviceAction()
    {

        //$results = RMAModel::getRMAs();
        View::renderTemplate('RMA/replacedevice.html'
            //, [
               // 'results' => $results
           // ]
        );

    }

    public function closeAction()
    {
        $results=RMAModel::getRMAsByStatus(12);
        View::renderTemplate('RMA/close.html'
            ,
            [
                'results'=>$results
            ]
    );


    }




}