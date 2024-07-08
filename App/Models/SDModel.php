<?php
/**
 * Created by PhpStorm.
 * User: SimonaThrussell
 * Date: 01/10/2018
 * Time: 09:28
 */

namespace App\Models;
use PDO;

class SDModel extends \Core\Model
{
    public static function getRebuyOrders()
    {
        try{
            $db=static::getDB();
            $stmt=$db->query('SELECT * FROM forzaerp_rebuy_order as r 
            JOIN forzaerp_customer as c ON r.customer_id=c.customer_id 
            JOIN forzaerp_rebuy_order_device as d on r.order_id=d.order_id
            JOIN forzaerp_device_model as t on d.device_type_id=t.device_id
            JOIN forzaerp_rebuy_payment_types as p on p.payment_type_id=r.payment_type_id
            ORDER BY r.order_id');
            $results=$stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        }
        catch (\PDOException $e)
        {
            echo $e->getMessage();
        }

    }

    public static function getRMAbyStatus($status_id)
    {
        try {
            $db = static::getDB();
            $stmt = $db->prepare('SELECT * FROM forzaerp_rma_order AS r 
            JOIN forzaerp_customer AS c ON r.customer_id=c.customer_id 
            JOIN forzaerp_rma_order_details as p on r.rma_id=p.rma_id
           JOIN forzaerp_rma_problem_code as d on p.problem_id=d.problem_id
           JOIN forzaerp_rma_order_status as s on r.rma_id=s.rma_id
           JOIN forzaerp_rma_order_status_types as t on s.status_id=t.status_id
           WHERE s.status_id=? ORDER BY rma_date');
            $stmt->execute([$status_id]);
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function getRMA($rma_id)
    {
        try {
            $db = static::getDB();
            $stmt = $db->prepare('SELECT * FROM forzaerp_rma_order AS r 
            JOIN forzaerp_rma_order_details as p on r.rma_id=p.rma_id
           JOIN forzaerp_rma_problem_code as d on p.problem_id=d.problem_id
            WHERE r.rma_id=?');
            $stmt->execute([$rma_id]);

            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function updateRMAStatus($status, $rma_id)
    {
        try {
            $db = static::getDB();
            $sql = "UPDATE forzaerp_rma_order_status SET `status_id` = ? WHERE `rma_id` = ?";
            $db->prepare($sql)->execute([$status, $rma_id]);

        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

    }

    public static function updateOStatus($fstatus, $rma_id)
    {
        try {
            $db = static::getDB();
            $sql = "UPDATE forzaerp_rma_order_status SET `shipping_status_id` = ? WHERE `rma_id` = ?";
            $db->prepare($sql)->execute([$fstatus, $rma_id]);

        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }



    public static function getAddress($rma_id)
    {
        try{
            $db=static::getDB();
            $stmt = $db->prepare("SELECT * FROM forzaerp_customer as c 
            JOIN forzaerp_customer_address as a on c.customer_id=a.customer_id 
            JOIN forzaerp_rma_order as o on o.customer_id=c.customer_id
            WHERE o.rma_id=?");

            $stmt->execute([$rma_id]);
            $results = $stmt->fetchAll();
            return $results;
        }
        catch (\PDOException $e)
        {
            echo $e->getMessage();
        }

    }

    public static function getShipping()
    {
        try {
            $db = static::getDB();
            $stmt = $db->query('SELECT * FROM forzaerp_rma_order_status AS r 
            JOIN forzaerp_rma_shipping_status AS d ON r.shipping_status_id=d.shipping_status_id
          ');
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }


    }


    public static function getShippingById($rma_id)
    {

        try {
            $db = static::getDB();
            $stmt = $db->prepare("SELECT * FROM forzaerp_rma_order AS r 
            JOIN forzaerp_rma_order_status AS z ON r.rma_id=z.rma_id
            JOIN forzaerp_rma_shipping_status AS d ON z.shipping_status_id=d.shipping_status_id
            
          
            WHERE r.rma_id=?");
            $stmt->execute([$rma_id]);
            $results = $stmt->fetchAll();
            return $results;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }


    }

    public static function getRMAs()
    {
        try {
            $db = static::getDB();
            $stmt = $db->query('SELECT * FROM forzaerp_rma_order AS r 
            JOIN forzaerp_customer AS c ON r.customer_id=c.customer_id 
            JOIN forzaerp_rma_order_details as p on r.rma_id=p.rma_id
           JOIN forzaerp_rma_problem_code as d on p.problem_id=d.problem_id
           JOIN forzaerp_rma_order_status as s on r.rma_id=s.rma_id
           JOIN forzaerp_rma_order_status_types as t on s.status_id=t.status_id
            ORDER BY rma_date');
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function getRMAHistory($imei)
    {
        try {
            $db = static::getDB();
            $stmt = $db->prepare('SELECT * FROM forzaerp_rma_order AS r 
            
           JOIN forzaerp_device_history as h on r.device_imei=h.imei
           JOIN forzaerp_event_type as e on h.event_type=e.event_type_id
          
           WHERE r.device_imei=?
            ORDER BY rma_date');
            $stmt->execute([$imei]);
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }


    public static function getIMEI($rma_id)
    {
        try {
            $db = static::getDB();
            $stmt = $db->prepare("SELECT * FROM forzaerp_rma_order
            WHERE rma_id=?");
            $stmt->execute([$rma_id]);
            $results = $stmt->fetchAll();
            return $results[0][3];
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

    }

    public static function getRebuyStatus()
    {
        {
            try {
                $db = static::getDB();
                $stmt = $db->query('SELECT * FROM forzaerp_rebuy_order AS r
            JOIN forzaerp_rebuy_order_status AS x ON r.order_id=x.order_id
            JOIN forzaerp_rebuy_forza_order_status_type AS y ON x.forza_order_status=y.status_id
            JOIN forzaerp_rebuy_customer_status_type AS z ON x.customer_order_status=z.cust_status_id
            JOIN forzaerp_rebuy_action_status AS a ON x.next_action_id=a.action_id
            JOIN forzaerp_rebuy_action_buttons as b on b.action_id=a.action_id
            ');
                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $results;
            } catch (\PDOException $e) {
                echo $e->getMessage();
            }


        }

    }





}