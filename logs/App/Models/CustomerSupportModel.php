<?php
/**
 * Created by PhpStorm.
 * User: SimonaThrussell
 * Date: 01/10/2018
 * Time: 09:28
 */

namespace App\Models;
use PDO;

class CustomerSupportModel extends \Core\Model
{
    public static function getOrders()
    {
        try{
            $db=static::getDB();
            $stmt=$db->query('SELECT * FROM forzaerp_order as r JOIN forzaerp_customer as c ON r.customer_id=c.customer_id 
            JOIN rebuyplus_device_customer_estimated_status as d on r.order_id=d.order_id
            JOIN forzaerp_device_model as t on d.device_type=t.device_id
            JOIN forzaerp_rebuy_payment_types as p on p.payment_type_id=r.payment_type_id
            ORDER BY order_date');
            $results=$stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        }
        catch (\PDOException $e)
        {
            echo $e->getMessage();
        }

    }



}