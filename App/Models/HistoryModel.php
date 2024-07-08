<?php
/**
 * Created by PhpStorm.
 * User: SimonaThrussell
 * Date: 15/02/2019
 * Time: 09:07
 */

namespace App\Models;
use PDO;

class HistoryModel extends \Core\Model
{
    public static function getHistory($imei)
    {
        try {
            $db = static::getDB();
            $stmt = $db->prepare('SELECT * FROM forzaerp_rma_order AS r 
            JOIN forzaerp_device_history as h on r.imei=h.imei
           JOIN forzaerp_event_type as e on h.event_type=e.event_type_id
           JOIN forzaerp_inspection as i on i.device_imei=r.imei
           JOIN forzaerp_event_streams as s on s.stream_id=h.event_stream
           WHERE r.imei=? ');
            $stmt->execute([$imei]);
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function getEventHistory($imei)
    {
        try {
            $db = static::getDB();
            $stmt = $db->prepare('SELECT * FROM forzaerp_device AS f
         
           JOIN forzaerp_rma_problem_code as d on p.problem_id=d.problem_id
         
           JOIN forzaerp_device_history as h on f.device_IMEI=h.imei
           JOIN forzaerp_event_type as e on h.event_type=e.event_type_id
           JOIN forzaerp_inspection as i on f.device_IMEI=i.device_imei
           JOIN forzaerp_rebuy_device_check as c on c.IMEI=f.device_IMEI
           JOIN
           WHERE f.device_IMEI=?');
            $stmt->execute([$imei]);
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }












}