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
    public static function CreateEvent($user_id,$event_type)
    {
        try {
            $db = static::getDB();
            //$start_time=new \DateTime('Y-m-d H:i:s');
            $sql = "INSERT INTO
            forzaerp_events (`user_id`,`event_type`) 
            VALUES (?,?)";
            $stmt = $db->prepare($sql);
            $stmt->execute([$user_id, $event_type

            ]);
            $stmt = null;
            $event_id = $db->lastInsertId();

            return $event_id;


        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

    }

    public static function UpdateEvet($event_id)
    {


    }





}