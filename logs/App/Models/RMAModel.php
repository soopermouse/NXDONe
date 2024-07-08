<?php
/**
 * Created by PhpStorm.
 * User: darke
 * Date: 31/10/2018
 * Time: 20:03
 */


namespace App\Models;
use PDO;

class RMAModel extends \Core\Model
{


    public static function getWarranty($imei)
    {

            try {
                $db = static::getDB();
                $stmt = $db->prepare("SELECT * FROM forzaerp_sales_order AS r 
                JOIN forzaerp_warranty as w on r.order_id=w.order_id
                JOIN forzaerp_sales_order_device as d on d.order_id=r.order_id
                JOIN forzaerp_device_model as t on d.device_type_id=t.device_id
                JOIN forzaerp_device_storage_type as s on d.device_storage_id=s.storage_type_id
                JOIN forzaerp_connection_type as c on d.device_connection_id=c.connection_type_id
                
                WHERE w.device_imei=?");
                $stmt->execute([$imei]);
                $results = $stmt->fetchAll();
                //return $results;
                $count = $stmt->rowCount();
                return $results;
            } catch (\PDOException $e) {
                echo $e->getMessage();
            }



    }

    public static function makeRMA($imei)
    {




    }

    public static function checkMEI($imei)
    {
        try {
            $db = static::getDB();
            $stmt = $db->prepare("SELECT * FROM forzaerp_warranty WHERE device_imei=?");
            $stmt->execute([$imei]);

            $count = $stmt->rowCount();
            return $count;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

























}