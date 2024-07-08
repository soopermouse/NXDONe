<?php
/**
 * Created by PhpStorm.
 * User: SimonaThrussell
 * Date: 18/12/2018
 * Time: 17:19
 *//**
 * Created by PhpStorm.
 * User: SimonaThrussell
 * Date: 18/12/2018
 * Time: 11:53
 */


namespace App\Models;
use PDO;

class EventModel extends \Core\Model
{
    public static function CreateEvent($user_id,$event_type,$imei,$stream)
    {
        try {
            $db = static::getDB();
            $date = new \DateTime();
            $date->getTimestamp();
            $start_time=$date->format('Y-m-d H:i:s');
            $sql = 'INSERT INTO
            forzaerp_events (`user_id`,`event_type`,`imei`,`event_stream`) 
            VALUES (?,?,?,?)';
            $stmt = $db->prepare($sql);
            $stmt->execute([$user_id, $event_type,$imei,
            $stream]);
            $stmt = null;
            $event_id = $db->lastInsertId();

            return $event_id;


        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

    }

    public static function UpdateEvent($event_id)
    {
         try {
                $db = static::getDB();
                $sql = "UPDATE forzaerp_events SET `event_status` = 4 WHERE `event_id` = ?";
                $stmt=$db->prepare($sql);
                $stmt->execute([$event_id]);
                $event_created= $event_id = $db->lastInsertId();
                return $event_created;

            } catch (\PDOException $e) {
                echo $e->getMessage();
            }

    }

    public static function EndEvent($event_id)
    {
        try {
            $db = static::getDB();
            $date = new \DateTime();
            $date->getTimestamp();
            $end_time=$date->format('Y-m-d H:i:s');
            $sql = "UPDATE forzaerp_events SET `event_end` = ? WHERE `event_id` = ?";
            $stmt=$db->prepare($sql);
            $stmt->execute([$end_time,$event_id]);
            $event_created= $event_id = $db->lastInsertId();
            return $event_created;

        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

    }




    public static function createHistoryEvent($imei,$event_type,$stream)
    {
        try {
            $db = static::getDB();
            $date=date('Y-m-d');
            $sql = "INSERT INTO forzaerp_device_history(`imei`,`date`,`event_type`,`event_stream`) VALUES (?,?,?,?)";
            $stmt = $db->prepare($sql);
            $stmt->execute([$imei, $date,$event_type,$stream ]);
            //$stmt = null;
            $event_id = $db->lastInsertId();

            return $event_id;


        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

    }

    public static function getDeviceStatus($imei)
    {
        try {
            $db = static::getDB();
            $stmt = $db->prepare("SELECT * FROM forzaerp_device_history as o
            JOIN forzaerp_events as d on o.imei=d.imei
            JOIN forzaerp_event_type as e on o.event_type=e.event_type_id
            JOIN forzaerp_event_streams as s on s.stream_id=o.event_stream
            WHERE d.imei=? ORDER BY `date`");
            $stmt->execute([$imei]);
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

    }




}