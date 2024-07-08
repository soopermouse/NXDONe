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

    public static function Overview()
    {
        try {
            $db = static::getDB();
            $stmt = $db->query('SELECT * FROM forzaerp_rebuy_order AS r 
            JOIN forzaerp_rebuy_order_device AS d ON r.order_id=d.order_id
            JOIN forzaerp_device_model AS t ON d.device_type_id=t.device_id
            JOIN forzaerp_rebuy_order_status AS x ON r.order_id=x.order_id
            JOIN forzaerp_rebuy_forza_order_status_type AS y ON x.forza_order_status=y.status_id
            JOIN forzaerp_rebuy_customer_status_type AS z ON x.customer_order_status=z.cust_status_id
            JOIN forzaerp_rebuy_order_salestag AS j ON r.order_id=j.order_id
            JOIN forzaerp_sales_order_tags AS g ON j.sales_tag_id=g.tag_id
            JOIN forzaerp_rebuy_order_quote AS a ON r.order_id=a.order_id
            ORDER BY order_date');
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }


    }

}
