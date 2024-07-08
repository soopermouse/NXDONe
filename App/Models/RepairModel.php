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

    public static function getRepairOrder($imei)
    {

        try {
            $db = static::getDB();
            $stmt = $db->prepare("SELECT `repair_id` FROM forzaerp_repair_orders as o
            
            JOIN forzaerp_inspection as i on o.imei=i.device_imei
            WHERE imei=?");
            $stmt->execute([$imei]);
            $results = $stmt->fetch();
            return $results[0];
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }


    }



    public static function getrepair2parts()
    {

        try {
            $db = static::getDB();
            $stmt = $db->prepare("SELECT * FROM forzaerp_repair2_parts_type
            WHERE device_id=?");
            $stmt->execute([1]);
            $results = $stmt->fetchAll();
            return $results;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }




    }


    public static function getRepairs()
    {
    try {
            $db = static::getDB();
            $stmt = $db->query("SELECT * FROM forzaerp_repair_orders as o
            JOIN forzaerp_repair_order_type as t on o.type_id=t.type_id
            JOIN forzaerp_device as d on o.imei=d.device_IMEI
            JOIN forzaerp_device_model as m on d.device_type=m.device_id
            JOIN forzaerp_device_storage_type as s on d.device_storage=s.storage_type_id
            JOIN forzaerp_connection_type as c on d.device_connection=c.connection_type_id
            JOIN forzaerp_repair_order_status as n on n.order_id=o.repair_id
            JOIN forzaerp_repair_order_status_types as f on n.status_type=f.status_id
            JOIN forzaerp_repair_action_types as a on n.action=a.action_id
            ");

            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

    }

    public static function getRepair($imei)
    {
        try {
            $db = static::getDB();
            $stmt = $db->prepare("SELECT * FROM forzaerp_repair_orders as o
            JOIN forzaerp_repair_order_type as t on o.type_id=t.type_id
            JOIN forzaerp_device as d on o.imei=d.device_IMEI
            JOIN forzaerp_device_model as m on m.device_id=d.device_type
            WHERE imei=?");
            $stmt->execute([$imei]);

            $results = $stmt->fetchAll();
            return $results;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function getRMAId($imei)
    {
        try {
            $db = static::getDB();
            $stmt = $db->prepare("SELECT rma_id FROM forzaerp_rma_order 
            WHERE `imei`=? ");
            $stmt->execute([$imei]);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result[0]['rma_id'];
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function getRepairId($imei)
    {
        try {
            $db = static::getDB();
            $stmt = $db->prepare("SELECT repair_id FROM forzaerp_repair_orders 
            WHERE `imei`=? ");
            $stmt->execute([$imei]);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result[0]['repair_id'];
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function getLastInspection($imei)
    {
        try {
            /* check query */
            $db = static::getDB();
            $stmt = $db->prepare('SELECT * FROM forzaerp_events as e 
            JOIN forzaerp_inspection_details_sound as s on e.imei=s.imei
            JOIN forzaerp_inspection_details_screen as d on d.device_imei=s.imei
            JOIN forzaerp_inspection_details_power as p on p.device_imei=s.imei
            JOIN forzaerp_inspection_details_misc as m on m.device_imei=s.imei
            JOIN forzaerp_inspection_details_connections as c on c.device_imei=s.imei
            JOIN forzaerp_inspection_details_camera as i on i.device_imei=s.imei
            JOIN forzaerp_inspection_details_buttons as b on b.device_imei=s.imei
            WHERE s.imei=? ORDER BY e.event_end');
            $stmt->execute([$imei]);
            $count = $stmt->rowCount();
            // $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            //return $results;
            return $count;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

    }

           public static function makeRepairOrder($imei,$inspection_id,$repair_type)
    {
        try {
            $db = static::getDB();
            $date = date('Y-m-d');
            $sql = "INSERT INTO
            forzaerp_repair_orders(`imei`,`date`,`inspection_id`,`type_id`)
            VALUES (?,?,?,?)";
            $stmt = $db->prepare($sql);
            $stmt->execute([$imei,$date,$inspection_id, $repair_type]);
            //$stmt = null;
            $order_id = $db->lastInsertId();

            return $order_id;

        } catch (\PDOException $e) {
            echo $e->getMessage();
        }


    }

    public static function makerepairstatus($order_id,$imei,$status,$action)
    {
        try {
            $db = static::getDB();

            $sql = "INSERT INTO
            forzaerp_repair_order_status(`order_id`,`imei`,`status_type`,`action`)
            VALUES (?,?,?,?)";
            $stmt = $db->prepare($sql);
            $stmt->execute([$order_id,$imei,$status,$action]);
            //$stmt = null;
            $order_id = $db->lastInsertId();

            return $order_id;

        } catch (\PDOException $e) {
            echo $e->getMessage();
        }


    }

    public static function getselect()
    {
        try {
            $db = static::getDB();
            $stmt = $db->query('SELECT * FROM forzaerp_rebuy_order ');
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }


    }

    public static function getRepairTwoParts($device_id)

    {
        try {
            $db = static::getDB();
            $stmt = $db->prepare('SELECT * FROM forzaerp_device_model as m
            JOIN  forzaerp_eav_device_part as p on m.device_id=p.deviceid
            JOIN forzaerp_repair2_parts_type as t on t.type_id=p.partid
            WHERE m.device_id=?');
            $stmt->execute([$device_id]);
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }


    }

    public static function getRepairOneParts($device_id)

    {
        try {
            $db = static::getDB();
            $stmt = $db->prepare('SELECT * FROM forzaerp_device_model as m
            /**JOIN  forzaerp_eav_device_part as p on m.device_id=p.deviceid**/
            JOIN forzaerp_repair1_parts_type as t on t.device=m.device_id
            WHERE m.device_id=?');
            $stmt->execute([$device_id]);
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }


    }

    public static function DoRepairOne($imei,$comments,$parts,$user_id,$status)
    {
         try {
            $db = static::getDB();
            $date = date('Y-m-d');
            $sql = "INSERT INTO
            forzaerp_repair_1(`device_imei`,`repair_date`,`comments`,`repair_part_1`,`repaired_by`,`status`)
            VALUES (?,?,?,?,?,?)";
            $stmt = $db->prepare($sql);
            $stmt->execute([$imei,$date,$comments,$parts,$user_id,$status]);
            //$stmt = null;
            $order_id = $db->lastInsertId();

            return $order_id;

        } catch (\PDOException $e) {
    echo $e->getMessage();
}

    }

    public static function DoRepairTWO($imei,$comments,$parts,$user_id,$status)
    {
        try {
            $db = static::getDB();
            $date = date('Y-m-d');
            $sql = "INSERT INTO
            forzaerp_repair_2(`device_imei`,`repair_date`,`comments`,`repair_part_1`,`repaired_by`,`status`)
            VALUES (?,?,?,?,?,?)";
            $stmt = $db->prepare($sql);
            $stmt->execute([$imei,$date,$comments,$parts,$user_id,$status]);
            //$stmt = null;
            $order_id = $db->lastInsertId();

            return $order_id;

        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

    }

    public static function getRecycle()
    {
        try {
            $db = static::getDB();
            $stmt = $db->query('SELECT * FROM forzaerp_device_inventory as d
            JOIN forzaerp_device as p on d.IMEI=p.device_IMEI
            JOIN forzaerp_device_model as m on p.device_type=m.device_id
            JOIN forzaerp_device_storage_type as s on p.device_storage=s.storage_type_id
            JOIN forzaerp_connection_type as t on p.device_connection=t.connection_type_id
            JOIN forzaerp_device_colour as c on p.device_colour=c.colour_id
            WHERE `location_code`=6');
            $results=$stmt->fetchAll();
            return $results;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function getLabel($imei)
    {
        try {
            $db = static::getDB();
            $stmt = $db->prepare('SELECT * FROM forzaerp_device as d            
            JOIN forzaerp_device_model as m on d.device_type=m.device_id
            JOIN forzaerp_device_storage_type as s on d.device_storage=s.storage_type_id
            JOIN forzaerp_connection_type as t on d.device_connection=t.connection_type_id
            JOIN forzaerp_device_colour as c on d.device_colour=c.colour_id
            JOIN forzaerp_device_grade as g on g.grade_id=d.Grade
            WHERE `device_IMEI`=?');
            $stmt->execute([$imei]);
            $results=$stmt->fetchAll();
            return $results;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function getLabels()
    {
        try {
            $db = static::getDB();
            $stmt = $db->query('SELECT * FROM forzaerp_device as d            
            JOIN forzaerp_device_model as m on d.device_type=m.device_id
            JOIN forzaerp_device_storage_type as s on d.device_storage=s.storage_type_id
            JOIN forzaerp_connection_type as t on d.device_connection=t.connection_type_id
            JOIN forzaerp_device_colour as c on d.device_colour=c.colour_id
            JOIN forzaerp_device_grade as g on g.grade_id=d.Grade');
            $results=$stmt->fetchAll();
            return $results;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function gradedevice($imei,$date,$grade,$user_id)
    {
        try {
            $db = static::getDB();
            $stmt =$db->prepare("INSERT INTO
            forzaerp_post_repair_grade(`imei`,`grading_date`,`device_grade`,`graded_by`)
            VALUES (?,?,?,?)");
            $stmt->execute([$imei,$date,$grade,$user_id]);
            $grade_id = $db->lastInsertId();
            return $grade_id;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

    }

    public static function getRepairsByStatus($status)
    {
        try {
            $db = static::getDB();
            $stmt = $db->prepare("SELECT * FROM forzaerp_repair_orders as o
            JOIN forzaerp_repair_order_type as t on o.type_id=t.type_id
            JOIN forzaerp_device as d on o.imei=d.device_IMEI
            JOIN forzaerp_device_model as m on d.device_type=m.device_id
            JOIN forzaerp_device_storage_type as s on d.device_storage=s.storage_type_id
            JOIN forzaerp_connection_type as c on d.device_connection=c.connection_type_id
            JOIN forzaerp_repair_order_status as n on n.order_id=o.repair_id
            JOIN forzaerp_repair_order_status_types as f on n.status_type=f.status_id
            JOIN forzaerp_repair_action_types as a on n.action=a.action_id
            WHERE status_type=?");
            $stmt->execute([$status]);
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

    }



}