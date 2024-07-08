<?php
/**
 * Created by PhpStorm.
 * User: simona
 * Date: 05/03/2019
 * Time: 14:21
 */

namespace App\Models;
use PDO;

class ReturnModel extends \Core\Model
{
    public static function createReturnOrder($order_id,$device_imei)
    {
        $date = date('Y-m-d');
        try{
            $db=static::getDB();
            $sql= "INSERT into
            forzaerp_return_order (`crder_id`,`device_imei`,`return_date`) 
            VALUES (?,?,?)";
            $stmt=$db->prepare($sql);
            $stmt->execute([$order_id,$device_imei,$date
            ]);
            $stmt = null;
            $order_id = $db->lastInsertId();
            return $order_id;

        }
        catch (\PDOException $e)
        {
            echo $e->getMessage();
        }
    }

    public static function checkReturnbyorderid($order_id)
    {
        $date = date('Y-m-d');
        try{
            try {
                $db = static::getDB();
                $stmt =$db->prepare( "SELECT * FROM `forzaerp_sales_order`
                WHERE order_id=? ");
                $stmt->execute([$order_id]);
                $results = $stmt->fetchAll();
                return $results;
            } catch (\PDOException $e) {
                echo $e->getMessage();
            }

        }
        catch (\PDOException $e)
        {
            echo $e->getMessage();
        }
    }


    public static function checkReturnbyimei($imei)
    {
        $date = date('Y-m-d');

            try {
                $db = static::getDB();
                $stmt =$db->prepare( "SELECT * FROM `forzaerp_sales_order_device_imei` as r
                JOIN forzaerp_sales_order as o on r.order_id=o.order_id
                WHERE r.device_imei=?");
                $stmt->execute([$imei]);
                $results = $stmt->fetchAll();
                return $results;
            } catch (\PDOException $e) {
                echo $e->getMessage();
            }



    }

    public static function getReturns()
    {


            try {
                $db = static::getDB();
                $stmt =$db->query( "SELECT * FROM forzaerp_return_orders");

                $results = $stmt->fetch();
                return $results;
            } catch (\PDOException $e) {
                echo $e->getMessage();
            }


    }

}