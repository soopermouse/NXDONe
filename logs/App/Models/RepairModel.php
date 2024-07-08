<?php
/**
 * Created by PhpStorm.
 * User: SimonaThrussell
 * Date: 01/10/2018
 * Time: 09:14
 */

namespace App\Models;
use PDO;

class RepairModel extends \Core\Model
{


    public static function getFailcard($imei)
    {

            try {
                $db = static::getDB();
                $stmt = $db->prepare("SELECT * FROM forzaerp_rebuy_inspection_failcard
            WHERE device_IMEI=?");
                $stmt->execute([$imei]);
                $results = $stmt->fetchAll();
                return $results;
            } catch (\PDOException $e) {
                echo $e->getMessage();
            }






    }












}