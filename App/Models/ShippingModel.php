<?php
/**
 * Created by PhpStorm.
 * User: SimonaThrussell
 * Date: 15/02/2019
 * Time: 09:27
 */

namespace App\Models;
use PDO;

class ShippingModel extends \Core\Model
{

    public static function updateOrderShippingStatus($istatus, $cstatus,$order_id)
    {
        try {
            $db = static::getDB();
            $sql = "UPDATE forzaerp_sales_order_status SET `internal_shipping_status` = ?, `customer_shipping_status`=? WHERE `order_id` = ?";
            $db->prepare($sql)->execute([$istatus,$cstatus, $order_id]);

        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

    }

    public static function getRebuyShipping()
    {
        try {
            $db = static::getDB();
            $stmt = $db->query('SELECT * FROM forzaerp_rebuy_order AS r 
            JOIN forzaerp_rebuy_shipping AS s ON r.order_id=s.order_id
            JOIN forzaerp_rebuy_shipping_status AS d ON s.shipping_status=d.shipping_status_id
            /**WHERE s.shipping_status=7**/
            ORDER BY r.order_id');
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }


    }

    public static function getRebuyShippingById($order_id)
    {

        try {
            $db = static::getDB();
            $stmt = $db->prepare("SELECT * FROM forzaerp_rebuy_order AS r 
            JOIN forzaerp_rebuy_shipping AS s ON r.order_id=s.order_id
            JOIN forzaerp_rebuy_shipping_status AS d ON s.shipping_status=d.shipping_status_id
            JOIN forzaerp_rebuy_order_status AS z ON r.order_id=z.order_id
            JOIN forzaerp_rebuy_action_status AS a ON z.next_action_id=a.action_id
            JOIN forzaerp_rebuy_action_buttons as b on b.action_id=a.action_id
            WHERE r.order_id=?");
            $stmt->execute([$order_id]);
            $results = $stmt->fetchAll();
            return $results;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }


    }

    public static function updateRebuyShipping($status, $order_id)
    {
        try {
            $db = static::getDB();
            $sql = "UPDATE forzaerp_rebuy_shipping SET `shipping_status` = ? WHERE `order_id` = ?";
            $db->prepare($sql)->execute([$status, $order_id]);

        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

    }










}