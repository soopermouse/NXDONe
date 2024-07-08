<?php
/**
 * Created by PhpStorm.
 * User: simona
 * Date: 24/02/2019
 * Time: 21:23
 */

namespace App\Controllers;
use App\Helpers\Validate;
use App\Models\EventModel;
use App\Models\InspectionModel;
use App\Models\InventoryModel;
use App\Models\StatusModel;
use App\Models\SuppliersModel;
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
use App\Models\ActionModel;
use App\Models\RepairModel;
//local setup
require '..\vendor\autoload.php';

class Suppliers extends \Core\Controller
{
    public function indexAction()
    {


        //$results=rebuyModel::getStatus();
        View::renderTemplate('Suppliers/index.html'
            //, [

            //'results'=> $results
        //]
    );

    }

    public function activateAction()
    {
        $id = $this->route_params['id'];
        return $id;
    }

    public function createsupplierAction()
    {
        $date=date('Y-m-d');
        //$results=rebuyModel::getStatus();
        View::renderTemplate('Suppliers/createsupplier.html'
            //, [

            //'results'=> $results
        //]
        );
    }

    public function createsupplierorderAction()
    {


        //$results=rebuyModel::getStatus();
        View::renderTemplate('Suppliers/createsupplierorder.html'
        //, [

        //'results'=> $results
        //]
        );
    }

    public function createsupAction()
    {

        $supplier=$_POST['supplier'];
        $message=$supplier_id=SuppliersModel::createSupplier($supplier). "was created";
        //$results=rebuyModel::getStatus();
        View::renderTemplate('Suppliers/createsup.html'
       , [
            'message'=>$message
        //'results'=> $results
       ]
        );
    }

    public function createorderAction()
    {
        $date = date('Y-m-d');
        $supplier_id = $_POST['supplier_id'];
        $device_model1 = $_POST['device_model1'];
        $quantity1 = $_POST['quantity1'];
        //add storage and colour to input
        $order = OrderModel::makeSupplierOrder($supplier_id);
        $rebuy_order=OrderModel::createRebuyOrder($supplier_id,3);
        echo "New Supplier order " . $order . " has been created";
        $id = OrderModel::addDeviceToSupplierOrder($order,$rebuy_order, $device_model1, $quantity1);
        if (is_numeric($id)) {
                $message= "order id " . $order . " has been updated";
        }else{
            $message="error updating the order ".$order;
        }
        //$results=rebuyModel::getStatus();
        View::renderTemplate('Suppliers/createorder.html'
        , [
            'message'=>$message
        //'results'=> $results
        ]
        );
    }

    public function ordersAction()
    {
       $results=SuppliersModel::getSupplyOrders();
        View::renderTemplate('Suppliers/orders.html'
            , [
                //'message'=>$message
                'results'=> $results
            ]
        );

    }

    public function orderdetailsAction()
    {
        $order_id = $this->activateAction();
        $results = SuppliersModel::getSupplyOrder($order_id);
        /*echo '<pre>';
        print_r($results);
        $device_model = $results[0]['device_model_id'];
        $quantity = $results[0]['device_quantity'];
        if ($quantity > 100) {
            $suborders = $quantity / 100;

            $i = 1;
            do {
                $suborder_id = $order_id . $i;
                $suborder = SuppliersModel::makeSupplySuborder($order_id, $suborder_id, $device_model, 100);

                echo $suborder_id . "</br>";
                $i++;
            } while ($i <= $suborders);
            $rest = $quantity % 100;
            /*if($rest>0){
                $suborders=$suborders+1;
            }

        }*/
            View::renderTemplate('Suppliers/orderdetails.html'
                , [
                    //'message'=>$message
                    'results' => $results
                    //,
                    //'rest'=>$rest,
                    //'suborders'=>$suborders

                ]
            );
        }



    public function shippingAction()
    {
        View::renderTemplate('Suppliers/ordershipping.html');
    }



    public function devicecheckAction()
    {
        $order_id=$this->activateAction();
        View::renderTemplate('Suppliers/devicecheck.html');
    }

    public function intakeAction()
    {


        $results=SuppliersModel::getSupplyOrdersByStatus(3);
        View::renderTemplate('Suppliers/intake.html',
            [
                'results'=>$results
            ]);
    }


    public function scanAction()
    {

        $order_id=$this->activateAction();
        //$results=SuppliersModel::getSupplyOrdersByStatus(3);
        View::renderTemplate('Suppliers/scan.html');
    }

    public function masscheckAction()
    {
        $order_id=$this->activateAction();

        $numbers=$_POST['testinput'];
        $results=SuppliersModel::getSupplyOrder($order_id);
        echo "</br>";
        echo $device_model_id=$results[0]['device_model_id']."</br>";
        echo  $device_storage=$results[0]['device_storage_id']."</br>";
        echo $device_connection=$results[0] ['device_connection']."</br>";

        $IMEIs = explode(',', $numbers);
        foreach($IMEIs as $IMEI)
        {
            $validate = Validate::validatemulti($IMEI);
            //
            //echo $validate;

            if(is_numeric($validate))
            {
                echo $device_imei=$validate."</br>";
                echo $inventory=InventoryModel::addToInventory($device_imei,2)."</br>";
                echo $status=StatusModel::makeDeviceStatus($device_imei,1,1,6)."</br>";
                echo $device=DeviceModel::makeSupplyDevice($order_id,$device_model_id,$device_storage,$device_connection,0,0,$device_imei)."</br>";
                echo $newdevice=DeviceModel::makeNewDevice($device_imei);

            }else{
                echo $IMEI ."is not a valid IMEI </br>";
            }

        }
        View::renderTemplate('Suppliers/masscheck.html',[
            'results'=>$IMEIs
        ]);
    }

    public function checkAction()
    {

        $results = SuppliersModel::getSupplyDevices(2);
        View::renderTemplate('Suppliers/check.html', [
            'results' => $results
        ]);
    }

    public function inspectAction()
    {
        $imei=$this->activateAction();

        $results = SuppliersModel::getSupplyDevice($imei);
        View::renderTemplate('Suppliers/inspect.html', [
            'results' => $results
        ]);

    }

    public function inspectsubmitAction()
    {
        $IMEI=$this->activateAction();
        $order_id=SuppliersModel::getSupplyOrderId($IMEI);
        $date = date('Y-m-d');
        $devicetype = $_POST['device_type'];
        $devicestorage = $_POST['device_storage'];
        $deviceconnection = $_POST['device_connection'];
        $devicecondition = $_POST['device_condition'];
        $devicecolour = $_POST['device_colour'];
        //$images=$_POST['images'];
        $devicecomments = $_POST['device_comments'];
        echo  $query = SuppliersModel::InspectSubmit($order_id, $devicetype, $devicestorage, $deviceconnection, $devicecondition, $devicecolour, $devicecomments,$date,$IMEI);
        echo  $status=StatusModel::updateDevicestatus(2, 10, 6,$IMEI);



        echo "event id ".$event=EventModel::CreateEvent(1,1,$IMEI,6)."has been created";
        // $device_id=DeviceModel::getDeviceId($IMEI);
        echo $entry=DeviceModel::updateNewDevice( $devicetype, $devicestorage, $deviceconnection, $devicecolour,$IMEI);
        //echo $repair=RepairModel::makeRepairOrder($IMEI,$query,2);
        sleep(5);
        $results = SuppliersModel::getDeviceCheckByImei($IMEI);

        View::renderTemplate('Suppliers/inspectsubmit.html'
            ,[
            'results'=>$results

        ]
            );

    }

    public function inspectionAction()
    {
        $results = SuppliersModel::getSupplyDevices(2);
        View::renderTemplate('Suppliers/inspection.html'
        ,[
            'results'=>$results
            ]);
    }

    public function failcardAction()
    {
        $imei=$this->activateAction();

        View::renderTemplate('Suppliers/failcard.html');
    }

    public function setfailcardAction()
    {


        $imei = $this->activateAction();
        $order_id=SuppliersModel::getSupplyOrderId($imei);
        //$results = RebuyModel::getOrderActionById($order_id);



        View::renderTemplate('Suppliers/setfailcard.html'
           // , ['results' => $results]
        );
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

            $sound_inspection_id=InspectionModel::makeSoundInspection($order_id,$imei,$date,$speakers,$internal_speakers,$microphone_bottom,$microphone_back,$front_speaker,$microphone_top);
            echo "the id of the sound inspection is ".$sound_inspection_id;
        }else{
            echo 'no sound issues';
            $sound_inspection_id=0;
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
            $power_inspection_id=InspectionModel::makePowerInspection($order_id,$imei,$date,$battery,$dock_connector,$power);
            echo "the id of the power inspection is ".$power_inspection_id;
        }else{
            $power_inspection_id=0;
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
            $screen_inspection_id=InspectionModel::makeScreenInspection($order_id,$imei,$date,$LCD,$multi_touch,$img_quality,$ambient_light,$auto_brightness,$proximity);
            echo "the id of the screen inspection is  ".$screen_inspection_id;
        }else{
            $screen_inspection_id=0;
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
            $buttons_inspection_id = InspectionModel::makeButtonsInspection($order_id, $imei, $date, $headset_jack, $power_button, $volume_flex_cable, $home_button, $touch_id);
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
            $connections_inspection_id = InspectionModel::makeConnsInspection($order_id, $imei, $date, $wifi_bt, $signal_strength, $no_cell_conn, $SIM_fail);;
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
            $misc_inspection_id = InspectionModel::makeMiscInspection($order_id, $imei, $date, $vibration_motor, $GPS, $torch);
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
            $camera_inspection_id = InspectionModel::makeCameraInspection($order_id, $imei, $date, $rear_camera, $front_camera, $fcfc);
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
        echo $date;
        echo $imei;
        echo $status = StatusModel::updateDeviceStatus(3,3,$imei,6);
        $event=EventModel::CreateEvent(1,1,$imei,6);
        echo $inspection_id = InspectionModel::makeInspection($order_id, $imei, $buttons_inspection_id, $camera_inspection_id, $connections_inspection_id, $misc_inspection_id, $power_inspection_id, $screen_inspection_id, $sound_inspection_id, $date,4);
        echo  $repair=RepairModel::makeRepairOrder($imei,$inspection_id,2)." repair order created";
        echo $status=RepairModel::makerepairstatus($repair,$imei,2,2);

    }

    public function ReportsAction()
    {

        View::renderTemplate('Suppliers/reports.html');
    }

    public function supordercheckAction()
    {        $order_id=$this->activateAction();
        $results=RebuyModel::getsupplyorderdevices($order_id);
        View::renderTemplate('Suppliers/supordercheck.html',
            ['results'=>$results
            ]);
    }

    public function ordershippingAction()
    {
        $results = RebuyModel::getShipping();
        View::renderTemplate('Suppliers/ordershipping.html', [
                'results' => $results
            ]
        );



    }

    public function devicestatusAction()
    {
        $order_id=$this->activateAction();
        $results = SuppliersModel::getDeviceOrderStatus($order_id);
        View::renderTemplate('Suppliers/devicestatus.html', [
                'results' => $results
            ]
        );

    }

    public function orderstatusAction()
    {
        $results = SuppliersModel::getSupplyOrdersStatus();
        View::renderTemplate('Suppliers/orderstatus.html', [
                'results' => $results
            ]
        );
    }

    public function closeordersAction()
    {
        $results = SuppliersModel::getSupplyOrdersStatus();
        View::renderTemplate('Suppliers/closeorders.html', [
                'results' => $results
            ]
        );
    }

    public function ordersplitAction()
    {
        $order_id = $this->activateAction();
        $total=SuppliersModel::checkSplit($order_id);
        if($total==0) {
            $results1 = SuppliersModel::getSupplyOrder($order_id);
            echo '<pre>';
            print_r($results1);
            $device_model = $results1[0]['device_model_id'];
            $quantity = $results1[0]['device_quantity'];
            if ($quantity > 100) {
                $suborders = $quantity / 100;

                $i = 1;
                do {
                    $suborder_id = $order_id . $i;
                    $suborder = SuppliersModel::makeSupplySuborder($order_id, $suborder_id, $device_model, 100);

                    echo $suborder_id . "</br>";
                    $i++;
                } while ($i <= $suborders);
                $rest = $quantity % 100;
                sleep(5);
                $results = SuppliersModel::getSuborders($order_id);
                View::renderTemplate('Suppliers/ordersplit.html'
                    , [
                        'results' => $results
                    ]);
            }

        }else{
            View::renderTemplate('Suppliers/ordersplitno.html'
                , [
                    'order_id' => $order_id
                ]);
        }

    }






}