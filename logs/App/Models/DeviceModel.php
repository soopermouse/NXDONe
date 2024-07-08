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

    public static function makeRebuyDevice($order_id, $devicetype, $devicestorage, $deviceconnection, $devicecondition, $devicecolour)
    {
        try{
            $db=static::getDB();
            $sql= "INSERT into
            forzaerp_rebuy_order_device (`order_id`,`device_type_id`,`device_storage_id`,`device_connection_id`,`device_condition_id`,`device_colour_id`) 
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
            return $results;

        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }


    public static function getHistory($imei)
    {
        try {
            $db = static::getDB();
            $stmt = $db->prepare("SELECT * FROM forzaerp_rebuy_device_check as c 
            JOIN forzaerp_rebuy_inspection as i on c.order_id=i.order_id 
            JOIN forzaerp_rebuy_inspection_failcard as f on c.order_id=f.order_id 
            JOIN forzaerp_rebuy_order as o on o.order_id=c.order_id 
            JOIN forzaerp_rebuy_device_condition as r on i.device_condition=r.condition_id 
            JOIN forzaerp_device_model as t on t.device_id=i.device_type 
            JOIN forzaerp_device_storage_type as s on i.device_storage=s.storage_type_id 
            WHERE `IMEI`=?");
            $stmt->execute([$imei]);
            $results = $stmt->fetchAll();
            return $results;

        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

    }









}