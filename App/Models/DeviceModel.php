<?php
/**
 * Created by PhpStorm.
 * User: SimonaThrussell
 * Date: 07/11/2018
 * Time: 13:15
 */

namespace App\Models;
use PDO;

class DeviceModel extends \Core\Model
{

    public static function makeRebuyDevice($order_id, $devicetype, $devicestorage, $deviceconnection, $devicecondition)
    {
        try{
            $db=static::getDB();
            $stmt=$db->prepare( "INSERT into
            forzaerp_rebuy_order_device (`order_id`,`device_type_id`,`device_storage_id`,`device_connection_id`,`device_condition_id`,`device_colour_id`,`device_imei`) 
            VALUES (?,?,?,?,?,?,?)");

            $stmt->execute([$order_id,$devicetype,$devicestorage, $deviceconnection,$devicecondition,0,0]);
            $device_id=$db->lastInsertId();
            return $device_id;


        }
        catch (\PDOException $e)
        {
            echo $e->getMessage();
        }


    }

    public static function makeSupplyDevice($order_id, $devicetype, $devicestorage, $deviceconnection, $devicecondition, $devicecolour,$imei)
    {
        try{
            $db=static::getDB();
            $sql= "INSERT into
            forzaerp_supply_order_device (`order_id`,`device_type_id`,`device_storage_id`,`device_connection_id`,`device_condition_id`,`device_colour_id`,`device_imei`) 
            VALUES (?,?,?,?,?,?,?)";
            $stmt=$db->prepare($sql);
            $stmt->execute([$order_id,$devicetype,$devicestorage, $deviceconnection,$devicecondition,$devicecolour,$imei]);
            $device_id=$db->lastInsertId();

            $message=$device_id." Device created</br>";
            return $message;

        }
        catch (\PDOException $e)
        {
            echo $e->getMessage();
        }


    }

    public static function getIMEI($order_id)
    {
        try {
            $db = static::getDB();
            $stmt = $db->prepare("SELECT * FROM forzaerp_rebuy_device_check
            WHERE order_id=?");
            $stmt->execute([$order_id]);
            $results = $stmt->fetchAll();
            return $results;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

    }

    public static function makeSaleDevice($order_id, $devicetype, $devicestorage, $deviceconnection, $devicecondition, $devicecolour)
    {
        try{
            $db=static::getDB();
            $sql= "INSERT into
            forzaerp_sale_order_device (`order_id`,`device_type_id`,`device_storage_id`,`device_connection_id`,`device_condition_id`,`device_colour_id`) 
            VALUES (?,?,?,?,?,?)";
            $stmt=$db->prepare($sql);
            $stmt->execute([$order_id,$devicetype,$devicestorage, $deviceconnection,$devicecondition,$devicecolour

            ]);
            $stmt = null;

            $message="Device created";
            return $message;

        }
        catch (\PDOException $e)
        {
            echo $e->getMessage();
        }



    }


    public static function getDeviceId($imei)
    {
        try {
            $db = static::getDB();
            $stmt = $db->prepare("SELECT `device_id` FROM forzaerp_rebuy_device_check
            WHERE `IMEI`=?");
            $stmt->execute([$imei]);
            $results = $stmt->fetchAll();
            return $results[0][0];

        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }


    public static function getHistory($imei)
    {
        try {
            $db = static::getDB();
            $stmt = $db->prepare("SELECT * FROM forzaerp_rebuy_order_device as c 
            JOIN forzaerp_rebuy_inspection as i on c.order_id=i.order_id 
            JOIN forzaerp_rebuy_inspection_failcard as f on c.order_id=f.order_id 
            JOIN forzaerp_rebuy_order as o on o.order_id=c.order_id 
            JOIN forzaerp_rebuy_device_condition as r on i.device_condition=r.condition_id 
            JOIN forzaerp_device_model as t on t.device_id=i.device_type 
            JOIN forzaerp_device_storage_type as s on i.device_storage=s.storage_type_id 
            JOIN forzaerp_rebuy_order_offer as a on c.order_id=a.order_id
            WHERE c.device_imei=?");
            $stmt->execute([$imei]);
            $results = $stmt->fetchAll();
            return $results;

        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

    }


    public static function getDeviceByImei($imei)
    {
        try {
            $db = static::getDB();
            $stmt = $db->prepare("SELECT * FROM forzaerp_rebuy_device_check as c 
            JOIN forzaerp_rebuy_inspection as i on c.order_id=i.order_id 
            JOIN forzaerp_rebuy_order as o on o.order_id=c.order_id 
            JOIN forzaerp_rebuy_device_condition as r on i.device_condition=r.condition_id 
            JOIN forzaerp_device_model as t on t.device_id=i.device_type 
            JOIN forzaerp_device_storage_type as s on i.device_storage=s.storage_type_id 
            WHERE c.IMEI=?");
            $stmt->execute([$imei]);
            $results = $stmt->fetchAll();
            return $results;

        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

    }

    public static function addToInventory($imei,$location_code)
    {
        try {
            $db = static::getDB();


            $sql = "INSERT INTO
            forzaerp_device_inventory (`IMEI`,`location_code`) 
            VALUES (?,?)";
            $stmt = $db->prepare($sql);
            $stmt->execute([$imei,$location_code]);
            $message="Inventory location updated";
            return $message;
            //$stmt = null;


        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

    }

    public static function makeDevice($device_imei,$devicetype, $devicestorage, $deviceconnection, $devicecolour)
    {
        try{
            $db=static::getDB();
            $sql= "INSERT into
            forzaerp_device (`device_IMEI`,`device_type`,`device_storage`,`device_connection`,`device_colour`) 
            VALUES (?,?,?,?,?)";
            $stmt=$db->prepare($sql);
            $stmt->execute([$device_imei,$devicetype, $devicestorage, $deviceconnection, $devicecolour

            ]);
            $stmt = null;

            $message="Device created";
            return $message;

        }
        catch (\PDOException $e)
        {
            echo $e->getMessage();
        }


    }

    public static function updateDevice($device_id, $device_imei,$devicetype, $devicestorage, $deviceconnection, $devicecolour)
    {
        try{
            $db=static::getDB();
            $sql= "INSERT into
            forzaerp_device (`device_id`,`device_IMEI`,`device_type`,`device_storage`,`device_connection`,`device_colour`) 
            VALUES (?,?,?,?,?,?)";
            $stmt=$db->prepare($sql);
            $stmt->execute([$device_id, $device_imei,$devicetype, $devicestorage, $deviceconnection, $devicecolour

            ]);
            $stmt = null;

            $message="Device created";
            return $message;

        }
        catch (\PDOException $e)
        {
            echo $e->getMessage();
        }


    }


    public static function makeNewDevice($IMEI)
    {
        try {
            $db = static::getDB();
            $stmt = $db->prepare('INSERT INTO
            forzaerp_device (`device_imei`) 
            VALUES (?)');

            $stmt->execute([$IMEI ]);

            $id = $db->lastInsertId();

            return $id;


        } catch (\PDOException $e) {
            echo $e->getMessage();
        }


    }

    public static function updateNewDevice( $device_type,$device_storage,$device_connection,$device_colour,$device_imei)
    {
        try {
            $db = static::getDB();
            $stmt = $db->prepare('UPDATE forzaerp_device SET `device_type` = ? , `device_storage`=? , `device_connection`=?,`device_colour`=? WHERE `device_imei` = ?');

            $stmt->execute([$device_type,$device_storage,$device_connection,$device_colour,$device_imei ]);

            //$id = $db->lastInsertId();

            //return $id;
            $message="device updated";
            return $message;


        } catch (\PDOException $e) {
            echo $e->getMessage();
        }


    }

    public static function getDeviceModel($imei)
    {
        try {
            $db = static::getDB();
            $stmt = $db->prepare("SELECT device_type FROM forzaerp_device 
            WHERE device_IMEI=?");
            $stmt->execute([$imei]);
            $results = $stmt->fetch(PDO::FETCH_ASSOC);
            return $results['device_type'];

        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

    }

    public static function updateRebuyDevice( $device_type,$device_storage,$devicecondition,$device_connection,$device_colour,$device_imei)
    {
        try {
            $db = static::getDB();
            $stmt = $db->prepare('UPDATE forzaerp_rebuy_order_device SET `device_type_id` = ? , `device_storage_id`=? , `device_condition_id`=?,`device_connection_id`=?,`device_colour_id`=? WHERE `device_imei` = ?');

            $stmt->execute([$device_type,$device_storage,$device_connection,$devicecondition,$device_colour,$device_imei ]);

            //$id = $db->lastInsertId();

            //return $id;
            $message="device updated";
            return $message;


        } catch (\PDOException $e) {
            echo $e->getMessage();
        }


    }

    public static function makeRebuyExpectedDevice($order_id, $devicetype, $devicestorage, $deviceconnection, $devicecondition,$devicequote)
    {
        try{
            $db=static::getDB();
            $stmt=$db->prepare( "INSERT into
            forzaerp_rebuy_expected_order_device (`order_id`,`device_type_id`,`device_storage_id`,`device_connection_id`,`device_condition_id`,`device_quote_id`) 
            VALUES (?,?,?,?,?,?)");

            $stmt->execute([$order_id,$devicetype,$devicestorage, $deviceconnection,$devicecondition,$devicequote]);
            $device_id=$db->lastInsertId();
            return $device_id;


        }
        catch (\PDOException $e)
        {
            echo $e->getMessage();
        }


    }









}