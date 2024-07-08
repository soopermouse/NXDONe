<?php
/**
 * Created by PhpStorm.
 * User: SimonaThrussell
 * Date: 15/02/2019
 * Time: 12:37
 */

namespace App\Models;
use PDO;

class StatusModel extends \Core\Model
{
    public static function getRMAStatus()
    {

    }


    public static function getRebuyStatus()
    {

    }

    public static function getSalesOrderStatus()
    {
        try {
            $db = static::getDB();
            $stmt = $db->query("SELECT * FROM forzaerp_sales_orders as o
            JOIN forzaerp_sales_order_status as r on o.repair_id=r.order_id
            
            
            
            ");

            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function updateRMAstatus($fstatus, $rma_id)
    {
        try {
            $db = static::getDB();
            $sql = "UPDATE forzaerp_rma_order_status SET `status_id` = ? WHERE `rma_id` = ?";
            $db->prepare($sql)->execute([$fstatus, $rma_id]);

        } catch (\PDOException $e) {
            echo $e->getMessage();
        }


    }

    public static function updateRepairStatus($status, $repair_id)
    {
        try {
            $db = static::getDB();
            $sql = "UPDATE forzaerp_repair_order_status SET `status_type` = ? WHERE `order_id` = ?";
            $db->prepare($sql)->execute([$status, $repair_id]);

        } catch (\PDOException $e) {
            echo $e->getMessage();
        }


    }


    public static function updateForzaRebuyDeviceStatus($fstatus, $imei)
    {

        try {
            $db = static::getDB();
            $stmt =$db->prepare("UPDATE forzaerp_rebuy_device_status SET `forza_order_status` = ? WHERE `imei` = ?");
            $stmt->execute([$fstatus, $imei]);
            $message= "status updated";
            return $message;

        } catch (\PDOException $e) {
            echo $e->getMessage();
        }




    }

    public static function updateForzaRebuystatuscheck($fstatus,$IMEI, $device_id)
    {

        try {
            $db = static::getDB();
            $stmt =$db->prepare("UPDATE forzaerp_rebuy_device_status SET `forza_order_status` = ?,`imei`=? WHERE `device_id` = ?");
            $stmt->execute([$fstatus,$IMEI, $device_id]);
            $message= "status updated";
            return $message;

        } catch (\PDOException $e) {
            echo $e->getMessage();
        }




    }


    public static function GetRepairStatus()
    {
        try {
            $db = static::getDB();
            $stmt = $db->query("SELECT * FROM forzaerp_repair_orders as o
            JOIN forzaerp_repair_order_type as t on o.type_id=t.type_id
            JOIN forzaerp_repair_order_status as r on o.repair_id=r.order_id
            JOIN forzaerp_repair_order_status_types as n on r.status_type=n.status_id
            JOIN forzaerp_repair_action_types as a on a.action_id=r.action
            JOIN forzaerp_device as d on o.imei=d.device_IMEI
            JOIN forzaerp_device_model as m on d.device_type=m.device_id
            JOIN forzaerp_device_storage_type as s on d.device_storage=s.storage_type_id
            JOIN  forzaerp_connection_type as c on d.device_connection=c.connection_type_id
            JOIN forzaerp_device_colour as l on d.device_colour=l.colour_id
            
            
            ");

            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function makeDeviceStatus($imei,$status,$action,$stream)
    {
        try {
            $db = static::getDB();
            $stmt = $db->prepare("INSERT INTO `forzaerp_device_status`(`device_imei`, `device_status`, `next_action`,`stream_id`) VALUES (?,?,?,?)
            ");
            $stmt->execute([$imei,$status,$action,$stream]);
            $id=$db->lastInsertId();
            return $id;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function updateDeviceStatus($status, $action, $stream,$imei)
    {
        try {
            $db = static::getDB();

            $sql = "UPDATE forzaerp_device_status SET `device_status` = ?,`next_action`=?,`stream_id`=? WHERE `device_imei` = ?";

            $db->prepare($sql)->execute([$status, $action, $stream,$imei]);
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

    }

    public static function makerebuydevicestatus($order_id,$device_id,$imei,$order_status,$cstatus,$action)
    {
        try {
            $db = static::getDB();
            $stmt = $db->prepare("INSERT INTO forzaerp_rebuy_device_status (`order_id`,`device_id`,`imei`,`forza_order_status`,`customer_order_status`,`next_action_id`) VALUES(?,?,?,?,?,?)
            ");
            $stmt->execute([$order_id,$device_id,$imei,$order_status,$cstatus,$action]);
            $device_status=$db->lastInsertId();

            $message =$device_status. " device status created";




        } catch (\PDOException $e) {
            echo $e->getMessage();
        }


    }

    public static function updaterebuydevicestatus($status,$cstatus,$action,$imei)
    {
        try {
            $db = static::getDB();
            $stmt =$db->prepare( "UPDATE forzaerp_rebuy_device_status SET `forza_order_status` = ?, `customer_order_status`=?, `next_action_id`=? WHERE `imei`=?");
            $stmt->execute([$status,$cstatus,$action,$imei]);

        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }


}