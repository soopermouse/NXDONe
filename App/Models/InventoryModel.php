<?php
/**
 * Created by PhpStorm.
 * User: SimonaThrussell
 * Date: 15/02/2019
 * Time: 12:39
 */

namespace App\Models;
use PDO;

class InventoryModel extends \Core\Model
{
    public static function getInventory()
    {
        try {
            $db = static::getDB();
            $stmt = $db->query('SELECT * FROM forzaerp_device_inventory AS r
            JOIN forzaerp_inventory_locations AS l ON r.location_code=l.location_id
           ');

            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

    }

    public static function getLocationInventory($location)
    {
        try {
            $db = static::getDB();
            $stmt = $db->prepare('SELECT * FROM forzaerp_device_inventory AS r
            JOIN forzaerp_inventory_locations AS l ON r.location_code=l.location_id
            WHERE location_id=? ');
            $stmt->execute([$location]);
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }


    }

    public static function movedeviceLocation($location_id,$imei)
    {
        try {
            $db = static::getDB();
            $sql = "UPDATE forzaerp_device_inventory SET `location_code` = ? WHERE `IMEI` = ?";
            $db->prepare($sql)->execute([$location_id,$imei]);
            $message=$imei."was moved to location id ".$location_id;
            return $message;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }


    public static function addToInventory($imei,$location_code)
    {
        try {
            $db = static::getDB();


            $sql = "INSERT INTO
            forzaerp_device_inventory (`IMEI`,`location_code`) 
            VALUES (?,?)";
            $stmt = $db->prepare($sql);
            $stmt->execute([$imei,$location_code]);
            $message="Inventory location updated";
            return $message;
            //$stmt = null;


        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

    }

    public static function getDevice($imei)
    {
        try {
            $db = static::getDB();
            $sql = $db->prepare('SELECT count(*) FROM forzaerp_device_inventory AS r
            JOIN forzaerp_inventory_locations AS l ON r.location_code=l.location_id
            WHERE r.IMEI=?');

            $sql->execute([$imei]);
            $count = $sql->fetchColumn();
            return $count;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

    }

    public static function removedevice($imei)
    {
        try {
        $db = static::getDB();
        $sql = $db->prepare('DELETE FROM forzaerp_device_inventory AS r
                    
                    WHERE IMEI=?');

        $sql->execute([$imei]);
        $count = $sql->fetchColumn();
        return $count;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

    }









}