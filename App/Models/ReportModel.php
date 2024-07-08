<?php
/**
 * Created by PhpStorm.
 * User: SimonaThrussell
 * Date: 20/12/2018
 * Time: 11:53
 */
namespace App\Models;
use PDO;

class ReportModel extends \Core\Model
{
    public static function getOrders()
    {
        try {
            $db = static::getDB();
            $stmt = $db->query('SELECT * FROM forzaerp_rebuy_order AS r 
            JOIN forzaerp_customer AS c ON r.customer_id=c.customer_id 
            JOIN forzaerp_rebuy_order_device AS d ON r.order_id=d.order_id
            JOIN forzaerp_device_model AS t ON d.device_type_id=t.device_id
            JOIN forzaerp_device_storage_type AS s ON d.device_storage_id=s.storage_type_id 
            JOIN forzaerp_rebuy_device_condition AS i ON d.device_condition_id=i.condition_id
            JOIN forzaerp_connection_type AS m ON d.device_connection_id=m.connection_type_id
            JOIN forzaerp_rebuy_order_status AS x ON r.order_id=x.order_id
            JOIN forzaerp_rebuy_forza_order_status_type AS y ON x.forza_order_status=y.status_id
            JOIN forzaerp_rebuy_customer_status_type AS z ON x.customer_order_status=z.cust_status_id
            JOIN forzaerp_rebuy_action_status AS a ON a.action_id=x.next_action_id
            /*JOIN forzaerp_rebuy_order_quote as a on r.order_id=a.order_id*/
            ORDER BY order_date DESC LIMIT 10');
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

    }

    public static function getDevice($order_id)
    {
        try {
            $db = static::getDB();
            $stmt = $db->prepare("SELECT * FROM forzaerp_rebuy_order AS r 
            JOIN forzaerp_customer AS c ON r.customer_id=c.customer_id             
            JOIN forzaerp_rebuy_order_device AS d ON r.order_id=d.order_id
            JOIN forzaerp_device_model AS t ON d.device_type_id=t.device_id
            JOIN forzaerp_device_storage_type AS s ON d.device_storage_id=s.storage_type_id 
            JOIN forzaerp_rebuy_device_condition AS i ON d.device_condition_id=i.condition_id
            JOIN forzaerp_connection_type AS m ON d.device_connection_id=m.connection_type_id
            JOIN forzaerp_rebuy_order_status AS x ON r.order_id=x.order_id
            JOIN forzaerp_rebuy_forza_order_status_type AS y ON x.forza_order_status=y.status_id
            JOIN forzaerp_rebuy_customer_status_type AS z ON x.customer_order_status=z.cust_status_id
            JOIN forzaerp_device_colour AS b ON d.device_colour_id=b.colour_id
            JOIN forzaerp_rebuy_inspection AS o ON o.order_id=r.order_id
            WHERE r.order_id=?");
            $stmt->execute([$order_id]);
            $results = $stmt->fetchAll();
            return $results;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

    }



    public static function RMAByImei($imei)
    {
        try {
            $db = static::getDB();
            $stmt = $db->prepare("SELECT * FROM forzaerp_rma_order AS r 
            
            WHERE r.device_imei=?");
            $stmt->execute([$imei]);
            $results = $stmt->fetchAll();
            return $results;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function RMAByProblemType($problem_id)
    {
        try {
            $db = static::getDB();
            $stmt = $db->prepare('SELECT * FROM forzaerp_rma_order AS r 
            JOIN forzaerp_rma_order_details as d on r.rma_id=d.rma_id
            JOIN forzaerp_rma_problem_code as c on d.problem_id=c.problem_id
            WHERE d.problem_id=?');
            $stmt->execute([$problem_id]);
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function RMAByBusinessCustomer($business_id)
    {
        try {
            $db = static::getDB();
            $stmt = $db->prepare('SELECT * FROM forzaerp_rma_order AS r 
            JOIN forzaerp_business_users as b on r.business_id=b.business_id
            WHERE r.business_id=?');
            $stmt->execute([$business_id]);
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function RMAbyReseller($reseller_id)
    {
        try {
            $db = static::getDB();
            $stmt = $db->prepare('SELECT * FROM forzaerp_rma_order AS r 
            JOIN forzaerp_resellers as s on r.reseller_id=s.reseller_id
            WHERE r.reseller_id=?');
            $stmt->execute([$reseller_id]);
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function RMAByUserId($user_id)
    {
        try {
            $db = static::getDB();
            $stmt = $db->prepare('SELECT * FROM forzaerp_rma_order AS r 
            JOIN forzaerp_users as u on r.rma_approved_by=u.user_id
            WHERE r.rma_approved_by=?');
            $stmt->execute([$user_id]);
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function RMAByDeviceType($device_type)
    {
        try {
            $db = static::getDB();
            $stmt = $db->prepare('SELECT * FROM forzaerp_rma_order AS r 
           JOIN forzaerp_rma_order_details as p on r.rma_id=p.rma_id
           JOIN forzaerp_rma_problem_code as d on p.problem_id=d.problem_id
           JOIN forzaerp_rma_order_status as s on r.rma_id=s.rma_id
           JOIN forzaerp_device as f on r.device_imei=f.device_IMEI
           JOIN forzaerp_device_model as l on f.device_type=l.device_model
            WHERE l.device_id=?');
            $stmt->execute([$device_type]);
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
           /**JOIN forzaerp_rma_action_types as a on s.next_action_id=a.action_id**/
            ORDER BY rma_date');
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function RMAbyStatus($status_id)
    {
        try {
            $db = static::getDB();
            $stmt = $db->prepare("SELECT * FROM forzaerp_rma_order AS r 
            JOIN forzaerp_customer AS c ON r.customer_id=c.customer_id 
            JOIN forzaerp_rma_order_details as p on r.rma_id=p.rma_id
           JOIN forzaerp_rma_problem_code as d on p.problem_id=d.problem_id
           JOIN forzaerp_rma_order_status as s on r.rma_id=s.rma_id
           JOIN forzaerp_rma_order_status_types as t on s.status_id=t.status_id
           JOIN forzaerp_users as u on r.approval_by=u.user_id
           WHERE s.status_id=? ");
            $stmt->execute([$status_id]);
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function RebuyByDeviceType($device_type)
    {


    }

    public static function rebuybycondition($condition_type)
    {

    }

    public static function rebuybyoffertype($offer_type)
    {

    }

    public static function rmaturnover()
    {

    }

    public static function rebuyturnover()
    {

    }

}
