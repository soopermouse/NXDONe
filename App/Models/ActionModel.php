<?php
/**
 * Created by PhpStorm.
 * User: simona
 * Date: 07/03/2019
 * Time: 06:33
 */
namespace App\Models;
use PDO;

class ActionModel extends \Core\Model
{

    Public static function setRMAAction($action, $rma_id)
    {
        {
            try {
                $db = static::getDB();
                $stmt= $db->prepare("UPDATE forzaerp_rma_order_status SET `next_action_id` = ? WHERE `rma_id` = ?");
                $stmt->execute([$action, $rma_id]);

            } catch (\PDOException $e) {
                echo $e->getMessage();
            }
        }
    }


    public static function setRebuyDeviceAction($action, $imei)
    {


            try {
                $db = static::getDB();
                $stmt=$db->prepare("UPDATE forzaerp_rebuy_device_status SET `next_action_id` = ? WHERE `imei` = ?");
                $stmt->execute([$action, $imei]);

            } catch (\PDOException $e) {
                echo $e->getMessage();
            }


    }

    public static function setRebuyCheckAction($action,$device_id)
    {


        try {
            $db = static::getDB();
            $stmt = $db->prepare("UPDATE forzaerp_rebuy_device_status SET `next_action_id` = ? WHERE `device_id` = ?");
            $stmt->execute([$action, $device_id]);

        } catch (\PDOException $e) {
            echo $e->getMessage();
        }


    }
    public static function setRebuyActionbyOrderId($action,$order_id)
    {


        try {
            $db = static::getDB();
            $sql = "UPDATE forzaerp_rebuy_order_status SET `next_action_id` = ? WHERE `order_id` = ?";
            $db->prepare($sql)->execute([$action, $order_id]);

        } catch (\PDOException $e) {
            echo $e->getMessage();
        }


    }

    public static function setRepairAction($action,$order_id)
    {


        try {
            $db = static::getDB();
            $stmt = $db->prepare("UPDATE forzaerp_repair_order_status SET `action` = ? WHERE `order_id` = ?");
            $stmt->execute([$action, $order_id]);

        } catch (\PDOException $e) {
            echo $e->getMessage();
        }


    }









}