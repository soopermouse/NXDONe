<?php
/**
 * Created by PhpStorm.
 * User: SimonaThrussell
 * Date: 01/10/2018
 * Time: 09:41
 */
namespace App\Controllers;
use App\Models\ActionModel;
use App\Models\DeviceModel;
use App\Models\HistoryModel;
use App\Models\InventoryModel;
use App\Models\StatusModel;
use \Core\View;
use App\Models\RepairModel;
use App\Models\RMAModel;
use App\Models\InspectionModel;
use App\Models\EventModel;
use App\Helpers\Action;


require '..\vendor\autoload.php';
class Repair extends \Core\Controller
{
    public function indexAction()
    {

        $results = RepairModel::getRepairs();
        View::renderTemplate('Repair/index.html',
            ['results'=>$results]
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

    public function RepairAction()
    {
        $results = RepairModel::getRepairsByStatus(2);
        View::renderTemplate('Repair/repair.html'
            ,
            [
               'results'=>$results          ]
        );

    }

    public function dorepaironeAction()
    {
        $imei = $this->activateAction();
        //$rma_id=RMAModel::getRMAId($imei);
       //$results = RMAModel::getRMA($rma_id);
        $hiss = DeviceModel::getHistory($imei);
        print_r($hiss);
        echo $device_type=DeviceModel::getDeviceModel($imei);
        $parts=RepairModel::getRepairOneParts($device_type);
        print_r($parts);

        //echo $conn;
        //echo '<pre>';
        //print_r(
        //$warrantys = RMAModel::getWarranty($imei);
        //if ($sn != 0 && $scn != 0 && $pwr != 0) {
        $sounds = InspectionModel::getSoundInspectionbyImei($imei);
        $screens = InspectionModel::getScreenInspectionbyImei($imei);
        $powers = InspectionModel::getPowerInspectionByImei($imei);
        $miscs = InspectionModel::getMiscInspectionByImei($imei);
        $cons = InspectionModel::getConnInspectionByImei($imei);
        $cams = InspectionModel::getCameraInspectionByImei($imei);
        $buttons = InspectionModel::getButtonsInspectionByImei($imei);
        //echo '<pre>';
        //foreach ($sounds as $key => $link) {
        //if ($link !== '1') {
        // unset($sounds[$key]);
        //}
        // return $sounds;
        //}
        // print_r($sounds);*/



        //echo $_SESSION['device'] = $message;
        $event=EventModel::CreateEvent(1,4,$imei,2);

        View::renderTemplate('Repair/dorepairone.html'
            ,
            [
                //'results'=>$results
                'sounds' => $sounds,
                'screens' => $screens,
                'powers' => $powers,
                'miscs' => $miscs,
                'cons' => $cons,
                'cams' => $cams,
                'buttons' => $buttons,
                'hiss' => $hiss,
                'parts'=>$parts

            ]
        );
    }
    public function repairdoneAction()
    {
        $imei=$this->activateAction();
        $message="meow";
        //echo $status=RMAModel::setRMAStatus(5,$rma_id);
       print_r($repair_id=RepairModel::getRepairOrder($imei));
        //echo $repair_id=$repair[0]['repair_id'];
        $date=date('Y-m-d');
        //echo '<pre>';
        //print_r($_POST);
        $status=StatusModel::UpdateRepairStatus(3,$repair_id);
        $action=ActionModel::setRepairAction(4,$repair_id);
        View::renderTemplate('Repair/repairdone.html',[
            'message'=>$message,
            'imei'=>$imei,
            //'device'=>$device,
            'date'=>$date
        ]);
    }
    public function reportsAction()
    {
        View::renderTemplate('Repair/reports.html');
    }

    public function repairdeviceAction()
    {
        $imei=$this->activateAction();

        $rma_id=RepairModel::getRMAId($imei);
        $results=RMAModel::getRMA($rma_id);
        $hiss=DeviceModel::getHistory($imei);
        $sn=InspectionModel::checkSoundInspection($rma_id);
        $scn=InspectionModel::checkScreenInspection($rma_id);
        echo $scn;
        $pwr=InspectionModel::checkPowerInspection($rma_id);
        echo $pwr;
        $msc=InspectionModel::checkMiscInspection($rma_id);
        echo $msc;
        $conn=InspectionModel::checkConnInspection($rma_id);
        echo $conn;

        $warrantys=RMAModel::getWarranty($imei);
        //if($sn!=0 && $scn!=0 && $pwr!=0){

        $sounds=InspectionModel::getSoundInspection($rma_id);
        $screens=InspectionModel::getScreenInspection($rma_id);
        $powers=InspectionModel::getPowerInspection($rma_id);
        $miscs=InspectionModel::getMiscInspection($rma_id);
        $cons=InspectionModel::getConnInspection($rma_id);
        $cams=InspectionModel::getCameraInspection($rma_id);
        $buttons=InspectionModel::getButtonsInspection($rma_id);
        View::renderTemplate('Repair/repairdevice.html'
        ,
         [
         'results'=>$results,
         'sounds'=>$sounds,
        'screens'=>$screens,
          'powers'=>$powers,
          'miscs'=>$miscs,
          'cons'=>$cons,
          'cams'=>$cams,
           'buttons'=>$buttons,
          'hiss'=>$hiss,
          'warrantys'=>$warrantys,
         ]
        );
    }

    public function repairtwoAction()
    {
    View::renderTemplate('Repair/repairtwo.html');
    }

    public function gradingAction()
    {
        $results=RepairModel::getRepairsByStatus(5);
        View::renderTemplate('Repair/grading.html',
        [
            'results'=>$results
        ]
        );
    }

    public function inventoryAction()
    {
        $results=InventoryModel::getLocationInventory(2);
        View::renderTemplate('Repair/inventory.html',
            [
                'results'=>$results
            ]);
    }

    public function partsAction()
    {
        View::renderTemplate('Repair/parts.html');
    }

    public function usersAction()
    {
        View::renderTemplate('Repair/users.html');
    }

    public function recycleAction()
    {
        $results=RepairModel::getRecycle();
        View::renderTemplate('Repair/recycle.html',
            [
                'results'=>$results
            ]);
    }

    public function inspectionAction()
    {
        $results = $results = $results = RepairModel::getRepairsByStatus(2);
        View::renderTemplate('Repair/inspection.html'
        ,[
            'results'=>$results
            ]);
    }

    public function inspectAction()
    {
        //$imei=$this->activateAction();
        View::renderTemplate('Repair/inspect.html');
    }

    public function inspectsubmitAction()
    {
        $imei=$this->activateAction();
        $order_id=RepairModel::getRepairId($imei);
        $date=date('Y-m-d');
        View::renderTemplate('repair/inspectsubmit.html');
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
            $sound_inspection_id=InspectionModel::makeSoundInspection($order_id,$imei,$date,$speakers,$internal_speakers,$microphone_bottom,$microphone_back,$front_speaker,$microphone_top);
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
            $power_inspection_id=InspectionModel::makePowerInspection($order_id,$imei,$date,$battery,$dock_connector,$power);
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
            $screen_inspection_id=InspectionModel::makeScreenInspection($order_id,$imei,$date,$LCD,$multi_touch,$img_quality,$ambient_light,$auto_brightness,$proximity);
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
            $buttons_inspection_id=InspectionModel::makeButtonsInspection($order_id,$imei,$date,$headset_jack,$power_button,$volume_flex_cable,$home_button,$touch_id);
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
            $connections_inspection_id=InspectionModel::makeConnsInspection($order_id,$imei,$date,$wifi_bt,$signal_strength,$no_cell_conn,$SIM_fail);;
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
            $misc_inspection_id=InspectionModel::makeMiscInspection($order_id,$imei,$date,$vibration_motor,$GPS,$torch);
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
            $camera_inspection_id=InspectionModel::makeCameraInspection($order_id,$imei,$date,$rear_camera,$front_camera,$fcfc);
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
        //echo $status=StatusModel::SetRepairStatus($status,$repair_id);
        echo $event=EventModel::CreateEvent(1,1,$imei,2);

        echo $inspection=InspectionModel::makeInspection($order_id,$imei,$buttons_inspection_id,$camera_inspection_id,$connections_inspection_id,$misc_inspection_id,$power_inspection_id,$screen_inspection_id,$sound_inspection_id,$date,2);


    }

    public function gradeAction()
    {
        $imei=$this->activateAction();
        //$_SESSION['order_id']=$order_id;
        $results = RepairModel::getRepair($imei);
        View::renderTemplate('Repair/grade.html'
            , [
                'results' => $results
            ]
        );
    }

    public function gradedeviceAction()
    {
        $imei=$this->activateAction();
        $grade=$_POST['grade'];
        $repair_id=RepairModel::getRepairOrder($imei);
        $date=date('Y-m-d');
        //$user_id=$_SESSION['user_id'];
        $user_id=1;
        echo $grade=RepairModel::gradedevice($imei,$date,$grade,$user_id);
        echo $inv=InventoryModel::movedeviceLocation(3,$imei);
        $status=StatusModel::updateRepairStatus(7,$repair_id);
        $action=ActionModel::setRepairAction(8,$repair_id);
        View::renderTemplate('Repair/gradedevice.html'
        //, [
        //'results' => $results
        //]
        );
    }

    public function getrepairAction()
    {

        View::renderTemplate('Repair/getrepair.html');

    }

    public function getrepairorderAction()
    {

            $imei = $_POST['imei'];
            echo $imei;
            print_r($results = RepairModel::getRepair($imei));



        View::renderTemplate('Repair/getrepairorder.html'
            ,[
                'results'=>$results,

            ]);
    }

    public function PRInspectionAction()
    {
        $results=RepairModel::getRepairsByStatus(3);
        View::renderTemplate('Repair/PRInspection.html'
        ,[
            'results'=>$results

            ]);
    }

    public function PRInspect()
    {
        $imei=$this->activateAction();
        View::renderTemplate('Repair/PRInspect.html'
        //,[
        //'results'=>$results

        //]
        );
    }

    public function labellingAction()
    {
        $results=RepairModel::getLabels();
        View::renderTemplate('Repair/labelling.html'
            ,[
                'results'=>$results

            ]);
    }

    public function labelsAction()
    {
        $imei=$this->activateAction();
        $results=RepairModel::getLabel($imei);
        View::renderTemplate('Repair/labels.html'
        ,[
        'results'=>$results

        ]
        );
    }

    public function multigradeAction()
    {
    View::renderTemplate('Repair/multigrade.html');
    }

    public function grademultiAction()
    {
        View::renderTemplate('Repair/grademulti.html');
    }

    public function PRFailcardAction()
    {
        $imei = $this->activateAction();
        //$rma_id=RMAModel::getRMAId($imei);
        $repair_id=RepairModel::getRepairOrder($imei);
        $date = date('Y-m-d');


        if (empty($_POST['failcard']) && (empty($_POST['sound'])) && (empty($_POST['power'])) && (empty($_POST['screen'])) && (empty($_POST['buttons'])) && (empty($_POST['connections'])) && (empty($_POST['misc'])) && (empty($_POST['camera']))) {
            $message = "device has been repaired";
            //$query = RMAModel::setRMAStatus(12, $rma_id);
            $status = 12;

        } else {
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

                echo $sound = InspectionModel::makeSoundInspection($repair_id, $imei, $date, $speakers, $internal_speakers, $microphone_bottom, $microphone_back, $front_speaker, $microphone_top);
            } else {
                echo 'no sound issues';
                $sound=0;
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

                echo $power = InspectionModel::makePowerInspection($repair_id, $imei, $date, $battery, $dock_connector, $power);
            } else {

                echo "no power issues";
                $power=0;
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

                echo $screen = InspectionModel::makeScreenInspection($repair_id, $imei, $date, $LCD, $multi_touch, $img_quality, $ambient_light, $auto_brightness, $proximity);
            } else {

                echo "No screen problems";
                $screen=0;
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

                echo $buttons = InspectionModel::makeButtonsInspection($repair_id, $imei, $date, $headset_jack, $power_button, $volume_flex_cable, $home_button, $touch_id);
            } else {

                echo "no jacks/buttons problems";
                $buttons=0;
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
                echo $conns = InspectionModel::makeConnsInspection($repair_id, $imei, $date, $wifi_bt, $signal_strength, $no_cell_conn, $SIM_fail);


            } else {
                echo "no connections problems";
                $conns=0;
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

                echo $misc = InspectionModel::makeMiscInspection($repair_id, $imei, $date, $vibration_motor, $GPS, $torch);

            } else {
                echo "no misc problems";
                $misc=0;
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

                echo $cam = InspectionModel::makeCameraInspection($repair_id, $imei, $date, $rear_camera, $front_camera, $fcfc);
            } else {

                echo "no camera problems";
                $cam=0;
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
            $message = "redo repair";
            //$message = '<a href="redorepair"><button class="btn-danger">Repair </button></a>';
            echo $inspection = InspectionModel::makeInspection($repair_id, $imei, $buttons, $cam, $conns, $misc, $power, $screen, $sound, $date, 3)."id created";
            echo $query = StatusModel::updateRepairStatus(5,$repair_id);
            echo $action=ActionModel::setRepairAction(6,$repair_id);

            echo $event=EventModel::CreateEvent(1,13,$imei,2);


        }

        View::renderTemplate('Repair/PRFailcard.html',
            [
                'message'=>$message
            ]);

    }

    public function makerepairorderAction()
    {
        View::renderTemplate('Repair/makerepairorder.html');
    }

    public function enterrepairAction()
    {
        $imei=$_POST['imei'];
        $repairtype=$_POST['repair_type'];
        echo $repair=RepairModel::makeRepairOrder($imei,0,$repairtype);
        echo $status=RepairModel::makerepairstatus($repair,$imei,1,1);
        View::renderTemplate('Repair/enterrepair.html');
    }

    public function getdeviceAction()
    {
        View::renderTemplate('Repair/getdevice.html');
    }

    public function getdevicestatusAction()
    {
        echo $imei=$_POST['imei'];
        print_r($results=EventModel::getDeviceStatus($imei));
        View::renderTemplate('Repair/getdevicestatus.html',
            [
                'results'=>$results,

            ]);
    }

    public function furtherrepairAction()
    {
        $imei=$this->activateAction();
        $rma_id=RMAModel::getRMAId($imei);

        //$devices=RMAModel::getWarranty($imei);
        //$device_id=DeviceModel::getDeviceModel($imei);
        $results=RepairModel::getRepairTwoParts($device_id);
        //$results=RepairModel::getrepair2parts();
        $event=EventModel::CreateEvent(1,5,$imei,2);
        $status=RMAModel::setRMAStatus(15,$rma_id);
        $action=Action::updateRMAAction($status);
        $set=RMAModel::setAction($action,$rma_id);

        View::renderTemplate('Repair/furtherrepair.html'
            ,[
                'rma_id'=>$rma_id,
                'imei'=>$imei
                ,'devices'=>$devices,
                'results'=>$results

            ]
        );
    }

    public function recycledeviceAction()
    {
        $imei = $this->activateAction();
        View::renderTemplate('Repair/recycledevice.html');

    }
}

