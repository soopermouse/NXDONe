<?php
/**
 * Created by PhpStorm.
 * User: SimonaThrussell
 * Date: 14/02/2019
 * Time: 11:49
 */
namespace App\Models;
use PDO;

class InspectionModel extends \Core\Model
{
    public static function CheckDeviceType()
    {

    }


    public static function makeSoundInspection( $IMEI,  $speakers, $internal_speaker, $microphone_bottom, $microphone_back, $front_speaker, $microphone_top)
    {
        try {
            $db = static::getDB();
            $sql = "INSERT INTO
            forzaerp_inspection_details_sound (`imei`,`speakers`,`internal_speakers`,`microphone_bottom`,
            `microphone_back`,`front_speaker`,`microphone_top`)
            VALUES (?,?,?,?,?,?,?)";
            $stmt = $db->prepare($sql);
            $stmt->execute([$IMEI,  $speakers, $internal_speaker, $microphone_bottom, $microphone_back, $front_speaker, $microphone_top]);
            //$stmt = null;
            $id = $db->lastInsertId();
            return $id;

        } catch (\PDOException $e) {
            echo $e->getMessage();
        }


    }

    public static function makePowerInspection($IMEI,  $battery, $dock_connector, $power)
    {
        try {
            $db = static::getDB();
            $sql = "INSERT INTO
            forzaerp_inspection_details_power (`device_imei`,`battery`,`dock_connector_cable`,`no_power`)
            VALUES (?,?,?,?)";
            $stmt = $db->prepare($sql);
            $stmt->execute([ $IMEI, $battery, $dock_connector, $power]);
            //$stmt = null;
            $id = $db->lastInsertId();
            return $id;

        } catch (\PDOException $e) {
            echo $e->getMessage();
        }


    }

    public static function makeScreenInspection( $IMEI, $LCD, $multi_touch, $img_quality, $ambient_light, $auto_brightness, $proximity)
    {
        try {
            $db = static::getDB();
            $sql = "INSERT INTO
            forzaerp_inspection_details_screen (`device_imei`,`LCD`,`multi_touch`,`image_quality`,`ambient_light`,`auto_brightness`,`proximity`)
            VALUES (?,?,?,?,?,?,?)";
            $stmt = $db->prepare($sql);
            $stmt->execute([$IMEI,  $LCD, $multi_touch, $img_quality, $ambient_light, $auto_brightness, $proximity]);
            //$stmt = null;
            $id = $db->lastInsertId();
            return $id;

        } catch (\PDOException $e) {
            echo $e->getMessage();
        }


    }

    public static function makeButtonsInspection($IMEI, $headset_jack, $power_button, $volume_flex_cable, $home_button, $touch_id)
    {
        try {
            $db = static::getDB();
            $sql = "INSERT INTO
            forzaerp_inspection_details_buttons (`device_imei`,`headset_jack`,`power_button`,`volume_flex_cable`,`home_button`,touch_id)
            VALUES (?,?,?,?,?,?)";
            $stmt = $db->prepare($sql);
            $stmt->execute([ $IMEI, $headset_jack, $power_button, $volume_flex_cable, $home_button, $touch_id]);
            //$stmt = null;
            $id = $db->lastInsertId();
            return $id;

        } catch (\PDOException $e) {
            echo $e->getMessage();
        }


    }

    public static function makeConnsInspection($imei,  $wifi_bt, $signal_strength, $no_cell_conn, $SIM_fail)
    {
        try {
            $db = static::getDB();
            $sql = "INSERT INTO
            forzaerp_inspection_details_connections (`device_imei`,`wifi_bt`,`signal_strength`,`no_cell_conn`,`SIM_fail`)
            VALUES (?,?,?,?,?)";
            $stmt = $db->prepare($sql);
            $stmt->execute([ $imei,  $wifi_bt, $signal_strength, $no_cell_conn, $SIM_fail]);
            //$stmt = null;
            $id = $db->lastInsertId();
            return $id;

        } catch (\PDOException $e) {
            echo $e->getMessage();
        }


    }

    public static function makeMiscInspection( $imei,  $vibration_motor, $GPS, $torch)
    {
        try {
            $db = static::getDB();
            $sql = "INSERT INTO
            forzaerp_inspection_details_misc (`device_imei`,`vibration_motor`,`GPS`,`torch`)
            VALUES (?,?,?,?)";
            $stmt = $db->prepare($sql);
            $stmt->execute([ $imei,  $vibration_motor, $GPS, $torch]);
            //$stmt = null;
            $id = $db->lastInsertId();
            return $id;

        } catch (\PDOException $e) {
            echo $e->getMessage();
        }


    }

    public static function makeCameraInspection( $imei, $rear_camera, $front_camera, $fcfc)
    {
        try {
            $db = static::getDB();
            $sql = "INSERT INTO
            forzaerp_inspection_details_camera (`device_imei`,`rear_camera`,`front_camera`,`front_camera _flex_cable`)
            VALUES (?,?,?,?)";
            $stmt = $db->prepare($sql);
            $stmt->execute([$imei,  $rear_camera, $front_camera, $fcfc]);
            //$stmt = null;
            $id = $db->lastInsertId();
            return $id;

        } catch (\PDOException $e) {
            echo $e->getMessage();
        }


    }

    public static function makeInspection($order_id,$imei, $buttons_inspection_id, $camera_inspection_id, $connections_inspection_id, $misc_inspection_id, $power_inspection_id, $screen_inspection_id, $sound_inspection_id,  $inspection_type)
    {
        try {
            $db = static::getDB();
            $sql = "INSERT INTO
            forzaerp_inspection(`order_id`,`device_imei`,`buttons_inspection_id`,`camera_inspection_id`,`connections_inspection_id`,`misc_inspection_id`, `power_inspection_id`,`screen_inspection_id`,`sound_inspection_id`,`inspection_type`)
            VALUES (?,?,?,?,?,?,?,?,?,?)";
            $stmt = $db->prepare($sql);
            $stmt->execute([$order_id, $imei, $buttons_inspection_id, $camera_inspection_id, $connections_inspection_id, $misc_inspection_id, $power_inspection_id, $screen_inspection_id, $sound_inspection_id, $inspection_type]);
            //$stmt = null;
            $id = $db->lastInsertId();
            return $id;

        } catch (\PDOException $e) {
            echo $e->getMessage();
        }


    }

    public static function getInspection($imei)
    {
        try {
            $db = static::getDB();
            $stmt = $db->prepare('SELECT * FROM forzaerp_inspection_details_sound as s 
            JOIN forzaerp_inspection_details_screen as d on s.order_id=d.order_id
            JOIN forzaerp_inspection_details_power as p on s.order_id=p.order_id
            JOIN forzaerp_inspection_details_misc as m on m.order_id=s.order_id
            JOIN forzaerp_inspection_details_connections as c on s.order_id=c.order_id
            JOIN forzaerp_inspection_details_camera as i on i.order_id=s.order_id
            JOIN forzaerp_inspection_details_buttons as b on b.order_id=s.order_id
            WHERE s.order_id=? AND `inspection_type`=?');
            $stmt->execute([$imei, 2]);
            $count = $stmt->rowCount();
            // $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            //return $results;
            return $count;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

    }

    public static function checkSoundInspection($imei)
    {
        try {
            $db = static::getDB();
            $stmt = $db->prepare('SELECT * FROM forzaerp_inspection_details_sound 
            
            WHERE imei=?');
            $stmt->execute([$imei]);
            $count = $stmt->rowCount();
            // $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            //return $results;
            return $count;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function getSoundInspection($imei)
    {
        try {
            $db = static::getDB();
            $stmt = $db->prepare('SELECT * FROM forzaerp_inspection_details_sound 
            
            WHERE imei=?');
            $stmt->execute([$imei]);
            //$count = $stmt->rowCount();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results;
            //return $count;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function checkScreenInspection($imei)
    {
        try {
            $db = static::getDB();
            $stmt = $db->prepare('SELECT * FROM forzaerp_inspection_details_screen 
            
            WHERE device_imei=?');
            $stmt->execute([$imei]);
            $screencount = $stmt->rowCount();
            // $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            //return $results;
            return $screencount;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

    }

    public static function getScreenInspection($imei)
    {
        try {
            $db = static::getDB();
            $stmt = $db->prepare('SELECT * FROM forzaerp_inspection_details_screen
            
            WHERE device_imei=?');
            $stmt->execute([$imei]);
            //$count = $stmt->rowCount();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results;
            //return $count;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function checkPowerInspection($imei)
    {
        try {
            $db = static::getDB();
            $stmt = $db->prepare('SELECT * FROM forzaerp_inspection_details_power 
            
            WHERE device_imei=?');
            $stmt->execute([$imei]);
            $screencount = $stmt->rowCount();
            // $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            //return $results;
            return $screencount;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

    }

    public static function getPowerInspection($imei)
    {
        try {
            $db = static::getDB();
            $stmt = $db->prepare('SELECT * FROM forzaerp_inspection_details_power
            
            WHERE device_imei=?');
            $stmt->execute([$imei]);
            //$count = $stmt->rowCount();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results;
            //return $count;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function checkMiscInspection($imei)
    {
        try {
            $db = static::getDB();
            $stmt = $db->prepare('SELECT * FROM forzaerp_inspection_details_misc 
            
            WHERE device_imei=?');
            $stmt->execute([$imei]);
            $screencount = $stmt->rowCount();
            // $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            //return $results;
            return $screencount;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

    }

    public static function getMiscInspection($imei)
    {
        try {
            $db = static::getDB();
            $stmt = $db->prepare('SELECT * FROM forzaerp_inspection_details_misc
            
            WHERE device_imei=?');
            $stmt->execute([$imei]);
            //$count = $stmt->rowCount();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results;
            //return $count;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function checkConnInspection($imei)
    {
        try {
            $db = static::getDB();
            $stmt = $db->prepare('SELECT * FROM forzaerp_inspection_details_connections 
            
            WHERE device_imei=?');
            $stmt->execute([$imei]);
            $screencount = $stmt->rowCount();
            // $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            //return $results;
            return $screencount;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

    }

    public static function getConnInspection($imei)
    {
        try {
            $db = static::getDB();
            $stmt = $db->prepare('SELECT * FROM forzaerp_inspection_details_connections
            
            WHERE device_imei=?');
            $stmt->execute([$imei]);
            //$count = $stmt->rowCount();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results;
            //return $count;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function checkCameraInspection($imei)
    {
        try {
            $db = static::getDB();
            $stmt = $db->prepare('SELECT * FROM forzaerp_inspection_details_camera 
            
            WHERE device_imei=?');
            $stmt->execute([$imei]);
            $screencount = $stmt->rowCount();
            // $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            //return $results;
            return $screencount;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

    }

    public static function getCameraInspection($imei)
    {
        try {
            $db = static::getDB();
            $stmt = $db->prepare('SELECT * FROM forzaerp_inspection_details_camera
            
            WHERE device_imei=?');
            $stmt->execute([$imei]);
            //$count = $stmt->rowCount();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results;
            //return $count;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function checkButtonsInspection($imei)
    {
        try {
            $db = static::getDB();
            $stmt = $db->prepare('SELECT * FROM forzaerp_inspection_details_buttons 
            
            WHERE device_imei=?');
            $stmt->execute([$imei]);
            $screencount = $stmt->rowCount();
            // $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            //return $results;
            return $screencount;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

    }

    public static function getButtonsInspection($imei)
    {
        try {
            $db = static::getDB();
            $stmt = $db->prepare('SELECT * FROM forzaerp_inspection_details_buttons

            
            WHERE device_imei=?');
            $stmt->execute([$imei]);
            //$count = $stmt->rowCount();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results;
            //return $count;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function getRebuyInspection()
    {
        try {
            $db = static::getDB();
            $stmt = $db->prepare('SELECT * FROM forzaerp_rebuy_order_status as s 
            JOIN forzaerp_rebuy_order as r on r.order_id=s.order_id
            JOIN forzaerp_rebuy_order_device as d on d.order_id=r.order_id
            JOIN forzaerp_connection_type as c on d.device_connection_id=c.connection_type_id
            
            WHERE forza_order_status=?');
            $stmt->execute([15]);
            //$count = $stmt->rowCount();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results;
            //return $count;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function getButtonsInspectionbyImei($IMEI)
    {
        try {
            $db = static::getDB();
            $stmt = $db->prepare('SELECT * FROM forzaerp_inspection_details_buttons
            WHERE device_imei=?');
            $stmt->execute([$IMEI]);
            //$count = $stmt->rowCount();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results;
            //return $count;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function getCameraInspectionbyImei($IMEI)
    {
        try {
            $db = static::getDB();
            $stmt = $db->prepare('SELECT * FROM forzaerp_inspection_details_camera
            WHERE device_imei=?');
            $stmt->execute([$IMEI]);
            //$count = $stmt->rowCount();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results;
            //return $count;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }


    }

    public static function getConnInspectionbyImei($IMEI)
    {
        try {
            $db = static::getDB();
            $stmt = $db->prepare('SELECT * FROM forzaerp_inspection_details_connections
             WHERE device_imei=?');
            $stmt->execute([$IMEI]);
            //$count = $stmt->rowCount();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results;
            //return $count;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function getMiscInspectionbyImei($IMEI)
    {
        try {
            $db = static::getDB();
            $stmt = $db->prepare('SELECT * FROM forzaerp_inspection_details_misc
             WHERE device_imei=?');
            $stmt->execute([$IMEI]);
            //$count = $stmt->rowCount();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results;
            //return $count;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }


    public static function getPowerInspectionbyImei($IMEI)
    {
        try {
            $db = static::getDB();
            $stmt = $db->prepare('SELECT * FROM forzaerp_inspection_details_power
             WHERE device_imei=?');
            $stmt->execute([$IMEI]);
            //$count = $stmt->rowCount();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results;
            //return $count;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function getScreenInspectionbyImei($IMEI)
    {
        try {
            $db = static::getDB();
            $stmt = $db->prepare('SELECT * FROM forzaerp_inspection_details_screen
              WHERE device_imei=?');
            $stmt->execute([$IMEI]);

            //$count = $stmt->rowCount();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results;
            //return $count;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function getSoundInspectionbyImei($IMEI)
    {
        try {
            $db = static::getDB();
            $stmt = $db->prepare('SELECT * FROM forzaerp_inspection_details_sound 
              WHERE imei=?');
            $stmt->execute([$IMEI]);
            //$count = $stmt->rowCount();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results;
            //return $count;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }


}