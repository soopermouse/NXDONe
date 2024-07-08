<?php
/**
 * Created by PhpStorm.
 * User: simona
 * Date: 17/02/2019
 * Time: 10:39
 */

namespace App\Helpers;
use App\Models\InspectionModel;


class Inspection
{
    public static function IsChecked($chkname,$value)
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

    public static function SoundInspection($rma_id, $imei, $date,$sound)
    {
       //$_POST['sound']=$sound;
        //if (isset($_POST['sound'])) {
        if(!empty($sound)){
            if (self::IsChecked('sound', '30')) {
                $speakers = 1;
            } else {
                $speakers = 0;
            }
            if (self::IsChecked('$sound', '7')) {
                $front_speaker = 1;
            } else {
                $front_speaker = 0;
            }
            if (self::IsChecked('$sound', '24')) {
                $microphone_bottom = 1;
            } else {
                $microphone_bottom = 0;
            }
            if (self::IsChecked('$sound', '26')) {
                $internal_speakers = 1;
            } else {
                $internal_speakers = 0;
            }
            if (self::IsChecked('$sound', '13')) {
                $microphone_back = 1;
            } else {
                $microphone_back = 0;
            }
            if (self::IsChecked('$sound', '3')) {
                $microphone_top = 1;
            } else {
                $microphone_top = 0;
            }
            $sound_inspection_id = InspectionModel::makeSoundInspection($rma_id, $imei, $date, $speakers, $internal_speakers, $microphone_bottom, $microphone_back, $front_speaker, $microphone_top);
            echo "the id of the sound inspection is " . $sound_inspection_id;
            } else {
            echo 'no sound issues';
            $sound_inspection_id = 0;
            }

        return $sound_inspection_id;

    }
    public static function PowerInspection($rma_id, $imei, $date,$power)
    {
    if (isset($_POST['power'])) {

        if (self::IsChecked('power', '29')) {
            $power = 1;
        } else {
            $power = 0;
        }

        if (self::IsChecked('power', '23')) {
            $battery = 1;
        } else {
            $battery = 0;
        }

        if (self::IsChecked('power', '12')) {
            $dock_connector = 1;
        } else {
            $dock_connector = 0;
        }
        $power_inspection_id = InspectionModel::makePowerInspection($rma_id, $imei, $date, $battery, $dock_connector, $power);
        echo "the id of the power inspection is " . $power_inspection_id;
    } else {
        $power_inspection_id = 0;
        echo "no power issues";
    }
        return $power_inspection_id;
    }

    public static function ScreenInspection($rma_id, $imei, $date,$screen)
    {
    if (isset($_POST['screen'])) {
        print_r($_POST['screen']);
        if (self::IsChecked('screen', '28')) {
            $LCD = 1;
        } else {
            $LCD = 0;
        }
        if (self::IsChecked('screen', '11')) {
            $multi_touch = 1;
        } else {
            $multi_touch = 0;
        }
        if (self::IsChecked('screen', '0')) {
            $img_quality = 1;
        } else {
            $img_quality = 0;
        }
        if (self::IsChecked('screen', '6')) {
            $ambient_light = 1;
        } else {
            $ambient_light = 0;
        }
        if (self::IsChecked('screen', '5')) {
            $auto_brightness = 1;
        } else {
            $auto_brightness = 0;
        }
        if (self::IsChecked('screen', '4')) {
            $proximity = 1;
        } else {
            $proximity = 0;
        }
        $screen_inspection_id = InspectionModel::makeScreenInspection($rma_id, $imei, $date, $LCD, $multi_touch, $img_quality, $ambient_light, $auto_brightness, $proximity);
        echo "the id of the screen inspection is  " . $screen_inspection_id;
        } else {
        $screen_inspection_id = 0;
        echo "No screen problems";
        }

        return $screen_inspection_id = 0;
    }

    public static function ButtonsInspection($rma_id, $imei, $date,$buttons)
    {
        if (isset($_POST['buttons'])) {
            print_r($_POST['buttons']);

            if (self::IsChecked('buttons', '25')) {
                $headset_jack = 1;
            } else {
                $headset_jack = 0;
            }
            if (self::IsChecked('buttons', '21')) {
                $power_button = 1;
            } else {
                $power_button = 0;
            }


            if (self::IsChecked('buttons', '16')) {
                $home_button = 1;
            } else {
                $home_button = 0;
            }


            if (self::IsChecked('buttons', '9')) {
                $volume_flex_cable = 1;
            } else {
                $volume_flex_cable = 0;
            }

            if (self::IsChecked('buttons', '8')) {
                $touch_id = 1;
            } else {
                $touch_id = 0;
            }
            $buttons_inspection_id = InspectionModel::makeButtonsInspection($rma_id, $imei, $date, $headset_jack, $power_button, $volume_flex_cable, $home_button, $touch_id);
            echo "the id of the buttons inspection is " . $buttons_inspection_id;
        } else {
            $buttons_inspection_id = 0;
            echo "no jacks/buttons problems";
        }

        return $buttons_inspection_id;
    }

    public static function ConnectionsInspection($rma_id, $imei, $date,$connections)
    {
        If (isset($_POST['connections'])) {
            Print_r($_POST['connections']);
            if (self::IsChecked('connections', '17')) {
                $SIM_fail = 1;
            } else {
                $SIM_fail = 0;
            }
            if (self::IsChecked('connections', '18')) {
                $no_cell_conn = 1;
            } else {
                $no_cell_conn = 0;
            }
            if (self::IsChecked('connections', '19')) {
                $signal_strength = 1;
            } else {
                $signal_strength = 0;
            }
            if (self::IsChecked('connections', '20')) {
                $wifi_bt = 1;
            } else {
                $wifi_bt = 0;
            }
            $connections_inspection_id = InspectionModel::makeConnsInspection($rma_id, $imei, $date, $wifi_bt, $signal_strength, $no_cell_conn, $SIM_fail);;
            echo "the id of the connections inspection is " . $connections_inspection_id;


        } else {
            $connections_inspection_id = 0;
            echo "no connections problems";
        }

        return $connections_inspection_id;
    }

    public static function MiscInspection($rma_id, $imei, $date,$misc)
    {

        if (isset($_POST['misc'])) {
            print_r($_POST['misc']);

            if (self::IsChecked('misc', '27')) {
                $vibration_motor = 1;
            } else {
                $vibration_motor = 0;
            }

            if (self::IsChecked('misc', '22')) {
                $GPS = 1;
            } else {
                $GPS = 0;
            }

            if (self::IsChecked('misc', '14')) {
                $torch = 1;
            } else {
                $torch = 0;
            }
            $misc_inspection_id = InspectionModel::makeMiscInspection($rma_id, $imei, $date, $vibration_motor, $GPS, $torch);
            echo "the id of the miscellaneous inspection is " . $misc_inspection_id;

        } else {
            $misc_inspection_id = 0;
            echo "no misc problems";
        }
        return $misc_inspection_id;

    }

    Public static function CameraInspection($rma_id, $imei, $date,$camera)
    {
        if (isset($_POST['camera'])) {
            print_r($_POST['camera']);

            if (self::IsChecked('camera', '15')) {
                $rear_camera = 1;
            } else {
                $rear_camera = 0;
            }
            if (self::IsChecked('camera', '2')) {
                $front_camera = 1;
            } else {
                $front_camera = 0;
            }


            if (self::IsChecked('camera', '1')) {
                $fcfc = 1;
            } else {
                $fcfc = 0;
            }
            $camera_inspection_id = InspectionModel::makeCameraInspection($rma_id, $imei, $date, $rear_camera, $front_camera, $fcfc);
            echo "the camera inspection id is " . $camera_inspection_id;
        } else {
            $camera_inspection_id = 0;
            echo "no camera problems";
        }

        Return $camera_inspection_id;

    }

    public static function otherinspection($rma_id, $imei, $date,$other)
    {
        if(self::IsChecked('failcard','12'))
        {
            $physical_damage=1;
        }else{
            $physical_damage=0;
        }



        if(self::IsChecked('failcard','16'))
        {
            $charging=1;
        }else{
            $charging=0;
        }

        if(self::IsChecked('failcard','20'))
        {
            $power_flex_cable=1;
        }else{
            $power_flex_cable=0;
        }
    }
}